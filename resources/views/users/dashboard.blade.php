@extends('users.layouts.app')

@section('title', 'Dashboard')

@push('head')
<!-- Tambahkan Chart.js dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <div class="container px-4 2xl:flex">
        <section class="mb-6 2xl:mb-0 2xl:flex-1">
            <!-- total widget -->
            <div class="mb-[24px] w-full">
                <div class="grid grid-cols-1 gap-[24px] lg:grid-cols-5">
                    <!-- Total Daycare Card -->
                    <div class="rounded-xl bg-white p-6 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="inline-block p-4 rounded-lg bg-success-50">
                                    <svg class="w-8 h-8 text-success-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Daycare</p>
                                    <h3 class="text-2xl font-bold text-bgray-900 dark:text-white mt-1">{{ $totalDaycare }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Bimbel Card -->
                    <div class="rounded-xl bg-white p-6 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="inline-block p-4 rounded-lg bg-yellow-50">
                                    <svg class="w-8 h-8 text-warning-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Bimbel</p>
                                    <h3 class="text-2xl font-bold text-bgray-900 dark:text-white mt-1">{{ $totalBimbel }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Bermain Card -->
                    <div class="rounded-xl bg-white p-6 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="inline-block p-4 rounded-lg bg-indigo-50">
                                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Bermain</p>
                                    <h3 class="text-2xl font-bold text-bgray-900 dark:text-white mt-1">{{ $totalBermain }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Stimulasi Card -->
                    <div class="rounded-xl bg-white p-6 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="inline-block p-4 rounded-lg bg-purple-50">
                                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Stimulasi</p>
                                    <h3 class="text-2xl font-bold text-bgray-900 dark:text-white mt-1">{{ $totalStimulasi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Event Card -->
                    <div class="rounded-xl bg-white p-6 dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="inline-block p-4 rounded-lg bg-pink-50">
                                    <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Event</p>
                                    <h3 class="text-2xl font-bold text-bgray-900 dark:text-white mt-1">{{ $totalEvent }}</h3>
                                </div>
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
                            Tingkat Bergabung Mingguan
                        </h3>
                    </div>
                    <div class="w-full">
                        <canvas id="weeklyJoinRate" height="255"></canvas>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Weekly Join Rate Chart
    const weeklyJoinCtx = document.getElementById('weeklyJoinRate');
    if (weeklyJoinCtx) {
        new Chart(weeklyJoinCtx, {
            type: 'bar',
            data: {
                labels: @json($weeklyData['labels']),
                datasets: [
                    {
                        label: 'Daycare',
                        data: @json($weeklyData['daycare']),
                        backgroundColor: '#22C55E', // Hijau
                        borderRadius: 6,
                    },
                    {
                        label: 'Bimbel',
                        data: @json($weeklyData['bimbel']),
                        backgroundColor: '#F59E0B', // Orange
                        borderRadius: 6,
                    },
                    {
                        label: 'Bermain',
                        data: @json($weeklyData['bermain']),
                        backgroundColor: '#3B82F6', // Biru
                        borderRadius: 6,
                    },
                    {
                        label: 'Stimulasi',
                        data: @json($weeklyData['stimulasi']),
                        backgroundColor: '#A855F7', // Ungu
                        borderRadius: 6,
                    },
                    {
                        label: 'Event',
                        data: @json($weeklyData['event']),
                        backgroundColor: '#EC4899', // Pink
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#9CA3AF'
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#9CA3AF'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#9CA3AF',
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                return `${context.dataset.label}: ${context.parsed.y} pendaftar`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Mini Charts untuk setiap card
    const cardChartOptions = {
        type: 'line',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { display: false },
                y: { display: false }
            },
            elements: {
                line: {
                    tension: 0.4,
                    borderWidth: 2,
                },
                point: {
                    radius: 0
                }
            }
        }
    };

    // Inisialisasi mini charts jika ada
    ['totalEarn', 'totalSpending', 'totalGoal'].forEach(chartId => {
        const ctx = document.getElementById(chartId);
        if (ctx) {
            new Chart(ctx, {
                ...cardChartOptions,
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        data: [20, 40, 30, 50, 40, 60],
                        borderColor: chartId === 'totalEarn' ? '#22C55E' :
                                   chartId === 'totalSpending' ? '#F59E0B' : '#3B82F6',
                        fill: false
                    }]
                }
            });
        }
    });
});
</script>
@endpush