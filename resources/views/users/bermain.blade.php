@extends('users.layouts.app')

@section('title', 'Dashboard')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="min-h-screen  dark:bg-darkblack-800">
    <div class="2xl:flex 2xl:space-x-[48px]">
        <section class="mb-6 2xl:mb-0 2xl:flex-1">


            <!-- Cards Section -->
            <div class="mb-[24px] w-full">
                <div class="grid grid-cols-1 gap-[24px] lg:grid-cols-3">
                    <!-- Card Total Active -->
                    <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex items-center space-x-[7px]">
                                <div class="icon">
                                    <span><img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" /></span>
                                </div>
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total yang aktif bermain</span>
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

                    <!-- Card Total Today -->
                    <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex items-center space-x-[7px]">
                                <div class="icon">
                                    <span><img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" /></span>
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

                    <!-- Card Total All -->
                    <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex items-center space-x-[7px]">
                                <div class="icon">
                                    <span><img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" /></span>
                                </div>
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total Semua</span>
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

            <!-- Search and Filter Section -->
            <div class="w-full rounded-lg bg-white dark:bg-darkblack-600 px-[24px] py-[20px] mb-4">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <!-- Search Bar -->
                    <div class="w-full md:w-1/3">
                        <input type="text"
                               id="searchInput"
                               placeholder="Cari berdasarkan nama, hari, atau tanggal..."
                               class="w-full rounded-lg border border-bgray-300 p-2.5 dark:bg-darkblack-600 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <!-- Status Filter -->
                    <div class="flex gap-2">
                        <button type="button"
                                data-status="all"
                                class="filter-btn px-4 py-2 rounded-lg bg-success-300 text-white dark:bg-success-300 dark:text-white">
                            Semua
                        </button>
                        <button type="button"
                                data-status="waiting"
                                class="filter-btn px-4 py-2 rounded-lg bg-white text-bgray-600 dark:bg-darkblack-500 dark:text-gray-300">
                            Menunggu
                        </button>
                        <button type="button"
                                data-status="playing"
                                class="filter-btn px-4 py-2 rounded-lg bg-white text-bgray-600 dark:bg-darkblack-500 dark:text-gray-300">
                            Bermain
                        </button>
                        <button type="button"
                                data-status="finished"
                                class="filter-btn px-4 py-2 rounded-lg bg-white text-bgray-600 dark:bg-darkblack-500 dark:text-gray-300">
                            Selesai
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="w-full rounded-lg bg-white dark:bg-darkblack-600 px-[24px] py-[20px]">
                <div class="flex justify-between mb-4">
                    <!-- Tombol Export Excel -->
                    <div>
                        <a href="{{ route('bermain.export') }}" id="exportExcel" class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-green-600/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Excel
                        </a>
                    </div>

                    <!-- Real Time Clock -->
                    <div class="bg-white dark:bg-darkblack-600 rounded-lg px-4 py-2 shadow">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Waktu Sekarang:</span>
                        <span id="realTimeClock" class="ml-2 text-lg font-bold text-gray-800 dark:text-white">00:00:00</span>
                    </div>
                </div>
                <div class="flex flex-col space-y-5">
                    <div class="table-content w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex w-full items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Nama</span>
                                            <span>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex w-full items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Usia</span>
                                            <span>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Hari</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Tanggal</span>
                                            <span>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Waktu</span>
                                            <span>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Durasi</span>
                                            <span>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Status</span>
                                            <span>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Sisa Waktu</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Bukti Pembayaran</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Aksi</span>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="dark:bg-darkblack-600">
                                @forelse($bermain as $item)
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400" data-id="{{ $item->id }}">
                                    <td class="px-6 py-5 xl:px-0">
                                        <p class="text-base font-semibold text-bgray-900 dark:text-white">{{ $item->name }}</p>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $item->age }} Tahun</p>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $item->day }}</p>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <p class="text-base font-medium text-bgray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <p class="text-base font-medium text-bgray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($item->start_datetime)->format('H:i') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <p class="text-base font-medium text-bgray-900 dark:text-white">
                                            {{ $item->duration }} Jam
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <span class="text-base font-medium {{ $item->status }} dark:text-white">
                                            @if($item->status === 'waiting')
                                                Menunggu
                                            @elseif($item->status === 'playing')
                                                Bermain
                                            @else
                                                Selesai
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <span class="timer text-base font-medium text-bgray-900 dark:text-white"
                                              data-remaining="{{ isset($item) ? $item->remaining_time : 0 }}"
                                              data-duration="{{ isset($item) ? $item->duration : 0 }}"
                                              data-selected-date-time="{{ isset($item) ? $item->start_datetime : '' }}">
                                            @if(isset($item))
                                                @if($item->status === 'playing')
                                                    {{ gmdate('H:i:s', $item->remaining_time) }}
                                                @elseif($item->status === 'waiting')
                                                    Belum Mulai
                                                @else
                                                    Selesai
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        @if($item->payment_proof)
                                            <a href="{{ asset('storage/payment_proofs/' . str_replace('payment_proofs/', '', $item->payment_proof)) }}"
                                               target="_blank"
                                               class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-200 shadow-lg hover:shadow-green-500/30 w-fit">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-red-500 dark:text-red-400">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 xl:px-0">
                                        <div class="flex gap-2 justify-end">
                                            @if(!empty($PermissionDelete))
                                            <button onclick="confirmDelete('{{ $item->id }}')"
                                                    class="flex items-center px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-200 shadow-lg hover:shadow-red-500/30">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                            @endif
                                            <button onclick="generateInvoicePDF('{{ $item->id }}', '{{ $item->name }}', '{{ $item->age }}', '{{ $item->day }}', '{{ $item->start_datetime }}', '{{ $item->duration }}', {{ $item->need_socks ? 'true' : 'false' }})"
                                                    class="flex items-center px-3 py-1.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-200 shadow-lg hover:shadow-blue-500/30">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Invoice
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-5 text-center">
                                        Tidak ada data
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-content w-full dark:bg-darkblack-600">
                        <div class="flex w-full items-center justify-center lg:justify-between">
                            <div class="hidden items-center space-x-4 lg:flex">
                                <span class="text-sm font-semibold text-bgray-600 dark:text-white">Show result:</span>
                                <div class="relative">
                                    <button onclick="togglePerPageDropdown()" type="button"
                                        class="flex items-center space-x-6 rounded-lg border border-bgray-300 px-2.5 py-[14px] dark:border-darkblack-400 dark:text-white">
                                        <span class="text-sm font-semibold text-bgray-900 dark:text-white" id="per-page-value">{{ $per_page }}</span>
                                        <span>
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.03516 6.03271L8.03516 10.0327L12.0352 6.03271" stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                    <div id="per-page-dropdown" class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white dark:bg-darkblack-500 shadow-lg">
                                        <ul>
                                            <li onclick="changePerPage(3)" class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100 dark:text-white dark:hover:bg-darkblack-400">3</li>
                                            <li onclick="changePerPage(5)" class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100 dark:text-white dark:hover:bg-darkblack-400">5</li>
                                            <li onclick="changePerPage(7)" class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100 dark:text-white dark:hover:bg-darkblack-400">7</li>
                                            <li onclick="changePerPage('all')" class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100 dark:text-white dark:hover:bg-darkblack-400">All</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-5 sm:space-x-[35px]" id="pagination-buttons">
                                <!-- Pagination buttons will be inserted here by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('styles')
