@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-darkblack-600 rounded-lg shadow-md card border dark:border-darkblack-400">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Ganti Password</h2>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Saat Ini</label>
                    <input type="password"
                           name="current_password"
                           class="w-full px-3 py-2 bg-white dark:bg-darkblack-500 border border-gray-300 dark:border-darkblack-400 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-success-300">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Baru</label>
                    <input type="password"
                           name="password"
                           class="w-full px-3 py-2 bg-white dark:bg-darkblack-500 border border-gray-300 dark:border-darkblack-400 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-success-300">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password Baru</label>
                    <input type="password"
                           name="password_confirmation"
                           class="w-full px-3 py-2 bg-white dark:bg-darkblack-500 border border-gray-300 dark:border-darkblack-400 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-success-300">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 bg-success-300 text-white rounded-md hover:bg-success-400 focus:outline-none focus:ring-2 focus:ring-success-300">
                        Simpan Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection