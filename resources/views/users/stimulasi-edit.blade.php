@extends('users.layouts.app')

@section('title', 'Edit Kelas Stimulasi')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<style>
    .image-preview {
        max-width: 200px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-900 dark:border dark:border-white dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0">
                    <div class="flex items-center justify-between">
                        <h6 class="dark:text-white">Edit Halaman Kelas Stimulasi</h6>
                    </div>
                </div>

                <div class="flex-auto p-6">
                    @if (session('success'))
                    <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-success" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>
                        <span class="sr-only">Error</span>
                        <div class="ms-3 text-sm font-medium">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-error" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endif

                    <form action="{{ route('stimulasi.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Jenis Banner</label>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_image" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ isset($stimulasiData['banner_type']) && $stimulasiData['banner_type'] == 'image' ? 'checked' : '' }}>
                                        <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gambar</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_video" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ isset($stimulasiData['banner_type']) && $stimulasiData['banner_type'] == 'video' ? 'checked' : '' }}>
                                        <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Video YouTube</label>
                                    </div>
                                </div>
                            </div>

                            <div id="banner_image_container" class="mb-4 {{ isset($stimulasiData['banner_type']) && $stimulasiData['banner_type'] == 'image' ? '' : 'hidden' }}">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Banner</label>
                                <div class="flex items-center space-x-4">
                                    @if(isset($stimulasiData['banner_image']))
                                    <img src="{{ asset($stimulasiData['banner_image']) }}" alt="Banner Preview" class="image-preview mb-2">
                                    @else
                                    <img src="{{ asset('@img.png') }}" alt="Banner Preview" class="image-preview mb-2">
                                    @endif
                                    <input type="file" name="banner_image" id="banner_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                            </div>

                            <div id="banner_video_container" class="mb-4 {{ isset($stimulasiData['banner_type']) && $stimulasiData['banner_type'] == 'video' ? '' : 'hidden' }}">
                                <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Video YouTube</label>
                                <input type="text" name="banner_video" id="banner_video" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=..." value="{{ $stimulasiData['banner_video'] ?? '' }}">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">About Kelas Stimulasi</h2>

                            <div class="bg-white p-4 rounded-lg drop-shadow-sm mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="age_range" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Rentang Usia</label>
                                        <input type="text" id="age_range" name="age_range" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $stimulasiData['age_range'] ?? '' }}">
                                    </div>
                                    <div>
                                        <label for="hours" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Jam Operasional</label>
                                        <input type="text" id="hours" name="hours" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $stimulasiData['hours'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="days" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Hari</label>
                                    <input type="text" id="days" name="days" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $stimulasiData['days'] ?? '' }}">
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Apa itu Kelas Stimulasi</label>
                                    <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $stimulasiData['description'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Program Kelas Stimulasi Rumah Samoedra</h2>

                                <div class="mb-4">
                                    <label for="program_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Program</label>
                                    <input type="text" name="program_title" id="program_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $stimulasiData['program_title'] ?? 'Kelas Stimulasi Di Rumah Samoedra' }}">
                                </div>

                                <div class="mb-4">
                                    <label for="program_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Program</label>
                                    <textarea name="program_description" id="program_description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $stimulasiData['program_description'] ?? 'Kelas Stimulasi Rumah Samoedra dirancang untuk mendukung tumbuh kembang anak melalui aktivitas bermain yang menyenangkan dan penuh makna. Kami percaya setiap anak itu unik, dan melalui kelas ini, mereka diajak belajar, bermain, dan tumbuh bersama dalam lingkungan yang aman dan penuh kasih. Yuk, kenalkan si kecil pada dunia belajar yang seru dan interaktif bersama Rumah Samoedra!' }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="program_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Program</label>
                                    <div class="flex items-center space-x-4">
                                        @if(isset($stimulasiData['program_image']))
                                        <img src="{{ asset($stimulasiData['program_image']) }}" alt="Program Preview" class="image-preview mb-2">
                                        @else
                                        <img src="{{ asset('images/assets/img_detail_layanan.png') }}" alt="Program Preview" class="image-preview mb-2">
                                        @endif
                                        <input type="file" name="program_image" id="program_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Ukuran yang direkomendasikan: 500 x 500 pixel</p>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Program Kelas Stimulasi</h2>
                                <div id="program_points_container">
                                    @if(isset($stimulasiData['program']['points']) && count($stimulasiData['program']['points']) > 0)
                                        @foreach($stimulasiData['program']['points'] as $index => $point)
                                        <div class="program-point-item mb-2 flex items-center gap-2">
                                            <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $point }}">
                                            <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="program-point-item mb-2 flex items-center gap-2">
                                            <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Pembelajaran melalui bermain">
                                            <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="program-point-item mb-2 flex items-center gap-2">
                                            <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Fokus pada perkembangan motorik">
                                            <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="program-point-item mb-2 flex items-center gap-2">
                                            <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Peningkatan kemampuan sosial">
                                            <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <button type="button" id="add_program_point" class="text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                        Tambah Program
                                    </button>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Kegiatan Kelas Stimulasi</h2>

                                <div class="mb-4">
                                    <label for="kegiatan_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Kegiatan</label>
                                    <input type="text" name="kegiatan_title" id="kegiatan_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $stimulasiData['kegiatan_title'] ?? 'Kegiatan Kelas Stimulasi Rumah Samoedra' }}">
                                </div>

                                <div class="mb-4">
                                    <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daftar Kegiatan</p>
                                    <div id="kegiatan_container">
                                        @if(isset($stimulasiData['kegiatan']) && count($stimulasiData['kegiatan']) > 0)
                                            @foreach($stimulasiData['kegiatan'] as $index => $item)
                                            <div class="kegiatan-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300">
                                                <div class="mb-3">
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                                                    <input type="text" name="kegiatan[{{$index}}][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $item['name'] }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                                    <textarea name="kegiatan[{{$index}}][description]" rows="3" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $item['description'] }}</textarea>
                                                </div>
                                                <div class="flex items-center justify-end">
                                                    <button type="button" class="remove-kegiatan text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                                                        Hapus Kegiatan
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="kegiatan-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300">
                                                <div class="mb-3">
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                                                    <input type="text" name="kegiatan[0][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="ADAPTASI SOSIAL">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                                    <textarea name="kegiatan[0][description]" rows="3" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">Diskusi tentang pengalaman bulan Puasa & Lebaran
⁠Praktik Bersalaman dan Bermaaf maafan
⁠Berkenalan dengan teman baru
Menjawab pertanyaan sederhana</textarea>
                                                </div>
                                                <div class="flex items-center justify-end">
                                                    <button type="button" class="remove-kegiatan text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                                                        Hapus Kegiatan
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="kegiatan-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300">
                                                <div class="mb-3">
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                                                    <input type="text" name="kegiatan[1][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="LOGIKA MATEMATIKA">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                                    <textarea name="kegiatan[1][description]" rows="3" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">⁠Meniru bentuk sebuah pola menggunakan stick
Belajar mengenal waktu Tahun, Bulan, Minggu, Hari, Jam menggunakan kalender dan jam dinding</textarea>
                                                </div>
                                                <div class="flex items-center justify-end">
                                                    <button type="button" class="remove-kegiatan text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                                                        Hapus Kegiatan
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" id="add_kegiatan" class="text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                            Tambah Kegiatan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Harga</h2>

                            <div class="mb-4">
                                <label for="pricelist_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Price List</label>
                                <input type="text" name="pricelist_title" id="pricelist_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $stimulasiData['pricelist_title'] ?? 'Price List Kelas Stimulasi' }}">
                            </div>

                            <div class="mb-4">
                                <label for="pricelist_subtitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subtitle Price List</label>
                                <input type="text" name="pricelist_subtitle" id="pricelist_subtitle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $stimulasiData['pricelist_subtitle'] ?? 'Pricelist' }}">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Default</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                        <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ isset($stimulasiData['price']) ? str_replace('Rp. ', '', $stimulasiData['price']) : '375.000' }}" placeholder="Masukkan harga">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Format: 375.000</p>
                                </div>
                                <div class="mb-4">
                                    <label for="meetings" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Pertemuan Default</label>
                                    <input type="text" name="meetings" id="meetings" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ isset($stimulasiData['meetings']) ? str_replace('x Pertemuan', '', $stimulasiData['meetings']) : '4' }}" placeholder="Contoh: 4">
                                    <p class="mt-1 text-xs text-gray-500">Format: 4 (akan otomatis ditambahkan 'x Pertemuan')</p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="registration_fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Pendaftaran Default</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                    <input type="text" name="registration_fee" id="registration_fee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ isset($stimulasiData['registration_fee']) ? str_replace('Rp. ', '', $stimulasiData['registration_fee']) : '50.000' }}" placeholder="Masukkan biaya pendaftaran">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Format: 50.000</p>
                            </div>

                            <div class="bg-white p-4 rounded-lg drop-shadow-sm mb-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-medium">Daftar Harga</h2>
                                    <button type="button" id="add_pricelist_item" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Tambah Item
                                    </button>
                                </div>

                                <div id="pricelist_items_container">
                                    @if(isset($stimulasiData['pricelist_items']) && is_array($stimulasiData['pricelist_items']))
                                        @foreach($stimulasiData['pricelist_items'] as $index => $item)
                                            <div class="pricelist-item bg-white p-4 rounded-lg mb-4 border border-gray-300">
                                                <div class="grid grid-cols-2 gap-4 mb-3">
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900">Layanan</label>
                                                        <input type="text" name="pricelist_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $item['title'] ?? '' }}">
                                                    </div>
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900">Usia</label>
                                                        <input type="text" name="pricelist_items[{{ $index }}][age_range]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $item['age_range'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-3 gap-4 mb-3">
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Pendaftaran</label>
                                                        <div class="relative">
                                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                                            <input type="text" name="pricelist_items[{{ $index }}][registration_fee]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="{{ preg_replace('/^Rp\.\s*/', '', $item['registration_fee'] ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                                                        <div class="relative">
                                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                                            <input type="text" name="pricelist_items[{{ $index }}][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="{{ preg_replace('/^Rp\.\s*/', '', $item['price'] ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block mb-1 text-sm font-medium text-gray-900">Pertemuan</label>
                                                        <input type="text" name="pricelist_items[{{ $index }}][meetings]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $item['meetings'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="button" class="remove-pricelist-item text-red-600 hover:text-red-800 px-2 py-1 rounded text-sm">Hapus Item</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <!-- Default pricelist items if none exist -->
                                        <div class="pricelist-item bg-white p-4 rounded-lg mb-4 border border-gray-300">
                                            <div class="grid grid-cols-2 gap-4 mb-3">
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Layanan</label>
                                                    <input type="text" name="pricelist_items[0][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="Kelas Stimulasi Reguler">
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Usia</label>
                                                    <input type="text" name="pricelist_items[0][age_range]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="3 - 6 tahun">
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-3 gap-4 mb-3">
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Pendaftaran</label>
                                                    <div class="relative">
                                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                                        <input type="text" name="pricelist_items[0][registration_fee]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="50.000">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                                                    <div class="relative">
                                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                                        <input type="text" name="pricelist_items[0][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="375.000">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Pertemuan</label>
                                                    <input type="text" name="pricelist_items[0][meetings]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="4x Pertemuan">
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="button" class="remove-pricelist-item text-red-600 hover:text-red-800 px-2 py-1 rounded text-sm">Hapus Item</button>
                                            </div>
                                        </div>
                                        <div class="pricelist-item bg-white p-4 rounded-lg mb-4 border border-gray-300">
                                            <div class="grid grid-cols-2 gap-4 mb-3">
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Layanan</label>
                                                    <input type="text" name="pricelist_items[1][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="Kelas Stimulasi Toddler">
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Usia</label>
                                                    <input type="text" name="pricelist_items[1][age_range]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="1 - 3 tahun">
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-3 gap-4 mb-3">
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Pendaftaran</label>
                                                    <div class="relative">
                                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                                        <input type="text" name="pricelist_items[1][registration_fee]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="50.000">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                                                    <div class="relative">
                                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                                                        <input type="text" name="pricelist_items[1][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="350.000">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block mb-1 text-sm font-medium text-gray-900">Pertemuan</label>
                                                    <input type="text" name="pricelist_items[1][meetings]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="4x Pertemuan">
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="button" class="remove-pricelist-item text-red-600 hover:text-red-800 px-2 py-1 rounded text-sm">Hapus Item</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Fasilitas Kelas Stimulasi</h2>

                            <div class="mb-4">
                                <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daftar Fasilitas</p>
                                <div id="fasilitas_container">
                                    @if(isset($stimulasiData['fasilitas']) && count($stimulasiData['fasilitas']) > 0)
                                        @foreach($stimulasiData['fasilitas'] as $index => $fasilitas)
                                        <div class="fasilitas-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300">
                                            <div class="mb-3">
                                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Fasilitas</label>
                                                <input type="text" name="fasilitas[{{$index}}][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $fasilitas['name'] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                                                <div class="flex items-center space-x-4">
                                                    @if(isset($fasilitas['image']))
                                                    <img src="{{ asset($fasilitas['image']) }}" alt="{{ $fasilitas['name'] }}" class="image-preview mb-2" style="max-width: 100px; max-height: 100px;">
                                                    @else
                                                    <div class="bg-gray-200 flex items-center justify-center mb-2" style="width: 100px; height: 100px;">
                                                        <span class="text-gray-500">No Image</span>
                                                    </div>
                                                    @endif
                                                    <input type="file" name="fasilitas_image[{{$index}}]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" accept="image/*">
                                                </div>
                                                <input type="hidden" name="fasilitas[{{$index}}][image]" value="{{ $fasilitas['image'] ?? '' }}">
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <button type="button" class="remove-fasilitas text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                                                    Hapus Fasilitas
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="fasilitas-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300">
                                            <div class="mb-3">
                                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Fasilitas</label>
                                                <input type="text" name="fasilitas[0][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="Full AC">
                                            </div>
                                            <div class="mb-3">
                                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                                                <div class="flex items-center space-x-4">
                                                    <div class="bg-gray-200 flex items-center justify-center mb-2" style="width: 100px; height: 100px;">
                                                        <span class="text-gray-500">No Image</span>
                                                    </div>
                                                    <input type="file" name="fasilitas_image[0]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" accept="image/*">
                                                </div>
                                                <input type="hidden" name="fasilitas[0][image]" value="images/assets/img_layanan.png">
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <button type="button" class="remove-fasilitas text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                                                    Hapus Fasilitas
                                                </button>
                                            </div>
                                        </div>
                                        <div class="fasilitas-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300">
                                            <div class="mb-3">
                                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Fasilitas</label>
                                                <input type="text" name="fasilitas[1][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="Purifier">
                                            </div>
                                            <div class="mb-3">
                                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                                                <div class="flex items-center space-x-4">
                                                    <div class="bg-gray-200 flex items-center justify-center mb-2" style="width: 100px; height: 100px;">
                                                        <span class="text-gray-500">No Image</span>
                                                    </div>
                                                    <input type="file" name="fasilitas_image[1]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" accept="image/*">
                                                </div>
                                                <input type="hidden" name="fasilitas[1][image]" value="images/assets/img_layanan.png">
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <button type="button" class="remove-fasilitas text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                                                    Hapus Fasilitas
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <button type="button" id="add_fasilitas" class="text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                        Tambah Fasilitas
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Galeri Kelas Stimulasi</h2>
                            <p class="mb-4 text-sm text-gray-500 dark:text-gray-300">Untuk mengelola galeri, silakan menggunakan halaman <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:underline dark:text-blue-400">manajemen galeri</a> dan pilih kategori "Kelas Stimulasi".</p>
                        </div>


                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('dashboard') }}" class="py-2 px-4 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Batal</a>
                            <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-600">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle banner type selection
        const bannerTypeRadios = document.querySelectorAll('input[name="banner_type"]');
        const bannerImageContainer = document.getElementById('banner_image_container');
        const bannerVideoContainer = document.getElementById('banner_video_container');

        bannerTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'image') {
                    bannerImageContainer.classList.remove('hidden');
                    bannerVideoContainer.classList.add('hidden');
                } else if (this.value === 'video') {
                    bannerImageContainer.classList.add('hidden');
                    bannerVideoContainer.classList.remove('hidden');
                }
            });
        });

        // Add program point
        const programPointsContainer = document.getElementById('program_points_container');
        const addProgramPointButton = document.getElementById('add_program_point');

        addProgramPointButton.addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.className = 'program-point-item mb-2 flex items-center gap-2';
            newItem.innerHTML = `
                <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="">
                <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            `;
            programPointsContainer.appendChild(newItem);

            // Attach event listener to new remove button
            newItem.querySelector('.remove-program-point').addEventListener('click', function() {
                this.closest('.program-point-item').remove();
            });
        });

        // Remove program point
        document.querySelectorAll('.remove-program-point').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.program-point-item').remove();
            });
        });

        // Add kegiatan
        const kegiatanContainer = document.getElementById('kegiatan_container');
        const addKegiatanButton = document.getElementById('add_kegiatan');

        addKegiatanButton.addEventListener('click', function() {
            const kegiatanCount = document.querySelectorAll('.kegiatan-item').length;
            const newItem = document.createElement('div');
            newItem.className = 'kegiatan-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300';
            newItem.innerHTML = `
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                    <input type="text" name="kegiatan[${kegiatanCount}][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                </div>
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea name="kegiatan[${kegiatanCount}][description]" rows="3" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                </div>
                <div class="flex items-center justify-end">
                    <button type="button" class="remove-kegiatan text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                        Hapus Kegiatan
                    </button>
                </div>
            `;
            kegiatanContainer.appendChild(newItem);

            // Attach event listener to new remove button
            newItem.querySelector('.remove-kegiatan').addEventListener('click', function() {
                this.closest('.kegiatan-item').remove();
                // Reindex kegiatan items
                updateKegiatanIndexes();
            });
        });

        // Remove kegiatan
        document.querySelectorAll('.remove-kegiatan').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.kegiatan-item').remove();
                // Reindex kegiatan items
                updateKegiatanIndexes();
            });
        });

        // Function to update kegiatan indexes after deletion
        function updateKegiatanIndexes() {
            const kegiatanItems = document.querySelectorAll('.kegiatan-item');
            kegiatanItems.forEach((item, index) => {
                const nameInput = item.querySelector('input[name^="kegiatan["]');
                const descriptionTextarea = item.querySelector('textarea[name^="kegiatan["]');

                nameInput.name = `kegiatan[${index}][name]`;
                descriptionTextarea.name = `kegiatan[${index}][description]`;
            });
        }

        // Add price list item
        const pricelistItemsContainer = document.getElementById('pricelist_items_container');
        const addPricelistItemButton = document.getElementById('add_pricelist_item');

        addPricelistItemButton.addEventListener('click', function() {
            const pricelistItemCount = document.querySelectorAll('.pricelist-item').length;
            const newIndex = pricelistItemCount;

            const newItem = document.createElement('div');
            newItem.className = 'pricelist-item bg-white p-4 rounded-lg mb-4 border border-gray-300';
            newItem.innerHTML = `
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Layanan</label>
                        <input type="text" name="pricelist_items[${newIndex}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Usia</label>
                        <input type="text" name="pricelist_items[${newIndex}][age_range]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-3">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Pendaftaran</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                            <input type="text" name="pricelist_items[${newIndex}][registration_fee]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">Rp.</span>
                            <input type="text" name="pricelist_items[${newIndex}][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5" value="">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Pertemuan</label>
                        <input type="text" name="pricelist_items[${newIndex}][meetings]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="remove-pricelist-item text-red-600 hover:text-red-800 px-2 py-1 rounded text-sm">Hapus Item</button>
                </div>
            `;

            pricelistItemsContainer.appendChild(newItem);

            // Add event listener to the new remove button
            newItem.querySelector('.remove-pricelist-item').addEventListener('click', function() {
                pricelistItemsContainer.removeChild(newItem);
                updatePricelistItemIndexes();
            });
        });

        // Event delegation for remove buttons
        document.getElementById('pricelist_items_container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-pricelist-item')) {
                const item = e.target.closest('.pricelist-item');
                item.parentNode.removeChild(item);
                updatePricelistItemIndexes();
            }
        });

        // Update the indexes after removal
        function updatePricelistItemIndexes() {
            const items = document.querySelectorAll('.pricelist-item');
            items.forEach((item, index) => {
                const inputs = item.querySelectorAll('input');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        // Update the index in input name attribute
                        const newName = name.replace(/pricelist_items\[\d+\]/g, `pricelist_items[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }

        // Add fasilitas
        const fasilitasContainer = document.getElementById('fasilitas_container');
        const addFasilitasButton = document.getElementById('add_fasilitas');

        addFasilitasButton.addEventListener('click', function() {
            const fasilitasCount = document.querySelectorAll('.fasilitas-item').length;
            const newItem = document.createElement('div');
            newItem.className = 'fasilitas-item bg-gray-50 p-4 rounded-lg mb-4 border border-gray-300';
            newItem.innerHTML = `
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Fasilitas</label>
                    <input type="text" name="fasilitas[${fasilitasCount}][name]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                </div>
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                    <div class="flex items-center space-x-4">
                        <div class="bg-gray-200 flex items-center justify-center mb-2" style="width: 100px; height: 100px;">
                            <span class="text-gray-500">No Image</span>
                        </div>
                        <input type="file" name="fasilitas_image[${fasilitasCount}]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" accept="image/*">
                    </div>
                    <input type="hidden" name="fasilitas[${fasilitasCount}][image]" value="">
                </div>
                <div class="flex items-center justify-end">
                    <button type="button" class="remove-fasilitas text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 p-1 rounded">
                        Hapus Fasilitas
                    </button>
                </div>
            `;
            fasilitasContainer.appendChild(newItem);

            // Attach event listener to new remove button
            newItem.querySelector('.remove-fasilitas').addEventListener('click', function() {
                this.closest('.fasilitas-item').remove();
                // Reindex fasilitas items
                updateFasilitasIndexes();
            });
        });

        // Remove fasilitas
        document.querySelectorAll('.remove-fasilitas').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.fasilitas-item').remove();
                // Reindex fasilitas items
                updateFasilitasIndexes();
            });
        });

        // Function to update fasilitas indexes after deletion
        function updateFasilitasIndexes() {
            const fasilitasItems = document.querySelectorAll('.fasilitas-item');
            fasilitasItems.forEach((item, index) => {
                const nameInput = item.querySelector('input[name^="fasilitas["][name$="[name]"]');
                const imageInput = item.querySelector('input[type="file"]');
                const hiddenImageInput = item.querySelector('input[type="hidden"][name^="fasilitas["][name$="[image]"]');

                nameInput.name = `fasilitas[${index}][name]`;
                imageInput.name = `fasilitas_image[${index}]`;
                hiddenImageInput.name = `fasilitas[${index}][image]`;
            });
        }

        // Auto-dismiss alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('[id^="alert-"]');
            alerts.forEach(alert => {
                alert.remove();
            });
        }, 5000);
    });
</script>
@endsection