<style>
.status-badge {
    @apply px-3 py-1 text-sm font-medium rounded-full transition-colors duration-300;
}
.status-badge.waiting {
    @apply bg-yellow-100 text-yellow-800 dark:bg-yellow-500 dark:bg-opacity-20 dark:text-yellow-100;
}
.status-badge.playing {
    @apply bg-green-100 text-green-800 dark:bg-green-500 dark:bg-opacity-20 dark:text-green-100;
}
.status-badge.finished {
    @apply bg-gray-100 text-gray-800 dark:bg-gray-500 dark:bg-opacity-20 dark:text-gray-100;
}

@media print {
    body * {
        visibility: hidden;
    }
    #printableInvoice, #printableInvoice * {
        visibility: visible;
    }
    #printableInvoice {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}

/* Dark mode improvements */
.dark .status-badge {
    @apply shadow-none;
}

.dark .status-badge.waiting {
    @apply from-yellow-600 to-yellow-700;
}

.dark .status-badge.playing {
    @apply from-green-600 to-green-700;
}

.dark .status-badge.finished {
    @apply from-gray-600 to-gray-700;
}

/* Modal backdrop for dark mode */
.dark #deleteModal::before,
.dark #alertModal::before {
    background: rgba(255, 255, 255, 0.1);
}

/* Button improvements for dark mode */
.dark button.bg-gray-100 {
    @apply bg-darkblack-500 text-gray-300;
}

.dark button.bg-gray-100:hover {
    @apply bg-darkblack-400;
}

/* Animation improvements */
.animate-modal-pop {
    animation: modalPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}

