@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-bgray-900 dark:text-bgray-50">Edit Statistik {{ ucfirst($kategori) }}</h1>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow p-6">
            <form action="{{ route('statistik.update', $kategori) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Judul</label>
                    <input type="text" name="judul" id="judul" value="{{ $statistik->{$kategori.'_title'} }}"
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                        required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ $statistik->$kategori }}" min="0"
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                        required>
                    @error('jumlah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                        required>{{ $statistik->{$kategori.'_description'} }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('statistik.index') }}"
                       class="px-4 py-2 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-darkblack-500 transition-all duration-300">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
