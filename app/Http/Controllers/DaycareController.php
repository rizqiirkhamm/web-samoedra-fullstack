<?php

namespace App\Http\Controllers;

use App\Models\DaycareRegistrationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DaycareController extends Controller
{
    public function index(Request $request)
    {
        // Check permission untuk akses Daycare
        $PermissionDaycare = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare');
        if (empty($PermissionDaycare)) {
            abort(404);
        }

        // Perbaiki nama variabel permission sesuai dengan yang digunakan di view
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Delete');
        $data['PermissionDetail'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Detail');

        $query = DaycareRegistrationModel::query();

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $searchQuery = $request->search;
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('father_name', 'like', "%{$searchQuery}%")
                    ->orWhere('mother_name', 'like', "%{$searchQuery}%");
            });
        }

        // Handle status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Get per page value
        $per_page = $request->query('per_page', 10);

        $data['daycares'] = $query->paginate($per_page)->appends($request->except('page'));
        $data['total_today'] = DaycareRegistrationModel::whereDate('created_at', today())->count();
        $data['total_active'] = DaycareRegistrationModel::where('status', 'active')->count();
        $data['total_all'] = DaycareRegistrationModel::count();
        $data['per_page'] = $per_page;

        return view('users.daycare', $data);
    }

    public function detail($id)
    {
        // Sementara bypass permission check untuk testing
        // $PermissionDetail = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Detail');
        // if(empty($PermissionDetail)){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorized access'
        //     ], 403);
        // }

        try {
            $daycare = DaycareRegistrationModel::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $daycare
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function destroy($id)
    {
        // Sementara bypass permission check untuk testing
        // $PermissionDelete = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Delete');
        // if(empty($PermissionDelete)){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorized access'
        //     ], 403);
        // }

        try {
            $daycare = DaycareRegistrationModel::findOrFail($id);
            $daycare->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data daycare berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data daycare: ' . $e->getMessage()
            ], 500);
        }
    }

    public function generateInvoice($id)
    {
        try {
            // Ambil data daycare
            $daycare = DaycareRegistrationModel::findOrFail($id);

            // Hitung harga berdasarkan jenis daycare
            $basePrice = 0;
            if ($daycare->daycare_type == 'bulanan') {
                $basePrice = 100000; // Harga bulanan
            } else {
                $basePrice = 110000; // Harga harian
            }

            // Hitung total harga (termasuk kaus kaki jika diperlukan)
            $socksPrice = $daycare->need_socks ? 5000 : 0;
            $totalPrice = $basePrice + $socksPrice;

            // Tambahkan informasi harga ke data
            $daycare->base_price = $basePrice;
            $daycare->socks_price = $socksPrice;
            $daycare->total_price = $totalPrice;

            // Tambahkan keterangan tipe daycare
            $daycare->daycare_type_text = $daycare->daycare_type == 'bulanan' ?
                'Penitipan Anak Bulanan' : 'Penitipan Anak Harian';

            // Tambahkan keterangan bahwa ini hanya biaya pendaftaran
            $daycare->registration_note = 'Catatan: Ini adalah biaya pendaftaran saja';



            return response()->json([
                'success' => true,
                'data' => $daycare
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data invoice: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export(Request $request)
    {
        try {
            // Ambil data daycare
            $query = DaycareRegistrationModel::query();

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
                ->setTitle('Data Daycare Samoedra')
                ->setSubject('Data Daycare')
                ->setDescription('Export data daycare Samoedra')
                ->setKeywords('daycare samoedra export')
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
            $sheet->setCellValue('A4', 'DATA DAYCARE SAMOEDRA');
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
                'No',
                'Nama',
                'Usia',
                'No. Telepon',
                'Jenis Daycare',
                'Tinggi (cm)',
                'Berat (gr)',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Agama',
                'Alamat',
                'Urutan Anak',
                'No. HP Anak',
                'Nama Ayah',
                'Usia Ayah',
                'Pendidikan Ayah',
                'Pekerjaan Ayah',
                'Nama Ibu',
                'Usia Ibu',
                'Pendidikan Ibu',
                'Pekerjaan Ibu',
                'Status',
                'Tanggal Mulai',
                'Bukti Pembayaran',
                'Foto Anak'
            ];

            $columnWidths = [
                5,
                30,
                10,
                15,
                20,
                15,
                15,
                15,
                20,
                20,
                15,
                40,
                15,
                15,
                30,
                15,
                20,
                20,
                30,
                15,
                20,
                20,
                15,
                20,
                40,
                40
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
                $sheet->setCellValue('E' . $row, $item->daycare_type === 'bulanan' ? 'Penitipan Bulanan' : 'Penitipan Harian');
                $sheet->setCellValue('F' . $row, $item->height);
                $sheet->setCellValue('G' . $row, $item->weight);
                $sheet->setCellValue('H' . $row, $item->gender === 'L' ? 'Laki-laki' : 'Perempuan');
                $sheet->setCellValue('I' . $row, $item->birth_place);
                $sheet->setCellValue('J' . $row, Carbon::parse($item->birth_date)->format('d M Y'));
                $sheet->setCellValue('K' . $row, ucfirst($item->religion));
                $sheet->setCellValue('L' . $row, $item->address);
                $sheet->setCellValue('M' . $row, 'Anak ke-' . $item->child_order);
                $sheet->setCellValue('N' . $row, $item->child_phone ?: '-');
                $sheet->setCellValue('O' . $row, $item->father_name);
                $sheet->setCellValue('P' . $row, $item->father_age . ' Tahun');
                $sheet->setCellValue('Q' . $row, $item->father_education);
                $sheet->setCellValue('R' . $row, $item->father_occupation);
                $sheet->setCellValue('S' . $row, $item->mother_name);
                $sheet->setCellValue('T' . $row, $item->mother_age . ' Tahun');
                $sheet->setCellValue('U' . $row, $item->mother_education);
                $sheet->setCellValue('V' . $row, $item->mother_occupation);
                $sheet->setCellValue('W' . $row, ucfirst($item->status));
                $sheet->setCellValue('X' . $row, Carbon::parse($item->created_at)->format('d M Y'));

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
                            $drawing->setCoordinates('Y' . $row);
                            $drawing->setWorksheet($sheet);
                        } catch (\Exception $e) {
                            $sheet->setCellValue('Y' . $row, 'Error loading image');
                        }
                    } else {
                        $sheet->setCellValue('Y' . $row, 'File not found');
                    }
                } else {
                    $sheet->setCellValue('Y' . $row, 'Tidak ada bukti');
                }

                // Tambahkan foto anak
                if ($item->student_photo) {
                    $photoPath = storage_path('app/public/' . $item->student_photo);
                    if (file_exists($photoPath)) {
                        try {
                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                            $drawing->setName('Photo_' . $key);
                            $drawing->setDescription('Foto Anak');
                            $drawing->setPath($photoPath);
                            $drawing->setHeight(50);
                            $drawing->setCoordinates('Z' . $row);
                            $drawing->setWorksheet($sheet);
                        } catch (\Exception $e) {
                            $sheet->setCellValue('Z' . $row, 'Error loading image');
                        }
                    } else {
                        $sheet->setCellValue('Z' . $row, 'File not found');
                    }
                } else {
                    $sheet->setCellValue('Z' . $row, 'Tidak ada foto');
                }

                // Apply status style
                if ($item->status === 'active') {
                    $sheet->getStyle('W' . $row)->applyFromArray($activeStyle);
                } else {
                    $sheet->getStyle('W' . $row)->applyFromArray($inactiveStyle);
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
            $fileName = 'Data_Daycare_Samoedra_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';

            // Set header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            // Redirect output ke client browser
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } catch (\Exception $e) {
            return redirect()->route('daycare.index')
                ->with('error', 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage());
        }
    }
}
