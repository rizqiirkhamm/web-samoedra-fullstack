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

<body>
    <!-- Navbar Section -->
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
    <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto mt-14 flex flex-col justify-center items-center mb-28">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:flex justify-center gap-3 md:gap-5 max-sm:w-full">
            <div class="px-3 md:px-6 h-10 md:h-12 flex justify-center items-center bg-[#E8A26A] rounded-xl">
                <p class="text-white text-base md:text-lg font-medium whitespace-nowrap" style="font-family: 'Onest';">
                    All</p>
            </div>
            <div
                class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Daycare</p>
            </div>
            <div
                class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Area Main</p>
            </div>
            <div
                class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Bimbel</p>
            </div>
            <div
                class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Kelas Stimulasi</p>
            </div>
            <div
                class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Event</p>
            </div>
        </div>
        <div class="mt-14">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
                <div class="w-full">
                    <img src="images/assets/img_layanan.png" alt="Galeri" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">Event</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">Play date TK Alam
                        Al Majid</p>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer-fe')




  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
