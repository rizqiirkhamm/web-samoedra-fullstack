@extends('users.layouts.app')

@section('title', 'Daycare')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="2xl:flex 2xl:space-x-[48px]">
    <section class="mb-6 2xl:mb-0 2xl:flex-1">
        <!-- total widget-->
        <div class="mb-[24px] w-full">
            <div class="grid grid-cols-1 gap-[24px] lg:grid-cols-3">
                <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                    <div class="mb-5 flex items-center justify-between">
                        <div class="flex items-center space-x-[7px]">
                            <div class="icon">
                                <span>
                                    <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                </span>
                            </div>
                            <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total Hari ini</span>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <div class="flex-1">
                            <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                {{ $total_today }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                    <div class="mb-5 flex items-center justify-between">
                        <div class="flex items-center space-x-[7px]">
                            <div class="icon">
                                <span>
                                    <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                </span>
                            </div>
                            <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total Daycare Aktif</span>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <div class="flex-1">
                            <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                {{ $total_active }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                    <div class="mb-5 flex items-center justify-between">
                        <div class="flex items-center space-x-[7px]">
                            <div class="icon">
                                <span>
                                    <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                </span>
                            </div>
                            <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total Keseluruhan</span>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <div class="flex-1">
                            <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                {{ $total_all }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative w-[230px]">
                    <input type="text" id="searchInput"
                           class="h-[44px] w-full rounded-lg border border-bgray-300 pl-14 pr-4 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white"
                           placeholder="Search"
                           value="{{ request('search') }}">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#7F8995" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19 19L14.65 14.65" stroke="#7F8995" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div>
                    <select id="statusFilter"
                            class="h-[44px] rounded-lg border border-bgray-300 pl-4 pr-10 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div>
                <a href="{{ route('daycare.export') }}?{{ http_build_query(request()->query()) }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-success-300 py-3 px-4 font-medium text-white hover:bg-success-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
            <div class="flex flex-col space-y-5">
                <div id="tableContainer" class="table-content w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Nama</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Usia</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Tinggi (cm)</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Berat (kg)</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Jenis Daycare</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Status</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Bukti Pembayaran</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="daycareTableBody">
                            @forelse($daycares as $daycare)
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-base font-medium text-bgray-900 dark:text-white">
                                                {{ $daycare->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $daycare->age }} tahun
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $daycare->height }} cm
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $daycare->weight }} gr
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $daycare->daycare_type === 'bulanan' ? 'Penitipan Bulanan' : 'Penitipan Harian' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-block px-3 py-1 rounded-full text-sm
                                            {{ $daycare->status === 'active' ? 'bg-success-50 text-success-300' : 'bg-warning-50 text-warning-300' }}">
                                            {{ ucfirst($daycare->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($daycare->payment_proof)
                                            <a href="{{ asset('storage/' . $daycare->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 text-success-300 hover:text-success-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-bgray-500 dark:text-bgray-300">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex gap-2">
                                            <button onclick="showDetail({{ $daycare->id }})"
                                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                                Detail
                                            </button>
                                            <button onclick="confirmDelete({{ $daycare->id }})"
                                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-5 text-center">
                                        <span class="text-base text-bgray-500 dark:text-white">Tidak ada data</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-content w-full">
                    <div class="flex w-full items-center justify-center lg:justify-between">
                        <div class="hidden items-center space-x-4 lg:flex">
                            <span class="text-sm font-semibold text-bgray-600 dark:text-bgray-50">Menampilkan</span>
                            <div class="relative">
                                <select id="perPageSelect"
                                        class="rounded-lg border border-bgray-300 px-4 py-2 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                                    <option value="10" {{ $per_page == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ $per_page == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ $per_page == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>
                            <span class="text-sm font-semibold text-bgray-600 dark:text-bgray-50">dari {{ $daycares->total() }} data</span>
                        </div>
                        {{ $daycares->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Modal content will be injected here by JavaScript -->
</div>

<!-- Modal Konfirmasi Delete -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Modal content will be injected here by JavaScript -->
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
// Fungsi untuk menampilkan detail daycare
function showDetail(id) {
    const detailModal = document.getElementById('detailModal');
    detailModal.classList.remove('hidden');

    // Loading state
    detailModal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow-lg max-w-4xl w-full relative">
                <div class="p-6 text-center">
                    <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-success-300 mb-4"></div>
                    <p class="text-lg text-bgray-600 dark:text-white">Memuat detail...</p>
                </div>
            </div>
        </div>
    `;

    // Tambahkan CSRF token ke header
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Fetch data dengan headers yang tepat
    fetch(`/daycare/detail/${id}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin' // Penting untuk mengirim cookies session
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Terjadi kesalahan pada server');
            });
        }
        return response.json();
    })
    .then(response => {
        if (!response.success) {
            throw new Error(response.message || 'Gagal memuat data');
        }
        renderDetailModal(response.data);
    })
    .catch(error => {
        detailModal.innerHTML = `
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow-lg max-w-md w-full relative">
                    <div class="p-6 text-center">
                        <div class="mb-4 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-bgray-900 dark:text-white mb-2">Error</h3>
                        <p class="text-bgray-600 dark:text-bgray-50 mb-4">${error.message}</p>
                        <button onclick="closeDetailModal()" class="px-4 py-2 bg-bgray-500 text-white rounded-lg hover:bg-bgray-600">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        `;
        console.error('Error:', error);
    });
}

