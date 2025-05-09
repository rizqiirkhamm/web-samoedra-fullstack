<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Daycare</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="icon" href="{{ asset('images/assets/logo-doang.png') }}" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Fredoka:wght@300..700&family=Fuzzy+Bubbles:wght@400;700&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">
        <link href="{{ asset('css/public.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Section -->
    <div class="relative w-full overflow-x-hidden">
        <!-- SVG Background -->
        <svg width="3488" height="71" viewBox="0 0 3488 71" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M69.5 70.5C34.5 70.5 -21 44.5 -21 44.5V0H3508V70.5H3466.5C3443 70.5 3415 53 3384.5 53C3354 53 3343.5 70.5 3299 70.5C3254.5 70.5 3237.5 53 3192.5 53C3147.5 53 3142.5 70.5 3096.5 70.5C3050.5 70.5 3029 53 2979.5 53C2930 53 2916.5 70.5 2880.5 70.5C2844.5 70.5 2825 53 2784 53C2743 53 2742.5 70.5 2701 70.5C2659.5 70.5 2645.5 53 2603.5 53C2561.5 53 2558 70.5 2513.5 70.5C2469 70.5 2451.5 53 2408 53C2364.5 53 2377 70.5 2337 70.5C2297 70.5 2284.5 53 2243.5 53C2202.5 53 2204.5 70.5 2161 70.5C2117.5 70.5 2113.5 53 2067.5 53C2021.5 53 2026.5 70.5 1975.5 70.5C1924.5 70.5 1926 53 1874 53C1822 53 1819.5 70.5 1769 70.5C1718.5 70.5 1717 53 1669 53C1621 53 1602.5 70.5 1567.5 70.5C1532.5 70.5 1494.5 53 1453 53C1411.5 53 1385.5 70.5 1352 70.5C1318.5 70.5 1288.5 53 1250 53C1211.5 53 1192.5 70.5 1153 70.5C1113.5 70.5 1096 53 1056 53C1016 53 999 70.5 969 70.5C939 70.5 928 53 888.5 53C849 53 850.5 70.5 811 70.5C771.5 70.5 757 53 713.5 53C670 53 674.5 70.5 631 70.5C587.5 70.5 577.5 53 535 53C492.5 53 484.5 70.5 446 70.5C407.5 70.5 388 53 343.5 53C299 53 294 70.5 249.5 70.5C205 70.5 200.5 53 153 53C105.5 53 104.5 70.5 69.5 70.5Z"
                fill="#CFE1E4" class="hidden lg:flex" />
        </svg>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="fixed top-0 left-0 h-screen w-full bg-white transform -translate-x-full transition-transform duration-300 ease-in-out z-40 flex items-center justify-center">
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
                <li><a href="#home"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Home</a>
                </li>
                <li><a href="#informasi"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Informasi</a>
                </li>
                <li><a href="#fasilitas"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Fasilitas</a>
                </li>
                <li><a href="#pricelist"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Pricelist</a>
                </li>
                <li><a href="#galery"
                        class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Galery</a>
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
                <img src="images/assets/samoedra_logo.png" alt="Logo" class="h-11 md:h-13">
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
                <li><a href="#home"
                        class="text-[#3E5467] hover:text-[#BDBDCB] transition-all duration-300 font-medium">Home</a>
                </li>
                <li><a href="#informasi"
                        class="text-[#BDBDCB] hover:text-[#3E5467] transition-all duration-300 font-medium">Informasi</a>
                </li>
                <li><a href="#fasilitas"
                        class="text-[#BDBDCB] hover:text-[#3E5467] transition-all duration-300 font-medium">Fasilitas</a>
                </li>
                <li><a href="#pricelist"
                        class="text-[#BDBDCB] hover:text-[#3E5467] transition-all duration-300 font-medium">Pricelist</a>
                </li>
                <li><a href="#galery"
                        class="text-[#BDBDCB] hover:text-[#3E5467] transition-all duration-300 font-medium">Galery</a>
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


    <section id="home">
        <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto md:py-24 relative z-10">
            <div class="flex justify-center flex-col items-center">
                <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-center"
                    style="font-family: 'Fredoka';">Halo👋🏻,
                    Selamat Datang <br> Di Layanan Daycare
                </h1>
                <div class="flex gap-5 mt-10">
                    <a href="#">
                        <button
                            class="bg-[#3E5467] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar<svg
                                width="21" height="10" viewBox="0 0 21 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </a>
                    <a href="#" class="flex space-x-2 items-center">
                        <svg width="28" height="28" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_68_61" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="32" height="33">
                                <path d="M0 0.5H32V32.5H0V0.5Z" fill="white" />
                            </mask>
                            <g mask="url(#mask0_68_61)">
                                <path
                                    d="M19.0147 0.735802L18.0547 0.601065C15.1696 0.184488 12.2254 0.59661 9.56553 1.78939C6.90564 2.98216 4.6396 4.90645 3.03158 7.33791C1.32068 9.66208 0.300775 12.4221 0.0892282 15.3003C-0.122319 18.1786 0.483092 21.058 1.83579 23.6074C1.97423 23.8629 2.06042 24.1434 2.08933 24.4326C2.11825 24.7217 2.08931 25.0137 2.00421 25.2916C1.31368 27.6663 0.673684 30.0579 0 32.5674L0.842105 32.3147C3.11579 31.7084 5.38947 31.1021 7.66316 30.5463C8.14306 30.4466 8.64188 30.4935 9.09474 30.6811C11.1346 31.6766 13.3639 32.2244 15.6329 32.2875C17.9019 32.3506 20.1582 31.9276 22.2503 31.0469C24.3424 30.1663 26.2219 28.8483 27.7627 27.1815C29.3035 25.5146 30.4699 23.5375 31.1837 21.3828C31.8975 19.228 32.1422 16.9456 31.9013 14.6885C31.6603 12.4314 30.9394 10.252 29.7868 8.29648C28.6343 6.34097 27.0768 4.65461 25.2189 3.35058C23.3609 2.04655 21.2456 1.15501 19.0147 0.735802ZM23.2589 22.8326C22.6468 23.3807 21.9004 23.7567 21.0957 23.9224C20.291 24.088 19.4567 24.0375 18.6779 23.7758C15.1494 22.7807 12.088 20.5667 10.0379 17.5274C9.25503 16.4522 8.62582 15.2731 8.16842 14.0242C7.92059 13.2996 7.8759 12.521 8.0392 11.7728C8.20249 11.0246 8.56754 10.3355 9.09474 9.78001C9.35139 9.45246 9.70074 9.20979 10.0973 9.08362C10.4938 8.95745 10.9192 8.95362 11.3179 9.07264C11.6547 9.15685 11.8905 9.64527 12.1937 10.0158C12.4407 10.7119 12.727 11.3912 13.0526 12.0537C13.2992 12.3914 13.4022 12.8129 13.3391 13.2263C13.276 13.6397 13.0519 14.0113 12.7158 14.26C11.9579 14.9337 12.0758 15.4895 12.6147 16.2474C13.8056 17.9645 15.4498 19.3172 17.3642 20.1547C17.9032 20.3905 18.3074 20.4411 18.6611 19.8853C18.8126 19.6663 19.0147 19.4811 19.1832 19.279C20.16 18.0495 19.8568 18.0663 21.4063 18.74C21.9004 18.9477 22.3775 19.1891 22.8379 19.4642C23.2926 19.7337 23.9832 20.02 24.0842 20.4242C24.1814 20.8627 24.1558 21.3196 24.0103 21.7445C23.8647 22.1694 23.6047 22.5459 23.2589 22.8326Z"
                                    fill="#A2A2BD" />
                            </g>
                        </svg>
                        <h1 class="text-[#A2A2BD]">+62 896 111 111 53</h1>
                    </a>
                </div>
                <div class="flex md:flex-row justify-center items-center w-full gap-10">
                    <!-- Video/Gambar Thumbnail -->
                    <div class="flex flex-col xl:flex-row gap-10 mt-10 md:mt-20">
                        <div class="w-full xl:w-9/12">
                            <img src="images/assets/img.png" alt="Samoedra Daycare"
                                class="rounded-3xl h-96 w-full object-cover">
                            <!-- Kelebihan Daycare -->
                            <h1 class="font-semibold text-[#3E5467] text-3xl xl:text-4xl mt-8"
                                style="font-family: 'Fredoka';">Kelebihan Daycare Kami</h1>
                            <p class="text-[#A2A2BD] mt-4" style="font-family: 'Onest';">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus itaque rem quae
                                alias
                                facere ipsum in maiores cupiditate modi, magnam qui natus beatae nam aut voluptate,
                                neque
                                quibusdam reiciendis aliquid atque. Necessitatibus praesentium maiores, modi ratione
                                nostrum
                                vel odit recusandae!
                            </p>
                        </div>
                        <div class="w-full xl:w-1/3">
                            <!-- Kartu Informasi -->
                            <div class="bg-[#F3EEE6] p-8 rounded-3xl">
                                <h2 class="font-semibold text-[#3E5467] text-2xl md:text-3xl mb-5"
                                    style="font-family: 'Fredoka';">About Daycare</h2>
                                <div class="space-y-3">
                                    <div
                                        class="flex justify-between border-b-2 border-dashed pb-3 border-[#E8A26A] items-center">
                                        <flex class="flex-row flex items-center space-x-3">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1012 0.664006C12.7292 0.248006 13.7932 -0.0489938 14.5962 0.754006L19.2432 5.40201C20.0492 6.20601 19.7512 7.27001 19.3342 7.89701C19.1084 8.23699 18.8145 8.52642 18.4712 8.74701C18.1372 8.96001 17.7152 9.12101 17.2602 9.09701C17.04 9.08141 16.8206 9.05773 16.6022 9.02601L16.5342 9.01601C16.2996 8.98237 16.0637 8.95802 15.8272 8.94301C15.3232 8.91801 15.1292 9.00301 15.0672 9.06301L12.5772 11.554C12.4972 11.634 12.3972 11.812 12.3212 12.154C12.2482 12.484 12.2162 12.89 12.2082 13.34C12.2012 13.772 12.2162 14.214 12.2322 14.64L12.2332 14.687C12.2482 15.11 12.2632 15.542 12.2422 15.881C12.1772 16.912 11.3742 17.671 10.5842 18.022C9.79418 18.372 8.66718 18.459 7.88418 17.675L5.63418 15.425L1.52918 19.53C1.46051 19.6037 1.37771 19.6628 1.28572 19.7038C1.19372 19.7448 1.0944 19.7668 0.9937 19.7686C0.892997 19.7704 0.792968 19.7518 0.69958 19.7141C0.606191 19.6764 0.521357 19.6203 0.450139 19.549C0.37892 19.4778 0.322775 19.393 0.285054 19.2996C0.247333 19.2062 0.228809 19.1062 0.230585 19.0055C0.232362 18.9048 0.254404 18.8055 0.295396 18.7135C0.336388 18.6215 0.39549 18.5387 0.469177 18.47L4.57318 14.365L2.32318 12.115C1.54018 11.331 1.62618 10.205 1.97718 9.41501C2.32718 8.62501 3.08718 7.82201 4.11718 7.75701C4.45718 7.73601 4.88918 7.75101 5.31218 7.76601L5.35918 7.76701C5.78518 7.78201 6.22718 7.79801 6.65918 7.79101C7.10918 7.78301 7.51518 7.75101 7.84518 7.67801C8.18718 7.60201 8.36518 7.50101 8.44518 7.42101L10.9352 4.93101C10.9962 4.87001 11.0812 4.67501 11.0552 4.17101C11.0402 3.93447 11.0158 3.69862 10.9822 3.46401L10.9732 3.39601C10.9415 3.17762 10.9178 2.95814 10.9022 2.73801C10.8772 2.28301 11.0382 1.86101 11.2502 1.52701C11.4662 1.18701 11.7652 0.887006 12.1012 0.664006Z"
                                                    fill="#E8A26A" />
                                            </svg>
                                            <h1 class="font-semibold text-[#3E5467] text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Usia</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">6 bln
                                            - 12 y.o</p>
                                    </div>
                                    <div
                                        class="flex justify-between border-b-2 border-dashed pb-3 border-[#E8A26A] items-center">
                                        <flex class="flex-row flex items-center space-x-3">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1012 0.664006C12.7292 0.248006 13.7932 -0.0489938 14.5962 0.754006L19.2432 5.40201C20.0492 6.20601 19.7512 7.27001 19.3342 7.89701C19.1084 8.23699 18.8145 8.52642 18.4712 8.74701C18.1372 8.96001 17.7152 9.12101 17.2602 9.09701C17.04 9.08141 16.8206 9.05773 16.6022 9.02601L16.5342 9.01601C16.2996 8.98237 16.0637 8.95802 15.8272 8.94301C15.3232 8.91801 15.1292 9.00301 15.0672 9.06301L12.5772 11.554C12.4972 11.634 12.3972 11.812 12.3212 12.154C12.2482 12.484 12.2162 12.89 12.2082 13.34C12.2012 13.772 12.2162 14.214 12.2322 14.64L12.2332 14.687C12.2482 15.11 12.2632 15.542 12.2422 15.881C12.1772 16.912 11.3742 17.671 10.5842 18.022C9.79418 18.372 8.66718 18.459 7.88418 17.675L5.63418 15.425L1.52918 19.53C1.46051 19.6037 1.37771 19.6628 1.28572 19.7038C1.19372 19.7448 1.0944 19.7668 0.9937 19.7686C0.892997 19.7704 0.792968 19.7518 0.69958 19.7141C0.606191 19.6764 0.521357 19.6203 0.450139 19.549C0.37892 19.4778 0.322775 19.393 0.285054 19.2996C0.247333 19.2062 0.228809 19.1062 0.230585 19.0055C0.232362 18.9048 0.254404 18.8055 0.295396 18.7135C0.336388 18.6215 0.39549 18.5387 0.469177 18.47L4.57318 14.365L2.32318 12.115C1.54018 11.331 1.62618 10.205 1.97718 9.41501C2.32718 8.62501 3.08718 7.82201 4.11718 7.75701C4.45718 7.73601 4.88918 7.75101 5.31218 7.76601L5.35918 7.76701C5.78518 7.78201 6.22718 7.79801 6.65918 7.79101C7.10918 7.78301 7.51518 7.75101 7.84518 7.67801C8.18718 7.60201 8.36518 7.50101 8.44518 7.42101L10.9352 4.93101C10.9962 4.87001 11.0812 4.67501 11.0552 4.17101C11.0402 3.93447 11.0158 3.69862 10.9822 3.46401L10.9732 3.39601C10.9415 3.17762 10.9178 2.95814 10.9022 2.73801C10.8772 2.28301 11.0382 1.86101 11.2502 1.52701C11.4662 1.18701 11.7652 0.887006 12.1012 0.664006Z"
                                                    fill="#E8A26A" />
                                            </svg>
                                            <h1 class="font-semibold text-[#3E5467] text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Jam</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">7:00 -
                                            17:00 (Lebih dari batas : 15k/jam)</p>
                                    </div>
                                    <div
                                        class="flex justify-between border-b-2 border-dashed pb-3 border-[#E8A26A] items-center">
                                        <flex class="flex-row flex items-center space-x-3">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1012 0.664006C12.7292 0.248006 13.7932 -0.0489938 14.5962 0.754006L19.2432 5.40201C20.0492 6.20601 19.7512 7.27001 19.3342 7.89701C19.1084 8.23699 18.8145 8.52642 18.4712 8.74701C18.1372 8.96001 17.7152 9.12101 17.2602 9.09701C17.04 9.08141 16.8206 9.05773 16.6022 9.02601L16.5342 9.01601C16.2996 8.98237 16.0637 8.95802 15.8272 8.94301C15.3232 8.91801 15.1292 9.00301 15.0672 9.06301L12.5772 11.554C12.4972 11.634 12.3972 11.812 12.3212 12.154C12.2482 12.484 12.2162 12.89 12.2082 13.34C12.2012 13.772 12.2162 14.214 12.2322 14.64L12.2332 14.687C12.2482 15.11 12.2632 15.542 12.2422 15.881C12.1772 16.912 11.3742 17.671 10.5842 18.022C9.79418 18.372 8.66718 18.459 7.88418 17.675L5.63418 15.425L1.52918 19.53C1.46051 19.6037 1.37771 19.6628 1.28572 19.7038C1.19372 19.7448 1.0944 19.7668 0.9937 19.7686C0.892997 19.7704 0.792968 19.7518 0.69958 19.7141C0.606191 19.6764 0.521357 19.6203 0.450139 19.549C0.37892 19.4778 0.322775 19.393 0.285054 19.2996C0.247333 19.2062 0.228809 19.1062 0.230585 19.0055C0.232362 18.9048 0.254404 18.8055 0.295396 18.7135C0.336388 18.6215 0.39549 18.5387 0.469177 18.47L4.57318 14.365L2.32318 12.115C1.54018 11.331 1.62618 10.205 1.97718 9.41501C2.32718 8.62501 3.08718 7.82201 4.11718 7.75701C4.45718 7.73601 4.88918 7.75101 5.31218 7.76601L5.35918 7.76701C5.78518 7.78201 6.22718 7.79801 6.65918 7.79101C7.10918 7.78301 7.51518 7.75101 7.84518 7.67801C8.18718 7.60201 8.36518 7.50101 8.44518 7.42101L10.9352 4.93101C10.9962 4.87001 11.0812 4.67501 11.0552 4.17101C11.0402 3.93447 11.0158 3.69862 10.9822 3.46401L10.9732 3.39601C10.9415 3.17762 10.9178 2.95814 10.9022 2.73801C10.8772 2.28301 11.0382 1.86101 11.2502 1.52701C11.4662 1.18701 11.7652 0.887006 12.1012 0.664006Z"
                                                    fill="#E8A26A" />
                                            </svg>
                                            <h1 class="font-semibold text-[#3E5467] text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Hari</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">6 bln
                                            - 12 y.o</p>
                                    </div>
                                </div>
                                <h2 class="font-semibold text-[#3E5467] text-2xl md:text-3xl mb-5 mt-7"
                                    style="font-family: 'Fredoka';">About Daycare</h2>
                                <div class="space-y-3">
                                    <div
                                        class="flex justify-between border-b-2 border-dashed pb-3 border-[#E8A26A] items-center">
                                        <flex class="flex-row flex items-center space-x-3">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1012 0.664006C12.7292 0.248006 13.7932 -0.0489938 14.5962 0.754006L19.2432 5.40201C20.0492 6.20601 19.7512 7.27001 19.3342 7.89701C19.1084 8.23699 18.8145 8.52642 18.4712 8.74701C18.1372 8.96001 17.7152 9.12101 17.2602 9.09701C17.04 9.08141 16.8206 9.05773 16.6022 9.02601L16.5342 9.01601C16.2996 8.98237 16.0637 8.95802 15.8272 8.94301C15.3232 8.91801 15.1292 9.00301 15.0672 9.06301L12.5772 11.554C12.4972 11.634 12.3972 11.812 12.3212 12.154C12.2482 12.484 12.2162 12.89 12.2082 13.34C12.2012 13.772 12.2162 14.214 12.2322 14.64L12.2332 14.687C12.2482 15.11 12.2632 15.542 12.2422 15.881C12.1772 16.912 11.3742 17.671 10.5842 18.022C9.79418 18.372 8.66718 18.459 7.88418 17.675L5.63418 15.425L1.52918 19.53C1.46051 19.6037 1.37771 19.6628 1.28572 19.7038C1.19372 19.7448 1.0944 19.7668 0.9937 19.7686C0.892997 19.7704 0.792968 19.7518 0.69958 19.7141C0.606191 19.6764 0.521357 19.6203 0.450139 19.549C0.37892 19.4778 0.322775 19.393 0.285054 19.2996C0.247333 19.2062 0.228809 19.1062 0.230585 19.0055C0.232362 18.9048 0.254404 18.8055 0.295396 18.7135C0.336388 18.6215 0.39549 18.5387 0.469177 18.47L4.57318 14.365L2.32318 12.115C1.54018 11.331 1.62618 10.205 1.97718 9.41501C2.32718 8.62501 3.08718 7.82201 4.11718 7.75701C4.45718 7.73601 4.88918 7.75101 5.31218 7.76601L5.35918 7.76701C5.78518 7.78201 6.22718 7.79801 6.65918 7.79101C7.10918 7.78301 7.51518 7.75101 7.84518 7.67801C8.18718 7.60201 8.36518 7.50101 8.44518 7.42101L10.9352 4.93101C10.9962 4.87001 11.0812 4.67501 11.0552 4.17101C11.0402 3.93447 11.0158 3.69862 10.9822 3.46401L10.9732 3.39601C10.9415 3.17762 10.9178 2.95814 10.9022 2.73801C10.8772 2.28301 11.0382 1.86101 11.2502 1.52701C11.4662 1.18701 11.7652 0.887006 12.1012 0.664006Z"
                                                    fill="#E8A26A" />
                                            </svg>
                                            <h1 class="font-semibold text-[#3E5467] text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Usia 0 - 1</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">1 Anak
                                            1 Care Giver</p>
                                    </div>
                                    <div
                                        class="flex justify-between border-b-2 border-dashed pb-3 border-[#E8A26A] items-center">
                                        <flex class="flex-row flex items-center space-x-3">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1012 0.664006C12.7292 0.248006 13.7932 -0.0489938 14.5962 0.754006L19.2432 5.40201C20.0492 6.20601 19.7512 7.27001 19.3342 7.89701C19.1084 8.23699 18.8145 8.52642 18.4712 8.74701C18.1372 8.96001 17.7152 9.12101 17.2602 9.09701C17.04 9.08141 16.8206 9.05773 16.6022 9.02601L16.5342 9.01601C16.2996 8.98237 16.0637 8.95802 15.8272 8.94301C15.3232 8.91801 15.1292 9.00301 15.0672 9.06301L12.5772 11.554C12.4972 11.634 12.3972 11.812 12.3212 12.154C12.2482 12.484 12.2162 12.89 12.2082 13.34C12.2012 13.772 12.2162 14.214 12.2322 14.64L12.2332 14.687C12.2482 15.11 12.2632 15.542 12.2422 15.881C12.1772 16.912 11.3742 17.671 10.5842 18.022C9.79418 18.372 8.66718 18.459 7.88418 17.675L5.63418 15.425L1.52918 19.53C1.46051 19.6037 1.37771 19.6628 1.28572 19.7038C1.19372 19.7448 1.0944 19.7668 0.9937 19.7686C0.892997 19.7704 0.792968 19.7518 0.69958 19.7141C0.606191 19.6764 0.521357 19.6203 0.450139 19.549C0.37892 19.4778 0.322775 19.393 0.285054 19.2996C0.247333 19.2062 0.228809 19.1062 0.230585 19.0055C0.232362 18.9048 0.254404 18.8055 0.295396 18.7135C0.336388 18.6215 0.39549 18.5387 0.469177 18.47L4.57318 14.365L2.32318 12.115C1.54018 11.331 1.62618 10.205 1.97718 9.41501C2.32718 8.62501 3.08718 7.82201 4.11718 7.75701C4.45718 7.73601 4.88918 7.75101 5.31218 7.76601L5.35918 7.76701C5.78518 7.78201 6.22718 7.79801 6.65918 7.79101C7.10918 7.78301 7.51518 7.75101 7.84518 7.67801C8.18718 7.60201 8.36518 7.50101 8.44518 7.42101L10.9352 4.93101C10.9962 4.87001 11.0812 4.67501 11.0552 4.17101C11.0402 3.93447 11.0158 3.69862 10.9822 3.46401L10.9732 3.39601C10.9415 3.17762 10.9178 2.95814 10.9022 2.73801C10.8772 2.28301 11.0382 1.86101 11.2502 1.52701C11.4662 1.18701 11.7652 0.887006 12.1012 0.664006Z"
                                                    fill="#E8A26A" />
                                            </svg>
                                            <h1 class="font-semibold text-[#3E5467] text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Usia 1 -3</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">2 Anak
                                            1 Care Giver</p>
                                    </div>
                                    <div
                                        class="flex justify-between border-b-2 border-dashed pb-3 border-[#E8A26A] items-center">
                                        <flex class="flex-row flex items-center space-x-3">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1012 0.664006C12.7292 0.248006 13.7932 -0.0489938 14.5962 0.754006L19.2432 5.40201C20.0492 6.20601 19.7512 7.27001 19.3342 7.89701C19.1084 8.23699 18.8145 8.52642 18.4712 8.74701C18.1372 8.96001 17.7152 9.12101 17.2602 9.09701C17.04 9.08141 16.8206 9.05773 16.6022 9.02601L16.5342 9.01601C16.2996 8.98237 16.0637 8.95802 15.8272 8.94301C15.3232 8.91801 15.1292 9.00301 15.0672 9.06301L12.5772 11.554C12.4972 11.634 12.3972 11.812 12.3212 12.154C12.2482 12.484 12.2162 12.89 12.2082 13.34C12.2012 13.772 12.2162 14.214 12.2322 14.64L12.2332 14.687C12.2482 15.11 12.2632 15.542 12.2422 15.881C12.1772 16.912 11.3742 17.671 10.5842 18.022C9.79418 18.372 8.66718 18.459 7.88418 17.675L5.63418 15.425L1.52918 19.53C1.46051 19.6037 1.37771 19.6628 1.28572 19.7038C1.19372 19.7448 1.0944 19.7668 0.9937 19.7686C0.892997 19.7704 0.792968 19.7518 0.69958 19.7141C0.606191 19.6764 0.521357 19.6203 0.450139 19.549C0.37892 19.4778 0.322775 19.393 0.285054 19.2996C0.247333 19.2062 0.228809 19.1062 0.230585 19.0055C0.232362 18.9048 0.254404 18.8055 0.295396 18.7135C0.336388 18.6215 0.39549 18.5387 0.469177 18.47L4.57318 14.365L2.32318 12.115C1.54018 11.331 1.62618 10.205 1.97718 9.41501C2.32718 8.62501 3.08718 7.82201 4.11718 7.75701C4.45718 7.73601 4.88918 7.75101 5.31218 7.76601L5.35918 7.76701C5.78518 7.78201 6.22718 7.79801 6.65918 7.79101C7.10918 7.78301 7.51518 7.75101 7.84518 7.67801C8.18718 7.60201 8.36518 7.50101 8.44518 7.42101L10.9352 4.93101C10.9962 4.87001 11.0812 4.67501 11.0552 4.17101C11.0402 3.93447 11.0158 3.69862 10.9822 3.46401L10.9732 3.39601C10.9415 3.17762 10.9178 2.95814 10.9022 2.73801C10.8772 2.28301 11.0382 1.86101 11.2502 1.52701C11.4662 1.18701 11.7652 0.887006 12.1012 0.664006Z"
                                                    fill="#E8A26A" />
                                            </svg>
                                            <h1 class="font-semibold text-[#3E5467] text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Usia 3 - 12</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">14
                                            Anak 1 Care Giver</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="informasi">
                    <div class="w-full flex flex-col md:flex-row mt-24">
                        <div class="w-full lg:w-1/2 flex flex-col justify-center">
                            <div class="space-y-3">
                                <p class="text-[#E8A26A] text-xl" style="font-family: Fuzzy Bubbles;">Program Daycare
                                </p>
                                <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-start"
                                    style="font-family: 'Fredoka';">Program Daycare Rumah Samoedra
                                </h1>
                                <p class="text-[#A2A2BD] max-w-xl mt-5" style="font-family: 'Onest';">Lorem ipsum dolor
                                    sit
                                    amet, consectetur adipisicing elit. Sequi fugit delectus repellendus non sed illo
                                    aliquam totam velit, dolorum quo sunt inventore temporibus eaque doloribus sint!
                                    Placeat
                                    quia alias perferendis.</p>
                            </div>
                            <div class="space-y-4 mt-6">
                                <div class="flex flex-row space-x-3">
                                    <div
                                        class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55018 15.15L18.0252 6.675C18.2252 6.475 18.4585 6.375 18.7252 6.375C18.9918 6.375 19.2252 6.475 19.4252 6.675C19.6252 6.875 19.7252 7.11267 19.7252 7.388C19.7252 7.66333 19.6252 7.90067 19.4252 8.1L10.2502 17.3C10.0502 17.5 9.81685 17.6 9.55018 17.6C9.28351 17.6 9.05018 17.5 8.85018 17.3L4.55018 13C4.35018 12.8 4.25418 12.5627 4.26218 12.288C4.27018 12.0133 4.37451 11.7757 4.57518 11.575C4.77585 11.3743 5.01351 11.2743 5.28818 11.275C5.56285 11.2757 5.80018 11.3757 6.00018 11.575L9.55018 15.15Z"
                                                fill="white" />
                                        </svg>
                                    </div>
                                    <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                        Daily
                                        Activity</h1>
                                </div>
                                <div class="flex flex-row space-x-3">
                                    <div
                                        class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55018 15.15L18.0252 6.675C18.2252 6.475 18.4585 6.375 18.7252 6.375C18.9918 6.375 19.2252 6.475 19.4252 6.675C19.6252 6.875 19.7252 7.11267 19.7252 7.388C19.7252 7.66333 19.6252 7.90067 19.4252 8.1L10.2502 17.3C10.0502 17.5 9.81685 17.6 9.55018 17.6C9.28351 17.6 9.05018 17.5 8.85018 17.3L4.55018 13C4.35018 12.8 4.25418 12.5627 4.26218 12.288C4.27018 12.0133 4.37451 11.7757 4.57518 11.575C4.77585 11.3743 5.01351 11.2743 5.28818 11.275C5.56285 11.2757 5.80018 11.3757 6.00018 11.575L9.55018 15.15Z"
                                                fill="white" />
                                        </svg>
                                    </div>
                                    <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                        Pengecekan Tumbuh Kembang Rutin</h1>
                                </div>
                                <div class="flex flex-row space-x-3">
                                    <div
                                        class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55018 15.15L18.0252 6.675C18.2252 6.475 18.4585 6.375 18.7252 6.375C18.9918 6.375 19.2252 6.475 19.4252 6.675C19.6252 6.875 19.7252 7.11267 19.7252 7.388C19.7252 7.66333 19.6252 7.90067 19.4252 8.1L10.2502 17.3C10.0502 17.5 9.81685 17.6 9.55018 17.6C9.28351 17.6 9.05018 17.5 8.85018 17.3L4.55018 13C4.35018 12.8 4.25418 12.5627 4.26218 12.288C4.27018 12.0133 4.37451 11.7757 4.57518 11.575C4.77585 11.3743 5.01351 11.2743 5.28818 11.275C5.56285 11.2757 5.80018 11.3757 6.00018 11.575L9.55018 15.15Z"
                                                fill="white" />
                                        </svg>
                                    </div>
                                    <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                        Daily
                                        Report</h1>
                                </div>
                                <div class="flex flex-row space-x-3">
                                    <div
                                        class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55018 15.15L18.0252 6.675C18.2252 6.475 18.4585 6.375 18.7252 6.375C18.9918 6.375 19.2252 6.475 19.4252 6.675C19.6252 6.875 19.7252 7.11267 19.7252 7.388C19.7252 7.66333 19.6252 7.90067 19.4252 8.1L10.2502 17.3C10.0502 17.5 9.81685 17.6 9.55018 17.6C9.28351 17.6 9.05018 17.5 8.85018 17.3L4.55018 13C4.35018 12.8 4.25418 12.5627 4.26218 12.288C4.27018 12.0133 4.37451 11.7757 4.57518 11.575C4.77585 11.3743 5.01351 11.2743 5.28818 11.275C5.56285 11.2757 5.80018 11.3757 6.00018 11.575L9.55018 15.15Z"
                                                fill="white" />
                                        </svg>
                                    </div>
                                    <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                        Stimulasi Sesuai Usia</h1>
                                </div>
                                <div class="flex flex-row space-x-3">
                                    <div
                                        class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55018 15.15L18.0252 6.675C18.2252 6.475 18.4585 6.375 18.7252 6.375C18.9918 6.375 19.2252 6.475 19.4252 6.675C19.6252 6.875 19.7252 7.11267 19.7252 7.388C19.7252 7.66333 19.6252 7.90067 19.4252 8.1L10.2502 17.3C10.0502 17.5 9.81685 17.6 9.55018 17.6C9.28351 17.6 9.05018 17.5 8.85018 17.3L4.55018 13C4.35018 12.8 4.25418 12.5627 4.26218 12.288C4.27018 12.0133 4.37451 11.7757 4.57518 11.575C4.77585 11.3743 5.01351 11.2743 5.28818 11.275C5.56285 11.2757 5.80018 11.3757 6.00018 11.575L9.55018 15.15Z"
                                                fill="white" />
                                        </svg>
                                    </div>
                                    <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                        Outdor
                                        Activity</h1>
                                </div>
                                <div class="flex flex-row space-x-3">
                                    <div
                                        class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55018 15.15L18.0252 6.675C18.2252 6.475 18.4585 6.375 18.7252 6.375C18.9918 6.375 19.2252 6.475 19.4252 6.675C19.6252 6.875 19.7252 7.11267 19.7252 7.388C19.7252 7.66333 19.6252 7.90067 19.4252 8.1L10.2502 17.3C10.0502 17.5 9.81685 17.6 9.55018 17.6C9.28351 17.6 9.05018 17.5 8.85018 17.3L4.55018 13C4.35018 12.8 4.25418 12.5627 4.26218 12.288C4.27018 12.0133 4.37451 11.7757 4.57518 11.575C4.77585 11.3743 5.01351 11.2743 5.28818 11.275C5.56285 11.2757 5.80018 11.3757 6.00018 11.575L9.55018 15.15Z"
                                                fill="white" />
                                        </svg>
                                    </div>
                                    <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">Art
                                        And
                                        Craft</h1>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 relative flex justify-center items-center">
                            <div class="w-full max-w-[500px] h-[500px] p-3 xl:p-5 bg-[#EFF5F6] mask-faq relative z-10">
                                <div class="mask-faq h-full">
                                    <img src="images/assets/img_detail_layanan.png" class="w-full h-full object-cover object-center"
                                        alt="">
                                </div>
                            </div>
                            <img src="images/assets/vector_line_faq.svg" alt="Vector FAQ"
                                class="absolute w-full max-w-[540px] h-[540px] -z-10 mx-auto bottom-0 left-0 right-0 top-1">
                            <img src="images/assets/ikan_pari.svg" alt="Ikan Pari"
                                class="absolute top-15 md:left-10 md:top-7 animate-float w-32 md:w-52">
                            <img src="images/assets/ikan_biru.svg" alt="Ikan Biru"
                                class="absolute bottom-10 right-0 md:right-12 md:bottom-0 animate-float-ikan w-24 md:w-44">
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="absolute w-full h-full top-40 z-0 overflow-x-hidden">
            <img src="images/assets/vector_line_detail_layanan.svg" alt="Vector Line Detail Layanan" class="hidden md:block">
            <img src="images/assets/kura2.svg" alt="Kura Kura" class="w-20 md:w-40 absolute top-3 -left-7">
            <img src="images/assets/lobster.svg" alt="Lobster" class="w-20 md:w-28 absolute top-65 -right-7">
        </div>
        <section id="fasilitas">
            <div class="relative overflow-x-hidden">
                <!-- SVG Background -->

                <svg class="absolute bottom-0 left-0 w-full h-full -z-10" viewBox="0 0 2360 1040"
                    preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M204.536 6.98202C99.2828 6.98195 -22.8599 37.4186 -65.8807 116.554C-108.902 195.689 -65.8757 808.682 -65.8807 881.73C-65.8858 954.778 66.249 1040 181.489 1040C296.729 1040 387.235 977.715 505.548 977.715C623.86 977.715 710.793 1040 821.424 1040C932.054 1040 977.46 977.715 1116.51 977.715C1255.56 977.715 1286.96 1040 1402.97 1040C1518.98 1040 1547.57 977.715 1688.16 977.715C1828.76 977.715 1863.23 1040 2012.27 1040C2161.3 1040 2365.65 984.126 2365.65 899.513C2365.65 814.899 2487.12 41.0711 2328.01 6.98208C2168.9 -27.1069 2141.64 74.7078 2041 74.7078C1940.36 74.7078 1918.46 6.98202 1794 6.98202C1669.54 6.98202 1624.64 74.7078 1524 74.7078C1423.36 74.7078 1417.58 6.98202 1293.12 6.98202C1168.66 6.98202 1105.8 74.7078 1009 74.7078C912.197 74.7078 850.622 6.98202 746.137 6.98202C641.652 6.98202 559.961 74.7078 467 74.7078C374.039 74.7078 309.789 6.9821 204.536 6.98202Z"
                        fill="#EFF5F6" />
                </svg>

                <div class="w-full relative flex flex-col justify-center items-center py-28">
                    <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Fasilitas</p>
                    <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">
                        Daycare
                    </h1>

                    <div
                        class="md:w-3/4 w-full px-8 md:px-0 overflow-x-auto no-scrollbar mx-auto flex flex-col items-start">
                        <div class="flex flex-row gap-7 py-10 overflow-x-auto">

                            <!-- Card Template -->
                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="images/assets/img_layanan.png" alt="Daycare"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Full AC</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="images/assets/img_layanan.png" alt="Daycare"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Purifier</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="images/assets/img_layanan.png" alt="Daycare"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">3 Kamar</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="images/assets/img_layanan.png" alt="Daycare"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Baby Bed</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="images/assets/img_layanan.png" alt="Daycare"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Outdor Area</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="images/assets/ikan_biru.svg" alt="Ikan Biru"
                    class="w-16 md:w-28 absolute scale-x-[-1] top-45 -right-7 rotate-45">
                <img src="images/assets/ikan_kuning.svg" alt="Ikan Kuning" class="w-12 md:w-20 absolute top-35 right-15">
                <img src="images/assets/bintang_laut_pink.svg" alt="Bintang Laut Kuning"
                    class="w-16 md:w-20 absolute bottom-30 left-5">
                <img src="images/assets/bintang_laut_kuning.svg" alt="Bintang Laut Kuning"
                    class="w-8 md:w-14 absolute bottom-22 left-17">
            </div>
        </section>

        <section id="pricelist">
            <!-- Wrapper div table-->
            <div class="w-full md:w-3/4 mx-auto px-8 md:px-0">
                <div class="flex flex-col justify-center mt-20 items-center">
                    <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Pricelist</p>
                    <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">
                        Daycare
                    </h1>
                </div>
                <div class="mt-10 overflow-x-auto">
                    <table class="w-full border-collapse border border-[#E8A26A] min-w-[800px]">
                        <thead>
                            <tr class="text-[#3E5467] text-lg md:text-xl" style="font-family: 'Fredoka';">
                                <th class="border border-[#E8A26A] px-4 py-3 text-center">No</th>
                                <th class="border border-[#E8A26A] px-4 py-3 text-center">Layanan</th>
                                <th class="border border-[#E8A26A] px-4 py-3 text-center">Usia</th>
                                <th class="border border-[#E8A26A] px-4 py-3 text-center">Promo Pendaftaran</th>
                                <th class="border border-[#E8A26A] px-4 py-3 text-center">Biaya</th>
                                <th class="border border-[#E8A26A] px-4 py-3 text-center">Biaya Makan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">01</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">Daycare Harian</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">6 bln s/d 12 thn</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">-</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">Rp. 110.000</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">12.5k / Porsi, 5k Snack</td>
                            </tr>
                            <tr>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">02</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">Daycare Bulanan</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">6 bln s/d 12 thn</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">Rp. 100.000</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">Rp. 1.300.000</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">12.5k / Porsi, 5k Snack</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section id="galery">
            <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto">
                <div class="flex flex-col justify-center mb-40 mt-20 items-center">
                    <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Galeri</p>
                    <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">
                        Daycare
                    </h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                        <div class="w-full rounded-3xl overflow-hidden">
                            <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover">
                        </div>
                        <div class="w-full rounded-3xl overflow-hidden">
                            <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover">
                        </div>
                        <div class="w-full rounded-3xl overflow-hidden">
                            <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover">
                        </div>
                        <div class="w-full rounded-3xl overflow-hidden">
                            <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover">
                        </div>
                        <div class="w-full rounded-3xl overflow-hidden">
                            <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover">
                        </div>
                        <div class="w-full rounded-3xl overflow-hidden">
                            <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('components.footer-fe')
    </section>


  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
