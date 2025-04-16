@extends('users.layouts.app')

@section('title', 'Layanan')

@push('scripts')
<!-- Tambahkan CDN jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
@endpush

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
    <!-- Image Preview dengan desain baru -->
    <div class="flex justify-center mb-8">
        <div class="relative w-[400px] h-[250px] rounded-2xl overflow-hidden shadow-lg transition-transform hover:scale-105 duration-300">
                <img id="preview-image"
                     src="{{ asset('images/avatar/samodra.png') }}"
                 class="h-full w-full object-cover transition-all duration-500"
                     onerror="this.onerror=null; this.src='{{ asset('images/avatar/samodra.png') }}';">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Layanan Samoedra</h3>
                <p class="text-sm opacity-90">Pilih layanan untuk memulai</p>
            </div>
            </div>
        </div>

        <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/50 dark:bg-white/10 backdrop-blur-sm"></div>
            <div class="relative bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl p-8 w-96 max-w-md transform transition-all animate-modal-pop">
                <div class="text-center">
                    <!-- Icon sukses yang lebih besar dan lebih menarik -->
                    <div class="mx-auto mb-6 w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <!-- Judul dengan ukuran yang lebih besar -->
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Berhasil!</h3>

                    <!-- Pesan dengan margin yang lebih baik -->
                    <p class="text-gray-600 dark:text-gray-300 mb-8">Data berhasil disimpan.</p>

                    <!-- Info invoice dengan desain yang lebih baik -->
                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-blue-700 text-sm text-left">
                                Untuk mendapatkan invoice, silahkan hubungi admin
                            </p>
                        </div>
                    </div>

                    <!-- Tombol tutup yang lebih menarik -->
                    <button onclick="closeSuccessModal()" class="w-full py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 font-medium">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    <!-- Form dengan desain baru -->
    <form action="{{ route('layanan.submit') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto" id="layananForm">
            @csrf

        <!-- Alert Error -->
        @if(session('error') || $errors->any())
        <div class="mb-6">
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-600">
                            @if(session('error'))
                                {{ session('error') }}
                            @else
                        @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                        @endforeach
                            @endif
                        </p>
                    </div>
                </div>
            </div>
                </div>
            @endif

        <!-- Pilih Layanan -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
                <label class="block text-lg font-semibold text-gray-800 dark:text-white mb-4">
                    Pilih Layanan
                </label>
                <select id="main_service_type" name="main_service_type" required
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-3 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    <option value="">Pilih Layanan</option>
                    <option value="bermain">Bermain</option>
                    <option value="bimbel">Bimbel</option>
                    <option value="event">Event</option>
                    <option value="daycare">Daycare</option>
                    <option value="stimulasi">Kelas Stimulasi</option>
                </select>
            </div>

            <!-- Data Diri -->
            <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Data Diri</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" required
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Usia
                        </label>
                        <input type="number" name="age" required
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nomor Telepon Orangtua
                        </label>
                        <input type="tel" name="phone" required
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>
            </div>

            <!-- Kaos Kaki -->
            <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox"
                           name="need_socks"
                           class="form-checkbox h-5 w-5 text-success-300 rounded border-gray-300 focus:ring-success-300 transition duration-150 ease-in-out"
                           value="1">
                    <span class="text-gray-700 dark:text-gray-300">
                        Beli Kaos Kaki (Rp 15.000) - <span class="text-red-500">*Wajib beli jika belum memiliki kaos kaki</span>
                    </span>
                </label>
            </div>

            <!-- Dynamic Fields Container dengan style baru -->
            <div id="dynamic-fields" class="hidden space-y-6">
                <div id="serviceFields">
                <!-- Konten dynamic akan diisi oleh JavaScript -->
                </div>
                </div>

            <!-- Status Info -->
            <div id="statusInfo" class="hidden">
                <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
                    <p class="text-center"></p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-8">
                <button type="submit"
                        class="px-8 py-3 bg-success-300 text-white rounded-xl font-semibold hover:bg-success-400 transform hover:scale-105 transition-all duration-300 focus:ring-4 focus:ring-success-300/50">
                    Submit Layanan
                </button>
            </div>
            </div>
        </form>

    <!-- Form Event -->
    <div id="eventForm" class="hidden space-y-6">
        <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pendaftaran Event</h3>

            <!-- Event yang Tersedia -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Event yang Tersedia
                </label>
                <select name="event_id" required
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    <option value="">Pilih Event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Orang Tua -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nama Orang Tua
                </label>
                <input type="text" name="parent_name" required
                       class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
            </div>

            <!-- Alamat -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Alamat
                </label>
                <textarea name="address" required rows="3"
                          class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
            </div>

            <!-- Social Media -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Akun Instagram/Facebook/TikTok Pendamping
                </label>
                <input type="text" name="social_media" required
                       class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
            </div>

            <!-- Informasi Pembayaran -->
            <div class="form-group animate-fade-in mb-6">
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <p class="text-yellow-800">
                        <strong>Informasi Pembayaran:</strong><br>
                        Administrasi Pendaftaran: Rp 20.000/anak<br>
                        No Rekening: 6821039361<br>
                        BCA atas nama: siti nur arsyillah. a
                    </p>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Bukti Transfer
                </label>
                <div class="flex flex-col items-center">
                    <div class="w-full max-w-[300px] aspect-[4/3] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                        <div id="event-payment-proof-preview" class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                            <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Upload Bukti Transfer
                                </span>
                            </div>
                            <input type="file"
                                   name="payment_proof"
                                   required
                                   class="hidden"
                                   accept="image/*"
                                   onchange="previewEventPaymentProof(this)">
                        </label>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                            Format yang diterima: JPG, JPEG, PNG (Max. 2MB)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sumber Informasi -->
            <div class="form-group animate-fade-in">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Mengetahui Acara ini dari
                </label>
                <select name="source_info" required
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    <option value="">Pilih Sumber Informasi</option>
                    <option value="instagram">Instagram</option>
                    <option value="facebook">Facebook</option>
                    <option value="tiktok">TikTok</option>
                    <option value="teman">Teman</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Tambahkan CDN jsPDF sebelum script lainnya -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainServiceType = document.getElementById('main_service_type');
    const dynamicFields = document.getElementById('dynamic-fields');
    const previewImage = document.getElementById('preview-image');
    const eventForm = document.getElementById('eventForm');

    // Update path gambar
    const images = {
        'bermain': '{{ asset("images/avatar/bermain.png") }}',
        'bimbel': '{{ asset("images/avatar/bimbel.png") }}',
        'event': '{{ asset("images/avatar/event.png") }}',
        'daycare': '{{ asset("images/avatar/daycare.png") }}',
        'stimulasi': '{{ asset("images/avatar/kelas_stimulasi.png") }}', // Tambahkan ini
        'default': '{{ asset("images/avatar/samodra.png") }}'
    };

    mainServiceType.addEventListener('change', function() {
        const selectedService = this.value;
        const imagePath = images[selectedService] || images['default'];
        previewImage.src = imagePath;

        // Perbaiki logika ini
        const dynamicFields = document.getElementById('dynamic-fields');

        if (selectedService) {
            dynamicFields.classList.remove('hidden');
            if (selectedService === 'event') {
                loadEventFields(dynamicFields);
            } else {
            loadServiceFields(selectedService);
            }
        } else {
            dynamicFields.classList.add('hidden');
        }
    });

    function loadServiceFields(service) {
        console.log('Loading service fields for:', service);
        const serviceFieldsContainer = document.getElementById('dynamic-fields');

        if (!serviceFieldsContainer) {
            console.error('Container not found!');
            return;
        }

        let fields = '';

        if (service === 'stimulasi') {
            fields = `
                <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Data Kelas Stimulasi</h3>

                    <!-- Jenis Kelamin -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Jenis Kelamin
                        </label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="L" required class="mr-2">
                                <span>Laki-laki</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="P" required class="mr-2">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <!-- Anak Ke- -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Anak ke-
                        </label>
                        <input type="number"
                               name="child_order"
                               required
                               min="1"
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Tempat/Tanggal Lahir -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="form-group animate-fade-in">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tempat Lahir
                            </label>
                            <input type="text" name="birth_place" required
                                   class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                        </div>
                        <div class="form-group animate-fade-in">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tanggal Lahir
                            </label>
                            <input type="date" name="birth_date" required
                                   class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>

                    <!-- Agama -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Agama
                        </label>
                        <select name="religion" required
                                class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alamat Lengkap
                        </label>
                        <textarea name="address" required rows="3"
                                  class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
                    </div>

                    <!-- Nomor HP Anak -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nomor HP Anak (Opsional)
                        </label>
                        <input type="tel" name="child_phone"
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Data Ayah -->
                    <div class="bg-gray-50 dark:bg-darkblack-500 p-4 rounded-lg mb-4">
                        <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-3">Data Ayah</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group animate-fade-in">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Ayah
                                </label>
                                <input type="text" name="father_name" required
                                       class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                            </div>
                            <div class="form-group animate-fade-in">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Usia Ayah
                                </label>
                                <input type="number" name="father_age" required min="1"
                                       class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                            </div>
                            <div class="form-group animate-fade-in md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pendidikan Terakhir Ayah
                                </label>
                                <textarea name="father_education" required rows="2"
                                          class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
                            </div>
                            <div class="form-group animate-fade-in md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pekerjaan Ayah
                                </label>
                                <textarea name="father_occupation" required rows="2"
                                          class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="bg-gray-50 dark:bg-darkblack-500 p-4 rounded-lg mb-4">
                        <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-3">Data Ibu</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group animate-fade-in">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Ibu
                                </label>
                                <input type="text" name="mother_name" required
                                       class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                            </div>
                            <div class="form-group animate-fade-in">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Usia Ibu
                                </label>
                                <input type="number" name="mother_age" required min="1"
                                       class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                            </div>
                            <div class="form-group animate-fade-in md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pendidikan Terakhir Ibu
                                </label>
                                <textarea name="mother_education" required rows="2"
                                          class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
                            </div>
                            <div class="form-group animate-fade-in md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pekerjaan Ibu
                                </label>
                                <textarea name="mother_occupation" required rows="2"
                                          class="w-full bg-white dark:bg-darkblack-400 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tinggi dan Berat Badan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="form-group animate-fade-in">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tinggi Badan (cm)
                            </label>
                            <input type="number" name="height" required min="1"
                                   class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                        </div>
                        <div class="form-group animate-fade-in">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Berat Badan (gr)
                            </label>
                            <input type="number" name="weight" required min="1"
                                   class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>

                    <!-- Foto Peserta -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Foto Peserta
                        </label>
                        <div class="flex flex-col items-center">
                            <div class="w-full max-w-[300px] aspect-[3/4] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                                <div id="student-photo-preview" class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                    <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Pilih Foto
                                        </span>
                                    </div>
                                    <input type="file"
                                           name="student_photo"
                                           required
                                           class="hidden"
                                           accept="image/*"
                                           onchange="previewStudentPhoto(this)">
                                </label>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                    Upload foto close-up (kepala sampai dada).<br>
                                    Format: JPG, JPEG, PNG (Max. 2MB)
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pembayaran -->
                    <div class="form-group animate-fade-in mb-6">
                        <div class="p-4 bg-yellow-50 rounded-lg">
                            <p class="text-yellow-800">
                                <strong>Informasi Pembayaran:</strong><br>
                                No Rekening: 6821039361<br>
                                BCA atas nama: siti nur arsyillah. a
                            </p>
                        </div>
                    </div>

                    <!-- Bukti Pembayaran -->
                    <div class="form-group animate-fade-in">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Bukti Pembayaran
                        </label>
                        <div class="flex flex-col items-center">
                            <div class="w-full max-w-[300px] aspect-[4/3] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                                <div id="payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                    <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Upload Bukti Transfer
                                        </span>
                                    </div>
                                    <input type="file"
                                           name="payment_proof"
                                           required
                                           class="hidden"
                                           accept="image/*"
                                           onchange="previewPaymentProof(this)">
                                </label>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                    Format yang diterima: JPG, JPEG, PNG (Max. 2MB)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } else if (service === 'bermain') {
            // Kode yang sudah ada untuk bermain
            fields = `
                <!-- Informasi Operasional -->
                <div class="form-group animate-fade-in mb-4">
                    <div class="p-4 bg-yellow-50 rounded-lg">
                        <p class="text-yellow-800">
                            <strong>Jam Operasional:</strong> 08:00 - 17:00 WIB
                        </p>
                    </div>
                </div>

                <!-- Tanggal Bermain -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Tanggal Bermain
                    </label>
                    <input type="date"
                           id="bermain_date"
                           name="date"
                           required
                           min="{{ date('Y-m-d') }}"
                           onchange="updateHariBermain()"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- Hari (Readonly) -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Hari
                    </label>
                    <input type="text"
                           id="bermain_day"
                           name="day"
                           readonly
                           required
                           class="w-full rounded-lg border border-bgray-300 p-2.5 bg-gray-50 cursor-not-allowed">
                </div>

                <!-- Jam Mulai -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Jam Mulai
                    </label>
                    <input type="time" name="selected_time" required
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- Durasi Bermain -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Durasi Bermain
                    </label>
                   <select name="duration" required
                        class="w-full rounded-lg border border-bgray-300 p-2.5">
                    <option value="">Pilih Durasi</option>
                    <option value="1">1 Jam</option>
                    <option value="2">2 Jam</option>
                    <option value="3">3 Jam</option>
                    <option value="6">Sepuasnya - 6 Jam </option>
                </select>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Bukti Pembayaran
                    </label>
                    <div class="flex flex-col items-center">
                        <div class="w-full max-w-[300px] aspect-[4/3] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                            <div id="payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Upload Bukti Transfer
                                    </span>
                                </div>
                    <input type="file"
                           name="payment_proof"
                           required
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewPaymentProof(this)">
                            </label>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                        Format yang diterima: JPG, JPEG, PNG (Max. 2MB)
                    </p>
                        </div>
                    </div>
                </div>
            `;
        } else if (service === 'bimbel') {
            // Kode yang sudah ada untuk bimbel
            fields = `
                <!-- Jenis Bimbel -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Jenis Bimbel
                    </label>
                    <select name="bimbel_type" required
                            class="w-full rounded-lg border border-bgray-300 p-2.5">
                        <option value="">Pilih Jenis Bimbel</option>
                        <option value="offline">Offline</option>
                        <option value="online">Online</option>
                    </select>
                </div>

                <!-- Bimbel yang ingin diikuti -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Bimbel yang ingin diikuti
                    </label>
                    <select name="service_type" required
                            class="w-full rounded-lg border border-bgray-300 p-2.5">
                        <option value="">Pilih Bimbel</option>
                        <option value="bimbel_calistung">Bimbel Calistung</option>
                        <option value="bimbel_sd">Bimbel Pelajaran SD</option>
                        <option value="bimbel_mengaji">Bimbel Mengaji</option>
                        <option value="bimbel_coding">Bimbel Coding IT</option>
                        <option value="bimbel_english">Bimbel Bahasa Inggris</option>
                        <option value="bimbel_arabic">Bimbel Bahasa Arab</option>
                        <option value="bimbel_islam">Bimbel Pendidikan Agama Islam</option>
                        <option value="bimbel_art">Bimbel Melukis, Mewarnai, Drawing</option>
                        <option value="bimbel_computer">Bimbel Komputer Dasar</option>
                    </select>
                </div>

                <!-- Tanggal Mulai Bimbel -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Tanggal Mulai Bimbel
                    </label>
                    <input type="date" name="start_date" required min="{{ date('Y-m-d') }}"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Jenis Kelamin
                    </label>
                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="radio" name="gender" value="L" required class="mr-2">
                            <span>Laki-laki</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="gender" value="P" required class="mr-2">
                            <span>Perempuan</span>
                        </label>
                    </div>
                </div>

                <!-- Tempat/Tanggal Lahir -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Tempat Lahir
                    </label>
                    <input type="text" name="birth_place" required
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Tanggal Lahir
                    </label>
                    <input type="date" name="birth_date" required
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- Riwayat Sekolah -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Apakah sudah pernah sekolah sebelumnya (formal/non formal)?
                    </label>
                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="radio" name="has_school_history" value="1" required class="mr-2">
                            <span>Ya</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="has_school_history" value="0" required class="mr-2">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Nama Sekolah (conditional) -->
                <div class="form-group animate-fade-in" id="school_name_container" style="display: none;">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Nama Sekolah
                    </label>
                    <input type="text" name="school_name"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- Agama -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Agama
                    </label>
                    <select name="religion" required
                            class="w-full rounded-lg border border-bgray-300 p-2.5">
                        <option value="">Pilih Agama</option>
                        <option value="islam">Islam</option>
                        <option value="kristen">Kristen</option>
                        <option value="protestan">Protestan</option>
                        <option value="hindu">Hindu</option>
                        <option value="budha">Budha</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Alamat Lengkap
                    </label>
                    <textarea name="address" required
                              class="w-full rounded-lg border border-bgray-300 p-2.5" rows="3"></textarea>
                </div>

                <!-- Anak Ke -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Anak ke-
                    </label>
                    <input type="number" name="child_order" required min="1"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- No HP Anak -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Nomor HP Anak (Opsional)
                    </label>
                    <input type="tel" name="child_phone"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- Data Ayah -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Nama Ayah
                    </label>
                    <input type="text" name="father_name" required
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Usia Ayah
                    </label>
                    <input type="number" name="father_age" required min="1"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Pendidikan Terakhir Ayah
                    </label>
                    <textarea name="father_education" required
                              class="w-full rounded-lg border border-bgray-300 p-2.5"
                              placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                </div>

                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Pekerjaan Ayah
                    </label>
                    <textarea name="father_occupation" required
                              class="w-full rounded-lg border border-bgray-300 p-2.5"
                              placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                </div>

                <!-- Data Ibu -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Nama Ibu
                    </label>
                    <input type="text" name="mother_name" required
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Usia Ibu
                    </label>
                    <input type="number" name="mother_age" required min="1"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Pendidikan Terakhir Ibu
                    </label>
                    <textarea name="mother_education" required
                              class="w-full rounded-lg border border-bgray-300 p-2.5"
                              placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                </div>

                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Pekerjaan Ibu
                    </label>
                    <textarea name="mother_occupation" required
                              class="w-full rounded-lg border border-bgray-300 p-2.5"
                              placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                </div>

                <!-- Update bagian Upload Foto di dalam fields bimbel -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Foto Peserta Bimbel
                    </label>
                    <div class="flex flex-col items-center">
                        <div class="w-full max-w-[300px] aspect-[3/4] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                            <div id="student-photo-preview" class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Pilih Foto
                                    </span>
                                </div>
                                <input type="file"
                                       name="student_photo"
                                       required
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewStudentPhoto(this)">
                            </label>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                Upload foto close-up (kepala sampai dada).<br>
                                Format: JPG, JPEG, PNG (Max. 2MB)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bukti Transfer Biaya Bimbel -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Bukti Transfer Biaya Bimbel
                    </label>
                    <div class="flex flex-col items-center">
                        <div class="w-full max-w-[300px] aspect-[4/3] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                            <div id="payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Upload Bukti Transfer
                                    </span>
                                </div>
                                <input type="file"
                                       name="payment_proof"
                                       required
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewPaymentProof(this)">
                            </label>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                        Format yang diterima: JPG, JPEG, PNG (Max. 2MB)
                    </p>
                        </div>
                    </div>
                </div>
            `;

            // Tambahkan event listener untuk show/hide nama sekolah
            setTimeout(() => {
                const schoolHistoryInputs = document.querySelectorAll('input[name="has_school_history"]');
                const schoolNameContainer = document.getElementById('school_name_container');
                const schoolNameInput = document.querySelector('input[name="school_name"]');

                schoolHistoryInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        if (this.value === '1') {
                            schoolNameContainer.style.display = 'block';
                            schoolNameInput.required = true;
                        } else {
                            schoolNameContainer.style.display = 'none';
                            schoolNameInput.required = false;
                            schoolNameInput.value = '';
                        }
                    });
                });
            }, 100);
        } else if (service === 'daycare') {
            // Kode yang sudah ada untuk daycare
            fields = `
                <!-- Informasi Daycare -->
                <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
                    <!-- Informasi Waktu Operasional -->
                    <div class="p-4 bg-yellow-50 rounded-lg mb-4">
                        <p class="text-yellow-800">
                            <strong>Informasi Layanan:</strong><br>
                            Jam Operasional Harian: 07.00 - 16.00 WIB (9 jam)
                        </p>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Data Daycare</h3>

                    <!-- Jenis Daycare -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Jenis Daycare
                        </label>
                        <select name="daycare_type" required
                                class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Jenis Daycare</option>
                            <option value="bulanan">Penitipan Anak Bulanan</option>
                            <option value="harian">Penitipan Anak per Hari (9 jam)</option>
                        </select>
                    </div>

                    <!-- Tinggi dan Berat Badan -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="form-group animate-fade-in">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tinggi Badan (cm)
                            </label>
                            <input type="number" name="height" required
                                   class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                        </div>
                        <div class="form-group animate-fade-in">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Berat Badan (gr)
                            </label>
                            <input type="number" name="weight" required
                                   class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>

                    <!-- Kaos Kaki -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox"
                                   name="need_socks"
                                   class="form-checkbox h-5 w-5 text-success-300 rounded border-gray-300 focus:ring-success-300 transition duration-150 ease-in-out"
                                   value="1">
                            <span class="text-gray-700 dark:text-gray-300">
                                Beli Kaos Kaki (Rp 15.000) - <span class="text-red-500">*Wajib beli jika belum memiliki kaos kaki</span>
                            </span>
                        </label>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Jenis Kelamin
                        </label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="L" required class="mr-2">
                                <span>Laki-laki</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="P" required class="mr-2">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <!-- Tempat/Tanggal Lahir -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tempat Lahir
                        </label>
                        <input type="text" name="birth_place" required
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tanggal Lahir
                        </label>
                        <input type="date" name="birth_date" required
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Agama -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Agama
                        </label>
                        <select name="religion" required
                                class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="protestan">Protestan</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alamat Lengkap
                        </label>
                        <textarea name="address" required rows="3"
                                  class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
                    </div>

                    <!-- Anak Ke -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Anak ke-
                        </label>
                        <input type="number" name="child_order" required min="1"
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- No HP Anak -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nomor HP Anak (Opsional)
                        </label>
                        <input type="tel" name="child_phone"
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Data Ayah -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Ayah
                        </label>
                        <input type="text" name="father_name" required
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Usia Ayah
                        </label>
                        <input type="number" name="father_age" required min="1"
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pendidikan Terakhir Ayah
                        </label>
                        <textarea name="father_education" required
                                  class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                                  placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                    </div>

                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pekerjaan Ayah
                        </label>
                        <textarea name="father_occupation" required
                                  class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                                  placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                    </div>

                    <!-- Data Ibu -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Ibu
                        </label>
                        <input type="text" name="mother_name" required
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Usia Ibu
                        </label>
                        <input type="number" name="mother_age" required min="1"
                               class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pendidikan Terakhir Ibu
                        </label>
                        <textarea name="mother_education" required
                                  class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                                  placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                    </div>

                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pekerjaan Ibu
                        </label>
                        <textarea name="mother_occupation" required
                                  class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"
                                  placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                    </div>

                    <!-- Foto Peserta -->
                    <div class="form-group animate-fade-in mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Foto Peserta Daycare
                        </label>
                        <div class="flex flex-col items-center">
                            <div class="w-full max-w-[300px] aspect-[3/4] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                                <div id="student-photo-preview" class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                    <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Pilih Foto
                                        </span>
                                    </div>
                                    <input type="file"
                                           name="student_photo"
                                           required
                                           class="hidden"
                                           accept="image/*"
                                           onchange="previewStudentPhoto(this)">
                                </label>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                    Upload foto close-up (kepala sampai dada).<br>
                                    Format: JPG, JPEG, PNG (Max. 2MB)
                                </p>
                            </div>
                        </div>
                    </div>

                     <!-- Informasi Biaya -->
                    <div class="form-group animate-fade-in mb-6">
                        <div class="p-4 bg-yellow-50 rounded-lg">
                            <p class="text-yellow-800">
                                No Rekening: 6821039361<br>
                                BCA atas nama: siti nur arsyillah. a
                            </p>
                        </div>
                    </div>

                    <!-- Bukti Pembayaran -->
                    <div class="form-group animate-fade-in">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Bukti Pembayaran
                        </label>
                        <div class="flex flex-col items-center">
                            <div class="w-full max-w-[300px] aspect-[4/3] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                                <div id="payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                    <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Upload Bukti Transfer
                                        </span>
                                    </div>
                                    <input type="file"
                                           name="payment_proof"
                                           required
                                           class="hidden"
                                           accept="image/*"
                                           onchange="previewPaymentProof(this)">
                                </label>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                    Format yang diterima: JPG, JPEG, PNG (Max. 2MB)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        console.log('Setting innerHTML with fields');
        serviceFieldsContainer.innerHTML = fields;
    }

    function initializeEventListeners() {
        // File input preview
        const fileInput = document.querySelector('input[name="payment_proof"]');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.createElement('img');
                        preview.classList.add('w-full', 'h-32', 'object-cover', 'rounded-lg', 'mt-2');
                            preview.src = e.target.result;

                        // Remove existing preview if any
                        const existingPreview = fileInput.parentElement.querySelector('img');
                        if (existingPreview) {
                            existingPreview.remove();
                        }

                        fileInput.parentElement.appendChild(preview);
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }

        // Date input
        const dateInput = document.querySelector('input[name="date"]');
        const dayInput = document.querySelector('input[name="day"]');
        if (dateInput && dayInput) {
            dateInput.addEventListener('change', function() {
                const date = new Date(this.value);
                const days = {
                    0: 'Minggu',
                    1: 'Senin',
                    2: 'Selasa',
                    3: 'Rabu',
                    4: 'Kamis',
                    5: 'Jumat',
                    6: 'Sabtu'
                };
                const selectedDay = days[date.getDay()];
                dayInput.value = selectedDay;
                document.querySelector('input[name="day_display"]').value = selectedDay;
            });
        }

        // Tanggal Mulai Bimbel
        const startDateInput = document.querySelector('input[name="start_date"]');
        if (startDateInput) {
            startDateInput.addEventListener('change', function() {
                const date = new Date(this.value);
                const days = {
                    0: 'Minggu',
                    1: 'Senin',
                    2: 'Selasa',
                    3: 'Rabu',
                    4: 'Kamis',
                    5: 'Jumat',
                    6: 'Sabtu'
                };
                const selectedDay = days[date.getDay()];
                document.querySelector('input[name="day"]').value = selectedDay;
                document.querySelector('input[name="day_display"]').value = selectedDay;
            });
        }
    }
});

