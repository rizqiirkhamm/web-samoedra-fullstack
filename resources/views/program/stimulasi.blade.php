<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $stimulasiData['title'] ?? 'Kelas Stimulasi' }}</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="icon" href="{{ asset('images/assets/logo-doang.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Fredoka:wght@300..700&family=Fuzzy+Bubbles:wght@400;700&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Set default data jika $stimulasiData belum ada -->


    <!-- Navbar Section -->
    @include('components.navbar-detail')


    <section id="home">
        <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto md:py-24 relative z-10">
            <div class="flex justify-center flex-col items-center">
                <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-center"
                    style="font-family: 'Fredoka';">Halo👋🏻,
                    Selamat Datang <br> Di {{ $stimulasiData['title'] }}
                </h1>
                <div class="flex gap-5 mt-10">
                    <a href="{{ route('program') }}" class="border-[1.5px]  rounded-full bg-[#3E5467] hover:bg-[#BDBDCB] flex items-center gap-2 text-white px-4 py-3 transition-all duration-300 ">
                        <svg fill="#ffff" height="25px" width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 219.151 219.151" xml:space="preserve" stroke="#3E5467"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M109.576,219.151c60.419,0,109.573-49.156,109.573-109.576C219.149,49.156,169.995,0,109.576,0S0.002,49.156,0.002,109.575 C0.002,169.995,49.157,219.151,109.576,219.151z M109.576,15c52.148,0,94.573,42.426,94.574,94.575 c0,52.149-42.425,94.575-94.574,94.576c-52.148-0.001-94.573-42.427-94.573-94.577C15.003,57.427,57.428,15,109.576,15z"></path> <path d="M94.861,156.507c2.929,2.928,7.678,2.927,10.606,0c2.93-2.93,2.93-7.678-0.001-10.608l-28.82-28.819l83.457-0.008 c4.142-0.001,7.499-3.358,7.499-7.502c-0.001-4.142-3.358-7.498-7.5-7.498l-83.46,0.008l28.827-28.825 c2.929-2.929,2.929-7.679,0-10.607c-1.465-1.464-3.384-2.197-5.304-2.197c-1.919,0-3.838,0.733-5.303,2.196l-41.629,41.628 c-1.407,1.406-2.197,3.313-2.197,5.303c0.001,1.99,0.791,3.896,2.198,5.305L94.861,156.507z"></path> </g> </g></svg>
                        Kembali
                    </a>
                    <a href="https://wa.me/6289611111153" class="flex space-x-2 items-center">
                        <svg width="28" height="28" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_68_61" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="32" height="33">
                                <path d="M0 0.5H32V32.5H0V0.5Z" fill="white" />
                            </mask>
                            <g mask="url(#mask0_68_61)">
                                <path
                                    d="M19.0147 0.735802L18.0547 0.601065C15.1696 0.184488 12.2254 0.59661 9.56553 1.78939C6.90564 2.98216 4.6396 4.90645 3.03158 7.33791C1.32068 9.66208 0.300775 12.4221 0.0892282 15.3003C-0.122319 18.1786 0.483092 21.058 1.83579 23.6074C1.97423 23.8629 2.06042 24.1434 2.08933 24.4326C2.11825 24.7217 2.08931 25.0137 2.00421 25.2916C1.31368 27.6663 0.673684 30.0579 0 32.5674L0.842105 32.3147C3.11579 31.7084 5.38947 31.1021 7.66316 30.5463C8.14306 30.4466 8.64188 30.4935 9.09474 30.6811C11.1346 31.6766 13.3639 32.2244 15.6329 32.2875C17.9019 32.3506 20.1582 31.9276 22.2503 31.0469C24.3424 30.1663 26.2219 28.8483 27.7627 27.1815C29.3035 25.5146 30.4699 23.5375 31.1837 21.3828C31.8975 19.228 32.1422 16.9456 31.9013 14.6885C31.6603 12.4314 30.9394 10.252 29.7868 8.29648C28.6343 6.34097 27.0768 4.65461 25.2189 3.35058C23.3609 2.04655 21.2456 1.15501 19.0147 0.735802ZM23.2589 22.8326C22.6468 23.3807 21.9004 23.7567 21.0957 23.9224C20.291 24.088 19.4567 24.0375 18.6779 23.7758C15.1494 22.7807 12.088 20.5667 10.0379 17.5274C9.25503 16.4522 8.62582 15.2731 8.16842 14.0242C7.92059 13.2996 7.8759 12.521 8.0392 11.7728C8.20249 11.0246 8.56754 10.3355 9.09474 9.78001C9.35139 9.45246 9.70074 9.20979 10.0973 9.08362C10.4938 8.95745 10.9192 8.95362 11.3179 9.07264C11.6547 9.15685 11.8905 9.64527 12.1937 10.0158C12.4407 10.7119 12.727 11.3912 13.0526 12.0537C13.2992 12.3914 13.4022 12.8129 13.3391 13.2263C13.276 13.6397 13.0519 14.0113 12.7158 14.26C11.9579 14.9337 12.0758 15.4895 12.6147 16.2474C13.8056 17.9645 15.4498 19.3172 17.3642 20.1547C17.9032 20.3905 18.3074 20.4411 18.6611 19.8853C18.8126 19.6663 19.0147 19.4811 19.1832 19.279C20.16 18.0495 19.8568 18.0663 21.4063 18.74C21.9004 18.9477 22.3775 19.1891 22.8379 19.4642C23.2926 19.7337 23.9832 20.02 24.0842 20.4242C24.1814 20.8627 24.1558 21.3196 24.0103 21.7445C23.8647 22.1694 23.6047 22.5459 23.2589 22.8326Z"
                                    fill="#23da57" />
                            </g>
                        </svg>
                        <h1 class="text-[#A2A2BD]">+62 896 111 111 53</h1>
                    </a>
                </div>
                <div class="flex md:flex-row justify-center items-center w-full gap-10">
                    <!-- Video/Gambar Thumbnail -->
                    <div class="w-full flex flex-col xl:flex-row gap-10 mt-10 md:mt-20">
                        <div class="w-full xl:w-9/12">
                            @if($stimulasiData['banner_type'] == 'video')
                                <div class="rounded-3xl overflow-hidden h-96">
                                    <iframe width="100%" height="100%" src="{{ str_replace('watch?v=', 'embed/', $stimulasiData['banner_video']) }}"
                                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen class="w-full h-full object-cover"></iframe>
                                </div>
                            @else
                                <img src="{{ asset(Str::startsWith($stimulasiData['banner_image'], 'images/') ? $stimulasiData['banner_image'] : 'storage/' . $stimulasiData['banner_image']) }}" alt="Samoedra Kelas Stimulasi"
                                class="rounded-3xl h-96 w-full object-cover">
                            @endif
                            <!-- Kelebihan Daycare -->
                            <h1 class="font-semibold text-[#3E5467] text-3xl xl:text-4xl mt-8"
                                style="font-family: 'Fredoka';">Apa itu kelas stimulasi ?</h1>
                            <p class="text-[#A2A2BD] mt-4" style="font-family: 'Onest';">
                                {!! $stimulasiData['description'] !!}
                            </p>
                        </div>
                        <div class="w-full xl:w-1/3">
                            <!-- Kartu Informasi -->
                            <div class="bg-[#F3EEE6] p-8 rounded-3xl">
                                <h2 class="font-semibold text-[#3E5467] text-2xl md:text-3xl mb-5"
                                    style="font-family: 'Fredoka';">About Kelas Stimulasi</h2>
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
                                            <h1 class="text-[#3E5467] font-semibold text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Usia</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">{{ $stimulasiData['age_range'] }}</p>
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
                                            <h1 class="text-[#3E5467] font-semibold text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Jam</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">{{ $stimulasiData['hours'] }}</p>
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
                                            <h1 class="text-[#3E5467] font-semibold text-xl md:text-2xl"
                                                style="font-family: 'Fredoka';">Hari</h1>
                                        </flex>
                                        <p class="text-[#A2A2BD] text-end max-w-72" style="font-family: 'Onest';">{{ $stimulasiData['days'] }}</p>
                                    </div>
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
                            <p class="text-[#E8A26A] text-xl" style="font-family: Fuzzy Bubbles;">Program Kelas
                                Stimulasi
                            </p>
                            <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-start"
                                style="font-family: 'Fredoka';"> {{ $stimulasiData['program_title'] ?? 'Kelas Stimulasi Di Rumah Samoedra' }}
                            </h1>
                            <p class="text-[#A2A2BD] max-w-xl mt-5" style="font-family: 'Onest';">{{ $stimulasiData['program_description'] ?? 'Kelas Stimulasi Rumah Samoedra dirancang untuk mendukung tumbuh kembang anak melalui aktivitas bermain yang menyenangkan dan penuh makna. Kami percaya setiap anak itu unik, dan melalui kelas ini, mereka diajak belajar, bermain, dan tumbuh bersama dalam lingkungan yang aman dan penuh kasih. Yuk, kenalkan si kecil pada dunia belajar yang seru dan interaktif bersama Rumah Samoedra!' }}</p>
                        </div>

                    </div>
                    <div class="w-full lg:w-1/2 relative flex justify-center items-center">
                        <div class="w-full max-w-[500px] h-[500px] p-3 xl:p-5 bg-[#EFF5F6] mask-faq relative z-10">
                            <div class="mask-faq h-full">
                                <img src="{{ asset(Str::startsWith($stimulasiData['program_image'], 'images/') ? $stimulasiData['program_image'] : 'storage/' . $stimulasiData['program_image']) }}"
                                    class="w-full h-full object-cover object-center" alt="">
                            </div>
                        </div>
                        <img src="{{asset('images/assets/vector_line_faq.svg')}}" alt="Vector FAQ"
                            class="absolute w-full max-w-[540px] h-[540px] -z-10 mx-auto bottom-0 left-0 right-0 top-1">
                        <img src="{{asset('images/assets/ikan_pari.svg')}}" alt="Ikan Pari"
                            class="absolute top-15 md:left-10 md:top-7 animate-float w-32 md:w-52">
                        <img src="{{asset('images/assets/ikan_biru.svg')}}" alt="Ikan Biru"
                            class="absolute bottom-10 right-0 md:right-12 md:bottom-0 animate-float-ikan w-24 md:w-44">
                    </div>
                </div>
            </section>


            <section id="informasi">
                <div class="w-full flex items-start flex-col md:flex-row mt-24">
                    <div class="w-full  px-2 flex flex-col justify-center">
                        <div class="space-y-3 lg:w-1/2">
                            <p class="text-[#E8A26A] text-xl" style="font-family: Fuzzy Bubbles;">Kegiatan Kelas
                                Stimulasi</p>
                            <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-start"
                                style="font-family: 'Fredoka';">Program Kelas Stimulasi Rumah Samoedra</h1>
                        </div>
                        <div class="space-y-4 mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                            <!-- Daftar fitur utama -->
                            @foreach($stimulasiData['program']['points'] as $index => $point)
                            <div class="flex flex-row space-x-3">
                                <div
                                    class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                    <p class="text-white font-semibold">{{ $index + 1 }}</p>
                                </div>
                                <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                    {{ $point }}</h1>
                            </div>
                            @endforeach

                        </div>
                    </div>


                </div>
            </section>



            <section id="kegiatan">
                <div class="w-full flex  mt-24">
                    <div class="w-full  flex flex-col justify-center">
                        <div class="space-y-3 lg:w-1/2">
                            <p class="text-[#E8A26A] text-xl" style="font-family: Fuzzy Bubbles;">Program Kelas
                                Stimulasi</p>
                            <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-start"
                                style="font-family: 'Fredoka';">{{ $stimulasiData['kegiatan_title'] ?? 'Kegiatan Kelas Stimulasi Rumah Samoedra' }}</h1>

                        </div>
                        <div class="kegiatan grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-12">
                            @if(isset($stimulasiData['kegiatan']) && count($stimulasiData['kegiatan']) > 0)
                                @foreach($stimulasiData['kegiatan'] as $index => $kegiatan)
                                <div class="space-y-2 mt-6 {{ $index > 0 ? 'px-5' : '' }}">
                                    <!-- Daftar fitur utama -->
                                    <div class="flex flex-row space-x-3">
                                        <div
                                            class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                            <p class="text-white font-semibold">{{ $index + 1 }}</p>
                                        </div>
                                        <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                            {{ $kegiatan['name'] }}</h1>
                                    </div>
                                    <div class="ml-5 font-medium text-slate-700">
                                        @foreach(explode("\n", $kegiatan['description']) as $line)
                                            <li>{{ $line }}</li>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="space-y-2 mt-6">
                                    <!-- Daftar fitur utama -->
                                    <div class="flex flex-row space-x-3">
                                        <div
                                            class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                            <p class="text-white font-semibold">1</p>
                                        </div>
                                        <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                            ADAPTASI SOSIAL</h1>
                                    </div>
                                    <div class="ml-5 font-medium text-slate-700">
                                        <li>Diskusi tentang pengalaman bulan Puasa & Lebaran</li>
                                        <li>⁠Praktik Bersalaman dan Bermaaf maafan</li>
                                        <li>⁠Berkenalan dengan teman baru</li>
                                        <li>Menjawab pertanyaan sederhana</li>
                                    </div>
                                </div>
                                <div class="space-y-2 mt-6 px-5">
                                    <!-- Daftar fitur utama -->
                                    <div class="flex flex-row space-x-3">
                                        <div
                                            class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                            <p class="text-white font-semibold">1</p>
                                        </div>
                                        <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                            LOGIKA MATEMATIKA
                                        </h1>
                                    </div>
                                    <div class="ml-5 font-medium text-slate-700">
                                        <li> ⁠Meniru bentuk sebuah pola menggunakan stick</li>
                                        <li>Belajar mengenal waktu Tahun, Bulan, Minggu, Hari, Jam menggunakan kalender dan jam dinding</li>
                                    </div>
                                </div>
                                <div class="space-y-2 mt-6 px-5">
                                    <!-- Daftar fitur utama -->
                                    <div class="flex flex-row space-x-3">
                                        <div
                                            class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                            <p class="text-white font-semibold">1</p>
                                        </div>
                                        <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                            FISIK MOTORIK
                                        </h1>
                                    </div>
                                    <div class="ml-5 font-medium text-slate-700">
                                        <li>Melewati rintangan sensory path</li>
                                        <li>Bermain lompat karet</li>
                                    </div>
                                </div>
                                <div class="space-y-2 mt-6 px-5">
                                    <!-- Daftar fitur utama -->
                                    <div class="flex flex-row space-x-3">
                                        <div
                                            class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                            <p class="text-white font-semibold">1</p>
                                        </div>
                                        <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                            KREATIFITAS
                                        </h1>
                                    </div>
                                    <div class="ml-5 font-medium text-slate-700">
                                        <li> ⁠Melengkapi setengah gambar dengan cara meniru gambar di sebelahnya </li>
                                    </div>
                                </div>
                                <div class="space-y-2 mt-6 px-5">
                                    <!-- Daftar fitur utama -->
                                    <div class="flex flex-row space-x-3">
                                        <div
                                            class="w-8 h-8 aspect-square bg-[#7BA5B0] rounded-xl p-1 flex justify-center items-center">
                                            <p class="text-white font-semibold">1</p>
                                        </div>
                                        <h1 class="text-[#3E5467] font-semibold text-xl" style="font-family: 'Fredoka';">
                                            FOKUS & KESEIMBANGAN
                                        </h1>
                                    </div>
                                    <div class="ml-5 font-medium text-slate-700">
                                        <li>menggulung tali dan melepaskan jepitan</li>
                                        <li>menarik bola dalam lingkaran & melemparnya </li>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

        </div>
    </section>
    </div>
    </div>
    <div class="absolute w-full h-full top-40 z-0 overflow-x-hidden">
        <img src="{{asset('images/assets/vector_line_detail_layanan.svg')}}" alt="Vector Line Detail Layanan"
            class="hidden md:block">
        <img src="{{asset('images/assets/kura2.svg')}}" alt="Kura Kura" class="w-20 md:w-40 absolute top-3 -left-7">
        <img src="{{asset('images/assets/lobster.svg')}}" alt="Lobster" class="w-20 md:w-28 absolute top-65 -right-7">
    </div>
    <section id="fasilitas">
        <div class="relative overflow-x-hidden">
            <!-- SVG Background -->

            <svg class="absolute bottom-0 left-0 w-full h-full -z-10" viewBox="0 0 2360 1040" preserveAspectRatio="none"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M204.536 6.98202C99.2828 6.98195 -22.8599 37.4186 -65.8807 116.554C-108.902 195.689 -65.8757 808.682 -65.8807 881.73C-65.8858 954.778 66.249 1040 181.489 1040C296.729 1040 387.235 977.715 505.548 977.715C623.86 977.715 710.793 1040 821.424 1040C932.054 1040 977.46 977.715 1116.51 977.715C1255.56 977.715 1286.96 1040 1402.97 1040C1518.98 1040 1547.57 977.715 1688.16 977.715C1828.76 977.715 1863.23 1040 2012.27 1040C2161.3 1040 2365.65 984.126 2365.65 899.513C2365.65 814.899 2487.12 41.0711 2328.01 6.98208C2168.9 -27.1069 2141.64 74.7078 2041 74.7078C1940.36 74.7078 1918.46 6.98202 1794 6.98202C1669.54 6.98202 1624.64 74.7078 1524 74.7078C1423.36 74.7078 1417.58 6.98202 1293.12 6.98202C1168.66 6.98202 1105.8 74.7078 1009 74.7078C912.197 74.7078 850.622 6.98202 746.137 6.98202C641.652 6.98202 559.961 74.7078 467 74.7078C374.039 74.7078 309.789 6.9821 204.536 6.98202Z"
                    fill="#EFF5F6" />
            </svg>

            <div class="w-full relative flex flex-col justify-center items-center py-28">
                <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Fasilitas</p>
                <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">
                    Kelas Stimulasi
                </h1>

                <div
                    class="md:w-3/4 w-full px-8 md:px-0 overflow-x-auto no-scrollbar mx-auto flex flex-col items-start">
                    <div class="flex flex-row gap-7 py-10 overflow-x-auto">

                        @if(isset($stimulasiData['fasilitas']) && count($stimulasiData['fasilitas']) > 0)
                            @foreach($stimulasiData['fasilitas'] as $fasilitas)
                            <!-- Card Template -->
                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="{{ asset(Str::startsWith($fasilitas['image'], 'images/') ? $fasilitas['image'] : 'storage/' . $fasilitas['image']) }}" alt="{{ $fasilitas['name'] }}"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">{{ $fasilitas['name'] }}</h1>
                            </div>
                            @endforeach
                        @else
                            <!-- Default Fasilitas -->
                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="{{asset('images/assets/img_layanan.png')}}" alt="Kelas Stimulasi"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Full AC</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="{{asset('images/assets/img_layanan.png')}}" alt="Kelas Stimulasi"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Purifier</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="{{asset('images/assets/img_layanan.png')}}" alt="Kelas Stimulasi"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">3 Kamar</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="{{asset('images/assets/img_layanan.png')}}" alt="Kelas Stimulasi"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Baby Bed</h1>
                            </div>

                            <div class="w-80 h-64 rounded-4xl bg-white p-6 flex flex-col relative">
                                <img src="{{asset('images/assets/img_layanan.png')}}" alt="Kelas Stimulasi"
                                    class="w-full h-44 rounded-3xl object-cover">
                                <h1 class="text-3xl text-[#3E5467] font-semibold text-center mt-3"
                                    style="font-family: 'Fredoka';">Outdor Area</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <img src="{{asset('images/assets/ikan_biru.svg')}}" alt="Ikan Biru"
                class="w-16 md:w-28 absolute scale-x-[-1] top-45 -right-7 rotate-45">
            <img src="{{asset('images/assets/ikan_kuning.svg')}}" alt="Ikan Kuning"
                class="w-12 md:w-20 absolute top-35 right-15">
            <img src="{{asset('images/assets/bintang_laut_pink.svg')}}" alt="Bintang Laut Kuning"
                class="w-16 md:w-20 absolute bottom-30 left-5">
            <img src="{{asset('images/assets/bintang_laut_kuning.svg')}}" alt="Bintang Laut Kuning"
                class="w-8 md:w-14 absolute bottom-22 left-17">
        </div>
    </section>

    <section id="pricelist">
        <!-- Wrapper div table-->
        <div class="w-full md:w-3/4 mx-auto px-8 md:px-0">
            <div class="flex flex-col justify-center mt-20 items-center">
                <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">{{ $stimulasiData['pricelist_subtitle'] ?? 'Pricelist' }}</p>
                <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">
                    {{ $stimulasiData['pricelist_title'] ?? 'Price List Kelas Stimulasi' }}
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
                            <th class="border border-[#E8A26A] px-4 py-3 text-center">Pertemuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($stimulasiData['pricelist_items']) && count($stimulasiData['pricelist_items']) > 0)
                            @foreach($stimulasiData['pricelist_items'] as $index => $item)
                            <tr>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $item['title'] }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $item['age_range'] }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $item['registration_fee'] }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $item['price'] }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $item['meetings'] }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">01</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $stimulasiData['title'] ?? 'Kelas Stimulasi Little Exploler' }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $stimulasiData['age_range'] }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $stimulasiData['registration_fee'] }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $stimulasiData['price'] }}</td>
                                <td class="border border-[#E8A26A] px-4 py-3 text-[#3E5467] text-center"
                                    style="font-family: 'Onest';">{{ $stimulasiData['meetings'] }}</td>
                            </tr>
                        @endif
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
                    Kelas Stimulasi
                </h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                    <!-- Debug info: {{ count($galleries) }} galleries found -->
                    @forelse($galleries as $gallery)
                    <div class="w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-80 h-52 object-cover rounded-3xl">
                        <div class="mt-4">
                            <p class="text-[#E8A26A]" style="font-family: 'Onest';">{{ $gallery->category }}</p>
                            <h3 class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';" >{{ $gallery->title }}</h3>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12">
                        <img src="{{ asset('images/assets/ikan2.svg') }}" alt="No Galleries" class="w-32 h-32 mb-4 animate-float">
                        <h3 class="text-lg font-semibold text-[#3E5467]">Belum Ada Galeri</h3>
                        <p class="text-[#A2A2BD]">Silakan kembali lagi nanti</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="flex justify-center mb-16">
            <a href="{{ route('program') }}"
                class="border-[1.5px] border-[#3E5467] rounded-full flex items-center gap-2 text-[#3E5467] px-4 py-3 transition-all duration-300 ">
                <svg fill="#3E5467" height="25px" width="25px" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 219.151 219.151" xml:space="preserve" stroke="#3E5467">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path
                                d="M109.576,219.151c60.419,0,109.573-49.156,109.573-109.576C219.149,49.156,169.995,0,109.576,0S0.002,49.156,0.002,109.575 C0.002,169.995,49.157,219.151,109.576,219.151z M109.576,15c52.148,0,94.573,42.426,94.574,94.575 c0,52.149-42.425,94.575-94.574,94.576c-52.148-0.001-94.573-42.427-94.573-94.577C15.003,57.427,57.428,15,109.576,15z">
                            </path>
                            <path
                                d="M94.861,156.507c2.929,2.928,7.678,2.927,10.606,0c2.93-2.93,2.93-7.678-0.001-10.608l-28.82-28.819l83.457-0.008 c4.142-0.001,7.499-3.358,7.499-7.502c-0.001-4.142-3.358-7.498-7.5-7.498l-83.46,0.008l28.827-28.825 c2.929-2.929,2.929-7.679,0-10.607c-1.465-1.464-3.384-2.197-5.304-2.197c-1.919,0-3.838,0.733-5.303,2.196l-41.629,41.628 c-1.407,1.406-2.197,3.313-2.197,5.303c0.001,1.99,0.791,3.896,2.198,5.305L94.861,156.507z">
                            </path>
                        </g>
                    </g>
                </svg>
                Kembali
            </a>
            <a href="{{ route('welcome') }}"
                class="bg-[#3E5467] ml-3 rounded-full flex items-center gap-2 text-white px-6 py-3 transition-all duration-300 hover:bg-[#576B81]">

                Daftar
            </a>
        </div>
        @include('components.footer-fe')
    </section>

    </section>


    <script src="{{ asset('script.js') }}"></script>
</body>

</html>
