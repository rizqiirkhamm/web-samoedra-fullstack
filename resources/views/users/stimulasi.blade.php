@extends('users.layouts.app')

@section('title', 'Stimulasi')

@section('content')
<div class="2xl:flex 2xl:space-x-[48px]">
    <section class="mb-6 2xl:mb-0 2xl:flex-1">
        <!-- total widget-->
        <div class="mb-[24px] w-full">
            <div class="grid grid-cols-1 gap-[24px] lg:grid-cols-3">
                <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
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

                <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                    <div class="mb-5 flex items-center justify-between">
                        <div class="flex items-center space-x-[7px]">
                            <div class="icon">
                                <span>
                                    <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                </span>
                            </div>
                            <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total Stimulasi Aktif</span>
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

                <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
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
                <div>
                    <a href="{{ route('stimulasi.export', ['search' => request('search'), 'status' => request('status')]) }}"
                       class="h-[44px] px-4 py-2 bg-success-300 text-white rounded-lg hover:bg-success-400 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export Excel
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
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
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Berat (gr)</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Status</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stimulasis as $stimulasi)
                            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                <td class="px-6 py-5">
                                    <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->name }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->age }} tahun</p>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->height }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->weight }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 rounded-full text-xs {{ $stimulasi->status == 'active' ? 'bg-success-50 text-success-500' : 'bg-error-50 text-error-500' }}">
                                        {{ ucfirst($stimulasi->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex gap-2">
                                        <button onclick="showDetail({{ $stimulasi->id }})"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            Detail
                                        </button>
                                        <button onclick="confirmDelete({{ $stimulasi->id }})"
                                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-5 text-center">
                                    <span class="text-base text-bgray-500 dark:text-white">Tidak ada data</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            Menampilkan {{ $stimulasis->firstItem() ?? 0 }} - {{ $stimulasis->lastItem() ?? 0 }} dari {{ $stimulasis->total() }} data
                        </span>
                        <select id="perPageSelect" class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                            <option value="3" {{ $per_page == 3 ? 'selected' : '' }}>3</option>
                            <option value="5" {{ $per_page == 5 ? 'selected' : '' }}>5</option>
                            <option value="7" {{ $per_page == 7 ? 'selected' : '' }}>7</option>
                        </select>
                    </div>

                    @if ($stimulasis->hasPages())
                    <nav class="flex items-center gap-2">
                        <a href="{{ $stimulasis->previousPageUrl() }}"
                           class="{{ !$stimulasis->onFirstPage() ? 'bg-success-50 text-success-500' : 'bg-gray-100 text-gray-400' }} w-9 h-9 rounded-lg flex items-center justify-center transition-colors duration-200 {{ !$stimulasis->onFirstPage() ? 'hover:bg-success-500 hover:text-white' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>

                        @foreach ($stimulasis->getUrlRange(1, $stimulasis->lastPage()) as $page => $url)
                            <a href="{{ $url }}"
                               class="{{ $page == $stimulasis->currentPage() ? 'bg-success-500 text-white' : 'bg-success-50 text-success-500 hover:bg-success-500 hover:text-white' }} w-9 h-9 rounded-lg flex items-center justify-center transition-colors duration-200">
                                {{ $page }}
                            </a>
                        @endforeach

                        <a href="{{ $stimulasis->nextPageUrl() }}"
                           class="{{ $stimulasis->hasMorePages() ? 'bg-success-50 text-success-500' : 'bg-gray-100 text-gray-400' }} w-9 h-9 rounded-lg flex items-center justify-center transition-colors duration-200 {{ $stimulasis->hasMorePages() ? 'hover:bg-success-500 hover:text-white' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </nav>
                    @endif
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
<script>
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
            window.location.href = `/stimulasi?${urlParams.toString()}`;
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
        window.location.href = `/stimulasi?${urlParams.toString()}`;
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
        window.location.href = `/stimulasi?${urlParams.toString()}`;
    });
});