// Update fungsi showSuccessModal
function showSuccessModal(responseData) {
    // Simpan data untuk digunakan nanti
    window.lastSubmittedData = responseData;

    // Log data untuk debugging
    console.log('Success data:', responseData);

    const modal = document.getElementById('successModal');
    const statusInfo = document.querySelector('#successModal .bg-blue-50');

    // Tampilkan modal
    modal.classList.remove('hidden');

    // Jika tipe layanan adalah bimbel, tambahkan informasi status
    if (responseData.main_service_type === 'bimbel') {
        // Tampilkan info status bimbel
        statusInfo.classList.remove('hidden');

        // Set text status sesuai dengan status bimbel
        const statusText = responseData.data.status === 'inactive'
            ? 'Bimbel dalam status menunggu konfirmasi admin'
            : 'Bimbel sudah aktif dan dapat dimulai';

        statusInfo.querySelector('p').textContent = statusText;

        // Tambahkan kelas warna sesuai status
        statusInfo.querySelector('p').className =
            responseData.data.status === 'inactive'
                ? 'text-yellow-600 dark:text-yellow-400'
                : 'text-green-600 dark:text-green-400';
    } else if (responseData.main_service_type === 'event') {
        // Tampilkan info untuk event
        statusInfo.classList.remove('hidden');
        statusInfo.querySelector('p').textContent = 'Pendaftaran event berhasil. Silahkan cek halaman Event untuk detail lebih lanjut.';
        statusInfo.querySelector('p').className = 'text-green-600 dark:text-green-400';
    } else if (responseData.main_service_type === 'daycare') {
        // Tampilkan info untuk daycare
        statusInfo.classList.remove('hidden');
        statusInfo.querySelector('p').textContent = 'Pendaftaran daycare berhasil. Untuk mendapatkan invoice, silahkan hubungi admin.';
        statusInfo.querySelector('p').className = 'text-blue-600 dark:text-blue-400';
    } else if (responseData.main_service_type === 'stimulasi') {
        // Tampilkan info untuk stimulasi
        statusInfo.classList.remove('hidden');
        statusInfo.querySelector('p').textContent = 'Pendaftaran stimulasi berhasil. Untuk mendapatkan invoice, silahkan hubungi admin.';
        statusInfo.querySelector('p').className = 'text-blue-600 dark:text-blue-400';
    } else {
        // Sembunyikan info status untuk layanan lain
        statusInfo.classList.add('hidden');
    }
}

