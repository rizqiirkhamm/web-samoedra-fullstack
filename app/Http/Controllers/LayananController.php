<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BermainModel;
use Carbon\Carbon;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use App\Models\LayananModel;
use Illuminate\Support\Facades\Log;
use App\Models\BimbelModel;
use Illuminate\Support\Facades\Validator;
use App\Models\EventModel;
use App\Models\EventRegistrationModel;
use App\Models\DaycareRegistrationModel;
use App\Models\StimulasiModel;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    // Ubah konstanta untuk mapping jumlah pertemuan
    private const BIMBEL_MEETINGS = [
        'bimbel_calistung' => 8,    // 8x pertemuan
        'bimbel_sd' => 8,           // 8x pertemuan
        'bimbel_mengaji' => 8,      // 8x pertemuan
        'bimbel_coding' => 4,       // 4x pertemuan (khusus)
        'bimbel_english' => 8,      // 8x pertemuan
        'bimbel_arabic' => 8,       // 8x pertemuan
        'bimbel_islam' => 8,        // 8x pertemuan
        'bimbel_art' => 8,          // 8x pertemuan
        'bimbel_computer' => 8      // 8x pertemuan
    ];

    // Konstanta untuk harga bermain
    private const BERMAIN_PRICES = [
        1 => 15000,  // 1 jam = Rp 15.000
        2 => 30000,  // 2 jam = Rp 30.000
        3 => 35000,  // 3 jam = Rp 35.000
        6 => 45000   // Sepuasnya (6 jam) = Rp 45.000
    ];

    // Konstanta untuk harga daycare
    private const DAYCARE_PRICES = [
        'bulanan' => 100000,  // Bulanan = Rp 100.000
        'harian' => 110000    // Harian (9 jam) = Rp 110.000
    ];

    // Konstanta untuk harga stimulasi
    private const STIMULASI_PRICE = 50000;  // Rp 50.000

    // Konstanta untuk harga bimbel (semua jenis Rp 50.000)
    private const BIMBEL_PRICE = 50000;

    // Konstanta untuk harga kaos kaki
    private const SOCKS_PRICE = 15000;  // Rp 15.000

    public function index()
    {
        // Check permission untuk akses Layanan
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Layanan');
        if(empty($PermissionRole)){
            abort(404);
        }

        // Get active events
        $events = EventModel::all();

        // Get permissions untuk masing-masing layanan
        $data['PermissionBermain'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bermain');
        $data['PermissionBimbel'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel');
        $data['events'] = $events;

        // Get list layanan yang tersedia
        $data['getRecord'] = LayananModel::getRecord();

        return view('users.layanan', $data);
    }

    public function submit(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->main_service_type === 'bermain') {
                // Tambahkan validasi untuk form bermain
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'age' => 'required|integer|min:1',
                    'phone' => 'required|string|max:15',
                    'duration' => 'required|integer|in:1,2,3,6',
                    'date' => 'required|date|after_or_equal:today',
                    'selected_time' => 'required',
                    'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
                ]);

                // Handle file upload
                if ($request->hasFile('payment_proof')) {
                    $file = $request->file('payment_proof');
                    if ($file->isValid()) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = $file->storeAs('payment_proofs', $filename, 'public');

                        if (!$path) {
                            throw new \Exception('Gagal menyimpan file');
                        }

                        // Parse tanggal dan waktu
                        $startDateTime = Carbon::parse($request->date . ' ' . $request->selected_time);
                        $duration = intval($request->duration);
                        $endDateTime = $startDateTime->copy()->addHours($duration);

                        // Konversi hari ke bahasa Indonesia
                        $dayName = $startDateTime->format('l');
                        $indonesianDays = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];
                        $indonesianDay = $indonesianDays[$dayName] ?? $dayName;

                        // Simpan data ke database
                        $bermain = BermainModel::create([
                            'name' => $request->name,
                            'age' => intval($request->age),
                            'phone' => $request->phone,
                            'duration' => intval($request->duration),
                            'day' => $indonesianDay,
                            'start_datetime' => $startDateTime,
                            'end_datetime' => $endDateTime,
                            'status' => 'waiting',
                            'payment_proof' => $path,
                            'need_socks' => $request->has('need_socks'),
                            'remaining_time' => $duration * 3600 // Konversi jam ke detik
                        ]);

                        // Generate invoice data
                        $invoiceData = $this->generateInvoiceData(
                            'bermain',
                            [
                                'name' => $request->name,
                                'phone' => $request->phone,
                                'duration' => intval($request->duration)
                            ],
                            $request->has('need_socks')
                        );

                        DB::commit();

                        return response()->json([
                            'success' => true,
                            'message' => 'Pendaftaran berhasil!',
                            'main_service_type' => 'bermain',
                            'data' => $invoiceData
                        ]);
                    }
                }
            } elseif ($request->main_service_type === 'bimbel') {
                // Validasi untuk form bimbel
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'age' => 'required|integer|min:1',
                    'phone' => 'required|string|max:15',
                    'bimbel_type' => 'required|in:online,offline',
                    'service_type' => 'required|in:' . implode(',', array_keys(self::BIMBEL_MEETINGS)),
                    'gender' => 'required|in:L,P',
                    'birth_place' => 'required|string',
                    'birth_date' => 'required|date',
                    'has_school_history' => 'required|boolean',
                    'school_name' => 'nullable|required_if:has_school_history,1',
                    'religion' => 'required',
                    'address' => 'required|string',
                    'child_order' => 'required|integer|min:1',
                    'child_phone' => 'nullable|string',
                    'father_name' => 'required|string',
                    'father_age' => 'required|integer',
                    'father_education' => 'required|string',
                    'father_occupation' => 'required|string',
                    'mother_name' => 'required|string',
                    'mother_age' => 'required|integer',
                    'mother_education' => 'required|string',
                    'mother_occupation' => 'required|string',
                    'student_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'start_date' => 'required|date',
                ]);

                // Ambil jumlah pertemuan berdasarkan jenis bimbel
                $totalMeetings = self::BIMBEL_MEETINGS[$request->service_type];

                // Handle file uploads
                $studentPhotoPath = $request->file('student_photo')->store('student_photos', 'public');
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

                // Get day from start_date
                $day = Carbon::parse($request->start_date)->format('l');
                $indonesianDay = [
                    'Sunday' => 'Minggu',
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu'
                ][$day];

                // Get start date as Carbon instance and set to start of day
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $today = Carbon::now()->startOfDay();

                // Determine status based on start date
                $status = $startDate->lte($today) ? 'active' : 'inactive';

                // Create bimbel record
                $bimbel = BimbelModel::create([
                    'name' => $request->name,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'bimbel_type' => $request->bimbel_type,
                    'service_type' => $request->service_type,
                    'gender' => $request->gender,
                    'birth_place' => $request->birth_place,
                    'birth_date' => $request->birth_date,
                    'has_school_history' => $request->has_school_history,
                    'school_name' => $request->school_name,
                    'religion' => $request->religion,
                    'address' => $request->address,
                    'child_order' => $request->child_order,
                    'child_phone' => $request->child_phone,
                    'father_name' => $request->father_name,
                    'father_age' => $request->father_age,
                    'father_education' => $request->father_education,
                    'father_occupation' => $request->father_occupation,
                    'mother_name' => $request->mother_name,
                    'mother_age' => $request->mother_age,
                    'mother_education' => $request->mother_education,
                    'mother_occupation' => $request->mother_occupation,
                    'student_photo' => $studentPhotoPath,
                    'payment_proof' => $paymentProofPath,
                    'start_date' => $request->start_date,
                    'day' => $indonesianDay,
                    'total_meetings' => $totalMeetings,
                    'need_socks' => $request->has('need_socks') ? true : false,
                    'status' => $status
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'main_service_type' => 'bimbel',
                    'data' => [
                        'id' => $bimbel->id,
                        'name' => $bimbel->name,
                        'age' => $bimbel->age,
                        'bimbel_type' => $bimbel->bimbel_type,
                        'service_type' => $bimbel->service_type,
                        'total_meetings' => $bimbel->total_meetings,
                        'need_socks' => $bimbel->need_socks,
                        'phone' => $bimbel->phone,
                        'start_date' => $bimbel->start_date,
                        'status' => $bimbel->status
                    ]
                ]);
            } elseif ($request->main_service_type === 'event') {
                // Validasi untuk form event
                $validator = Validator::make($request->all(), [
                    'event_id' => 'required|exists:events,id',
                    'parent_name' => 'required|string|max:255',
                    'address' => 'required|string',
                    'social_media' => 'required|string|max:255',
                    'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'source_info' => 'required|string|in:instagram,facebook,tiktok,teman,lainnya',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validasi gagal',
                        'errors' => $validator->errors()
                    ], 422);
                }

                // Upload bukti pembayaran
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

                // Simpan data event registration
                $eventRegistration = new \App\Models\EventRegistrationModel();
                $eventRegistration->event_id = $request->event_id;
                $eventRegistration->name = $request->name;
                $eventRegistration->age = $request->age;
                $eventRegistration->phone = $request->phone;
                $eventRegistration->parent_name = $request->parent_name;
                $eventRegistration->address = $request->address;
                $eventRegistration->social_media = $request->social_media;
                $eventRegistration->payment_proof = $paymentProofPath;
                $eventRegistration->source_info = $request->source_info;
                $eventRegistration->need_socks = $request->has('need_socks') ? 1 : 0;
                $eventRegistration->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'main_service_type' => 'event',
                    'data' => [
                        'id' => $eventRegistration->id,
                        'name' => $eventRegistration->name,
                        'age' => $eventRegistration->age,
                        'need_socks' => $eventRegistration->need_socks,
                        'phone' => $eventRegistration->phone
                    ]
                ]);
            } elseif ($request->main_service_type === 'stimulasi') {
                $validator = Validator::make($request->all(), [
                    // Field wajib yang sudah ada
                    'name' => 'required|string',
                    'age' => 'required|integer',
                    'phone' => 'required|string',
                    'need_socks' => 'nullable|boolean',
                    'child_order' => 'required|integer|min:1',
                    'gender' => 'required|in:L,P',
                    'birth_place' => 'required|string',
                    'birth_date' => 'required|date',
                    'religion' => 'required|string',
                    'address' => 'required|string',
                    'child_phone' => 'nullable|string',
                    'father_name' => 'required|string',
                    'father_age' => 'required|integer',
                    'father_education' => 'required|string',
                    'father_occupation' => 'required|string',
                    'mother_name' => 'required|string',
                    'mother_age' => 'required|integer',
                    'mother_education' => 'required|string',
                    'mother_occupation' => 'required|string',
                    'student_photo' => 'required|image|max:2048',
                    'payment_proof' => 'required|image|max:2048',
                    'height' => 'required|integer|min:1',
                    'weight' => 'required|integer|min:1',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validasi gagal',
                        'errors' => $validator->errors()
                    ], 422);
                }

                // Handle file uploads
                $studentPhotoPath = $request->file('student_photo')->store('student_photos', 'public');
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

                // Create stimulasi registration dengan semua field
                $stimulasi = StimulasiModel::create([
                    'name' => $request->name,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'need_socks' => $request->has('need_socks') ? true : false,
                    'child_order' => $request->child_order,
                    'gender' => $request->gender,
                    'birth_place' => $request->birth_place,
                    'birth_date' => $request->birth_date,
                    'religion' => $request->religion,
                    'address' => $request->address,
                    'child_phone' => $request->child_phone,
                    'father_name' => $request->father_name,
                    'father_age' => $request->father_age,
                    'father_education' => $request->father_education,
                    'father_occupation' => $request->father_occupation,
                    'mother_name' => $request->mother_name,
                    'mother_age' => $request->mother_age,
                    'mother_education' => $request->mother_education,
                    'mother_occupation' => $request->mother_occupation,
                    'student_photo' => $studentPhotoPath,
                    'payment_proof' => $paymentProofPath,
                    'status' => 'active',
                    'height' => $request->height,
                    'weight' => $request->weight,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'main_service_type' => 'stimulasi',
                    'data' => [
                        'id' => $stimulasi->id,
                        'name' => $stimulasi->name,
                        'age' => $stimulasi->age,
                        'gender' => $stimulasi->gender,
                        'phone' => $stimulasi->phone
                    ]
                ]);
            } elseif ($request->main_service_type === 'daycare') {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'age' => 'required|integer',
                    'phone' => 'required|string',
                    'height' => 'required|integer',
                    'weight' => 'required|integer',
                    'daycare_type' => 'required|in:bulanan,harian',
                    'gender' => 'required|in:L,P',
                    'birth_place' => 'required|string',
                    'birth_date' => 'required|date',
                    'address' => 'required|string',
                    'child_phone' => 'nullable|string',
                    'child_order' => 'required|integer',
                    'religion' => 'required|string',
                    'father_name' => 'required|string',
                    'father_age' => 'required|integer',
                    'father_education' => 'required|string',
                    'father_occupation' => 'required|string',
                    'mother_name' => 'required|string',
                    'mother_age' => 'required|integer',
                    'mother_education' => 'required|string',
                    'mother_occupation' => 'required|string',
                    'student_photo' => 'required|image|max:2048',
                    'payment_proof' => 'required|image|max:2048',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validasi gagal',
                        'errors' => $validator->errors()
                    ], 422);
                }

                // Handle file uploads
                $studentPhotoPath = $request->file('student_photo')->store('student_photos', 'public');
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

                // Create daycare registration
                $daycare = DaycareRegistrationModel::create([
                    'name' => $request->name,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'daycare_type' => $request->daycare_type,
                    'gender' => $request->gender,
                    'birth_place' => $request->birth_place,
                    'birth_date' => $request->birth_date,
                    'address' => $request->address,
                    'child_phone' => $request->child_phone,
                    'child_order' => $request->child_order,
                    'religion' => $request->religion,
                    'father_name' => $request->father_name,
                    'father_age' => $request->father_age,
                    'father_education' => $request->father_education,
                    'father_occupation' => $request->father_occupation,
                    'mother_name' => $request->mother_name,
                    'mother_age' => $request->mother_age,
                    'mother_education' => $request->mother_education,
                    'mother_occupation' => $request->mother_occupation,
                    'student_photo' => $studentPhotoPath,
                    'payment_proof' => $paymentProofPath,
                    'status' => 'active'
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'main_service_type' => 'daycare',
                    'data' => [
                        'id' => $daycare->id,
                        'name' => $daycare->name,
                        'age' => $daycare->age,
                        'daycare_type' => $daycare->daycare_type,
                        'phone' => $daycare->phone
                    ]
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in submit: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Tambahkan method baru untuk mendapatkan jumlah pertemuan
    public function getMeetingsCount(Request $request)
    {
        $serviceType = $request->service_type;
        if (isset(self::BIMBEL_MEETINGS[$serviceType])) {
            return response()->json([
                'success' => true,
                'total_meetings' => self::BIMBEL_MEETINGS[$serviceType]
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Tipe layanan tidak valid'
        ], 400);
    }

    private function validateFiles($request)
    {
        $maxSize = 2048; // 2MB
        $allowedTypes = ['jpeg', 'png', 'jpg'];

        $validator = Validator::make($request->all(), [
            'student_photo' => [
                'required',
                'image',
                'mimes:' . implode(',', $allowedTypes),
                'max:' . $maxSize
            ],
            'payment_proof' => [
                'required',
                'image',
                'mimes:' . implode(',', $allowedTypes),
                'max:' . $maxSize
            ]
        ]);

        return $validator;
    }

    public function welcome()
    {
        // Get all events tanpa filter status karena kolom status tidak ada
        $events = \App\Models\EventModel::all();

        return view('welcome', [
            'events' => $events
        ]);
    }

    public function submitPublic(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validasi data umum yang sama untuk semua layanan
            $validator = Validator::make($request->all(), [
                'main_service_type' => 'required|in:bermain,bimbel,stimulasi,daycare,event',
                'name' => 'required|string|max:255',
                'age' => 'required|numeric|min:1|max:15',
                'phone' => 'required|string|max:15',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Proses berdasarkan jenis layanan
            $service = $request->main_service_type;
            $result = false;

            switch ($service) {
                case 'bermain':
                    // Validasi untuk form bermain
                    $validator = Validator::make($request->all(), [
                        'duration' => 'required|in:1,2,3,6',
                        'day' => 'required|string',
                        'need_socks' => 'nullable',
                        'payment_proof' => 'required|image|max:2048',
                        'date' => 'required|date',
                        'selected_time' => 'required',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Validasi gagal',
                            'errors' => $validator->errors()
                        ], 422);
                    }

                    // Upload bukti pembayaran
                    $paymentProofPath = null;
                    if ($request->hasFile('payment_proof')) {
                        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
                    }

                    // Parse tanggal dan waktu
                    $startDateTime = Carbon::parse($request->date . ' ' . $request->selected_time);
                    $duration = intval($request->duration);
                    $endDateTime = $startDateTime->copy()->addHours($duration);

                    // Simpan data bermain
                    $bermain = new BermainModel();
                    $bermain->name = $request->name;
                    $bermain->age = $request->age;
                    $bermain->phone = $request->phone;
                    $bermain->day = $request->day;
                    $bermain->duration = $request->duration;
                    $bermain->need_socks = $request->has('need_socks') ? 1 : 0;
                    $bermain->payment_proof = $paymentProofPath;
                    $bermain->status = 'waiting'; // Status default
                    $bermain->remaining_time = $request->duration * 3600; // Konversi jam ke detik
                    $bermain->start_datetime = $startDateTime;
                    $bermain->end_datetime = $endDateTime;
                    $bermain->save();

                    $result = true;
                    break;

                case 'bimbel':
                    // Validasi untuk form bimbel
                    $validator = Validator::make($request->all(), [
                        'bimbel_type' => 'required|string',
                        'service_type' => 'required|string',
                        'start_date' => 'required|date',
                        'gender' => 'required|in:L,P',
                        'birth_place' => 'required|string',
                        'birth_date' => 'required|date',
                        'religion' => 'required|string',
                        'address' => 'required|string',
                        'child_order' => 'required|integer',
                        'child_phone' => 'nullable|string',
                        'father_name' => 'required|string',
                        'father_age' => 'required|integer',
                        'father_education' => 'required|string',
                        'father_occupation' => 'required|string',
                        'mother_name' => 'required|string',
                        'mother_age' => 'required|integer',
                        'mother_education' => 'required|string',
                        'mother_occupation' => 'required|string',
                        'student_photo' => 'required|image|max:2048',
                        'payment_proof' => 'required|image|max:2048',
                        'has_school_history' => 'nullable|boolean',
                        'need_socks' => 'nullable',
                        'school_name' => 'nullable|string',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Validasi gagal',
                            'errors' => $validator->errors()
                        ], 422);
                    }

                    // Upload foto siswa dan bukti pembayaran
                    $studentPhotoPath = null;
                    $paymentProofPath = null;

                    if ($request->hasFile('student_photo')) {
                        $studentPhotoPath = $request->file('student_photo')->store('student_photos', 'public');
                    }

                    if ($request->hasFile('payment_proof')) {
                        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
                    }

                    // Tentukan jumlah pertemuan berdasarkan jenis layanan
                    $totalMeetings = 8; // Tetapkan 8 untuk semua jenis bimbel

                    // Konversi tanggal ke format yang benar
                    $startDate = Carbon::parse($request->start_date);

                    // Dapatkan nama hari dalam bahasa Indonesia
                    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    $dayIndex = $startDate->dayOfWeek;
                    $indonesianDay = $dayNames[$dayIndex];

                    // Simpan data bimbel dengan semua field yang diperlukan
                    $bimbel = new BimbelModel();
                    $bimbel->name = $request->name;
                    $bimbel->age = $request->age;
                    $bimbel->phone = $request->phone;
                    $bimbel->bimbel_type = $request->bimbel_type;
                    $bimbel->service_type = $request->service_type;
                    $bimbel->gender = $request->gender;
                    $bimbel->birth_place = $request->birth_place;
                    $bimbel->birth_date = $request->birth_date;
                    $bimbel->religion = $request->religion;
                    $bimbel->address = $request->address;
                    $bimbel->child_order = $request->child_order;
                    $bimbel->child_phone = $request->child_phone;
                    $bimbel->father_name = $request->father_name;
                    $bimbel->father_age = $request->father_age;
                    $bimbel->father_education = $request->father_education;
                    $bimbel->father_occupation = $request->father_occupation;
                    $bimbel->mother_name = $request->mother_name;
                    $bimbel->mother_age = $request->mother_age;
                    $bimbel->mother_education = $request->mother_education;
                    $bimbel->mother_occupation = $request->mother_occupation;
                    $bimbel->has_school_history = $request->has('has_school_history') ? 1 : 0;
                    $bimbel->school_name = $request->school_name ?? '-';
                    $bimbel->student_photo = $studentPhotoPath;
                    $bimbel->payment_proof = $paymentProofPath;
                    $bimbel->start_date = $startDate;
                    $bimbel->day = $indonesianDay;
                    $bimbel->total_meetings = $totalMeetings;
                    $bimbel->need_socks = $request->has('need_socks') ? 1 : 0;
                    $bimbel->status = 'inactive'; // Ubah status menjadi 'inactive' alih-alih 'pending'
                    $bimbel->save();

                    $result = true;
                    break;

                case 'stimulasi':
                    // Validasi untuk form stimulasi
                    $validator = Validator::make($request->all(), [
                        'gender' => 'required|in:L,P',
                        'birth_place' => 'required|string',
                        'birth_date' => 'required|date',
                        'religion' => 'required|string',
                        'address' => 'required|string',
                        'child_order' => 'required|integer|min:1',
                        'child_phone' => 'nullable|string',
                        'father_name' => 'required|string',
                        'father_age' => 'required|integer',
                        'father_education' => 'required|string',
                        'father_occupation' => 'required|string',
                        'mother_name' => 'required|string',
                        'mother_age' => 'required|integer',
                        'mother_education' => 'required|string',
                        'mother_occupation' => 'required|string',
                        'height' => 'required|integer|min:1',
                        'weight' => 'required|integer|min:1',
                        'student_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                        'need_socks' => 'nullable',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Validasi gagal',
                            'errors' => $validator->errors()
                        ], 422);
                    }

                    // Handle file uploads
                    $studentPhotoPath = $request->file('student_photo')->store('student_photos', 'public');
                    $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

                    // Create stimulasi record
                    $stimulasi = new \App\Models\StimulasiModel();
                    $stimulasi->name = $request->name;
                    $stimulasi->age = $request->age;
                    $stimulasi->phone = $request->phone;
                    $stimulasi->gender = $request->gender;
                    $stimulasi->birth_place = $request->birth_place;
                    $stimulasi->birth_date = $request->birth_date;
                    $stimulasi->religion = $request->religion;
                    $stimulasi->address = $request->address;
                    $stimulasi->child_order = $request->child_order;
                    $stimulasi->child_phone = $request->child_phone;
                    $stimulasi->father_name = $request->father_name;
                    $stimulasi->father_age = $request->father_age;
                    $stimulasi->father_education = $request->father_education;
                    $stimulasi->father_occupation = $request->father_occupation;
                    $stimulasi->mother_name = $request->mother_name;
                    $stimulasi->mother_age = $request->mother_age;
                    $stimulasi->mother_education = $request->mother_education;
                    $stimulasi->mother_occupation = $request->mother_occupation;
                    $stimulasi->height = $request->height;
                    $stimulasi->weight = $request->weight;
                    $stimulasi->student_photo = $studentPhotoPath;
                    $stimulasi->payment_proof = $paymentProofPath;
                    $stimulasi->need_socks = $request->has('need_socks') ? 1 : 0;
                    $stimulasi->status = 'active'; // Sesuai dengan enum di database
                    $stimulasi->save();

                    $result = true;
                    break;

                case 'daycare':
                    // Validasi untuk form daycare
                    $validator = Validator::make($request->all(), [
                        'daycare_type' => 'required|in:bulanan,harian',
                        'gender' => 'required|in:L,P',
                        'birth_place' => 'required|string',
                        'birth_date' => 'required|date',
                        'religion' => 'required|string',
                        'address' => 'required|string',
                        'child_order' => 'required|integer|min:1',
                        'child_phone' => 'nullable|string',
                        'father_name' => 'required|string',
                        'father_age' => 'required|integer',
                        'father_education' => 'required|string',
                        'father_occupation' => 'required|string',
                        'mother_name' => 'required|string',
                        'mother_age' => 'required|integer',
                        'mother_education' => 'required|string',
                        'mother_occupation' => 'required|string',
                        'height' => 'required|integer|min:1',
                        'weight' => 'required|integer|min:1',
                        'student_photo' => 'required|image|max:2048',
                        'payment_proof' => 'required|image|max:2048',
                        'need_socks' => 'nullable',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Validasi gagal',
                            'errors' => $validator->errors()
                        ], 422);
                    }

                    // Upload foto siswa
                    $studentPhoto = $request->file('student_photo');
                    $studentPhotoPath = $studentPhoto->store('student_photos', 'public');

                    // Upload bukti pembayaran
                    $paymentProof = $request->file('payment_proof');
                    $paymentProofPath = $paymentProof->store('payment_proofs', 'public');

                    // Simpan data daycare
                    $daycare = new DaycareRegistrationModel();
                    $daycare->name = $request->name;
                    $daycare->age = $request->age;
                    $daycare->phone = $request->phone;
                    $daycare->daycare_type = $request->daycare_type;
                    $daycare->gender = $request->gender;
                    $daycare->birth_place = $request->birth_place;
                    $daycare->birth_date = $request->birth_date;
                    $daycare->religion = $request->religion;
                    $daycare->address = $request->address;
                    $daycare->child_order = $request->child_order;
                    $daycare->child_phone = $request->child_phone;
                    $daycare->father_name = $request->father_name;
                    $daycare->father_age = $request->father_age;
                    $daycare->father_education = $request->father_education;
                    $daycare->father_occupation = $request->father_occupation;
                    $daycare->mother_name = $request->mother_name;
                    $daycare->mother_age = $request->mother_age;
                    $daycare->mother_education = $request->mother_education;
                    $daycare->mother_occupation = $request->mother_occupation;
                    $daycare->height = $request->height;
                    $daycare->weight = $request->weight;
                    $daycare->student_photo = $studentPhotoPath;
                    $daycare->payment_proof = $paymentProofPath;
                    $daycare->need_socks = $request->has('need_socks') ? 1 : 0;
                    $daycare->status = 'active'; // Sesuai dengan enum di database
                    $daycare->save();

                    $result = true;
                    break;

                case 'event':
                    // Validasi untuk form event
                    $validator = Validator::make($request->all(), [
                        'event_id' => 'required|exists:events,id',
                        'parent_name' => 'required|string|max:255',
                        'address' => 'required|string',
                        'social_media' => 'required|string|max:255',
                        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                        'source_info' => 'required|string|in:instagram,facebook,tiktok,teman,lainnya',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Validasi gagal',
                            'errors' => $validator->errors()
                        ], 422);
                    }

                    // Upload bukti pembayaran
                    $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

                    // Simpan data event registration
                    $eventRegistration = new \App\Models\EventRegistrationModel();
                    $eventRegistration->event_id = $request->event_id;
                    $eventRegistration->name = $request->name;
                    $eventRegistration->age = $request->age;
                    $eventRegistration->phone = $request->phone;
                    $eventRegistration->parent_name = $request->parent_name;
                    $eventRegistration->address = $request->address;
                    $eventRegistration->social_media = $request->social_media;
                    $eventRegistration->payment_proof = $paymentProofPath;
                    $eventRegistration->source_info = $request->source_info;
                    $eventRegistration->need_socks = $request->has('need_socks') ? 1 : 0;
                    $eventRegistration->save();

                    $result = true;
                    break;
            }

            if ($result) {
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran berhasil',
                    'main_service_type' => $service
                ]);
            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Gagal menyimpan data']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in submitPublic: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function generateInvoiceData($mainServiceType, $data, $needSocks = false) {
        try {
            $invoiceData = [
                'service_info' => [
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'need_socks' => $needSocks
                ],
                'service_name' => '',
                'service_fee' => 0,
                'socks_fee' => $needSocks ? 15000 : 0, // Harga kaos kaki
                'total' => 0,
                'duration_info' => ''
            ];

            if ($mainServiceType === 'bermain') {
                // Hitung biaya berdasarkan durasi
                $serviceFee = self::BERMAIN_PRICES[$data['duration']] ?? 0;

                $invoiceData['service_name'] = 'Layanan Bermain';
                $invoiceData['service_fee'] = $serviceFee;
                $invoiceData['duration_info'] = "{$data['duration']} Jam";
                $invoiceData['total'] = $serviceFee + $invoiceData['socks_fee'];
            }

            return $invoiceData;
        } catch (\Exception $e) {
            Log::error('Error in generateInvoiceData: ' . $e->getMessage());
            throw $e;
        }
    }

    // Tambahkan method baru untuk generate invoice
    public function generateInvoice($id, $type)
    {
        try {
            // Ambil data berdasarkan tipe layanan
            $data = null;
            $invoiceData = null;

            if ($type === 'bermain') {
                $data = BermainModel::findOrFail($id);

                // Format data untuk invoice
                $invoiceData = [
                    'id' => $data->id,
                    'name' => $data->name,
                    'age' => $data->age,
                    'phone' => $data->phone,
                    'day' => $data->day,
                    'start_datetime' => $data->start_datetime,
                    'duration' => $data->duration,
                    'need_socks' => $data->need_socks,
                    'total_price' => self::BERMAIN_PRICES[$data->duration] + ($data->need_socks ? self::SOCKS_PRICE : 0)
                ];
            } elseif ($type === 'bimbel') {
                // Logika untuk bimbel
                $data = BimbelModel::findOrFail($id);
                // Format data untuk invoice bimbel
            } elseif ($type === 'stimulasi') {
                // Logika untuk stimulasi
                $data = StimulasiModel::findOrFail($id);
                // Format data untuk invoice stimulasi
            } elseif ($type === 'daycare') {
                // Logika untuk daycare
                $data = DaycareRegistrationModel::findOrFail($id);
                // Format data untuk invoice daycare
            } elseif ($type === 'event') {
                $data = \App\Models\EventRegistrationModel::with('event')->findOrFail($id);

                // Format data untuk invoice event
                $invoiceData = [
                    'id' => $data->id,
                    'name' => $data->name,
                    'age' => $data->age,
                    'phone' => $data->phone,
                    'parent_name' => $data->parent_name,
                    'address' => $data->address,
                    'social_media' => $data->social_media,
                    'event_name' => $data->event->name,
                    'event_date' => $data->event->date,
                    'event_time' => $data->event->time,
                    'event_location' => $data->event->location,
                    'event_price' => $data->event->price,
                    'need_socks' => $data->need_socks,
                    'total_price' => $data->event->price + ($data->need_socks ? self::SOCKS_PRICE : 0),
                    'source_info' => $data->source_info,
                    'created_at' => $data->created_at
                ];
            } else {
                return response()->json(['success' => false, 'message' => 'Tipe layanan tidak valid'], 400);
            }

            // Return data untuk digunakan oleh frontend
            return response()->json([
                'success' => true,
                'data' => $invoiceData,
                'type' => $type
            ]);

        } catch (\Exception $e) {
            Log::error('Error generating invoice: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Ambil daftar event yang tersedia untuk dropdown
     */
    public function getEvents()
    {
        try {
            Log::info('Fetching events data');

            // Coba ambil semua data tanpa filter dulu
            $events = \App\Models\EventModel::all();

            Log::info('Events fetched successfully', [
                'count' => $events->count(),
                'first_event' => $events->first()
            ]);

            return response()->json([
                'success' => true,
                'events' => $events
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching events: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data event: ' . $e->getMessage()
            ], 500);
        }
    }
}
