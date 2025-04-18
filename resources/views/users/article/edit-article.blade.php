@extends('users.layouts.app')

@section('title', 'Edit Artikel')

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
    .dark .border-bgray-200,
    .dark .border-bgray-50,
    .dark .bg-darkblack-500,
    .dark .border-darkblack-400,
    .dark .text-bgray-50,
    .dark .dark\:bg-darkblack-500,
    .dark .dark\:text-gray-300,
    .dark .dark\:hover\:bg-darkblack-400,
    .dark .dark\:border-darkblack-400 {
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
    .dark .note-editor {
        border-color: #e5e7eb !important;
    }
    .note-toolbar {
        background-color: #f8f8f8 !important;
    }
    .dark .note-toolbar {
        background-color: #f8f8f8 !important;
    }
    .dark .note-editable {
        background-color: white !important;
        color: #333 !important;
    }
    /* Sembunyikan preview yang tidak diinginkan
    .note-editing-area .note-editable p:first-child {
        display: none !important;
    } */
    /* Sembunyikan textarea duplikat */
    .note-editor + textarea {
        display: none !important;
    }
    .note-editor .note-status-output,
    .note-editor .note-statusbar {
        display: none !important;
    }
    /* Fix untuk modal Summernote */
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
    /* Fix untuk dialog file upload */
    .note-image-dialog {
        position: relative !important;
        margin: 30px auto !important;
    }
    /* Fix untuk dark mode pada modal Summernote */
    .dark .note-modal-content {
        background-color: #1e1e2d !important;
        color: white !important;
    }
    .dark .note-modal-header {
        border-bottom: 1px solid #3f3f5f !important;
    }
    .dark .note-modal-footer {
        border-top: 1px solid #3f3f5f !important;
    }
    .dark .note-form-label {
        color: white !important;
    }
    /* Fix untuk video player */
    .note-video-clip {
        max-width: 100%;
    }
    .note-editable img {
        max-width: 100%;
    }
    /* Style untuk tags */
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 0.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        min-height: 3rem;
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
    .dark .tags-container {
        border-color: #3f3f5f;
    }
    .dark .tag {
        background-color: #2d3748;
        color: #e2e8f0;
    }
    .dark .tag button {
        color: #a0aec0;
    }
    .dark .tag button:hover {
        color: #e2e8f0;
    }
    /* Style untuk preview gambar */
    .upload-area {
        width: 100%;
        min-height: 300px;
        border: 2px dashed #e2e8f0;
        border-radius: 0.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
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

    .dark .upload-area {
        border-color: #3f3f5f;
    }

    .dark .upload-area:hover {
        border-color: #6b7280;
    }

    .note-editor.note-frame .note-editing-area .note-editable {
        display: block !important;
    }
    .note-editor.note-frame .note-editing-area .note-codable {
        display: none !important;
    }
    /* Sembunyikan tampilan HTML mentah */
    .note-editor + .note-editor {
        display: none !important;
    }
</style>
@endpush

@section('content')
<div class="w-full rounded-lg bg-white px-[24px] py-[20px]">
    <div class="flex items-center justify-between gap-4 border-b border-bgray-200 pb-4">
        <h2 class="text-xl font-semibold text-bgray-800 dark:text-white">Edit Artikel</h2>
        <a href="{{ route('article.master') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300 dark:bg-darkblack-500 dark:text-gray-300 dark:hover:bg-darkblack-400">
            Kembali
        </a>
    </div>

    <!-- Form Edit Artikel -->
    <div class="mt-6">
        <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="articleForm">
            @csrf
            @method('PUT')
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <!-- Pesan Error -->
            @if ($errors->any())
            <div class="bg-red-100 p-4 rounded-lg mb-6 dark:bg-red-900/20">
                <div class="text-red-600 dark:text-red-400 font-medium mb-2">Ada kesalahan dalam pengisian form:</div>
                <ul class="list-disc pl-5 text-red-600 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Pesan Sukses -->
            @if (session('success'))
            <div class="bg-green-100 p-4 rounded-lg mb-6 dark:bg-green-900/20">
                <p class="text-green-600 dark:text-green-400">{{ session('success') }}</p>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full rounded-lg border border-bgray-300 p-3 focus:ring-2 focus:ring-success-300 dark:bg-darkblack-500 dark:border-darkblack-400" required>
                </div>

                <div>
                    <label for="category" class="mb-2 block font-medium text-bgray-600">Kategori</label>
                    <select name="category_id" class="w-full rounded-lg border border-bgray-300 p-3 focus:ring-2 focus:ring-success-300 dark:bg-darkblack-500 dark:border-darkblack-400" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ $article->category_id == $event->id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-2">Gambar Utama</label>
                <div class="upload-area" id="uploadArea">
                    <!-- Upload Placeholder -->
                    <div class="upload-placeholder" id="uploadPlaceholder" style="{{ $article->image ? 'display: none;' : '' }}">
                        <svg class="w-12 h-12 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                        </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG atau JPEG (MAX. 2MB)</p>
                            </div>

                    <!-- Image Preview -->
                    <div class="image-preview {{ !$article->image ? 'hidden' : '' }}" id="imagePreview">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : '#' }}" alt="Preview" id="previewImg">
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
                           onchange="previewImage(this)"/>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-2">Konten <span class="text-red-500">*</span></label>
                <div id="summernote"></div>
                <textarea name="content" style="display: none">{!! old('content', $article->content) !!}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-2">Tags</label>
                <div class="tags-container">
                    <div id="tags-list"></div>
                    <input type="text" id="tags-input" class="tags-input" placeholder="Ketik tag dan tekan spasi...">
                    <input type="hidden" name="tags" id="tags-hidden" value="{{ old('tags', is_array($article->tags) ? implode(',', $article->tags) : $article->tags) }}">
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('article.master') }}"
                    class="rounded-lg bg-gray-100 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-200 dark:bg-darkblack-500 dark:text-gray-300 dark:hover:bg-darkblack-400">
                    Batal
                </a>
                <button type="submit"
                        class="rounded-lg bg-success-300 px-6 py-3 text-sm font-medium text-white hover:bg-success-400">
                    Simpan Perubahan
                </button>
            </div>
        </form>
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
                console.log('Halaman editor artikel selalu dalam mode terang untuk keterbacaan');

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
            disableResizeEditor: true,
            codeviewFilter: true,
            codeviewIframeFilter: true,
            callbacks: {
                onInit: function() {
                    // Pastikan konten dimuat dengan benar
                    var content = $('textarea[name="content"]').val();
                    if (content) {
                        $('#summernote').summernote('code', content);
                    }
                },
                onChange: function(contents) {
                    $('textarea[name="content"]').val(contents);
                },
                onImageUpload: function(files) {
                    for(let file of files) {
                        uploadImage(file);
                    }
                },
                onMediaDelete: function(target) {
                    console.log(target[0].src);
                }
            },
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'help']]
            ],
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36']
        });

        // Show Summernote
        $('#summernote').show();

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

    // Initialize existing tags
    const existingTags = tagsHidden.value ? tagsHidden.value.split(',') : [];
    tags = existingTags.map(tag => tag.trim()).filter(tag => tag);
    updateTags();

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
            placeholder.style.display = 'none';
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
    placeholder.style.display = 'flex';
}

// Initialize tags when document is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeTags();
});

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
