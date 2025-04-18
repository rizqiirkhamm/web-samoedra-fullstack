@extends('users.layouts.app')

@section('title', 'Kelola Galeri')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0">
                    <div class="flex items-center justify-between">
                        <h6 class="dark:text-white">Daftar Galeri</h6>
                        @if($canEdit)
                        <button type="button" data-modal-target="tambahGaleri" data-modal-toggle="tambahGaleri" class="text-white bg-[#3E5467] hover:bg-[#576B81] font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Galeri
                        </button>
                        @endif
                    </div>
                </div>

                <div class="flex-auto p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($galleries as $gallery)
                        <div class="relative group">
                            <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center space-x-2">
                                    @if($canEdit)
                                    <button type="button" data-modal-target="editGaleri{{ $gallery->id }}" data-modal-toggle="editGaleri{{ $gallery->id }}" class="text-white bg-blue-600 hover:bg-blue-700 rounded-full p-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    @endif
                                    @if($canDelete)
                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 rounded-full p-2" onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-[#E8A26A]">{{ $gallery->category }}</p>
                                <h3 class="text-lg font-semibold text-[#3E5467]">{{ $gallery->title }}</h3>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-12">
                            <img src="{{ asset('images/assets/ikan2.svg') }}" alt="No Galleries" class="w-32 h-32 mb-4 animate-float">
                            <h3 class="text-lg font-semibold text-[#3E5467]">Belum Ada Galeri</h3>
                            <p class="text-gray-500">Silakan tambahkan galeri baru</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($galleries->hasPages())
                    <div class="flex items-center justify-between mt-4 px-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-700 dark:text-gray-400">
                                Showing {{ $galleries->firstItem() }}-{{ $galleries->lastItem() }} of {{ $galleries->total() }}
                            </span>
                        </div>
                        <div class="flex justify-end space-x-2">
                            @if ($galleries->onFirstPage())
                                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed dark:bg-gray-700 dark:text-gray-400">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $galleries->previousPageUrl() }}" class="px-3 py-1 text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800">
                                    Previous
                                </a>
                            @endif

                            <div class="flex space-x-2">
                                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                                    @if($page == $galleries->currentPage())
                                        <span class="px-3 py-1 text-white bg-blue-600 rounded-md dark:bg-blue-600">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="px-3 py-1 text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            @if ($galleries->hasMorePages())
                                <a href="{{ $galleries->nextPageUrl() }}" class="px-3 py-1 text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800">
                                    Next
                                </a>
                            @else
                                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed dark:bg-gray-700 dark:text-gray-400">
                                    Next
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Galeri -->
<div id="tambahGaleri" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Galeri Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="tambahGaleri">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-6">
                    <div class="mb-4">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Daycare">Daycare</option>
                            <option value="Area Main">Area Main</option>
                            <option value="Bimbel">Bimbel</option>
                            <option value="Kelas Stimulasi">Kelas Stimulasi</option>
                            <option value="Event">Event</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                        <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400" accept="image/*" required>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" data-modal-hide="tambahGaleri">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Galeri -->
@foreach($galleries as $gallery)
<div id="editGaleri{{ $gallery->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Galeri</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editGaleri{{ $gallery->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-6">
                    <div class="mb-4">
                        <label for="title{{ $gallery->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                        <input type="text" name="title" id="title{{ $gallery->id }}" value="{{ $gallery->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="mb-4">
                        <label for="category{{ $gallery->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="category" id="category{{ $gallery->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="Daycare" {{ $gallery->category == 'Daycare' ? 'selected' : '' }}>Daycare</option>
                            <option value="Area Main" {{ $gallery->category == 'Area Main' ? 'selected' : '' }}>Area Main</option>
                            <option value="Bimbel" {{ $gallery->category == 'Bimbel' ? 'selected' : '' }}>Bimbel</option>
                            <option value="Kelas Stimulasi" {{ $gallery->category == 'Kelas Stimulasi' ? 'selected' : '' }}>Kelas Stimulasi</option>
                            <option value="Event" {{ $gallery->category == 'Event' ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="image{{ $gallery->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                        <input type="file" name="image" id="image{{ $gallery->id }}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*">
                        <p class="mt-1 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar</p>
                    </div>
                </div>
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white bg-[#3E5467] hover:bg-[#576B81] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Perubahan</button>
                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5" data-modal-hide="editGaleri{{ $gallery->id }}">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi modal menggunakan Flowbite
        const $modalElement = document.querySelector('#tambahGaleri');

        if ($modalElement) {
            const modal = new Flowbite.Modal($modalElement, {
                placement: 'center-center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true
            });

            // Tombol untuk membuka modal
            const $buttonElement = document.querySelector('[data-modal-toggle="tambahGaleri"]');
            if ($buttonElement) {
                $buttonElement.addEventListener('click', () => {
                    modal.show();
                });
            }

            // Tombol untuk menutup modal
            const $closeButton = document.querySelector('[data-modal-hide="tambahGaleri"]');
            if ($closeButton) {
                $closeButton.addEventListener('click', () => {
                    modal.hide();
                });
            }
        }
    });
</script>
@endsection

@push('scripts')
<script>
    // Pastikan Modal tersedia dari Flowbite
    if (typeof Modal === 'undefined') {
        console.error('Modal tidak tersedia. Pastikan Flowbite dimuat dengan benar.');
    }
</script>
@endpush