@keyframes modalPop {
    0% {
        opacity: 0;
        transform: scale(0.95) translateY(10px);
    }
    100% {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Table improvements for dark mode */
.dark tbody tr:hover {
    @apply bg-darkblack-500;
}

.dark td {
    @apply text-gray-300;
}

/* Status badge enhancements */
.status-badge {
    @apply px-3 py-1.5 text-sm font-medium rounded-full transition-all duration-300;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.status-badge:hover {
    transform: translateY(-1px);
}

/* Button hover effects */
button {
    @apply transform transition-all duration-200;
}

button:hover {
    @apply translate-y-[-1px];
}

button:active {
    @apply translate-y-0;
}

/* Dark mode improvements */
.dark .bg-white {
    @apply bg-darkblack-600;
}

.dark .text-bgray-900 {
    @apply text-white;
}

.dark .border-bgray-300 {
    @apply border-darkblack-400;
}

/* Table improvements */
.dark tbody tr {
    @apply bg-darkblack-600;
}

.dark tbody tr:hover {
    @apply bg-darkblack-500;
}

/* Filter buttons in dark mode */
.dark .filter-btn {
    @apply bg-darkblack-500 text-gray-300;
}

.dark .filter-btn:hover {
    @apply bg-darkblack-400;
}

.dark .filter-btn.active {
    @apply bg-success-300 text-white;
}

/* Search input in dark mode */
.dark #searchInput {
    @apply bg-darkblack-500 border-darkblack-400 text-white placeholder-gray-400;
}

/* Status badges in dark mode */
.dark .status-badge.waiting {
    @apply bg-yellow-900 bg-opacity-20 text-yellow-100;
}

.dark .status-badge.playing {
    @apply bg-green-900 bg-opacity-20 text-green-100;
}

.dark .status-badge.finished {
    @apply bg-gray-900 bg-opacity-20 text-gray-100;
}

/* Pagination in dark mode */
.dark #pagination-buttons button {
    @apply text-gray-300;
}

.dark #pagination-buttons button:disabled {
    @apply text-gray-600;
}

.dark #pagination-buttons button.active {
    @apply bg-success-300 text-white;
}

/* Per page dropdown in dark mode */
.dark #per-page-dropdown {
    @apply bg-darkblack-500 border-darkblack-400;
}

.dark #per-page-dropdown li:hover {
    @apply bg-darkblack-400;
}

/* Real time clock in dark mode */
.dark #realTimeClock {
    @apply text-white;
}

/* Action buttons hover effect */
.dark button.bg-red-500:hover {
    @apply bg-red-600;
}

.dark button.bg-blue-500:hover {
    @apply bg-blue-600;
}

/* Modal improvements for dark mode */
.dark #deleteModal .bg-white,
.dark #alertModal .bg-white {
    @apply bg-darkblack-600;
}

.dark #deleteModal .text-gray-900,
.dark #alertModal .text-gray-900 {
    @apply text-white;
}

.dark #deleteModal .text-gray-600,
.dark #alertModal .text-gray-600 {
    @apply text-gray-300;
}

/* Table header improvements */
.dark thead tr {
    @apply bg-darkblack-600;
}

.dark thead td {
    @apply text-gray-300;
}

/* Custom scrollbar for dark mode */
.dark ::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.dark ::-webkit-scrollbar-track {
    @apply bg-darkblack-500;
}

.dark ::-webkit-scrollbar-thumb {
    @apply bg-darkblack-400 rounded-full;
}

