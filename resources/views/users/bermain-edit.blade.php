@extends('users.layouts.app')

@section('title', 'Edit Area Bermain')

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
                        <h6 class="dark:text-white">Edit Data Halaman Area Bermain</h6>
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

                    <form action="{{ route('update.bermain') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Banner Utama -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Jenis Banner</label>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_image" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ isset($bermain['banner_type']) && $bermain['banner_type'] == 'image' ? 'checked' : (!isset($bermain['banner_type']) ? 'checked' : '') }}>
                                        <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gambar</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="banner_type" id="banner_type_video" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ isset($bermain['banner_type']) && $bermain['banner_type'] == 'video' ? 'checked' : '' }}>
                                        <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Video YouTube</label>
                                    </div>
                                </div>
                            </div>

                            <div id="banner_image_container" class="mb-4 {{ !isset($bermain['banner_type']) || $bermain['banner_type'] == 'image' ? '' : 'hidden' }}">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Banner</label>
                                <div class="flex items-center space-x-4">
                                    @if(isset($bermain['banner_image']))
                                        <img src="{{ asset('storage/' . $bermain['banner_image']) }}" alt="Banner Preview" class="image-preview mb-2">
                                    @endif
                                    <input type="file" name="banner_image" id="banner_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                            </div>

                            <div id="banner_video_container" class="mb-4 {{ isset($bermain['banner_type']) && $bermain['banner_type'] == 'video' ? '' : 'hidden' }}">
                                <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Video YouTube</label>
                                <input type="text" name="banner_video" id="banner_video" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=..." value="{{ $bermain['banner_video'] ?? '' }}">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                            </div>
                        </div>

                        <!-- Kelebihan Area Bermain -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Kelebihan Area Bermain</h2>

                            <div class="mb-4">
                                <label for="benefit_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Kelebihan</label>
                                <input type="text" id="benefit_title" name="benefit_title" value="{{ $bermain['benefit_title'] ?? 'Kelebihan Area Bermain Kami' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label for="benefit_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Kelebihan</label>
                                <textarea id="benefit_description" name="benefit_description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $bermain['benefit_description'] ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus itaque rem quae alias facere ipsum in maiores cupiditate modi, magnam qui natus beatae nam aut voluptate, neque quibusdam reiciendis aliquid atque. Necessitatibus praesentium maiores, modi ratione nostrum vel odit recusandae!' }}</textarea>
                            </div>
                        </div>

                        <!-- Informasi Area Bermain -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Area Bermain</h2>

                            <div class="mb-4">
                                <label for="info_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Informasi</label>
                                <input type="text" id="info_title" name="info_title" value="{{ $bermain['info_title'] ?? 'About Area Bermain' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="age_range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rentang Usia</label>
                                    <input type="text" id="age_range" name="age_range" value="{{ $bermain['age_range'] ?? '6 bln - 12 y.o' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label for="operating_hours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Operasional</label>
                                    <input type="text" id="operating_hours" name="operating_hours" value="{{ $bermain['operating_hours'] ?? '9:00 - 17:00' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label for="operating_days" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hari Operasional</label>
                                    <input type="text" id="operating_days" name="operating_days" value="{{ $bermain['operating_days'] ?? 'Senin-Sabtu' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label for="cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya</label>
                                    <textarea id="cost" name="cost" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $bermain['cost'] ?? '15k perJam
45k sepuasnya
(max 6jam)' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Fasilitas</h2>

                            <div class="mb-4">
                                <label for="facility_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Fasilitas</label>
                                <input type="text" id="facility_title" name="facility_title" value="{{ $bermain['facility_title'] ?? 'Area Bermain' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div id="facilities-container">
                                @if(isset($bermain) && isset($bermain['facilities']))
                                    @foreach($bermain['facilities'] as $index => $facility)
                                        <div class="facility-item border rounded-lg p-4 mb-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <h4 class="font-semibold dark:text-white">Fasilitas {{ $index + 1 }}</h4>
                                                <button type="button" class="remove-facility text-red-500">Hapus</button>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Fasilitas</label>
                                                    <input type="text" name="facility_name[]" value="{{ $facility['name'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                                                    @if(isset($facility['image']))
                                                        <div class="mb-2">
                                                            <img src="{{ asset('storage/' . $facility['image']) }}" alt="Facility Image" class="image-preview">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="facility_image[]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                    <input type="hidden" name="existing_facility_image[]" value="{{ $facility['image'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="facility-item border rounded-lg p-4 mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <h4 class="font-semibold dark:text-white">Fasilitas 1</h4>
                                            <button type="button" class="remove-facility text-red-500">Hapus</button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Fasilitas</label>
                                                <input type="text" name="facility_name[]" value="Full AC" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                                                <input type="file" name="facility_image[]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                <input type="hidden" name="existing_facility_image[]" value="">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <button type="button" id="add-facility" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">Tambah Fasilitas</button>
                        </div>

                        <!-- Galeri -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Galeri</h2>

                            <div class="mb-8">
                                <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Untuk mengelola galeri, silakan menggunakan halaman <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:underline dark:text-blue-500">manajemen galeri</a> dan pilih kategori "Area Main".</p>
                            </div>



                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700">Simpan Perubahan</button>
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

        // Add Facility
        const addFacilityBtn = document.getElementById('add-facility');
        const facilitiesContainer = document.getElementById('facilities-container');

        addFacilityBtn.addEventListener('click', function() {
            const facilityCount = document.querySelectorAll('.facility-item').length;
            const newFacility = document.createElement('div');
            newFacility.className = 'facility-item border rounded-lg p-4 mb-4';
            newFacility.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold dark:text-white">Fasilitas ${facilityCount + 1}</h4>
                    <button type="button" class="remove-facility text-red-500">Hapus</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Fasilitas</label>
                        <input type="text" name="facility_name[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Fasilitas</label>
                        <input type="file" name="facility_image[]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <input type="hidden" name="existing_facility_image[]" value="">
                    </div>
                </div>
            `;
            facilitiesContainer.appendChild(newFacility);
        });

        // Remove Facility
        facilitiesContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-facility')) {
                const facilityItem = e.target.closest('.facility-item');
                if (document.querySelectorAll('.facility-item').length > 1) {
                    facilityItem.remove();
                } else {
                    alert('Minimal harus ada satu fasilitas');
                }
            }
        });
    });
</script>
@endsection
