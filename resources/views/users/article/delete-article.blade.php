@extends('users.layouts.app')

@section('title', 'Hapus Artikel')

@section('content')
<div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
    <div class="flex items-center justify-between gap-4 border-b border-bgray-200 pb-4">
        <h2 class="text-xl font-semibold text-bgray-800 dark:text-white">Konfirmasi Hapus Artikel</h2>
        <a href="{{ route('article.master') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300 dark:bg-darkblack-500 dark:text-gray-300 dark:hover:bg-darkblack-400">
            Kembali
        </a>
    </div>

    <div class="mt-8 flex flex-col items-center justify-center">
        <div class="max-w-md w-full bg-red-50 p-6 rounded-lg shadow-sm dark:bg-red-900/10">
            <div class="text-center mb-6">
                <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Anda yakin ingin menghapus artikel ini?</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Artikel "<span class="font-semibold">{{ $article->title }}</span>" akan dihapus secara permanen dan tidak dapat dikembalikan.
                </p>
            </div>

            <div class="bg-white dark:bg-darkblack-500 p-4 rounded-lg mb-6">
                <h4 class="font-medium text-gray-700 dark:text-gray-200 mb-2">Detail Artikel:</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex">
                        <span class="font-medium w-24 text-gray-500 dark:text-gray-400">Judul:</span>
                        <span class="text-gray-800 dark:text-white">{{ $article->title }}</span>
                    </li>
                    <li class="flex">
                        <span class="font-medium w-24 text-gray-500 dark:text-gray-400">Kategori:</span>
                        <span class="text-gray-800 dark:text-white">{{ $article->category }}</span>
                    </li>
                    <li class="flex">
                        <span class="font-medium w-24 text-gray-500 dark:text-gray-400">Dibuat pada:</span>
                        <span class="text-gray-800 dark:text-white">{{ $article->created_at->format('d M Y, H:i') }}</span>
                    </li>
                </ul>
            </div>

            <form action="{{ route('article.destroy', $article->id) }}" method="POST" class="flex flex-col md:flex-row gap-3 justify-center">
                @csrf
                @method('DELETE')

                <a href="{{ route('article.master') }}" class="py-2.5 px-6 rounded-lg border border-gray-300 text-gray-700 font-medium text-center hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-darkblack-500">
                    Batal
                </a>

                <button type="submit" class="py-2.5 px-6 rounded-lg bg-red-600 text-white font-medium text-center hover:bg-red-700">
                    Ya, Hapus Artikel
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