.dark ::-webkit-scrollbar-thumb:hover {
    @apply bg-darkblack-300;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
const timers = {};

// Tambahkan variable untuk menyimpan waktu awal semua timer
const timerStates = {};

function saveTimerState(id, remaining, status) {
    localStorage.setItem(`timer_${id}`, JSON.stringify({
        remaining: remaining,
        status: status,
        lastUpdate: new Date().getTime()
    }));
}

function getTimerState(id) {
    const saved = localStorage.getItem(`timer_${id}`);
    if (saved) {
        const state = JSON.parse(saved);
        const now = new Date().getTime();
        const elapsed = Math.floor((now - state.lastUpdate) / 1000);
        state.remaining = Math.max(0, state.remaining - elapsed);
        return state;
    }
    return null;
}

function initializeTimer(id, remainingTime, status, selectedDateTime) {
    if (timers[id]) {
        clearInterval(timers[id]);
    }

    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (!row) return;

    const timerElement = row.querySelector('.timer');
    const statusElement = row.querySelector('.status-badge');

    if (!timerElement || !statusElement) return;

    // Pastikan remainingTime adalah integer
    remainingTime = Math.floor(parseInt(remainingTime));

    function updateDisplay() {
        const now = new Date();
        const startTime = selectedDateTime ? new Date(selectedDateTime) : null;

        if (status === 'waiting' && startTime && now >= startTime) {
            updateServerTimer(id);
            return;
        }

        if (status === 'playing') {
            if (remainingTime <= 0) {
                updateServerTimer(id);
                return;
            }
            timerElement.textContent = formatTime(remainingTime);
            remainingTime--;
        } else if (status === 'waiting') {
            timerElement.textContent = 'Belum Mulai';
        } else {
            timerElement.textContent = 'Selesai';
        }
    }

    updateDisplay();
    timers[id] = setInterval(updateDisplay, 1000);
}

// Tambahkan variable untuk status
let currentStatus = 'all';

// Tambahkan variabel untuk pagination
let currentPage = 1;
let lastPage = {{ $bermain->lastPage() }};
let perPage = {{ $per_page }};

function togglePerPageDropdown() {
    const dropdown = document.getElementById('per-page-dropdown');
    dropdown.classList.toggle('hidden');
}

function changePerPage(value) {
    perPage = value;
    document.getElementById('per-page-value').textContent = value === 'all' ? 'Semua' : value;
    togglePerPageDropdown();
    currentPage = 1; // Reset ke halaman pertama
    updateTable(document.getElementById('searchInput').value);
}

function updatePaginationButtons() {
    const paginationContainer = document.getElementById('pagination-buttons');
    let html = '';

    // Previous button
    html += `
        <button type="button" onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
            <span>
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.7217 5.03271L7.72168 10.0327L12.7217 15.0327" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </button>
    `;

    // Page numbers
    html += '<div class="flex items-center">';

    // First page
    html += createPageButton(1);

    // Dots or numbers
    if (lastPage > 7) {
        if (currentPage > 4) {
            html += '<span class="text-sm text-bgray-500">...</span>';
        }

        // Show current page and surrounding pages
        for (let i = Math.max(2, currentPage - 2); i <= Math.min(lastPage - 1, currentPage + 2); i++) {
            html += createPageButton(i);
        }

        if (currentPage < lastPage - 3) {
            html += '<span class="text-sm text-bgray-500">...</span>';
        }
    } else {
        // Show all pages if total pages are 7 or less
        for (let i = 2; i < lastPage; i++) {
            html += createPageButton(i);
        }
    }

    // Last page if not already shown
    if (lastPage > 1) {
        html += createPageButton(lastPage);
    }

    html += '</div>';

    // Next button
    html += `
        <button type="button" onclick="changePage(${currentPage + 1})" ${currentPage === lastPage ? 'disabled' : ''}>
            <span>
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.72168 5.03271L12.7217 10.0327L7.72168 15.0327" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </button>
    `;

    paginationContainer.innerHTML = html;
}

function createPageButton(pageNumber) {
    const isActive = pageNumber === currentPage;
    return `
        <button type="button" onclick="changePage(${pageNumber})"
            class="rounded-lg ${isActive ? 'bg-success-50 text-success-300' : 'text-bgray-500'} px-4 py-1.5 text-xs font-bold transition duration-300 ease-in-out hover:bg-success-50 hover:text-success-300 dark:hover:bg-darkblack-500 lg:px-6 lg:py-2.5 lg:text-sm">
            ${pageNumber}
        </button>
    `;
}

function changePage(page) {
    if (page < 1 || page > lastPage || page === currentPage) return;
    currentPage = page;
    updateTable(document.getElementById('searchInput').value);
}

function updateTable(query = '') {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!token) {
        console.error('CSRF token not found');
        return;
    }

    // Simpan state semua timer yang sedang berjalan
    document.querySelectorAll('tr[data-id]').forEach(row => {
        const id = row.dataset.id;
        const timerElement = row.querySelector('.timer');
        const statusElement = row.querySelector('.status-badge');

        if (timerElement && statusElement) {
            const status = statusElement.classList.contains('playing') ? 'playing' :
                          statusElement.classList.contains('waiting') ? 'waiting' : 'finished';

            if (status === 'playing') {
                timerStates[id] = {
                    remaining: parseInt(timerElement.dataset.remaining),
                    startTime: Date.now() - ((parseInt(timerElement.dataset.remaining) - parseInt(timerElement.textContent.split(':').reduce((acc, time) => (60 * acc) + parseInt(time), 0))) * 1000),
                    status: status
                };
            }
        }
    });

    // Tambahkan parameter per_page dan page ke URL
    let url = `/bermain/search?query=${encodeURIComponent(query)}&status=${currentStatus}`;

    // Hanya tambahkan parameter page jika bukan 'all'
    if (perPage !== 'all') {
        url += `&per_page=${perPage}&page=${currentPage}`;
    } else {
        url += '&per_page=all';
    }

    fetch(url, {
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(response => {
        const data = response.data;

        // Update pagination info
        if (perPage === 'all') {
            currentPage = 1;
            lastPage = 1;
        } else {
            currentPage = parseInt(response.current_page);
            lastPage = parseInt(response.last_page);
        }

        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';

        if (data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="px-6 py-5 text-center">
                        Tidak ada data yang sesuai
                    </td>
                </tr>
            `;
            return;
        }

        // Urutkan data berdasarkan start_datetime terbaru
        data.sort((a, b) => new Date(b.start_datetime) - new Date(a.start_datetime));

        data.forEach(item => {
            // Jika ada state timer yang tersimpan, gunakan itu
            if (timerStates[item.id] && item.status === 'playing') {
                const elapsed = Math.floor((Date.now() - timerStates[item.id].startTime) / 1000);
                item.remaining_time = Math.max(0, parseInt(timerStates[item.id].remaining) - elapsed);
            }
            tbody.insertAdjacentHTML('beforeend', createTableRow(item));
        });

        // Reinisialisasi timer
        setTimeout(() => {
            document.querySelectorAll('tr[data-id]').forEach(row => {
                const id = row.dataset.id;
                const statusBadge = row.querySelector('.status-badge');
                const timerElement = row.querySelector('.timer');

                if (!statusBadge || !timerElement) return;

                let status;
                if (statusBadge.classList.contains('playing')) status = 'playing';
                else if (statusBadge.classList.contains('waiting')) status = 'waiting';
                else status = 'finished';

                let remainingTime = parseInt(timerElement.dataset.remaining || 0);
                const selectedDateTime = timerElement.dataset.selectedDateTime;

                // Gunakan state yang tersimpan jika ada
                if (timerStates[id] && status === 'playing') {
                    const elapsed = Math.floor((Date.now() - timerStates[id].startTime) / 1000);
                    remainingTime = Math.max(0, timerStates[id].remaining - elapsed);
                }

                initializeTimer(id, remainingTime, status, selectedDateTime);
            });
        }, 100);

        // Update pagination buttons jika bukan 'all'
        const paginationContainer = document.getElementById('pagination-buttons');
        if (perPage === 'all') {
            paginationContainer.innerHTML = ''; // Sembunyikan pagination
            // Update tampilan jumlah data
            const perPageValue = document.getElementById('per-page-value');
            if (perPageValue) {
                perPageValue.textContent = 'Semua';
            }
        } else {
            updatePaginationButtons();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memuat data', 'error');
    });
}

// Update fungsi updateServerTimer
function updateServerTimer(id) {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!token) {
        console.error('CSRF token not found');
        return;
    }

    fetch(`/bermain/update-timer/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const row = document.querySelector(`tr[data-id="${id}"]`);
        const statusElement = row.querySelector('.status-badge');
        const timerElement = row.querySelector('.timer');

        if (data.status === 'playing') {
            statusElement.textContent = 'Bermain';
            statusElement.className = 'status-badge playing dark:bg-opacity-10';

            // Reinitialize timer dengan status baru
            if (timers[id]) {
                clearInterval(timers[id]);
            }
            initializeTimer(id, data.remaining_time, 'playing', null);

        } else if (data.status === 'finished') {
            statusElement.textContent = 'Selesai';
            statusElement.className = 'status-badge finished dark:bg-opacity-10';
            timerElement.textContent = 'Selesai';

            if (timers[id]) {
                clearInterval(timers[id]);
            }
        }
    })
    .catch(error => {
        console.error('Error updating timer:', error);
    });
}

// Initialize existing timers
document.addEventListener('DOMContentLoaded', function() {
    console.log('Initializing timers');

    document.querySelectorAll('tr[data-id]').forEach(row => {
        const id = row.dataset.id;
        const statusBadge = row.querySelector('.status-badge');
        const timerElement = row.querySelector('.timer');

        if (!statusBadge || !timerElement) return;

        const status = statusBadge.dataset.status;
        const remainingTime = parseInt(timerElement.dataset.remaining || 0);
        const selectedDateTime = timerElement.dataset.selectedDateTime;

        console.log('Initializing timer for ID:', id, {
            status: status,
            remainingTime: remainingTime,
            selectedDateTime: selectedDateTime
        });

        // Initialize timer dan status checker
        const cleanup = initializeTimer(id, remainingTime, status, selectedDateTime);

        // Cleanup pada unload
        window.addEventListener('unload', cleanup);
    });

    // Set active state untuk filter button default (all)
    const defaultFilterBtn = document.querySelector('.filter-btn[data-status="all"]');
    if (defaultFilterBtn) {
        defaultFilterBtn.className = 'filter-btn px-4 py-2 rounded-lg bg-success-300 text-white';
    }
});

// Add new scripts for search and delete
function confirmDelete(id) {
    const modalHtml = `
        <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/30 dark:bg-white/10 backdrop-blur-sm"></div>
            <div class="relative bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl p-6 w-96 max-w-md transform transition-all scale-100">
                <div class="mb-4 text-center">
                    <svg class="mx-auto mb-4 w-14 h-14 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konfirmasi Hapus</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="flex justify-center gap-4">
                    <button onclick="closeDeleteModal()"
                            class="px-4 py-2 bg-gray-100 dark:bg-darkblack-500 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-darkblack-400 transition-colors duration-200">
                        Batal
                    </button>
                    <button onclick="proceedDelete('${id}')"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

function proceedDelete(id) {
    closeDeleteModal();
    fetch(`/bermain/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (response.status === 403) {
            throw new Error('Unauthorized');
        }
        return response.json();
    })
    .then(data => {
        document.querySelector(`tr[data-id="${id}"]`).remove();
        showAlert('Data berhasil dihapus', 'success');
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert(error.message === 'Unauthorized' ? 'Anda tidak memiliki akses untuk menghapus data' : 'Terjadi kesalahan saat menghapus data', 'error');
    });
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.classList.add('fade-out');
        setTimeout(() => modal.remove(), 300);
    }
}

