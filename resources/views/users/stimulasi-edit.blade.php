@extends('users.layouts.app')

@section('title', 'Edit Stimulasi')

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
            <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-darkblack-600 border-0 shadow-xl dark:border dark:border-darkblack-400 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0">
                    <div class="flex items-center justify-between">
                        <h6 class="dark:text-white">Edit Data Halaman Stimulasi</h6>
                    </div>
                </div>

                <div class="flex-auto p-6">
                    @if (session('success'))
                    <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-darkblack-500 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-darkblack-500 dark:text-green-400 dark:hover:bg-darkblack-400" data-dismiss-target="#alert-success" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endif

                    <form action="{{ route('stimulasi.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Banner Utama -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Pilih Jenis Banner</label>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_image" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" {{ isset($stimulasi['banner_type']) && $stimulasi['banner_type'] == 'image' ? 'checked' : (!isset($stimulasi['banner_type']) ? 'checked' : '') }}>
                                        <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Gambar</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_video" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" {{ isset($stimulasi['banner_type']) && $stimulasi['banner_type'] == 'video' ? 'checked' : '' }}>
                                        <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Video YouTube</label>
                                    </div>
                                </div>
                            </div>

                            <div id="banner_image_container" class="mb-4 {{ !isset($stimulasi['banner_type']) || $stimulasi['banner_type'] == 'image' ? '' : 'hidden' }}">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Banner</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" name="banner_image" id="banner_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
                                </div>
                                @if(isset($stimulasi['banner_image']))
                                    <div class="mt-2">
                                        <img src="{{ Storage::disk('public')->exists($stimulasi['banner_image']) ? asset('storage/' . $stimulasi['banner_image']) : asset($stimulasi['banner_image']) }}"
                                             alt="Current Banner"
                                             class="w-64 h-32 object-cover">
                                    </div>
                                @endif
                                <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                            </div>

                            <div id="banner_video_container" class="mb-4 {{ isset($stimulasi['banner_type']) && $stimulasi['banner_type'] == 'video' ? '' : 'hidden' }}">
                                <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Link Video YouTube</label>
                                <input type="text" name="banner_video" id="banner_video" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=..." value="{{ $stimulasi['banner_video'] ?? '' }}">
                                <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                            </div>
                        </div>

                        <!-- Kelebihan Stimulasi -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Kelebihan Stimulasi</h2>

                                <div class="mb-4">
                                <label for="benefit_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Kelebihan</label>
                                <input type="text" id="benefit_title" name="benefit_title" value="{{ $stimulasi['benefit_title'] ?? 'Kelebihan Stimulasi Kami' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div class="mb-4">
                                <label for="benefit_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi Kelebihan</label>
                                <textarea id="benefit_description" name="benefit_description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $stimulasi['benefit_description'] ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus itaque rem quae alias facere ipsum in maiores cupiditate modi, magnam qui natus beatae nam aut voluptate, neque quibusdam reiciendis aliquid atque. Necessitatibus praesentium maiores, modi ratione nostrum vel odit recusandae!' }}</textarea>
                                </div>
                            </div>

                        <!-- Informasi Stimulasi -->
                            <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Stimulasi</h2>

                                <div class="mb-4">
                                <label for="info_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Informasi</label>
                                <input type="text" id="info_title" name="info_title" value="{{ $stimulasi['info_title'] ?? 'About Stimulasi' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="age_range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Rentang Usia</label>
                                    <input type="text" id="age_range" name="age_range" value="{{ $stimulasi['age_range'] ?? '0-6 Tahun' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label for="operating_hours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jam Operasional</label>
                                    <input type="text" id="operating_hours" name="operating_hours" value="{{ $stimulasi['operating_hours'] ?? '9:00 - 17:00' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label for="operating_days" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Hari Operasional</label>
                                    <input type="text" id="operating_days" name="operating_days" value="{{ $stimulasi['operating_days'] ?? 'Senin-Sabtu' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label for="cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Biaya</label>
                                    <textarea id="cost" name="cost" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $stimulasi['cost'] ?? 'Mulai dari Rp 500.000/bulan' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Program -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Program</h2>

                            <div class="mb-4">
                                <label for="program_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Program</label>
                                <input type="text" id="program_title" name="program_title" value="{{ $stimulasi['program_title'] ?? 'Program Stimulasi' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label for="program_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi Program</label>
                                <textarea id="program_description" name="program_description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $stimulasi['program_description'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Program</label>
                                <input type="file" name="program_image" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                                @if(isset($stimulasi['program_image']))
                                    <div class="mt-2">
                                        <img src="{{ Storage::disk('public')->exists($stimulasi['program_image']) ? asset('storage/' . $stimulasi['program_image']) : asset($stimulasi['program_image']) }}"
                                             alt="Current Program Image"
                                             class="w-64 h-32 object-cover">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Program Points</label>
                                <div id="program_points_container">
                                    @foreach($stimulasi['program']['points'] ?? [] as $index => $point)
                                    <div class="program-point-item flex items-center gap-2 mb-2">
                                        <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $point }}">
                                        <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-program-point" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Tambah Point
                                </button>
                            </div>
                        </div>

                        <!-- Kegiatan Kelas Stimulasi -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Kegiatan Kelas Stimulasi</h2>

                            <div class="mb-4">
                                <label for="kegiatan_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Kegiatan</label>
                                <input type="text" id="kegiatan_title" name="kegiatan_title" value="{{ $stimulasi['kegiatan_title'] ?? 'Kegiatan Kelas Stimulasi Rumah Samoedra' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div id="kegiatan-container">
                                @if(isset($stimulasi['kegiatan']) && count($stimulasi['kegiatan']) > 0)
                                    @foreach($stimulasi['kegiatan'] as $index => $kegiatan)
                                        <div class="kegiatan-item border rounded-lg p-4 mb-4 dark:border-darkblack-400">
                                            <div class="flex justify-between items-center mb-2">
                                                <h4 class="font-semibold dark:text-white">Kegiatan {{ $index + 1 }}</h4>
                                                <button type="button" class="remove-kegiatan text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                                            </div>
                                            <div class="mb-3">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Kegiatan</label>
                                                <input type="text" name="kegiatan_name[]" value="{{ $kegiatan['name'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </div>
                                            <div class="mb-3">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi (Pisahkan dengan baris baru)</label>
                                                <textarea name="kegiatan_description[]" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $kegiatan['description'] }}</textarea>
                                                <p class="mt-1 text-xs text-gray-500">Setiap baris baru akan menjadi poin baru dalam daftar</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="kegiatan-item border rounded-lg p-4 mb-4 dark:border-darkblack-400">
                                        <div class="flex justify-between items-center mb-2">
                                            <h4 class="font-semibold dark:text-white">Kegiatan 1</h4>
                                            <button type="button" class="remove-kegiatan text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Kegiatan</label>
                                            <input type="text" name="kegiatan_name[]" value="ADAPTASI SOSIAL" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            </div>
                                        <div class="mb-3">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi (Pisahkan dengan baris baru)</label>
                                            <textarea name="kegiatan_description[]" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Diskusi tentang pengalaman bulan Puasa & Lebaran