function renderDetailModal(data) {
    // Format tanggal lahir dengan benar
    let formattedBirthDate = '-';
    if (data.birth_date) {
        const birthDate = new Date(data.birth_date);
        if (!isNaN(birthDate.getTime())) {
            formattedBirthDate = birthDate.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        } else {
            formattedBirthDate = data.birth_date;
        }
    }

    const detailModal = document.getElementById('detailModal');

    detailModal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl max-w-4xl w-full relative">
                <!-- Header -->
                <div class="flex justify-between items-center p-6 border-b border-bgray-200 dark:border-darkblack-400">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-success-50 rounded-lg">
                            <svg class="w-6 h-6 text-success-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-bgray-900 dark:text-white">Detail Daycare</h3>
                    </div>
                    <button onclick="closeDetailModal()" class="text-bgray-500 hover:text-bgray-700 dark:text-bgray-300 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Kolom 1: Foto dan Info Dasar -->
                        <div class="md:col-span-1">
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-full max-w-[200px] aspect-[3/4] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                                    ${data.student_photo ?
                                        `<img src="/storage/${data.student_photo}" alt="Foto ${data.name}" class="w-full h-full object-cover">` :
                                        `<div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>`
                                    }
                                </div>
                                <h4 class="text-lg font-semibold text-bgray-900 dark:text-white">${data.name || '-'}</h4>
                                <p class="text-sm text-bgray-500 dark:text-bgray-300">${data.age || '-'} tahun</p>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Tinggi Badan:</span>
                                    <span class="text-sm text-bgray-900 dark:text-white">${data.height || '-'} cm</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Berat Badan:</span>
                                    <span class="text-sm text-bgray-900 dark:text-white">${data.weight || '-'} kg</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Jenis Kelamin:</span>
                                    <span class="text-sm text-bgray-900 dark:text-white">${data.gender === 'L' ? 'Laki-laki' : (data.gender === 'P' ? 'Perempuan' : '-')}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Anak ke-:</span>
                                    <span class="text-sm text-bgray-900 dark:text-white">${data.child_order || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Agama:</span>
                                    <span class="text-sm text-bgray-900 dark:text-white">${data.religion || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-bgray-600 dark:text-bgray-300">No. Telepon:</span>
                                    <span class="text-sm text-bgray-900 dark:text-white">${data.phone || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-bgray-600 dark:text-bgray-300">No. Telepon Anak:</span>
                                    <span class="text-sm text-bgray-900 dark:text-white">${data.child_phone || '-'}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom 2: Informasi Lengkap -->
                        <div class="md:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Informasi Anak -->
                                <div class="space-y-4">
                                    <h4 class="text-md font-semibold text-bgray-900 dark:text-white border-b pb-2">Informasi Anak</h4>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Tempat, Tanggal Lahir</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.birth_place || '-'}, ${formattedBirthDate}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Alamat</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.address || '-'}</p>
                                    </div>
                                </div>

                                <!-- Informasi Daycare -->
                                <div class="space-y-4">
                                    <h4 class="text-md font-semibold text-bgray-900 dark:text-white border-b pb-2">Informasi Daycare</h4>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Jenis Daycare</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.daycare_type === 'bulanan' ? 'Penitipan Anak Bulanan' : (data.daycare_type === 'harian' ? 'Penitipan Anak per Hari (9 jam)' : '-')}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Status</h5>
                                        <p class="text-sm">
                                            <span class="px-2 py-1 rounded-full text-xs ${
                                                data.status === 'active' ? 'bg-success-50 text-success-500' :
                                                data.status === 'pending' ? 'bg-warning-50 text-warning-500' :
                                                data.status === 'completed' ? 'bg-bgray-50 text-bgray-500' :
                                                'bg-danger-50 text-danger-500'
                                            }">
                                                ${
                                                    data.status === 'active' ? 'Aktif' :
                                                    data.status === 'pending' ? 'Menunggu' :
                                                    data.status === 'completed' ? 'Selesai' :
                                                    data.status === 'cancelled' ? 'Dibatalkan' :
                                                    data.status || '-'
                                                }
                                            </span>
                                        </p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Tanggal Pendaftaran</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.created_at ? new Date(data.created_at).toLocaleDateString('id-ID') : '-'}</p>
                                    </div>
                                </div>

                                <!-- Informasi Ayah -->
                                <div class="space-y-4">
                                    <h4 class="text-md font-semibold text-bgray-900 dark:text-white border-b pb-2">Informasi Ayah</h4>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Nama Ayah</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.father_name || '-'}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Usia</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.father_age ? `${data.father_age} tahun` : '-'}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Pendidikan Terakhir</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.father_education || '-'}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Pekerjaan</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.father_occupation || '-'}</p>
                                    </div>
                                </div>

                                <!-- Informasi Ibu -->
                                <div class="space-y-4">
                                    <h4 class="text-md font-semibold text-bgray-900 dark:text-white border-b pb-2">Informasi Ibu</h4>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Nama Ibu</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.mother_name || '-'}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Usia</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.mother_age ? `${data.mother_age} tahun` : '-'}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Pendidikan Terakhir</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.mother_education || '-'}</p>
                                    </div>

                                    <div>
                                        <h5 class="text-sm font-medium text-bgray-600 dark:text-bgray-300">Pekerjaan</h5>
                                        <p class="text-sm text-bgray-900 dark:text-white">${data.mother_occupation || '-'}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 mt-8">
                        <button onclick="generateInvoice(${data.id})" class="px-4 py-2 bg-success-300 text-white rounded-lg hover:bg-success-400 transition-colors">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                <span>Cetak Invoice</span>
                            </div>
                        </button>
                        <button onclick="closeDetailModal()" class="px-4 py-2 bg-bgray-300 text-white rounded-lg hover:bg-bgray-400 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
}