// Update event listener form submit
document.getElementById('layananForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const mainServiceType = document.getElementById('main_service_type').value;
    formData.append('main_service_type', mainServiceType);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Simpan data untuk digunakan nanti
            window.lastSubmittedData = data;
            showSuccessModal(data);
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    });
});

// Update fungsi closeSuccessModal
function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    const data = window.lastSubmittedData;

    // Tambahkan logging untuk debugging
    console.log('Closing modal with data:', data);

    // Tambahkan animasi fade-out
    modal.classList.add('animate-fade-out');

    // Tunggu animasi selesai baru sembunyikan dan redirect
    setTimeout(() => {
        modal.classList.remove('animate-fade-out');
        modal.classList.add('hidden');

        // Cek tipe layanan dan redirect ke halaman yang sesuai
        if (data && data.main_service_type === 'bermain') {
            window.location.href = "{{ route('bermain.index') }}";
        } else if (data && data.main_service_type === 'bimbel') {
            window.location.href = "{{ route('bimbel.index') }}";
        } else if (data && data.main_service_type === 'stimulasi') {
            window.location.href = "{{ route('stimulasi.index') }}";
        } else if (data && data.main_service_type === 'daycare') {
            window.location.href = "{{ route('daycare.index') }}";
        } else if (data && data.main_service_type === 'event') {
            window.location.href = "{{ route('event.index') }}";
        } else {
            // Default redirect ke layanan
            window.location.href = "{{ route('layanan') }}";
        }
    }, 300);
}

