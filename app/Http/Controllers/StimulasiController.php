<?php

namespace App\Http\Controllers;

use App\Models\PermissionRoleModel;
use App\Models\StimulasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class StimulasiController extends Controller
{
    public function index(Request $request) {
        // Check permission untuk akses Stimulasi
        $PermissionStimulasi = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Stimulasi');
        if(empty($PermissionStimulasi)){
            abort(404);
        }

        $query = StimulasiModel::query();
        $per_page = in_array($request->per_page, [3, 5, 7]) ? $request->per_page : 3;

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $searchQuery = $request->search;
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%");
            });
        }

        // Handle status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Jika request AJAX
        if ($request->ajax()) {
            $stimulasis = $query->orderBy('created_at', 'desc')->paginate($per_page);
            return response()->json([
                'success' => true,
                'html' => view('users.stimulasi-table', compact('stimulasis'))->render(),
                'pagination' => [
                    'current_page' => $stimulasis->currentPage(),
                    'last_page' => $stimulasis->lastPage(),
                    'total' => $stimulasis->total()
                ]
            ]);
        }

        // Regular request
        $data['total_today'] = StimulasiModel::whereDate('created_at', today())->count();
        $data['total_active'] = StimulasiModel::where('status', 'active')->count();
        $data['total_all'] = StimulasiModel::count();
        $data['stimulasis'] = $query->orderBy('created_at', 'desc')->paginate($per_page)->appends($request->except('page'));
        $data['per_page'] = $per_page;

        return view('users.stimulasi', $data);
    }

    public function detail($id){
        $stimulasi = StimulasiModel::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $stimulasi
        ]);
    }

    public function destroy($id){
        try {
            $stimulasi = StimulasiModel::findOrFail($id);
            $stimulasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data stimulasi berhasil dihapus'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data Stimulasi'
            ], 500);
        }
    }

    public function generateInvoice($id)
    {
        try {
            $stimulasi = StimulasiModel::findOrFail($id);

            // Hitung harga berdasarkan jenis stimulasi (contoh)
            $basePrice = 100000; // Default price

            // Pastikan harga tidak null
            if (!$stimulasi->price) {
                $stimulasi->price = $basePrice;
            }

            // Format data untuk invoice dengan detail lengkap
            $data = [
                'id' => $stimulasi->id,
                'name' => $stimulasi->name,
                'age' => $stimulasi->age,
                'father_name' => $stimulasi->father_name ?? '-',
                'mother_name' => $stimulasi->mother_name ?? '-',
                'address' => $stimulasi->address ?? '-',
                'phone' => $stimulasi->phone ?? '-',
                'stimulasi_type' => ucfirst($stimulasi->stimulasi_type),
                'day' => $stimulasi->day,
                'time' => $stimulasi->time,
                'price' => (int)$stimulasi->price, // Pastikan harga adalah integer
                'created_at' => $stimulasi->created_at->format('d M Y'),
                'status' => $stimulasi->status,
                'logo_path' => public_path('images/logo/logo_samoedra.JPG'),
            ];

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getData(Request $request)
    {
        $query = StimulasiModel::query();

        // Handle search
        if ($request->has('search')) {
            $searchQuery = $request->search;
            $query->where('name', 'like', "%{$searchQuery}%");
        }

        // Handle status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Get per page value
        $per_page = in_array($request->per_page, [3, 5, 7]) ? $request->per_page : 3;

        // Order by created_at
        $query->orderBy('created_at', 'desc');

        $stimulasis = $query->paginate($per_page);
        $PermissionDetail = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Stimulasi Detail');
        $PermissionDelete = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Stimulasi Delete');

        return response()->json([
            'success' => true,
            'data' => view('users.partials.stimulasi-table', compact('stimulasis', 'PermissionDetail', 'PermissionDelete'))->render(),
            'pagination' => view('users.partials.stimulasi-pagination', compact('stimulasis'))->render()
        ]);
    }

    public function export(Request $request)
    {
        try {
            // Ambil data stimulasi
            $query = StimulasiModel::query();

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
                ->setTitle('Data Stimulasi Samoedra')
                ->setSubject('Data Stimulasi')
                ->setDescription('Export data stimulasi Samoedra')
                ->setKeywords('stimulasi samoedra export')
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
            $sheet->setCellValue('A4', 'DATA STIMULASI SAMOEDRA');
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
                'No', 'Nama', 'Usia', 'Tinggi (cm)', 'Berat (gr)', 'Jenis Kelamin',
                'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'Alamat', 'Urutan Anak',
                'No. HP Anak', 'Nama Ayah', 'Usia Ayah', 'Pendidikan Ayah', 'Pekerjaan Ayah',
                'Nama Ibu', 'Usia Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu', 'Sekolah',
                'Hari', 'Total Pertemuan', 'Status', 'Tanggal Mulai', 'Foto Anak', 'Bukti Pembayaran'
            ];

            $columnWidths = [
                5, 30, 10, 15, 15, 15,
                20, 20, 15, 40, 15,
                15, 30, 15, 20, 20,
                30, 15, 20, 20, 30,
                15, 15, 15, 20, 40, 40
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
                $sheet->setCellValue('D' . $row, $item->height);
                $sheet->setCellValue('E' . $row, $item->weight);
                $sheet->setCellValue('F' . $row, $item->gender === 'L' ? 'Laki-laki' : 'Perempuan');
                $sheet->setCellValue('G' . $row, $item->birth_place);
                $sheet->setCellValue('H' . $row, Carbon::parse($item->birth_date)->format('d M Y'));
                $sheet->setCellValue('I' . $row, ucfirst($item->religion));
                $sheet->setCellValue('J' . $row, $item->address);
                $sheet->setCellValue('K' . $row, 'Anak ke-' . $item->child_order);
                $sheet->setCellValue('L' . $row, $item->child_phone ?: '-');
                $sheet->setCellValue('M' . $row, $item->father_name);
                $sheet->setCellValue('N' . $row, $item->father_age . ' Tahun');
                $sheet->setCellValue('O' . $row, $item->father_education);
                $sheet->setCellValue('P' . $row, $item->father_occupation);
                $sheet->setCellValue('Q' . $row, $item->mother_name);
                $sheet->setCellValue('R' . $row, $item->mother_age . ' Tahun');
                $sheet->setCellValue('S' . $row, $item->mother_education);
                $sheet->setCellValue('T' . $row, $item->mother_occupation);
                $sheet->setCellValue('U' . $row, $item->has_school_history ? $item->school_name : 'Belum Sekolah');
                $sheet->setCellValue('V' . $row, $item->day ?: 'Belum ditentukan');
                $sheet->setCellValue('W' . $row, '8 Pertemuan');
                $sheet->setCellValue('X' . $row, ucfirst($item->status));
                $sheet->setCellValue('Y' . $row, Carbon::parse($item->start_date)->format('d M Y'));

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

                // Tambahkan bukti pembayaran
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

                // Apply status style
                if ($item->status === 'active') {
                    $sheet->getStyle('X' . $row)->applyFromArray($activeStyle);
                } else {
                    $sheet->getStyle('X' . $row)->applyFromArray($inactiveStyle);
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
            $fileName = 'Data_Stimulasi_Samoedra_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';

            // Set header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            // Redirect output ke client browser
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;

        } catch (\Exception $e) {
            return redirect()->route('stimulasi.index')
                ->with('error', 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage());
        }
    }
}
