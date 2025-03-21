@extends('users.layouts.app')

@section('title', 'Dashboard')

@section('content')


    <!-- write your code here-->
    <div class="2xl:flex 2xl:space-x-[48px]">
        <section class="mb-6 2xl:mb-0 2xl:flex-1">
            <!-- total widget-->
            <div class="mb-[24px] w-full">
                <div class="grid grid-cols-1 gap-[24px] lg:grid-cols-3">
                    <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex items-center space-x-[7px]">
                                <div class="icon">
                                    <span class="inline-block h-[38px] w-[38px] rounded-full bg-success-50 p-2">
                                        <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                    </span>
                                </div>
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total
                                    Daycare</span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between">
                            <div class="flex-1">
                                <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                    {{ $totalDaycare }}
                                </p>
                                <div class="flex items-center space-x-1">
                                    <span class="text-sm font-medium text-success-300">
                                        + {{ number_format($daycareGrowth, 1) }}%
                                    </span>
                                    <span class="text-sm font-medium text-bgray-700 dark:text-bgray-50">
                                        dari minggu lalu
                                    </span>
                                </div>
                            </div>
                            <div class="w-[106px]">
                                <canvas id="totalEarn" height="68"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex items-center space-x-[7px]">
                                <div class="icon">
                                    <span class="inline-block h-[38px] w-[38px] rounded-full bg-warning-50 p-2">
                                        <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                    </span>
                                </div>
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total
                                    Bimbel</span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between">
                            <div class="flex-1">
                                <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                    {{ $totalBimbel }}
                                </p>
                                <div class="flex items-center space-x-1">
                                    @if($bimbelGrowth > 0)
                                        <span class="text-sm font-medium text-success-300">
                                            + {{ number_format($bimbelGrowth, 1) }}%
                                        </span>
                                    @else
                                        <span class="text-sm font-medium text-danger-300">
                                            {{ number_format($bimbelGrowth, 1) }}%
                                        </span>
                                    @endif
                                    <span class="text-sm font-medium text-bgray-700 dark:text-bgray-50">
                                        dari minggu lalu
                                    </span>
                                </div>
                            </div>
                            <div class="w-[106px]">
                                <canvas id="totalSpending" height="68"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex items-center space-x-[7px]">
                                <div class="icon">
                                    <span class="inline-block h-[38px] w-[38px] rounded-full bg-primary-50 p-2">
                                        <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                    </span>
                                </div>
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total
                                    Bermain</span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between">
                            <div class="flex-1">
                                <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                    {{ $totalBermain }}
                                </p>
                                <div class="flex items-center space-x-1">
                                    @if($bermainGrowth > 0)
                                        <span class="text-sm font-medium text-success-300">
                                            + {{ number_format($bermainGrowth, 1) }}%
                                        </span>
                                    @else
                                        <span class="text-sm font-medium text-danger-300">
                                            {{ number_format($bermainGrowth, 1) }}%
                                        </span>
                                    @endif
                                    <span class="text-sm font-medium text-bgray-700 dark:text-bgray-50">
                                        dari minggu lalu
                                    </span>
                                </div>
                            </div>
                            <div class="w-[106px]">
                                <canvas id="totalGoal" height="68"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg bg-white p-5 dark:bg-darkblack-600">
                        <div class="mb-5 flex items-center justify-between">
                            <div class="flex items-center space-x-[7px]">
                                <div class="icon">
                                    <span class="inline-block h-[38px] w-[38px] rounded-full bg-success-50 p-2">
                                        <img src="{{asset('/images/icons/total-earn.svg')}}" alt="icon" />
                                    </span>
                                </div>
                                <span class="text-lg font-semibold text-bgray-900 dark:text-white">Total
                                    Event
                                </span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between">
                            <div class="flex-1">
                                <p class="text-3xl font-bold leading-[48px] text-bgray-900 dark:text-white">
                                    40
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
                                    <span class="text-sm font-medium text-bgray-700 dark:text-bgray-50">
                                        from last week
                                    </span>
                                </div>
                            </div>
                            <div class="w-[106px]">
                                <canvas id="totalGoal" height="68"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- revenue, flow -->
            <div class="mb-[24px] w-full xl:flex xl:space-x-[24px]">
                <div
                    class="flex w-full flex-col justify-between rounded-lg bg-white px-[24px] py-3 dark:bg-darkblack-600 xl:w-66">
                    <div
                        class="mb-2 flex items-center justify-between border-b border-bgray-300 pb-2 dark:border-darkblack-400">
                        <h3 class="text-xl font-bold text-bgray-900 dark:text-white sm:text-2xl">
                            Sirkulasi Pendapatan
                        </h3>
                        <div class="hidden items-center space-x-[28px] sm:flex">
                            <div class="flex items-center space-x-2">
                                <div class="h-3 w-3 rounded-full bg-warning-300"></div>
                                <span class="text-sm font-medium text-bgray-700 dark:text-bgray-50">Dalam Proses
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="h-3 w-3 rounded-full bg-success-300"></div>
                                <span class="text-sm font-medium text-bgray-700 dark:text-bgray-50">Pemasukan
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="h-3 w-3 rounded-full bg-orange"></div>
                                <span class="text-sm font-medium text-bgray-700 dark:text-bgray-50">Pengeluaran
                                </span>
                            </div>
                        </div>
                        <div class="date-filter relative">
                            <button onclick="dateFilterAction('#date-filter-body')" type="button"
                                class="flex items-center space-x-1 overflow-hidden rounded-lg bg-bgray-100 px-3 py-2 dark:bg-darkblack-500 dark:text-white">
                                <span class="text-sm font-medium text-bgray-900 dark:text-white">Jan 10
                                    -
                                    Jan 16</span>
                                <span>
                                    <svg class="stroke-bgray-900 dark:stroke-gray-50" width="16" height="17"
                                        viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 6.5L8 10.5L12 6.5" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </button>
                            <div id="date-filter-body"
                                class="absolute right-0 top-[44px] z-10 hidden overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                                <ul>
                                    <li onclick="dateFilterAction('#date-filter-body')"
                                        class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                        Jan 10 - Jan 16
                                    </li>
                                    <li onclick="dateFilterAction('#date-filter-body')"
                                        class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                        Jan 10 - Jan 16
                                    </li>
                                    <li onclick="dateFilterAction('#date-filter-body')"
                                        class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                        Jan 10 - Jan 16
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <canvas id="revenueFlow" height="255"></canvas>
                    </div>
                </div>
                <div class="hidden flex-1 xl:block">
                    <div class="rounded-lg bg-white dark:bg-darkblack-600">
                        <div
                            class="flex items-center justify-between border-b border-bgray-300 px-[20px] py-[12px] dark:border-darkblack-400">
                            <h3 class="text-xl font-bold text-bgray-900 dark:text-white">
                                Efisiensi
                            </h3>
                            <div class="date-filter relative">
                                <button onclick="dateFilterAction('#month-filter')" type="button"
                                    class="flex items-center space-x-1">
                                    <span class="text-base font-semibold text-bgray-900 dark:text-white">Bulanan</span>
                                    <span>
                                        <svg class="stroke-bgray-900 dark:stroke-bgray-50" width="16" height="17"
                                            viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 6.5L8 10.5L12 6.5" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>
                                <div id="month-filter"
                                    class="absolute right-0 top-5 z-10 hidden overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                                    <ul>
                                        <li onclick="dateFilterAction('#month-filter')"
                                            class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                            Januari
                                        </li>
                                        <li onclick="dateFilterAction('#month-filter')"
                                            class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                            Febuari
                                        </li>

                                        <li onclick="dateFilterAction('#month-filter')"
                                            class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                            Maret
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="px-[20px] py-[12px]">
                            <div class="mb-4 flex items-center space-x-8">
                                <div class="relative w-[180px]">
                                    <canvas id="pie_chart" height="168"></canvas>
                                    <div class="absolute z-0 h-[34px] w-[34px] rounded-full bg-[#EDF2F7]" style="
                                left: calc(50% - 17px);
                                top: calc(50% - 17px);
                              "></div>
                                </div>
                                <div class="counting">
                                    <div class="mb-6">
                                        <div class="flex items-center space-x-[2px]">
                                            <p class="text-lg font-bold text-success-300">
                                              15.500.000
                                            </p>
                                            <span><svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M10.7749 0.558058C10.5309 0.313981 10.1351 0.313981 9.89107 0.558058L7.39107 3.05806C7.14699 3.30214 7.14699 3.69786 7.39107 3.94194C7.63514 4.18602 8.03087 4.18602 8.27495 3.94194L9.70801 2.50888V11C9.70801 11.3452 9.98783 11.625 10.333 11.625C10.6782 11.625 10.958 11.3452 10.958 11V2.50888L12.3911 3.94194C12.6351 4.18602 13.0309 4.18602 13.2749 3.94194C13.519 3.69786 13.519 3.30214 13.2749 3.05806L10.7749 0.558058Z"
                                                        fill="#22C55E" />
                                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.22407 11.4419C3.46815 11.686 3.86388 11.686 4.10796 11.4419L6.60796 8.94194C6.85203 8.69786 6.85203 8.30214 6.60796 8.05806C6.36388 7.81398 5.96815 7.81398 5.72407 8.05806L4.29102 9.49112L4.29101 1C4.29101 0.654823 4.01119 0.375001 3.66602 0.375001C3.32084 0.375001 3.04102 0.654823 3.04102 1L3.04102 9.49112L1.60796 8.05806C1.36388 7.81398 0.968151 7.81398 0.724074 8.05806C0.479996 8.30214 0.479996 8.69786 0.724074 8.94194L3.22407 11.4419Z"
                                                        fill="#22C55E" />
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="text-base font-medium text-bgray-600">
                                            Arrival
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-[2px]">
                                            <p class="text-lg font-bold text-bgray-900 dark:text-white">
                                                16.042.124
                                            </p>
                                            <span>
                                                <svg class="fill-bgray-900 dark:fill-bgray-50" width="14" height="12"
                                                    viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M10.7749 0.558058C10.5309 0.313981 10.1351 0.313981 9.89107 0.558058L7.39107 3.05806C7.14699 3.30214 7.14699 3.69786 7.39107 3.94194C7.63514 4.18602 8.03087 4.18602 8.27495 3.94194L9.70801 2.50888V11C9.70801 11.3452 9.98783 11.625 10.333 11.625C10.6782 11.625 10.958 11.3452 10.958 11V2.50888L12.3911 3.94194C12.6351 4.18602 13.0309 4.18602 13.2749 3.94194C13.519 3.69786 13.519 3.30214 13.2749 3.05806L10.7749 0.558058Z" />
                                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.22407 11.4419C3.46815 11.686 3.86388 11.686 4.10796 11.4419L6.60796 8.94194C6.85203 8.69786 6.85203 8.30214 6.60796 8.05806C6.36388 7.81398 5.96815 7.81398 5.72407 8.05806L4.29102 9.49112L4.29101 1C4.29101 0.654823 4.01119 0.375001 3.66602 0.375001C3.32084 0.375001 3.04102 0.654823 3.04102 1L3.04102 9.49112L1.60796 8.05806C1.36388 7.81398 0.968151 7.81398 0.724074 8.05806C0.479996 8.30214 0.479996 8.69786 0.724074 8.94194L3.22407 11.4419Z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="text-base font-medium text-bgray-600 dark:text-bgray-50">
                                            Bimbel
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="status">
                                <div class="mb-1.5 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-2.5 w-2.5 rounded-full bg-success-300"></div>
                                        <span class="text-sm font-medium text-bgray-600 dark:text-bgray-50">Daycare</span>
                                    </div>
                                    <p class="text-sm font-bold text-bgray-900 dark:text-bgray-50">
                                        13%
                                    </p>
                                </div>
                                <div class="mb-1.5 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-2.5 w-2.5 rounded-full bg-warning-300"></div>
                                        <span class="text-sm font-medium text-bgray-600 dark:text-white">Bermain</span>
                                    </div>
                                    <p class="text-sm font-bold text-bgray-900 dark:text-bgray-50">
                                        28%
                                    </p>
                                </div>
                                <div class="mb-1.5 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-2.5 w-2.5 rounded-full bg-bgray-200"></div>
                                        <span class="text-sm font-medium text-bgray-600 dark:text-white">Others</span>
                                    </div>
                                    <p class="text-sm font-bold text-bgray-900 dark:text-bgray-50">
                                        59%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Users Table -->
            <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
                <div class="flex flex-col space-y-5">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-bgray-900 dark:text-white">
                            Pengguna Terbaru
                        </h3>
                        <a href="{{ route('user.list') }}" class="text-sm text-success-300 hover:text-success-400">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="table-content w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                    <th class="px-6 py-5 text-left">
                                        <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Nama</span>
                                    </th>
                                    <th class="px-6 py-5 text-left">
                                        <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Email</span>
                                    </th>
                                    <th class="px-6 py-5 text-left">
                                        <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Role</span>
                                    </th>
                                    <th class="px-6 py-5 text-left">
                                        <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Bergabung</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecord as $user)
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-base font-medium text-bgray-900 dark:text-white">
                                                {{ $user->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $user->email }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-block rounded-full bg-success-50 px-3 py-1 text-sm font-medium text-success-300">
                                            {{ $user->role_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-base text-bgray-900 dark:text-white">
                                            {{ $user->created_at->diffForHumans() }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-5 text-center text-gray-500">
                                        Tidak ada data pengguna
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Dashboard specific scripts -->
<script src="{{ asset('js/dashboard-users.js') }}"></script>
@endpush
