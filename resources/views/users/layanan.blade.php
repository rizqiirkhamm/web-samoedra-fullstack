@extends('users.layouts.app')

@section('title', 'Layanan')

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

        <!-- Success Modal -->
        <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/30 dark:bg-white/10 backdrop-blur-sm"></div>
            <div class="relative bg-white dark:bg-darkblack-600 rounded-xl shadow-2xl p-6 w-96 max-w-md transform transition-all animate-modal-pop">
                <div class="text-center">
                    <svg class="mx-auto mb-4 w-14 h-14 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Berhasil!</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">Data berhasil disimpan.</p>
                    <div class="flex justify-center gap-4">
                        <button onclick="handleGenerateInvoice()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Generate Invoice
                        </button>
                        <button onclick="closeSuccessModal()" class="px-4 py-2 bg-gray-100 dark:bg-darkblack-500 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-darkblack-400 transition-colors duration-200">
                            Tutup
                        </button>
                    </div>
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
                <!-- Konten dynamic akan diisi oleh JavaScript -->
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
</div>

@endsection

@push('scripts')
<!-- Tambahkan CDN jsPDF sebelum script lainnya -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('main_service_type');
    const dynamicFields = document.getElementById('dynamic-fields');
    const previewImage = document.getElementById('preview-image');

    // Update path gambar
    const images = {
        'bermain': '{{ asset("images/avatar/bermain.png") }}',
        'bimbel': '{{ asset("images/avatar/bimbel.png") }}',
        'default': '{{ asset("images/avatar/samodra.png") }}'
    };

    serviceSelect.addEventListener('change', function() {
        const selectedService = this.value;

        // Update gambar dengan efek fade
        previewImage.style.opacity = '0';
        setTimeout(() => {
            previewImage.src = selectedService ? images[selectedService] : images.default;
            previewImage.style.opacity = '1';
        }, 300);

        // Show/hide dynamic fields
        if (selectedService) {
            dynamicFields.classList.remove('hidden');
            loadServiceFields(selectedService);
        } else {
            dynamicFields.classList.add('hidden');
            dynamicFields.innerHTML = '';
        }
    });

    function loadServiceFields(service) {
        let fields = '';

        if (service === 'bermain') {
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
                    <input type="date" name="date" required min="{{ date('Y-m-d') }}"
                           class="w-full rounded-lg border border-bgray-300 p-2.5">
                </div>

                <!-- Hari (Readonly) -->
                <div class="form-group animate-fade-in">
                    <label class="mb-2 block text-base font-medium text-bgray-600 dark:text-bgray-50">
                        Hari
                    </label>
                    <input type="text" name="day_display" readonly required
                           class="w-full rounded-lg border border-bgray-300 p-2.5 bg-gray-50 cursor-not-allowed">
                    <input type="hidden" name="day" required>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
        }

        dynamicFields.innerHTML = fields;

        // Reinitialize event listeners
        initializeEventListeners();
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
    const modal = document.getElementById('successModal');
    modal.classList.remove('hidden');

    // Simpan data response untuk digunakan saat generate invoice
    window.lastSubmittedData = responseData;

    // Update status info jika ini adalah bimbel
    if (responseData.main_service_type === 'bimbel') {
        const statusInfo = document.getElementById('statusInfo');
        const startDate = new Date(responseData.data.start_date);
        const formattedDate = startDate.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        statusInfo.classList.remove('hidden');
        const statusText = responseData.data.status === 'inactive'
            ? `Bimbel akan aktif pada tanggal ${formattedDate}`
            : 'Bimbel sudah aktif dan dapat dimulai';

        statusInfo.querySelector('p').textContent = statusText;

        // Tambahkan kelas warna sesuai status
        statusInfo.querySelector('p').className =
            responseData.data.status === 'inactive'
                ? 'text-yellow-600 dark:text-yellow-400'
                : 'text-green-600 dark:text-green-400';
    }
}

// Update event listener form submit
document.getElementById('layananForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Reset status info setiap kali form disubmit
    const statusInfo = document.getElementById('statusInfo');
    statusInfo.classList.add('hidden');
    statusInfo.querySelector('p').textContent = '';

    const formData = new FormData(this);
    const mainServiceType = document.getElementById('main_service_type').value;
    formData.append('main_service_type', mainServiceType);

    const token = document.querySelector('meta[name="csrf-token"]').content;

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccessModal(data);
            // Hapus redirect otomatis
        } else {
            alert(data.message || 'Terjadi kesalahan');
            if (data.errors) {
                console.error('Validation errors:', data.errors);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    });
});

// Update fungsi closeSuccessModal untuk mengarahkan ke halaman yang sesuai
function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.add('hidden');

    // Ambil tipe layanan yang dipilih
    const mainServiceType = document.getElementById('main_service_type').value;

    // Redirect sesuai dengan tipe layanan
    if (mainServiceType === 'bimbel') {
        window.location.href = '/bimbel';
    } else if (mainServiceType === 'bermain') {
        window.location.href = '{{ route("bermain.index") }}';
    }
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
    doc.text(`Bermain (${duration} jam)`, 25, yPos);
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

// Update fungsi handleGenerateInvoice
function handleGenerateInvoice() {
    const data = window.lastSubmittedData;
    if (!data) {
        alert('Data tidak tersedia');
        return;
    }

    const mainServiceType = data.main_service_type;

    if (mainServiceType === 'bimbel') {
        generateBimbelInvoice(data.data); // Gunakan data.data karena response dari server menyimpan data di nested object
    } else if (mainServiceType === 'bermain') {
        generateInvoicePDF(
            data.data.id,
            data.data.name,
            data.data.age,
            data.data.day,
            data.data.selected_time,
            data.data.duration,
            data.data.need_socks
        );
    }
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
</style>
@endpush
