@extends('users.layouts.app')

@section('title', 'Edit Halaman Tentang')

@section('content')
<div class="w-full">
    <div class="mb-6">
        <h4 class="text-xl font-semibold text-bgray-900 dark:text-white">
            Edit Halaman Tentang
        </h4>
        <p class="text-sm text-bgray-600 dark:text-bgray-50">
            Perubahan disini akan mempengaruhi tampilan pada halaman Tentang Kami
        </p>
    </div>

    <!-- Tab Navigation -->
    <div class="border-b border-bgray-200 dark:border-darkblack-400 mb-8">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
            <li class="mr-2">
                <a href="#konten" class="inline-block p-4 border-b-2 border-success-300 rounded-t-lg active dark:text-white" id="konten-tab">Konten Tentang</a>
            </li>
            <li class="mr-2">
                <a href="#organisasi" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:border-bgray-300 dark:text-white" id="organisasi-tab">Struktur Organisasi</a>
            </li>
        </ul>
    </div>

    <!-- Konten Tab -->
    <div id="konten-content" class="w-full rounded-lg bg-white px-6 py-8 dark:bg-darkblack-600">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-bgray-200 pb-5 dark:border-darkblack-400">
            <div>
                <h4 class="text-xl font-bold text-bgray-900 dark:text-white">Konten Tentang</h4>
                <p class="text-sm font-medium text-bgray-600 dark:text-bgray-50">
                    Ubah teks dan gambar untuk halaman tentang
                </p>
            </div>
        </div>

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

        <form action="{{ route('tentang.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-5">
            @csrf
            <div class="grid grid-cols-1 gap-x-6 gap-y-6">
                <!-- Gambar Sambutan -->
                <div>
                    <label class="block text-base font-medium text-bgray-600 dark:text-bgray-50 mb-2">
                        Gambar Sambutan
                    </label>
                    <div class="flex items-center space-x-4">
                        @php
                            $tentangData = [];
                            $jsonPath = 'tentang/data.json';
                            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($jsonPath)) {
                                $jsonData = \Illuminate\Support\Facades\Storage::disk('public')->get($jsonPath);
                                $tentangData = json_decode($jsonData, true) ?? [];
                            }
                        @endphp

                        <div class="w-32 h-32 overflow-hidden rounded-lg border border-dashed border-bgray-200 flex items-center justify-center">
                            @if (isset($tentangData['image_sambutan']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($tentangData['image_sambutan']))
                                <img src="{{ asset('storage/' . $tentangData['image_sambutan']) }}" alt="Gambar Sambutan" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/assets/img1.png') }}" alt="Gambar Sambutan" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <input type="file" name="image_sambutan" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0">
                        <p class="text-xs text-bgray-500 dark:text-bgray-300">Format: JPG, PNG, GIF - Maksimal 2MB</p>
                    </div>
                </div>

                <!-- Sambutan Lembaga -->
                <div>
                    <label class="block text-base font-medium text-bgray-600 dark:text-bgray-50 mb-2">
                        Sambutan Lembaga
                    </label>
                    <textarea name="sambutan_lembaga" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full" rows="4">{{ $tentangData['sambutan_lembaga'] ?? 'SAMOEDRA berdiri murni dibawah Lembaga swasta tidak dibawah Kementerian Tertentu sehingga memiliki keunikan tersendiri dalam pelayanan anak karena tidak ada intervensi dari tekanan Kurikulum tertentu. Sesuai koncep dan motonya, "belajar dan main suka-suka"' }}</textarea>
                </div>

                <!-- Tempat Bermain & Belajar -->
                <div>
                    <label class="block text-base font-medium text-bgray-600 dark:text-bgray-50 mb-2">
                        Tempat Bermain & Belajar Suka Suka
                    </label>
                    <textarea name="tempat_bermain" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full" rows="4">{{ $tentangData['tempat_bermain'] ?? 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. At, animi deserunt unde architecto, natus asperiores numquam expedita assumenda quidem quis, suscipit facere perspiciatis porro.' }}</textarea>
                </div>

                <!-- Konsep Pendidikan -->
                <div>
                    <label class="block text-base font-medium text-bgray-600 dark:text-bgray-50 mb-2">
                        Konsep Pendidikan
                    </label>
                    <textarea name="konsep_pendidikan" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full" rows="4">{{ $tentangData['konsep_pendidikan'] ?? 'Kurikulum Adaptif: Dirancang untuk memenuhi kebutuhan anak dengan pendekatan sensorik dan stimulasi motorik, mengusung konsep "Bebas dan Merdeka Belajar" yang fleksibel dan berkembang sesuai ilmu pengetahuan.' }}</textarea>
                </div>

                <!-- Filosofi -->
                <div>
                    <label class="block text-base font-medium text-bgray-600 dark:text-bgray-50 mb-2">
                        Filosofi
                    </label>
                    <textarea name="filosofi" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full" rows="4">{{ $tentangData['filosofi'] ?? 'Samoedra melambangkan kebebasan dan keluasaan hidup, seperti samudra yang tak terbatas. ORCA merepresentasikan kecerdasan paus dan lumba-lumba, mengajarkan anak belajar dengan bebas dan pintar.' }}</textarea>
                </div>

                <!-- Sejarah -->
                <div>
                    <label class="block text-base font-medium text-bgray-600 dark:text-bgray-50 mb-2">
                        Sejarah
                    </label>
                    <textarea name="sejarah" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full" rows="4">{{ $tentangData['sejarah'] ?? 'CV Konci, berdiri sejak 2017, bergerak di bidang pendidikan tinggi dan kemitraan. Resmi terdaftar sebagai Penanaman Modal Dalam Negeri (PMDN).' }}</textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-lg bg-success-300 px-12 py-3 text-base font-medium text-white transition hover:bg-success-400">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Organisasi Tab -->
    <div id="organisasi-content" class="w-full rounded-lg bg-white px-6 py-8 dark:bg-darkblack-600 hidden">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-bgray-200 pb-5 dark:border-darkblack-400">
            <div>
                <h4 class="text-xl font-bold text-bgray-900 dark:text-white">Struktur Organisasi</h4>
                <p class="text-sm font-medium text-bgray-600 dark:text-bgray-50">
                    Ubah foto, nama, dan jabatan staff Rumah Samoedra
                </p>
            </div>
        </div>

        @php
            $organisasiData = [];
            $jsonPath = 'tentang/organisasi.json';
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($jsonPath)) {
                $jsonData = \Illuminate\Support\Facades\Storage::disk('public')->get($jsonPath);
                $organisasiData = json_decode($jsonData, true) ?? [];
            }

            // Default data jika kosong
            if(empty($organisasiData)) {
                $organisasiData = [
                    'manajemen' => [
                        [
                            'id' => 'direktur',
                            'nama' => 'Mr Hakim',
                            'jabatan' => 'Direktur',
                            'foto' => 'images/assets/img1.png',
                            'dapat_dihapus' => false
                        ],
                        [
                            'id' => 'manager',
                            'nama' => 'Miss Rina',
                            'jabatan' => 'Manager Operasional',
                            'foto' => 'images/assets/img1.png',
                            'dapat_dihapus' => false
                        ]
                    ],
                    'guru' => [
                        [
                            'id' => 'guru1',
                            'nama' => 'Mr. Karim',
                            'jabatan' => 'Teachers',
                            'foto' => 'images/assets/img1.png',
                            'dapat_dihapus' => false
                        ],
                        [
                            'id' => 'guru2',
                            'nama' => 'Mr. Dimas',
                            'jabatan' => 'Teachers',
                            'foto' => 'images/assets/img1.png',
                            'dapat_dihapus' => false
                        ],
                        [
                            'id' => 'guru3',
                            'nama' => 'Mr. Andi',
                            'jabatan' => 'Teachers',
                            'foto' => 'images/assets/img1.png',
                            'dapat_dihapus' => false
                        ],
                        [
                            'id' => 'guru4',
                            'nama' => 'Miss Anna',
                            'jabatan' => 'Teachers',
                            'foto' => 'images/assets/img1.png',
                            'dapat_dihapus' => false
                        ]
                    ]
                ];
            }
        @endphp

        <form action="{{ route('tentang.organisasi.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 mt-5">
            @csrf

            <!-- Manajemen -->
            <div class="border-b border-bgray-200 pb-8 dark:border-darkblack-400">
                <h5 class="text-lg font-bold text-bgray-900 dark:text-white mb-4">Manajemen</h5>
                <div class="space-y-6">
                    @foreach($organisasiData['manajemen'] as $index => $manager)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center p-4 border border-bgray-200 dark:border-darkblack-400 rounded-lg">
                        <input type="hidden" name="manajemen[{{$index}}][id]" value="{{ $manager['id'] }}">
                        <input type="hidden" name="manajemen[{{$index}}][dapat_dihapus]" value="{{ $manager['dapat_dihapus'] ? 'true' : 'false' }}">

                        <div class="flex items-center space-x-4">
                            <div class="w-20 h-20 overflow-hidden rounded-full border border-dashed border-bgray-200 flex items-center justify-center">
                                <img
                                    src="{{ isset($manager['foto']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($manager['foto'])
                                        ? asset('storage/' . $manager['foto'])
                                        : asset($manager['foto']) }}"
                                    alt="{{ $manager['nama'] }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <input type="file" name="manajemen[{{$index}}][foto]" class="text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-1">Nama</label>
                            <input type="text" name="manajemen[{{$index}}][nama]" value="{{ $manager['nama'] }}" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-3 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-1">Jabatan</label>
                            <input type="text" name="manajemen[{{$index}}][jabatan]" value="{{ $manager['jabatan'] }}" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-3 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full">
                        </div>

                        <div class="flex justify-end">
                            @if($manager['dapat_dihapus'])
                            <button type="button" onclick="hapusAnggota(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                Hapus
                            </button>
                            @else
                            <div class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                                Tidak dapat dihapus
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Guru -->
            <div>
                <h5 class="text-lg font-bold text-bgray-900 dark:text-white mb-4">Guru</h5>
                <div id="guruContainer" class="space-y-6">
                    @foreach($organisasiData['guru'] as $index => $guru)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center p-4 border border-bgray-200 dark:border-darkblack-400 rounded-lg">
                        <input type="hidden" name="guru[{{$index}}][id]" value="{{ $guru['id'] }}">
                        <input type="hidden" name="guru[{{$index}}][dapat_dihapus]" value="{{ $guru['dapat_dihapus'] ? 'true' : 'false' }}">

                        <div class="flex items-center space-x-4">
                            <div class="w-20 h-20 overflow-hidden rounded-full border border-dashed border-bgray-200 flex items-center justify-center">
                                <img
                                    src="{{ isset($guru['foto']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($guru['foto'])
                                        ? asset('storage/' . $guru['foto'])
                                        : asset($guru['foto']) }}"
                                    alt="{{ $guru['nama'] }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <input type="file" name="guru[{{$index}}][foto]" class="text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-1">Nama</label>
                            <input type="text" name="guru[{{$index}}][nama]" value="{{ $guru['nama'] }}" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-3 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-1">Jabatan</label>
                            <input type="text" name="guru[{{$index}}][jabatan]" value="{{ $guru['jabatan'] }}" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-3 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full">
                        </div>

                        <div class="flex justify-end">
                            @if($guru['dapat_dihapus'])
                            <button type="button" onclick="hapusAnggota(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                Hapus
                            </button>
                            @else
                            <div class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                                Tidak dapat dihapus
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <button type="button" id="tambahGuru" class="mt-4 flex items-center text-success-300 hover:text-success-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Tambah Guru
                </button>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="rounded-lg bg-success-300 px-12 py-3 text-base font-medium text-white transition hover:bg-success-400">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const kontenTab = document.getElementById('konten-tab');
        const organisasiTab = document.getElementById('organisasi-tab');
        const kontenContent = document.getElementById('konten-content');
        const organisasiContent = document.getElementById('organisasi-content');

        kontenTab.addEventListener('click', function(e) {
            e.preventDefault();
            kontenTab.classList.add('border-success-300');
            organisasiTab.classList.remove('border-success-300');
            organisasiTab.classList.add('border-transparent');
            kontenContent.classList.remove('hidden');
            organisasiContent.classList.add('hidden');
        });

        organisasiTab.addEventListener('click', function(e) {
            e.preventDefault();
            organisasiTab.classList.add('border-success-300');
            kontenTab.classList.remove('border-success-300');
            kontenTab.classList.add('border-transparent');
            organisasiContent.classList.remove('hidden');
            kontenContent.classList.add('hidden');
        });

        // Check for hash in URL
        if(window.location.hash === '#organisasi') {
            organisasiTab.click();
        }

        // Tambah guru baru
        document.getElementById('tambahGuru').addEventListener('click', function() {
            const guruContainer = document.getElementById('guruContainer');
            const guruItems = guruContainer.querySelectorAll('.grid');
            const index = guruItems.length;

            const newId = 'guru_' + Date.now();

            const newItem = document.createElement('div');
            newItem.className = 'grid grid-cols-1 md:grid-cols-4 gap-4 items-center p-4 border border-bgray-200 dark:border-darkblack-400 rounded-lg';
            newItem.innerHTML = `
                <input type="hidden" name="guru[${index}][id]" value="${newId}">
                <input type="hidden" name="guru[${index}][dapat_dihapus]" value="true">

                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 overflow-hidden rounded-full border border-dashed border-bgray-200 flex items-center justify-center">
                        <img src="{{ asset('images/assets/img1.png') }}" alt="Default" class="w-full h-full object-cover">
                    </div>
                    <input type="file" name="guru[${index}][foto]" class="text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-1">Nama</label>
                    <input type="text" name="guru[${index}][nama]" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-3 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium text-bgray-600 dark:text-bgray-50 mb-1">Jabatan</label>
                    <input type="text" name="guru[${index}][jabatan]" class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-3 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full">
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="hapusAnggota(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Hapus
                    </button>
                </div>
            `;

            guruContainer.appendChild(newItem);
        });
    });

    // Fungsi untuk menghapus anggota
    function hapusAnggota(button) {
        if (confirm('Anda yakin ingin menghapus?')) {
            button.closest('.grid').remove();
        }
    }
</script>
@endpush
