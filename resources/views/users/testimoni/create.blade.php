@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#3E5467]">Tambah Testimoni Baru</h1>
        </div>

        <form action="{{ route('testimoni.store') }}" method="POST" class="bg-white dark:bg-darkblack-600 rounded-lg shadow p-6" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="testimoni" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Testimoni</label>
                <textarea name="testimoni" id="testimoni" rows="4"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>{{ old('testimoni') }}</textarea>
                @error('testimoni')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto</label>
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-100 dark:bg-darkblack-500 flex items-center justify-center border-2 border-dashed border-gray-300 dark:border-darkblack-400">
                        <img id="preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                        <svg id="default-icon" class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="relative">
                            <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(this)"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 flex items-center justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Pilih foto...</span>
                                <button type="button" class="px-4 py-2 bg-gray-200 dark:bg-darkblack-400 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-darkblack-300 transition-all duration-300">
                                    Pilih File
                                </button>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Format: JPEG, PNG, JPG, GIF. Maksimal: 2MB</p>
                    </div>
                </div>
                @error('foto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="urutan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Urutan</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" min="0"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>
                @error('urutan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                    required>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('testimoni.index') }}"
                   class="px-6 py-2.5 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-darkblack-500 transition-all duration-300">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-[#4CAF50] text-white rounded-lg hover:bg-[#45a049] transition-all duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const defaultIcon = document.getElementById('default-icon');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            defaultIcon.classList.add('hidden');
        }

        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        defaultIcon.classList.remove('hidden');
    }
}
</script>
@endpush
@endsection
