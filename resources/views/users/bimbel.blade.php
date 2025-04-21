@extends('users.layouts.app')

@section('title', 'Dashboard')

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
                                        <img src="{{asset('/images/icons/total-earn.svg') }}" alt="icon" />
                                    </span>
                                </div>
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total
                                    Hari ini</span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between">
                            <div class="flex-1">
                                <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                    {{ $total_today ?? '0' }}
                                </p>
                                <div class="flex items-center space-x-1">
                                    <span>
                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4318 0.522827L12.4446 0.522827L8.55575 0.522827L7.56859 0.522827C6.28227 0.522827 5.48082 1.91818 6.12896 3.02928L9.06056 8.05489C9.7037 9.1574 11.2967 9.1574 11.9398 8.05489L14.8714 3.02928C15.5196 1.91818 14.7181 0.522828 13.4318 0.522827Z"
                                                fill="#22C55E" />
                                            <path opacity="0.4"
                                                d="M2.16878 13.0485L3.15594 13.0485L7.04483 13.0485L8.03199 13.0485C9.31831 13.0485 10.1198 11.6531 9.47163 10.542L6.54002 5.5164C5.89689 4.41389 4.30389 4.41389 3.66076 5.5164L0.729153 10.542C0.0810147 11.6531 0.882466 13.0485 2.16878 13.0485Z"
                                                fill="#22C55E" />
                                        </svg>
                                    </span>
                                    <span class="text-sm font-medium text-success-300">
                                        + 3.5%
                                    </span>
                                </div>
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
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total Bimbel Aktif</span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between">
                            <div class="flex-1">
                                <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                    {{ $total_active ?? '0' }}
                                </p>
                                <div class="flex items-center space-x-1">
                                    <span>
                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4318 0.522827L12.4446 0.522827L8.55575 0.522827L7.56859 0.522827C6.28227 0.522827 5.48082 1.91818 6.12896 3.02928L9.06056 8.05489C9.7037 9.1574 11.2967 9.1574 11.9398 8.05489L14.8714 3.02928C15.5196 1.91818 14.7181 0.522828 13.4318 0.522827Z"
                                                fill="#22C55E" />
                                            <path opacity="0.4"
                                                d="M2.16878 13.0485L3.15594 13.0485L7.04483 13.0485L8.03199 13.0485C9.31831 13.0485 10.1198 11.6531 9.47163 10.542L6.54002 5.5164C5.89689 4.41389 4.30389 4.41389 3.66076 5.5164L0.729153 10.542C0.0810147 11.6531 0.882466 13.0485 2.16878 13.0485Z"
                                                fill="#22C55E" />
                                        </svg>
                                    </span>
                                    <span class="text-sm font-medium text-success-300">
                                        + 3.5%
                                    </span>
                                </div>
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
                                    {{ $total_all ?? '0' }}
                                </p>
                                <div class="flex items-center space-x-1">
                                    <span>
                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4318 0.522827L12.4446 0.522827L8.55575 0.522827L7.56859 0.522827C6.28227 0.522827 5.48082 1.91818 6.12896 3.02928L9.06056 8.05489C9.7037 9.1574 11.2967 9.1574 11.9398 8.05489L14.8714 3.02928C15.5196 1.91818 14.7181 0.522828 13.4318 0.522827Z"
                                                fill="#22C55E" />
                                            <path opacity="0.4"
                                                d="M2.16878 13.0485L3.15594 13.0485L7.04483 13.0485L8.03199 13.0485C9.31831 13.0485 10.1198 11.6531 9.47163 10.542L6.54002 5.5164C5.89689 4.41389 4.30389 4.41389 3.66076 5.5164L0.729153 10.542C0.0810147 11.6531 0.882466 13.0485 2.16878 13.0485Z"
                                                fill="#22C55E" />
                                        </svg>
                                    </span>
                                    <span class="text-sm font-medium text-success-300">
                                        + 3.5%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3">
                    <div class="relative w-[230px]">
                        <input
                            type="text"
                            id="searchInput"
                            class="h-[44px] w-full rounded-lg border border-bgray-300 pl-14 pr-4 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white"
                            placeholder="Search"
                            value="{{ request('search') }}"
                        />
                        <span class="absolute left-5 top-1/2 -translate-y-1/2">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#7F8995" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M19 19L14.65 14.65" stroke="#7F8995" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <div>
                        <select
                            id="statusFilter"
                            class="h-[44px] rounded-lg border border-bgray-300 pl-4 pr-10 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white"
                        >
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div>
                        <button id="exportBtn" class="flex h-[44px] items-center justify-center gap-2 rounded-lg bg-success-300 px-6 text-white hover:bg-success-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-sm font-medium">Export Excel</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--list table-->
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
                                        <span class="text-base font-medium text-bgray-600 dark:text-white">Jenis Bimbel</span>
                                    </th>
                                    <th class="px-6 py-5 text-left">
                                        <span class="text-base font-medium text-bgray-600 dark:text-white">Hari</span>
                                    </th>
                                    <th class="px-6 py-5 text-left">
                                        <span class="text-base font-medium text-bgray-600 dark:text-white">Total Pertemuan</span>
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
                            <tbody id="bimbelTableBody">
                                @forelse($bimbels as $bimbel)
                            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-base font-medium text-bgray-900 dark:text-white">
                                                {{ $bimbel->name }}
                                        </span>
                                    </div>
                                </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $bimbel->age }} tahun
                                        </span>
                                </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ ucfirst($bimbel->bimbel_type) }}
                                        </span>
                                </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $bimbel->day }}
                                        </span>
                                </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $bimbel->total_meetings }} Pertemuan
                                        </span>
                                </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-block px-3 py-1 rounded-full text-sm
                                            {{ $bimbel->status === 'active' ? 'bg-success-50 text-success-300 dark:bg-success-900/20 dark:text-success-300' : 'bg-warning-50 text-warning-300 dark:bg-warning-900/20 dark:text-warning-300' }}">
                                            {{ ucfirst($bimbel->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($bimbel->payment_proof)
                                            <a href="{{ Storage::url($bimbel->payment_proof) }}"
                                               target="_blank"
                                               class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-base text-bgray-500 dark:text-white">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex gap-2">
                                            @if($PermissionDetail)
                                                <button onclick="showDetail({{ $bimbel->id }})"
                                                    class="btn-detail px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                                    Detail
                                                </button>
                                            @endif
                                            @if($PermissionDelete)
                                                <button onclick="confirmDelete({{ $bimbel->id }})"
                                                    class="btn-delete px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                    Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                            </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-5 text-center">
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
                                        <option value="3" {{ $per_page == 3 ? 'selected' : '' }}>3</option>
                                        <option value="5" {{ $per_page == 5 ? 'selected' : '' }}>5</option>
                                        <option value="7" {{ $per_page == 7 ? 'selected' : '' }}>7</option>
                                        <option value="all" {{ $per_page == 'all' ? 'selected' : '' }}>All</option>
                                    </select>
                                </div>
                                <span class="text-sm font-semibold text-bgray-600 dark:text-bgray-50">dari {{ $bimbels->total() }} data</span>
                                    </div>

                            <div id="paginationContainer" class="flex items-center space-x-5 sm:space-x-[35px]">
                                @if($bimbels->hasPages())
                                    <div class="flex rounded-lg bg-white shadow-xs dark:bg-darkblack-600">
                                        <!-- First Page -->
                                        <button data-page="1"
                                            class="paginate-btn flex h-10 w-10 items-center justify-center rounded-l-lg border-r border-bgray-300 dark:border-darkblack-400 {{ $bimbels->onFirstPage() ? 'cursor-not-allowed opacity-50' : '' }}"
                                            {{ $bimbels->onFirstPage() ? 'disabled' : '' }}>
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.2499 3.75L6.75 8.25L11.2499 12.75" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                        <!-- Previous Page -->
                                        <button data-page="{{ $bimbels->currentPage() - 1 }}"
                                            class="paginate-btn flex h-10 w-10 items-center justify-center border-r border-bgray-300 dark:border-darkblack-400 {{ $bimbels->onFirstPage() ? 'cursor-not-allowed opacity-50' : '' }}"
                                            {{ $bimbels->onFirstPage() ? 'disabled' : '' }}>
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5 12.5L7 9l3.5-3.5" stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                        <!-- Page Numbers -->
                                        @php
                                            $start = max(1, $bimbels->currentPage() - 1);
                                            $end = min($start + 2, $bimbels->lastPage());
                                            if ($end - $start < 2) {
                                                $start = max(1, $end - 2);
                                            }
                                        @endphp

                                        @for ($i = $start; $i <= $end; $i++)
                                            <button data-page="{{ $i }}"
                                                class="paginate-btn flex h-10 w-10 items-center justify-center border-r border-bgray-300 dark:border-darkblack-400 {{ $i == $bimbels->currentPage() ? 'bg-success-300 text-white' : 'text-bgray-600 dark:text-bgray-50' }}">
                                                {{ $i }}
                                            </button>
                                        @endfor

                                        <!-- Next Page -->
                                        <button data-page="{{ $bimbels->currentPage() + 1 }}"
                                            class="paginate-btn flex h-10 w-10 items-center justify-center border-r border-bgray-300 dark:border-darkblack-400 {{ !$bimbels->hasMorePages() ? 'cursor-not-allowed opacity-50' : '' }}"
                                            {{ !$bimbels->hasMorePages() ? 'disabled' : '' }}>
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.5 5.5L11 9l-3.5 3.5" stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                        <!-- Last Page -->
                                        <button data-page="{{ $bimbels->lastPage() }}"
                                            class="paginate-btn flex h-10 w-10 items-center justify-center rounded-r-lg {{ !$bimbels->hasMorePages() ? 'cursor-not-allowed opacity-50' : '' }}"
                                            {{ !$bimbels->hasMorePages() ? 'disabled' : '' }}>
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.75 14.25L11.25 9.75L6.75 5.25" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- ... existing modal content ... -->
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- ... existing modal content ... -->
    </div>
@endsection

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
// Pindahkan fungsi ke scope global
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
    fetch(`/bimbel/detail/${id}`, {
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
                        <h3 class="text-xl font-semibold text-bgray-900 dark:text-white">Detail Bimbel</h3>
                    </div>
                    <button onclick="closeDetailModal()" class="text-bgray-500 hover:text-red-500 dark:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div class="p-6 overflow-y-auto max-h-[70vh]">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Informasi Siswa -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 dark:bg-darkblack-500 rounded-xl p-6">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="p-2 bg-blue-50 rounded-lg">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-bgray-900 dark:text-white">Informasi Siswa</h4>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Nama</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.name}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Usia</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.age} tahun</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Jenis Kelamin</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.gender === 'L' ? 'Laki-laki' : 'Perempuan'}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Agama</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.religion}</p>
                                    </div>
                                    <div class="col-span-2 space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Tempat, Tanggal Lahir</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.birth_place}, ${data.birth_date}</p>
                                    </div>
                                    <div class="col-span-2 space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Alamat</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.address}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Orang Tua -->
                            <div class="bg-gray-50 dark:bg-darkblack-500 rounded-xl p-6">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="p-2 bg-purple-50 rounded-lg">
                                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-bgray-900 dark:text-white">Informasi Orang Tua</h4>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2 border-b border-gray-200 dark:border-darkblack-400 pb-4">
                                        <p class="text-sm font-medium text-success-500 mb-2">Data Ayah</p>
                                        <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Nama</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.father_name}</p>
                                </div>
                                            <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Usia</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.father_age} tahun</p>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Pendidikan</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.father_education}</p>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Pekerjaan</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.father_occupation}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-sm font-medium text-success-500 mb-2">Data Ibu</p>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Nama</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.mother_name}</p>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Usia</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.mother_age} tahun</p>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Pendidikan</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.mother_education}</p>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-sm text-bgray-600 dark:text-bgray-50">Pekerjaan</p>
                                                <p class="font-medium text-bgray-900 dark:text-white">${data.mother_occupation}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-6">
                            <!-- Informasi Bimbel -->
                            <div class="bg-gray-50 dark:bg-darkblack-500 rounded-xl p-6">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="p-2 bg-green-50 rounded-lg">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-bgray-900 dark:text-white">Informasi Bimbel</h4>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Jenis Bimbel</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.bimbel_type}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Jenis Layanan</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.service_type}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Hari</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.day}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Total Pertemuan</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.total_meetings} pertemuan</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Status</p>
                                        <span class="inline-block px-3 py-1 text-sm rounded-full ${
                                            data.status === 'active'
                                            ? 'bg-success-50 text-success-500'
                                            : 'bg-warning-50 text-warning-500'
                                        }">
                                            ${data.status.charAt(0).toUpperCase() + data.status.slice(1)}
                                        </span>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Kaos Kaki</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">${data.need_socks ? 'Ya' : 'Tidak'}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Harga -->
                            <div class="bg-gray-50 dark:bg-darkblack-500 rounded-xl p-6">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="p-2 bg-yellow-50 rounded-lg">
                                        <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-bgray-900 dark:text-white">Informasi Harga</h4>
                                </div>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Harga Dasar</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">Rp ${data.base_price.toLocaleString('id-ID')}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-bgray-600 dark:text-bgray-50">Harga Kaos Kaki</p>
                                        <p class="font-medium text-bgray-900 dark:text-white">Rp ${data.socks_price.toLocaleString('id-ID')}</p>
                                    </div>
                                    <div class="border-t border-gray-200 dark:border-darkblack-400 pt-4">
                                        <div class="flex justify-between items-center">
                                            <p class="text-base font-semibold text-bgray-900 dark:text-white">Total Harga</p>
                                            <p class="text-lg font-bold text-success-500">Rp ${data.total_price.toLocaleString('id-ID')}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Siswa -->
                            <div class="bg-gray-50 dark:bg-darkblack-500 rounded-xl p-6">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="p-2 bg-pink-50 rounded-lg">
                                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                            </div>
                                    <h4 class="text-lg font-semibold text-bgray-900 dark:text-white">Foto Siswa</h4>
                        </div>
                                <div class="relative aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                                    <img src="${data.student_photo_url}" alt="Foto Siswa" class="object-cover w-full h-full">
                    </div>
                </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="p-6 border-t border-bgray-200 dark:border-darkblack-400 flex justify-end space-x-4">
                    <button onclick="closeDetailModal()" class="px-4 py-2 bg-bgray-500 text-white rounded-lg hover:bg-bgray-600">
                        Tutup
                    </button>
                    <button onclick="generateInvoice(${JSON.stringify(data).replace(/"/g, '&quot;')})"
                            class="px-4 py-2 bg-info-500 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Generate Invoice</span>
                    </button>
                </div>
            </div>
        </div>
    `;
}

function confirmDelete(id) {
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.classList.remove('hidden');

    deleteModal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow-lg max-w-md w-full relative">
                <div class="p-6 text-center">
                    <div class="mb-4 text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-bgray-900 dark:text-white mb-2">Konfirmasi Hapus</h3>
                    <p class="text-bgray-600 dark:text-bgray-50 mb-6">Apakah Anda yakin ingin menghapus data bimbel ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex justify-center space-x-3">
                        <button onclick="closeDeleteModal()" class="px-4 py-2 bg-bgray-500 text-white rounded-lg hover:bg-bgray-600">
                            Batal
                        </button>
                        <button onclick="deleteData(${id})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Pindahkan fungsi generateInvoice ke scope global
window.generateInvoice = function(data) {
    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Konfigurasi font dan warna
        const colors = {
            primary: [0, 102, 204],    // Biru
            success: [34, 197, 94],    // Hijau
            text: [31, 41, 55],        // Abu gelap
            lightText: [107, 114, 128], // Abu terang
        };

        // Header
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 15, 10, 30, 30);

        doc.setFontSize(24);
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(...colors.primary);
        doc.text('INVOICE', 55, 25);

        // Nomor Invoice dan Tanggal
        const invoiceNumber = `INV/${data.id}/${new Date().getFullYear()}/${String(new Date().getMonth() + 1).padStart(2, '0')}`;
        const currentDate = new Date().toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...colors.text);
        doc.text(`No. Invoice: ${invoiceNumber}`, 55, 35);
        doc.text(`Tanggal: ${currentDate}`, 55, 40);

        // Garis pemisah
        doc.setDrawColor(...colors.lightText);
        doc.line(15, 45, 195, 45);

        // Informasi Pelanggan
        doc.setFontSize(12);
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(...colors.primary);
        doc.text('Informasi Pelanggan', 15, 55);

        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...colors.text);

        const customerInfo = [
            [`Nama Lengkap`, `: ${data.name}`],
            [`Usia`, `: ${data.age} tahun`],
            [`Alamat`, `: ${data.address}`],
            [`No. Telepon`, `: ${data.child_phone || '-'}`]
        ];

        let yPos = 65;
        customerInfo.forEach(([label, value]) => {
            doc.text(label, 15, yPos);
            doc.text(value, 45, yPos);
            yPos += 5;
        });

        // Informasi Bimbel
        yPos += 5;
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(...colors.primary);
        doc.text('Detail Bimbel', 15, yPos);

        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...colors.text);

        yPos += 10;
        const bimbelInfo = [
            [`Jenis Bimbel`, `: ${data.bimbel_type}`],
            [`Jenis Layanan`, `: ${data.service_type}`],
            [`Hari`, `: ${data.day}`],
            [`Total Pertemuan`, `: ${data.total_meetings} pertemuan`]
        ];

        bimbelInfo.forEach(([label, value]) => {
            doc.text(label, 15, yPos);
            doc.text(value, 45, yPos);
            yPos += 5;
        });

        // Tabel Rincian Pembayaran
        yPos += 10;
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(...colors.primary);
        doc.text('Rincian Pembayaran', 15, yPos);

        // Header tabel
        yPos += 10;
        const tableHeaders = ['Deskripsi', 'Jumlah'];
        const columnWidths = [130, 40];
        const startX = 15;

        // Styling header tabel
        doc.setFillColor(...colors.primary);
        doc.rect(startX, yPos - 5, 170, 7, 'F');
        doc.setTextColor(255, 255, 255);

        doc.text(tableHeaders[0], startX + 5, yPos);
        doc.text(tableHeaders[1], startX + columnWidths[0] + 5, yPos, { align: 'right' });

        // Isi tabel
        yPos += 10;
        doc.setTextColor(...colors.text);
        doc.setFont('helvetica', 'normal');

        // Biaya Bimbel
        doc.text('Biaya Bimbel', startX + 5, yPos);
        doc.text(`Rp ${data.base_price.toLocaleString('id-ID')}`, startX + columnWidths[0] + 35, yPos, { align: 'right' });

        // Biaya Kaos Kaki (jika ada)
        if (data.need_socks) {
            yPos += 7;
            doc.text('Kaos Kaki', startX + 5, yPos);
            doc.text(`Rp ${data.socks_price.toLocaleString('id-ID')}`, startX + columnWidths[0] + 35, yPos, { align: 'right' });
        }

        // Total
        yPos += 12;
        doc.setDrawColor(...colors.lightText);
        doc.line(startX, yPos - 5, startX + 170, yPos - 5);

        doc.setFont('helvetica', 'bold');
        doc.text('Total Pembayaran', startX + 5, yPos);
        doc.setTextColor(...colors.success);
        doc.text(`Rp ${data.total_price.toLocaleString('id-ID')}`, startX + columnWidths[0] + 35, yPos, { align: 'right' });

        // Footer
        doc.setFontSize(8);
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...colors.lightText);
        const footerText = [
            'Terima kasih telah memilih Bimbel Samoedra!',
            'Invoice ini adalah bukti pembayaran yang sah.',
            'Simpan invoice ini sebagai bukti pendaftaran bimbel.'
        ];

        yPos = 270;
        footerText.forEach(text => {
            doc.text(text, 105, yPos, { align: 'center' });
            yPos += 5;
        });

        // Watermark
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({ opacity: 0.1 }));
        doc.setTextColor(...colors.lightText);
        doc.setFontSize(60);
        doc.text('SAMOEDRA', 105, 150, {
            align: 'center',
            angle: 45
        });
        doc.restoreGraphicsState();

        // Save PDF
        const fileName = `invoice-bimbel-${data.name.replace(/\s+/g, '_')}-${new Date().toISOString().split('T')[0]}.pdf`;
        doc.save(fileName);

        // Tampilkan notifikasi sukses
        alert('Invoice berhasil di-generate!');

    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Terjadi kesalahan saat membuat invoice. Silakan coba lagi.');
    }
};

// Pindahkan fungsi deleteData ke scope global
window.deleteData = function(id) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const deleteModal = document.getElementById('deleteModal');

    // Tampilkan loading state
    deleteModal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow-lg max-w-md w-full relative">
                <div class="p-6 text-center">
                    <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-success-300 mb-4"></div>
                    <p class="text-lg text-bgray-600 dark:text-white">Menghapus data...</p>
                </div>
            </div>
        </div>
    `;

    // Kirim request delete
    fetch(`/bimbel/destroy/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(response => {
        if (!response.success) {
            throw new Error(response.message || 'Gagal menghapus data');
        }

        // Tampilkan pesan sukses
        deleteModal.innerHTML = `
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow-lg max-w-md w-full relative">
                    <div class="p-6 text-center">
                        <div class="mb-4 text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-bgray-900 dark:text-white mb-2">Berhasil</h3>
                        <p class="text-bgray-600 dark:text-bgray-50 mb-4">${response.message}</p>
                        <button onclick="window.location.reload()" class="px-4 py-2 bg-success-300 text-white rounded-lg hover:bg-success-400">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        `;

        // Refresh halaman setelah 1.5 detik
        setTimeout(() => {
            window.location.reload();
        }, 1500);
    })
    .catch(error => {
        console.error('Error:', error);
        deleteModal.innerHTML = `
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
                        <button onclick="closeDeleteModal()" class="px-4 py-2 bg-bgray-500 text-white rounded-lg hover:bg-bgray-600">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
};