// Update fungsi generateBimbelInvoice dengan desain baru
function generateBimbelInvoice(data) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Definisikan warna
    const primaryColor = [41, 128, 185];   // Biru yang lebih soft
    const textColor = [75, 85, 99];        // Abu-abu gelap untuk teks
    const greenColor = [46, 204, 113];     // Hijau untuk status LUNAS

    // Tambahkan watermark
    const addWatermark = () => {
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();
    };

    // Background putih
    doc.setFillColor(255, 255, 255);
    doc.rect(0, 0, 210, 297, 'F');

    // Tambahkan watermark
    addWatermark();

    // Header dengan garis biru
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, 35, 190, 35);

    // Logo dan Judul
    doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 20, 15, 25, 15);
    doc.setTextColor(...primaryColor);
    doc.setFontSize(24);
    doc.setFont('helvetica', 'bold');
    doc.text('INVOICE BIMBEL', 190, 25, { align: 'right' });

    // Informasi Invoice
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Kolom Kiri - Informasi Pelanggan
    doc.text('Ditagihkan Kepada:', 20, 50);
    doc.setFont('helvetica', 'bold');
    doc.text(data.name, 20, 57);
    doc.setFont('helvetica', 'normal');
    doc.text(`Usia: ${data.age} tahun`, 20, 64);
    doc.text(`Jenis Bimbel: ${data.bimbel_type}`, 20, 71);
    doc.text(`Mulai: ${new Date(data.start_date).toLocaleDateString('id-ID')}`, 20, 78);

    // Kolom Kanan - Informasi Invoice
    doc.text('No. Invoice:', 140, 50);
    doc.text('Tanggal:', 140, 57);
    doc.text('Status:', 140, 64);

    doc.setFont('helvetica', 'bold');
    doc.text(`BIM-${data.id}`, 190, 50, { align: 'right' });
    doc.text(new Date().toLocaleDateString('id-ID'), 190, 57, { align: 'right' });

    // Status LUNAS dengan warna hijau
    doc.setTextColor(...greenColor);
    doc.text('LUNAS', 190, 64, { align: 'right' });

    // Garis pemisah
    doc.setDrawColor(230, 230, 230);
    doc.setLineWidth(0.3);
    doc.line(20, 90, 190, 90);

    // Header Tabel
    doc.setFillColor(249, 250, 251);
    doc.rect(20, 95, 170, 10, 'F');

    doc.setTextColor(...textColor);
    doc.setFontSize(10);
    doc.setFont('helvetica', 'bold');
    doc.text('DESKRIPSI', 25, 101);
    doc.text('JUMLAH', 180, 101, { align: 'right' });

    // Isi Tabel
    let yPos = 115;
    doc.setFont('helvetica', 'normal');

    // Detail Bimbel
    doc.text(`${data.service_type}`, 25, yPos);
    doc.text(`(${data.total_meetings}x Pertemuan/Bulan)`, 25, yPos + 7);
    doc.text('Rp 50.000', 180, yPos, { align: 'right' });

    yPos += 25;

    // Kaos kaki jika ada
    if (data.need_socks) {
        doc.text('Kaos Kaki', 25, yPos);
        doc.text('Rp 15.000', 180, yPos, { align: 'right' });
        yPos += 15;
    }

    // Area Total
    doc.setFillColor(249, 250, 251);
    doc.rect(20, yPos, 170, 25, 'F');

    // Garis tipis di atas total
    doc.setDrawColor(230, 230, 230);
    doc.line(20, yPos, 190, yPos);

    yPos += 16;

    // Total dengan style yang lebih bold
    const totalPrice = data.need_socks ? 65000 : 50000;
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(12);
    doc.text('TOTAL', 25, yPos);
    doc.text(`Rp ${totalPrice.toLocaleString('id-ID')}`, 180, yPos, { align: 'right' });

    // Footer
    const footerY = 270;

    // Garis footer
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, footerY - 15, 190, footerY - 15);

    // Informasi kontak
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...textColor);
    doc.text('Little Star Kids - Samoedra', 105, footerY - 8, { align: 'center' });
    doc.text('Jl. Contoh No. 123, Kota, Indonesia', 105, footerY - 3, { align: 'center' });
    doc.text('Telp: (021) 1234567 | Email: info@samoedra.com', 105, footerY + 2, { align: 'center' });

    // Catatan
    doc.setFontSize(8);
    doc.setTextColor(...primaryColor);
    doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 10, { align: 'center' });

    // Simpan PDF dengan format nama yang rapi
    const formattedDate = new Date().toISOString().slice(0,10);
    doc.save(`Invoice-Bimbel-${data.name}-${formattedDate}.pdf`);
}

// Update fungsi generateInvoicePDF untuk bermain dengan desain baru
function generateInvoicePDF(id, name, age, day, startDateTime, duration, needSocks) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Warna yang lebih soft
    const primaryColor = [41, 128, 185];   // Biru yang lebih soft
    const textColor = [75, 85, 99];        // Abu-abu gelap untuk teks
    const accentColor = [46, 204, 113];    // Hijau untuk status

    // Tambahkan watermark logo
    const addWatermark = () => {
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();
    };

    // Background putih (default)
    doc.setFillColor(255, 255, 255);
    doc.rect(0, 0, 210, 297, 'F');

    // Tambahkan watermark
    addWatermark();

    // Header dengan garis biru
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, 35, 190, 35);

    // Logo dan Judul
    doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 20, 15, 25, 15);

    doc.setTextColor(...primaryColor);
    doc.setFontSize(24);
    doc.setFont('helvetica', 'bold');
    doc.text('INVOICE', 190, 25, { align: 'right' });

    // Informasi Invoice
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Kolom Kiri
    doc.text('Ditagihkan Kepada:', 20, 50);
    doc.setFont('helvetica', 'bold');
    doc.text(name, 20, 57);
    doc.setFont('helvetica', 'normal');
    doc.text(`Usia: ${age} tahun`, 20, 64);
    doc.text(`Hari: ${day}`, 20, 71);
    doc.text(`Waktu: ${new Date(startDateTime).toLocaleTimeString('id-ID')}`, 20, 78);

    // Kolom Kanan
    doc.text('No. Invoice:', 140, 50);
    doc.text('Tanggal:', 140, 57);
    doc.text('Status:', 140, 64);

    doc.setFont('helvetica', 'bold');
    doc.text(`INV-${id}`, 190, 50, { align: 'right' });
    doc.text(new Date().toLocaleDateString('id-ID'), 190, 57, { align: 'right' });

    // Status dengan warna hijau
    doc.setTextColor(...accentColor);
    doc.text('LUNAS', 190, 64, { align: 'right' });

    // Garis pemisah
    doc.setDrawColor(230, 230, 230);
    doc.setLineWidth(0.3);
    doc.line(20, 90, 190, 90);

    // Header Tabel
    doc.setFillColor(249, 250, 251);
    doc.rect(20, 95, 170, 10, 'F');

    doc.setTextColor(...textColor);
    doc.setFontSize(10);
    doc.setFont('helvetica', 'bold');
    doc.text('DESKRIPSI', 25, 101);
    doc.text('JUMLAH', 180, 101, { align: 'right' });

    // Isi Tabel
    let yPos = 115;
    doc.setFont('helvetica', 'normal');

    // Detail bermain
    const durPrice = duration === 1 ? '15.000' : duration === 2 ? '25.000' : '50.000';
    doc.text(`Bermain ${duration} Jam`, 25, yPos);
    doc.text(`Rp ${durPrice}`, 180, yPos, { align: 'right' });

    yPos += 20;

    // Kaos kaki jika ada
    if (needSocks) {
        doc.text('Kaos Kaki', 25, yPos);
        doc.text('Rp 15.000', 180, yPos, { align: 'right' });
        yPos += 15;
    }

    // Area Total
    doc.setFillColor(249, 250, 251);
    doc.rect(20, yPos, 170, 25, 'F');

    // Garis tipis di atas total
    doc.setDrawColor(230, 230, 230);
    doc.line(20, yPos, 190, yPos);

    yPos += 16;

    // Total dengan style yang lebih bold
    let totalPrice = 0;
    switch(parseInt(duration)) {
        case 1: totalPrice = 15000; break;
        case 2: totalPrice = 25000; break;
        case 3: totalPrice = 50000; break;
    }
    if (needSocks) totalPrice += 15000;

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(12);
    doc.text('TOTAL', 25, yPos);
    doc.text(`Rp ${totalPrice.toLocaleString('id-ID')}`, 180, yPos, { align: 'right' });

    // Footer
    const footerY = 270;

    // Garis footer
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, footerY - 15, 190, footerY - 15);

    // Informasi kontak
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...textColor);
    doc.text('Little Star Kids', 105, footerY - 8, { align: 'center' });
    doc.text('Jl. Contoh No. 123, Kota, Indonesia', 105, footerY - 3, { align: 'center' });
    doc.text('Telp: (021) 1234567 | Email: info@littlestarkids.com', 105, footerY + 2, { align: 'center' });

    // Catatan
    doc.setFontSize(8);
    doc.setTextColor(...primaryColor);
    doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 10, { align: 'center' });

    // Simpan PDF dengan format nama yang rapi
    const formattedDate = new Date().toISOString().slice(0,10);
    doc.save(`Invoice-Bermain-${name}-${formattedDate}.pdf`);
}

