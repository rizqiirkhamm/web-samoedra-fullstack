@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto border dark:border-darkblack-400 p-6 rounded-xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-bgray-900 dark:text-bgray-50">Tambah FAQ Baru</h1>
        </div>

        <form action="{{ route('faq.store') }}" method="POST" class="bg-white dark:bg-darkblack-600 rounded-lg shadow p-8">
            @csrf

            <div class="mb-4">
                <label for="pertanyaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pertanyaan</label>
                <input type="text" name="pertanyaan" id="pertanyaan" value="{{ old('pertanyaan') }}"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>
                @error('pertanyaan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jawaban" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jawaban</label>
                <textarea name="jawaban" id="jawaban" rows="4"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>{{ old('jawaban') }}</textarea>
                @error('jawaban')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="urutan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Urutan</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" min="0"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>
                @error('urutan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('faq.admin.index') }}"
                   class="px-4 py-2 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-darkblack-500 transition-all duration-300">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-[#22C55E] text-white rounded-lg hover:bg-[#16A34A] transition-all duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
