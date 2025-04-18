@extends('users.layouts.app')

@section('title', 'Master Artikel')

@push('head')
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<!-- Flowbite -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

<style>
    /* Force light mode regardless of system settings */
    :root {
        color-scheme: light !important;
    }

    /* Override dark mode styles */
    .dark .bg-darkblack-600,
    .dark .text-white,
    .dark .border-bgray-50,
    .dark .bg-darkblack-500,
    .dark .border-darkblack-400,
    .dark .text-bgray-50,
    .dark .dark\:bg-darkblack-500,
    .dark .dark\:text-gray-300,
    .dark .dark\:hover\:bg-darkblack-400 {
        background-color: white !important;
        color: #333 !important;
        border-color: #e5e7eb !important;
    }

    .summernote-container {
        margin-bottom: 20px;
    }
    .note-editor {
        background-color: white !important;
        position: relative;
        z-index: 1060 !important;
    }
    .note-toolbar {
        background-color: #f8f8f8 !important;
    }
    .note-editable {
        background-color: white !important;
        color: #333 !important;
    }
    .note-modal {
        z-index: 2000 !important;
    }
    .note-modal-backdrop {
        z-index: 1999 !important;
        background: rgba(0, 0, 0, 0.5) !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }
    .note-image-dialog {
        position: relative !important;
        margin: 30px auto !important;
    }
    #articleModal {
        z-index: 1050 !important;
        display: none;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 1rem;
    }
    .modal-backdrop {
        z-index: 1040 !important;
    }
    .note-modal-content {
        background-color: white !important;
        color: #333 !important;
    }
    .note-modal-header {
        border-bottom: 1px solid #e2e8f0 !important;
    }
    .note-modal-footer {
        border-top: 1px solid #e2e8f0 !important;
    }
    .note-form-label {
        color: #333 !important;
    }
    .note-video-clip {
        max-width: 100%;
    }
    .note-editable img {
        max-width: 100%;
    }
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 0.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        min-height: 3rem;
        background-color: white;
    }
    .tag {
        display: inline-flex;
        align-items: center;
        background-color: #e2e8f0;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        color: #4a5568;
    }
    .tag button {
        margin-left: 0.5rem;
        color: #718096;
        font-size: 1rem;
        line-height: 1;
        padding: 0.125rem;
    }
    .tag button:hover {
        color: #4a5568;
    }
    .tags-input {
        border: none;
        outline: none;
        flex-grow: 1;
        min-width: 100px;
        background: transparent;
    }
    #imagePreviewContainer {
        position: relative;
        width: 100%;
        min-height: 200px;
        max-height: 500px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f7fafc;
        border-radius: 0.5rem;
    }
    #imagePreview {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
    }
    .upload-area {
        width: 100%;
        min-height: 300px;
        border: 2px dashed #e2e8f0;
        border-radius: 0.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        background-color: white;
    }
    .upload-area:hover {
        border-color: #94a3b8;
    }
    .upload-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-height: 300px;
        padding: 1rem;
        color: #4a5568;
    }
    .image-preview {
        width: 100%;
        height: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .image-preview img {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
    }
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .image-preview:hover .image-overlay {
        opacity: 1;
    }
    .remove-image-btn {
        background: #ef4444;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: background-color 0.3s ease;
    }
    .remove-image-btn:hover {
        background: #dc2626;
    }
</style>
@endpush

@section('content')
<div class="w-full rounded-lg bg-white px-[24px] py-[20px]">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-bgray-200 pb-4">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-semibold text-bgray-800">Master Data Artikel</h2>
            <button onclick="showAddModal()" class="flex items-center justify-center rounded-lg bg-success-300 px-4 py-2 text-sm font-medium text-white hover:bg-success-400 transition-all duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Artikel
            </button>
        </div>
        <!-- Search Bar -->
        <div class="flex items-center gap-3">
            <form action="{{ route('article.master') }}" method="GET" class="flex items-center gap-3">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari artikel..."
                       class="w-[250px] rounded-lg border border-bgray-300 p-2 bg-white">
                <button type="submit" class="flex items-center gap-2 rounded-lg bg-success-300 px-4 py-2 text-white hover:bg-success-400 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Table Articles -->
    <div class="mt-6 overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="border-b border-bgray-200">
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600">Gambar</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600">Judul Artikel</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600">Kategori</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600">Tags</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr class="border-b border-bgray-200 hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-16 h-16 object-cover rounded-lg">
                    </td>
                    <td class="px-4 py-3 text-sm text-bgray-900">{{ $article->title }}</td>
                    <td class="px-4 py-3 text-sm text-bgray-900">
                        {{ $article->category ? $article->category->name : '-' }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-2">
                            @foreach(is_array($article->tags) ? $article->tags : [] as $tag)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-bgray-200 text-bgray-800">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm text-bgray-900">{{ $article->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            @php
                                $PermissionEdit = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Edit');
                                $PermissionDelete = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Delete');
                            @endphp
                            @if(!empty($PermissionEdit))
                            <a href="{{ route('article.edit', ['id' => $article->id]) }}"
                               class="flex items-center text-blue-500 hover:text-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            @endif
                            @if(!empty($PermissionDelete))
                            <button onclick="showDeleteModal('{{ $article->id }}')"
                                    class="flex items-center text-red-500 hover:text-red-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $articles->links() }}
    </div>

    <!-- Modal Add/Edit Article -->
    <div id="articleModal" class="fixed inset-0 z-50">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="relative z-10 mx-auto max-w-5xl h-screen flex items-center justify-center px-4">
            <div class="rounded-xl bg-white p-6 shadow-xl w-full max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-bgray-900">Tambah Artikel Baru</h3>
                    <button onclick="hideModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="articleForm">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-bgray-600 mb-2">Judul Artikel</label>
                            <input type="text" name="title" class="w-full rounded-lg border border-bgray-300 p-3 focus:ring-2 focus:ring-success-300" required>
                        </div>

                        <div>
                            <label for="category" class="mb-2 block font-medium text-bgray-600">Kategori</label>
                            <select name="category_id" class="w-full rounded-lg border border-bgray-300 p-3 focus:ring-2 focus:ring-success-300" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-bgray-600 mb-2">Gambar Utama</label>
                        <div class="upload-area" id="uploadArea">
                            <!-- Upload Placeholder -->
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <svg class="w-12 h-12 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                </p>
                                    <p class="text-xs text-gray-500">PNG, JPG atau JPEG (MAX. 2MB)</p>
                            </div>

                            <!-- Image Preview -->
                            <div class="image-preview hidden" id="imagePreview">
                                <img src="#" alt="Preview" id="previewImg">
                                <div class="image-overlay">
                                    <button type="button" class="remove-image-btn" onclick="removeImage()">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>

                            <input type="file"
                                   id="imageInput"
                                   name="image"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                   accept="image/*"
                                   required
                                   onchange="previewImage(this)"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-bgray-600 mb-2">Konten</label>
                        <div id="summernote" style="display: none;"></div>
                        <textarea name="content" id="contentInput" style="display:none;"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-bgray-600 mb-2">Tags</label>
                        <div class="tags-container">
                            <div id="tags-list"></div>
                            <input type="text" id="tags-input" class="tags-input" placeholder="Ketik tag dan tekan spasi...">
                            <input type="hidden" name="tags" id="tags-hidden">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <button type="button" onclick="hideModal()"
                                class="rounded-lg bg-gray-100 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-success-300 px-6 py-3 text-sm font-medium text-white hover:bg-success-400">
                            Simpan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div id="deleteArticleModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="relative z-10 mx-auto mt-20 max-w-lg">
            <div class="rounded-xl bg-white p-6 shadow-xl">
                <div class="flex flex-col items-center text-center">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Penghapusan</h3>

                    <div class="mt-2 mb-6">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menghapus artikel ini?
                        </p>
                    </div>

                    <form id="deleteArticleForm" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center gap-4">
                            <button type="button"
                                    onclick="hideDeleteModal()"
                                    class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-200">
                                Batal
                            </button>
                            <button type="submit"
                                    class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                                Ya, Hapus Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Bootstrap dan Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<!-- Flowbite JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<script>
// Check if we're on an article page that should always be light mode
const forceArticleLightMode = true; // Set to false to disable forced light mode

document.addEventListener('DOMContentLoaded', function() {
    // Only override dark mode if we're on a page that requires light mode
    if (forceArticleLightMode) {
        // Force light mode by removing dark class
        document.documentElement.classList.remove('dark');

        // Override the dark mode toggle functionality for this page
        const darkModeToggle = document.getElementById('theme-toggle');
        if (darkModeToggle) {
            const originalClickHandler = darkModeToggle.onclick;
            darkModeToggle.addEventListener('click', function(e) {
                // Prevent the toggle from changing to dark mode on this page
                e.preventDefault();
                e.stopPropagation();

                // Notify user that this page is always in light mode
                console.log('Halaman artikel selalu dalam mode terang untuk keterbacaan');

                // Prevent default handler
                return false;
            }, true); // Use capture to intercept before regular event handler
        }

        // Also listen for theme changes from other components
        document.addEventListener('themeChanged', function(e) {
            // If someone tries to set dark mode, immediately switch back to light
            if (e.detail.isDark) {
                document.documentElement.classList.remove('dark');
            }
        });
    }

    // Continue with Summernote initialization
    if (typeof $.fn.summernote === 'undefined') {
        console.error('Summernote belum dimuat dengan benar');
        return;
    }

    try {
        // Inisialisasi Summernote dengan konfigurasi lengkap
        $('#summernote').summernote({
        height: 300,
            minHeight: 200,
            maxHeight: 500,
            focus: true,
        toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36'],
            callbacks: {
                onImageUpload: function(files) {
                    for(let file of files) {
                        uploadImage(file);
                    }
                },
                onMediaDelete: function(target) {
                    // Optional: Tambahkan logika untuk menghapus gambar dari server
                    console.log(target[0].src);
                },
                onChange: function(contents, $editable) {
                    $('#contentInput').val(contents);
                }
            },
            popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            },
            codemirror: {
                theme: 'monokai'
            }
        });

        // Fungsi untuk upload gambar
        function uploadImage(file) {
    let formData = new FormData();
            formData.append('image', file);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
                url: '{{ route("article.upload.image") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
                    if (response.url) {
                        let image = $('<img>').attr('src', response.url);
                        $('#summernote').summernote('insertNode', image[0]);
                    } else {
                        console.error('URL gambar tidak ditemukan dalam response');
                        alert('Gagal mengupload gambar. URL tidak valid.');
                    }
        },
        error: function(xhr, status, error) {
            console.error('Error uploading image:', error);
                    let errorMessage = 'Gagal mengupload gambar. ';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage += xhr.responseJSON.error;
                    } else {
                        errorMessage += 'Silakan coba lagi.';
                    }
                    alert(errorMessage);
                }
            });
        }

        // Show Summernote when modal opens
        $('#summernote').show();

        // Fungsi submit form dengan menyimpan konten dari Summernote
        $('#articleForm').on('submit', function() {
            var content = $('#summernote').summernote('code');
            $('#contentInput').val(content);
        });
    } catch (error) {
        console.error('Error initializing Summernote:', error);
    }
});