// Hapus semua fungsi handleGenerateInvoice yang ada dan ganti dengan ini
function handleGenerateInvoice() {
    try {
        const data = window.lastSubmittedData;
        if (!data) throw new Error('Data tidak tersedia');

        console.log("Data untuk invoice:", data);

        // Cek tipe layanan
        if (data.data && data.main_service_type === 'bermain') {
            // Ekstrak data bermain
            const serviceInfo = data.data.service_info || {};
            const name = serviceInfo.name || data.data.name || '';
            const phone = serviceInfo.phone || data.data.phone || '';
            const age = data.data.age || '';
            const duration = data.data.duration || '';
            const needSocks = serviceInfo.need_socks || false;

            // Generate invoice bermain
            generateSimpleBermainInvoice(name, phone, age, duration, needSocks);
        } else {
            // Untuk layanan lain
            alert('Fitur invoice untuk layanan ini sedang dikembangkan');
        }
    } catch (error) {
        console.error('Error generating invoice:', error);
        alert('Terjadi kesalahan saat membuat invoice: ' + error.message);
    }
}

// Fungsi invoice bermain yang sederhana dan pasti berfungsi
function generateSimpleBermainInvoice(name, phone, age, duration, needSocks) {
    // Pastikan jsPDF tersedia
    if (typeof window.jspdf === 'undefined') {
        console.error("jsPDF tidak tersedia");
        alert("Library jsPDF tidak tersedia");
        return;
    }

    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Warna
        const blue = [0, 102, 204];
        const black = [0, 0, 0];

        // Background putih
        doc.setFillColor(255, 255, 255);
        doc.rect(0, 0, 210, 297, 'F');

        // Coba tambahkan watermark logo
        try {
            // Watermark (opacity rendah)
            doc.saveGraphicsState();
            doc.setGState(new doc.GState({opacity: 0.1}));
            doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
            doc.restoreGraphicsState();
        } catch (e) {
            console.warn("Tidak dapat menambahkan watermark:", e);
        }

        // Header
        doc.setFontSize(24);
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(...blue);
        doc.text('INVOICE', 105, 30, {align: 'center'});

        // Garis header
        doc.setDrawColor(...blue);
        doc.setLineWidth(0.5);
        doc.line(20, 40, 190, 40);

        // Informasi pelanggan
        doc.setFontSize(12);
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(...black);
        doc.text('Ditagihkan Kepada:', 20, 55);
        doc.setFont('helvetica', 'bold');
        doc.text(`Nama: ${name}`, 20, 65);
        doc.text(`No. Telepon: ${phone}`, 20, 75);
        if (age) {
            doc.text(`Usia: ${age} tahun`, 20, 85);
        }

        // Detail layanan
        doc.setFont('helvetica', 'bold');
        doc.text('Detail Layanan:', 20, 100);
        doc.setFont('helvetica', 'normal');
        doc.text(`Layanan Bermain`, 20, 110);

        // Durasi
        let durText = '';
        switch(parseInt(duration)) {
            case 1: durText = '1 Jam (Rp 15.000)'; break;
            case 2: durText = '2 Jam (Rp 30.000)'; break;
            case 3: durText = '3 Jam (Rp 35.000)'; break;
            case 6: durText = '6 Jam - Sepuasnya (Rp 45.000)'; break;
            default: durText = `${duration} Jam`;
        }
        doc.text(durText, 20, 120);

        // Kaos kaki
        let totalPrice = 0;
        switch(parseInt(duration)) {
            case 1: totalPrice = 15000; break;
            case 2: totalPrice = 30000; break;
            case 3: totalPrice = 35000; break;
            case 6: totalPrice = 45000; break;
        }

        let yPos = 130;
        if (needSocks) {
            doc.text(`Kaos Kaki: Rp 15.000`, 20, yPos);
            totalPrice += 15000;
            yPos += 10;
        }

        // Garis sebelum total
        doc.setDrawColor(200, 200, 200);
        doc.setLineWidth(0.3);
        doc.line(20, yPos + 5, 190, yPos + 5);

        // Total
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(14);
        doc.setTextColor(...blue);
        doc.text(`Total: Rp ${totalPrice.toLocaleString('id-ID')}`, 20, yPos + 20);

        // Footer
        const footerY = 270;

        // Garis footer
        doc.setDrawColor(...blue);
        doc.setLineWidth(0.5);
        doc.line(20, footerY - 10, 190, footerY - 10);

        // Informasi kontak
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(100, 100, 100);
        doc.text('Little Star Kids - Samoedra', 105, footerY, {align: 'center'});
        doc.text('Jl. Contoh No. 123, Kota, Indonesia', 105, footerY + 7, {align: 'center'});
        doc.text('Telp: (021) 1234567 | Email: info@samoedra.com', 105, footerY + 14, {align: 'center'});

        // Catatan
        doc.setFontSize(8);
        doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 25, {align: 'center'});

        // Simpan PDF
        doc.save(`Invoice-Bermain-${name}-${new Date().toISOString().slice(0,10)}.pdf`);

    } catch (error) {
        console.error("Error creating PDF:", error);
        alert("Terjadi kesalahan saat membuat invoice: " + error.message);
    }
}

