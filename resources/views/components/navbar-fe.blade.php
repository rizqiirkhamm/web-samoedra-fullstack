<div class="relative w-full overflow-x-hidden">
    <!-- SVG Background -->
    <svg width="3488" height="71" viewBox="0 0 3488 71" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M69.5 70.5C34.5 70.5 -21 44.5 -21 44.5V0H3508V70.5H3466.5C3443 70.5 3415 53 3384.5 53C3354 53 3343.5 70.5 3299 70.5C3254.5 70.5 3237.5 53 3192.5 53C3147.5 53 3142.5 70.5 3096.5 70.5C3050.5 70.5 3029 53 2979.5 53C2930 53 2916.5 70.5 2880.5 70.5C2844.5 70.5 2825 53 2784 53C2743 53 2742.5 70.5 2701 70.5C2659.5 70.5 2645.5 53 2603.5 53C2561.5 53 2558 70.5 2513.5 70.5C2469 70.5 2451.5 53 2408 53C2364.5 53 2377 70.5 2337 70.5C2297 70.5 2284.5 53 2243.5 53C2202.5 53 2204.5 70.5 2161 70.5C2117.5 70.5 2113.5 53 2067.5 53C2021.5 53 2026.5 70.5 1975.5 70.5C1924.5 70.5 1926 53 1874 53C1822 53 1819.5 70.5 1769 70.5C1718.5 70.5 1717 53 1669 53C1621 53 1602.5 70.5 1567.5 70.5C1532.5 70.5 1494.5 53 1453 53C1411.5 53 1385.5 70.5 1352 70.5C1318.5 70.5 1288.5 53 1250 53C1211.5 53 1192.5 70.5 1153 70.5C1113.5 70.5 1096 53 1056 53C1016 53 999 70.5 969 70.5C939 70.5 928 53 888.5 53C849 53 850.5 70.5 811 70.5C771.5 70.5 757 53 713.5 53C670 53 674.5 70.5 631 70.5C587.5 70.5 577.5 53 535 53C492.5 53 484.5 70.5 446 70.5C407.5 70.5 388 53 343.5 53C299 53 294 70.5 249.5 70.5C205 70.5 200.5 53 153 53C105.5 53 104.5 70.5 69.5 70.5Z"
        fill="#CFE1E4" class="hidden lg:flex" />
    </svg>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
      class="fixed top-0 left-0 h-screen md:hidden w-full bg-white transform -translate-x-full transition-transform duration-300 ease-in-out z-40 flex items-center justify-center">
      <!-- Tombol Close yang terpisah -->
      <button id="menu-button" class="absolute top-8 right-8 focus:outline-none z-50">
        <svg id="hamburger-icon" class="w-6 h-6 text-[#3E5467]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
          </path>
        </svg>
        <svg id="close-icon" class="w-6 h-6 hidden text-[#3E5467]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
          </path>
        </svg>
      </button>
      <ul class="space-y-7 text-center w-full">
        <li><a href="{{ route('home') }}"
            class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Home</a>
        </li>
        <li><a href="{{ route('tentang') }}"
            class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Tentang</a>
        </li>
        <li><a href="{{ route('program') }}"
            class="text-[#3E5467] font-semibold text-xl block hover:text-[#BDBDCB] transition-all duration-300">Layanan</a>
        </li>
        <li class="relative">
          <button id="mobile-dropdown-trigger"
            class="text-[#3E5467] text-xl font-semibold flex items-center justify-center hover:text-[#BDBDCB] transition-all duration-300 w-full gap-2">
            Informasi
            <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div id="mobile-dropdown-content" class="hidden w-full py-3 space-y-2">
            <a href="{{ route('artikel') }}"
              class="block text-[#3E5467] hover:text-[#BDBDCB] transition-all duration-300 text-lg ml-10">Artikel</a>
            <a href="{{ route('galeri') }}"
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
  <!-- Nav Content -->
