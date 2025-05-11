@extends('users.layouts.app')

@section('title', 'Edit Bimbel')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<style>
    .content-section {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .btn-add-item {
        margin-top: 20px;
    }

    .item-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }

    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .btn-remove-item {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .image-preview {
        max-width: 200px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .program-points-container {
        margin-top: 20px;
    }

    .program-point {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .program-point input {
        flex-grow: 1;
        margin-right: 10px;
    }

    .banner-type-selector {
        margin-bottom: 20px;
    }

    .banner-type-option {
        margin-right: 15px;
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
                        <h6 class="dark:text-white">Edit Halaman Bimbel</h6>
                    </div>
                </div>

                <div class="flex-auto p-6">
                    @if(session('success'))
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

                    @if(session('error'))
                    <div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="sr-only">Error</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-error" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div id="alert-validation" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="sr-only">Validation Error</span>
                        <div class="ms-3 text-sm font-medium">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-validation" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endif

                    <form action="{{ route('bimbel.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Banner Utama Section -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Pilih Jenis Banner</label>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_image" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" {{ $bimbel['banner_type'] == 'image' ? 'checked' : (!isset($bimbel['banner_type']) ? 'checked' : '') }}>
                                        <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Gambar</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_video" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" {{ $bimbel['banner_type'] == 'video' ? 'checked' : '' }}>
                                        <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Video YouTube</label>
                                    </div>
                                </div>
                            </div>

                            <div id="banner_image_container" class="mb-4 {{ !isset($bimbel['banner_type']) || $bimbel['banner_type'] == 'image' ? '' : 'hidden' }}">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Banner</label>
                                <div class="flex items-center space-x-4">
                                    @if(isset($bimbel['banner_image']))
                                        <img src="{{ asset($bimbel['banner_image']) }}" alt="Banner Preview" class="image-preview mb-2">
                                    @endif
                                    <input type="file" name="banner_image" id="banner_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                            </div>

                            <div id="banner_video_container" class="mb-4 {{ isset($bimbel['banner_type']) && $bimbel['banner_type'] == 'video' ? '' : 'hidden' }}">
                                <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Link Video YouTube</label>
                                <input type="text" name="banner_video" id="banner_video" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=..." value="{{ $bimbel['banner_video'] ?? '' }}">
                                <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                            </div>
                        </div>

                        <!-- Benefit Section -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Kelebihan Bimbel</h2>
                            <div class="mb-4">
                                <label for="benefit_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Kelebihan</label>
                                <input type="text" name="benefit_title" id="benefit_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bimbel['benefit_title'] ?? '' }}">
                            </div>

                            <div class="mb-4">
                                <label for="benefit_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi Kelebihan</label>
                                <textarea name="benefit_description" id="benefit_description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $bimbel['benefit_description'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Informasi Bimbel Section -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Bimbel</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="age_range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Rentang Usia</label>
                                    <input type="text" name="age_range" id="age_range" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bimbel['age_range'] ?? '' }}">
                                </div>

                                <div class="mb-4">
                                    <label for="operating_hours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jam Operasional</label>
                                    <input type="text" name="operating_hours" id="operating_hours" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bimbel['operating_hours'] ?? '' }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="operating_days" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Hari Operasional</label>
                                <input type="text" name="operating_days" id="operating_days" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bimbel['operating_days'] ?? '' }}">
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jenis Layanan</label>
                                <div id="service_types_container">
                                    @if(isset($bimbel['service_types']))
                                        @foreach($bimbel['service_types'] as $index => $service)
                                            <div class="input-group mb-2 service-type">
                                                <div class="flex items-center gap-2">
                                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="service_types[]" value="{{ $service }}">
                                                    <button type="button" class="remove-service-type text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" id="add_service_type" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Tambah Jenis Layanan
                                </button>
                            </div>
                        </div>

                        <!-- Program Section -->
                        <div class="content-section">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Program Bimbel</h5>
                                    <p class="text-secondary">Informasi tentang program bimbel yang ditawarkan.</p>

                                    <div class="mb-4">
                                        <label for="program_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul Program</label>
                                        <input type="text" name="program_title" id="program_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bimbel['program_title'] ?? '' }}" placeholder="Masukkan judul program">
                                    </div>

                                    <div class="mb-4">
                                        <label for="program_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi Program</label>
                                        <textarea name="program_description" id="program_description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan deskripsi program">{{ $bimbel['program_description'] ?? '' }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Program Points</label>
                                        <div id="program_points_container">
                                            @if(isset($bimbel['program_points']))
                                                @foreach($bimbel['program_points'] as $index => $point)
                                                    <div class="program-point-item flex items-center gap-2 mb-2">
                                                        <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $point }}" placeholder="Masukkan point program">
                                                        <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="program-point-item flex items-center gap-2 mb-2">
                                                    <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan point program">
                                                    <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button" id="add_program_point" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Tambah Point Program
                                        </button>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Program</label>
                                        <div class="flex items-center space-x-4">
                                            @if(isset($bimbel['program_image']))
                                                <img src="{{ asset('storage/' . $bimbel['program_image']) }}" alt="Program Preview" class="image-preview mb-2">
                                            @endif
                                            <div class="flex-1">
                                                <input type="file" name="program_image" id="program_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
                                                <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">PNG, JPG atau JPEG (Maks. 2MB)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fasilitas Section -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Fasilitas Bimbel</h2>
                            <div id="facility_container">
                                @if(isset($bimbel['facilities']))
                                    @foreach($bimbel['facilities'] as $index => $facility)
                                    <div class="facility-item border rounded-lg p-4 mb-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Fasilitas</label>
                                                <input type="text" name="facility_items[{{ $index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $facility['title'] }}" required>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi</label>
                                                <input type="text" name="facility_items[{{ $index }}][description]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $facility['description'] }}" required>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Fasilitas</label>
                                            @if(isset($facility['image']))
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $facility['image']) }}" alt="{{ $facility['title'] }}" class="image-preview">
                                            </div>
                                            @endif
                                            <input type="file" name="facility_items[{{ $index }}][image]" class="facility-image-input block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*" onchange="previewImage(this)">
                                            <div class="mt-2 hidden preview-container">
                                                <img class="preview-image max-w-xs h-auto rounded-lg shadow-xl dark:shadow-gray-800" src="" alt="Preview">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="button" class="remove-facility text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                Hapus Fasilitas
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add-facility" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Tambah Fasilitas
                            </button>
                        </div>

                        <!-- Pricing Section -->
                        <div class="content-section">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Harga Bimbel</h5>
                                    <p class="text-secondary">Informasi harga program bimbel yang ditawarkan.</p>

                                    <div id="pricing_items_container">
                                        @if(isset($bimbel['pricing_items']))
                                            @foreach($bimbel['pricing_items'] as $index => $item)
                                            <div class="pricing-item border rounded-lg p-4 mb-4">
                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Layanan/Bimbel</label>
                                                    <input type="text" name="pricing_items[{{ $index }}][service]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['service'] }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jenjang Tersedia</label>
                                                    <input type="text" name="pricing_items[{{ $index }}][levels]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['levels'] }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Promo Pendaftaran*</label>
                                                    <input type="text" name="pricing_items[{{ $index }}][registration_promo]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['registration_promo'] }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif / Pertemuan</label>
                                                    <input type="number" name="pricing_items[{{ $index }}][price_per_session]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['price_per_session'] }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif / Pertemuan Promo 25%**</label>
                                                    <input type="number" name="pricing_items[{{ $index }}][price_per_session_promo]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['price_per_session_promo'] }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif Bulanan</label>
                                                    <input type="number" name="pricing_items[{{ $index }}][monthly_price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['monthly_price'] }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif Bulanan Promo**</label>
                                                    <input type="number" name="pricing_items[{{ $index }}][monthly_price_promo]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['monthly_price_promo'] }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jumlah Pertemuan/Sebulan</label>
                                                    <input type="number" name="pricing_items[{{ $index }}][sessions_per_month]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $item['sessions_per_month'] }}" required>
                                                </div>

                                                <button type="button" class="remove-pricing text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                    Hapus Paket
                                                </button>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <button type="button" id="add_pricing_item" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="fas fa-plus mr-2"></i> Tambah Paket Harga
                                    </button>
                                </div>
                            </div>
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
        // Toggle banner type containers
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
                newItem.className = 'program-point-item flex items-center gap-2 mb-2';
                newItem.innerHTML = `
                    <input type="text" name="program_points[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan point program">
                    <button type="button" class="remove-program-point text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                `;
                programPointsContainer.appendChild(newItem);
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-program-point')) {
                    e.target.closest('.program-point-item').remove();
                }
            });
        }

        // Service types
        const addServiceTypeBtn = document.getElementById('add_service_type');
        const serviceTypesContainer = document.getElementById('service_types_container');

        if (addServiceTypeBtn && serviceTypesContainer) {
            addServiceTypeBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'input-group mb-2 service-type';
                newItem.innerHTML = `
                    <div class="flex items-center gap-2">
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="service_types[]" placeholder="Jenis Layanan">
                        <button type="button" class="remove-service-type text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                `;
                serviceTypesContainer.appendChild(newItem);
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-service-type')) {
                    e.target.closest('.service-type').remove();
                }
            });
        }

        // Handle add pricing item
        const addPricingItemBtn = document.getElementById('add_pricing_item');
        const pricingItemsContainer = document.getElementById('pricing_items_container');

        if (addPricingItemBtn && pricingItemsContainer) {
            addPricingItemBtn.addEventListener('click', function() {
                const index = document.querySelectorAll('.pricing-item').length;
                const template = `
                    <div class="pricing-item border rounded-lg p-4 mb-4">
                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Layanan/Bimbel</label>
                            <input type="text" name="pricing_items[${index}][service]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jenjang Tersedia</label>
                            <input type="text" name="pricing_items[${index}][levels]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Promo Pendaftaran*</label>
                            <input type="text" name="pricing_items[${index}][registration_promo]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif / Pertemuan</label>
                            <input type="number" name="pricing_items[${index}][price_per_session]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif / Pertemuan Promo 25%**</label>
                            <input type="number" name="pricing_items[${index}][price_per_session_promo]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif Bulanan</label>
                            <input type="number" name="pricing_items[${index}][monthly_price]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Tarif Bulanan Promo**</label>
                            <input type="number" name="pricing_items[${index}][monthly_price_promo]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Jumlah Pertemuan/Sebulan</label>
                            <input type="number" name="pricing_items[${index}][sessions_per_month]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <button type="button" class="remove-pricing text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                            <i class="fas fa-trash mr-2"></i> Hapus Paket
                        </button>
                    </div>
                `;
                pricingItemsContainer.insertAdjacentHTML('beforeend', template);
            });

            // Handle remove pricing item
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-pricing')) {
                    e.target.closest('.pricing-item').remove();
                }
            });
        }

        // Facilities
        const addFacilityBtn = document.getElementById('add-facility');
        const facilityContainer = document.getElementById('facility_container');
        let facilityCounter = document.querySelectorAll('.facility-item').length;

        if (addFacilityBtn && facilityContainer) {
            addFacilityBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'facility-item border rounded-lg p-4 mb-4';
                newItem.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nama Fasilitas</label>
                            <input type="text" name="facility_items[${facilityCounter}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi</label>
                            <input type="text" name="facility_items[${facilityCounter}][description]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Fasilitas</label>
                        <input type="file" name="facility_items[${facilityCounter}][image]" class="facility-image-input block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*" onchange="previewImage(this)">
                        <div class="mt-2 hidden preview-container">
                            <img class="preview-image max-w-xs h-auto rounded-lg shadow-xl dark:shadow-gray-800" src="" alt="Preview">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="remove-facility text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                            Hapus Fasilitas
                        </button>
                    </div>
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
    });

    // Image preview function
    function previewImage(input) {
        const previewContainer = input.parentElement.querySelector('.preview-container');
        const previewImage = previewContainer.querySelector('.preview-image');

        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Mohon upload file gambar saja (JPG, PNG, GIF, etc.)');
                input.value = '';
                return;
            }

            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                input.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
            previewImage.src = '';
        }
    }

    // Add preview functionality to existing facility images
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.facility-image-input').forEach(input => {
            input.addEventListener('change', function() {
                previewImage(this);
            });
        });
    });
</script>
@endsection