// Fungsi untuk menampilkan modal detail
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
    fetch(`/stimulasi/detail/${id}`, {
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
                        <button onclick="closeModal('detailModal')" class="px-4 py-2 bg-bgray-500 text-white rounded-lg hover:bg-bgray-600">
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
        // Coba parse tanggal dari format ISO atau format lainnya
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

    // Perbaiki jalur akses foto dan bukti pembayaran
    const studentPhotoUrl = data.student_photo ?
        (data.student_photo.startsWith('student_photos/') ?
            `/storage/${data.student_photo}` :
            `/storage/student_photos/${data.student_photo.split('/').pop()}`) : null;

    const paymentProofUrl = data.payment_proof ?
        (data.payment_proof.startsWith('payment_proofs/') ?
            `/storage/${data.payment_proof}` :
            `/storage/payment_proofs/${data.payment_proof.split('/').pop()}`) : null;

            const phoneNumber = data.phone || '-';

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
                        <h3 class="text-xl font-bold text-bgray-900 dark:text-white">Detail Stimulasi</h3>
                    </div>
                    <button onclick="closeModal('detailModal')" class="text-bgray-500 hover:text-bgray-700 dark:text-bgray-300 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Kolom 1: Foto dan Info Dasar -->
                        <div class="md:col-span-1">
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-full max-w-[200px] aspect-[3/4] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                                    ${studentPhotoUrl ?
                                        `<img src="${studentPhotoUrl}" alt="Foto ${data.name}" class="w-full h-full object-cover">` :
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
                        </div>

                        <!-- Kolom 2: Informasi Anak -->
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Informasi Anak</h3>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Jenis Kelamin:</span> ${data.gender === 'L' ? 'Laki-laki' : 'Perempuan'}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Tempat Lahir:</span> ${data.birth_place}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Tanggal Lahir:</span> ${new Date(data.birth_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Agama:</span> ${data.religion.charAt(0).toUpperCase() + data.religion.slice(1)}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Alamat:</span> ${data.address}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Urutan Anak:</span> Anak ke-${data.child_order}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">No. HP Anak:</span> ${data.child_phone || '-'}
                                </p>
                            </div>
                        </div>

                        <!-- Kolom 3: Informasi Orang Tua -->
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Informasi Orang Tua</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Ayah</h4>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Nama:</span> ${data.father_name}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Usia:</span> ${data.father_age} Tahun
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Pendidikan:</span> ${data.father_education}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Pekerjaan:</span> ${data.father_occupation}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Ibu</h4>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Nama:</span> ${data.mother_name}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Usia:</span> ${data.mother_age} Tahun
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Pendidikan:</span> ${data.mother_education}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Pekerjaan:</span> ${data.mother_occupation}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Stimulasi -->
                    <div class="mt-6 bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Informasi Stimulasi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Sekolah:</span> ${data.has_school_history ? data.school_name : 'Belum Sekolah'}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Hari:</span> ${data.day || 'Belum ditentukan'}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Total Pertemuan:</span> 8 Pertemuan
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Tanggal Mulai:</span> ${new Date(data.start_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-gray-900 dark:text-white">Status:</span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full ${data.status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'}">
                                        ${data.status === 'active' ? 'Aktif' : 'Tidak Aktif'}
                                    </span>
                                </p>
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
                        <button onclick="closeModal('detailModal')" class="px-4 py-2 bg-bgray-300 text-white rounded-lg hover:bg-bgray-400 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Fungsi untuk generate invoice PDF
const generateInvoice = async (id) => {
    try {
        // Tampilkan loading
        showLoadingMessage('Memuat data invoice...');

        // Fetch data invoice dari server
        const response = await fetch(`/stimulasi/generate-invoice/${id}`, {
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
        console.log("Data invoice:", result); // Debug data

        if (!result.success) {
            throw new Error(result.message || 'Gagal memuat data invoice');
        }

        const data = result.data;

        // Pastikan harga adalah angka
        const price = typeof data.price === 'number' ? data.price : parseInt(data.price) || 0;

        // Load jsPDF library
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Konfigurasi warna
        const primaryColor = [41, 128, 185];   // Biru yang lebih soft
        const textColor = [75, 85, 99];        // Abu-abu gelap untuk teks
        const accentColor = [46, 204, 113];    // Hijau untuk status

        // Background putih (default)
        doc.setFillColor(255, 255, 255);
        doc.rect(0, 0, 210, 297, 'F');

        // Tambahkan watermark logo
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("/images/logo/logo_samoedra.JPG", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();

        // Header dengan garis biru
        doc.setDrawColor(...primaryColor);
        doc.setLineWidth(0.5);
        doc.line(20, 35, 190, 35);

        // Logo dan Judul
        doc.addImage("/images/logo/logo_samoedra.JPG", 'JPEG', 20, 15, 25, 15);

        doc.setTextColor(...primaryColor);
        doc.setFontSize(24);
        doc.setFont('helvetica', 'bold');
        doc.text('INVOICE STIMULASI', 190, 25, { align: 'right' });

        // Informasi Invoice
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...textColor);

        // Nomor Invoice dan Tanggal
        const invoiceNumber = `INV/STM/${data.id}/${new Date().getFullYear()}/${String(new Date().getMonth() + 1).padStart(2, '0')}`;
        const currentDate = new Date().toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        doc.text(`No. Invoice: ${invoiceNumber}`, 190, 45, { align: 'right' });
        doc.text(`Tanggal: ${currentDate}`, 190, 52, { align: 'right' });
        doc.text(`Status: ${data.status || 'Aktif'}`, 190, 59, { align: 'right' });

        // Kolom Kiri - Informasi Pelanggan
        doc.text('Ditagihkan Kepada:', 20, 50);
        doc.setFont('helvetica', 'bold');
        doc.text(data.name, 20, 57);
        doc.setFont('helvetica', 'normal');
        doc.text(`Usia: ${data.age} tahun`, 20, 64);
        doc.text(`Nama Ayah: ${data.father_name}`, 20, 71);
        doc.text(`Nama Ibu: ${data.mother_name}`, 20, 78);
        doc.text(`Alamat: ${data.address}`, 20, 85);
        doc.text(`No. Telepon: ${data.phone}`, 20, 92);

        // Garis pemisah
        doc.setDrawColor(230, 230, 230);
        doc.line(20, 100, 190, 100);

        // Judul Detail Layanan
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(12);
        doc.setTextColor(...primaryColor);
        doc.text('DETAIL LAYANAN', 20, 110);

        // Header tabel
        let yPos = 120;
        doc.setFillColor(...primaryColor);
        doc.rect(20, yPos, 170, 10, 'F');

        doc.setTextColor(255, 255, 255);
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(10);
        doc.text('Deskripsi', 25, yPos + 7);
        doc.text('Jumlah', 180, yPos + 7, { align: 'right' });

        // Isi tabel
        yPos += 15;
        doc.setTextColor(...textColor);
        doc.setFont('helvetica', 'normal');

        // Detail stimulasi
        doc.text(`Stimulasi ${data.stimulasi_type}`, 25, yPos);
        doc.text(`Rp ${price.toLocaleString('id-ID')}`, 180, yPos, { align: 'right' });

        // Area Total
        yPos += 20;
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
        doc.text(`Rp ${price.toLocaleString('id-ID')}`, 180, yPos, { align: 'right' });

        // Catatan tambahan
        yPos += 30;
        doc.setFont('helvetica', 'italic');
        doc.setFontSize(10);
        doc.text('Catatan:', 20, yPos);
        doc.text('- Biaya di atas adalah biaya pendaftaran stimulasi', 20, yPos + 7);
        doc.text('- Pembayaran dapat dilakukan secara tunai atau transfer', 20, yPos + 14);
        doc.text('- Bukti pembayaran harap disimpan sebagai bukti pendaftaran', 20, yPos + 21);

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
        doc.text('Rumah Bermain & Belajar Samoedra', 105, footerY - 8, { align: 'center' });
        doc.text('Jl. Mutiara No.C80, Padasuka, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610', 105, footerY - 3, { align: 'center' });
        doc.text('Telp: 0896-1111-1153 | instagram: @maindisamoedra', 105, footerY + 2, { align: 'center' });

        // Catatan
        doc.setFontSize(8);
        doc.setTextColor(...primaryColor);
        doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 10, { align: 'center' });

        // Simpan PDF dengan format nama yang rapi
        const formattedDate = new Date().toISOString().slice(0,10);
        doc.save(`Invoice-Stimulasi-${data.name.replace(/\s+/g, '-')}-${formattedDate}.pdf`);

        // Tampilkan notifikasi sukses
        hideLoadingMessage();
        showSuccessMessage('Invoice berhasil dibuat!');
    } catch (error) {
        console.error('Error generating invoice:', error);
        hideLoadingMessage();
        showErrorMessage('Gagal membuat invoice: ' + error.message);
    }
};

function showLoadingMessage(message) {
    const loadingDiv = document.createElement('div');
    loadingDiv.id = 'loadingMessage';
    loadingDiv.className = 'fixed top-4 right-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded shadow-md z-50';
    loadingDiv.innerHTML = `
        <div class="flex items-center">
            <div class="mr-3">
                <div class="animate-spin rounded-full h-5 w-5 border-t-2 border-b-2 border-blue-500"></div>
            </div>
            <div>
                <p>${message}</p>
            </div>
        </div>
    `;
    document.body.appendChild(loadingDiv);
}

function hideLoadingMessage() {
    const loadingDiv = document.getElementById('loadingMessage');
    if (loadingDiv) {
        loadingDiv.remove();
    }
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

// Fungsi untuk konfirmasi hapus
function confirmDelete(id) {
    const modal = document.getElementById('deleteModal');
    modal.innerHTML = `
        <div class="fixed inset-0 bg-black/50 dark:bg-white/10 backdrop-blur-sm"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white dark:bg-darkblack-600 rounded-xl max-w-lg w-full p-6 text-center">
                <div class="mb-6">
                    <svg class="mx-auto w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-bgray-900 dark:text-white">
                        Konfirmasi Hapus
                    </h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        Apakah Anda yakin ingin menghapus data ini?
                    </p>
                </div>
                <div class="flex justify-center gap-4">
                    <button onclick="closeModal('deleteModal')"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button onclick="deleteData(${id})"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    `;
    modal.classList.remove('hidden');
}

// Fungsi untuk menghapus data
function deleteData(id) {
    fetch(`/stimulasi/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal('deleteModal');
            showAlert('Data berhasil dihapus', 'success');
            loadData(); // Reload data setelah berhasil hapus
        } else {
            showAlert('Gagal menghapus data', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan', 'error');
    });
}

// Fungsi untuk menutup modal
function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Fungsi untuk menampilkan alert
function showAlert(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 p-4 rounded-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    setTimeout(() => alertDiv.remove(), 3000);
}
</script>
@endpush

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
@endpush