⁠Praktik Bersalaman dan Bermaaf maafan
⁠Berkenalan dengan teman baru
Menjawab pertanyaan sederhana</textarea>
                                            <p class="mt-1 text-xs text-gray-500">Setiap baris baru akan menjadi poin baru dalam daftar</p>
                                        </div>
                                        </div>
                                    @endif
                            </div>
                            <button type="button" id="add-kegiatan" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Kegiatan</button>
                        </div>

                        <!-- Fasilitas -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Fasilitas</h2>

                            <div id="fasilitas-container">
                                @if(isset($stimulasi['fasilitas']) && count($stimulasi['fasilitas']) > 0)
                                    @foreach($stimulasi['fasilitas'] as $index => $fasilitas)
                                        <div class="fasilitas-item border rounded-lg p-4 mb-4 dark:border-darkblack-400">
                                            <div class="flex justify-between items-center mb-2">
                                                <h4 class="font-semibold dark:text-white">Fasilitas {{ $index + 1 }}</h4>
                                                <button type="button" class="remove-fasilitas text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                                            </div>
                                            <div class="mb-3">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Fasilitas</label>
                                                <input type="text" name="fasilitas_name[]" value="{{ $fasilitas['name'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            </div>
                                            <div class="mb-3">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Fasilitas</label>
                                                <input type="file" name="fasilitas_image[]" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                                                @if(isset($fasilitas['image']) && $fasilitas['image'])
                                                    <div class="mt-2">
                                                        <img src="{{ Storage::disk('public')->exists($fasilitas['image']) ? asset('storage/' . $fasilitas['image']) : asset($fasilitas['image']) }}"
                                                            alt="Gambar Fasilitas"
                                                            class="w-64 h-32 object-cover">
                                                    </div>
                                                    <input type="hidden" name="fasilitas_old_image[]" value="{{ $fasilitas['image'] }}">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="fasilitas-item border rounded-lg p-4 mb-4 dark:border-darkblack-400">
                                        <div class="flex justify-between items-center mb-2">
                                            <h4 class="font-semibold dark:text-white">Fasilitas 1</h4>
                                            <button type="button" class="remove-fasilitas text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Fasilitas</label>
                                            <input type="text" name="fasilitas_name[]" value="Full AC" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="mb-3">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Fasilitas</label>
                                            <input type="file" name="fasilitas_image[]" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                                            </div>
                                        </div>
                                    @endif
                            </div>
                            <button type="button" id="add-fasilitas" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Fasilitas</button>
                        </div>

                        <!-- Pricelist -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Pricelist</h2>

                            <div class="mb-4">
                                <label for="pricelist_subtitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Subtitle Pricelist</label>
                                <input type="text" id="pricelist_subtitle" name="pricelist_subtitle" value="{{ $stimulasi['pricelist_subtitle'] ?? 'Pricelist' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label for="pricelist_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Pricelist</label>
                                <input type="text" id="pricelist_title" name="pricelist_header" value="{{ $stimulasi['pricelist_title'] ?? 'Price List Kelas Stimulasi' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div class="overflow-x-auto mt-4 mb-4">
                                <table class="w-full border-collapse border border-gray-300 dark:border-darkblack-400">
                                    <thead>
                                        <tr class="bg-gray-100 dark:bg-darkblack-500">
                                            <th class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">No</th>
                                            <th class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">Layanan</th>
                                            <th class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">Usia</th>
                                            <th class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">Promo Pendaftaran</th>
                                            <th class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">Biaya</th>
                                            <th class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">Pertemuan</th>
                                            <th class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pricelist-table-body">
                                        @if(isset($stimulasi['pricelist_items']) && count($stimulasi['pricelist_items']) > 0)
                                            @foreach($stimulasi['pricelist_items'] as $index => $item)
                                                <tr class="pricelist-row">
                                                    <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">{{ $index + 1 }}</td>
                                                    <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                        <input type="text" name="pricelist_title[]" value="{{ $item['title'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                        <input type="text" name="pricelist_age_range[]" value="{{ $item['age_range'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                        <input type="text" name="pricelist_registration_fee[]" value="{{ $item['registration_fee'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                        <input type="text" name="pricelist_price[]" value="{{ $item['price'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                        <input type="text" name="pricelist_meetings[]" value="{{ $item['meetings'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">
                                                        <button type="button" class="remove-pricelist text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="pricelist-row">
                                                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">1</td>
                                                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                    <input type="text" name="pricelist_title[]" value="Kelas Stimulasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </td>
                                                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                    <input type="text" name="pricelist_age_range[]" value="6 bulan - 12 tahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </td>
                                                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                    <input type="text" name="pricelist_registration_fee[]" value="Rp. 100.000" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </td>
                                                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                    <input type="text" name="pricelist_price[]" value="Rp. 500.000" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </td>
                                                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                                                    <input type="text" name="pricelist_meetings[]" value="10x Pertemuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </td>
                                                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">
                                                    <button type="button" class="remove-pricelist text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <button type="button" id="add-pricelist" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Item Pricelist
                            </button>
                        </div>

                        <!-- Galeri -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Galeri</h2>

                            <div class="mb-8">
                                <p class="mb-4 text-sm text-gray-500 dark:text-bgray-300">Untuk mengelola galeri, silakan menggunakan halaman <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:underline dark:text-blue-400">manajemen galeri</a> dan pilih kategori "Stimulasi".</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle banner type containers
        const bannerTypeInputs = document.querySelectorAll('input[name="banner_type"]');
        const bannerImageContainer = document.getElementById('banner_image_container');
        const bannerVideoContainer = document.getElementById('banner_video_container');

        bannerTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'image') {
                    bannerImageContainer.classList.remove('hidden');
                    bannerVideoContainer.classList.add('hidden');
                } else if (this.value === 'video') {
                    bannerImageContainer.classList.add('hidden');
                    bannerVideoContainer.classList.remove('hidden');
                }
            });
        });

        // Program Points
        const addProgramPointBtn = document.getElementById('add-program-point');
        const programPointsContainer = document.getElementById('program_points_container');

        if (addProgramPointBtn && programPointsContainer) {
            addProgramPointBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'program-point-item flex items-center gap-2 mb-2';
                newItem.innerHTML = `
                    <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Point Program">
                    <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                `;
                programPointsContainer.appendChild(newItem);

                // Attach event listener to remove button
                newItem.querySelector('.remove-program-point').addEventListener('click', function() {
                    newItem.remove();
                });
            });

            // Attach event listeners to existing remove buttons
            document.querySelectorAll('.remove-program-point').forEach(button => {
                button.addEventListener('click', function() {
                    newItem.remove();
                });
            });
        }

        // Kegiatan Kelas Stimulasi
        const addKegiatanBtn = document.getElementById('add-kegiatan');
        const kegiatanContainer = document.getElementById('kegiatan-container');

        if (addKegiatanBtn && kegiatanContainer) {
            addKegiatanBtn.addEventListener('click', function() {
                const kegiatanCount = document.querySelectorAll('.kegiatan-item').length;
                const newKegiatan = document.createElement('div');
                newKegiatan.className = 'kegiatan-item border rounded-lg p-4 mb-4 dark:border-darkblack-400';
                newKegiatan.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                        <h4 class="font-semibold dark:text-white">Kegiatan ${kegiatanCount + 1}</h4>
                        <button type="button" class="remove-kegiatan text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                </div>
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Kegiatan</label>
                        <input type="text" name="kegiatan_name[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi (Pisahkan dengan baris baru)</label>
                        <textarea name="kegiatan_description[]" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        <p class="mt-1 text-xs text-gray-500">Setiap baris baru akan menjadi poin baru dalam daftar</p>
                    </div>
                `;
                kegiatanContainer.appendChild(newKegiatan);

                // Attach event listener to remove button
                newKegiatan.querySelector('.remove-kegiatan').addEventListener('click', function() {
                    if (document.querySelectorAll('.kegiatan-item').length > 1) {
                        newKegiatan.remove();
                    } else {
                        alert('Minimal harus ada satu kegiatan');
                    }
                });
            });

            // Attach event listeners to existing remove buttons
            document.querySelectorAll('.remove-kegiatan').forEach(button => {
                button.addEventListener('click', function() {
                    if (document.querySelectorAll('.kegiatan-item').length > 1) {
                        this.closest('.kegiatan-item').remove();
                    } else {
                        alert('Minimal harus ada satu kegiatan');
                    }
                });
            });
        }

        // Handle Fasilitas
        document.getElementById('add-fasilitas').addEventListener('click', function() {
            const fasilitasContainer = document.getElementById('fasilitas-container');
            const fasilitasItems = fasilitasContainer.querySelectorAll('.fasilitas-item');
            const newIndex = fasilitasItems.length + 1;

            const newItem = document.createElement('div');
            newItem.className = 'fasilitas-item border rounded-lg p-4 mb-4 dark:border-darkblack-400';
            newItem.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold dark:text-white">Fasilitas ${newIndex}</h4>
                    <button type="button" class="remove-fasilitas text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Hapus</button>
                </div>
                <div class="mb-3">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Fasilitas</label>
                    <input type="text" name="fasilitas_name[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-3">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Fasilitas</label>
                    <input type="file" name="fasilitas_image[]" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                </div>
            `;

            fasilitasContainer.appendChild(newItem);

            // Add event listener to the new delete button
            newItem.querySelector('.remove-fasilitas').addEventListener('click', function() {
                if (fasilitasContainer.querySelectorAll('.fasilitas-item').length > 1) {
                    this.closest('.fasilitas-item').remove();
                } else {
                    alert('Minimal harus ada satu fasilitas!');
                }
            });
        });

        // Add event listeners to existing fasilitas delete buttons
        document.querySelectorAll('.remove-fasilitas').forEach(button => {
            button.addEventListener('click', function() {
                const fasilitasContainer = document.getElementById('fasilitas-container');
                if (fasilitasContainer.querySelectorAll('.fasilitas-item').length > 1) {
                    this.closest('.fasilitas-item').remove();
                } else {
                    alert('Minimal harus ada satu fasilitas!');
                }
            });
        });

        // Handle Pricelist
        document.getElementById('add-pricelist').addEventListener('click', function() {
            const tableBody = document.getElementById('pricelist-table-body');
            const rows = tableBody.getElementsByClassName('pricelist-row');
            const rowCount = rows.length;

            // Create a new row
            const newRow = document.createElement('tr');
            newRow.className = 'pricelist-row';

            // Set the row's content
            newRow.innerHTML = `
                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">${rowCount + 1}</td>
                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                    <input type="text" name="pricelist_title[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </td>
                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                    <input type="text" name="pricelist_age_range[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </td>
                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                    <input type="text" name="pricelist_registration_fee[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </td>
                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                    <input type="text" name="pricelist_price[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </td>
                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2">
                    <input type="text" name="pricelist_meetings[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </td>
                <td class="border border-gray-300 dark:border-darkblack-400 px-4 py-2 text-center">
                    <button type="button" class="remove-pricelist text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </td>
            `;

            // Add the new row to the table
            tableBody.appendChild(newRow);

            // Add event listener to new remove button
            newRow.querySelector('.remove-pricelist').addEventListener('click', function() {
                newRow.remove();
                updatePricelistRowNumbers();
            });
        });

        // Function to update row numbers
        function updatePricelistRowNumbers() {
            const tableBody = document.getElementById('pricelist-table-body');
            const rows = tableBody.getElementsByClassName('pricelist-row');

            for (let i = 0; i < rows.length; i++) {
                rows[i].cells[0].textContent = i + 1;
            }
        }

        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-pricelist').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
                updatePricelistRowNumbers();
            });
        });
    });
</script>
@endsection