// Fungsi untuk tags
let tags = [];

function initializeTags() {
    const tagsInput = document.getElementById('tags-input');
    const tagsList = document.getElementById('tags-list');
    const tagsHidden = document.getElementById('tags-hidden');

    function updateTags() {
        tagsList.innerHTML = tags.map(tag => `
            <span class="tag">
                ${tag}
                <button type="button" onclick="removeTag('${tag}')">&times;</button>
            </span>
        `).join('');
        tagsHidden.value = tags.join(',');
    }

    tagsInput.addEventListener('keydown', function(e) {
        if (e.key === ' ' && this.value.trim()) {
            e.preventDefault();
            const tag = this.value.trim();
            if (!tags.includes(tag)) {
                tags.push(tag);
                updateTags();
            }
            this.value = '';
        } else if (e.key === 'Backspace' && !this.value && tags.length) {
            tags.pop();
            updateTags();
        }
    });
}

function removeTag(tag) {
    tags = tags.filter(t => t !== tag);
    document.getElementById('tags-list').innerHTML = tags.map(tag => `
        <span class="tag">
            ${tag}
            <button type="button" onclick="removeTag('${tag}')">&times;</button>
        </span>
    `).join('');
    document.getElementById('tags-hidden').value = tags.join(',');
}

// Tambahkan ke fungsi showAddModal
function showAddModal() {
    try {
        const modal = document.getElementById("articleModal");
        modal.style.display = "flex";
        if (typeof $.fn.summernote !== 'undefined') {
            $('#summernote').show();
            $('#summernote').summernote('reset');
        } else {
            console.error('Summernote tidak tersedia');
        }
        // Reset tags
        tags = [];
        document.getElementById('tags-list').innerHTML = '';
        document.getElementById('tags-hidden').value = '';
        document.getElementById('tags-input').value = '';
    } catch (error) {
        console.error('Error in showAddModal:', error);
    }
}