function generateBermainInvoicePDF(id, name, age, day, startDateTime, duration, needSocks) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Warna yang lebih menarik
    const primaryColor = [41, 128, 185];   // Biru yang lebih soft
    const secondaryColor = [243, 156, 18]; // Oranye untuk aksen
    const textColor = [75, 85, 99];        // Abu-abu gelap untuk teks
    const accentColor = [46, 204, 113];    // Hijau untuk status

    // Tambahkan watermark logo
    const addWatermark = () => {
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();
    };

    // Background dengan gradasi subtle
    doc.setFillColor(252, 252, 252);
    doc.rect(0, 0, 210, 297, 'F');

    // Tambahkan watermark
    addWatermark();

    // Header dengan desain yang lebih menarik
    doc.setFillColor(...primaryColor, 0.1);
    doc.roundedRect(15, 10, 180, 30, 3, 3, 'F');

    // Logo dan Judul
    doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 20, 15, 25, 20);

    doc.setTextColor(...primaryColor);
    doc.setFontSize(24);
    doc.setFont('helvetica', 'bold');
    doc.text('INVOICE BERMAIN', 190, 25, { align: 'right' });

    // Informasi Invoice dengan desain card
    doc.setFillColor(249, 250, 251);
    doc.roundedRect(15, 45, 180, 40, 3, 3, 'F');

    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Kolom Kiri
    doc.text('Ditagihkan Kepada:', 20, 55);
    doc.setFont('helvetica', 'bold');
    doc.text(name, 20, 62);
    doc.setFont('helvetica', 'normal');
    doc.text(`Usia: ${age} tahun`, 20, 69);
    doc.text(`Hari: ${day}`, 20, 76);
    doc.text(`Waktu: ${new Date(startDateTime).toLocaleTimeString('id-ID')}`, 20, 83);

    // Kolom Kanan
    doc.text('No. Invoice:', 140, 55);
    doc.text('Tanggal:', 140, 62);
    doc.text('Status:', 140, 69);

    doc.setFont('helvetica', 'bold');
    doc.text(`BRM-${id}`, 190, 55, { align: 'right' });
    doc.text(new Date().toLocaleDateString('id-ID'), 190, 62, { align: 'right' });

    // Status dengan warna hijau dan badge
    doc.setFillColor(...accentColor);
    doc.roundedRect(165, 65, 25, 7, 3, 3, 'F');
    doc.setTextColor(255, 255, 255);
    doc.setFontSize(8);
    doc.text('LUNAS', 177.5, 70, { align: 'center' });

    // Tabel dengan desain yang lebih menarik
    doc.setFillColor(...primaryColor, 0.1);
    doc.roundedRect(15, 95, 180, 10, 3, 3, 'F');

    doc.setTextColor(...primaryColor);
    doc.setFontSize(10);
    doc.setFont('helvetica', 'bold');
    doc.text('DESKRIPSI', 25, 101);
    doc.text('JUMLAH', 180, 101, { align: 'right' });

    // Isi Tabel dengan baris bergantian
    let yPos = 115;
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Harga berdasarkan durasi yang diperbarui
    let durPrice = '';
    switch(parseInt(duration)) {
        case 1: durPrice = '15.000'; break;
        case 2: durPrice = '30.000'; break;
        case 3: durPrice = '35.000'; break;
        case 6: durPrice = '45.000'; break; // Tambahan untuk sepuasnya (6 jam)
        default: durPrice = '0';
    }

    // Detail Bermain dengan background
    doc.setFillColor(249, 250, 251);
    doc.rect(15, yPos-8, 180, 15, 'F');
    doc.text(`Bermain ${duration} Jam${duration == 6 ? ' (Sepuasnya)' : ''}`, 25, yPos);
    doc.text(`Rp ${durPrice}`, 180, yPos, { align: 'right' });

    yPos += 20;

    // Kaos kaki jika ada
    if (needSocks) {
        doc.setFillColor(252, 252, 252);
        doc.rect(15, yPos-8, 180, 15, 'F');
        doc.text('Kaos Kaki', 25, yPos);
        doc.text('Rp 15.000', 180, yPos, { align: 'right' });
        yPos += 15;
    }

    // Area Total dengan desain yang lebih menarik
    doc.setFillColor(...secondaryColor, 0.1);
    doc.roundedRect(15, yPos, 180, 25, 3, 3, 'F');

    yPos += 16;

    // Total dengan style yang lebih bold
    let totalPrice = 0;
    switch(parseInt(duration)) {
        case 1: totalPrice = 15000; break;
        case 2: totalPrice = 30000; break;
        case 3: totalPrice = 35000; break;
        case 6: totalPrice = 45000; break; // Tambahan untuk sepuasnya (6 jam)
    }
    if (needSocks) totalPrice += 15000;

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(12);
    doc.setTextColor(...secondaryColor);
    doc.text('TOTAL', 25, yPos);
    doc.text(`Rp ${totalPrice.toLocaleString('id-ID')}`, 180, yPos, { align: 'right' });

    // Footer dengan desain yang lebih menarik
    const footerY = 270;

    // Garis footer dengan gradasi
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, footerY - 15, 190, footerY - 15);

    // Informasi kontak dengan ikon
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...textColor);
    doc.text('Little Star Kids - Samoedra', 105, footerY - 8, { align: 'center' });
    doc.text('Jl. Contoh No. 123, Kota, Indonesia', 105, footerY - 3, { align: 'center' });
    doc.text('Telp: (021) 1234567 | Email: info@samoedra.com', 105, footerY + 2, { align: 'center' });

    // QR Code (simulasi)
    doc.setFillColor(0, 0, 0);
    doc.roundedRect(20, footerY - 10, 15, 15, 2, 2, 'F');

    // Catatan dengan desain yang lebih menarik
    doc.setFillColor(...primaryColor, 0.1);
    doc.roundedRect(40, footerY + 7, 130, 10, 3, 3, 'F');
    doc.setFontSize(8);
    doc.setTextColor(...primaryColor);
    doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 13, { align: 'center' });

    // Simpan PDF dengan format nama yang rapi
    const formattedDate = new Date().toISOString().slice(0,10);
    doc.save(`Invoice-Bermain-${name}-${formattedDate}.pdf`);
}

