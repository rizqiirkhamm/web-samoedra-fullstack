@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Edit Konten Home</h1>
        <a href="{{ route('home-content.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-300">
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-darkblack-500 rounded-lg shadow-lg p-6">
        <form action="{{ route('home-content.update', $content) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkblack-500 dark:text-gray-200"
                        required>{{ old('description', $content->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nomor Telepon
                    </label>
                    <input type="text" id="phone_number" name="phone_number"
                        value="{{ old('phone_number', $content->phone_number) }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkblack-500 dark:text-gray-200"
                        required>
                    @error('phone_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link WhatsApp -->
                <div>
                    <label for="phone_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Link WhatsApp
                    </label>
                    <input type="text" id="phone_link" name="phone_link"
                        value="{{ old('phone_link', $content->phone_link) }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkblack-500 dark:text-gray-200"
                        required>
                    @error('phone_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Gambar
                    </label>
                    @if($content->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $content->image) }}"
                                 alt="Current Image"
                                 class="w-64 h-64 object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" id="image" name="image"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkblack-500 dark:text-gray-200"
                        accept="image/*">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
