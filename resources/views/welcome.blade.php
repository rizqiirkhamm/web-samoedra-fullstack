<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samoedra - Pendaftaran Layanan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="icon" href="{{ asset('images/assets/logo-doang.png') }}" type="image/png">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{route('home')}}">
                            <p class="ml-2 font- text-gray-600 bg-gray-200 px-4 py-2 rounded-xl hover:text-gray-400 transition-all duration-300 flex gap-2 items-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                                Kembali</p>
                        </a> </div>
                </div> <img src="{{ asset('images/assets/logo-doang.png') }}" class="h-8 w-auto" alt="Samoedra">
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="w-full rounded-xl bg-white px-[24px] py-[20px]">
            <!-- Image Preview dengan desain baru -->
            <div class="flex justify-center mb-8">
                <div
                    class="relative w-full max-w-3xl md:h-[400px] rounded-xl overflow-hidden shadow-lg">
                    <img id="preview-image" src="{{ asset('images/avatar/samodra.png') }}"
                        class="h-full w-full object-cover transition-all duration-500"
                        onerror="this.onerror=null; this.src='{{ asset('images/avatar/samodra.png') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-2xl font-semibold">Layanan Samoedra</h3>
                    </div>
                </div>
            </div>

            <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
                <div class="fixed inset-0 bg-black/50 dark:bg-white/10 backdrop-blur-sm"></div>
                <div
                    class="relative bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl p-8 w-96 max-w-md transform transition-all animate-modal-pop">
                    <div class="text-center">
                        <!-- Icon sukses yang lebih besar dan lebih menarik -->
                        <div class="mx-auto mb-6 w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <!-- Judul dengan ukuran yang lebih besar -->
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Berhasil!</h3>

                        <!-- Pesan dengan margin yang lebih baik -->
                        <p class="text-gray-600 mb-8">Data berhasil disimpan.</p>

                        <!-- Info invoice dengan desain yang lebih baik -->
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-blue-700 text-sm text-left">
                                    Untuk mendapatkan invoice, silahkan hubungi admin
                                </p>
                            </div>
                        </div>

                        <!-- Tombol tutup yang lebih menarik -->
                        <button onclick="closeSuccessModal()"
                            class="w-full py-3 bg-gray-800 text-white rounded-xl hover:bg-gray-700 transition-colors duration-200 font-medium">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form dengan desain baru -->
            <form id="layananForm" action="{{ route('layanan.public.submit') }}" method="POST"
                enctype="multipart/form-data" class="max-w-3xl mx-auto">
                @csrf

                <!-- Alert Error -->
                @if(session('error') || $errors->any())
                <div class="mb-6">
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-600">
                                    {{ session('error') ?? $errors->first() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Pilih Layanan -->
                <div class="mb-6">
                    <label for="main_service_type" class="block text-lg font-medium text-gray-700 mb-3">
                        Pilih Layanan
                    </label>
                    <select id="main_service_type" name="main_service_type" required
                        class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                        <option value="">Pilih Layanan</option>
                        <option value="bermain">Bermain</option>
                        <option value="bimbel">Bimbel</option>
                        <option value="stimulasi">Kelas Stimulasi</option>
                        <option value="daycare">Daycare</option>
                        <option value="event">Event</option>
                    </select>
                </div>

                <!-- Data Diri -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-700 mb-3">Data Diri</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" id="name" name="name" required
                                class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                        </div>
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700 mb-2">
                                Usia
                            </label>
                            <input type="number" id="age" name="age" required min="1" max="100"
                                class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon Orangtua
                        </label>
                        <input type="number" id="phone" name="phone" required
                            class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>

                <!-- Dynamic Fields Container -->
                <div id="dynamic-fields" class="mb-6 hidden">
                    <div id="serviceFields">
                        <!-- Fields akan diisi oleh JavaScript -->
                    </div>
                </div>

                <!-- Checkbox untuk kaos kaki -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="need_socks" class="mr-2">
                        <span>Beli Kaos Kaki (Rp 5.000) - <span class="text-red-500">*Wajib beli jika belum memiliki
                                kaos kaki</span></span>
                    </label>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="form-group animate-fade-in mb-6">
                    <div class="p-4 bg-yellow-50 rounded-xl">
                        <p class="text-yellow-800">
                            <strong>Informasi Pembayaran:</strong><br>
                            No Rekening: 6821039361<br>
                            BCA atas nama: siti nur arsyillah. a
                        </p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors duration-300">
                        Daftar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Copy all scripts from layanan.blade.php -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi form
            const mainServiceType = document.getElementById('main_service_type');
            const dynamicFields = document.getElementById('dynamic-fields');
            const serviceFields = document.getElementById('serviceFields');

            if (mainServiceType) {
                mainServiceType.addEventListener('change', function () {
                    const selectedService = this.value;

                    if (selectedService) {
                        dynamicFields.classList.remove('hidden');
                        loadServiceFields(selectedService);

                        // Perbarui gambar preview
                        const previewImage = document.getElementById('preview-image');
                        if (previewImage) {
                            previewImage.src = `{{ asset('images/avatar/${selectedService}.png') }}`;
                        }
                    } else {
                        dynamicFields.classList.add('hidden');
                        serviceFields.innerHTML = '';
                    }
                });
            }

            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(today.getDate() - 1);

            // Format tanggal ke YYYY-MM-DD
            const maxDate = yesterday.toISOString().split('T')[0];

            // Set max date untuk semua input birth_date
            document.querySelectorAll('input[name="birth_date"]').forEach(input => {
                input.setAttribute('max', maxDate);
            });

            // Fungsi untuk memuat field berdasarkan tipe layanan
            window.loadServiceFields = function (service) {
                if (service === 'bermain') {
                    serviceFields.innerHTML = `
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Bermain</h3>

                            <!-- Informasi Operasional -->
                            <div class="mb-4">
                                <div class="p-4 bg-yellow-50 rounded-xl">
                                    <p class="text-yellow-800">
                                        <strong>Jam Operasional:</strong> 08:00 - 17:00 WIB
                                    </p>
                                </div>
                            </div>

                            <!-- Tanggal Bermain -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Bermain
                                </label>
                                <input type="date"
                                       id="bermain_date"
                                       name="date"
                                       required
                                       min="${new Date().toISOString().split('T')[0]}"
                                       onchange="updateHariBermain()"
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <!-- Hari (Readonly) -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hari
                                </label>
                                <input type="text"
                                       id="bermain_day"
                                       name="day"
                                       readonly
                                       required
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300 cursor-not-allowed">
                            </div>

                            <!-- Jam Mulai -->
                            <div class="form-group animate-fade-in mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jam Mulai
                                </label>
                                <input type="time" id="bermain_time" name="selected_time" required
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                <input type="hidden" id="start_datetime" name="start_datetime">
                            </div>

                            <!-- Durasi Bermain -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Durasi Bermain
                                </label>
                                <select name="duration" id="bermain_duration" required
                                        class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    <option value="">Pilih Durasi</option>
                                    <option value="1">1 Jam</option>
                                    <option value="2">2 Jam</option>
                                    <option value="3">3 Jam</option>
                                    <option value="6">Sepuasnya ( 6 jam )</option>
                                </select>
                            </div>

                            <!-- Bukti Pembayaran -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Bukti Pembayaran
                                </label>
                                <div class="flex flex-col items-center">
                                    <div class="w-full max-w-3xl aspect-[5/3] bg-gray-100 rounded-xl overflow-hidden mb-4">
                                        <div id="payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                            <div class="w-full px-4 py-3 text-sm text-center text-white bg-green-500 rounded-xl hover:bg-green-600 transition-colors duration-200">
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
                                                   onchange="window.previewPaymentProof(this)">
                                        </label>
                                        <p class="mt-2 text-sm text-gray-500 text-center">
                                            Format yang diterima: JPG, JPEG, PNG, HEIC (Max. 10MB)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    // Inisialisasi tanggal dengan hari ini
                    const today = new Date().toISOString().split('T')[0];
                    const dateInput = document.getElementById('bermain_date');
                    if (dateInput) {
                        dateInput.value = today;
                        updateHariBermain(); // Panggil sekali untuk mengatur hari awal
                    }
                } else if (service === 'bimbel') {
                    serviceFields.innerHTML = `
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Bimbel</h3>

                            <!-- Tambahkan field tersembunyi untuk memastikan semua field terkirim -->
                            <input type="hidden" name="service" value="bimbel">

                            <!-- Jenis Bimbel -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Bimbel
                                </label>
                                <select name="bimbel_type" required
                                        class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    <option value="">Pilih Jenis Bimbel</option>
                                    <option value="offline">Offline</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>

                            <!-- Bimbel yang ingin diikuti -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Bimbel yang ingin diikuti
                                </label>
                                <select name="service_type" required
                                        class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
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
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Mulai Bimbel
                                </label>
                                <input type="date" name="start_date" id="bimbel_start_date" required min="${new Date().toISOString().split('T')[0]}"
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                                       onchange="updateBimbelDay(this.value)">
                            </div>

                            <!-- Hari (readonly, diisi otomatis) -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hari
                                </label>
                                <input type="text" id="bimbel_day_display" readonly
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300 cursor-not-allowed">
                                <input type="hidden" name="day" id="bimbel_day" value="">
                            </div>

                            <!-- Total Pertemuan (hidden, default 8) -->
                            <input type="hidden" name="total_meetings" value="8">

                            <!-- Jenis Kelamin -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
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
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tempat Lahir
                                </label>
                                <input type="text" name="birth_place" required
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Lahir
                                </label>
                                <input type="date" name="birth_date" required
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300" max="{{ date('Y-m-d', strtotime('-1 day')) }}">
                            </div>

                            <!-- Riwayat Sekolah -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Apakah sudah/sedang bersekolah?
                                </label>
                                <div class="flex gap-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="has_school_history" value="1" required class="mr-2" onchange="toggleSchoolName(this.value)">
                                        <span>Ya</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="has_school_history" value="0" required class="mr-2" onchange="toggleSchoolName(this.value)">
                                        <span>Tidak</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Nama Sekolah (conditional) -->
                            <div class="mb-4" id="school_name_container" style="display: none;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Sekolah
                                </label>
                                <input type="text" name="school_name"
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <!-- Agama -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Agama
                                </label>
                                <select name="religion" required
                                        class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    <option value="">Pilih Agama</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="protestan">Protestan</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                </select>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat
                                </label>
                                <textarea name="address" required rows="3"
                                          class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"></textarea>
                            </div>

                            <!-- Anak ke- -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Anak ke-
                                </label>
                                <input type="number" name="child_order" required min="1"
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <!-- Nomor HP Anak (opsional) -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor HP Anak (opsional)
                                </label>
                                <input type="number" name="child_phone"
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <!-- Data Ayah -->
                            <h4 class="text-md font-semibold text-gray-800 mt-6 mb-4">Data Ayah</h4>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Ayah
                                </label>
                                <input type="text" name="father_name" required
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Usia Ayah
                                </label>
                                <input type="number" name="father_age" required min="1"
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pendidikan Terakhir Ayah
                                </label>
                                <textarea name="father_education" required
                                          class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                                          placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pekerjaan Ayah
                                </label>
                                <textarea name="father_occupation" required
                                          class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                                          placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                            </div>

                            <!-- Data Ibu -->
                            <h4 class="text-md font-semibold text-gray-800 mt-6 mb-4">Data Ibu</h4>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Ibu
                                </label>
                                <input type="text" name="mother_name" required
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Usia Ibu
                                </label>
                                <input type="number" name="mother_age" required min="1"
                                       class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pendidikan Terakhir Ibu
                                </label>
                                <textarea name="mother_education" required
                                          class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                                          placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pekerjaan Ibu
                                </label>
                                <textarea name="mother_occupation" required
                                          class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                                          placeholder="Sebutkan dengan detail untuk kepentingan assessment"></textarea>
                            </div>

                            <!-- Foto Peserta -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto Peserta Bimbel
                                </label>
                                <div class="flex flex-col items-center">
                                    <div class="w-full max-w-3xl aspect-[5/3] bg-gray-100 rounded-xl overflow-hidden mb-4">
                                        <div id="student-photo-preview" class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                            <div class="w-full px-4 py-3 text-sm text-center text-white bg-green-500 rounded-xl hover:bg-green-600 transition-colors duration-200">
                                                <span class="flex items-center justify-center gap-2">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Upload Foto Peserta
                                                </span>
                                            </div>
                                            <input type="file"
                                                   name="student_photo"
                                                   required
                                                   class="hidden"
                                                   accept="image/*"
                                                   onchange="previewStudentPhoto(this)">
                                        </label>
                                        <p class="mt-2 text-sm text-gray-500 text-center">
                                            Format yang diterima: JPG, JPEG, PNG, HEIC (Max. 10MB)
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Bukti Pembayaran -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Bukti Pembayaran
                                </label>
                                <div class="flex flex-col items-center">
                                    <div class="w-full max-w-3xl aspect-[5/3] bg-gray-100 rounded-xl overflow-hidden mb-4">
                                        <div id="bimbel-payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                            <div class="w-full px-4 py-3 text-sm text-center text-white bg-green-500 rounded-xl hover:bg-green-600 transition-colors duration-200">
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
                                                   onchange="previewBimbelPaymentProof(this)">
                                        </label>
                                        <p class="mt-2 text-sm text-gray-500 text-center">
                                            Format yang diterima: JPG, JPEG, PNG, HEIC (Max. 10MB)
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Field need_socks (hidden, default false) -->
                            <input type="hidden" name="need_socks" value="0">

                            <!-- Status (hidden, default waiting) -->
                            <input type="hidden" name="status" value="waiting">
                        </div>
                    `;

                    // Inisialisasi tanggal dan hari
                    setTimeout(() => {
                        const startDateInput = document.getElementById('bimbel_start_date');
                        if (startDateInput) {
                            const today = new Date().toISOString().split('T')[0];
                            startDateInput.value = today;
                            updateBimbelDay(today);
                        }
                    }, 100);
                } else if (service === 'stimulasi') {
                    serviceFields.innerHTML = `
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Stimulasi</h3>

                            <!-- Informasi Operasional -->
                            <div class="mb-4">
                                <div class="p-4 bg-yellow-50 rounded-xl">
                                    <p class="text-yellow-800">
                                        <strong>Informasi Layanan:</strong> ada Eksplorasi, Sensory, Motorik, Science Expriment, dll
                                    </p>
                                </div>
                            </div>

                            <!-- Data Diri Anak -->
                            <div class="mb-6">
                                <h4 class="text-md font-medium text-gray-700 mb-3">Data Diri Anak</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Jenis Kelamin -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Jenis Kelamin
                                        </label>
                                        <select name="gender" required
                                                class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>

                                    <!-- Agama -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Agama
                                        </label>
                                        <select name="religion" required
                                                class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                            <option value="">Pilih Agama</option>
                                            <option value="islam">Islam</option>
                                            <option value="kristen">Kristen</option>
                                            <option value="katolik">Katolik</option>
                                            <option value="hindu">Hindu</option>
                                            <option value="buddha">Buddha</option>
                                            <option value="konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Tempat Lahir -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Tempat Lahir
                                        </label>
                                        <input type="text" name="birth_place" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Lahir
                                        </label>
                                        <input type="date" name="birth_date" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300" max="{{ date('Y-m-d', strtotime('-1 day')) }}">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Tinggi Badan -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Tinggi Badan (cm)
                                        </label>
                                        <input type="number" name="height" required min="1"
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>

                                    <!-- Berat Badan -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Berat Badan (kg)
                                        </label>
                                        <input type="number" name="weight" required min="1"
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-4 mb-4">
                                    <!-- Alamat -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Alamat
                                        </label>
                                        <textarea name="address" required rows="3"
                                                  class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"></textarea>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Anak ke- -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Anak ke-
                                        </label>
                                        <input type="number" name="child_order" required min="1"
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>

                                    <!-- Nomor Telepon Anak (opsional) -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nomor Telepon Anak (opsional)
                                        </label>
                                        <input type="number" name="child_phone"
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>
                                </div>
                            </div>

                            <!-- Data Orang Tua -->
                            <div class="mb-6">
                                <h4 class="text-md font-medium text-gray-700 mb-3">Data Ayah</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Nama Ayah -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Ayah
                                        </label>
                                        <input type="text" name="father_name" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>

                                    <!-- Usia Ayah -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Usia Ayah
                                        </label>
                                        <input type="number" name="father_age" required min="1"
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Pendidikan Ayah -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Pendidikan Ayah
                                        </label>
                                        <input type="text" name="father_education" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>

                                    <!-- Pekerjaan Ayah -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Pekerjaan Ayah
                                        </label>
                                        <input type="text" name="father_occupation" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>
                                </div>

                                <h4 class="text-md font-medium text-gray-700 mb-3 mt-5">Data Ibu</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Nama Ibu -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Ibu
                                        </label>
                                        <input type="text" name="mother_name" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>

                                    <!-- Usia Ibu -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Usia Ibu
                                        </label>
                                        <input type="number" name="mother_age" required min="1"
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Pendidikan Ibu -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Pendidikan Ibu
                                        </label>
                                        <input type="text" name="mother_education" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>

                                    <!-- Pekerjaan Ibu -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Pekerjaan Ibu
                                        </label>
                                        <input type="text" name="mother_occupation" required
                                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                    </div>
                                </div>
                            </div>

                            <!-- HTML untuk form stimulasi dengan JavaScript inline -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-4">Upload Dokumen</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Foto Anak -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Foto Anak
                                        </label>
                                        <div class="bg-gray-100 rounded-xl overflow-hidden mb-3 aspect-[3/4]">
                                            <div id="stimulasi-photo-preview" class="w-full h-full flex items-center justify-center">
                                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <label for="student_photo" class="w-full py-3 px-4 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center cursor-pointer transition-colors">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Upload Foto Anak
                                        </label>
                                        <input type="file" id="student_photo" name="student_photo" accept="image/*" class="hidden" required
                                               onchange="
                                                   const file = this.files[0];
                                                   if (file) {
                                                       const reader = new FileReader();
                                                       reader.onload = function(e) {
                                                           const preview = document.getElementById('stimulasi-photo-preview');
                                                           // Hapus semua elemen anak
                                                           while (preview.firstChild) {
                                                               preview.removeChild(preview.firstChild);
                                                           }
                                                           // Buat elemen gambar baru
                                                           const img = document.createElement('img');
                                                           img.src = e.target.result;
                                                           img.alt = 'Foto Anak';
                                                           img.className = 'w-full h-full object-cover';
                                                           // Tambahkan gambar ke container
                                                           preview.appendChild(img);
                                                       };
                                                       reader.readAsDataURL(file);
                                                   }
                                               ">
                                    </div>

                                    <!-- Bukti Pembayaran -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Bukti Pembayaran
                                        </label>
                                        <div class="bg-gray-100 rounded-xl overflow-hidden mb-3 aspect-[3/4]">
                                            <div id="stimulasi-payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <label for="payment_proof" class="w-full py-3 px-4 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center cursor-pointer transition-colors">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Upload Bukti Pembayaran
                                        </label>
                                        <input type="file" id="payment_proof" name="payment_proof" accept="image/*" class="hidden" required
                                               onchange="
                                                   const file = this.files[0];
                                                   if (file) {
                                                       const reader = new FileReader();
                                                       reader.onload = function(e) {
                                                           const preview = document.getElementById('stimulasi-payment-proof-preview');
                                                           // Hapus semua elemen anak
                                                           while (preview.firstChild) {
                                                               preview.removeChild(preview.firstChild);
                                                           }
                                                           // Buat elemen gambar baru
                                                           const img = document.createElement('img');
                                                           img.src = e.target.result;
                                                           img.alt = 'Bukti Pembayaran';
                                                           img.className = 'w-full h-full object-cover';
                                                           // Tambahkan gambar ke container
                                                           preview.appendChild(img);
                                                       };
                                                       reader.readAsDataURL(file);
                                                   }
                                               ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else if (service === 'daycare') {
                    serviceFields.innerHTML = `
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Daycare</h3>

            <!-- Informasi Operasional -->
            <div class="mb-4">
                <div class="p-4 bg-blue-50 rounded-xl">
                    <p class="text-blue-800">
                        <strong>Informasi Layanan:</strong> Daycare untuk penitipan anak
                    </p>
                </div>
            </div>

            <!-- Tipe Daycare -->
            <div class="mb-6">
                <h4 class="text-md font-medium text-gray-700 mb-3">Tipe Daycare</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Tipe Daycare
                        </label>
                        <select name="daycare_type" required
                                class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Tipe</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="harian">Harian</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Data Diri Anak -->
            <div class="mb-6">
                <h4 class="text-md font-medium text-gray-700 mb-3">Data Diri Anak</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Kelamin
                        </label>
                        <select name="gender" required
                                class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Agama
                        </label>
                        <select name="religion" required
                                class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tempat Lahir
                        </label>
                        <input type="text" name="birth_place" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir
                        </label>
                        <input type="date" name="birth_date" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300" max="{{ date('Y-m-d', strtotime('-1 day')) }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Tinggi Badan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tinggi Badan (cm)
                        </label>
                        <input type="number" name="height" required min="1"
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Berat Badan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Berat Badan (kg)
                        </label>
                        <input type="number" name="weight" required min="1"
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 mb-4">
                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <textarea name="address" required rows="3"
                                  class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Anak ke- -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Anak ke-
                        </label>
                        <input type="number" name="child_order" required min="1"
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Nomor Telepon Anak (opsional) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon Anak (opsional)
                        </label>
                        <input type="number" name="child_phone"
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="mb-6">
                <h4 class="text-md font-medium text-gray-700 mb-3">Data Ayah</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Nama Ayah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Ayah
                        </label>
                        <input type="text" name="father_name" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Usia Ayah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Usia Ayah
                        </label>
                        <input type="number" name="father_age" required min="1"
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Pendidikan Ayah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pendidikan Ayah
                        </label>
                        <input type="text" name="father_education" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Pekerjaan Ayah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan Ayah
                        </label>
                        <input type="text" name="father_occupation" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>

                <h4 class="text-md font-medium text-gray-700 mb-3 mt-5">Data Ibu</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Nama Ibu -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Ibu
                        </label>
                        <input type="text" name="mother_name" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Usia Ibu -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Usia Ibu
                        </label>
                        <input type="number" name="mother_age" required min="1"
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Pendidikan Ibu -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pendidikan Ibu
                        </label>
                        <input type="text" name="mother_education" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Pekerjaan Ibu -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan Ibu
                        </label>
                        <input type="text" name="mother_occupation" required
                               class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                    </div>
                </div>
            </div>

            <!-- HTML untuk form daycare dengan nama field yang benar -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Upload Dokumen</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto Anak -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Anak
                        </label>
                        <div class="bg-gray-100 rounded-xl overflow-hidden mb-3 aspect-[3/4]">
                            <div id="daycare-photo-preview" class="w-full h-full flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <label for="student_photo" class="w-full py-3 px-4 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center cursor-pointer transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Upload Foto Anak
                        </label>
                        <input type="file" id="student_photo" name="student_photo" accept="image/*" class="hidden" required
                               onchange="
                                   const file = this.files[0];
                                   if (file) {
                                       const reader = new FileReader();
                                       reader.onload = function(e) {
                                           const preview = document.getElementById('daycare-photo-preview');
                                           // Hapus semua elemen anak
                                           while (preview.firstChild) {
                                               preview.removeChild(preview.firstChild);
                                           }
                                           // Buat elemen gambar baru
                                           const img = document.createElement('img');
                                           img.src = e.target.result;
                                           img.alt = 'Foto Anak';
                                           img.className = 'w-full h-full object-cover';
                                           // Tambahkan gambar ke container
                                           preview.appendChild(img);
                                       };
                                       reader.readAsDataURL(file);
                                   }
                               ">
                    </div>

                    <!-- Bukti Pembayaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Bukti Pembayaran
                        </label>
                        <div class="bg-gray-100 rounded-xl overflow-hidden mb-3 aspect-[3/4]">
                            <div id="daycare-payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <label for="payment_proof" class="w-full py-3 px-4 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center cursor-pointer transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Upload Bukti Pembayaran
                        </label>
                        <input type="file" id="payment_proof" name="payment_proof" accept="image/*" class="hidden" required
                               onchange="
                                   const file = this.files[0];
                                   if (file) {
                                       const reader = new FileReader();
                                       reader.onload = function(e) {
                                           const preview = document.getElementById('daycare-payment-proof-preview');
                                           // Hapus semua elemen anak
                                           while (preview.firstChild) {
                                               preview.removeChild(preview.firstChild);
                                           }
                                           // Buat elemen gambar baru
                                           const img = document.createElement('img');
                                           img.src = e.target.result;
                                           img.alt = 'Bukti Pembayaran';
                                           img.className = 'w-full h-full object-cover';
                                           // Tambahkan gambar ke container
                                           preview.appendChild(img);
                                       };
                                       reader.readAsDataURL(file);
                                   }
                               ">
                    </div>
                </div>
            </div>
        </div>
    `;
                } else if (service === 'event') {
                    // Ambil data event dari server
                    fetch('/api/events')
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const events = data.events;
                                let eventOptions = '<option value="">Pilih Event</option>';

                                events.forEach(event => {
                                    const eventDate = new Date(event.event_date)
                                        .toLocaleDateString('id-ID', {
                                            day: 'numeric',
                                            month: 'long',
                                            year: 'numeric'
                                        });
                                    eventOptions +=
                                        `<option value="${event.id}">${event.name} - ${eventDate}</option>`;
                                });

                                serviceFields.innerHTML = `
                                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Event</h3>

                                        <!-- Informasi Operasional -->
                                        <div class="mb-4">
                                            <div class="p-4 bg-blue-50 rounded-xl">
                                                <p class="text-blue-800">
                                                    <strong>Informasi Layanan:</strong> Pendaftaran event spesial
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Pilih Event -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Pilih Event
                                            </label>
                                            <select name="event_id" required
                                                    class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                                ${eventOptions}
                                            </select>
                                        </div>

                                        <!-- Data Orang Tua -->
                                        <div class="mb-6">
                                            <h4 class="text-md font-medium text-gray-700 mb-3">Data Orang Tua</h4>
                                            <div class="grid grid-cols-1 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Nama Orang Tua
                                                    </label>
                                                    <input type="text" name="parent_name" required
                                                           class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Alamat
                                                    </label>
                                                    <textarea name="address" required rows="3"
                                                              class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"></textarea>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Social Media
                                                    </label>
                                                    <input type="text" name="social_media" required
                                                           class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300"
                                                           placeholder="Instagram/Facebook/TikTok">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sumber Informasi -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Dari mana Anda mengetahui event ini?
                                            </label>
                                            <select name="source_info" required
                                                    class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-300 focus:border-transparent transition-all duration-300">
                                                <option value="">Pilih Sumber Informasi</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="tiktok">TikTok</option>
                                                <option value="teman">Teman/Keluarga</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                        </div>

                                        <!-- Bukti Pembayaran -->
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Bukti Pembayaran
                                            </label>
                                            <div class="flex flex-col items-center">
                                                <div class="w-full max-w-3xl aspect-[5/3] bg-gray-100 rounded-xl overflow-hidden mb-4">
                                                    <div id="payment-proof-preview" class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </div>

                                                </div>
                                                <div class="w-full">
                                                    <label class="relative flex flex-col items-center gap-2 cursor-pointer">
                                                        <div class="w-full px-4 py-3 text-sm text-center text-white bg-green-500 rounded-xl hover:bg-green-600 transition-colors duration-200">
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
                                                               onchange="window.previewPaymentProof(this)">
                                                    </label>
                                                    <p class="mt-2 text-sm text-gray-500 text-center">
                                                        Format yang diterima: JPG, JPEG, PNG, HEIC (Max. 10MB)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            } else {
                                serviceFields.innerHTML = `
                                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                                        <div class="p-4 bg-red-50 rounded-xl">
                                            <p class="text-red-800">
                                                <strong>Error:</strong> Tidak dapat memuat data event. Silakan coba lagi nanti.
                                            </p>
                                        </div>
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching events:', error);
                            serviceFields.innerHTML = `
                                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                                    <div class="p-4 bg-red-50 rounded-xl">
                                        <p class="text-red-800">
                                            <strong>Error:</strong> Tidak dapat memuat data event. Silakan coba lagi nanti.
                                        </p>
                                    </div>
                                </div>
                            `;
                        });
                } else {
                    // Kode untuk layanan lain
                    serviceFields.innerHTML =
                        `<div class="p-4 bg-yellow-50 rounded-xl">Silakan isi data diri dan pilih layanan yang tersedia.</div>`;
                }
            };

            // Definisikan fungsi-fungsi yang diperlukan di window scope
            window.updateHariBermain = function () {
                const dateInput = document.getElementById('bermain_date');
                const dayInput = document.getElementById('bermain_day');

                if (dateInput && dayInput) {
                    const date = new Date(dateInput.value);
                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    dayInput.value = days[date.getDay()];

                    // Update start_datetime jika jam sudah dipilih
                    window.updateStartDateTime();
                }
            };

            window.updateStartDateTime = function () {
                const dateInput = document.getElementById('bermain_date');
                const timeInput = document.getElementById('bermain_time');
                const startDatetimeInput = document.getElementById('start_datetime');

                if (dateInput && timeInput && startDatetimeInput && dateInput.value && timeInput.value) {
                    startDatetimeInput.value = `${dateInput.value} ${timeInput.value}`;
                    console.log('Start datetime set to:', startDatetimeInput.value);
                }
            };

            window.previewPaymentProof = function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const preview = document.getElementById('payment-proof-preview');
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    }
                    reader.readAsDataURL(file);
                }
            };

            window.previewBimbelPaymentProof = function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const preview = document.getElementById('bimbel-payment-proof-preview');
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    }
                    reader.readAsDataURL(file);
                }
            };

            window.closeSuccessModal = function () {
                const modal = document.getElementById('successModal');
                if (modal) {
                    modal.classList.add('hidden');
                }
            };

            window.showSuccessModal = function () {
                const modal = document.getElementById('successModal');
                if (modal) {
                    modal.classList.remove('hidden');
                }
            };

            // Tambahkan fungsi untuk preview foto peserta
            window.previewStudentPhoto = function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const preview = document.getElementById('student-photo-preview');
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    }
                    reader.readAsDataURL(file);
                }
            };

            // Tambahkan fungsi untuk toggle nama sekolah
            window.toggleSchoolName = function (value) {
                const schoolNameContainer = document.getElementById('school_name_container');
                const schoolNameInput = document.querySelector('input[name="school_name"]');

                if (value === '1') {
                    schoolNameContainer.style.display = 'block';
                    schoolNameInput.required = true;
                } else {
                    schoolNameContainer.style.display = 'none';
                    schoolNameInput.required = false;
                    schoolNameInput.value = '';
                }
            };

            // Fungsi untuk mengupdate hari berdasarkan tanggal
            window.updateBimbelDay = function (dateString) {
                const date = new Date(dateString);
                const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const dayIndex = date.getDay();
                const dayName = dayNames[dayIndex];

                const dayInput = document.getElementById('bimbel_day');
                const dayDisplay = document.getElementById('bimbel_day_display');

                if (dayInput) {
                    dayInput.value = dayName;
                }

                if (dayDisplay) {
                    dayDisplay.value = dayName;
                }
            };

            // Ubah form menjadi AJAX
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Pastikan start_datetime terisi jika layanan bermain
                    const serviceType = document.querySelector('select[name="main_service_type"]');
                    if (serviceType && serviceType.value === 'bermain') {
                        window.updateStartDateTime();
                    }

                    // Kirim form dengan AJAX
                    const formData = new FormData(form);

                    // Tampilkan loading
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    `;

                    fetch('/daftar-public', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Kembalikan tombol submit ke normal
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;

                            if (data.success) {
                                // Tampilkan modal sukses
                                window.showSuccessModal();
                                // Reset form
                                form.reset();
                                // Reset field dinamis
                                const serviceFields = document.getElementById('serviceFields');
                                if (serviceFields) {
                                    serviceFields.innerHTML = '';
                                }
                                // Sembunyikan field dinamis
                                const dynamicFields = document.getElementById('dynamic-fields');
                                if (dynamicFields) {
                                    dynamicFields.classList.add('hidden');
                                }
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            // Kembalikan tombol submit ke normal
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;

                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengirim data');
                        });
                });
            }

            // Di welcome.blade.php, tambahkan script ini
            fetch('/api/events')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const eventSelect = document.querySelector('select[name="event_id"]');
                        if (eventSelect) {
                            // Hapus semua option kecuali yang pertama
                            while (eventSelect.options.length > 1) {
                                eventSelect.remove(1);
                            }

                            // Tambahkan option baru dari data
                            data.events.forEach(event => {
                                const option = document.createElement('option');
                                option.value = event.id;
                                option.textContent = event.name;
                                eventSelect.appendChild(option);
                            });
                        }
                    } else {
                        console.error('Error:', data.message);
                        alert('Error: Tidak dapat memuat data event. Silakan coba lagi nanti.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error: Tidak dapat memuat data event. Silakan coba lagi nanti.');
                });

            // Tambahkan fungsi previewPaymentProof yang benar
            window.previewPaymentProof = function (input) {
                if (input && input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        const previewContainer = document.getElementById('payment-proof-preview');
                        if (previewContainer) {
                            // Hapus konten sebelumnya
                            previewContainer.innerHTML = '';

                            // Buat elemen gambar baru
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Bukti Pembayaran';
                            img.classList.add('w-full', 'h-full', 'object-cover');

                            // Tambahkan gambar ke container
                            previewContainer.appendChild(img);

                            // Tampilkan container preview
                            previewContainer.parentElement.classList.remove('hidden');
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };

            // Pastikan elemen input file untuk bukti pembayaran memiliki event listener yang benar
            document.addEventListener('DOMContentLoaded', function () {
                const paymentProofInput = document.getElementById('payment_proof');
                if (paymentProofInput) {
                    paymentProofInput.addEventListener('change', function () {
                        previewPaymentProof(this);
                    });
                }
            });

            // Fungsi untuk preview foto peserta bimbel
            window.previewStudentPhoto = function (input) {
                if (input && input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        const previewContainer = document.getElementById('student-photo-preview');
                        if (previewContainer) {
                            // Hapus konten sebelumnya
                            previewContainer.innerHTML = '';

                            // Buat elemen gambar baru
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Foto Peserta';
                            img.classList.add('w-full', 'h-full', 'object-cover');

                            // Tambahkan gambar ke container
                            previewContainer.appendChild(img);
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };

            // Fungsi untuk preview bukti pembayaran bimbel
            window.previewBimbelPaymentProof = function (input) {
                if (input && input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        const previewContainer = document.getElementById(
                            'bimbel-payment-proof-preview');
                        if (previewContainer) {
                            // Hapus konten sebelumnya
                            previewContainer.innerHTML = '';

                            // Buat elemen gambar baru
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Bukti Pembayaran';
                            img.classList.add('w-full', 'h-full', 'object-cover');

                            // Tambahkan gambar ke container
                            previewContainer.appendChild(img);
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };

            // Pastikan elemen input file memiliki event listener yang benar
            document.addEventListener('DOMContentLoaded', function () {
                // Inisialisasi event listener untuk input file foto peserta
                const studentPhotoInput = document.querySelector('input[name="student_photo"]');
                if (studentPhotoInput) {
                    studentPhotoInput.addEventListener('change', function () {
                        previewStudentPhoto(this);
                    });
                }

                // Inisialisasi event listener untuk input file bukti pembayaran bimbel
                const bimbelPaymentProofInput = document.querySelector('input[name="payment_proof"]');
                if (bimbelPaymentProofInput) {
                    bimbelPaymentProofInput.addEventListener('change', function () {
                        previewBimbelPaymentProof(this);
                    });
                }
            });

            // Fungsi untuk mengupdate hari berdasarkan tanggal yang dipilih
            function updateBimbelDay(date) {
                if (!date) return;

                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const selectedDate = new Date(date);
                const dayIndex = selectedDate.getDay();
                const dayName = days[dayIndex];

                document.getElementById('bimbel_day_display').value = dayName;
                document.getElementById('bimbel_day').value = dayName;
            }

            // Fungsi untuk menampilkan/menyembunyikan field nama sekolah
            function toggleSchoolName(value) {
                const container = document.getElementById('school_name_container');
                const input = container.querySelector('input[name="school_name"]');

                if (value === '1') {
                    container.style.display = 'block';
                    input.setAttribute('required', 'required');
                } else {
                    container.style.display = 'none';
                    input.removeAttribute('required');
                    input.value = '';
                }
            }

            // Fungsi untuk preview foto peserta stimulasi
            window.previewStimulasiPhoto = function (input) {
                console.log("previewStimulasiPhoto called", input);
                if (input && input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        const previewContainer = document.getElementById('stimulasi-photo-preview');
                        if (previewContainer) {
                            // Hapus konten sebelumnya
                            previewContainer.innerHTML = '';

                            // Buat elemen gambar baru
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Foto Peserta';
                            img.classList.add('w-full', 'h-full', 'object-cover');

                            // Tambahkan gambar ke container
                            previewContainer.appendChild(img);

                            // Tampilkan container preview
                            const parentContainer = previewContainer.closest('.preview-container');
                            if (parentContainer) {
                                parentContainer.classList.remove('hidden');
                            }
                        } else {
                            console.error("Preview container not found");
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    console.log("No file selected or input is invalid", input);
                }
            };

            // Fungsi untuk preview bukti pembayaran stimulasi
            window.previewStimulasiPaymentProof = function (input) {
                console.log("previewStimulasiPaymentProof called", input);
                if (input && input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        const previewContainer = document.getElementById(
                            'stimulasi-payment-proof-preview');
                        if (previewContainer) {
                            // Hapus konten sebelumnya
                            previewContainer.innerHTML = '';

                            // Buat elemen gambar baru
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Bukti Pembayaran';
                            img.classList.add('w-full', 'h-full', 'object-cover');

                            // Tambahkan gambar ke container
                            previewContainer.appendChild(img);

                            // Tampilkan container preview
                            const parentContainer = previewContainer.closest('.preview-container');
                            if (parentContainer) {
                                parentContainer.classList.remove('hidden');
                            }
                        } else {
                            console.error("Payment proof preview container not found");
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    console.log("No file selected or input is invalid", input);
                }
            };

            // Pastikan elemen input file memiliki event listener yang benar
            document.addEventListener('DOMContentLoaded', function () {
                console.log("DOM fully loaded");

                // Inisialisasi event listener untuk input file foto peserta stimulasi
                const stimulasiPhotoInput = document.querySelector('input[name="student_photo"]');
                if (stimulasiPhotoInput) {
                    console.log("Found stimulasi photo input");
                    stimulasiPhotoInput.addEventListener('change', function () {
                        console.log("Stimulasi photo changed");
                        previewStimulasiPhoto(this);
                    });
                } else {
                    console.log("Stimulasi photo input not found");
                }

                // Inisialisasi event listener untuk input file bukti pembayaran stimulasi
                const stimulasiPaymentProofInput = document.querySelector(
                    'input[name="payment_proof"]');
                if (stimulasiPaymentProofInput) {
                    console.log("Found stimulasi payment proof input");
                    stimulasiPaymentProofInput.addEventListener('change', function () {
                        console.log("Stimulasi payment proof changed");
                        previewStimulasiPaymentProof(this);
                    });
                } else {
                    console.log("Stimulasi payment proof input not found");
                }
            });

            // Fungsi untuk preview foto peserta (bisa digunakan untuk bimbel dan stimulasi)
            function previewPhoto(input, previewId) {
                if (input && input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        const previewContainer = document.getElementById(previewId);
                        if (previewContainer) {
                            // Hapus konten sebelumnya
                            previewContainer.innerHTML = '';

                            // Buat elemen gambar baru
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Preview';
                            img.classList.add('w-full', 'h-full', 'object-cover');

                            // Tambahkan gambar ke container
                            previewContainer.appendChild(img);
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Fungsi untuk preview bukti pembayaran (bisa digunakan untuk bimbel dan stimulasi)
            function previewPayment(input, previewId) {
                if (input && input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        const previewContainer = document.getElementById(previewId);
                        if (previewContainer) {
                            // Hapus konten sebelumnya
                            previewContainer.innerHTML = '';

                            // Buat elemen gambar baru
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Preview';
                            img.classList.add('w-full', 'h-full', 'object-cover');

                            // Tambahkan gambar ke container
                            previewContainer.appendChild(img);
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Event listener untuk bimbel
            const bimbelPhotoInput = document.querySelector('input[name="student_photo"]');
            if (bimbelPhotoInput) {
                bimbelPhotoInput.addEventListener('change', function () {
                    previewPhoto(this, 'student-photo-preview');
                });
            }

            const bimbelPaymentInput = document.querySelector('input[name="payment_proof"]');
            if (bimbelPaymentInput) {
                bimbelPaymentInput.addEventListener('change', function () {
                    previewPayment(this, 'bimbel-payment-proof-preview');
                });
            }

            // Event listener untuk stimulasi (menggunakan fungsi yang sama)
            const stimulasiPhotoInput = document.querySelector('input[name="student_photo"]');
            if (stimulasiPhotoInput) {
                stimulasiPhotoInput.addEventListener('change', function () {
                    previewPhoto(this, 'stimulasi-photo-preview');
                });
            }

            const stimulasiPaymentInput = document.querySelector('input[name="payment_proof"]');
            if (stimulasiPaymentInput) {
                stimulasiPaymentInput.addEventListener('change', function () {
                    previewPayment(this, 'stimulasi-payment-proof-preview');
                });
            }
        });

    </script>

    <style>
        #preview-image {
            transition: opacity 0.3s ease-in-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            @apply relative w-full max-w-3xl rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover: shadow-xl;
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
            @apply relative overflow-hidden inline-flex items-center justify-center px-6 py-3 rounded-xl bg-success-300 text-white font-medium hover: bg-success-400 transition-all duration-300 focus:ring-4 focus:ring-success-300/50;
        }

        .input-field {
            @apply w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 focus: ring-2 focus:ring-success-300 focus:border-transparent transition-all duration-300;
        }

        .animate-modal-pop {
            animation: modalPop 0.3s ease-out forwards;
        }

        @keyframes modalPop {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }

            70% {
                opacity: 1;
                transform: scale(1.05);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

    </style>
</body>

</html>