function hideModal() {
    try {
        document.getElementById("articleModal").style.display = "none";
        document.getElementById("articleForm").reset();
        if (typeof $.fn.summernote !== 'undefined') {
            $('#summernote').summernote('reset');
        }
        // Reset tags
        tags = [];
        document.getElementById('tags-list').innerHTML = '';
        document.getElementById('tags-hidden').value = '';
        document.getElementById('tags-input').value = '';
        // Reset image
        removeImage();
    } catch (error) {
        console.error('Error in hideModal:', error);
    }
}

function showDeleteModal(articleId) {
    const modal = document.getElementById("deleteArticleModal");
    const form = document.getElementById("deleteArticleForm");
    if (form && modal) {
        form.action = `/users/article/${articleId}`;
        modal.classList.remove("hidden");
    }
}

function hideDeleteModal() {
    const modal = document.getElementById("deleteArticleModal");
    if (modal) {
        modal.classList.add("hidden");
    }
}

// Initialize tags when document is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeTags();
});

// Fungsi untuk preview dan hapus gambar
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const placeholder = document.getElementById('uploadPlaceholder');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            input.required = false;
        }

        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const placeholder = document.getElementById('uploadPlaceholder');

    input.value = '';
    previewImg.src = '';
    preview.classList.add('hidden');
    placeholder.classList.remove('hidden');
    input.required = true;
}

// Tambahkan dukungan drag and drop
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.classList.add('border-primary-500');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('border-primary-500');
    }

    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length) {
            const input = document.getElementById('imageInput');
            input.files = files;
            previewImage(input);
        }
    }
});
</script>
@endpush
