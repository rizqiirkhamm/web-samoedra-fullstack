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
    <!-- Navbar Section -->
    <div class="relative w-full overflow-x-hidden">
        <!-- SVG Background -->
        <svg width="3488" height="71" viewBox="0 0 3488 71" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M69.5 70.5C34.5 70.5 -21 44.5 -21 44.5V0H3508V70.5H3466.5C3443 70.5 3415 53 3384.5 53C3354 53 3343.5 70.5 3299 70.5C3254.5 70.5 3237.5 53 3192.5 53C3147.5 53 3142.5 70.5 3096.5 70.5C3050.5 70.5 3029 53 2979.5 53C2930 53 2916.5 70.5 2880.5 70.5C2844.5 70.5 2825 53 2784 53C2743 53 2742.5 70.5 2701 70.5C2659.5 70.5 2645.5 53 2603.5 53C2561.5 53 2558 70.5 2513.5 70.5C2469 70.5 2451.5 53 2408 53C2364.5 53 2377 70.5 2337 70.5C2297 70.5 2284.5 53 2243.5 53C2202.5 53 2204.5 70.5 2161 70.5C2117.5 70.5 2113.5 53 2067.5 53C2021.5 53 2026.5 70.5 1975.5 70.5C1924.5 70.5 1926 53 1874 53C1822 53 1819.5 70.5 1769 70.5C1718.5 70.5 1717 53 1669 53C1621 53 1602.5 70.5 1567.5 70.5C1532.5 70.5 1494.5 53 1453 53C1411.5 53 1385.5 70.5 1352 70.5C1318.5 70.5 1288.5 53 1250 53C1211.5 53 1192.5 70.5 1153 70.5C1113.5 70.5 1096 53 1056 53C1016 53 999 70.5 969 70.5C939 70.5 928 53 888.5 53C849 53 850.5 70.5 811 70.5C771.5 70.5 757 53 713.5 53C670 53 674.5 70.5 631 70.5C587.5 70.5 577.5 53 535 53C492.5 53 484.5 70.5 446 70.5C407.5 70.5 388 53 343.5 53C299 53 294 70.5 249.5 70.5C205 70.5 200.5 53 153 53C105.5 53 104.5 70.5 69.5 70.5Z"
                fill="#CFE1E4" class="hidden lg:flex"/>
        </svg>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="fixed top-0 left-0 h-screen md:hidden w-full bg-white transform -translate-x-full transition-transform duration-300 ease-in-out z-40 flex items-center justify-center">
            <!-- Tombol Close yang terpisah -->
            <button id="menu-button" class="absolute top-8 right-8 focus:outline-none z-50">
                <svg id="hamburger-icon" class="w-6 h-6 text-[#3E5467]" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden text-[#3E5467]" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <ul class="space-y-7 text-center w-full">
                <li><a href="index.html"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Home</a>
                </li>
                <li><a href="tentang.html"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Tentang</a>
                </li>
                <li><a href="layanan.html"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Layanan</a>
                </li>
                <li class="relative">
                    <button id="mobile-dropdown-trigger"
                        class="text-[#3E5467] text-xl font-semibold flex items-center justify-center hover:text-[#BDBDCB] transition-all duration-300 w-full gap-2">
                        Informasi
                        <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="mobile-dropdown-content" class="hidden w-full py-3 space-y-2">
                        <a href="artikel.html"
                            class="block text-[#3E5467] hover:text-[#BDBDCB] transition-all duration-300 text-lg ml-10">Artikel</a>
                        <a href="galeri.html"
                            class="block text-[#3E5467] hover:text-[#BDBDCB] transition-all duration-300 text-lg ml-10">Galeri</a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Bagian ikon dan teks -->
        <div
            class="absolute top-0 left-1/2 transform -translate-x-1/2 md:w-3/4 w-full flex flex-row justify-start items-start md:items-center p-4 space-y-2 md:space-y-0 space-x-7">
            <div class="hidden items-center space-x-2 lg:flex">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12.5" cy="12.5" r="12.5" fill="#3E5467" />
                    <path
                        d="M18.7391 9.9884V15.3125C18.7392 15.7429 18.5675 16.1571 18.2594 16.4703C17.9513 16.7834 17.5299 16.9719 17.0816 16.9972L16.9783 17H8.76087C8.31172 17 7.87955 16.8356 7.55276 16.5403C7.22597 16.245 7.02928 15.8412 7.00293 15.4115L7 15.3125V9.9884L12.5438 13.5305L12.6119 13.5676C12.6921 13.6052 12.7803 13.6247 12.8696 13.6247C12.9589 13.6247 13.047 13.6052 13.1272 13.5676L13.1953 13.5305L18.7391 9.9884Z"
                        fill="#CFE1E4" />
                    <path
                        d="M16.9788 8C17.6127 8 18.1685 8.32063 18.4785 8.80269L12.8701 12.3858L7.26172 8.80269C7.40892 8.57365 7.61113 8.38166 7.85148 8.24271C8.09182 8.10377 8.36335 8.0219 8.64341 8.00394L8.76139 8H16.9788Z"
                        fill="#CFE1E4" />
                </svg>
                <p class="text-[#3E5467] font-medium text-sm">maindisamoedra@gmail.com</p>
            </div>
            <div class="hidden items-center space-x-2 xl:flex">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12.5" cy="12.5" r="12.5" fill="#3E5467" />
                    <path
                        d="M12.5 12.175C12.0738 12.175 11.665 12.0038 11.3636 11.699C11.0622 11.3943 10.8929 10.981 10.8929 10.55C10.8929 10.119 11.0622 9.7057 11.3636 9.40095C11.665 9.0962 12.0738 8.925 12.5 8.925C12.9262 8.925 13.335 9.0962 13.6364 9.40095C13.9378 9.7057 14.1071 10.119 14.1071 10.55C14.1071 10.7634 14.0656 10.9747 13.9848 11.1719C13.904 11.369 13.7857 11.5482 13.6364 11.699C13.4872 11.8499 13.31 11.9696 13.115 12.0513C12.92 12.133 12.7111 12.175 12.5 12.175ZM12.5 6C11.3065 6 10.1619 6.47937 9.31802 7.33266C8.47411 8.18595 8 9.34326 8 10.55C8 13.9625 12.5 19 12.5 19C12.5 19 17 13.9625 17 10.55C17 9.34326 16.5259 8.18595 15.682 7.33266C14.8381 6.47937 13.6935 6 12.5 6Z"
                        fill="#CFE1E4" />
                </svg>
                <p class="text-[#3E5467] font-medium text-sm">Jalan Mutiara No. C80, Perumahan Pondok Kencana Permai,
                    Ciomas,
                    Bogor 16610</p>
            </div>
            <div class="hidden items-center space-x-2 lg:flex ">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12.5" cy="12.5" r="12.5" fill="#3E5467" />
                    <path
                        d="M13.7269 6.11839L13.3368 6.06387C12.1643 5.89529 10.9679 6.06207 9.88707 6.54476C8.80619 7.02745 7.88536 7.80617 7.23192 8.79013C6.53668 9.73068 6.12222 10.8476 6.03626 12.0124C5.95029 13.1771 6.19631 14.3424 6.746 15.3741C6.80225 15.4775 6.83728 15.591 6.84903 15.708C6.86078 15.825 6.84902 15.9432 6.81444 16.0556C6.53383 17.0166 6.27376 17.9845 6 19L6.3422 18.8978C7.26614 18.6524 8.19008 18.407 9.11402 18.1821C9.30903 18.1417 9.51173 18.1607 9.69576 18.2366C10.5247 18.6395 11.4306 18.8612 12.3526 18.8867C13.2747 18.9123 14.1915 18.7411 15.0417 18.3847C15.8918 18.0283 16.6556 17.495 17.2817 16.8204C17.9078 16.1459 18.3818 15.3458 18.6719 14.4738C18.962 13.6018 19.0614 12.6782 18.9635 11.7648C18.8656 10.8514 18.5726 9.96941 18.1042 9.17805C17.6359 8.3867 17.003 7.70426 16.248 7.17654C15.493 6.64883 14.6334 6.28804 13.7269 6.11839ZM15.4516 15.0605C15.2028 15.2823 14.8995 15.4345 14.5725 15.5015C14.2455 15.5686 13.9065 15.5481 13.59 15.4422C12.1561 15.0395 10.9121 14.1436 10.079 12.9136C9.76089 12.4785 9.50521 12.0014 9.31934 11.496C9.21863 11.2027 9.20047 10.8876 9.26683 10.5849C9.33318 10.2821 9.48152 10.0032 9.69576 9.77841C9.80005 9.64585 9.94201 9.54765 10.1031 9.49659C10.2643 9.44553 10.4371 9.44398 10.5992 9.49215C10.736 9.52623 10.8319 9.72388 10.9551 9.87383C11.0554 10.1555 11.1718 10.4304 11.3041 10.6985C11.4043 10.8352 11.4462 11.0058 11.4205 11.1731C11.3949 11.3403 11.3038 11.4907 11.1672 11.5914C10.8592 11.864 10.9071 12.0889 11.1262 12.3956C11.6101 13.0905 12.2782 13.6379 13.0562 13.9769C13.2752 14.0723 13.4394 14.0927 13.5831 13.8678C13.6447 13.7792 13.7269 13.7042 13.7953 13.6224C14.1923 13.1249 14.0691 13.1317 14.6987 13.4043C14.8995 13.4884 15.0934 13.5861 15.2805 13.6974C15.4652 13.8065 15.7458 13.9223 15.7869 14.0859C15.8264 14.2634 15.816 14.4482 15.7569 14.6202C15.6977 14.7921 15.592 14.9445 15.4516 15.0605Z"
                        fill="#CFE1E4" />
                </svg>
                <p class="text-[#3E5467] font-medium text-sm">+62 896 111 111 53</p>
            </div>
        </div>
    </div>

    <!-- Nav Content -->
    <nav
        class="relative w-full lg:px-0 px-8 lg:w-3/4 mx-auto flex justify-between items-center py-3 translate-y-[-50px] lg:translate-y-0">
        <div>
            <a href="index.html">
                <img src="{{ asset('images/assets/samoedra_logo.png') }}" alt="Logo" class="h-11 md:h-13">
            </a>
        </div>
        <!-- Hanya tampilkan hamburger di sini -->
        <div class="md:hidden items-center flex">
            <button id="mobile-menu-trigger" class="focus:outline-none z-50">
                <svg class="w-6 h-6 text-[#3E5467]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
        <div class="hidden md:flex md:space-x-7">
            <ul class="flex space-x-7">
                <li><a href="index.html"
                        class="text-[#BDBDCB] hover:text-[#3E5467] transition-all duration-300 font-medium">Home</a>
                </li>
                <li><a href="tentang.html"
                        class="text-[#BDBDCB] hover:text-[#3E5467] transition-all duration-300 font-medium">Tentang</a>
                </li>
                <li><a href="layanan.html"
                        class="text-[#BDBDCB] hover:text-[#3E5467] transition-all duration-300 font-medium">layanan</a>
                </li>
                <li class="relative group">
                    <a href="#"
                        class="text-[#3E5467] gap-2 group-hover:text-[#BDBDCB] transition-all duration-300 font-medium flex items-center">
                        Informasi
                        <svg width="8" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.999999 1L7 7L13 1" stroke="#A2A2BD"
                                class="group-hover:stroke-[#3E5467] transition-all duration-300" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <div
                        class="invisible opacity-0 group-hover:visible group-hover:opacity-100 absolute left-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl transition-all duration-300 ease-in-out z-50">
                        <a href="artikel.html">
                            <div class="p-2">
                                <p
                                    class="block px-3 py-1 text-[#3E5467] hover:bg-[#CFE1E4] transition-all duration-300 rounded-xl">
                                    Artikel</p>
                            </div>
                        </a>
                        <a href="galeri.html">
                            <div class="p-2 -mt-3">
                                <p
                                    class="block px-3 py-1 text-[#3E5467] hover:bg-[#CFE1E4] transition-all duration-300 rounded-xl">
                                    Galeri</p>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="hidden xl:block">
            <a href="#">
                <button
                    class="bg-[#3E5467] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar
                    <svg width="21" height="10" viewBox="0 0 21 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </a>
        </div>
    </nav>
    <!-- Artikel -->
    <div class="w-full px-8 md:w-7/12 md:px-0 mx-auto" style="font-family: 'Onest';">
        <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl mt-16" style="font-family: 'Fredoka';">{{ $article->title }}</h1>
        <div class="flex items-center gap-4 my-3">
            <p class="text-[#7BA5B0] text-lg">{{ $article->category ? $article->category->name : '-' }}</p>
            <div class="flex items-center gap-2">
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.2454 18.9C13.4768 18.9 15.6168 18.015 17.1946 16.4397C18.7725 14.8644 19.6589 12.7278 19.6589 10.5C19.6589 8.27218 18.7725 6.13561 17.1946 4.5603C15.6168 2.985 13.4768 2.1 11.2454 2.1C9.01399 2.1 6.87398 2.985 5.29614 4.5603C3.71831 6.13561 2.83189 8.27218 2.83189 10.5C2.83189 12.7278 3.71831 14.8644 5.29614 16.4397C6.87398 18.015 9.01399 18.9 11.2454 18.9ZM11.2454 0C12.6265 0 13.994 0.271591 15.27 0.799265C16.546 1.32694 17.7054 2.10036 18.6819 3.07538C19.6585 4.05039 20.4332 5.2079 20.9617 6.48182C21.4902 7.75574 21.7623 9.12112 21.7623 10.5C21.7623 13.2848 20.6542 15.9555 18.6819 17.9246C16.7096 19.8938 14.0346 21 11.2454 21C5.42956 21 0.728516 16.275 0.728516 10.5C0.728516 7.71523 1.83654 5.04451 3.80883 3.07538C5.78113 1.10625 8.45614 0 11.2454 0ZM11.7712 5.25V10.7625L16.5038 13.566L15.7151 14.8575L10.1937 11.55V5.25H11.7712Z" fill="#E8A26A"/>
                </svg>
                <p class="text-[#E8A26A] font-medium text-lg">{{ $article->created_at->format('d F Y') }}</p>
            </div>
        </div>
        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-130 rounded-2xl object-cover my-10">
        <div class="prose max-w-none mb-10">
            {!! $article->content !!}
        </div>

        <!-- Tags -->
        <div class="w-full">
            <div class="flex flex-wrap items-start gap-3 md:gap-5 mb-20">
                <p class="text-[#3E5467] text-xl font-semibold" style="font-family: 'Fredoka';">Tags :</p>
                <div class="flex flex-wrap gap-3">
                    @foreach(is_array($article->tags) ? $article->tags : [] as $tag)
                    <div class="px-3 md:px-5 py-1 outline outline-[#3E5467] rounded-full">
                        <p class="text-[#3E5467] font-medium" style="font-family: 'Fredoka';">{{ $tag }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="flex justify-center mb-20">
            <a href="{{ route('artikel') }}" class="group flex items-center gap-2 bg-[#3E5467] hover:bg-[#BDBDCB] transition-all duration-300 text-white px-6 py-3 rounded-full">
                <svg width="21" height="10" viewBox="0 0 21 10" fill="none" xmlns="http://www.w3.org/2000/svg" class="rotate-180">
                    <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="font-medium">Kembali ke Artikel</span>
            </a>
        </div>
    </div>
    <footer class="relative bg-[#EFF5F6] md:bg-none mt-20 md:mt-40">
        <!-- Container untuk SVG Pertama -->
        <div class="absolute -z-10 bottom-0 w-full svg-container hidden md:block"></div>

        <!-- Konten Footer -->
        <div class="w-full px-8 md:px-0 md:w-3/4 mx-auto grid grid-cols-1 md:grid-cols-3 md:gap-8 py-5">
            <!-- Kolom 1: Logo dan Deskripsi -->
            <div class="text-left">
                <img src="{{ asset('images/assets/text_samoedra.png') }}" alt="Logo Samoedra" class="h-13">
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
        <img src="{{ asset('images/assets/ikan2.svg') }}" alt="Ikan"
            class="absolute bottom-20 left-8 w-20 h-20 md:bottom-50 md:left-30 md:w-40 md:h-40 xl:w-60 xl:h-60 z-20 animate-float">
        <img src="{{ asset('images/assets/ikan2.svg') }}" alt="Ikan"
            class="absolute bottom-20 right-8 w-20 h-20 md:bottom-50 md:right-30 md:w-40 md:h-40 xl:w-56 xl:h-56 z-20 animate-float">
        <img src="{{ asset('images/assets/hiu.svg') }}" alt="Hiu"
            class="absolute bottom-24 right-16 w-20 h-20 md:bottom-70 md:right-75 md:w-40 md:h-40 xl:bottom-55 xl:w-60 xl:h-60 z-20 animate-swim">

        <!-- Elemen Tanaman -->
        <img src="{{ asset('images/assets/tanaman.svg') }}" alt="Tanaman" class="absolute bottom-0 z-10">

        <!-- Teks Copyright -->
        <div class="text-center bg-[#3E5467] md:bg-none text-white py-3.5 relative z-30">
            <p>Copyright © 2025 Rumah Samoedra. All Rights Reserved.</p>
        </div>
    </footer>
    <a href="#form-daftar"
    class="fixed bottom-14 right-7 z-50 bg-green-100  hover:bg-green-200 text-white font-semibold py-5 px-5 rounded-full shadow-lg transition-colors duration-300">
    <img class="w-8" src="{{ asset('images/assets/wa.svg') }}" alt="">
  </a>

    <script src="script.js"></script>
</body>

</html>
