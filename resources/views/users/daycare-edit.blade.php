@extends('users.layouts.app')

@section('title', 'Edit Daycare')

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
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0">
                    <div class="flex items-center justify-between">
                        <h6 class="dark:text-white">Edit Halaman Daycare</h6>
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

                    <form action="{{ route('daycare.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Banner Utama</h2>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Jenis Banner</label>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_image" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ $daycareData['banner_type'] == 'image' ? 'checked' : '' }}>
                                        <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gambar</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_video" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ $daycareData['banner_type'] == 'video' ? 'checked' : '' }}>
                                        <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Video YouTube</label>
                                    </div>
                                </div>
                            </div>

                            <div id="banner_image_container" class="mb-4 {{ $daycareData['banner_type'] == 'image' ? '' : 'hidden' }}">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Banner</label>
                                <div class="flex items-center space-x-4">
                                    @if(isset($daycareData['banner_image']))
                                    <img src="{{ asset($daycareData['banner_image']) }}" alt="Banner Preview" class="image-preview mb-2">
                                    @endif
                                    <input type="file" name="banner_image" id="banner_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                            </div>

                            <div id="banner_video_container" class="mb-4 {{ $daycareData['banner_type'] == 'video' ? '' : 'hidden' }}">
                                <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Video YouTube</label>
                                <input type="text" name="banner_video" id="banner_video" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=..." value="{{ $daycareData['banner_video'] ?? '' }}">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Kelebihan Daycare</h2>
                            <div class="mb-4">
                                <label for="kelebihan_daycare" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Kelebihan</label>
                                <textarea name="kelebihan_daycare" id="kelebihan_daycare" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $daycareData['kelebihan_daycare'] }}</textarea>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">About Daycare</h2>
                            <div class="mb-4">
                                <label for="about_daycare_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                <input type="text" name="about_daycare_title" id="about_daycare_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['title'] }}">
                            </div>

                            <div class="mb-4">
                                <label for="about_daycare_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea name="about_daycare_description" id="about_daycare_description" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $daycareData['about_daycare']['description'] }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="usia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usia</label>
                                    <input type="text" name="usia" id="usia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['details']['usia'] }}">
                                </div>

                                <div class="mb-4">
                                    <label for="jam_operasional" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" id="jam_operasional" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['details']['jam_operasional'] }}">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="rasio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rasio</label>
                                    <input type="text" name="rasio" id="rasio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['details']['rasio'] }}">
                                </div>

                                <div class="mb-4">
                                    <label for="makanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Makanan</label>
                                    <input type="text" name="makanan" id="makanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['details']['makanan'] }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">About Care Giver</h2>
                            <div class="mb-4">
                                <label for="about_caregiver_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                <input type="text" name="about_caregiver_title" id="about_caregiver_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_caregiver']['title'] }}">
                            </div>

                            <div class="mb-4">
                                <label for="about_caregiver_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea name="about_caregiver_description" id="about_caregiver_description" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $daycareData['about_caregiver']['description'] }}</textarea>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Program Daycare</h2>
                            <div class="mb-4">
                                <label for="program_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Program</label>
                                <textarea name="program_description" id="program_description" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $daycareData['program']['description'] }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Program</label>
                                <div class="flex items-center space-x-4">
                                    @if(isset($daycareData['program']['image']))
                                    <img src="{{ asset($daycareData['program']['image']) }}" alt="Program Preview" class="image-preview mb-2">
                                    @endif
                                    <input type="file" name="program_image" id="program_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
                                </div>
                            </div>

                            <div id="program_points_container">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Point-point Program</label>
                                @foreach($daycareData['program']['points'] as $index => $point)
                                <div class="mb-2 flex items-center program-point-item">
                                    <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $point }}">
                                    <button type="button" class="remove-program-point ms-2 text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" id="add_program_point" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Point
                            </button>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Fasilitas Daycare</h2>

                            <div id="facility_container">
                                @foreach($daycareData['facilities'] as $index => $facility)
                                <div class="facility-item border rounded-lg p-4 mb-4">
                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Fasilitas</label>
                                        <input type="text" name="facility_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $facility['title'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Fasilitas</label>
                                        <textarea name="facility_items[{{ $index }}][description]" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $facility['description'] }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                                        <div class="flex items-center space-x-4">
                                            @if(isset($facility['image']))
                                            <img src="{{ asset($facility['image']) }}" alt="Facility Preview" class="image-preview mb-2">
                                            @endif
                                            <input type="file" name="facility_items[{{ $index }}][image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
                                        </div>
                                    </div>

                                    <button type="button" class="remove-facility text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                        Hapus Fasilitas
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" id="add_facility" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Fasilitas
                            </button>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Pricelist Daycare</h2>

                            <div id="pricelist_container">
                                @foreach($daycareData['pricelist'] as $index => $pricelist)
                                <div class="pricelist-item border rounded-lg p-4 mb-4">
                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Paket</label>
                                        <input type="text" name="pricelist_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $pricelist['title'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                        <input type="text" name="pricelist_items[{{ $index }}][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $pricelist['price'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                        <textarea name="pricelist_items[{{ $index }}][description]" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $pricelist['description'] }}</textarea>
                                    </div>

                                    <button type="button" class="remove-pricelist text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                        Hapus Pricelist
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" id="add_pricelist" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Pricelist
                            </button>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Kegiatan Daycare</h2>

                            <div id="activity_container">
                                @foreach($daycareData['activities'] as $index => $activity)
                                <div class="activity-item border rounded-lg p-4 mb-4">
                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                                        <input type="text" name="activity_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $activity['title'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu</label>
                                        <input type="text" name="activity_items[{{ $index }}][time]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $activity['time'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                        <textarea name="activity_items[{{ $index }}][description]" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $activity['description'] }}</textarea>
                                    </div>

                                    <button type="button" class="remove-activity text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                        Hapus Kegiatan
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" id="add_activity" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Kegiatan
                            </button>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Galeri Daycare</h2>
                            <p class="mb-4 text-sm text-gray-500">Untuk mengelola galeri, silakan menggunakan halaman <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:underline">manajemen galeri</a> dan pilih kategori "Daycare".</p>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
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
        // Toggle untuk jenis banner
        const radioBannerImage = document.getElementById('banner_type_image');
        const radioBannerVideo = document.getElementById('banner_type_video');
        const bannerImageContainer = document.getElementById('banner_image_container');
        const bannerVideoContainer = document.getElementById('banner_video_container');

        if (radioBannerImage && radioBannerVideo) {
            radioBannerImage.addEventListener('change', function() {
                if (this.checked) {
                    bannerImageContainer.classList.remove('hidden');
                    bannerVideoContainer.classList.add('hidden');
                }
            });

            radioBannerVideo.addEventListener('change', function() {
                if (this.checked) {
                    bannerImageContainer.classList.add('hidden');
                    bannerVideoContainer.classList.remove('hidden');
                }
            });
        }

        // Program points
        const addProgramPointBtn = document.getElementById('add_program_point');
        const programPointsContainer = document.getElementById('program_points_container');

        if (addProgramPointBtn && programPointsContainer) {
            addProgramPointBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'mb-2 flex items-center program-point-item';
                newItem.innerHTML = `
                    <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Point Program">
                    <button type="button" class="remove-program-point ms-2 text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                `;
                programPointsContainer.appendChild(newItem);

                // Attach event listener to new remove button
                newItem.querySelector('.remove-program-point').addEventListener('click', function() {
                    newItem.remove();
                });
            });

            // Attach event listeners to existing remove buttons
            document.querySelectorAll('.remove-program-point').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.program-point-item').remove();
                });
            });
        }

        // Facilities
        const addFacilityBtn = document.getElementById('add_facility');
        const facilityContainer = document.getElementById('facility_container');
        let facilityCounter = document.querySelectorAll('.facility-item').length;

        if (addFacilityBtn && facilityContainer) {
            addFacilityBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'facility-item border rounded-lg p-4 mb-4';
                newItem.innerHTML = `
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Fasilitas</label>
                        <input type="text" name="facility_items[${facilityCounter}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Judul Fasilitas">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Fasilitas</label>
                        <textarea name="facility_items[${facilityCounter}][description]" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi fasilitas"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                        <input type="file" name="facility_items[${facilityCounter}][image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
                    </div>

                    <button type="button" class="remove-facility text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                        Hapus Fasilitas
                    </button>
                `;
                facilityContainer.appendChild(newItem);
                facilityCounter++;

                // Attach event listener to new remove button
                newItem.querySelector('.remove-facility').addEventListener('click', function() {
                    newItem.remove();
                });
            });

            // Attach event listeners to existing remove buttons
            document.querySelectorAll('.remove-facility').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.facility-item').remove();
                });
            });
        }

        // Pricelist
        const addPricelistBtn = document.getElementById('add_pricelist');
        const pricelistContainer = document.getElementById('pricelist_container');
        let pricelistCounter = document.querySelectorAll('.pricelist-item').length;

        if (addPricelistBtn && pricelistContainer) {
            addPricelistBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'pricelist-item border rounded-lg p-4 mb-4';
                newItem.innerHTML = `
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Paket</label>
                        <input type="text" name="pricelist_items[${pricelistCounter}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Judul Paket">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="text" name="pricelist_items[${pricelistCounter}][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rp 500.000/bulan">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="pricelist_items[${pricelistCounter}][description]" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi paket"></textarea>
                    </div>

                    <button type="button" class="remove-pricelist text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                        Hapus Pricelist
                    </button>
                `;
                pricelistContainer.appendChild(newItem);
                pricelistCounter++;

                // Attach event listener to new remove button
                newItem.querySelector('.remove-pricelist').addEventListener('click', function() {
                    newItem.remove();
                });
            });

            // Attach event listeners to existing remove buttons
            document.querySelectorAll('.remove-pricelist').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.pricelist-item').remove();
                });
            });
        }

        // Activities
        const addActivityBtn = document.getElementById('add_activity');
        const activityContainer = document.getElementById('activity_container');
        let activityCounter = document.querySelectorAll('.activity-item').length;

        if (addActivityBtn && activityContainer) {
            addActivityBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'activity-item border rounded-lg p-4 mb-4';
                newItem.innerHTML = `
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                        <input type="text" name="activity_items[${activityCounter}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Kegiatan">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu</label>
                        <input type="text" name="activity_items[${activityCounter}][time]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="08.00 - 10.00">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="activity_items[${activityCounter}][description]" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi kegiatan"></textarea>
                    </div>

                    <button type="button" class="remove-activity text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                        Hapus Kegiatan
                    </button>
                `;
                activityContainer.appendChild(newItem);
                activityCounter++;

                // Attach event listener to new remove button
                newItem.querySelector('.remove-activity').addEventListener('click', function() {
                    newItem.remove();
                });
            });

            // Attach event listeners to existing remove buttons
            document.querySelectorAll('.remove-activity').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.activity-item').remove();
                });
            });
        }
    });
</script>
@endsection
