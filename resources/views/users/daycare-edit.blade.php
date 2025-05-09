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
            <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-darkblack-600 border-0 shadow-xl dark:border dark:border-darkblack-400 dark:shadow-dark-xl rounded-2xl bg-clip-border">
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
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Pilih Jenis Banner</label>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_image" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ $daycareData['banner_type'] == 'image' ? 'checked' : '' }}>
                                        <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Gambar</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_video" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ $daycareData['banner_type'] == 'video' ? 'checked' : '' }}>
                                        <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Video YouTube</label>
                                    </div>
                                </div>
                            </div>

                            <div id="banner-image-section" class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Banner</label>
                                <input type="file" name="banner_image" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                                @if($daycareData['banner_type'] == 'image' && $daycareData['banner_image'])
                                    <div class="mt-2">
                                        <img src="{{ Storage::disk('public')->exists($daycareData['banner_image']) ? asset('storage/' . $daycareData['banner_image']) : asset($daycareData['banner_image']) }}"
                                             alt="Current Banner"
                                             class="w-64 h-32 object-cover">
                                    </div>
                                    @endif
                            </div>

                            <div id="banner-video-section" class="mb-4" style="display: none;">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Link Video</label>
                                <input type="text" name="banner_video" value="{{ $daycareData['banner_video'] }}" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Kelebihan Daycare</h2>
                            <div class="mb-4">
                                <label for="kelebihan_daycare" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi Kelebihan</label>
                                <textarea name="kelebihan_daycare" id="kelebihan_daycare" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $daycareData['kelebihan_daycare'] }}</textarea>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">About Daycare</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="usia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Usia</label>
                                    <input type="text" name="usia" id="usia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['details']['usia'] }}">
                                </div>

                                <div class="mb-4">
                                    <label for="jam_operasional" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" id="jam_operasional" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['details']['jam_operasional'] }}">
                                </div>
                            </div>

                                <div class="mb-4">
                                <label for="hari" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Hari</label>
                                <input type="text" name="hari" id="hari" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $daycareData['about_daycare']['details']['hari'] ?? 'Senin-Sabtu' }}">
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">About Care Giver</h2>
                            <div id="caregiver_container">
                                @if(isset($daycareData['about_caregiver']['caregivers']))
                                    @foreach($daycareData['about_caregiver']['caregivers'] as $index => $caregiver)
                                    <div class="caregiver-item border-b pb-3 mb-3 dark:border-darkblack-400">
                                        <div class="flex flex-wrap gap-4">
                                            <div class="flex-1 min-w-[200px]">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Usia</label>
                                                <input type="text" name="caregiver_items[{{ $index }}][usia]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $caregiver['usia'] }}">
                                            </div>
                                            <div class="flex-1 min-w-[200px]">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Rasio</label>
                                                <input type="text" name="caregiver_items[{{ $index }}][rasio]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $caregiver['rasio'] }}">
                                            </div>
                                            <div class="flex items-end pb-2">
                                                <button type="button" class="remove-caregiver text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="caregiver-item border-b pb-3 mb-3 dark:border-darkblack-400">
                                        <div class="flex flex-wrap gap-4">
                                            <div class="flex-1 min-w-[200px]">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Usia</label>
                                                <input type="text" name="caregiver_items[0][usia]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Usia 0 - 1">
                                            </div>
                                            <div class="flex-1 min-w-[200px]">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Rasio</label>
                                                <input type="text" name="caregiver_items[0][rasio]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1 Anak 1 Care Giver">
                                            </div>
                                            <div class="flex items-end pb-2">
                                                <button type="button" class="remove-caregiver text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                            </div>
                                @endif
                            </div>
                            <button type="button" id="add_caregiver" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Rasio Caregiver
                            </button>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Program</h2>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi Program</label>
                                <textarea name="program_description" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white" rows="3">{{ $daycareData['program']['description'] }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Program</label>
                                <input type="file" name="program_image" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                                @if($daycareData['program']['image'])
                                    <div class="mt-2">
                                        <img src="{{ Storage::disk('public')->exists($daycareData['program']['image']) ? asset('storage/' . $daycareData['program']['image']) : asset($daycareData['program']['image']) }}"
                                             alt="Current Program Image"
                                             class="w-64 h-32 object-cover">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Program Points</label>
                                <div id="program_points_container">
                                    @foreach($daycareData['program']['points'] as $index => $point)
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

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Fasilitas</h2>
                            <div id="facilities">
                                @if(isset($daycareData['facilities']) && is_array($daycareData['facilities']))
                                    @foreach($daycareData['facilities'] as $index => $facility)
                                        <div class="border p-4 mb-4 dark:border-darkblack-400">
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul</label>
                                                <input type="text" name="facility_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $facility['title'] ?? '' }}">
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi</label>
                                                <textarea name="facility_items[{{ $index }}][description]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $facility['description'] ?? '' }}</textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar</label>
                                                <input type="file" name="facility_items[{{ $index }}][image]" class="w-full p-2 border rounded dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white">
                                                @if(isset($facility['image']) && $facility['image'])
                                                    <div class="mt-2">
                                                        <img src="{{ Storage::disk('public')->exists($facility['image']) ? asset('storage/' . $facility['image']) : asset($facility['image']) }}"
                                                             alt="Current Facility Image"
                                                             class="w-64 h-32 object-cover">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add_facility" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Fasilitas
                            </button>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Pricelist Daycare</h2>

                            <div id="pricelist_container">
                                @foreach($daycareData['pricelist'] as $index => $pricelist)
                                <div class="pricelist-item border rounded-lg p-4 mb-4 dark:border-darkblack-400">
                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Paket</label>
                                        <input type="text" name="pricelist_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $pricelist['title'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Harga</label>
                                        <input type="text" name="pricelist_items[{{ $index }}][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ str_replace('Rp ', '', $pricelist['price']) }}" placeholder="500.000 (Rp akan ditambahkan otomatis)">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Promo Pendaftaran</label>
                                        <input type="number" name="pricelist_items[{{ $index }}][description]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ str_replace(['Rp', '.', ' ', 'promo'], '', $pricelist['description']) }}" placeholder="Masukkan nilai tanpa 'Rp' contoh: 100000">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Biaya Makan</label>
                                        <input type="text" name="pricelist_items[{{ $index }}][food_cost]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $pricelist['food_cost'] ?? '12.5k / Porsi, 5k Snack' }}" placeholder="Contoh: 12.5k / Porsi, 5k Snack">
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
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Kegiatan Daycare</h2>

                            <div id="activity_container">
                                @foreach($daycareData['activities'] as $index => $activity)
                                <div class="activity-item border rounded-lg p-4 mb-4 dark:border-darkblack-400">
                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Kegiatan</label>
                                        <input type="text" name="activity_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $activity['title'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Waktu</label>
                                        <input type="text" name="activity_items[{{ $index }}][time]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $activity['time'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi</label>
                                        <textarea name="activity_items[{{ $index }}][description]" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $activity['description'] }}</textarea>
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
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Galeri Daycare</h2>
                            <p class="mb-4 text-sm text-gray-500 dark:text-bgray-300">Untuk mengelola galeri, silakan menggunakan halaman <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:underline dark:text-blue-400">manajemen galeri</a> dan pilih kategori "Daycare".</p>
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
        const bannerImageContainer = document.getElementById('banner-image-section');
        const bannerVideoContainer = document.getElementById('banner-video-section');

        if (radioBannerImage && radioBannerVideo) {
            radioBannerImage.addEventListener('change', function() {
                if (this.checked) {
                    bannerImageContainer.style.display = 'block';
                    bannerVideoContainer.style.display = 'none';
                }
            });

            radioBannerVideo.addEventListener('change', function() {
                if (this.checked) {
                    bannerImageContainer.style.display = 'none';
                    bannerVideoContainer.style.display = 'block';
                }
            });
        }

        // Program points
        const addProgramPointBtn = document.getElementById('add-program-point');
        const programPointsContainer = document.getElementById('program_points_container');

        if (addProgramPointBtn && programPointsContainer) {
            addProgramPointBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'mb-2 flex items-center program-point-item';
                newItem.innerHTML = `
                    <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Point Program">
                    <button type="button" class="remove-program-point ms-2 text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
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
        const facilityContainer = document.getElementById('facilities');
        let facilityCounter = document.querySelectorAll('.facility-item').length;

        if (addFacilityBtn && facilityContainer) {
            addFacilityBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'facility-item border rounded-lg p-4 mb-4 dark:border-darkblack-400';
                newItem.innerHTML = `
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Fasilitas</label>
                        <input type="text" name="facility_items[${facilityCounter}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Judul Fasilitas">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi Fasilitas</label>
                        <textarea name="facility_items[${facilityCounter}][description]" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi fasilitas"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Fasilitas</label>
                        <input type="file" name="facility_items[${facilityCounter}][image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
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
                newItem.className = 'pricelist-item border rounded-lg p-4 mb-4 dark:border-darkblack-400';
                newItem.innerHTML = `
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Paket</label>
                        <input type="text" name="pricelist_items[${pricelistCounter}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Judul Paket">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Harga</label>
                        <input type="text" name="pricelist_items[${pricelistCounter}][price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="500.000/bulan (Rp akan ditambahkan otomatis)">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Promo Pendaftaran</label>
                        <input type="number" name="pricelist_items[${pricelistCounter}][description]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan nilai tanpa 'Rp' contoh: 100000">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Biaya Makan</label>
                        <input type="text" name="pricelist_items[${pricelistCounter}][food_cost]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh: 12.5k / Porsi, 5k Snack">
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
                newItem.className = 'activity-item border rounded-lg p-4 mb-4 dark:border-darkblack-400';
                newItem.innerHTML = `
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Kegiatan</label>
                        <input type="text" name="activity_items[${activityCounter}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Kegiatan">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Waktu</label>
                        <input type="text" name="activity_items[${activityCounter}][time]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="08.00 - 10.00">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi</label>
                        <textarea name="activity_items[${activityCounter}][description]" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi kegiatan"></textarea>
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

        // Caregivers
        const addCaregiverBtn = document.getElementById('add_caregiver');
        const caregiverContainer = document.getElementById('caregiver_container');
        let caregiverCounter = document.querySelectorAll('.caregiver-item').length;

        if (addCaregiverBtn && caregiverContainer) {
            addCaregiverBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'caregiver-item border-b pb-3 mb-3 dark:border-darkblack-400';
                newItem.innerHTML = `
                    <div class="flex flex-wrap gap-4">
                        <div class="flex-1 min-w-[200px]">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Usia</label>
                            <input type="text" name="caregiver_items[${caregiverCounter}][usia]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="contoh: Usia 0 - 1">
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Rasio</label>
                            <input type="text" name="caregiver_items[${caregiverCounter}][rasio]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="contoh: 1 Anak 1 Care Giver">
                        </div>
                        <div class="flex items-end pb-2">
                            <button type="button" class="remove-caregiver text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                caregiverContainer.appendChild(newItem);
                caregiverCounter++;

                // Attach event listener to new remove button
                newItem.querySelector('.remove-caregiver').addEventListener('click', function() {
                    newItem.remove();
                });
            });

            // Attach event listeners to existing remove buttons
            document.querySelectorAll('.remove-caregiver').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.caregiver-item').remove();
                });
            });
        }
    });
</script>
@endsection