<nav class="relative w-full lg:px-0 px-8 lg:w-3/4 mx-auto flex justify-between items-center py-3 translate-y-[-50px] lg:translate-y-0">
    <div>
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/assets/samoedra_logo.png') }}" alt="Logo" class="h-11 md:h-13">
        </a>
    </div>

    <!-- Mobile Menu Trigger -->
    <div class="md:hidden items-center flex">
        <button id="mobile-menu-trigger" class="focus:outline-none z-50">
            <svg class="w-6 h-6 text-[#3E5467]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Desktop Menu -->
    <div class="hidden md:flex md:space-x-7">
        <ul class="flex space-x-7">
            <li>
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} hover:text-[#3E5467] transition-all duration-300 font-medium">
                   Home
                </a>
            </li>
            <li>
                <a href="{{ route('tentang') }}"
                   class="{{ request()->routeIs('tentang') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} hover:text-[#3E5467] transition-all duration-300 font-medium">
                   Tentang
                </a>
            </li>
            <li>
                <a href="{{ route('program') }}"
                   class="{{ request()->routeIs('program') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} hover:text-[#3E5467] transition-all duration-300 font-medium">
                   Layanan
                </a>
            </li>
            <li class="relative group">
                <a href="#"
                   class="{{ request()->routeIs('artikel', 'galeri') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} gap-2 group-hover:text-[#3E5467] transition-all duration-300 font-medium flex items-center">
                   Informasi
                   <svg width="8" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M0.999999 1L7 7L13 1"
                             stroke="{{ request()->routeIs('artikel', 'galeri') ? '#3E5467' : '#A2A2BD' }}"
                             class="group-hover:stroke-[#3E5467] transition-all duration-300"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                   </svg>
                </a>
                <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 absolute left-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl transition-all duration-300 ease-in-out z-50">
                    <a href="{{ route('artikel') }}">
                        <div class="p-2">
                            <p class="block px-3 py-1 text-[#3E5467] hover:bg-[#CFE1E4] transition-all duration-300 rounded-xl">
                                Artikel
                            </p>
                        </div>
                    </a>
                    <a href="{{ route('galeri') }}">
                        <div class="p-2 -mt-3">
                            <p class="block px-3 py-1 text-[#3E5467] hover:bg-[#CFE1E4] transition-all duration-300 rounded-xl">
                                Galeri
                            </p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <div class="hidden xl:block">
        <a href="{{ route('welcome') }}">
            <button class="bg-[#3E5467] cursor-pointer rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">
                Daftar
                <svg width="21" height="10" viewBox="0 0 21 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </a>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed top-0 left-0 h-screen md:hidden w-full bg-white transform -translate-x-full transition-transform duration-300 ease-in-out z-40 flex items-center justify-center">
    <!-- Close Button -->
    <button id="menu-button" class="absolute top-8 right-8 focus:outline-none z-50">
        <svg id="hamburger-icon" class="w-6 h-6 text-[#3E5467]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="close-icon" class="w-6 h-6 hidden text-[#3E5467]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <ul class="space-y-7 text-center w-full">
        <li>
            <a href="{{ route('welcome') }}"
               class="{{ request()->routeIs('home') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} font-semibold text-xl block hover:text-[#3E5467] transition-all duration-300">
               Home
            </a>
        </li>
        <li>
            <a href="{{ route('tentang') }}"
               class="{{ request()->routeIs('tentang') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} font-semibold text-xl block hover:text-[#3E5467] transition-all duration-300">
               Tentang
            </a>
        </li>
        <li>
            <a href="{{ route('program') }}"
               class="{{ request()->routeIs('program') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} font-semibold text-xl block hover:text-[#3E5467] transition-all duration-300">
               Layanan
            </a>
        </li>
        <li class="relative">
            <button id="mobile-dropdown-trigger"
                class="{{ request()->routeIs('artikel', 'galeri') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} text-xl font-semibold flex items-center justify-center hover:text-[#3E5467] transition-all duration-300 w-full gap-2">
                Informasi
                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="mobile-dropdown-content" class="hidden w-full py-3 space-y-2">
                <a href="{{ route('artikel') }}"
                   class="block {{ request()->routeIs('artikel') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} hover:text-[#3E5467] transition-all duration-300 text-lg ml-10">
                   Artikel
                </a>
                <a href="{{ route('galeri') }}"
                   class="block {{ request()->routeIs('galeri') ? 'text-[#3E5467]' : 'text-[#BDBDCB]' }} hover:text-[#3E5467] transition-all duration-300 text-lg ml-10">
                   Galeri
                </a>
            </div>
        </li>
    </ul>
</div>
