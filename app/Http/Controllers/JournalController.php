<?php

namespace App\Http\Controllers;

use App\Models\JournalModel;
use App\Models\BimbelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Check permission untuk akses Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Journal');
            if(empty($PermissionRole)){
                abort(404);
            }

            // Get permission untuk Add, Edit dan Delete
            $data['PermissionAdd'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add Journal');
            $data['PermissionEdit'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Journal');
            $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Journal');

            $perPage = $request->get('per_page', 5);
            $query = JournalModel::with('bimbel');

            // Filter berdasarkan search
            if ($request->has('search') && $request->search !== '') {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('nama_guru', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('pelajaran', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('pembahasan', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhereHas('bimbel', function($q) use ($searchTerm) {
                          $q->where('name', 'LIKE', '%' . $searchTerm . '%');
                      });
                });
            }

            // Filter berdasarkan parameter individual
            if ($request->tanggal) {
                $query->whereDate('tanggal', $request->tanggal);
            }
            if ($request->nama_guru) {
                $query->where('nama_guru', 'LIKE', '%' . $request->nama_guru . '%');
            }
            if ($request->bimbel_id) {
                $query->where('bimbel_id', $request->bimbel_id);
            }
            if ($request->pelajaran) {
                $query->where('pelajaran', 'LIKE', '%' . $request->pelajaran . '%');
            }
            if ($request->pertemuan_ke) {
                $query->where('pertemuan_ke', $request->pertemuan_ke);
            }

            $data['journals'] = $query->orderBy('tanggal', 'desc')->paginate($perPage);
            $data['bimbels'] = BimbelModel::where('status', 'active')->get();
            $data['per_page'] = $perPage;

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'data' => $data['journals'],
                    'bimbels' => $data['bimbels'],
                    'pagination' => [
                        'current_page' => $data['journals']->currentPage(),
                        'last_page' => $data['journals']->lastPage(),
                        'per_page' => $perPage,
                        'total' => $data['journals']->total()
                    ]
                ]);
            }

            return view('users.journal', $data);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memuat data: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Check permission untuk Add Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add Journal');
            if(empty($PermissionRole)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Validasi input
            $validated = $request->validate([
                'bimbel_id' => 'required|exists:bimbel,id',
                'tanggal' => 'required|date',
                'nama_guru' => 'required|string|max:255',
                'pelajaran' => 'required|string|max:255',
                'pembahasan' => 'required|string',
                'pertemuan_ke' => 'required|integer|min:1',
                'periode_ke' => 'required|integer|min:1'

            ]);

            // Tambahkan created_by ke data yang divalidasi
            $validated['created_by'] = Auth::user()->name;

            // Membuat record baru
            $journal = JournalModel::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Journal berhasil ditambahkan',
                    'data' => $journal
                ]);
            }

            return redirect()->route('journal.index')
                ->with('success', 'Journal berhasil ditambahkan');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan journal: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan journal: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Check permission untuk Edit Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Journal');
            if(empty($PermissionRole)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $journal = JournalModel::findOrFail($id);

            // Update data
            $journal->tanggal = $request->tanggal;
            $journal->nama_guru = $request->nama_guru;
            $journal->bimbel_id = $request->bimbel_id;
            $journal->pelajaran = $request->pelajaran;
            $journal->pembahasan = $request->pembahasan;
            $journal->pertemuan_ke = $request->pertemuan_ke;
            $journal->periode_ke = $request->periode_ke;
            $journal->save();

            return response()->json([
                'success' => true,
                'message' => 'Journal berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate journal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Check permission untuk Delete Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Journal');
            if(empty($PermissionRole)){
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $journal = JournalModel::findOrFail($id);
            $journal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Journal berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus journal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $journal = JournalModel::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $journal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data journal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export(Request $request)
    {
        try {
            $query = JournalModel::with('bimbel');

            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_guru', 'like', '%' . $search . '%')
                      ->orWhere('pelajaran', 'like', '%' . $search . '%')
                      ->orWhere('pembahasan', 'like', '%' . $search . '%')
                      ->orWhereHas('bimbel', function($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%');
                      });
                });
            }

            $data = $query->orderBy('tanggal', 'desc')->get();

            // Check if data exists
            if ($data->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada data journal yang dapat diekspor'
                ], 404);
            }

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set document properties
            $spreadsheet->getProperties()
                ->setCreator('Samoedra')
                ->setTitle('Data Journal')
                ->setSubject('Export Data Journal')
                ->setDescription('Data Journal yang diekspor dari sistem');

            // Add logo if exists
            $logoPath = public_path('images/logo/logo_samoedra.JPG');
            if (file_exists($logoPath)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo');
                $drawing->setPath($logoPath);
                $drawing->setHeight(50);
                $drawing->setCoordinates('A1');
                $drawing->setWorksheet($sheet);
            }

            // Set title
            $sheet->setCellValue('A2', 'DATA JOURNAL BIMBEL SAMOEDRA');
            $sheet->mergeCells('A2:H2');
            $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Set headers
            $headers = ['No', 'Tanggal', 'Nama Guru', 'Nama Siswa', 'Pelajaran', 'Pembahasan', 'Periode Ke-', 'Pertemuan Ke-', 'Created By'];
            $sheet->fromArray($headers, null, 'A4');

            // Style for headers
            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => ['rgb' => '0B5ED7'],
                    'endColor' => ['rgb' => '0A58CA']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                ]
            ];
            $sheet->getStyle('A4:I4')->applyFromArray($headerStyle);

            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(25);
            $sheet->getColumnDimension('E')->setWidth(25);
            $sheet->getColumnDimension('F')->setWidth(40);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(15);
            $sheet->getColumnDimension('I')->setWidth(25);

            // Fill data
            $row = 5;
            foreach ($data as $index => $item) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, Carbon::parse($item->tanggal)->format('d M Y'));
                $sheet->setCellValue('C' . $row, $item->nama_guru);
                $sheet->setCellValue('D' . $row, $item->bimbel ? $item->bimbel->name : '-');
                $sheet->setCellValue('E' . $row, $item->pelajaran);
                $sheet->setCellValue('F' . $row, $item->pembahasan);
                $sheet->setCellValue('G' . $row, $item->periode_ke);
                $sheet->setCellValue('H' . $row, $item->pertemuan_ke);
                $sheet->setCellValue('I' . $row, $item->created_by);

                // Style for data rows
                $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                        'vertical' => Alignment::VERTICAL_TOP
                    ]
                ]);

                // Wrap text for pembahasan
                $sheet->getStyle('F' . $row)->getAlignment()->setWrapText(true);

                $row++;
            }

            // Auto filter
            $sheet->setAutoFilter('A4:I' . ($row - 1));

            // Add footer
            $footerRow = $row + 1;
            $sheet->setCellValue('A' . $footerRow, 'Dicetak pada: ' . Carbon::now()->format('d M Y H:i:s'));
            $sheet->mergeCells('A' . $footerRow . ':I' . $footerRow);
            $sheet->getStyle('A' . $footerRow)->getFont()->setItalic(true);
            $sheet->getStyle('A' . $footerRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

            // Protect sheet
            $sheet->getProtection()->setSheet(true);
            $sheet->getProtection()->setPassword('samoedra');

            // Set active sheet
            $spreadsheet->setActiveSheetIndex(0);

            // Generate file
            $writer = new Xlsx($spreadsheet);
            $filename = 'journal_export_' . Carbon::now()->format('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengekspor data: ' . $e->getMessage()
            ], 500);
        }
    }
}