// Live Search
const searchInput = document.getElementById('searchInput');
let searchTimeout;

searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        updateTable(this.value);
    }, 300);
});

function createTableRow(item) {
    // Pastikan data valid
    const id = item.id || '';
    const name = item.name ? item.name.replace(/'/g, "\\'").replace(/"/g, '\\"') : '';
    const age = item.age || '';
    const day = item.day ? item.day.replace(/'/g, "\\'").replace(/"/g, '\\"') : '';
    const duration = item.duration || '';

    // Format tanggal dan waktu
    let formattedDate = '';
    let formattedTime = '';

    try {
        // Parse tanggal dengan benar
        const startDate = new Date(item.start_datetime.replace(' ', 'T'));
        formattedDate = startDate.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
        formattedTime = startDate.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });
    } catch (error) {
        console.error('Error formatting date:', error);
    }

    // Status dan timer text
    let statusText = '';
    switch(item.status) {
        case 'waiting':
            statusText = 'Menunggu';
            break;
        case 'playing':
            statusText = 'Bermain';
            break;
        case 'finished':
            statusText = 'Selesai';
            break;
        default:
            statusText = '-';
    }

    let timerText = '';
    if (item.status === 'playing') {
        timerText = formatTime(Math.floor(item.remaining_time));
    } else if (item.status === 'waiting') {
        timerText = 'Belum Mulai';
    } else {
        timerText = 'Selesai';
    }

    return `
        <tr class="border-b border-bgray-300 dark:border-darkblack-400" data-id="${id}">
            <td class="px-6 py-5 xl:px-0">
                <p class="text-base font-semibold text-bgray-900 dark:text-white">${name}</p>
            </td>
            <td class="px-6 py-5 xl:px-0">
                <p class="text-base font-medium text-bgray-900 dark:text-white">${age} Tahun</p>
            </td>
            <td class="px-6 py-5 xl:px-0">
                <p class="text-base font-medium text-bgray-900 dark:text-white">${day}</p>
            </td>
            <td class="px-6 py-5 xl:px-0">
                <p class="text-base font-medium text-bgray-900 dark:text-white">${formattedDate}</p>
            </td>
            <td class="px-6 py-5 xl:px-0">
                <p class="text-base font-medium text-bgray-900 dark:text-white">${formattedTime}</p>
            </td>
            <td class="px-6 py-5 xl:px-0">
                <p class="text-base font-medium text-bgray-900 dark:text-white">${duration} Jam</p>
            </td>
            <td class="px-6 py-5 xl:px-0">
                <span class="text-base font-medium text-bgray-900 ${item.status} dark:text-white">${statusText}</span>
            </td>
            <td class="px-6 py-5 xl:px-0">
                <span class="timer text-base font-medium text-bgray-900 dark:text-white"
                      data-remaining="${item.remaining_time}"
                      data-duration="${item.duration}"
                      data-selected-date-time="${item.start_datetime}">
                    ${timerText}
                </span>
            </td>
            <td class="px-6 py-5 xl:px-0">
                ${item.payment_proof ?
                    `<a href="${item.payment_proof}"
                        target="_blank"
                        class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-200 shadow-lg hover:shadow-green-500/30 w-fit">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Bukti
                    </a>` :
                    '<span class="text-red-500 dark:text-red-400">Tidak ada bukti</span>'
                }
            </td>
            <td class="px-6 py-5 xl:px-0">
                <div class="flex gap-2 justify-end">
                    @if(!empty($PermissionDelete))
                    <button onclick="confirmDelete('${id}')"
                            class="flex items-center px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-200 shadow-lg hover:shadow-red-500/30">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                    @endif
                    <button onclick="generateInvoicePDF('${id}', '${name}', '${age}', '${day}', '${item.start_datetime}', ${duration}, ${item.need_socks ? 'true' : 'false'})"
                            class="flex items-center px-3 py-1.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-200 shadow-lg hover:shadow-blue-500/30">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Invoice
                    </button>
                </div>
            </td>
        </tr>
    `;
}

