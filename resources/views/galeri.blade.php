<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Samoedra</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Fredoka:wght@300..700&family=Fuzzy+Bubbles:wght@400;700&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    @include('components.navbar-fe')

    <!-- Banner -->
    <div class="w-full">
        <!-- Overlay & Text -->
        <div class="w-full h-110 flex flex-col items-center justify-center text-white text-center"
            style="background-image: url('images/assets/banner.png'); background-repeat: no-repeat; background-position: center;">
            <h1 class="text-white font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Galeri Rumah
                Samoedra</h1>
            <p class="mt-5 duration-300 text-xl" style="font-family: 'Fuzzy Bubbles';">
                <span class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Home → Informasi
                    →</span>
                Galeri
            </p>
        </div>
    </div>
    <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto mt-14 flex flex-col justify-center items-center">
        <!-- Filter Categories -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:flex justify-center gap-3 md:gap-5 max-sm:w-full">
            <div class="px-3 md:px-6 h-10 md:h-12 flex justify-center items-center bg-[#E8A26A] rounded-xl category-filter" data-category="all">
                <p class="text-white text-base md:text-lg font-medium whitespace-nowrap" style="font-family: 'Onest';">
                    All</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Daycare">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Daycare</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Area Main">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Area Main</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Bimbel">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Bimbel</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Kelas Stimulasi">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Kelas Stimulasi</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Event">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Event</p>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="mt-14">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($galleries as $gallery)
                <div class="w-full gallery-item" data-category="{{ $gallery->category }}">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">{{ $gallery->category }}</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">{{ $gallery->title }}</p>
                </div>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <img src="{{ asset('images/assets/ikan2.svg') }}" alt="No Galleries" class="w-32 h-32 mb-4 animate-float">
                    <h3 class="text-lg font-semibold text-[#3E5467]">Belum Ada Galeri</h3>
                    <p class="text-gray-500">Silakan kembali lagi nanti</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($galleries->hasPages())
            <div class="flex items-center gap-4 mt-10 pagination-container">
                <p class="font-medium text-xl text-[#E8A26A]">Lihat Lainnya</p>
                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                    @if($page == $galleries->currentPage())
                        <div class="w-10 h-10 bg-[#E8A26A] rounded-full items-center justify-center flex aspect-square">
                            <p class="text-white text-lg font-medium" style="font-family: 'Fredoka';">{{ $page }}</p>
                        </div>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 outline-2 outline-[#E8A26A] outline-offset-[-2px] rounded-full items-center justify-center flex aspect-square hover:bg-[#E8A26A] group transition-all duration-300">
                            <p class="text-[#E8A26A] text-lg font-medium group-hover:text-white transition-all duration-300" style="font-family: 'Fredoka';">{{ $page }}</p>
                        </a>
                    @endif
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <footer class="relative bg-[#EFF5F6] md:bg-none mt-20 md:mt-40">
        <!-- Container untuk SVG Pertama -->
        <div class="absolute -z-10 bottom-0 w-full svg-container hidden md:block"></div>

        <!-- Konten Footer -->
        <div class="w-full px-8 md:px-0 md:w-3/4 mx-auto grid grid-cols-1 md:grid-cols-3 md:gap-8 py-5">
            <!-- Kolom 1: Logo dan Deskripsi -->
            <div class="text-left">
                <img src="images/assets/text_samoedra.png" alt="Logo Samoedra" class="h-13">
                <p class="mt-4 text-[#3E5467] max-w-sm">Rumah Samoedra adalah ruang bermain dan belajar anak dengan
                    layanan
                    daycare, area bermain, bimbel, kelas stimulasi, serta layanan event.</p>
                <!-- Ikon Sosial Media -->
                <div class="flex space-x-3 mt-6 relative z-30">
                    <div
                        class="w-9 h-9 p-2 aspect-square bg-[#3E5467] hover:bg-[#BDBDCB] transition-all rounded-xl flex justify-center items-center">
                        <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.8813 3.87159C16.9583 3.87481 17.9902 4.30405 18.7517 5.06558C19.5133 5.82711 19.9425 6.85904 19.9457 7.936V16.0639C19.9425 17.1409 19.5133 18.1728 18.7517 18.9343C17.9902 19.6959 16.9583 20.1251 15.8813 20.1283H7.75338C6.67642 20.1251 5.64449 19.6959 4.88296 18.9343C4.12144 18.1728 3.69219 17.1409 3.68898 16.0639V7.936C3.69219 6.85904 4.12144 5.82711 4.88296 5.06558C5.64449 4.30405 6.67642 3.87481 7.75338 3.87159H15.8813ZM15.8813 2.24609H7.75338C4.62387 2.24609 2.06348 4.80648 2.06348 7.936V16.0639C2.06348 19.1934 4.62387 21.7538 7.75338 21.7538H15.8813C19.0108 21.7538 21.5712 19.1934 21.5712 16.0639V7.936C21.5712 4.80648 19.0108 2.24609 15.8813 2.24609Z"
                                fill="#EFF5F6" />
                            <path
                                d="M17.1006 7.93603C16.8594 7.93603 16.6237 7.86452 16.4232 7.73055C16.2227 7.59658 16.0664 7.40616 15.9741 7.18337C15.8819 6.96059 15.8577 6.71544 15.9048 6.47893C15.9518 6.24242 16.0679 6.02518 16.2384 5.85466C16.4089 5.68415 16.6262 5.56803 16.8627 5.52099C17.0992 5.47394 17.3444 5.49809 17.5671 5.59037C17.7899 5.68265 17.9803 5.83892 18.1143 6.03942C18.2483 6.23992 18.3198 6.47565 18.3198 6.71679C18.3201 6.877 18.2888 7.0357 18.2277 7.18378C18.1665 7.33186 18.0767 7.4664 17.9635 7.57969C17.8502 7.69297 17.7156 7.78277 17.5676 7.84392C17.4195 7.90507 17.2608 7.93637 17.1006 7.93603ZM11.8174 8.74856C12.4604 8.74856 13.0891 8.93925 13.6238 9.29652C14.1585 9.6538 14.5752 10.1616 14.8213 10.7557C15.0674 11.3498 15.1318 12.0036 15.0063 12.6343C14.8809 13.265 14.5712 13.8444 14.1165 14.2991C13.6618 14.7538 13.0824 15.0635 12.4517 15.189C11.821 15.3144 11.1672 15.25 10.5731 15.0039C9.97897 14.7578 9.47117 14.3411 9.1139 13.8064C8.75662 13.2717 8.56593 12.6431 8.56593 12C8.56685 11.1379 8.90971 10.3115 9.51927 9.7019C10.1288 9.09234 10.9553 8.74948 11.8174 8.74856ZM11.8174 7.12306C10.8528 7.12306 9.90989 7.40909 9.10789 7.94497C8.30588 8.48085 7.68079 9.24253 7.31167 10.1337C6.94254 11.0248 6.84596 12.0054 7.03414 12.9514C7.22232 13.8975 7.6868 14.7665 8.36885 15.4485C9.0509 16.1306 9.91989 16.595 10.8659 16.7832C11.812 16.9714 12.7925 16.8748 13.6837 16.5057C14.5748 16.1366 15.3365 15.5115 15.8724 14.7095C16.4083 13.9075 16.6943 12.9646 16.6943 12C16.6943 10.7065 16.1805 9.46608 15.2659 8.55148C14.3513 7.63688 13.1108 7.12306 11.8174 7.12306Z"
                                fill="#EFF5F6" />
                        </svg>
                    </div>
                    <div
                        class="w-9 h-9 p-2.5 aspect-square bg-[#3E5467] hover:bg-[#BDBDCB] transition-all rounded-xl flex justify-center items-center">
                        <svg width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.4067 0.0949119L7.65395 0.0913086C4.98443 0.0913086 3.25999 2.00459 3.25999 4.96909V7.21656H0.498047V11.2836H3.25999L3.25666 19.9087H7.12105L7.12438 11.2836H10.2935L10.291 7.21746H7.12438V5.31049C7.12438 4.39348 7.32505 3.92958 8.42833 3.92958L10.3984 3.92867L10.4067 0.0949119Z"
                                fill="#EFF5F6" />
                        </svg>
                    </div>
                    <div
                        class="w-9 h-9 p-2 aspect-square bg-[#3E5467] hover:bg-[#BDBDCB] transition-all rounded-xl flex justify-center items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.9986 5.08086C18.0969 4.17865 17.0255 3.46372 15.8464 2.97722C14.6672 2.49072 13.4034 2.24226 12.1278 2.24614C6.7745 2.24614 2.41661 6.58226 2.41444 11.9129C2.41207 13.6103 2.8595 15.278 3.71118 16.7463L2.33301 21.7539L7.48209 20.4097C8.90738 21.1818 10.5029 21.5859 12.1239 21.5854H12.1278C17.4807 21.5854 21.8381 17.2488 21.8407 11.9186C21.844 10.6473 21.5944 9.38814 21.1065 8.21426C20.6185 7.04038 19.902 5.97525 18.9986 5.08086ZM12.1278 19.9538H12.1243C10.6793 19.9542 9.26048 19.5675 8.01551 18.8338L7.72071 18.6596L4.66523 19.4574L5.48081 16.4924L5.28878 16.1876C4.48077 14.9084 4.05267 13.426 4.0543 11.9129C4.0543 7.48318 7.67761 3.87904 12.1309 3.87904C14.2671 3.87523 16.3174 4.72011 17.8308 6.22786C19.3442 7.73561 20.1967 9.78275 20.2009 11.919C20.1991 16.3492 16.5776 19.9538 12.1278 19.9538ZM16.5558 13.9364C16.3133 13.8154 15.1188 13.231 14.8976 13.1504C14.6764 13.0699 14.5132 13.0294 14.3516 13.2715C14.1901 13.5136 13.7246 14.0553 13.583 14.2186C13.4415 14.3819 13.3 14.3997 13.0575 14.2787C12.8149 14.1576 12.0324 13.9029 11.1054 13.0799C10.3839 12.4394 9.89705 11.6486 9.75553 11.4069C9.61401 11.1653 9.74029 11.0342 9.86177 10.914C9.97107 10.8056 10.1043 10.6319 10.2258 10.4908C10.3473 10.3497 10.3878 10.2487 10.4683 10.0876C10.5489 9.92644 10.5088 9.78536 10.4483 9.66474C10.3878 9.54412 9.90227 8.35493 9.70023 7.87116C9.50297 7.40001 9.3031 7.46402 9.15418 7.45662C9.01267 7.44965 8.84938 7.44791 8.6887 7.44791C8.56587 7.45111 8.44501 7.47959 8.33368 7.53159C8.22235 7.58358 8.12293 7.65797 8.04163 7.75011C7.81912 7.99221 7.19209 8.57744 7.19209 9.76533C7.19209 10.9532 8.06297 12.1028 8.18315 12.2639C8.30333 12.425 9.89443 14.8648 12.329 15.9111C12.7811 16.1047 13.243 16.2745 13.7128 16.4197C14.2941 16.6035 14.8232 16.5778 15.2412 16.5155C15.7076 16.4463 16.6782 15.9312 16.8798 15.3668C17.0814 14.8025 17.0818 14.3192 17.0213 14.2186C16.9608 14.118 16.7988 14.057 16.5558 13.9364Z"
                                fill="#EFF5F6" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Kolom 2: Layanan dan Tentang Kami -->
            <div class="grid grid-cols-2 gap-6 mt-8 md:mt-0 z-30">
                <!-- Layanan -->
                <div>
                    <h3 class="font-semibold text-2xl text-[#3E5467]" style="font-family: 'Fredoka';">Layanan</h3>
                    <ul class="space-y-2 mt-4 text-[#3E5467]">
                        <li><a href="#">Daycare</a></li>
                        <li><a href="#">Area Main</a></li>
                        <li><a href="#">Bimbel</a></li>
                        <li><a href="#">Stimulasi</a></li>
                        <li><a href="#">Event</a></li>
                    </ul>
                </div>
                <!-- Tentang Kami -->
                <div>
                    <h3 class="font-semibold text-2xl text-[#3E5467]" style="font-family: 'Fredoka';">Tentang Kami
                    </h3>
                    <ul class="space-y-2 mt-4 text-[#3E5467]">
                        <li><a href="#">Sambutan Lembaga</a></li>
                        <li><a href="#">Sejarah</a></li>
                        <li><a href="#">Struktur Organisasi</a></li>
                    </ul>
                </div>
            </div>

            <!-- Kolom 3: Alamat dan Kontak -->
            <div class="flex flex-col space-y-6 mt-8 md:mt-0 z-30">
                <!-- Alamat -->
                <div>
                    <h3 class="font-semibold text-2xl text-[#3E5467]" style="font-family: 'Fredoka';">Alamat</h3>
                    <p class="mt-4 text-[#3E5467]">Jl. Mutiara No.C80, Padasuka, Kec. Ciomas, Kabupaten Bogor, Jawa
                        Barat 16610
                    </p>
                </div>
                <!-- Contact -->
                <div>
                    <h3 class="font-semibold text-2xl text-[#3E5467]" style="font-family: 'Fredoka';">Contact</h3>
                    <p class="mt-4 text-[#3E5467]">+62 896 111 111 53</p>
                    <p class="text-[#3E5467]">maindisamoedra@gmail.com</p>
                </div>
            </div>
        </div>

        <!-- Container untuk SVG Kedua -->
        <div class="absolute bottom-0 w-full svg-container2 hidden md:block z-20"></div>

        <!-- Elemen Ikan dan Hiu dengan Animasi -->
        <img src="images/assets/ikan2.svg" alt="Ikan"
            class="absolute bottom-20 left-8 w-20 h-20 md:bottom-50 md:left-30 md:w-40 md:h-40 xl:w-60 xl:h-60 z-20 animate-float">
        <img src="images/assets/ikan2.svg" alt="Ikan"
            class="absolute bottom-20 right-8 w-20 h-20 md:bottom-50 md:right-30 md:w-40 md:h-40 xl:w-56 xl:h-56 z-20 animate-float">
        <img src="images/assets/hiu.svg" alt="Hiu"
            class="absolute bottom-24 right-16 w-20 h-20 md:bottom-70 md:right-75 md:w-40 md:h-40 xl:bottom-55 xl:w-60 xl:h-60 z-20 animate-swim">

        <!-- Elemen Tanaman -->
        <img src="images/assets/tanaman.svg" alt="Tanaman" class="absolute bottom-0 z-10">

        <!-- Teks Copyright -->
        <div class="text-center bg-[#3E5467] md:bg-none text-white py-3.5 relative z-30">
            <p>Copyright © 2025 Rumah Samoedra. All Rights Reserved.</p>
        </div>
    </footer>
    <a href="#form-daftar"
    class="fixed bottom-14 right-7 z-50 bg-green-100  hover:bg-green-200 text-white font-semibold py-5 px-5 rounded-full shadow-lg transition-colors duration-300">
    <img class="w-8" src="images/assets/wa.svg" alt="">
  </a>

    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filters = document.querySelectorAll('.category-filter');
            const items = document.querySelectorAll('.gallery-item');
            const paginationContainer = document.querySelector('.pagination-container');
            const categoryCounts = @json($categoryCounts);

            // Hitung total items untuk kategori "all"
            const totalItems = Object.values(categoryCounts).reduce((a, b) => a + b, 0);

            filters.forEach(filter => {
                filter.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');

                    // Remove active class from all filters
                    filters.forEach(f => {
                        f.classList.remove('bg-[#E8A26A]');
                        f.querySelector('p').classList.remove('text-white');
                        f.querySelector('p').classList.add('text-[#E8A26A]');
                    });

                    // Add active class to clicked filter
                    this.classList.add('bg-[#E8A26A]');
                    this.querySelector('p').classList.remove('text-[#E8A26A]');
                    this.querySelector('p').classList.add('text-white');

                    // Filter items
                    items.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') === category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Show/hide pagination based on category count
                    if (paginationContainer) {
                        if (category === 'all') {
                            paginationContainer.style.display = totalItems > 9 ? 'flex' : 'none';
                        } else {
                            const categoryCount = categoryCounts[category] || 0;
                            paginationContainer.style.display = categoryCount > 9 ? 'flex' : 'none';
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
