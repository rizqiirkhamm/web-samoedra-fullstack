<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\EventRegistrationModel;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        // Check Event permission
        $PermissionEvent = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event');
        if(empty($PermissionEvent)){
            abort(404);
        }

        $query = EventRegistrationModel::with('event');

        // Handle search
        if(request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('parent_name', 'like', "%{$search}%")
                  ->orWhereHas('event', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $registrations = $query->latest()->paginate(10);
        return view('users.event', compact('registrations'));
    }

    public function master()
    {
        // Check Event_master permission
        $PermissionEventMaster = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event_master');
        if(empty($PermissionEventMaster)){
            abort(404);
        }

        $query = EventModel::query();

        // Handle search
        if(request('search')) {
            $search = request('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $events = $query->latest()->paginate(10);
        return view('users.event-master', compact('events'));
    }

    public function storeMaster(Request $request)
    {
        // Check Event_master permission
        $PermissionEventMaster = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event_master');
        if(empty($PermissionEventMaster)){
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date'
        ]);

        EventModel::create($validated);

        return redirect()->route('event.master')->with('success', 'Event berhasil ditambahkan');
    }

    public function destroyMaster($id)
    {
        // Check Event_master permission
        $PermissionEventMaster = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event_master');
        if(empty($PermissionEventMaster)){
            abort(404);
        }

        $event = EventModel::findOrFail($id);
        $event->delete();

        return redirect()->route('event.master')->with('success', 'Event berhasil dihapus');
    }

    public function updateMaster(Request $request, $id)
    {
        // Check Event_master permission
        $PermissionEventMaster = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event_master');
        if(empty($PermissionEventMaster)){
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date'
        ]);

        $event = EventModel::findOrFail($id);
        $event->update($validated);

        return redirect()->route('event.master')->with('success', 'Event berhasil diperbarui');
    }

    public function register(Request $request)
    {
        // Check Event permission
        $PermissionEvent = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event');
        if(empty($PermissionEvent)){
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'need_socks' => 'nullable|boolean',
            'event_id' => 'required|exists:events,id',
            'parent_name' => 'required|string|max:255',
            'address' => 'required|string',
            'social_media' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'source_info' => 'required|string'
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('event_payments', 'public');
            $validated['payment_proof'] = $path;
        }

        // Set need_socks value
        $need_socks = $request->has('need_socks') ? true : false;

        $eventRegistration = EventRegistrationModel::create([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'need_socks' => $need_socks,
            'event_id' => $request->event_id,
            'parent_name' => $request->parent_name,
            'address' => $request->address,
            'social_media' => $request->social_media,
            'payment_proof' => $validated['payment_proof'],
            'source_info' => $request->source_info
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran event berhasil',
            'data' => $eventRegistration
        ]);
    }

    public function export(Request $request)
    {
        try {
            // Ambil data event registrations
            $query = EventRegistrationModel::with('event');

            // Filter berdasarkan search jika ada
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('parent_name', 'like', "%{$search}%")
                      ->orWhereHas('event', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
                });
            }

            $data = $query->orderBy('created_at', 'desc')->get();

            // Buat objek Spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set judul dokumen
            $spreadsheet->getProperties()
                ->setCreator('Samoedra Admin')
                ->setLastModifiedBy('Samoedra Admin')
                ->setTitle('Data Event Samoedra')
                ->setSubject('Data Event')
                ->setDescription('Export data event Samoedra')
                ->setKeywords('event samoedra export')
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
                    'startColor' => ['rgb' => '1E40AF'],
                    'endColor' => ['rgb' => '3B82F6'],
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
            $sheet->setCellValue('A4', 'DATA EVENT SAMOEDRA');
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
                'No', 'Event', 'Nama Orang Tua', 'Alamat', 'Social Media',
                'Sumber Info', 'Bukti Pembayaran', 'Tanggal Registrasi'
            ];

            $columnWidths = [5, 30, 30, 40, 20, 20, 40, 20];

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
                $sheet->setCellValue('B' . $row, $item->event->name);
                $sheet->setCellValue('C' . $row, $item->parent_name);
                $sheet->setCellValue('D' . $row, $item->address);
                $sheet->setCellValue('E' . $row, $item->social_media);
                $sheet->setCellValue('F' . $row, $item->source_info);

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
                            $drawing->setCoordinates('G' . $row);
                            $drawing->setWorksheet($sheet);
                        } catch (\Exception $e) {
                            $sheet->setCellValue('G' . $row, 'Error loading image');
                        }
                    } else {
                        $sheet->setCellValue('G' . $row, 'File not found');
                    }
                } else {
                    $sheet->setCellValue('G' . $row, 'Tidak ada bukti');
                }

                $sheet->setCellValue('H' . $row, Carbon::parse($item->created_at)->format('d M Y H:i'));

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
            $fileName = 'Data_Event_Samoedra_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';

            // Set header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            // Redirect output ke client browser
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;

        } catch (\Exception $e) {
            return redirect()->route('event.index')
                ->with('error', 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage());
        }
    }
}
