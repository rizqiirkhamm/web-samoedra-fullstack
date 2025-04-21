<?php

namespace App\Http\Controllers;

use App\Models\BimbelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BimbelController extends Controller
{
    public function index(Request $request)
    {
        // Check permission untuk akses Bimbel
        $PermissionBimbel = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel');
        if(empty($PermissionBimbel)){
            abort(404);
        }

        // Update status berdasarkan tanggal setiap kali halaman diakses
        BimbelModel::updateStatusBasedOnDate();

        // Perbaiki nama variabel permission sesuai dengan yang digunakan di view
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Delete');
        $data['PermissionDetail'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Detail');

        $perPage = $request->get('per_page', 3);
        $query = BimbelModel::query();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan search jika ada
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $data['total_active'] = BimbelModel::where('status', 'active')->count();
        $data['total_inactive'] = BimbelModel::where('status', 'inactive')->count();
        $data['total_today'] = BimbelModel::whereDate('created_at', today())->count();
        $data['total_all'] = BimbelModel::count();

        // Handle 'all' option for pagination
        if ($perPage === 'all') {
            $data['bimbels'] = $query->orderBy('created_at', 'desc')->get();
            // Convert collection to paginator
            $data['bimbels'] = new \Illuminate\Pagination\LengthAwarePaginator(
                $data['bimbels'],
                $data['bimbels']->count(),
                $data['bimbels']->count(),
                1
            );
        } else {
            $data['bimbels'] = $query->orderBy('created_at', 'desc')->paginate($perPage);
        }

        $data['per_page'] = $perPage;

        return view('users.bimbel', $data);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'age' => 'required|integer|min:1',
                'phone' => 'required|string|max:15',
                'bimbel_type' => 'required|in:online,offline',
                'service_type' => 'required',
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
                'total_meetings' => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        $expectedMeetings = $request->service_type === 'bimbel_coding' ? 4 : 8;
                        if ($value !== $expectedMeetings) {
                            $fail('Jumlah pertemuan tidak sesuai dengan jenis bimbel yang dipilih.');
                        }
                    },
                ],
                'need_socks' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Handle file uploads dengan pengecekan
            if (!$request->hasFile('student_photo') || !$request->hasFile('payment_proof')) {
                throw new \Exception('File foto siswa dan bukti pembayaran harus diupload');
            }

            $studentPhoto = $request->file('student_photo');
            $paymentProof = $request->file('payment_proof');

            if (!$studentPhoto->isValid() || !$paymentProof->isValid()) {
                throw new \Exception('File tidak valid');
            }

            $studentPhotoPath = $studentPhoto->store('student_photos', 'public');
            $paymentProofPath = $paymentProof->store('payment_proofs', 'public');

            // Get day from start_date
            $day = BimbelModel::getDayFromDate($request->start_date);

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
                'day' => $day,
                'total_meetings' => $request->total_meetings,
                'need_socks' => $request->has('need_socks') ? true : false,
                'status' => 'active'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data bimbel berhasil disimpan',
                'data' => $bimbel
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        try {
            // Ubah nama permission dari 'Bimbel_Detail' menjadi 'Bimbel Detail'
            $PermissionDetail = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Detail');
            if(empty($PermissionDetail)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            $bimbel = BimbelModel::findOrFail($id);

            // Hitung harga
            $basePrice = 50000;
            $socksPrice = $bimbel->need_socks ? 5000 : 0;
            $totalPrice = $basePrice + $socksPrice;

            // Format data untuk response
            $data = [
                'id' => $bimbel->id,
                'name' => $bimbel->name,
                'age' => $bimbel->age,
                'phone' => $bimbel->phone,
                'child_phone' => $bimbel->child_phone,
                'gender' => $bimbel->gender,
                'birth_place' => $bimbel->birth_place,
                'birth_date' => Carbon::parse($bimbel->birth_date)->format('d F Y'),
                'religion' => ucfirst($bimbel->religion),
                'address' => $bimbel->address,
                'child_order' => $bimbel->child_order,
                'father_name' => $bimbel->father_name,
                'father_age' => $bimbel->father_age,
                'father_education' => $bimbel->father_education,
                'father_occupation' => $bimbel->father_occupation,
                'mother_name' => $bimbel->mother_name,
                'mother_age' => $bimbel->mother_age,
                'mother_education' => $bimbel->mother_education,
                'mother_occupation' => $bimbel->mother_occupation,
                'bimbel_type' => ucfirst($bimbel->bimbel_type),
                'service_type' => ucfirst($bimbel->service_type),
                'day' => $bimbel->day,
                'total_meetings' => $bimbel->total_meetings,
                'status' => $bimbel->status,
                'need_socks' => $bimbel->need_socks,
                'student_photo_url' => Storage::url($bimbel->student_photo),
                'base_price' => $basePrice,
                'socks_price' => $socksPrice,
                'total_price' => $totalPrice
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Detail bimbel berhasil diambil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus($id, Request $request)
    {
        try {
            $bimbel = BimbelModel::findOrFail($id);
            $bimbel->status = $request->status;
            $bimbel->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status'
            ], 500);
        }
    }

    public function trackMeeting($id, Request $request)
    {
        try {
            $bimbel = BimbelModel::findOrFail($id);
            $currentMeeting = $request->meeting_number;

            // Simpan progress pertemuan
            // Implementasi sesuai kebutuhan

            return response()->json([
                'success' => true,
                'message' => 'Progress pertemuan berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan progress'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Check permission untuk delete
            $PermissionDelete = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Delete');
            if(empty($PermissionDelete)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            // Cari data bimbel
            $bimbel = BimbelModel::findOrFail($id);

            // Hapus file foto dan bukti pembayaran jika ada
            if ($bimbel->student_photo && Storage::disk('public')->exists($bimbel->student_photo)) {
                Storage::disk('public')->delete($bimbel->student_photo);
            }

            if ($bimbel->payment_proof && Storage::disk('public')->exists($bimbel->payment_proof)) {
                Storage::disk('public')->delete($bimbel->payment_proof);
            }

            // Hapus data dari database
            if ($bimbel->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data bimbel berhasil dihapus'
                ]);
            }

            throw new \Exception('Gagal menghapus data bimbel');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data bimbel tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data'
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 3);
            $query = $request->get('query', '');
            $status = $request->get('status', '');

            $results = BimbelModel::query();

            if (!empty($query)) {
                $results->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%')
                      ->orWhere('day', 'LIKE', '%' . $query . '%')
                      ->orWhere('service_type', 'LIKE', '%' . $query . '%');
                });
            }

            if (!empty($status)) {
                $results->where('status', $status);
            }

            // Handle 'all' option
            if ($perPage === 'all') {
                $data = $results->orderBy('created_at', 'desc')->get();
                $total = $data->count();

                // Map the data
                $formattedData = $data->map(function($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'age' => $item->age,
                        'day' => $item->day,
                        'bimbel_type' => $item->bimbel_type,
                        'service_type' => $item->service_type,
                        'total_meetings' => $item->total_meetings,
                        'status' => $item->status,
                        'need_socks' => $item->need_socks,
                        'payment_proof' => $item->payment_proof ? Storage::url($item->payment_proof) : null
                    ];
                });

                return response()->json([
                    'data' => $formattedData,
                    'current_page' => 1,
                    'last_page' => 1,
                    'per_page' => $total,
                    'total' => $total,
                    'canDetail' => Auth::user() && PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Detail'),
                    'canDelete' => Auth::user() && PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Delete')
                ]);
            }

            // Normal pagination
            $paginated = $results->orderBy('created_at', 'desc')->paginate($perPage);

            $formattedData = collect($paginated->items())->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'age' => $item->age,
                    'day' => $item->day,
                    'bimbel_type' => $item->bimbel_type,
                    'service_type' => $item->service_type,
                    'total_meetings' => $item->total_meetings,
                    'status' => $item->status,
                    'need_socks' => $item->need_socks,
                    'payment_proof' => $item->payment_proof ? Storage::url($item->payment_proof) : null
                ];
            });

            return response()->json([
                'data' => $formattedData,
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $perPage,
                'total' => $paginated->total(),
                'canDetail' => Auth::user() && PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Detail'),
                'canDelete' => Auth::user() && PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Delete')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => $request->get('per_page', 3),
                'total' => 0
            ], 500);
        }
    }

    public function export(Request $request)
    {
        try {
            // Ambil data bimbel
            $query = BimbelModel::query();

            // Filter berdasarkan status jika ada
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }

            // Filter berdasarkan search jika ada
            if ($request->has('search')) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            }

            $data = $query->orderBy('created_at', 'desc')->get();

            // Buat objek Spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set judul dokumen
            $spreadsheet->getProperties()
                ->setCreator('Samoedra Admin')
                ->setLastModifiedBy('Samoedra Admin')
                ->setTitle('Data Bimbel Samoedra')
                ->setSubject('Data Bimbel')
                ->setDescription('Export data bimbel Samoedra')
                ->setKeywords('bimbel samoedra export')
                ->setCategory('Data Export');

            // Style untuk header
            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12,
                    'name' => 'Arial',
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => ['rgb' => '1E40AF'], // Biru tua
                    'endColor' => ['rgb' => '3B82F6'],   // Biru muda
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];

            // Style untuk data
            $dataStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => [
                    'size' => 11,
                    'name' => 'Arial',
                ],
            ];

            // Style untuk status
            $activeStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D1E7DD']],
                'font' => ['bold' => true, 'color' => ['rgb' => '0F5132']],
            ];
            $inactiveStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E9ECEF']],
                'font' => ['bold' => true, 'color' => ['rgb' => '495057']],
            ];

            // Tambahkan logo
            $logoPath = public_path('images/logo/logo_samoedra.JPG');
            if (file_exists($logoPath)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo Samoedra');
                $drawing->setPath($logoPath);
                $drawing->setHeight(60);
                $drawing->setCoordinates('A1');
                $drawing->setWorksheet($sheet);

                // Geser konten ke bawah untuk memberi ruang logo
                $sheet->insertNewRowBefore(1, 3);
            }

            // Tambahkan judul
            $sheet->mergeCells('A4:H4');
            $sheet->setCellValue('A4', 'DATA BIMBEL SAMOEDRA');
            $sheet->getStyle('A4')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'name' => 'Arial',
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
            $sheet->getRowDimension(4)->setRowHeight(30);

            // Set header kolom dan ukuran kolom
            $headerRow = 5;
            $columns = [
                'No', 'Nama', 'Usia', 'No. Telepon', 'Jenis Bimbel', 'Tipe Layanan',
                'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'Alamat',
                'Urutan Anak', 'No. HP Anak', 'Nama Ayah', 'Usia Ayah', 'Pendidikan Ayah',
                'Pekerjaan Ayah', 'Nama Ibu', 'Usia Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu',
                'Sekolah', 'Hari', 'Total Pertemuan', 'Status', 'Tanggal Mulai', 'Bukti Pembayaran', 'Foto Siswa'
            ];

            $columnWidths = [
                5, 30, 10, 15, 20, 20,
                15, 20, 20, 15, 40,
                15, 15, 30, 15, 20,
                20, 30, 15, 20, 20,
                30, 15, 15, 15, 20, 40, 40
            ];

            foreach ($columns as $key => $column) {
                $cell = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key + 1) . $headerRow;
                $sheet->setCellValue($cell, $column);
                $sheet->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key + 1))->setWidth($columnWidths[$key]);
            }

            $lastColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($columns));
            $sheet->getStyle('A' . $headerRow . ':' . $lastColumn . $headerRow)->applyFromArray($headerStyle);
            $sheet->getRowDimension($headerRow)->setRowHeight(25);

            // Isi data
            $row = $headerRow + 1;
            foreach ($data as $key => $item) {
                $sheet->setCellValue('A' . $row, $key + 1);
                $sheet->setCellValue('B' . $row, $item->name);
                $sheet->setCellValue('C' . $row, $item->age . ' Tahun');
                $sheet->setCellValue('D' . $row, $item->phone);
                $sheet->setCellValue('E' . $row, ucfirst($item->bimbel_type));
                $sheet->setCellValue('F' . $row, ucfirst($item->service_type));
                $sheet->setCellValue('G' . $row, $item->gender === 'L' ? 'Laki-laki' : 'Perempuan');
                $sheet->setCellValue('H' . $row, $item->birth_place);
                $sheet->setCellValue('I' . $row, Carbon::parse($item->birth_date)->format('d M Y'));
                $sheet->setCellValue('J' . $row, ucfirst($item->religion));
                $sheet->setCellValue('K' . $row, $item->address);
                $sheet->setCellValue('L' . $row, 'Anak ke-' . $item->child_order);
                $sheet->setCellValue('M' . $row, $item->child_phone ?: '-');
                $sheet->setCellValue('N' . $row, $item->father_name);
                $sheet->setCellValue('O' . $row, $item->father_age . ' Tahun');
                $sheet->setCellValue('P' . $row, $item->father_education);
                $sheet->setCellValue('Q' . $row, $item->father_occupation);
                $sheet->setCellValue('R' . $row, $item->mother_name);
                $sheet->setCellValue('S' . $row, $item->mother_age . ' Tahun');
                $sheet->setCellValue('T' . $row, $item->mother_education);
                $sheet->setCellValue('U' . $row, $item->mother_occupation);
                $sheet->setCellValue('V' . $row, $item->has_school_history ? $item->school_name : 'Belum Sekolah');
                $sheet->setCellValue('W' . $row, $item->day);
                $sheet->setCellValue('X' . $row, $item->total_meetings . ' Kali');
                $sheet->setCellValue('Y' . $row, ucfirst($item->status));
                $sheet->setCellValue('Z' . $row, Carbon::parse($item->start_date)->format('d M Y'));

                // Tambahkan gambar bukti pembayaran
                if ($item->payment_proof) {
                    $paymentPath = storage_path('app/public/' . $item->payment_proof);
                    if (file_exists($paymentPath)) {
                        try {
                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                            $drawing->setName('Payment_' . $key);
                            $drawing->setDescription('Bukti Pembayaran');
                            $drawing->setPath($paymentPath);
                            $drawing->setHeight(50);
                            $drawing->setCoordinates('AA' . $row);
                            $drawing->setWorksheet($sheet);
                        } catch (\Exception $e) {
                            $sheet->setCellValue('AA' . $row, 'Error loading image');
                        }
                    } else {
                        $sheet->setCellValue('AA' . $row, 'File not found');
                    }
                } else {
                    $sheet->setCellValue('AA' . $row, 'Tidak ada bukti');
                }

                // Tambahkan foto siswa
                if ($item->student_photo) {
                    $photoPath = storage_path('app/public/' . $item->student_photo);
                    if (file_exists($photoPath)) {
                        try {
                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                            $drawing->setName('Photo_' . $key);
                            $drawing->setDescription('Foto Siswa');
                            $drawing->setPath($photoPath);
                            $drawing->setHeight(50);
                            $drawing->setCoordinates('AB' . $row);
                            $drawing->setWorksheet($sheet);
                        } catch (\Exception $e) {
                            $sheet->setCellValue('AB' . $row, 'Error loading image');
                        }
                    } else {
                        $sheet->setCellValue('AB' . $row, 'File not found');
                    }
                } else {
                    $sheet->setCellValue('AB' . $row, 'Tidak ada foto');
                }

                // Apply status style
                if ($item->status === 'active') {
                    $sheet->getStyle('Y' . $row)->applyFromArray($activeStyle);
                } else {
                    $sheet->getStyle('Y' . $row)->applyFromArray($inactiveStyle);
                }

                // Apply data style untuk seluruh baris
                $sheet->getStyle('A' . $row . ':' . $lastColumn . $row)->applyFromArray($dataStyle);
                $sheet->getRowDimension($row)->setRowHeight(50); // Tinggi baris disesuaikan dengan gambar

                $row++;
            }

            // Auto filter
            $sheet->setAutoFilter('A' . $headerRow . ':' . $lastColumn . ($row - 1));

            // Tambahkan footer dengan style
            $row += 2;
            $sheet->mergeCells('A' . $row . ':C' . $row);
            $sheet->setCellValue('A' . $row, 'Diekspor pada:');
            $sheet->mergeCells('D' . $row . ':E' . $row);
            $sheet->setCellValue('D' . $row, Carbon::now()->format('d M Y H:i:s'));

            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray([
                'font' => [
                    'italic' => true,
                    'size' => 10,
                    'color' => ['rgb' => '666666'],
                ],
            ]);

            // Protect sheet
            $sheet->getProtection()->setSheet(true);
            $sheet->getProtection()->setSort(true);
            $sheet->getProtection()->setInsertRows(true);
            $sheet->getProtection()->setFormatCells(true);

            // Set active sheet index to the first sheet
            $spreadsheet->setActiveSheetIndex(0);

            // Nama file Excel
            $fileName = 'Data_Bimbel_Samoedra_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';

            // Set header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            // Redirect output ke client browser
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;

        } catch (\Exception $e) {
            return redirect()->route('bimbel.index')
                ->with('error', 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage());
        }
    }
}