function formatTime(seconds) {
    seconds = Math.floor(seconds); // Pastikan angka bulat
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = Math.floor(seconds % 60);
    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
}

// Update fungsi updateServerTimer
function updateServerTimer(id) {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!token) {
        console.error('CSRF token not found');
        return;
    }

    fetch(`/bermain/update-timer/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const row = document.querySelector(`tr[data-id="${id}"]`);
        const statusElement = row.querySelector('.status-badge');
        const timerElement = row.querySelector('.timer');

        if (data.status === 'playing') {
            statusElement.textContent = 'Bermain';
            statusElement.className = 'status-badge playing dark:bg-opacity-10';

            // Reinitialize timer dengan status baru
            if (timers[id]) {
                clearInterval(timers[id]);
            }
            initializeTimer(id, data.remaining_time, 'playing', null);

        } else if (data.status === 'finished') {
            statusElement.textContent = 'Selesai';
            statusElement.className = 'status-badge finished dark:bg-opacity-10';
            timerElement.textContent = 'Selesai';

            if (timers[id]) {
                clearInterval(timers[id]);
            }
        }
    })
    .catch(error => {
        console.error('Error updating timer:', error);
    });
}

// Update click handlers untuk filter buttons
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Update active state untuk semua button
        document.querySelectorAll('.filter-btn').forEach(btn => {
            // Reset semua button ke state default
            btn.className = 'filter-btn px-4 py-2 rounded-lg bg-white text-bgray-600 dark:bg-darkblack-500 dark:text-gray-300';
        });

        // Set active state untuk button yang diklik
        this.className = 'filter-btn px-4 py-2 rounded-lg bg-success-300 text-white';

        // Update current status dan refresh table
        currentStatus = this.dataset.status;
        currentPage = 1; // Reset ke halaman pertama saat filter berubah
        updateTable(document.getElementById('searchInput').value);
    });
});

function initializeAllTimers() {
    // Bersihkan timer yang ada
    Object.keys(timers).forEach(id => {
        clearInterval(timers[id]);
        delete timers[id];
    });

    document.querySelectorAll('tr[data-id]').forEach(row => {
        const id = row.dataset.id;
        const statusBadge = row.querySelector('.status-badge');
        const timerElement = row.querySelector('.timer');

        if (!statusBadge || !timerElement) return;

        let status;
        if (statusBadge.classList.contains('playing')) status = 'playing';
        else if (statusBadge.classList.contains('waiting')) status = 'waiting';
        else status = 'finished';

        const remainingTime = parseInt(timerElement.dataset.remaining || 0);
        const selectedDateTime = timerElement.dataset.selectedDateTime;

        // Cek state yang tersimpan
        const savedState = getTimerState(id);
        if (savedState && status === 'playing') {
            initializeTimer(id, savedState.remaining, status, selectedDateTime);
        } else {
            initializeTimer(id, remainingTime, status, selectedDateTime);
        }
    });
}

// Tambahkan event listener untuk page visibility
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        // Reinisialisasi semua timer saat halaman kembali visible
        initializeAllTimers();
    }
});

// Pastikan inisialisasi timer saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    initializeAllTimers();
    updatePaginationButtons();
    updateRealTimeClock();
});

function calculatePrice(duration, needSocks) {
    let price = 0;
    duration = parseInt(duration) || 0;

    // Hitung harga bermain dengan harga yang diperbarui
    switch(duration) {
        case 1: price = 15000; break;
        case 2: price = 30000; break;
        case 3: price = 35000; break;
        case 6: price = 45000; break; // Tambahan untuk sepuasnya (6 jam)
    }

    // Tambah harga kaos kaki jika diperlukan
    if (needSocks) {
        price += 5000;
    }

    return price;
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(amount);
}

function generateInvoicePDF(id, name, age, day, startDateTime, duration, needSocks) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Warna yang lebih soft
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

    // Background putih (default)
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
    doc.text('INVOICE BERMAIN', 190, 25, { align: 'right' });

    // Informasi Invoice
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Kolom Kiri
    doc.text('Ditagihkan Kepada:', 20, 50);
    doc.setFont('helvetica', 'bold');
    doc.text(name, 20, 57);
    doc.setFont('helvetica', 'normal');
    doc.text(`Usia: ${age} tahun`, 20, 64);
    doc.text(`Hari: ${day}`, 20, 71);
    doc.text(`Waktu: ${new Date(startDateTime).toLocaleTimeString('id-ID')}`, 20, 78);

    // Kolom Kanan
    doc.text('No. Invoice:', 140, 50);
    doc.text('Tanggal:', 140, 57);
    doc.text('Status:', 140, 64);

    doc.setFont('helvetica', 'bold');
    doc.text(`INV-${id}`, 190, 50, { align: 'right' });
    doc.text(new Date().toLocaleDateString('id-ID'), 190, 57, { align: 'right' });

    // Status dengan warna hijau
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

    // Tentukan harga berdasarkan durasi
    let durPrice = 0;
    switch(parseInt(duration)) {
        case 1: durPrice = 15000; break;
        case 2: durPrice = 30000; break;
        case 3: durPrice = 35000; break;
        case 6: durPrice = 45000; break; // Sepuasnya (6 jam)
        default: durPrice = 0;
    }

    // Format harga dengan pemisah ribuan
    const formattedDurPrice = durPrice.toLocaleString('id-ID');

    // Detail bermain
    doc.text(`Bermain ${duration} Jam${parseInt(duration) == 6 ? ' (Sepuasnya)' : ''}`, 25, yPos);
    doc.text(`Rp ${formattedDurPrice}`, 180, yPos, { align: 'right' });

    yPos += 20;

    // Kaos kaki jika ada
    if (needSocks) {
        doc.text('Kaos Kaki', 25, yPos);
        doc.text('Rp 15.000', 180, yPos, { align: 'right' });
        yPos += 15;
    }

    // Area Total
    doc.setFillColor(249, 250, 251);
    doc.rect(20, yPos, 170, 25, 'F');

    // Garis tipis di atas total
    doc.setDrawColor(230, 230, 230);
    doc.line(20, yPos, 190, yPos);

    yPos += 16;

    // Total dengan style yang lebih bold
    let totalPrice = durPrice;
    if (needSocks) totalPrice += 15000;

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(12);
    doc.text('TOTAL', 25, yPos);
    doc.text(`Rp ${totalPrice.toLocaleString('id-ID')}`, 180, yPos, { align: 'right' });

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
    doc.save(`Invoice-Bermain-${name}-${formattedDate}.pdf`);
}

// Tambahkan fungsi untuk mendapatkan waktu real-time
function updateRealTimeClock() {
    const clockElement = document.getElementById('realTimeClock');
    if (clockElement) {
        setInterval(() => {
            const now = new Date();
            clockElement.textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }, 1000);
    }
}

// Update fungsi showAlert untuk mendukung dark mode
function showAlert(message, type = 'success') {
    const modalHtml = `
        <div id="alertModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/30 dark:bg-white/10 backdrop-blur-sm"></div>
            <div class="relative bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl p-6 w-96 max-w-md transform transition-all animate-modal-pop">
                <div class="text-center">
                    ${type === 'success'
                        ? '<svg class="mx-auto mb-4 w-14 h-14 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                        : '<svg class="mx-auto mb-4 w-14 h-14 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                    }
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        ${type === 'success' ? 'Berhasil!' : 'Gagal!'}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-5">${message}</p>
                    <button onclick="closeAlertModal()"
                            class="px-4 py-2 bg-gray-100 dark:bg-darkblack-500 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-darkblack-400 transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHtml);

    setTimeout(closeAlertModal, 3000);
}

function closeAlertModal() {
    const modal = document.getElementById('alertModal');
    if (modal) {
        modal.classList.add('fade-out');
        setTimeout(() => modal.remove(), 300);
    }
}

// Tambahkan script untuk export Excel
document.addEventListener('DOMContentLoaded', function() {
    // Update tombol export saat status atau search berubah
    function updateExportUrl() {
        const exportBtn = document.getElementById('exportExcel');
        if (exportBtn) {
            let url = '{{ route("bermain.export") }}';
            let params = new URLSearchParams();

            // Tambahkan parameter status jika bukan 'all'
            if (currentStatus !== 'all') {
                params.append('status', currentStatus);
            }

            // Tambahkan parameter search jika ada
            const searchValue = document.getElementById('searchInput').value;
            if (searchValue) {
                params.append('search', searchValue);
            }

            // Tambahkan params ke URL
            const queryString = params.toString();
            if (queryString) {
                url += '?' + queryString;
            }

            exportBtn.href = url;
        }
    }

    // Tambahkan event listener ke filter button
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', updateExportUrl);
    });

    // Tambahkan event listener ke search input
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                updateExportUrl();
            }, 300);
        });
    }

    // Set URL awal
    updateExportUrl();
});
</script>
@endpush
