@extends('users.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-[#3E5467]">Manajemen FAQ</h1>
            <a href="{{ route('faq.create') }}"
               class="px-4 py-2 bg-[#22C55E] text-white rounded-lg hover:bg-[#16A34A] transition-all duration-300 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah FAQ</span>
            </a>
        </div>

        <!-- Preview Gambar dan Tombol Edit -->
        <div class="mb-8 bg-white dark:bg-darkblack-600 rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#3E5467]">Preview Gambar FAQ</h2>
                <button type="button" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 flex items-center space-x-2"
                        onclick="openImageModal()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Edit Gambar</span>
                </button>
            </div>
            <div class="w-full max-w-2xl mx-auto">
                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/faq/faq.png') }}" 
                         alt="Gambar FAQ" 
                         class="w-full max-h-80 object-cover"
                         onerror="this.src='{{ asset('images/assets/img_faq.png') }}'">
                </div>
            </div>
        </div>

        <!-- Tabel FAQ -->
        <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-darkblack-400">
                    <thead class="bg-gray-50 dark:bg-darkblack-500">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Pertanyaan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Urutan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-darkblack-600 divide-y divide-gray-200 dark:divide-darkblack-400 ">
                        @forelse($faqs as $faq)
                            <tr class="hover:bg-gray-50 dark:hover:bg-darkblack-500 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ Str::limit($faq->pertanyaan, 50) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $faq->urutan }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $faq->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $faq->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-end space-x-4">
                                        <a href="{{ route('faq.edit', $faq->id) }}"
                                           class="text-[#22C55E] hover:text-[#16A34A] transition-colors duration-150 flex items-center space-x-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150 flex items-center space-x-1"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Tidak ada FAQ yang tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($faqs instanceof \Illuminate\Pagination\LengthAwarePaginator && $faqs->hasPages())
            <div class="mt-6">
                {{ $faqs->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal Edit Gambar -->
<div id="imageModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden">
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-darkblack-600 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="absolute right-0 top-0 pr-4 pt-4">
                    <button type="button" class="rounded-md bg-white dark:bg-darkblack-600 text-gray-400 hover:text-gray-500" onclick="closeImageModal()">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">Edit Gambar FAQ</h3>
                        <div class="mt-4">
                            <form id="imageForm" method="POST" action="{{ route('faq.update-image') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gambar Saat Ini</label>
                                    <div class="w-full h-48 rounded-lg overflow-hidden mb-4">
                                        <img id="currentImage" src="{{ asset('images/faq/faq.png') }}" alt="Gambar FAQ" class="w-full h-full object-cover">
                                    </div>
                                    <input type="file" name="gambar" id="gambar" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-[#22C55E] file:text-white
                                        hover:file:bg-[#16A34A]">
                                </div>
                                <div class="flex justify-end space-x-4">
                                    <button type="button" onclick="closeImageModal()" class="px-4 py-2 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-darkblack-500 transition-all duration-300">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-[#22C55E] text-white rounded-lg hover:bg-[#16A34A] transition-all duration-300">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openImageModal() {
        const modal = document.getElementById('imageModal');
        const form = document.getElementById('imageForm');
        const currentImage = document.getElementById('currentImage');
        
        // Set form action
        form.action = `/faq/update-image`;
        currentImage.src = `/images/faq/faq.png`;
        
        // Show modal
        modal.classList.remove('hidden');
    }
    
    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    }
</script>
@endpush
@endsection
