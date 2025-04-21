@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Konten Home</h1>
        <a href="{{ route('home-content.edit', $content) }}"
           class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300">
            Edit Konten
        </a>
    </div>

    <div class="bg-white dark:bg-darkblack-500 rounded-lg shadow-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Deskripsi</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $content->description }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Gambar</h2>
                @if($content->image)
                    <div class="relative w-full h-64">
                        <img src="{{ asset('storage/' . $content->image) }}"
                             alt="Home Content Image"
                             class="absolute inset-0 w-full h-full object-cover rounded-lg"
                             onerror="this.onerror=null; this.src='{{ asset('images/assets/img_faq.png') }}';">
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada gambar</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