function confirmDelete(id) {
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.classList.remove('hidden');

    deleteModal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl max-w-md w-full relative">
                <div class="p-6 text-center">
                    <div class="mb-5 flex justify-center">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-bgray-900 dark:text-white mb-3">Konfirmasi Hapus</h3>
                    <p class="text-bgray-600 dark:text-bgray-50 mb-6">Apakah Anda yakin ingin menghapus data daycare ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex justify-center gap-3">
                        <button onclick="closeDeleteModal()" class="px-5 py-2.5 bg-bgray-200 text-bgray-800 rounded-lg hover:bg-bgray-300 transition-colors">
                            Batal
                        </button>
                        <button onclick="deleteData(${id})" class="px-5 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
}

function deleteData(id) {
    // Tambahkan CSRF token ke header
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/daycare/destroy/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        closeDeleteModal();
        if (data.success) {
            // Tampilkan pesan sukses
            showSuccessMessage(data.message);
            // Refresh halaman setelah 1 detik
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showErrorMessage(data.message || 'Terjadi kesalahan saat menghapus data');
        }
    })
    .catch(error => {
        closeDeleteModal();
        showErrorMessage('Terjadi kesalahan saat menghapus data');
        console.error('Error:', error);
    });
}

function showSuccessMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md z-50 animate-fade-in-right';
    messageDiv.innerHTML = `
        <div class="flex items-center">
            <div class="py-1">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="font-bold">Berhasil!</p>
                <p>${message}</p>
            </div>
        </div>
    `;
    document.body.appendChild(messageDiv);

    setTimeout(() => {
        messageDiv.classList.replace('animate-fade-in-right', 'animate-fade-out-right');
        setTimeout(() => {
            document.body.removeChild(messageDiv);
        }, 500);
    }, 3000);
}

function showErrorMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md z-50 animate-fade-in-right';
    messageDiv.innerHTML = `
        <div class="flex items-center">
            <div class="py-1">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="font-bold">Error!</p>
                <p>${message}</p>
            </div>
        </div>
    `;
    document.body.appendChild(messageDiv);

    setTimeout(() => {
        messageDiv.classList.replace('animate-fade-in-right', 'animate-fade-out-right');
        setTimeout(() => {
            document.body.removeChild(messageDiv);
        }, 500);
    }, 3000);
}

