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

    // Tambahkan konstanta untuk harga
    private const BIMBEL_PRICE = 50000; // Rp 50.000 untuk semua jenis bimbel

    public function index()
    {
        // Check permission untuk akses Layanan
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Layanan');
        if(empty($PermissionRole)){
            abort(404);
        }

        // Get permissions untuk masing-masing layanan
        $data['PermissionBermain'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bermain');
        $data['PermissionBimbel'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel');

        // Get list layanan yang tersedia
        $data['getRecord'] = LayananModel::getRecord();

        return view('users.layanan', $data);
    }

    public function submit(Request $request)
    {
        try {
            // Log request data
            Log::info('Received request data:', [
                'main_service_type' => $request->main_service_type,
                'all_data' => $request->all()
            ]);

            // Validasi tipe layanan utama
            if (!in_array($request->main_service_type, ['bermain', 'bimbel'])) {
                throw new \Exception('Tipe layanan tidak valid');
            }

            if ($request->main_service_type === 'bimbel') {
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

                // Tambahkan data yang diperlukan untuk invoice
                return response()->json([
                    'success' => true,
                    'message' => 'Data bimbel berhasil disimpan',
                    'main_service_type' => 'bimbel',
                    'data' => array_merge($bimbel->toArray(), [
                        'id' => $bimbel->id,
                        'name' => $bimbel->name,
                        'bimbel_type' => $bimbel->bimbel_type,
                        'service_type' => $bimbel->service_type,
                        'total_meetings' => $bimbel->total_meetings,
                        'need_socks' => $bimbel->need_socks,
                        'phone' => $bimbel->phone,
                        'address' => $bimbel->address
                    ])
                ]);
            } elseif ($request->main_service_type === 'bermain') {
            // Handle file upload
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                    if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                        // Pastikan direktori storage/app/public/payment_proofs sudah ada
                        $path = $file->storeAs('payment_proofs', $filename, 'public');

                        if (!$path) {
                            throw new \Exception('Gagal menyimpan file');
                        }

                        // Konversi duration ke integer
                        $duration = intval($request->duration);

                        // Parse tanggal dan waktu
                        $startDateTime = Carbon::parse($request->date . ' ' . $request->selected_time);
                        // Gunakan duration yang sudah dikonversi ke integer
                        $endDateTime = $startDateTime->copy()->addHours($duration);

                        // Data untuk BermainModel
                        $bermainData = [
                            'name' => $request->name,
                            'age' => intval($request->age),
                            'phone' => $request->phone,
                            'duration' => $duration,
                            'start_datetime' => $startDateTime,
                            'end_datetime' => $endDateTime,
                            'day' => $request->day,
                            'status' => 'waiting',
                            'remaining_time' => $duration * 3600,
                            'payment_proof' => $filename,
                            'need_socks' => $request->has('need_socks') ? true : false
                        ];

                        // Debug log
                        Log::info('Data yang akan disimpan:', [
                            'data' => $bermainData,
                            'duration_type' => gettype($duration),
                            'start_datetime' => $startDateTime->format('Y-m-d H:i:s'),
                            'end_datetime' => $endDateTime->format('Y-m-d H:i:s')
                        ]);

                        // Simpan ke database
                        $bermain = BermainModel::create($bermainData);

                        if (!$bermain) {
                            throw new \Exception('Gagal menyimpan data ke database');
                        }

                        return response()->json([
                            'success' => true,
                            'message' => 'Data berhasil disimpan',
                            'main_service_type' => 'bermain',
                            'data' => [
                                'id' => $bermain->id,
                                'name' => $bermain->name,
                                'age' => $bermain->age,
                                'day' => $bermain->day,
                                'selected_time' => $bermain->start_datetime,
                                'duration' => $bermain->duration,
                                'need_socks' => $bermain->need_socks,
                                'phone' => $bermain->phone
                            ]
                        ]);
                    }
                }
            }

        } catch (\Exception $e) {
            Log::error('Error in layanan submit: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 422);
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
}
