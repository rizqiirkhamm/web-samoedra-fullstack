@extends('users.layouts.app')

@section('title', 'Event Registrations')

@section('content')
<div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-bgray-200 pb-4">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-semibold text-bgray-800 dark:text-white">Daftar Registrasi Event</h2>
            <a href="{{ route('event.export', ['search' => request('search')]) }}"
               class="flex items-center gap-2 rounded-lg bg-success-300 px-4 py-2 text-white hover:bg-success-400 transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export Excel
            </a>
        </div>
        <!-- Search Bar -->
        <div class="flex items-center gap-3">
            <form action="{{ route('event.index') }}" method="GET" class="flex items-center gap-3">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama orang tua atau event..."
                       class="w-[250px] rounded-lg border border-bgray-300 p-2 dark:bg-darkblack-500 dark:border-darkblack-400">
                <button type="submit" class="flex items-center gap-2 rounded-lg bg-success-300 px-4 py-2 text-white hover:bg-success-400 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
            </form>
        </div>
    </div>

    <div class="mt-6">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-bgray-200 dark:border-darkblack-400">
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Event</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Nama Orang Tua</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Alamat</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Social Media</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Sumber Info</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Bukti Pembayaran</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Tanggal Registrasi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                    <tr class="border-b border-bgray-200 dark:border-darkblack-400 hover:bg-gray-50 dark:hover:bg-darkblack-500">
                        <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $registration->event->name }}</td>
                        <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $registration->parent_name }}</td>
                        <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $registration->address }}</td>
                        <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $registration->social_media }}</td>
                        <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $registration->source_info }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ Storage::url($registration->payment_proof) }}"
                               target="_blank"
                               class="inline-flex items-center text-success-300 hover:text-success-400 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Bukti
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">
                            {{ $registration->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            <button onclick="generateEventInvoice({{ json_encode($registration) }})"
                                    class="inline-flex items-center px-3 py-1 bg-success-300 text-white rounded-lg hover:bg-success-400 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Invoice
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $registrations->links() }}
    </div>
</div>
@endsection

@push('scripts')
<!-- Tambahkan CDN jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
function generateEventInvoice(data) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Definisikan warna
    const primaryColor = [41, 128, 185];   // Biru yang lebih soft
    const textColor = [75, 85, 99];        // Abu-abu gelap untuk teks
    const accentColor = [46, 204, 113];    // Hijau untuk status

    // Tambahkan watermark logo
    const addWatermark = () => {
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();
    };

    // Background putih
    doc.setFillColor(255, 255, 255);
    doc.rect(0, 0, 210, 297, 'F');

    // Tambahkan watermark
    addWatermark();

    // Header dengan garis biru
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, 35, 190, 35);

    // Logo dan Judul
    doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 20, 15, 25, 15);
    doc.setTextColor(...primaryColor);
    doc.setFontSize(24);
    doc.setFont('helvetica', 'bold');
    doc.text('INVOICE EVENT', 190, 25, { align: 'right' });

    // Informasi Invoice
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Kolom Kiri - Informasi Pelanggan
    doc.text('Ditagihkan Kepada:', 20, 50);
    doc.setFont('helvetica', 'bold');
    doc.text(data.parent_name, 20, 57);
    doc.setFont('helvetica', 'normal');
    doc.text(`Event: ${data.event.name}`, 20, 64);
    doc.text(`Tanggal: ${new Date(data.event.event_date).toLocaleDateString('id-ID')}`, 20, 71);
    doc.text(`Alamat: ${data.address}`, 20, 78);

    // Kolom Kanan - Informasi Invoice
    doc.text('No. Invoice:', 140, 50);
    doc.text('Tanggal:', 140, 57);
    doc.text('Status:', 140, 64);

    doc.setFont('helvetica', 'bold');
    doc.text(`EVT-${data.id}`, 190, 50, { align: 'right' });
    doc.text(new Date().toLocaleDateString('id-ID'), 190, 57, { align: 'right' });

    // Status LUNAS dengan warna hijau
    doc.setTextColor(...accentColor);
    doc.text('LUNAS', 190, 64, { align: 'right' });

    // Garis pemisah
    doc.setDrawColor(230, 230, 230);
    doc.setLineWidth(0.3);
    doc.line(20, 90, 190, 90);

    // Header Tabel
    doc.setFillColor(249, 250, 251);
    doc.rect(20, 95, 170, 10, 'F');

    doc.setTextColor(...textColor);
    doc.setFontSize(10);
    doc.setFont('helvetica', 'bold');
    doc.text('DESKRIPSI', 25, 101);
    doc.text('JUMLAH', 180, 101, { align: 'right' });

    // Isi Tabel
    let yPos = 115;
    doc.setFont('helvetica', 'normal');

    // Detail Event
    doc.text('Biaya Administrasi Event', 25, yPos);
    doc.text('Rp 20.000', 180, yPos, { align: 'right' });

    // Area Total
    yPos += 30;
    doc.setFillColor(249, 250, 251);
    doc.rect(20, yPos, 170, 25, 'F');

    // Garis tipis di atas total
    doc.setDrawColor(230, 230, 230);
    doc.line(20, yPos, 190, yPos);

    yPos += 16;

    // Total dengan style yang lebih bold
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(12);
    doc.text('TOTAL', 25, yPos);
    doc.text('Rp 20.000', 180, yPos, { align: 'right' });

    // Footer
    const footerY = 270;

    // Garis footer
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, footerY - 15, 190, footerY - 15);

    // Informasi kontak
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...textColor);
    doc.text('Little Star Kids - Samoedra', 105, footerY - 8, { align: 'center' });
    doc.text('Jl. Contoh No. 123, Kota, Indonesia', 105, footerY - 3, { align: 'center' });
    doc.text('Telp: (021) 1234567 | Email: info@samoedra.com', 105, footerY + 2, { align: 'center' });

    // Catatan
    doc.setFontSize(8);
    doc.setTextColor(...primaryColor);
    doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 10, { align: 'center' });

    // Simpan PDF dengan format nama yang rapi
    const formattedDate = new Date().toISOString().slice(0,10);
    doc.save(`Invoice-Event-${data.parent_name}-${formattedDate}.pdf`);
}
</script>
@endpush