// Fungsi untuk generate invoice PDF
const generateInvoice = async (id) => {
    try {
        // Tampilkan loading
        showLoadingMessage('Memuat data invoice...');

        // Fetch data invoice dari server
        const response = await fetch(`/daycare/generate-invoice/${id}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        // Periksa tipe konten respons
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Server mengembalikan respons yang tidak valid. Harap coba lagi.');
        }

        const result = await response.json();

        // Log hasil untuk debugging
        console.log('Response dari server:', result);

        if (!result.success) {
            throw new Error(result.message || 'Gagal mengambil data invoice');
        }

        const data = result.data;
        if (!data) {
            throw new Error('Data invoice kosong');
        }

        // Generate PDF menggunakan jsPDF
        const { jsPDF } = window.jspdf;
        if (!jsPDF) {
            throw new Error('Library jsPDF tidak tersedia');
        }

        const doc = new jsPDF();

        // Warna yang lebih soft
        const colors = {
            primary: [41, 128, 185],   // Biru yang lebih soft
            text: [75, 85, 99],        // Abu-abu gelap untuk teks
            success: [46, 204, 113],   // Hijau untuk status
            lightText: [160, 174, 192] // Abu-abu terang untuk garis
        };

        // Tambahkan watermark logo
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();

        // Background putih
        doc.setFillColor(255, 255, 255);
        doc.rect(0, 0, 210, 297, 'F');

        // Header dengan logo
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 15, 15, 25, 15);

        // Judul invoice
        doc.setTextColor(...colors.primary);
        doc.setFontSize(24);
        doc.setFont('helvetica', 'bold');
        doc.text('INVOICE DAYCARE', 195, 25, { align: 'right' });

        // Garis header
        doc.setDrawColor(...colors.primary);
        doc.setLineWidth(0.5);
        doc.line(15, 35, 195, 35);

        // Informasi invoice
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...colors.text);

        // Informasi Pelanggan
        doc.setFontSize(12);
        doc.setFont('helvetica', 'bold');
        doc.text('Informasi Pelanggan', 15, 45);
        doc.setFont('helvetica', 'normal');
        doc.text(`Nama: ${data.name || '-'}`, 15, 55);
        doc.text(`Usia: ${data.age || '-'} tahun`, 15, 65);
        doc.text(`Tanggal Lahir: ${data.birth_date ? new Date(data.birth_date).toLocaleDateString('id-ID') : '-'}`, 15, 75);
        doc.text(`Alamat: ${data.address || '-'}`, 15, 85);

        // Informasi Layanan
        let yPos = 105;
        doc.setFontSize(12);
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(...colors.primary);
        doc.text('Informasi Layanan', 15, yPos);
        yPos += 10;

        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...colors.text);

        // Header tabel
        doc.setFillColor(...colors.primary);
        doc.setTextColor(255, 255, 255);
        doc.rect(15, yPos, 180, 8, 'F');
        doc.text('Deskripsi', 20, yPos + 5.5);
        doc.text('Jumlah', 130, yPos + 5.5);
        doc.text('Harga', 160, yPos + 5.5);
        yPos += 8;

        // Isi tabel
        doc.setTextColor(...colors.text);
        doc.setFillColor(240, 240, 240);
        doc.rect(15, yPos, 180, 8, 'F');

        const daycareType = data.daycare_type_text || (data.daycare_type === 'bulanan' ? 'Penitipan Bulanan' : 'Penitipan Harian');
        doc.text(daycareType, 20, yPos + 5.5);
        doc.text('1', 130, yPos + 5.5);
        doc.text(`Rp ${(data.base_price || 0).toLocaleString('id-ID')}`, 160, yPos + 5.5);
        yPos += 8;

        // Tambahkan kaus kaki jika diperlukan
        if (data.need_socks) {
            doc.setFillColor(255, 255, 255);
            doc.rect(15, yPos, 180, 8, 'F');
            doc.text('Kaos Kaki', 20, yPos + 5.5);
            doc.text('1', 130, yPos + 5.5);
            doc.text(`Rp ${(data.socks_price || 5000).toLocaleString('id-ID')}`, 160, yPos + 5.5);
            yPos += 8;
        }

        // Total
        yPos += 5;
        doc.setDrawColor(...colors.lightText);
        doc.line(15, yPos, 195, yPos);
        yPos += 5;

        doc.setFont('helvetica', 'bold');
        doc.text('Total', 130, yPos + 5);
        doc.setTextColor(...colors.success);
        doc.text(`Rp ${(data.total_price || 0).toLocaleString('id-ID')}`, 160, yPos + 5);

        // Catatan pendaftaran
        yPos += 20;
        doc.setTextColor(...colors.text);
        doc.setFont('helvetica', 'italic');
        doc.setFontSize(10);
        doc.text('Catatan: Ini adalah biaya pendaftaran saja', 15, yPos);

        // Footer
        const pageHeight = doc.internal.pageSize.height;
        doc.setFontSize(10);
        doc.setTextColor(...colors.text);
        doc.setFont('helvetica', 'italic');
        doc.text('Terima kasih telah menggunakan layanan kami.', 15, pageHeight - 20);
        doc.text('Untuk pertanyaan, silakan hubungi kami di 0812-3456-7890', 15, pageHeight - 15);

        // Simpan PDF dengan nama yang sesuai
        const formattedDate = new Date().toISOString().slice(0,10);
        const fileName = `Invoice_Daycare_${(data.name || 'Pelanggan').replace(/\s+/g, '_')}_${formattedDate}.pdf`;
        doc.save(fileName);

        showSuccessMessage('Invoice berhasil dibuat dan diunduh');
    } catch (error) {
        console.error('Error generating invoice:', error);
        showErrorMessage('Gagal membuat invoice: ' + error.message);
    } finally {
        closeLoadingModal();
    }
};

// Fungsi untuk menampilkan pesan loading
function showLoadingMessage(message) {
    const modalHtml = `
        <div id="loadingModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/30 dark:bg-white/10 backdrop-blur-sm"></div>
            <div class="relative bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl p-6 w-96 max-w-md transform transition-all animate-modal-pop">
                <div class="text-center">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-success-300 border-t-transparent mb-4"></div>
                    <p class="text-gray-600 dark:text-gray-300">${message}</p>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

// Fungsi untuk menutup modal loading
function closeLoadingModal() {
    const modal = document.getElementById('loadingModal');
    if (modal) {
        modal.remove();
    }
}

// Tambahkan event listener untuk search dan filter
document.addEventListener('DOMContentLoaded', function() {
    // Handler untuk pencarian
    let searchTimeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const searchQuery = this.value;
            // Dapatkan parameter URL saat ini
            const urlParams = new URLSearchParams(window.location.search);

            // Update parameter search
            if (searchQuery) {
                urlParams.set('search', searchQuery);
            } else {
                urlParams.delete('search');
            }

            // Pertahankan parameter lain
            const status = document.getElementById('statusFilter').value;
            if (status) {
                urlParams.set('status', status);
            }

            const perPage = document.getElementById('perPageSelect').value;
            urlParams.set('per_page', perPage);

            // Redirect ke URL baru
            window.location.href = `/daycare?${urlParams.toString()}`;
        }, 500);
    });

    // Handler untuk filter status
    document.getElementById('statusFilter').addEventListener('change', function() {
        const statusFilter = this.value;
        // Dapatkan parameter URL saat ini
        const urlParams = new URLSearchParams(window.location.search);

        // Update parameter status
        if (statusFilter) {
            urlParams.set('status', statusFilter);
        } else {
            urlParams.delete('status');
        }

        // Pertahankan parameter lain
        const search = document.getElementById('searchInput').value;
        if (search) {
            urlParams.set('search', search);
        }

        const perPage = document.getElementById('perPageSelect').value;
        urlParams.set('per_page', perPage);

        // Redirect ke URL baru
        window.location.href = `/daycare?${urlParams.toString()}`;
    });

    // Handler untuk per page select
    document.getElementById('perPageSelect').addEventListener('change', function() {
        const perPage = this.value;
        // Dapatkan parameter URL saat ini
        const urlParams = new URLSearchParams(window.location.search);

        // Update parameter per_page
        urlParams.set('per_page', perPage);

        // Pertahankan parameter lain
        const search = document.getElementById('searchInput').value;
        if (search) {
            urlParams.set('search', search);
        }

        const status = document.getElementById('statusFilter').value;
        if (status) {
            urlParams.set('status', status);
        }

        // Redirect ke URL baru
        window.location.href = `/daycare?${urlParams.toString()}`;
    });
});
</script>
@endpush