function previewStudentPhoto(input) {
    const preview = document.getElementById('student-photo-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}"
                     class="w-full h-full object-cover transition-all duration-300 hover:scale-105"
                     alt="Preview foto peserta">
            `;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewPaymentProof(input) {
    const preview = document.getElementById('payment-proof-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}"
                     class="w-full h-full object-cover transition-all duration-300 hover:scale-105"
                     alt="Preview bukti pembayaran">
            `;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewEventPaymentProof(input) {
    const preview = document.getElementById('event-payment-proof-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}"
                     class="w-full h-full object-cover transition-all duration-300 hover:scale-105"
                     alt="Preview bukti pembayaran event">
            `;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Tambahkan fungsi loadEventFields
function loadEventFields(dynamicFields) {
    const fields = `
        <div class="bg-white dark:bg-darkblack-600 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-darkblack-400">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pendaftaran Event</h3>

            <!-- Event yang Tersedia -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Event yang Tersedia
                </label>
                <select name="event_id" required
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    <option value="">Pilih Event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Orang Tua -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nama Orang Tua
                </label>
                <input type="text" name="parent_name" required
                       class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
            </div>

            <!-- Alamat -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Alamat
                </label>
                <textarea name="address" required rows="3"
                          class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300"></textarea>
            </div>

            <!-- Social Media -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Akun Instagram/Facebook/TikTok Pendamping
                </label>
                <input type="text" name="social_media" required
                       class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
            </div>

            <!-- Informasi Pembayaran -->
            <div class="form-group animate-fade-in mb-6">
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <p class="text-yellow-800">
                        <strong>Informasi Pembayaran:</strong><br>
                        Administrasi Pendaftaran: Rp 20.000/anak<br>
                        No Rekening: 6821039361<br>
                        BCA atas nama: siti nur arsyillah. a
                    </p>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="form-group animate-fade-in mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Bukti Transfer
                </label>
                <div class="flex flex-col items-center">
                    <div class="w-full max-w-[300px] aspect-[4/3] bg-gray-100 dark:bg-darkblack-500 rounded-lg overflow-hidden mb-4">
                        <div id="event-payment-proof-preview" class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                            <div class="w-full px-4 py-3 text-sm text-center text-white bg-success-300 rounded-lg hover:bg-success-400 transition-colors duration-200">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Upload Bukti Transfer
                                </span>
                            </div>
                            <input type="file"
                                   name="payment_proof"
                                   required
                                   class="hidden"
                                   accept="image/*"
                                   onchange="previewEventPaymentProof(this)">
                        </label>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                            Format yang diterima: JPG, JPEG, PNG (Max. 2MB)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sumber Informasi -->
            <div class="form-group animate-fade-in">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Mengetahui Acara ini dari
                </label>
                <select name="source_info" required
                        class="w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300">
                    <option value="">Pilih Sumber Informasi</option>
                    <option value="instagram">Instagram</option>
                    <option value="facebook">Facebook</option>
                    <option value="tiktok">TikTok</option>
                    <option value="teman">Teman</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
        </div>
    `;

    dynamicFields.innerHTML = fields;
}

// Update fungsi generateEventInvoice
function generateEventInvoice(data) {
    console.log('Generating invoice with data:', data); // Untuk debugging

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Definisikan warna
    const primaryColor = [41, 128, 185];
    const textColor = [75, 85, 99];
    const accentColor = [46, 204, 113];

    // Tambahkan watermark logo
    const addWatermark = () => {
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();
    };

    // Background putih
    doc.setFillColor(255, 255, 255);
    doc.rect(0, 0, 210, 297, 'F');

    // Tambahkan watermark
    addWatermark();

    // Header dengan garis biru
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, 35, 190, 35);

    // Logo dan Judul
    doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 20, 15, 25, 15);
    doc.setTextColor(...primaryColor);
    doc.setFontSize(24);
    doc.setFont('helvetica', 'bold');
    doc.text('INVOICE EVENT', 190, 25, { align: 'right' });

    // Informasi Invoice
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Kolom Kiri - Informasi Pelanggan dengan pengecekan data
    doc.text('Ditagihkan Kepada:', 20, 50);
    doc.setFont('helvetica', 'bold');

    // Gunakan operator nullish coalescing untuk fallback values
    const customerName = data.name ?? data.parent_name ?? 'Peserta';
    const parentName = data.parent_name ?? 'Orang Tua';
    const eventName = data.event_name ?? (data.event?.name ?? 'Event');
    const eventDate = data.event_date ?? (data.event?.event_date ?
        new Date(data.event.event_date).toLocaleDateString('id-ID') :
        new Date().toLocaleDateString('id-ID'));
    const address = data.address ?? '-';

    doc.text(customerName, 20, 57);
    doc.setFont('helvetica', 'normal');
    doc.text(`Orang Tua: ${parentName}`, 20, 64);
    doc.text(`Event: ${eventName}`, 20, 71);
    doc.text(`Tanggal Event: ${eventDate}`, 20, 78);
    doc.text(`Alamat: ${address}`, 20, 85);

    // Kolom Kanan - Informasi Invoice
    doc.text('No. Invoice:', 140, 50);
    doc.text('Tanggal:', 140, 57);
    doc.text('Status:', 140, 64);

    doc.setFont('helvetica', 'bold');
    doc.text(`EVT-${data.id}`, 190, 50, { align: 'right' });
    doc.text(new Date().toLocaleDateString('id-ID'), 190, 57, { align: 'right' });

    // Status LUNAS dengan warna hijau
    doc.setTextColor(...accentColor);
    doc.text('LUNAS', 190, 64, { align: 'right' });

    // Garis pemisah
    doc.setDrawColor(230, 230, 230);
    doc.setLineWidth(0.3);
    doc.line(20, 90, 190, 90);

    // Header Tabel
    doc.setFillColor(249, 250, 251);
    doc.rect(20, 95, 170, 10, 'F');

    doc.setTextColor(...textColor);
    doc.setFontSize(10);
    doc.setFont('helvetica', 'bold');
    doc.text('DESKRIPSI', 25, 101);
    doc.text('JUMLAH', 180, 101, { align: 'right' });

    // Isi Tabel
    let yPos = 115;
    doc.setFont('helvetica', 'normal');

    // Detail Event
    doc.text('Biaya Administrasi Event', 25, yPos);
    doc.text('Rp 20.000', 180, yPos, { align: 'right' });

    // Area Total
    yPos += 30;
    doc.setFillColor(249, 250, 251);
    doc.rect(20, yPos, 170, 25, 'F');

    // Garis tipis di atas total
    doc.setDrawColor(230, 230, 230);
    doc.line(20, yPos, 190, yPos);

    yPos += 16;

    // Total dengan style yang lebih bold
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(12);
    doc.text('TOTAL', 25, yPos);
    doc.text('Rp 20.000', 180, yPos, { align: 'right' });

    // Footer
    const footerY = 270;

    // Garis footer
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, footerY - 15, 190, footerY - 15);

    // Informasi kontak
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...textColor);
    doc.text('Little Star Kids - Samoedra', 105, footerY - 8, { align: 'center' });
    doc.text('Jl. Contoh No. 123, Kota, Indonesia', 105, footerY - 3, { align: 'center' });
    doc.text('Telp: (021) 1234567 | Email: info@samoedra.com', 105, footerY + 2, { align: 'center' });

    // Catatan
    doc.setFontSize(8);
    doc.setTextColor(...primaryColor);
    doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 10, { align: 'center' });

    // Simpan PDF dengan format nama yang rapi
    const formattedDate = new Date().toISOString().slice(0,10);
    doc.save(`Invoice-Event-${customerName}-${formattedDate}.pdf`);
}

// Tambahkan fungsi untuk invoice stimulasi
function generateStimulasiInvoice(data) {
    // Ambil data stimulasi
    const customerName = data.name ?? 'Pelanggan';
    const customerPhone = data.phone ?? '-';
    const address = data.address ?? '-';

    // Hitung biaya
    const basePrice = 300000;
    const socksPrice = data.need_socks ? 15000 : 0;
    const totalPrice = basePrice + socksPrice;

    // Buat template invoice
    const invoiceTemplate = `
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">INVOICE</h1>
                <p class="text-gray-600">Samoedra Indonesia Bangkit</p>
            </div>
            <div class="text-right">
                <img src="/images/logo/logo_samoedra.JPG" alt="Logo" class="h-16 mb-2">
                <p class="text-sm text-gray-600">Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
                <p class="text-sm text-gray-600">No. Invoice: STIM-${Date.now().toString().substring(6)}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Ditagihkan Kepada:</h2>
                <p class="text-gray-700">${customerName}</p>
                <p class="text-gray-700">${customerPhone}</p>
                <p class="text-gray-700">${address}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Detail Pembayaran:</h2>
                <p class="text-gray-700">Metode: Transfer Bank</p>
                <p class="text-gray-700">Bank: BCA</p>
                <p class="text-gray-700">No. Rekening: 6821039361</p>
                <p class="text-gray-700">Atas Nama: siti nur arsyillah. a</p>
            </div>
        </div>

        <div class="mb-8">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-700">Deskripsi</th>
                        <th class="px-4 py-2 text-right text-gray-700">Jumlah</th>
                        <th class="px-4 py-2 text-right text-gray-700">Harga</th>
                        <th class="px-4 py-2 text-right text-gray-700">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-gray-700">Kelas Stimulasi Bulanan</td>
                        <td class="px-4 py-2 text-right text-gray-700">1</td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp ${basePrice.toLocaleString('id-ID')}</td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp ${basePrice.toLocaleString('id-ID')}</td>
                    </tr>
                    ${data.need_socks ? `
                    <tr class="border-b">
                        <td class="px-4 py-2 text-gray-700">Kaos Kaki</td>
                        <td class="px-4 py-2 text-right text-gray-700">1</td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp ${socksPrice.toLocaleString('id-ID')}</td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp ${socksPrice.toLocaleString('id-ID')}</td>
                    </tr>
                    ` : ''}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-right font-semibold text-gray-700">Total</td>
                        <td class="px-4 py-2 text-right font-semibold text-gray-700">Rp ${totalPrice.toLocaleString('id-ID')}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-sm text-gray-600 mb-8">
            <p class="mb-2">Catatan:</p>
            <p>1. Invoice ini adalah bukti pembayaran yang sah.</p>
            <p>2. Segala bentuk pembayaran harus ditransfer ke rekening yang tertera di atas.</p>
            <p>3. Harap simpan bukti pembayaran untuk konfirmasi pendaftaran.</p>
        </div>

        <div class="text-center text-gray-600 text-sm">
            <p>Terima kasih atas kepercayaan Anda pada Samoedra Indonesia Bangkit</p>
            <p>Jika ada pertanyaan, silakan hubungi kami di 08123456789</p>
        </div>
    </div>
    `;

    return invoiceTemplate;
}

// Tambahkan case untuk stimulasi di handleGenerateInvoice
function handleGenerateInvoice(data) {
    let invoiceHtml = '';

    if (data.data.service_type === 'stimulasi') {
        invoiceHtml = generateStimulasiInvoice(data.data);
    } else if (data.data.service_type === 'daycare') {
        invoiceHtml = generateDaycareInvoice(data.data);
    } else if (data.data.service_type === 'bermain') {
        invoiceHtml = generateBermainInvoice(data.data);
    } else if (data.data.service_type === 'bimbel') {
        invoiceHtml = generateBimbelInvoice(data.data);
    } else if (data.data.service_type === 'event') {
        invoiceHtml = generateEventInvoice(data.data);
    }

    // Tampilkan invoice pada modal
    if (invoiceHtml) {
        document.getElementById('invoice-content').innerHTML = invoiceHtml;
        document.getElementById('successModal').classList.remove('hidden');
        document.getElementById('printInvoiceBtn').onclick = function() {
            const printWindow = window.open('', '_blank');
            printWindow.document.write();
            printWindow.document.close();
        };
    }
}

// Fungsi untuk mengupdate hari berdasarkan tanggal
function updateDay() {
    const dateInput = document.getElementById('bermain_date');
    const dayInput = document.getElementById('bermain_day');

    if (dateInput && dayInput) {
        dateInput.addEventListener('change', function() {
            const date = new Date(this.value);
            const days = {
                0: 'Minggu',
                1: 'Senin',
                2: 'Selasa',
                3: 'Rabu',
                4: 'Kamis',
                5: 'Jumat',
                6: 'Sabtu'
            };

            if (!isNaN(date.getDay())) {
                dayInput.value = days[date.getDay()];
            }
        });
    }
}

// Panggil fungsi saat dokumen dimuat
document.addEventListener('DOMContentLoaded', function() {
    updateDay();
});

// Jika menggunakan Alpine.js, tambahkan ke data
function bermainFormData() {
    return {
        init() {
            updateDay();
        }
    }
}

function submitBermainForm() {
    const formData = new FormData(document.getElementById('bermainForm'));

    fetch('/daftar/submit', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tambahkan redirect ke halaman bermain
            window.location.href = '/bermain';
        } else {
            // Handle error
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Fungsi untuk mengatur hari otomatis
function setHariOtomatis() {
    const dateInput = document.getElementById('bermain_date');
    const dayInput = document.getElementById('bermain_day');

    if (dateInput.value) {
        const date = new Date(dateInput.value);
        const hariIndonesia = {
            0: 'Minggu',
            1: 'Senin',
            2: 'Selasa',
            3: 'Rabu',
            4: 'Kamis',
            5: 'Jumat',
            6: 'Sabtu'
        };

        dayInput.value = hariIndonesia[date.getDay()];
        console.log('Hari diset ke:', dayInput.value); // Untuk debugging
    }
}

// Jalankan saat halaman dimuat jika ada tanggal yang sudah dipilih
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('bermain_date');
    if (dateInput.value) {
        setHariOtomatis();
    }
});

function updateHariBermain() {
    const dateInput = document.getElementById('bermain_date');
    const dayInput = document.getElementById('bermain_day');

    if (dateInput && dateInput.value) {
        const date = new Date(dateInput.value);
        const hariIndonesia = {
            0: 'Minggu',
            1: 'Senin',
            2: 'Selasa',
            3: 'Rabu',
            4: 'Kamis',
            5: 'Jumat',
            6: 'Sabtu'
        };

        const hari = hariIndonesia[date.getDay()];
        dayInput.value = hari;
        console.log('Hari diset ke:', hari); // Untuk debugging
    }
}

// Tambahkan event listener setelah form bermain dimuat
function initializeBermainForm() {
    const dateInput = document.getElementById('bermain_date');
    if (dateInput) {
        dateInput.addEventListener('change', updateHariBermain);
        // Update hari jika tanggal sudah ada
        if (dateInput.value) {
            updateHariBermain();
        }
    }
}

// Tambahkan variabel global untuk menyimpan data
window.lastSubmittedData = null;

// Fungsi untuk menangani submit form
function submitLayananForm() {
    const form = document.getElementById('layananForm');
    const formData = new FormData(form);

    // Tampilkan loading
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitBtn').innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    })
    .then(response => response.json())
    .then(data => {
        // Simpan data respons untuk digunakan nanti
        window.lastSubmittedData = data;

        console.log("Response data:", data);

        // Reset form state
        document.getElementById('submitBtn').disabled = false;
        document.getElementById('submitBtn').innerHTML = 'Submit';

        if (data.success) {
            // Tampilkan pesan sukses
            document.getElementById('successMessage').classList.remove('hidden');
            document.getElementById('errorMessage').classList.add('hidden');
            document.getElementById('printInvoiceBtn').classList.remove('hidden');

            // Scroll ke pesan sukses
            document.getElementById('successMessage').scrollIntoView({ behavior: 'smooth' });

            // Reset form jika diperlukan
            if (data.reset_form) {
                form.reset();
            }
        } else {
            // Tampilkan pesan error
            document.getElementById('errorMessage').textContent = data.message || 'Terjadi kesalahan saat memproses permintaan.';
            document.getElementById('errorMessage').classList.remove('hidden');
            document.getElementById('successMessage').classList.add('hidden');
            document.getElementById('printInvoiceBtn').classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('submitBtn').disabled = false;
        document.getElementById('submitBtn').innerHTML = 'Submit';
        document.getElementById('errorMessage').textContent = 'Terjadi kesalahan saat menghubungi server.';
        document.getElementById('errorMessage').classList.remove('hidden');
        document.getElementById('successMessage').classList.add('hidden');
        document.getElementById('printInvoiceBtn').classList.add('hidden');
    });
}

// Fungsi untuk generate invoice
function handleGenerateInvoice() {
    try {
        const data = window.lastSubmittedData;
        if (!data) throw new Error('Data tidak tersedia');

        // Inisialisasi jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Header
        doc.setFontSize(24);
        doc.text('INVOICE', 15, 25);

        // Informasi Pelanggan
        doc.setFontSize(12);
        doc.text('Ditagihkan Kepada:', 15, 40);
        doc.text(`Nama: ${data.data.service_info.name}`, 15, 50);
        doc.text(`No. Telepon: ${data.data.service_info.phone}`, 15, 60);

        // Detail Layanan
        doc.text('Detail Layanan:', 15, 80);
        doc.text(data.data.service_name, 15, 90);

        // Info Durasi/Tipe
        if (data.data.duration_info) {
            doc.text(data.data.duration_info, 15, 100);
        }
        if (data.data.type_info) {
            doc.text(data.data.type_info, 15, 100);
        }

        // Info Kaos Kaki jika ada
        if (data.data.service_info.need_socks) {
            doc.text('Kaos Kaki: Rp 15.000', 15, 110);
        }

        // Total
        doc.text(`Total: Rp ${data.data.total.toLocaleString('id-ID')}`, 15, 130);

        // Simpan PDF
        doc.save(`Invoice-${data.data.service_info.name}.pdf`);

    } catch (error) {
        console.error('Error generating invoice:', error);
        alert('Terjadi kesalahan saat membuat invoice. Silakan coba lagi.');
    }
}

// Pastikan fungsi ini tersedia secara global
window.handleGenerateInvoice = handleGenerateInvoice;
window.submitLayananForm = submitLayananForm;

// ... existing code ...

// Tambahkan fungsi generateBermainInvoicePDF yang diambil dari bermain.blade.php
function generateBermainInvoicePDF(id, name, age, day, startDateTime, duration, needSocks) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Warna yang lebih soft
    const primaryColor = [41, 128, 185];   // Biru yang lebih soft
    const textColor = [75, 85, 99];        // Abu-abu gelap untuk teks
    const accentColor = [46, 204, 113];    // Hijau untuk status

    // Tambahkan watermark logo
    const addWatermark = () => {
        doc.saveGraphicsState();
        doc.setGState(new doc.GState({opacity: 0.08}));
        doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 55, 90, 100, 100);
        doc.restoreGraphicsState();
    };

    // Background putih (default)
    doc.setFillColor(255, 255, 255);
    doc.rect(0, 0, 210, 297, 'F');

    // Tambahkan watermark
    addWatermark();

    // Header dengan garis biru
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, 35, 190, 35);

    // Logo dan Judul
    doc.addImage("{{ asset('images/logo/logo_samoedra.JPG') }}", 'JPEG', 20, 15, 25, 15);

    doc.setTextColor(...primaryColor);
    doc.setFontSize(24);
    doc.setFont('helvetica', 'bold');
    doc.text('INVOICE', 190, 25, { align: 'right' });

    // Informasi Invoice
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...textColor);

    // Kolom Kiri
    doc.text('Ditagihkan Kepada:', 20, 50);
    doc.setFont('helvetica', 'bold');
    doc.text(name, 20, 57);
    doc.setFont('helvetica', 'normal');
    doc.text(`Usia: ${age} tahun`, 20, 64);
    doc.text(`Hari: ${day}`, 20, 71);
    doc.text(`Waktu: ${new Date(startDateTime).toLocaleTimeString('id-ID')}`, 20, 78);

    // Kolom Kanan
    doc.text('No. Invoice:', 140, 50);
    doc.text('Tanggal:', 140, 57);
    doc.text('Status:', 140, 64);

    doc.setFont('helvetica', 'bold');
    doc.text(`INV-${id}`, 190, 50, { align: 'right' });
    doc.text(new Date().toLocaleDateString('id-ID'), 190, 57, { align: 'right' });

    // Status dengan warna hijau
    doc.setTextColor(...accentColor);
    doc.text('LUNAS', 190, 64, { align: 'right' });

    // Garis pemisah
    doc.setDrawColor(230, 230, 230);
    doc.setLineWidth(0.3);
    doc.line(20, 90, 190, 90);

    // Header Tabel
    doc.setFillColor(249, 250, 251);
    doc.rect(20, 95, 170, 10, 'F');

    doc.setTextColor(...textColor);
    doc.setFontSize(10);
    doc.setFont('helvetica', 'bold');
    doc.text('DESKRIPSI', 25, 101);
    doc.text('JUMLAH', 180, 101, { align: 'right' });

    // Isi Tabel
    let yPos = 115;
    doc.setFont('helvetica', 'normal');

    // Harga berdasarkan durasi yang diperbarui
    let durPrice = '';
    switch(parseInt(duration)) {
        case 1: durPrice = '15.000'; break;
        case 2: durPrice = '30.000'; break;
        case 3: durPrice = '35.000'; break;
        case 6: durPrice = '45.000'; break; // Tambahan untuk sepuasnya (6 jam)
        default: durPrice = '0';
    }

    // Detail Bermain
    doc.text(`Bermain ${duration} Jam${duration == 6 ? ' (Sepuasnya)' : ''}`, 25, yPos);
    doc.text(`Rp ${durPrice}`, 180, yPos, { align: 'right' });

    yPos += 20;

    // Kaos kaki jika ada
    if (needSocks) {
        doc.text('Kaos Kaki', 25, yPos);
        doc.text('Rp 15.000', 180, yPos, { align: 'right' });
        yPos += 15;
    }

    // Area Total
    doc.setFillColor(249, 250, 251);
    doc.rect(20, yPos, 170, 25, 'F');

    // Garis tipis di atas total
    doc.setDrawColor(230, 230, 230);
    doc.line(20, yPos, 190, yPos);

    yPos += 16;

    // Total dengan style yang lebih bold
    let totalPrice = 0;
    switch(parseInt(duration)) {
        case 1: totalPrice = 15000; break;
        case 2: totalPrice = 30000; break;
        case 3: totalPrice = 35000; break;
        case 6: totalPrice = 45000; break; // Tambahan untuk sepuasnya (6 jam)
    }
    if (needSocks) totalPrice += 15000;

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(12);
    doc.text('TOTAL', 25, yPos);
    doc.text(`Rp ${totalPrice.toLocaleString('id-ID')}`, 180, yPos, { align: 'right' });

    // Footer
    const footerY = 270;

    // Garis footer
    doc.setDrawColor(...primaryColor);
    doc.setLineWidth(0.5);
    doc.line(20, footerY - 15, 190, footerY - 15);

    // Informasi kontak
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...textColor);
    doc.text('Little Star Kids - Samoedra', 105, footerY - 8, { align: 'center' });
    doc.text('Jl. Contoh No. 123, Kota, Indonesia', 105, footerY - 3, { align: 'center' });
    doc.text('Telp: (021) 1234567 | Email: info@samoedra.com', 105, footerY + 2, { align: 'center' });

    // Catatan
    doc.setFontSize(8);
    doc.setTextColor(...primaryColor);
    doc.text('* Invoice ini sah dan diproses secara elektronik', 105, footerY + 10, { align: 'center' });

    // Simpan PDF dengan format nama yang rapi
    const formattedDate = new Date().toISOString().slice(0,10);
    doc.save(`Invoice-Bermain-${name}-${formattedDate}.pdf`);
}

// ... existing code ...
</script>

<style>
#preview-image {
    transition: opacity 0.3s ease-in-out;
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.aspect-[3/4] {
    aspect-ratio: 3/4;
}

.aspect-[4/3] {
    aspect-ratio: 4/3;
}

#student-photo-preview img,
#payment-proof-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hover\:scale-105:hover {
    transform: scale(1.05);
}

.preview-container {
    @apply relative w-full max-w-[300px] rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-xl;
}

.preview-container.student-photo {
    @apply aspect-[3/4];
}

.preview-container.payment-proof {
    @apply aspect-[4/3];
}

.preview-overlay {
    @apply absolute inset-0 bg-black/40 flex items-center justify-center transition-opacity duration-300;
}

.preview-container:hover .preview-overlay {
    @apply opacity-0;
}

#student-photo-preview img,
#payment-proof-preview img {
    @apply w-full h-full object-cover transition-transform duration-500;
}

.preview-container:hover img {
    @apply scale-110;
}

.upload-button {
    @apply relative overflow-hidden inline-flex items-center justify-center px-6 py-3 rounded-xl bg-success-300 text-white font-medium hover:bg-success-400 transition-all duration-300 focus:ring-4 focus:ring-success-300/50;
}

.input-field {
    @apply w-full bg-gray-50 dark:bg-darkblack-500 border-2 border-gray-200 dark:border-darkblack-400 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300;
}
</style>
@endpush
