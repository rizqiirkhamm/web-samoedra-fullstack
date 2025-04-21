@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#3E5467]">Statistik</h1>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div class="p-4 bg-gray-50 dark:bg-darkblack-500 rounded-lg">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $statistik->daycare_title }}</label>
                                <p class="text-2xl font-bold text-[#3E5467]">{{ $statistik->daycare }}</p>
                            </div>
                            <a href="{{ route('statistik.edit', 'daycare') }}"
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 font-medium">
                                Edit
                            </a>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $statistik->daycare_description }}</p>
                    </div>

                    <div class="p-4 bg-gray-50 dark:bg-darkblack-500 rounded-lg">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $statistik->bermain_title }}</label>
                                <p class="text-2xl font-bold text-[#3E5467]">{{ $statistik->bermain }}</p>
                            </div>
                            <a href="{{ route('statistik.edit', 'bermain') }}"
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 font-medium">
                                Edit
                            </a>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $statistik->bermain_description }}</p>
                    </div>

                    <div class="p-4 bg-gray-50 dark:bg-darkblack-500 rounded-lg">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $statistik->bimbel_title }}</label>
                                <p class="text-2xl font-bold text-[#3E5467]">{{ $statistik->bimbel }}</p>
                            </div>
                            <a href="{{ route('statistik.edit', 'bimbel') }}"
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 font-medium">
                                Edit
                            </a>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $statistik->bimbel_description }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="p-4 bg-gray-50 dark:bg-darkblack-500 rounded-lg">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $statistik->stimulasi_title }}</label>
                                <p class="text-2xl font-bold text-[#3E5467]">{{ $statistik->stimulasi }}</p>
                            </div>
                            <a href="{{ route('statistik.edit', 'stimulasi') }}"
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 font-medium">
                                Edit
                            </a>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $statistik->stimulasi_description }}</p>
                    </div>

                    <div class="p-4 bg-gray-50 dark:bg-darkblack-500 rounded-lg">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $statistik->event_title }}</label>
                                <p class="text-2xl font-bold text-[#3E5467]">{{ $statistik->event }}</p>
                            </div>
                            <a href="{{ route('statistik.edit', 'event') }}"
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 font-medium">
                                Edit
                            </a>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $statistik->event_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
