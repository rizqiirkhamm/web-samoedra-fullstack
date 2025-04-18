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
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
</head>

<body class="font-[Onest]">
  <!-- Navbar Section -->
  @include('components.navbar-fe')


  <!-- Hero Section -->
  <section id="home" class="relative z-0">
    <div
      class="lg:w-3/4 w-full px-8 lg:px-0 mx-auto md:my-18 flex flex-col-reverse md:flex-row justify-between items-center">
      <div class="flex items-center w-full md:w-1/2">
        <div class="flex-col">
          <h1 class="text-[#3E5467] font-semibold text-2xl sm:text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Halo👋🏻,
            Selamat Datang
          </h1>
          <div class="flex items-center gap-2">
            <h1 class="text-[#3E5467] font-semibold text-2xl sm:text-4xl xl:text-5xl leading-none" style="font-family: 'Fredoka';">
              Di Rumah</h1>
            <img src="images/assets/text_samoedra.png" class="sm:h-12 h-9 xl:h-18" alt="">
          </div>
          <p class=" text-[#A2A2BD] max-w-xl mt-4">Rumah Samoedra adalah ruang bermain dan belajar anak
            dengan layanan daycare, area bermain, bimbel, kelas
            stimulasi, serta event seperti playdate, ulang tahun, dan outing class. </p>
          <div class="flex gap-5 mt-6">
            <a href="{{route('welcome')}}">
              <button
                class="bg-[#3E5467] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar<svg
                  width="21" height="10" viewBox="0 0 21 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
            </a>
            <a href="#" class="flex space-x-2 items-center">
              <svg width="28" height="28" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_68_61" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="32"
                  height="33">
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
        </div>
      </div>
      <div class="w-full md:w-1/2 relative flex justify-center items-center mb-16 md:mb-0">
        <div class="w-full md:max-w-[600px] md:h-[600px] p-3 xl:p-6 bg-[#91CFE0] mask-home relative z-10">
          <div class="mask-home h-full">
            <img src="images/assets/img.png" class="w-full h-full object-cover object-center" alt="">
          </div>
        </div>
        <img src="images/assets/vector_line_home.svg" alt="Vector FAQ"
          class="absolute w-full md:max-w-[2000px] md:h-[540px] -z-10 mx-auto bottom-0 left-0 right-0 top-1">
        <img src="images/assets/lobster.svg" alt="Lobster"
          class="absolute bottom-0 md:bottom-25 -left-1 md:-left-5 animate-swim w-20 md:w-32">
        <img src="images/assets/ikan_tosca.svg" alt="Ikan Tosca"
          class="absolute md:bottom-10 -right-1 md:right-10 -top-5 md:top-12 animate-float-ikan w-24 md:w-36">
      </div>

    </div>
    </div>
    <!-- Layanan Section -->
    <div class="relative mt-28">
      <!-- SVG Background -->

      <img src="images/assets/gurita.svg" alt="Gurita"
        class="absolute left-60 -top-17 w-48 -z-10 animate-float hidden md:block">

      <svg class="absolute bottom-0 left-0 w-full h-full -z-10" viewBox="0 0 2360 1040" preserveAspectRatio="none"
        fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M204.536 6.98202C99.2828 6.98195 -22.8599 37.4186 -65.8807 116.554C-108.902 195.689 -65.8757 808.682 -65.8807 881.73C-65.8858 954.778 66.249 1040 181.489 1040C296.729 1040 387.235 977.715 505.548 977.715C623.86 977.715 710.793 1040 821.424 1040C932.054 1040 977.46 977.715 1116.51 977.715C1255.56 977.715 1286.96 1040 1402.97 1040C1518.98 1040 1547.57 977.715 1688.16 977.715C1828.76 977.715 1863.23 1040 2012.27 1040C2161.3 1040 2365.65 984.126 2365.65 899.513C2365.65 814.899 2487.12 41.0711 2328.01 6.98208C2168.9 -27.1069 2141.64 74.7078 2041 74.7078C1940.36 74.7078 1918.46 6.98202 1794 6.98202C1669.54 6.98202 1624.64 74.7078 1524 74.7078C1423.36 74.7078 1417.58 6.98202 1293.12 6.98202C1168.66 6.98202 1105.8 74.7078 1009 74.7078C912.197 74.7078 850.622 6.98202 746.137 6.98202C641.652 6.98202 559.961 74.7078 467 74.7078C374.039 74.7078 309.789 6.9821 204.536 6.98202Z"
          fill="#EFF5F6" />
      </svg>

      <div class="w-full relative flex flex-col justify-center items-center py-28">
        <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Kami Menawarkan</p>
        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">Program Layanan
          Kami</h1>

        <div class="md:w-3/4 w-full px-8 md:px-0 overflow-x-auto no-scrollbar mx-auto flex flex-col items-start">

    <div class="flex flex-row gap-7 py-10 overflow-x-auto scroll-smooth" id="cards-container">
            <!-- Card Template -->
            <div class="card-item w-80 h-96 rounded-4xl bg-white p-6 flex flex-col relative">
              <img src="images/assets/img_layanan.png" alt="Daycare" class="w-full h-44 rounded-3xl object-cover">
              <div class="flex justify-between my-5">
                <h1 class="text-3xl text-[#3E5467] font-semibold" style="font-family: 'Fredoka';">Daycare</h1>
                <div class="px-3 py-1 rounded-xl bg-[#7BA5B0] flex items-center">
                  <p class=" text-white" style="font-family: 'Onest';">08.00 - 15.00</p>
                </div>
              </div>
              <p class=" text-[#A2A2BD] flex-grow">Lorem ipsum dolor sit amet consectetur adipsing elit
                nguawor
                la tayiba teu nyaho naon...</p>

              <!-- Button Next -->
              <div
                class="absolute left-1/2 -translate-x-1/2 -bottom-7 p-4 w-14 h-14 hover:bg-[#F3EEE6] transition-all duration-300 bg-[#E8A26A] rounded-2xl flex items-center justify-center">
                <svg width="25" height="21" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.8333 2L24 11M24 11L14.8333 20M24 11H2" stroke="white" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>

            <div class="card-item w-80 h-96 rounded-4xl bg-white p-6 flex flex-col relative">
              <img src="images/assets/img_layanan.png" alt="Daycare" class="w-full h-44 rounded-3xl object-cover">
              <div class="flex justify-between my-5">
                <h1 class="text-3xl text-[#3E5467] font-semibold" style="font-family: 'Fredoka';">Area Main</h1>
                <div class="px-3 py-1 rounded-xl bg-[#7BA5B0] flex items-center">
                  <p class=" text-white" style="font-family: 'Onest';">08.00 - 15.00</p>
                </div>
              </div>
              <p class=" text-[#A2A2BD] flex-grow">Lorem ipsum dolor sit amet consectetur adipsing elit
                nguawor
                la tayiba teu nyaho naon...</p>

              <!-- Button Next -->
              <div
                class="absolute left-1/2 -translate-x-1/2 -bottom-7 p-4 w-14 h-14 hover:bg-[#F3EEE6] transition-all duration-300 bg-[#E8A26A] rounded-2xl flex items-center justify-center">
                <svg width="25" height="21" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.8333 2L24 11M24 11L14.8333 20M24 11H2" stroke="white" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>

            <div class="card-item w-80 h-96 rounded-4xl bg-white p-6 flex flex-col relative">
              <img src="images/assets/img_layanan.png" alt="Daycare" class="w-full h-44 rounded-3xl object-cover">
              <div class="flex justify-between my-5">
                <h1 class="text-3xl text-[#3E5467] font-semibold" style="font-family: 'Fredoka';">Bimbel</h1>
                <div class="px-3 py-1 rounded-xl bg-[#7BA5B0] flex items-center">
                  <p class=" text-white" style="font-family: 'Onest';">08.00 - 15.00</p>
                </div>
              </div>
              <p class=" text-[#A2A2BD] flex-grow">Lorem ipsum dolor sit amet consectetur adipsing elit
                nguawor
                la tayiba teu nyaho naon...</p>

              <!-- Button Next -->
              <div
                class="absolute left-1/2 -translate-x-1/2 -bottom-7 p-4 w-14 h-14 hover:bg-[#F3EEE6] transition-all duration-300 bg-[#E8A26A] rounded-2xl flex items-center justify-center">
                <svg width="25" height="21" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.8333 2L24 11M24 11L14.8333 20M24 11H2" stroke="white" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>

            <div class="card-item w-80 h-96 rounded-4xl bg-white p-6 flex flex-col relative">
              <img src="images/assets/img_layanan.png" alt="Daycare" class="w-full h-44 rounded-3xl object-cover">
              <div class="flex justify-between my-5">
                <h1 class="text-3xl text-[#3E5467] font-semibold" style="font-family: 'Fredoka';">Stimulasi</h1>
                <div class="px-3 py-1 rounded-xl bg-[#7BA5B0] flex items-center">
                  <p class=" text-white" style="font-family: 'Onest';">08.00 - 15.00</p>
                </div>
              </div>
              <p class=" text-[#A2A2BD] flex-grow">Lorem ipsum dolor sit amet consectetur adipsing elit
                nguawor
                la tayiba teu nyaho naon...</p>

              <!-- Button Next -->
              <div
                class="absolute left-1/2 -translate-x-1/2 -bottom-7 p-4 w-14 h-14 hover:bg-[#F3EEE6] transition-all duration-300 bg-[#E8A26A] rounded-2xl flex items-center justify-center">
                <svg width="25" height="21" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.8333 2L24 11M24 11L14.8333 20M24 11H2" stroke="white" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>

            <div class="card-item w-80 h-96 rounded-4xl bg-white p-6 flex flex-col relative">
              <img src="images/assets/img_layanan.png" alt="Daycare" class="w-full h-44 rounded-3xl object-cover">
              <div class="flex justify-between my-5">
                <h1 class="text-3xl text-[#3E5467] font-semibold" style="font-family: 'Fredoka';">Event</h1>
                <div class="px-3 py-1 rounded-xl bg-[#7BA5B0] flex items-center">
                  <p class=" text-white" style="font-family: 'Onest';">08.00 - 15.00</p>
                </div>
              </div>
              <p class=" text-[#A2A2BD] flex-grow">Lorem ipsum dolor sit amet consectetur adipsing elit
                nguawor
                la tayiba teu nyaho naon...</p>

              <!-- Button Next -->
              <div
                class="absolute left-1/2 -translate-x-1/2 -bottom-7 p-4 w-14 h-14 hover:bg-[#F3EEE6] transition-all duration-300 bg-[#E8A26A] rounded-2xl flex items-center justify-center">
                <svg width="25" height="21" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.8333 2L24 11M24 11L14.8333 20M24 11H2" stroke="white" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>
          </div>
          <div class="w-full items-start justify-start flex ">
            <p class="text-left text-[#A2A2BD] mt-1.5" style="font-family: 'Fuzzy Bubbles';">Tips : Scroll Horizontal</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Stats Section -->
    <div class="w-full xl:w-3/4 min-h-screen px-4 mx-auto flex items-center justify-center py-20 lg:py-0">
      <div class="relative w-full px-8">
        <!-- Background Vector -->
        <div class="absolute top-0 left-0 w-full h-full -z-10">
          <img src="images/assets/vector_stats.svg" alt="Vector Stats" class="w-full h-full object-cover">
        </div>

        <div class="relative min-h-[1000px] md:min-h-0">
          <!-- SVG Masking (Muncul di md ke atas) -->
          <svg class="hidden md:block w-full h-auto" viewBox="0 0 1241 671" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M4.52056 161.001C-4.86628 224.709 4.52056 365.953 4.52056 365.953C4.52056 365.953 24.2697 549.668 61.1697 596.585C98.0697 643.501 215.567 648.934 215.567 648.934C215.567 648.934 1099.86 683.998 1156.19 665.725C1212.51 647.452 1226.43 610.906 1232.58 576.336C1238.73 541.766 1240.34 517.073 1240.35 469.169C1240.35 421.265 1240.35 197.053 1240.35 137.296C1240.35 77.5393 1230.95 58.2788 1200.53 30.6227C1170.11 2.96662 1076.56 0.497329 1039.34 0.0034708C1002.12 -0.490388 201.321 51.8586 124.284 67.6621C47.2469 83.4656 13.9074 97.2936 4.52056 161.001Z"
              fill="#F3EEE6" />
          </svg>

          <!-- Background Biasa (Muncul di sm ke bawah) -->
          <div class="md:hidden w-full h-full bg-[#F3EEE6] rounded-3xl absolute top-0 left-0 z-0"></div>

          <!-- Gambar Ubur-Ubur (Kiri) -->
          <div class="absolute left-5 sm:left-20 bottom-10 sm:bottom-20 z-20">
            <img src="images/assets/ubur2.svg" alt="Ubur-Ubur" class="w-24 h-24 sm:w-32 sm:h-32 animate-float">
          </div>

          <!-- Gambar Rumput Laut (Kanan) -->
          <div class="absolute right-5 sm:right-20 bottom-0 z-20">
            <img src="images/assets/rumputlaut.svg" alt="Rumput Laut" class="w-24 h-24 sm:w-32 sm:h-32">
          </div>

          <!-- Gambar Kura-Kura (Kiri Bawah) -->
          <div class="absolute left-10 sm:left-40 top-0 sm:-top-10 z-20">
            <img src="images/assets/kura2.svg" alt="Kura-Kura" class="w-24 h-24 sm:w-42 sm:h-42 animate-swim">
          </div>

          <!-- Gambar Kepiting (Kanan Bawah) -->
          <div class="absolute right-10 sm:right-40 -top-12 sm:-top-20 -z-10">
            <img src="images/assets/kepiting.svg" alt="Kepiting" class="w-24 h-24 sm:w-32 sm:h-32 animate-float">
          </div>

          <!-- Konten Utama -->
          <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center p-4 z-50">
            <div class="relative z-30 flex flex-col gap-6 text-center">
              <div class="flex flex-col md:flex-row justify-center items-center mb-6 gap-6">
                <div class="flex flex-col items-center justify-center gap-3">
                  <p class="text-5xl sm:text-6xl xl:text-7xl font-bold text-[#7BA5B0]"
                    style="font-family: 'Fredericka the Great';">{{ $total_daycare  }}</p>
                  <p class="font-semibold text-[#3E5467] text-xl sm:text-2xl" style="font-family: 'Fredoka';">Anak Di
                    Daycare</p>
                  <p class="text-[#A2A2BD] max-w-60 sm:max-w-72 sm:text-base">Lorem Ipsum Dolor Sit Amet Consectetur
                    Adipsing Elit</p>
                </div>
                <div class="hidden md:block w-1 h-44 border-dashed border-r-2 border-[#C0C0CE]"></div>

                <div class="flex flex-col items-center justify-center gap-3">
                  <p class="text-5xl sm:text-6xl xl:text-7xl font-bold text-[#7BA5B0]"
                    style="font-family: 'Fredericka the Great';">{{ $total_bermain  }}</p>
                  <p class="font-semibold text-[#3E5467] text-xl sm:text-2xl" style="font-family: 'Fredoka';">Anak Aktif
                    Bermain</p>
                  <p class="text-[#A2A2BD] max-w-60 sm:max-w-72 sm:text-base">Lorem Ipsum Dolor Sit Amet Consectetur
                    Adipsing Elit</p>
                </div>
                <div class="hidden md:block w-1 h-44 border-dashed border-r-2 border-[#C0C0CE]"></div>

                <div class="flex flex-col items-center justify-center gap-3">
                  <p class="text-5xl sm:text-6xl xl:text-7xl font-bold text-[#7BA5B0]"
                    style="font-family: 'Fredericka the Great';">{{ $total_bimbel  }}</p>
                  <p class="font-semibold text-[#3E5467] text-xl sm:text-2xl" style="font-family: 'Fredoka';">Peserta
                    Bimbel</p>
                  <p class="text-[#A2A2BD] max-w-60 sm:max-w-72 sm:text-base">Lorem Ipsum Dolor Sit Amet Consectetur
                    Adipsing Elit</p>
                </div>
              </div>

              <div class="flex flex-col md:flex-row justify-center items-center gap-6">
                <div class="flex flex-col items-center justify-center gap-3">
                  <p class="text-5xl sm:text-6xl xl:text-7xl font-bold text-[#7BA5B0]"
                    style="font-family: 'Fredericka the Great';">{{ $total_stimulasi  }}</p>
                  <p class="font-semibold text-[#3E5467] text-xl sm:text-2xl" style="font-family: 'Fredoka';">Peserta
                    Kelas Stimulasi</p>
                  <p class="text-[#A2A2BD] max-w-60 sm:max-w-72 sm:text-base">Lorem Ipsum Dolor Sit Amet Consectetur
                    Adipsing Elit</p>
                </div>
                <div class="hidden md:block w-1 h-44 border-dashed border-r-2 border-[#C0C0CE]"></div>

                <div class="flex flex-col items-center justify-center gap-3">
                  <p class="text-5xl sm:text-6xl xl:text-7xl font-bold text-[#7BA5B0]"
                    style="font-family: 'Fredericka the Great';">{{ $total_event  }}</p>
                  <p class="font-semibold text-[#3E5467] text-xl sm:text-2xl" style="font-family: 'Fredoka';">Event</p>
                  <p class="text-[#A2A2BD] max-w-60 sm:max-w-72 sm:text-base">Lorem Ipsum Dolor Sit Amet Consectetur
                    Adipsing Elit</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Testimonial Section -->
    <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto">
      <div class="text-center">
        <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Testimonial</p>
        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">Cerita Mereka Main
          Di Samoedra</h1>
      </div>

      <div class="mt-10 overflow-x-auto flex space-x-6 no-scrollbar">
        <!-- Testimoni 1 -->
        <div class="w-96 items-center border-2 min-h-52 border-orange-300 border-dashed rounded-4xl p-7 flex-shrink-0">
          <div class="flex items-center space-x-4">
            <div class="relative">
              <img src="images/assets/iky.png" alt="Rizqi Irkham" class="w-14 h-14 rounded-full object-cover" />
              <span
                class="absolute -top-2 -left-2  border-orange-300 border-2 border-dashed  text-white text-lg font-bold rounded-full w-7 h-7 items-center justify-center flex text-center">
                <span
                  class="bg-orange-300 text-white text-lg font-bold rounded-full w-5 h-5 items-center justify-center flex text-center"><img
                    class="w-[10px]" src="images/assets/" .svg" alt=""></span></span>
            </div>
            <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Rizqi Irkham</h3>
          </div>
          <p class="mt-5 text-[#A2A2BD]">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
            itaque.
          </p>
        </div>
        <!-- Testimoni 2 -->
        <div class="w-96 items-center border-2 min-h-52 border-orange-300 border-dashed rounded-4xl p-7 flex-shrink-0">
          <div class="flex items-center space-x-4">
            <div class="relative">
              <img src="images/assets/iky.png" alt="Rizqi Irkham" class="w-14 h-14 rounded-full object-cover" />
              <span
                class="absolute -top-2 -left-2  border-orange-300 border-2 border-dashed  text-white text-lg font-bold rounded-full w-7 h-7 items-center justify-center flex text-center">
                <span
                  class="bg-orange-300 text-white text-lg font-bold rounded-full w-5 h-5 items-center justify-center flex text-center"><img
                    class="w-[10px]" src="images/assets/" .svg" alt=""></span></span>
            </div>
            <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Rizqi Irkham</h3>
          </div>
          <p class="mt-5 text-[#A2A2BD]">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
            itaque.
          </p>
        </div>

        <!-- Testimoni 3 -->
        <div class="w-96 items-center border-2 min-h-52 border-orange-300 border-dashed rounded-4xl p-7 flex-shrink-0">
          <div class="flex items-center space-x-4">
            <div class="relative">
              <img src="images/assets/iky.png" alt="Rizqi Irkham" class="w-14 h-14 rounded-full object-cover" />
              <span
                class="absolute -top-2 -left-2  border-orange-300 border-2 border-dashed  text-white text-lg font-bold rounded-full w-7 h-7 items-center justify-center flex text-center">
                <span
                  class="bg-orange-300 text-white text-lg font-bold rounded-full w-5 h-5 items-center justify-center flex text-center"><img
                    class="w-[10px]" src="images/assets/" .svg" alt=""></span></span>
            </div>
            <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Rizqi Irkham</h3>
          </div>
          <p class="mt-5 text-[#A2A2BD]">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
            itaque.
          </p>
        </div>

        <!-- Testimoni 4 -->
        <div class="w-96 items-center border-2 min-h-52 border-orange-300 border-dashed rounded-4xl p-7 flex-shrink-0">
          <div class="flex items-center space-x-4">
            <div class="relative">
              <img src="images/assets/iky.png" alt="Rizqi Irkham" class="w-14 h-14 rounded-full object-cover" />
              <span
                class="absolute -top-2 -left-2  border-orange-300 border-2 border-dashed  text-white text-lg font-bold rounded-full w-7 h-7 items-center justify-center flex text-center">
                <span
                  class="bg-orange-300 text-white text-lg font-bold rounded-full w-5 h-5 items-center justify-center flex text-center"><img
                    class="w-[10px]" src="images/assets/" .svg" alt=""></span></span>
            </div>
            <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Rizqi Irkham</h3>
          </div>
          <p class="mt-5 text-[#A2A2BD]">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
            itaque.
          </p>
        </div>
        <!-- Testimoni 5 -->
        <div class="w-96 items-center border-2 min-h-52 border-orange-300 border-dashed rounded-4xl p-7 flex-shrink-0">
          <div class="flex items-center space-x-4">
            <div class="relative">
              <img src="images/assets/iky.png" alt="Rizqi Irkham" class="w-14 h-14 rounded-full object-cover" />
              <span
                class="absolute -top-2 -left-2  border-orange-300 border-2 border-dashed  text-white text-lg font-bold rounded-full w-7 h-7 items-center justify-center flex text-center">
                <span
                  class="bg-orange-300 text-white text-lg font-bold rounded-full w-5 h-5 items-center justify-center flex text-center"><img
                    class="w-[10px]" src="images/assets/" .svg" alt=""></span></span>
            </div>
            <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Rizqi Irkham</h3>
          </div>
          <p class="mt-5 text-[#A2A2BD]">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
            itaque.
          </p>
        </div>
      </div>

      <div class="flex flex-row gap-3 items-center mt-6">
        <p class="text-left text-[#A2A2BD] mt-1.5" style="font-family: 'Fuzzy Bubbles';">Tips : Scroll Horizontal</p>
        <svg width="9" height="19" viewBox="0 0 9 19" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M0 1.55281L1.33853 0L8.62916 8.46284C8.74668 8.59844 8.83995 8.75969 8.90359 8.93732C8.96724 9.11494 9 9.30542 9 9.4978C9 9.69018 8.96724 9.88067 8.90359 10.0583C8.83995 10.2359 8.74668 10.3972 8.62916 10.5328L1.33853 19L0.00126076 17.4472L6.84403 9.5L0 1.55281Z"
            fill="#A2A2BD" />
        </svg>
      </div>

    </div>
    <!-- FAQ Section -->
    <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto py-20">
      <div class="text-center">
        <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">FAQ</p>
        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">Pertanyaan Sering
          Ditanyakan</h1>
      </div>
      <div class="flex flex-col md:flex-row justify-between items-center md:py-16">
        <!-- Container dengan clip-path -->
        <div class="w-full md:w-1/2 relative">
          <div class="w-full max-w-[500px] h-[500px] mx-auto p-3 xl:p-5 bg-[#91CFE0] mask-faq relative z-10">
            <div class="mask-faq h-full">
              <img src="images/assets/img_faq.png" class="w-full h-full object-cover object-center" alt="">
            </div>
          </div>
          <img src="images/assets/vector_line_faq.svg" alt="Vector FAQ"
            class="absolute w-full max-w-[540px] h-[540px] -z-10 mx-auto bottom-0 left-0 right-0 top-1">
          <img src="images/assets/ikan_pari.svg" alt="Ikan Pari"
            class="absolute top-15 md:left-10 md:top-7 animate-float w-32 md:w-52">
          <img src="images/assets/ikan_biru.svg" alt="Ikan Biru"
            class="absolute bottom-10 right-0 md:right-12 md:bottom-0 animate-float-ikan w-24 md:w-44">
        </div>

        <!-- FAQ Items -->
        <div class="mt-6 space-y-6 w-full md:w-1/2">
          <!-- FAQ Item 1 -->
          <div class="faq-item bg-[#EFF5F6] px-6 py-4 rounded-2xl cursor-pointer transition-all duration-300"
            onclick="toggleFAQ(1)">
            <div class="flex justify-between items-center">
              <span class="font-semibold text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">Lorem ipsum dolar
                siamet naon</span>
              <div
                class="w-7 h-7 aspect-square flex items-center justify-center rounded-full bg-[#E8A26A] transition-transform duration-300"
                id="icon-1">
                <svg width="16" height="10" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.0957 2L10.6016 10L2.10751 2" stroke="#F3EEE6" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <p class="mt-2 text-[#A2A2BD] max-w-xl hidden transition-all duration-300 overflow-hidden max-h-0"
              id="desc-1">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
              itaque. Numquam natus commodi Facere sequi voluptatem abuis. Lorem, ipsum dolor sit Lorem, ipsum dolor sit
              e sequi voluptatem abuis.
            </p>
          </div>

          <!-- FAQ Item 2 -->
          <div class="faq-item bg-[#EFF5F6] px-6 py-4 rounded-2xl cursor-pointer transition-all duration-300"
            onclick="toggleFAQ(2)">
            <div class="flex justify-between items-center">
              <span class="font-semibold text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">Lorem ipsum dolar
                siamet naon</span>
              <div
                class="w-7 h-7 aspect-square flex items-center justify-center rounded-full bg-[#E8A26A] transition-transform duration-300"
                id="icon-2">
                <svg width="16" height="10" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.0957 2L10.6016 10L2.10751 2" stroke="#F3EEE6" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <p class="mt-2 text-[#A2A2BD] max-w-xl hidden transition-all duration-300 overflow-hidden max-h-0"
              id="desc-2">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
              itaque. Numquam natus commodi Facere sequi voluptatem abuis. Lorem, ipsum dolor sit Lorem, ipsum dolor sit
              e sequi voluptatem abuis.
            </p>
          </div>

          <!-- FAQ Item 3 -->
          <div class="faq-item bg-[#EFF5F6] px-6 py-4 rounded-2xl cursor-pointer transition-all duration-300"
            onclick="toggleFAQ(3)">
            <div class="flex justify-between items-center">
              <span class="font-semibold text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">Lorem ipsum dolar
                siamet naon</span>
              <div
                class="w-7 h-7 aspect-square flex items-center justify-center rounded-full bg-[#E8A26A] transition-transform duration-300"
                id="icon-3">
                <svg width="16" height="10" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.0957 2L10.6016 10L2.10751 2" stroke="#F3EEE6" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <p class="mt-2 text-[#A2A2BD] max-w-xl hidden transition-all duration-300 overflow-hidden max-h-0"
              id="desc-3">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
              itaque. Numquam natus commodi Facere sequi voluptatem abuis. Lorem, ipsum dolor sit Lorem, ipsum dolor sit
              e sequi voluptatem abuis.
            </p>
          </div>

          <!-- FAQ Item 4 -->
          <div class="faq-item bg-[#EFF5F6] px-6 py-4 rounded-2xl cursor-pointer transition-all duration-300"
            onclick="toggleFAQ(4)">
            <div class="flex justify-between items-center">
              <span class="font-semibold text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">Lorem ipsum dolar
                siamet naon</span>
              <div
                class="w-7 h-7 aspect-square flex items-center justify-center rounded-full bg-[#E8A26A] transition-transform duration-300"
                id="icon-4">
                <svg width="16" height="10" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.0957 2L10.6016 10L2.10751 2" stroke="#F3EEE6" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <p class="mt-2 text-[#A2A2BD] max-w-xl hidden transition-all duration-300 overflow-hidden max-h-0"
              id="desc-4">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere sequi voluptatem ab, sint illum aliquam
              itaque. Numquam natus commodi Facere sequi voluptatem abuis. Lorem, ipsum dolor sit Lorem, ipsum dolor sit
              e sequi voluptatem abuis.
            </p>
          </div>
          <div class="border-t-[0.5px] w-full h-32 mt-3 border-slate-200">
            <p class="text-2xl pt-3 text-[#3E5467] font-bold">Faq Layanan</p>
            <p class="text-[#A2A2BD]">Pertanyaan pertanyaan seputar layanan Rumah Samoedra </p>
            <a href="{{route ('faq')}}"><p class="text-[#E8A26A] font-bold pt-4">Lihat Lainnya</p></a>
          </div>

        </div>
      </div>
    </div>
    @include('components.footer-fe')

  </section>


<script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
