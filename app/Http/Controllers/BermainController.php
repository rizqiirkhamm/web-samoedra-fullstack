<?php

namespace App\Http\Controllers;

use App\Models\BermainModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BermainController extends Controller
{
    public function index(Request $request)
    {
        // Check permission untuk akses Bermain
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bermain');
        if(empty($PermissionRole)){
            abort(404);
        }

        // Get permission untuk Delete
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Bermain');

        // Update semua status terlebih dahulu
        $this->updateAllStatus();

        $perPage = $request->get('per_page', 3); // Default 3 items per page
        $query = BermainModel::query();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan search jika ada
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('day', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('start_datetime', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Update data untuk tampilan
        $data['total_active'] = BermainModel::where('status', 'playing')->count();
        $data['total_today'] = BermainModel::whereDate('created_at', today())->count();
        $data['total_all'] = BermainModel::count();
        $data['bermain'] = $query->orderBy('start_datetime', 'desc')->paginate($perPage);
        $data['per_page'] = $perPage;

        return view('users.bermain', $data);
    }

    private function updateAllStatus()
    {
        try {
            $now = Carbon::now();
            Log::info('Updating all status at: ' . $now);

            // Update status waiting ke playing
            BermainModel::where('status', 'waiting')
                ->where('start_datetime', '<=', $now)
                ->where('end_datetime', '>', $now)
                ->each(function($bermain) use ($now) {
                    Log::info('Checking record:', [
                        'id' => $bermain->id,
                        'start' => $bermain->start_datetime,
                        'current' => $now,
                        'end' => $bermain->end_datetime
                    ]);

                    $startDateTime = Carbon::parse($bermain->start_datetime);
                    $endDateTime = Carbon::parse($bermain->end_datetime);

                    if ($now->between($startDateTime, $endDateTime)) {
                        $bermain->status = 'playing';
                        $bermain->remaining_time = $now->diffInSeconds($endDateTime);
                        $bermain->save();

                        Log::info('Updated to playing:', [
                            'id' => $bermain->id,
                            'remaining_time' => $bermain->remaining_time
                        ]);
                    }
                });

            // Update status playing ke finished
            BermainModel::where('status', 'playing')
                ->get()
                ->each(function($bermain) use ($now) {
                    $endDateTime = Carbon::parse($bermain->end_datetime);

                    if ($now->gte($endDateTime)) {
                        $bermain->status = 'finished';
                        $bermain->remaining_time = 0;
                        $bermain->save();

                        Log::info('Updated to finished:', [
                            'id' => $bermain->id
                        ]);
                    } else {
                        // Update remaining time untuk yang masih bermain
                        $bermain->remaining_time = $now->diffInSeconds($endDateTime);
                        $bermain->save();
                    }
                });

        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'selected_time' => 'required',
            'duration' => 'required|integer|between:1,3',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'date' => 'required|date',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/payment_proofs', $filename);
            $validated['payment_proof'] = $filename;
        }

        // Set status dan waktu
        $startDateTime = Carbon::parse($validated['date'] . ' ' . $validated['selected_time']);
        $endDateTime = $startDateTime->copy()->addHours($validated['duration']);

        $validated['status'] = 'waiting';
        $validated['start_datetime'] = $startDateTime;
        $validated['end_datetime'] = $endDateTime;
        $validated['remaining_time'] = $validated['duration'] * 3600;

        $bermain = BermainModel::create($validated);
        Log::info('New record created:', [
            'id' => $bermain->id,
            'start' => $bermain->start_datetime,
            'end' => $bermain->end_datetime
        ]);

        return redirect()->route('bermain.index')
            ->with('success', 'Reservasi berhasil dibuat!');
    }

    public function updateTimer($id)
    {
        try {
            $bermain = BermainModel::findOrFail($id);
            $now = Carbon::now();
            $startDateTime = Carbon::parse($bermain->start_datetime);
            $endDateTime = Carbon::parse($bermain->end_datetime);

            Log::info('Updating timer for ID: ' . $id, [
                'current_time' => $now,
                'start_time' => $startDateTime,
                'end_time' => $endDateTime,
                'current_status' => $bermain->status
            ]);

            if ($bermain->status === 'waiting' && $now->gte($startDateTime)) {
                $bermain->status = 'playing';
                $bermain->remaining_time = (int) $now->diffInSeconds($endDateTime);
                $bermain->save();

                return response()->json([
                    'status' => 'playing',
                    'remaining_time' => (int) $bermain->remaining_time
                ]);
            }

            if ($bermain->status === 'playing') {
                if ($now->gte($endDateTime)) {
                    $bermain->status = 'finished';
                    $bermain->remaining_time = 0;
                    $bermain->save();

                    return response()->json([
                        'status' => 'finished',
                        'remaining_time' => 0
                    ]);
                }

                $bermain->remaining_time = $now->diffInSeconds($endDateTime);
                $bermain->save();

                return response()->json([
                    'status' => 'playing',
                    'remaining_time' => $bermain->remaining_time
                ]);
            }

            return response()->json([
                'status' => $bermain->status,
                'remaining_time' => $bermain->remaining_time
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating timer: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        // Check permission untuk Delete Bermain
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Bermain');
        if(empty($PermissionRole)){
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $bermain = BermainModel::findOrFail($id);
        $bermain->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function search(Request $request)
    {
        $this->updateAllStatus();

        $query = $request->get('query');
        $perPage = $request->get('per_page', 3);
        $status = $request->get('status', 'all');
        $page = $request->get('page', 1);

        $results = BermainModel::where(function($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
              ->orWhere('day', 'LIKE', '%' . $query . '%')
              ->orWhere('start_datetime', 'LIKE', '%' . $query . '%');
        });

        if ($status !== 'all') {
            $results->where('status', $status);
        }

        $results = $results->orderBy('start_datetime', 'desc');

        // Jika per_page adalah 'all', ambil semua data tanpa pagination
        if ($perPage === 'all') {
            $data = $results->get();
            $total = $data->count();

            $formattedData = $data->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'age' => $item->age,
                    'day' => $item->day,
                    'start_datetime' => Carbon::parse($item->start_datetime)->format('Y-m-d H:i:s'),
                    'end_datetime' => Carbon::parse($item->end_datetime)->format('Y-m-d H:i:s'),
                    'status' => $item->status,
                    'duration' => $item->duration,
                    'remaining_time' => $item->remaining_time,
                    'need_socks' => $item->need_socks,
                    'payment_proof' => $item->payment_proof ? asset('storage/payment_proofs/' . str_replace('payment_proofs/', '', $item->payment_proof)) : null
                ];
            });

            return response()->json([
                'data' => $formattedData,
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => $total,
                'total' => $total
            ]);
        }

        // Jika per_page bukan 'all', gunakan pagination seperti biasa
        $paginated = $results->paginate($perPage, ['*'], 'page', $page);

        $formattedData = collect($paginated->items())->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'age' => $item->age,
                'day' => $item->day,
                'start_datetime' => Carbon::parse($item->start_datetime)->format('Y-m-d H:i:s'),
                'end_datetime' => Carbon::parse($item->end_datetime)->format('Y-m-d H:i:s'),
                'status' => $item->status,
                'duration' => $item->duration,
                'remaining_time' => $item->remaining_time,
                'need_socks' => $item->need_socks,
                'payment_proof' => $item->payment_proof ? asset('storage/payment_proofs/' . str_replace('payment_proofs/', '', $item->payment_proof)) : null
            ];
        });

        return response()->json([
            'data' => $formattedData,
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'per_page' => (int)$perPage,
            'total' => $paginated->total()
        ]);
    }

    public function export(Request $request)
    {
        try {
            // Update semua status terlebih dahulu
            $this->updateAllStatus();

            // Ambil data bermain
            $query = BermainModel::query();

            // Filter berdasarkan status jika ada
            if ($request->has('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Filter berdasarkan search jika ada
            if ($request->has('search')) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('day', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('start_datetime', 'LIKE', '%' . $request->search . '%');
                });
            }

            $data = $query->orderBy('start_datetime', 'desc')->get();

            // Buat objek Spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set judul dokumen
            $spreadsheet->getProperties()
                ->setCreator('Samoedra Admin')
                ->setLastModifiedBy('Samoedra Admin')
                ->setTitle('Data Bermain Samoedra')
                ->setSubject('Data Bermain')
                ->setDescription('Export data bermain Samoedra')
                ->setKeywords('bermain samoedra export')
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
            $waitingStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFF3CD']],
                'font' => ['bold' => true, 'color' => ['rgb' => '856404']],
            ];
            $playingStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D1E7DD']],
                'font' => ['bold' => true, 'color' => ['rgb' => '0F5132']],
            ];
            $finishedStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E9ECEF']],
                'font' => ['bold' => true, 'color' => ['rgb' => '495057']],
            ];

            // Tambahkan logo Samoedra
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
            $sheet->mergeCells('A4:J4');
            $sheet->setCellValue('A4', 'DATA BERMAIN SAMOEDRA');
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

            // Set header kolom dan ukuran kolom (pindah ke baris 5)
            $headerRow = 5;
            $columns = ['No', 'Nama', 'Usia', 'Hari', 'Tanggal', 'Waktu', 'Durasi', 'Status', 'Nomor Telepon', 'Bukti Pembayaran'];
            $columnWidths = [5, 30, 10, 15, 20, 15, 10, 15, 20, 40];

            foreach ($columns as $key => $column) {
                $cell = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key + 1) . $headerRow;
                $sheet->setCellValue($cell, $column);
                $sheet->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key + 1))->setWidth($columnWidths[$key]);
            }

            $sheet->getStyle('A' . $headerRow . ':J' . $headerRow)->applyFromArray($headerStyle);
            $sheet->getRowDimension($headerRow)->setRowHeight(25);

            // Isi data (mulai dari baris 6)
            $row = $headerRow + 1;
            foreach ($data as $key => $item) {
                $startDateTime = Carbon::parse($item->start_datetime);

                $sheet->setCellValue('A' . $row, $key + 1);
                $sheet->setCellValue('B' . $row, $item->name);
                $sheet->setCellValue('C' . $row, $item->age . ' Tahun');
                $sheet->setCellValue('D' . $row, $item->day);
                $sheet->setCellValue('E' . $row, $startDateTime->format('d M Y'));
                $sheet->setCellValue('F' . $row, $startDateTime->format('H:i'));
                $sheet->setCellValue('G' . $row, $item->duration . ' Jam');

                // Format status dengan style yang lebih menarik
                $statusText = '';
                switch($item->status) {
                    case 'waiting':
                        $statusText = 'Menunggu';
                        $sheet->getStyle('H' . $row)->applyFromArray($waitingStyle);
                        break;
                    case 'playing':
                        $statusText = 'Bermain';
                        $sheet->getStyle('H' . $row)->applyFromArray($playingStyle);
                        break;
                    case 'finished':
                        $statusText = 'Selesai';
                        $sheet->getStyle('H' . $row)->applyFromArray($finishedStyle);
                        break;
                }
                $sheet->setCellValue('H' . $row, $statusText);
                $sheet->getStyle('H' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue('I' . $row, $item->phone);

                // Tambahkan gambar bukti pembayaran jika ada
                if ($item->payment_proof) {
                    $imagePath = storage_path('app/public/payment_proofs/' . str_replace('payment_proofs/', '', $item->payment_proof));
                    if (file_exists($imagePath)) {
                        try {
                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                            $drawing->setName('Bukti_' . $key);
                            $drawing->setDescription('Bukti Pembayaran');
                            $drawing->setPath($imagePath);
                            $drawing->setHeight(50);
                            $drawing->setCoordinates('J' . $row);
                            $drawing->setWorksheet($sheet);
                            $sheet->getRowDimension($row)->setRowHeight(50);
                        } catch (\Exception $e) {
                            $sheet->setCellValue('J' . $row, 'Error loading image');
                        }
                    } else {
                        $sheet->setCellValue('J' . $row, 'File not found');
                    }
                } else {
                    $sheet->setCellValue('J' . $row, 'Tidak ada bukti');
                }

                // Apply style untuk baris data
                $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray($dataStyle);
                if (!$item->payment_proof) {
                    $sheet->getRowDimension($row)->setRowHeight(20);
                }

                $row++;
            }

            // Auto filter
            $sheet->setAutoFilter('A' . $headerRow . ':J' . ($row - 1));

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
            $fileName = 'Data_Bermain_Samoedra_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';

            // Set header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            // Redirect output ke client browser
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;

        } catch (\Exception $e) {
            Log::error('Error exporting data: ' . $e->getMessage());
            return redirect()->route('bermain.index')
                ->with('error', 'Terjadi kesalahan saat mengekspor data. ' . $e->getMessage());
        }
    }
}
