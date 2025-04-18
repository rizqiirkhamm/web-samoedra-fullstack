<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rumah Samoedra</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Fredoka:wght@300..700&family=Fuzzy+Bubbles:wght@400;700&family=Onest:wght@100..900&display=swap"
    rel="stylesheet">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
    </head>

<body>
  <!-- Navbar Section -->
  @include('components.navbar-fe')

  <div class="w-full ">
    <!-- Overlay & Text -->
    <div class="w-full h-110 flex flex-col items-center justify-center text-white text-center"
      style="background-image: url('{{ asset('images/assets/banner.png') }}'); background-repeat: no-repeat; background-position: center;">
      <h1 class="text-white font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Tentang Kami</h1>
      <p class="mt-5 duration-300 text-xl" style="font-family: 'Fuzzy Bubbles';">
        <span class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Home →</span>
        Tentang Kami
      </p>
    </div>
  </div>
  <div class="overflow-hidden md:w-3/4 w-full px-8 md:px-0 mx-auto duration-300 md:flex py-20">
    <div class="w-full duration-300 lg:w-1/2 flex items-center justify-start relative">
      <img class="absolute w-full items-center justify-center z-[-10] -left-30 -top-20" src="{{ asset('images/assets/line1.png') }}" alt="">

      <!-- Container untuk gambar utama dan line1.png -->
      <div
        class=" w-full lg:w-[70%] p-3 h-auto bg-[#91CFE0] rounded-tl-[130px] md:rounded-tl-[170px] rounded-br-[130px] items-center justify-center md:rounded-br-[170px] lg:rounded-tl-[190px] lg:rounded-br-[190px] rounded-tr-[70px] rounded-bl-[70px] relative">
        <img src="{{ asset('images/assets/lumba2.svg') }}" alt="Lumba Lumba"
          class=" z-10 duration-300 absolute w-28 md:w-28 lg:w-36 -bottom-20 md:-bottom-40 -left-5 md:-left-25 rotate-0 transform -translate-y-1/2">
        <img src="{{ asset('images/assets/bintang_laut_pink.svg') }}" alt="Bintang Pink"
          class=" z-10 duration-300 absolute w-16 md:w-28 lg:w-28 -bottom-12 right-0 md:-right-30 rotate-0 transform -translate-y-1/2">
          <img src="{{ asset('images/assets/cumi.svg') }}" alt="Cumi"
          class=" z-[-10] duration-300 absolute w-24 md:w-28 lg:w-48 -right-10 md:-top-2 md:-right-16 -rotate-18 transform -translate-y-1/2">



        <!-- Container gambar dengan aspect ratio 1:1 -->
        <div
          class="w-full  pb-[100%] items-center justify-center bg-slate-300  rounded-tl-[130px] md:rounded-tl-[170px] rounded-br-[130px] md:rounded-br-[170px] lg:rounded-tl-[190px] lg:rounded-br-[190px] rounded-tr-[70px] rounded-bl-[70px] relative ">
          <img
            class="absolute w-full h-full object-cover rounded-tl-[130px] md:rounded-tl-[170px] rounded-br-[130px] md:rounded-br-[170px] lg:rounded-tl-[190px] lg:rounded-br-[190px] rounded-tr-[70px] rounded-bl-[70px] "
            src="{{ isset($tentangData['image_sambutan']) && Storage::disk('public')->exists($tentangData['image_sambutan'])
                ? asset('storage/' . $tentangData['image_sambutan'])
                : asset('images/assets/img1.png') }}" alt="Img Layanan">
        </div>
      </div>
    </div>

    <div class="w-full duration-300 flex flex-col items-start justify-center lg:w-1/2 mt-16 md:mt-0 lg:pl-8">
      <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles';">Rumah Samoedra</p>
      <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Sambutan Lembaga
      </h1>
      <div class="flex items-center gap-2">
        <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Rumah</h1>
        <img src="{{ asset('images/assets/text_samoedra.png') }}" class="h-13 xl:h-18" alt="Samoedra">
      </div>
      <p class="mt-5 text-[#A2A2BD] mb-3">{{ $tentangData['sambutan_lembaga'] }}</p>

    </div>
  </div>
  <section
    class="md:w-3/4 md:px-0 px-8 w-full mx-auto py-3 grid grid-cols-1 duration-300 md:grid-cols-2 gap-10 items-center">
    <div class="flex flex-col items-start justify-start">
      <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles';">Tentang Kami</p>
      <h2 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Tempat
        nya Bermain & Belajar Suka Suka</h2>
      <p class="text-[#A2A2BD] mt-4 text-lg">{!! $tentangData['tempat_bermain'] !!}</p>
      <div class="flex gap-5 mt-6">
        <a href="#">
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
    <div class="space-y-8">
      <div class="flex items-center space-x-8">
        <div class="bg-[#F3EEE6] w-20 h-20 flex items-center justify-center rounded-xl aspect-square">
          <svg width="46" height="46" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M20.1811 8.2561L11.0076 4.58667L1.83398 8.2561L11.0076 11.9255L20.1811 8.2561ZM20.1811 8.2561V13.7602"
              stroke="#3E5467" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path
              d="M5.50391 9.72412V14.6778C5.50391 15.4077 6.08381 16.1077 7.11603 16.6239C8.14826 17.14 9.54826 17.4299 11.008 17.4299C12.4678 17.4299 13.8678 17.14 14.9001 16.6239C15.9323 16.1077 16.5122 15.4077 16.5122 14.6778V9.72412"
              stroke="#3E5467" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="space-y-1">
          <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Konsep Pendidikan</h3>
          <p class="text-[#A2A2BD]">{!! $tentangData['konsep_pendidikan'] !!}</p>
        </div>
      </div>
      <div class="flex items-center space-x-8">
        <div class="bg-[#F3EEE6] w-20 h-20 flex items-center justify-center rounded-xl aspect-square">
          <svg width="38" height="36" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0ZM10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2ZM10 14C10.2652 14 10.5196 14.1054 10.7071 14.2929C10.8946 14.4804 11 14.7348 11 15C11 15.2652 10.8946 15.5196 10.7071 15.7071C10.5196 15.8946 10.2652 16 10 16C9.73478 16 9.48043 15.8946 9.29289 15.7071C9.10536 15.5196 9 15.2652 9 15C9 14.7348 9.10536 14.4804 9.29289 14.2929C9.48043 14.1054 9.73478 14 10 14ZM10 4.5C10.8423 4.50003 11.6583 4.79335 12.3078 5.3296C12.9573 5.86585 13.3998 6.61154 13.5593 7.43858C13.7188 8.26562 13.5853 9.12239 13.1818 9.86171C12.7783 10.601 12.1299 11.1768 11.348 11.49C11.2322 11.5326 11.1278 11.6014 11.043 11.691C10.999 11.741 10.992 11.805 10.993 11.871L11 12C10.9997 12.2549 10.9021 12.5 10.7272 12.6854C10.5522 12.8707 10.313 12.9822 10.0586 12.9972C9.80416 13.0121 9.55362 12.9293 9.35817 12.7657C9.16271 12.6021 9.0371 12.3701 9.007 12.117L9 12V11.75C9 10.597 9.93 9.905 10.604 9.634C10.8783 9.52446 11.1176 9.34227 11.2962 9.10699C11.4748 8.87171 11.5859 8.59222 11.6176 8.29856C11.6493 8.00489 11.6004 7.70813 11.4762 7.44014C11.352 7.17215 11.1571 6.94307 10.9125 6.77748C10.6679 6.61189 10.3829 6.51606 10.0879 6.50027C9.79295 6.48448 9.49927 6.54934 9.23839 6.68787C8.97752 6.8264 8.75931 7.03338 8.60719 7.28658C8.45508 7.53978 8.37481 7.82962 8.375 8.125C8.375 8.39022 8.26964 8.64457 8.08211 8.83211C7.89457 9.01964 7.64022 9.125 7.375 9.125C7.10978 9.125 6.85543 9.01964 6.66789 8.83211C6.48036 8.64457 6.375 8.39022 6.375 8.125C6.375 7.16359 6.75692 6.24156 7.43674 5.56174C8.11656 4.88192 9.03859 4.5 10 4.5Z"
              fill="#3E5467" />
          </svg>
        </div>
        <div class="space-y-1">
          <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Filosofi</h3>
          <p class="text-[#A2A2BD]">{!! $tentangData['filosofi'] !!}</p>
        </div>
      </div>
      <div class="flex items-center space-x-8">
        <div class="bg-[#F3EEE6] w-20 h-20 flex items-center justify-center rounded-xl aspect-square">
          <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M9 18C6.9 18 5.04167 17.3627 3.425 16.088C1.80833 14.8133 0.758333 13.184 0.275 11.2C0.208333 10.95 0.258333 10.721 0.425 10.513C0.591667 10.305 0.816667 10.184 1.1 10.15C1.36667 10.1167 1.60833 10.1667 1.825 10.3C2.04167 10.4333 2.19167 10.6333 2.275 10.9C2.675 12.4 3.5 13.625 4.75 14.575C6 15.525 7.41667 16 9 16C10.95 16 12.6043 15.321 13.963 13.963C15.3217 12.605 16.0007 10.9507 16 9C15.9993 7.04933 15.3203 5.39533 13.963 4.038C12.6057 2.68067 10.9513 2.00133 9 2C7.85 2 6.775 2.26667 5.775 2.8C4.775 3.33333 3.93333 4.06667 3.25 5H5C5.28333 5 5.521 5.096 5.713 5.288C5.905 5.48 6.00067 5.71733 6 6C5.99933 6.28267 5.90333 6.52033 5.712 6.713C5.52067 6.90567 5.28333 7.00133 5 7H1C0.716667 7 0.479333 6.904 0.288 6.712C0.0966668 6.52 0.000666667 6.28267 0 6V2C0 1.71667 0.0960001 1.47933 0.288 1.288C0.48 1.09667 0.717333 1.00067 1 1C1.28267 0.999333 1.52033 1.09533 1.713 1.288C1.90567 1.48067 2.00133 1.718 2 2V3.35C2.85 2.28333 3.88767 1.45833 5.113 0.875C6.33833 0.291667 7.634 0 9 0C10.25 0 11.421 0.237667 12.513 0.713C13.605 1.18833 14.555 1.82967 15.363 2.637C16.171 3.44433 16.8127 4.39433 17.288 5.487C17.7633 6.57967 18.0007 7.75067 18 9C17.9993 10.2493 17.762 11.4203 17.288 12.513C16.814 13.6057 16.1723 14.5557 15.363 15.363C14.5537 16.1703 13.6037 16.812 12.513 17.288C11.4223 17.764 10.2513 18.0013 9 18ZM10 8.6L12.5 11.1C12.6833 11.2833 12.775 11.5167 12.775 11.8C12.775 12.0833 12.6833 12.3167 12.5 12.5C12.3167 12.6833 12.0833 12.775 11.8 12.775C11.5167 12.775 11.2833 12.6833 11.1 12.5L8.3 9.7C8.2 9.6 8.125 9.48767 8.075 9.363C8.025 9.23833 8 9.109 8 8.975V5C8 4.71667 8.096 4.47933 8.288 4.288C8.48 4.09667 8.71733 4.00067 9 4C9.28267 3.99933 9.52033 4.09533 9.713 4.288C9.90567 4.48067 10.0013 4.718 10 5V8.6Z"
              fill="#3E5467" />
          </svg>

        </div>
        <div class="space-y-1">
          <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Sejarah</h3>
          <p class="text-[#A2A2BD]">{!! $tentangData['sejarah'] !!}</p>
        </div>
      </div>
    </div>
  </section>
  <section class="w-full h-auto relative overflow-hidden">
    <!-- Elemen hewan laut di sebelah kiri -->
    <img src="{{ asset('images/assets/kepiting.svg') }}" alt="Kepiting"
      class="duration-300 absolute w-20 md:w-36 top-80 left-0 rotate-90 transform -translate-x-6 animate-float">
    <img src="{{ asset('images/assets/kura2.svg') }}" alt="Kura-kura"
      class="duration-300 absolute w-28 md:w-36 top-[800px] -left-8 transform -translate-y-1/2 animate-float-delay -scale-x-100">
    <img src="{{ asset('images/assets/paus.svg') }}" alt="Paus"
      class="duration-300 absolute w-28 h-28 md:w-40 bottom-14 -left-7 rotate-2 transform -translate-y-1/2 animate-float">

    <!-- Elemen hewan laut di sebelah kanan -->
    <img src="{{ asset('images/assets/ikan_biru.svg') }}" alt="Ikan Biru"
      class="duration-300 absolute w-20 h-28 md:w-36 top-[550px] -right-7 rotate-2 transform -translate-y-1/2 animate-swim -scale-x-100">
    <img src="{{ asset('images/assets/lobster.svg') }}" alt="Lobster"
      class="duration-300 absolute w-28 h-28 md:w-40 bottom-150 -right-7 rotate-2 scale-x-[1] transform -translate-y-1/2 animate-float">

    <!-- Konten utama -->
    <div class="md:w-3/4 md:px-0 px-8 w-full mx-auto p-8 mt-16 text-center">
      <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles';">Organisasi Lembaga</p>
      <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Struktur
        Organisasi</h1>

      <div class="mt-9 flex flex-col items-center">
        <!-- Direktur -->
        @if(isset($organisasiData['manajemen'][0]))
        <div class="relative">
          <img src="{{ isset($organisasiData['manajemen'][0]['foto']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($organisasiData['manajemen'][0]['foto'])
                ? asset('storage/' . $organisasiData['manajemen'][0]['foto'])
                : asset($organisasiData['manajemen'][0]['foto']) }}"
                alt="{{ $organisasiData['manajemen'][0]['nama'] }}"
            class="duration-300 md:w-32 w-24 h-28 md:h-36 lg:w-40 lg:h-44 rounded-t-full border-3 p-2 object-cover border-dashed border-[#7BA5B0] mx-auto">
          <p class="font-semibold mt-2 text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">{{ $organisasiData['manajemen'][0]['nama'] }}</p>
          <p class="text-[#E8A26A]" style="font-family: 'Onest';">{{ $organisasiData['manajemen'][0]['jabatan'] }}</p>
        </div>
        @endif

        <!-- Garis ke Manager -->
        <div class="relative flex flex-col items-center my-3">
          <div class="w-3 h-3 bg-[#7BA5B0] rounded-full"></div>
          <div class="border-l-3 border-[#7BA5B0] border-dashed h-14 my-1"></div>
          <div class="w-3 h-3 bg-[#7BA5B0] rounded-full"></div>
        </div>

        <!-- Manager -->
        @if(isset($organisasiData['manajemen'][1]))
        <div class="relative">
          <img src="{{ isset($organisasiData['manajemen'][1]['foto']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($organisasiData['manajemen'][1]['foto'])
                ? asset('storage/' . $organisasiData['manajemen'][1]['foto'])
                : asset($organisasiData['manajemen'][1]['foto']) }}"
                alt="{{ $organisasiData['manajemen'][1]['nama'] }}"
            class="duration-300 md:w-32 w-24 h-28 md:h-36 lg:w-40 lg:h-44 rounded-t-full border-3 p-2 object-cover border-dashed border-[#7BA5B0] mx-auto">
          <p class="font-semibold mt-2 text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">{{ $organisasiData['manajemen'][1]['nama'] }}</p>
          <p class="text-[#E8A26A]" style="font-family: 'Onest';">{{ $organisasiData['manajemen'][1]['jabatan'] }}</p>
        </div>
        @endif

        <!-- Garis ke Teachers -->
        <div class="relative flex flex-col items-center mt-4 w-[50%] md:w-[75%]">
          <div class="w-3 h-3 bg-[#7BA5B0] rounded-full"></div>
          <div class="border-l-3 border-[#7BA5B0] border-dashed h-12 my-1"></div>
          <div class="border-b-3 border-[#7BA5B0] border-dashed w-full h-1"></div>
        </div>

        <!-- Garis ke Teachers -->
        <div class="relative flex flex-col items-center w-full">
            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-items-center">
              <div class="flex justify-center">
                <div class="border-l-3 border-[#7BA5B0] border-dashed h-16 relative">
                  <div
                    class="w-3 h-3 bg-[#7BA5B0] rounded-full absolute bottom-[-4px] left-[-2px] transform -translate-x-1/2">
                  </div>
                </div>
              </div>
              <div class="flex justify-center">
                <div class="border-l-3 border-[#7BA5B0] border-dashed h-16 relative">
                  <div
                    class="w-3 h-3 bg-[#7BA5B0] rounded-full absolute bottom-[-4px] left-[-2px] transform -translate-x-1/2">
                  </div>
                </div>
              </div>
              <div class="hidden md:flex justify-center">
                <div class="border-l-3 border-[#7BA5B0] border-dashed h-16 relative">
                  <div
                    class="w-3 h-3 bg-[#7BA5B0] rounded-full absolute bottom-[-4px] left-[-2px] transform -translate-x-1/2">
                  </div>
                </div>
              </div>
              <div class="hidden md:flex justify-center">
                <div class="border-l-3 border-[#7BA5B0] border-dashed h-16 relative">
                  <div
                    class="w-3 h-3 bg-[#7BA5B0] rounded-full absolute bottom-[-4px] left-[-2px] transform -translate-x-1/2">
                  </div>
                </div>
              </div>
            </div>
          </div>

        <!-- Teachers Section -->
        <div
          class="grid w-full grid-cols-2 md:grid-cols-4 gap-6 mt-6 h-full justify-items-center place-items-center mb-28">
          <!-- Teachers -->
          @foreach($organisasiData['guru'] as $guru)
          <div class="text-center">
            <img src="{{ isset($guru['foto']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($guru['foto'])
                  ? asset('storage/' . $guru['foto'])
                  : asset($guru['foto']) }}"
                  alt="{{ $guru['nama'] }}"
              class="duration-300 md:w-32 w-24 h-28 md:h-36 lg:w-40 lg:h-44 rounded-t-full border-3 p-2 object-cover border-dashed border-[#7BA5B0] mx-auto">
            <p class="font-semibold mt-2 text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">{{ $guru['nama'] }}</p>
            <p class="text-[#E8A26A]" style="font-family: 'Onest';">{{ $guru['jabatan'] }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @include('components.footer-fe')
  </section>


<script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
