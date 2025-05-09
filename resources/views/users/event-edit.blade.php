@extends('users.layouts.app')

@section('title', 'Edit Event')

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
                        <h6 class="text-bgray-900 dark:text-white">Edit Data Halaman Event</h6>
                        @if(!isset($data['events']) || count($data['events']) < 4)
                        <button type="button" id="add_new_event" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Event Baru
                        </button>
                        @else
                        <span class="text-yellow-600 bg-yellow-100 px-3 py-2 rounded-lg text-sm">Maksimal 4 event telah tercapai</span>
                        @endif
                    </div>
                </div>

                <div class="flex-auto p-6 bg-white dark:bg-darkblack-600">
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

                    @if (session('error'))
                    <div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
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

                    <form action="{{ route('event.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div id="events_container">
                            @if(isset($data['events']) && is_array($data['events']))
                                @foreach($data['events'] as $eventIndex => $eventData)
                                <div class="event-item mb-8 p-6 bg-gray-50 dark:bg-darkblack-600 rounded-lg relative">
                                    @if(count($data['events']) > 1)
                                    <button type="button" class="remove-event absolute top-4 right-4 text-red-600 hover:text-red-800">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    @endif

                                    <div class="flex items-center mb-4">
                                        <div class="flex-grow flex items-center">
                                            <h2 class="text-lg font-semibold dark:text-white mr-4">Event #{{ $eventIndex + 1 }}</h2>
                                            @if(isset($eventData['about_event']['created_at']))
                                                <span class="text-sm text-gray-500">Dibuat: {{ date('d M Y H:i', strtotime($eventData['about_event']['created_at'])) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Pilih Jenis Banner</label>
                                            <div class="flex space-x-4">
                                                <div class="flex items-center">
                                                    <input type="radio" name="events[{{ $eventIndex }}][banner_type]" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" {{ isset($eventData['banner_type']) && $eventData['banner_type'] === 'image' ? 'checked' : (!isset($eventData['banner_type']) ? 'checked' : '') }}>
                                                    <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Gambar</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" name="events[{{ $eventIndex }}][banner_type]" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" {{ isset($eventData['banner_type']) && $eventData['banner_type'] === 'video' ? 'checked' : '' }}>
                                                    <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Video YouTube</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="banner_image_container" class="mb-4 {{ !isset($eventData['banner_type']) || $eventData['banner_type'] == 'image' ? '' : 'hidden' }}">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Banner</label>
                                            <div class="flex items-center space-x-4">
                                                @if(isset($eventData['banner_image']))
                                                <img src="{{ asset($eventData['banner_image']) }}" alt="Banner Preview" class="image-preview mb-2">
                                                @endif
                                                <input type="file" name="events[{{ $eventIndex }}][banner_image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                                        </div>

                                        <div id="banner_video_container" class="mb-4 {{ isset($eventData['banner_type']) && $eventData['banner_type'] == 'video' ? '' : 'hidden' }}">
                                            <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Link Video YouTube</label>
                                            <input type="text" name="events[{{ $eventIndex }}][banner_video]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=..." value="{{ $eventData['banner_video'] ?? '' }}">
                                            <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Event</h2>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Event</label>
                                            <input type="text" name="events[{{ $eventIndex }}][event_title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" value="{{ $eventData['event_title'] ?? '' }}" required>
                                        </div>

                                        <div class="descriptions-container">
                                            @if(isset($eventData['descriptions']) && is_array($eventData['descriptions']))
                                                @foreach($eventData['descriptions'] as $descIndex => $description)
                                                <div class="description-item mb-6 bg-white dark:bg-darkblack-600 p-4 rounded-lg">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <h3 class="text-md font-medium text-gray-900 dark:text-bgray-50">Deskripsi #{{ $descIndex + 1 }}</h3>
                                                        <button type="button" class="remove-description text-red-600 hover:text-red-800">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                                        <input type="text" name="events[{{ $eventIndex }}][descriptions][{{ $descIndex }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $description['title'] }}" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                                        <textarea name="events[{{ $eventIndex }}][descriptions][{{ $descIndex }}][content]" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>{{ $description['content'] }}</textarea>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <button type="button" class="add-description text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Tambah Deskripsi
                                        </button>
                                    </div>

                                    <div class="mb-8">
                                        <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">About Event</h2>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usia</label>
                                                <input type="text" name="events[{{ $eventIndex }}][about_event][usia]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" value="{{ $eventData['about_event']['usia'] ?? '' }}" required>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya</label>
                                                <input type="text" name="events[{{ $eventIndex }}][about_event][biaya]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" value="{{ $eventData['about_event']['biaya'] ?? '' }}" required>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                                <input type="text" name="events[{{ $eventIndex }}][about_event][tanggal]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" value="{{ $eventData['about_event']['tanggal'] ?? '' }}" required>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan</label>
                                                <input type="text" name="events[{{ $eventIndex }}][about_event][kegiatan]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" value="{{ $eventData['about_event']['kegiatan'] ?? '' }}" required>
                                            </div>
                                        </div>

                                        <input type="hidden" name="events[{{ $eventIndex }}][about_event][created_at]" value="{{ $eventData['about_event']['created_at'] ?? date('Y-m-d\TH:i') }}">

                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">List Kegiatan</label>
                                            <div class="activities-container space-y-2">
                                                @if(isset($eventData['about_event']['activities']) && is_array($eventData['about_event']['activities']))
                                                    @foreach($eventData['about_event']['activities'] as $actIndex => $activity)
                                                    <div class="activity-item flex items-center gap-2">
                                                        <span class="text-gray-500">-</span>
                                                        <input type="text" name="events[{{ $eventIndex }}][about_event][activities][]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 flex-1 p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" value="{{ $activity }}" required>
                                                        <button type="button" class="remove-activity text-red-600 hover:text-red-800">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="button" class="add-activity mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Tambah Kegiatan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <!-- Template for first event -->
                                <div class="event-item mb-8 p-6 bg-gray-50 dark:bg-darkblack-600 rounded-lg relative">
                                    <div class="flex items-center mb-4">
                                        <div class="flex-grow flex items-center">
                                            <h2 class="text-lg font-semibold dark:text-white mr-4">Event Baru</h2>
                                            <span class="text-sm text-gray-500">Dibuat: {{ date('d M Y H:i') }}</span>
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Pilih Jenis Banner</label>
                                            <div class="flex space-x-4">
                                                <div class="flex items-center">
                                                    <input type="radio" name="events[0][banner_type]" value="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" checked>
                                                    <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Gambar</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" name="events[0][banner_type]" value="video" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" {{ isset($event['banner_type']) && $event['banner_type'] == 'video' ? 'checked' : '' }}>
                                                    <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Video YouTube</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="banner_image_container" class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Banner</label>
                                            <div class="flex items-center space-x-4">
                                                <input type="file" name="events[0][banner_image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                                        </div>

                                        <div id="banner_video_container" class="mb-4 hidden">
                                            <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Video YouTube</label>
                                            <input type="text" name="events[0][banner_video]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=...">
                                            <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Event</h2>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Event</label>
                                            <input type="text" name="events[0][event_title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                                        </div>

                                        <div class="descriptions-container">
                                            <!-- Descriptions will be added here -->
                                        </div>

                                        <button type="button" class="add-description text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Tambah Deskripsi
                                        </button>
                                    </div>

                                    <div class="mb-8">
                                        <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">About Event</h2>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usia</label>
                                                <input type="text" name="events[0][about_event][usia]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya</label>
                                                <input type="text" name="events[0][about_event][biaya]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                                <input type="text" name="events[0][about_event][tanggal]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan</label>
                                                <input type="text" name="events[0][about_event][kegiatan]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                                            </div>
                                        </div>

                                        <input type="hidden" name="events[0][about_event][created_at]" value="{{ date('Y-m-d\TH:i') }}">

                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">List Kegiatan</label>
                                            <div class="activities-container space-y-2">
                                                <!-- Activities will be added here -->
                                            </div>
                                            <button type="button" class="add-activity mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Tambah Kegiatan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Informasi Kerja Sama -->
                        <div class="mt-10 border-t pt-6 mb-8 p-6 bg-gray-50 dark:bg-darkblack-600 rounded-lg">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Kerja Sama</h2>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Subtitle</label>
                                <input type="text" name="collaboration[subtitle]" value="{{ $data['collaboration']['subtitle'] ?? '' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Judul</label>
                                <input type="text" name="collaboration[title]" value="{{ $data['collaboration']['title'] ?? '' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Deskripsi</label>
                                <textarea name="collaboration[description]" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>{{ $data['collaboration']['description'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Nomor WhatsApp</label>
                                <input type="text" name="collaboration[contact][whatsapp]" value="{{ $data['collaboration']['contact']['whatsapp'] ?? '' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                                <p class="mt-1 text-sm text-gray-500">Format: 628xxxxxxxxxx (tanpa tanda + atau spasi)</p>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Pesan WhatsApp Default</label>
                                <textarea name="collaboration[contact][message]" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>{{ $data['collaboration']['contact']['message'] ?? '' }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Kerja Sama</label>
                                @if(isset($data['collaboration']['image']))
                                    <img src="{{ asset($data['collaboration']['image']) }}" alt="Collaboration Preview" class="mb-2 max-w-xs">
                                @endif
                                <input type="file" name="collaboration[image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
                            </div>
                        </div>

                        <!-- Galeri Event -->
                        <div class="mb-8 p-6 bg-gray-50 dark:bg-darkblack-600 rounded-lg">
                            <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Galeri Event</h2>
                            <p class="mb-4 text-sm text-gray-500 dark:text-bgray-300">Untuk mengelola galeri, silakan menggunakan halaman <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:underline dark:text-blue-400">manajemen galeri</a> dan pilih kategori "Event".</p>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Semua Data</button>
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
    const eventsContainer = document.getElementById('events_container');
    const addNewEventBtn = document.getElementById('add_new_event');
    let eventCount = document.querySelectorAll('.event-item').length;
    const MAX_EVENTS = 4;

    console.log('Initial event count:', eventCount);

    // Cek jika sudah mencapai batas maksimal event
    function checkMaxEvents() {
        console.log('Checking max events, current count:', eventCount);
        if (eventCount >= MAX_EVENTS) {
            if (addNewEventBtn) {
                addNewEventBtn.style.display = 'none';
                // Tambahkan pesan peringatan jika belum ada
                if (!document.querySelector('.max-events-warning')) {
                    const warningMessage = document.createElement('span');
                    warningMessage.className = 'max-events-warning text-yellow-600 bg-yellow-100 px-3 py-2 rounded-lg text-sm';
                    warningMessage.textContent = 'Maksimal ' + MAX_EVENTS + ' event telah tercapai';
                    addNewEventBtn.parentNode.appendChild(warningMessage);
                }
            }
        } else {
            if (addNewEventBtn) {
                addNewEventBtn.style.display = 'inline-flex';
                // Hapus pesan peringatan jika ada
                const warningMessage = document.querySelector('.max-events-warning');
                if (warningMessage) {
                    warningMessage.remove();
                }
            }
        }
    }

    // Panggil fungsi saat halaman dimuat
    checkMaxEvents();

    // Add new event
    if (addNewEventBtn) {
        addNewEventBtn.addEventListener('click', function() {
            console.log('Add event button clicked, current count:', eventCount);
            if (eventCount >= MAX_EVENTS) {
                alert('Maksimal ' + MAX_EVENTS + ' event telah tercapai.');
                return;
            }

            const newEventIndex = eventCount;
            const newEvent = document.createElement('div');
            newEvent.className = 'event-item mb-8 p-6 bg-gray-50 dark:bg-darkblack-600 rounded-lg relative';

            // Generate event template HTML
            newEvent.innerHTML = `
                ${eventCount > 0 ? `
                <button type="button" class="remove-event absolute top-4 right-4 text-red-600 hover:text-red-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
                ` : ''}

                <div class="flex items-center mb-4">
                    <div class="flex-grow flex items-center">
                        <h2 class="text-lg font-semibold dark:text-white mr-4">Event Baru</h2>
                        <span class="text-sm text-gray-500">Dibuat: ${new Date().toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'})}</span>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Banner Utama</h2>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Pilih Jenis Banner</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input type="radio" name="events[${newEventIndex}][banner_type]" value="image" class="banner-type-radio w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400" checked>
                                <label for="banner_type_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Gambar</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="events[${newEventIndex}][banner_type]" value="video" class="banner-type-radio w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-darkblack-500 dark:border-darkblack-400">
                                <label for="banner_type_video" class="ms-2 text-sm font-medium text-gray-900 dark:text-bgray-300">Video YouTube</label>
                            </div>
                        </div>
                    </div>

                    <div class="banner-image-container mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Gambar Banner</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" name="events[${newEventIndex}][banner_image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-bgray-300 focus:outline-none dark:bg-darkblack-500 dark:border-darkblack-400" accept="image/*">
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Ukuran yang direkomendasikan: 1200 x 400 pixel</p>
                    </div>

                    <div class="banner-video-container mb-4 hidden">
                        <label for="banner_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-bgray-50">Link Video YouTube</label>
                        <input type="text" name="events[${newEventIndex}][banner_video]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=...">
                        <p class="mt-1 text-sm text-gray-500 dark:text-bgray-300">Contoh: https://www.youtube.com/watch?v=XXXXXXXXXXX</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">Informasi Event</h2>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Event</label>
                        <input type="text" name="events[${newEventIndex}][event_title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                    </div>

                    <div class="descriptions-container">
                        <!-- Descriptions will be added here -->
                    </div>

                    <button type="button" class="add-description text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Deskripsi
                    </button>
                </div>

                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4 border-b pb-2 dark:text-white">About Event</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usia</label>
                            <input type="text" name="events[${newEventIndex}][about_event][usia]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya</label>
                            <input type="text" name="events[${newEventIndex}][about_event][biaya]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                            <input type="text" name="events[${newEventIndex}][about_event][tanggal]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan</label>
                            <input type="text" name="events[${newEventIndex}][about_event][kegiatan]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                        </div>
                    </div>

                    <input type="hidden" name="events[${newEventIndex}][about_event][created_at]" value="${new Date().toISOString().slice(0, 16)}">

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">List Kegiatan</label>
                        <div class="activities-container space-y-2">
                            <!-- Activities will be added here -->
                        </div>
                        <button type="button" class="add-activity mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Kegiatan
                        </button>
                    </div>
                </div>
            `;

            // Insert at the beginning of the container instead of appending to the end
            eventsContainer.insertBefore(newEvent, eventsContainer.firstChild);
            eventCount++;
            console.log('Event added, new count:', eventCount);

            // Update remove buttons visibility
            updateRemoveButtons();

            // Cek jika sudah mencapai batas maksimal
            checkMaxEvents();

            // Initialize event handlers for the new event
            initializeEventHandlers(newEvent);

            // Reindex all events after adding the new one
            reindexEvents();
        });
    }

    // Remove event
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-event')) {
            const eventItem = e.target.closest('.event-item');
            eventItem.remove();
            eventCount--;
            console.log('Event removed, new count:', eventCount);
            updateRemoveButtons();
            reindexEvents();

            // Update tampilan tombol tambah event
            checkMaxEvents();
        }
    });

    // Update remove buttons visibility
    function updateRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-event');
        removeButtons.forEach(button => {
            button.style.display = eventCount > 1 ? 'block' : 'none';
        });
    }

    // Reindex events after removal
    function reindexEvents() {
        const events = document.querySelectorAll('.event-item');
        events.forEach((event, index) => {
            // Update all input names to reflect new index
            event.querySelectorAll('input, textarea').forEach(input => {
                if (input.name) {
                    input.name = input.name.replace(/events\[\d+\]/, `events[${index}]`);
                }
            });
        });
    }

    // Initialize handlers for banner type toggle
    function initializeEventHandlers(eventElement) {
        console.log('Initializing event handlers for new element');

        // Handle banner type selection
        const radioButtons = eventElement.querySelectorAll('input[type="radio"][name^="events"][name$="[banner_type]"]');
        const imageContainer = eventElement.querySelector('.banner-image-container');
        const videoContainer = eventElement.querySelector('.banner-video-container');

        console.log('Found radio buttons:', radioButtons.length);
        console.log('Image container:', imageContainer ? 'yes' : 'no');
        console.log('Video container:', videoContainer ? 'yes' : 'no');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                console.log('Radio button changed to:', this.value);
                if (this.value === 'image') {
                    imageContainer.classList.remove('hidden');
                    videoContainer.classList.add('hidden');
                } else {
                    imageContainer.classList.add('hidden');
                    videoContainer.classList.remove('hidden');
                }
            });
        });

        // Initialize description handlers
        const addDescriptionBtn = eventElement.querySelector('.add-description');
        const descriptionsContainer = eventElement.querySelector('.descriptions-container');
        let descriptionCount = descriptionsContainer.querySelectorAll('.description-item').length;

        addDescriptionBtn.addEventListener('click', function() {
            const eventIndex = Array.from(eventsContainer.children).indexOf(eventElement);
            const newDescription = document.createElement('div');
            newDescription.className = 'description-item mb-6 bg-white dark:bg-darkblack-600 p-4 rounded-lg';
            newDescription.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-md font-medium text-gray-900 dark:text-bgray-50">Deskripsi #${descriptionCount + 1}</h3>
                    <button type="button" class="remove-description text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                    <input type="text" name="events[${eventIndex}][descriptions][${descriptionCount}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea name="events[${eventIndex}][descriptions][${descriptionCount}][content]" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                </div>
            `;
            descriptionsContainer.appendChild(newDescription);
            descriptionCount++;
        });

        // Initialize activity handlers
        const addActivityBtn = eventElement.querySelector('.add-activity');
        const activitiesContainer = eventElement.querySelector('.activities-container');

        addActivityBtn.addEventListener('click', function() {
            const eventIndex = Array.from(eventsContainer.children).indexOf(eventElement);
            const newActivity = document.createElement('div');
            newActivity.className = 'activity-item flex items-center gap-2';
            newActivity.innerHTML = `
                <span class="text-gray-500">-</span>
                <input type="text" name="events[${eventIndex}][about_event][activities][]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 flex-1 p-2.5 dark:bg-darkblack-500 dark:border-darkblack-400 dark:text-white dark:placeholder-gray-400" required>
                <button type="button" class="remove-activity text-red-600 hover:text-red-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            `;
            activitiesContainer.appendChild(newActivity);
        });
    }

    // Initialize handlers for existing events
    document.querySelectorAll('.event-item').forEach(eventElement => {
        initializeEventHandlers(eventElement);
    });

    // Handle removal of descriptions and activities
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-description')) {
            const descriptionItem = e.target.closest('.description-item');
            const descriptionsContainer = descriptionItem.closest('.descriptions-container');
            descriptionItem.remove();
            updateDescriptionNumbers(descriptionsContainer);
        }

        if (e.target.closest('.remove-activity')) {
            e.target.closest('.activity-item').remove();
        }
    });

    // Update description numbers after removal
    function updateDescriptionNumbers(container) {
        container.querySelectorAll('.description-item').forEach((item, index) => {
            item.querySelector('h3').textContent = `Deskripsi #${index + 1}`;
            const eventIndex = Array.from(eventsContainer.children).indexOf(item.closest('.event-item'));
            const titleInput = item.querySelector('input[name^="events"]');
            const contentTextarea = item.querySelector('textarea[name^="events"]');

            titleInput.name = `events[${eventIndex}][descriptions][${index}][title]`;
            contentTextarea.name = `events[${eventIndex}][descriptions][${index}][content]`;
        });
    }

    // Initial setup
    updateRemoveButtons();
    checkMaxEvents();
});
</script>
@endsection