document.addEventListener('DOMContentLoaded', function() {
    // Keep existing modal code
    // ... keep existing modal functions for detail and delete

    // Variabel global untuk halaman saat ini, item per halaman, filter dll
    let currentPage = {{ $bimbels->currentPage() }};
    let perPage = {{ $per_page }};
    let searchQuery = '';
    let statusFilter = '';

    // Handler untuk per page select
    document.getElementById('perPageSelect').addEventListener('change', function() {
        perPage = this.value;
        currentPage = 1; // Reset ke halaman pertama
        fetchData();
    });

    // Handler untuk tombol pagination
    document.querySelectorAll('.paginate-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (!this.disabled) {
                currentPage = parseInt(this.getAttribute('data-page'));
                fetchData();
            }
        });
    });

    // Handler untuk pencarian
    let searchTimeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            searchQuery = this.value;
            currentPage = 1; // Reset ke halaman pertama
            fetchData();
        }, 500);
    });

    // Handler untuk filter status
    document.getElementById('statusFilter').addEventListener('change', function() {
        statusFilter = this.value;
        currentPage = 1; // Reset ke halaman pertama
        fetchData();
    });

    // Fungsi untuk update konten tabel
    function updateTableContent(data) {
        const tableBody = document.getElementById('bimbelTableBody');
        if (!tableBody) return;

        if (data.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-5 text-center">
                        <span class="text-base text-bgray-500 dark:text-white">Tidak ada data</span>
                                </td>
                            </tr>
            `;
            return;
        }

        let html = '';
        data.forEach(bimbel => {
            const statusClass = bimbel.status === 'active'
                ? 'bg-success-50 text-success-300 dark:bg-success-900/20 dark:text-success-300'
                : 'bg-warning-50 text-warning-300 dark:bg-warning-900/20 dark:text-warning-300';

            const paymentProofHtml = bimbel.payment_proof
                ? `<a href="${bimbel.payment_proof}"
                     target="_blank"
                     class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Bukti
                </a>`
                : '<span class="text-base text-bgray-500 dark:text-white">Tidak ada bukti</span>';

            html += `
                            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                    <td class="px-6 py-5">
                        <div class="flex items-center space-x-3">
                            <span class="text-base font-medium text-bgray-900 dark:text-white">
                                ${bimbel.name}
                            </span>
                                    </div>
                                </td>
                    <td class="px-6 py-5">
                        <span class="text-base text-bgray-900 dark:text-white">
                            ${bimbel.age} tahun
                        </span>
                                </td>
                    <td class="px-6 py-5">
                        <span class="text-base text-bgray-900 dark:text-white">
                            ${bimbel.bimbel_type.charAt(0).toUpperCase() + bimbel.bimbel_type.slice(1)}
                        </span>
                                </td>
                    <td class="px-6 py-5">
                        <span class="text-base text-bgray-900 dark:text-white">
                            ${bimbel.day}
                        </span>
                                </td>
                    <td class="px-6 py-5">
                        <span class="text-base text-bgray-900 dark:text-white">
                            ${bimbel.total_meetings} Pertemuan
                        </span>
                                </td>
                    <td class="px-6 py-5">
                        <span class="inline-block px-3 py-1 rounded-full ${statusClass}">
                            ${bimbel.status.charAt(0).toUpperCase() + bimbel.status.slice(1)}
                        </span>
                                </td>
                    <td class="px-6 py-5">
                        ${paymentProofHtml}
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex gap-2">
                            @if($PermissionDetail)
                                <button onclick="showDetail(${bimbel.id})"
                                    class="btn-detail px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    Detail
                                </button>
                            @endif
                            @if($PermissionDelete)
                                <button onclick="confirmDelete(${bimbel.id})"
                                    class="btn-delete px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    Hapus
                                </button>
                            @endif
                        </div>
                    </td>
                            </tr>
            `;
        });

        tableBody.innerHTML = html;
    }

    // Fungsi untuk update pagination
    function updatePagination(data) {
        const container = document.getElementById('paginationContainer');
        if (!container) return;

        // Ini adalah variabel yang tidak bisa diubah karena menggunakan 'const'
        // Ubah menjadi 'let' agar bisa dimodifikasi
        let currentPage = data.current_page;
        let lastPage = data.last_page;
        let total = data.total;

        // Update total data count
        const totalSpan = document.querySelector('.pagination-content .lg\\:flex span:last-child');
        if (totalSpan) {
            totalSpan.textContent = `dari ${total} data`;
        }

        // Jika tidak ada halaman, kosongkan container
        if (lastPage <= 1) {
            container.innerHTML = '';
            return;
        }

        // Buat pagination buttons dengan UI yang lebih baik
        let html = `
            <div class="flex rounded-lg bg-white shadow-xs dark:bg-darkblack-600">
                <!-- First Page Button - Improved UI -->
                <button data-page="1"
                    class="paginate-btn flex h-10 w-10 items-center justify-center rounded-l-lg border-r border-bgray-300 dark:border-darkblack-400 ${currentPage === 1 ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-100'}"
                    ${currentPage === 1 ? 'disabled' : ''}>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.2499 3.75L6.75 8.25L11.2499 12.75" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <!-- Previous Page Button - Improved UI -->
                <button data-page="${currentPage - 1}"
                    class="paginate-btn flex h-10 w-10 items-center justify-center border-r border-bgray-300 dark:border-darkblack-400 ${currentPage === 1 ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-100'}"
                    ${currentPage === 1 ? 'disabled' : ''}>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 12.5L7 9l3.5-3.5" stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
        `;

        // Page Numbers - Dengan UI yang lebih baik
        const start = Math.max(1, currentPage - 1);
        const end = Math.min(start + 2, lastPage);

        for (let i = start; i <= end; i++) {
            html += `
                <button data-page="${i}"
                    class="paginate-btn flex h-10 w-10 items-center justify-center border-r border-bgray-300 dark:border-darkblack-400 ${i === currentPage ? 'bg-success-300 text-white' : 'text-bgray-600 dark:text-bgray-50 hover:bg-gray-100'}">
                    ${i}
                </button>
            `;
        }

        html += `
                <!-- Next Page Button - Improved UI -->
                <button data-page="${currentPage + 1}"
                    class="paginate-btn flex h-10 w-10 items-center justify-center border-r border-bgray-300 dark:border-darkblack-400 ${currentPage === lastPage ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-100'}"
                    ${currentPage === lastPage ? 'disabled' : ''}>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 5.5L11 9l-3.5 3.5" stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <!-- Last Page Button - Improved UI -->
                <button data-page="${lastPage}"
                    class="paginate-btn flex h-10 w-10 items-center justify-center rounded-r-lg ${currentPage === lastPage ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-100'}"
                    ${currentPage === lastPage ? 'disabled' : ''}>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.75 14.25L11.25 9.75L6.75 5.25" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        `;

        container.innerHTML = html;

        // Re-attach event listeners to pagination buttons
        document.querySelectorAll('.paginate-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (!this.disabled) {
                    // PERBAIKAN: Jangan mencoba mengubah currentPage pada listener
                    // Gunakan nilai dari data-page yang sudah ada
                    const pageNum = parseInt(this.getAttribute('data-page'));
                    fetchData(pageNum); // Ubah fungsi fetchData untuk menerima parameter page
                }
            });
        });
    }

    // Perbaikan fungsi fetchData untuk menerima parameter page (opsional)
    function fetchData(page = null) {
        // Jika halaman diberikan, gunakan itu sebagai currentPage
        if (page !== null) {
            currentPage = page;
        }

        // Tampilkan loading state yang lebih menarik
        document.getElementById('tableContainer').innerHTML = `
            <div class="py-10 text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-success-300"></div>
                <p class="mt-2 text-bgray-500 dark:text-white">Memuat data...</p>
            </div>
        `;

        // Buat URL untuk fetch data
        const url = `/bimbel/search?page=${currentPage}&per_page=${perPage}&query=${searchQuery}&status=${statusFilter}`;

        console.log('Fetching data with params:', {
            page: currentPage,
            per_page: perPage,
            query: searchQuery,
            status: statusFilter
        });

        // Fetch data dari server dengan timeout
        const fetchTimeout = setTimeout(() => {
            document.getElementById('tableContainer').innerHTML = `
                <div class="py-10 text-center text-yellow-500">
                    <p>Permintaan data membutuhkan waktu lebih lama dari biasanya.</p>
                    <p class="mt-2">Mohon tunggu sebentar...</p>
                </div>
            `;
        }, 3000); // Tampilkan pesan setelah 3 detik

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            clearTimeout(fetchTimeout);
            if (!response.ok) {
                throw new Error(`Server error: ${response.status} ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data);

            // Persiapkan struktur table container
            document.getElementById('tableContainer').innerHTML = `
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
                                <span class="text-base font-medium text-bgray-600 dark:text-white">Jenis Bimbel</span>
                            </th>
                            <th class="px-6 py-5 text-left">
                                <span class="text-base font-medium text-bgray-600 dark:text-white">Hari</span>
                            </th>
                            <th class="px-6 py-5 text-left">
                                <span class="text-base font-medium text-bgray-600 dark:text-white">Total Pertemuan</span>
                            </th>
                            <th class="px-6 py-5 text-left">
                                <span class="text-base font-medium text-bgray-600 dark:text-white">Status</span>
                            </th>
                            <th class="px-6 py-5 text-left">
                                <span class="text-base font-medium text-bgray-600 dark:text-white">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="bimbelTableBody">
                    </tbody>
                        </table>
            `;

            // Update table content
            updateTableContent(Array.isArray(data.data) ? data.data : []);

            // Update pagination
            updatePagination(data);
        })
        .catch(error => {
            clearTimeout(fetchTimeout);
            console.error('Error fetching data:', error);
            document.getElementById('tableContainer').innerHTML = `
                <div class="py-10 text-center">
                    <div class="bg-red-100 p-4 rounded-lg inline-block mb-4">
                        <svg class="w-6 h-6 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-red-500 font-medium">Terjadi kesalahan saat memuat data.</p>
                    <p class="mt-2 text-gray-600">Detail: ${error.message}</p>
                    <button onclick="fetchData()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Coba Lagi
                    </button>
                </div>
            `;
        });
    }

    // Fungsi helper untuk format waktu
    function formatTime(date) {
        return date.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Export button click handler

        document.getElementById('exportBtn').addEventListener('click', function() {
            window.location.href = '{{ route("bimbel.export") }}';
        });

});
</script>
@endpush
