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
    @php
    // Function to extract YouTube video ID from URL
    function getYoutubeVideoId($url) {
        preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return isset($matches[1]) ? $matches[1] : '';
    }
    @endphp

    <!-- Navbar Section -->
    @include('components.navbar-fe')
    <!-- Banner -->
    <div class="w-full">
        <!-- Overlay & Text -->
        <div class="w-full h-110 flex flex-col items-center justify-center text-white text-center"
            style="background-image: url('{{ asset('images/assets/banner.png') }}'); background-repeat: no-repeat; background-position: center;">
            <h1 class="text-white font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Layanan Kami</h1>
            <p class="mt-5 duration-300 text-xl" style="font-family: 'Fuzzy Bubbles';">
                <span class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Home →</span>
                Layanan Kami
            </p>
        </div>
    </div>
    <!-- Content Card -->
    <div class="w-full relative">
        <!-- Container untuk card dan hewan laut -->
        <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto relative overflow-x-hidden md:overflow-x-visible">
            <!-- Hewan laut dengan posisi relatif terhadap container -->
            <img src="{{ asset('images/assets/kura2.svg') }}" alt="Kura-kura"
                class="absolute w-28 md:w-36 top-16 -left-12 transform animate-swim">

            <img src="{{ asset('images/assets/ikan_pari.svg') }}" alt="Ikan Pari"
                class="absolute w-28 md:w-46 top-[860px] md:top-[750px] -left-10 md:-left-20 rotate-45 transform animate-float">

            <img src="{{ asset('images/assets/lobster.svg') }}" alt="Lobster"
                class="absolute w-22 md:w-30 top-[750px] -right-5 md:right-0 transform animate-float">
            <img src="{{ asset('images/assets/lumba2.svg') }}" alt="Lumba Lumba"
                class="absolute w-20 md:w-36 top-[1600px] md:top-[1500px] right-0 md:-right-5 -scale-x-[1] transform animate-swim">
            <!-- Konten card -->
            <p class="text-[#E8A26A] text-xl text-center mt-12" style="font-family: 'Fuzzy Bubbles';">Program Layanan
            </p>
            <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-center mb-12"
                style="font-family: 'Fredoka';">Rumah Samoedra</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="w-full h-180 border-3 border-[#7BA5B0] border-dashed rounded-3xl p-5 md:p-7 flex flex-col">
                    <img src="{{ asset($daycareData['banner_image']) }}" alt="Layanan Daycare" class="w-full h-96 object-cover rounded-3xl">
                    <div class="px-3">
                        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold mt-5"
                            style="font-family: 'Fredoka';">
                            Layanan Daycare</h1>
                        <div class="flex items-center gap-4 mt-4">
                            <p class="text-white bg-[#7BA5B0] px-3 py-1 rounded-xl w-fit"
                                style="font-family: 'Fredoka';">
                                {{ $daycareData['about_daycare']['details']['jam_operasional'] }}</p>
                            <p class="text-[#7BA5B0]" style="font-family: 'Fredoka';">{{ $daycareData['about_daycare']['details']['hari'] }}</p>
                        </div>
                        <p class="text-[#A2A2BD] mt-5">{{ $daycareData['kelebihan_daycare'] }}</p>
                        <div class="flex gap-5 mt-5">
                            <a href="{{ route('program.daycare') }}">
                                <button
                                    class="rounded-full cursor-pointer outline outline-[#7BA5B0] hover:outline-[#BDBDCB] flex items-center gap-2 text-[#7BA5B0] px-6 py-2 transition-all duration-300 group">
                                    <span class="group-hover:text-[#BDBDCB] transition-all duration-300">Detail</span>
                                </button>
                            </a>
                            <a href="{{route('welcome')}}">
                                <button
                                    class="bg-[#7BA5B0] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar
                                    <svg width="21" height="10" viewBox="0 0 21 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full h-180 border-3 border-[#7BA5B0] border-dashed rounded-3xl p-5 md:p-7 flex flex-col">
                    @if(isset($bermain) && isset($bermain['banner_type']))
                        @if($bermain['banner_type'] == 'video')
                            <div class="w-full h-96 rounded-3xl overflow-hidden">
                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ getYoutubeVideoId($bermain['banner_video']) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <img src="{{ asset(isset($bermain['banner_image']) ? 'storage/' . $bermain['banner_image'] : 'images/assets/img1.png') }}" alt="Area Main" class="w-full h-96 object-cover rounded-3xl">
                        @endif
                    @else
                        <img src="{{ asset('images/assets/img1.png') }}" alt="Area Main" class="w-full h-96 object-cover rounded-3xl">
                    @endif
                    <div class="px-3">
                        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold mt-5"
                            style="font-family: 'Fredoka';">
                            Area Main</h1>
                        <div class="flex items-center gap-4 mt-4">
                            <p class="text-white bg-[#7BA5B0] px-3 py-1 rounded-xl w-fit"
                                style="font-family: 'Fredoka';">
                                {{ $bermain['operating_hours'] ?? '08.00 - 15.00' }}</p>
                            <p class="text-[#7BA5B0]" style="font-family: 'Fredoka';">{{ $bermain['operating_days'] ?? 'Senin - Sabtu' }}</p>
                        </div>
                        <p class="text-[#A2A2BD] mt-5">{{ $bermain['benefit_description'] ?? 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias facere dolorem nesciunt ratione assumenda natus vitae nemo, dolores voluptatibus ipsum, numquam modi totam unde quas quaerat, rerum quasi voluptates deleniti.' }}</p>
                        <div class="flex gap-5 mt-5">
                            <a href="{{ route('program.bermain') }}">
                                <button
                                    class="rounded-full cursor-pointer outline outline-[#7BA5B0] hover:outline-[#BDBDCB] flex items-center gap-2 text-[#7BA5B0] px-6 py-2 transition-all duration-300 group">
                                    <span class="group-hover:text-[#BDBDCB] transition-all duration-300">Detail</span>
                                </button>
                            </a>
                            <a href="{{route('welcome')}}">
                                <button
                                    class="bg-[#7BA5B0] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar
                                    <svg width="21" height="10" viewBox="0 0 21 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full h-180 border-3 border-[#7BA5B0] border-dashed rounded-3xl p-5 md:p-7 flex flex-col">
                    @if($bimbelData['banner_type'] == 'video')
                        <div class="w-full h-96 rounded-3xl overflow-hidden">
                            <iframe width="100%" height="100%"
                                src="https://www.youtube.com/embed/{{ getYoutubeVideoId($bimbelData['banner_video']) }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <img src="{{ asset($bimbelData['banner_image']) }}" alt="Layanan Bimbel" class="w-full h-96 object-cover rounded-3xl">
                    @endif
                    <div class="px-3">
                        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold mt-5"
                            style="font-family: 'Fredoka';">
                            Bimbel</h1>
                        <div class="flex items-center gap-4 mt-4">
                            <p class="text-white bg-[#7BA5B0] px-3 py-1 rounded-xl w-fit"
                                style="font-family: 'Fredoka';">
                                {{ $bimbelData['operating_hours'] }}</p>
                            <p class="text-[#7BA5B0]" style="font-family: 'Fredoka';">{{ $bimbelData['operating_days'] }}</p>
                        </div>
                        <p class="text-[#A2A2BD] mt-5">{{ $bimbelData['benefit_description'] }}</p>
                        <div class="flex gap-5 mt-5">
                            <a href="{{ route('program.bimbel') }}">
                                <button
                                    class="rounded-full cursor-pointer outline outline-[#7BA5B0] hover:outline-[#BDBDCB] flex items-center gap-2 text-[#7BA5B0] px-6 py-2 transition-all duration-300 group">
                                    <span class="group-hover:text-[#BDBDCB] transition-all duration-300">Detail</span>
                                </button>
                            </a>
                            <a href="{{route('welcome')}}">
                                <button
                                    class="bg-[#7BA5B0] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar
                                    <svg width="21" height="10" viewBox="0 0 21 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full h-180 border-3 border-[#7BA5B0] border-dashed rounded-3xl p-5 md:p-7 flex flex-col">
                    <img src="{{ asset($stimulasiData['banner_image']) }}" alt="Layanan Kelas Stimulasi" class="w-full h-96 object-cover rounded-3xl">
                    <div class="px-3">
                        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold mt-5"
                            style="font-family: 'Fredoka';">
                            Kelas Stimulasi</h1>
                        <div class="flex items-center gap-4 mt-4">
                            <p class="text-white bg-[#7BA5B0] px-3 py-1 rounded-xl w-fit"
                                style="font-family: 'Fredoka';">
                                {{ $stimulasiData['hours'] }}</p>
                            <p class="text-[#7BA5B0]" style="font-family: 'Fredoka';">{{ $stimulasiData['days'] }}</p>
                        </div>
                        <p class="text-[#A2A2BD] mt-5">{{ $stimulasiData['description'] }}</p>
                        <div class="flex gap-5 mt-5">
                            <a href="{{ route('program.stimulasi') }}">
                                <button
                                    class="rounded-full cursor-pointer outline outline-[#7BA5B0] hover:outline-[#BDBDCB] flex items-center gap-2 text-[#7BA5B0] px-6 py-2 transition-all duration-300 group">
                                    <span class="group-hover:text-[#BDBDCB] transition-all duration-300">Detail</span>
                                </button>
                            </a>
                            <a href="{{route('welcome')}}">
                                <button
                                    class="bg-[#7BA5B0] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar
                                    <svg width="21" height="10" viewBox="0 0 21 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full h-180 border-3 border-[#7BA5B0] border-dashed rounded-3xl p-5 md:p-7 flex flex-col">
                    @if(isset($data['events']) && count($data['events']) > 0)
                        @php
                            // Ambil event terbaru (item pertama)
                            $latestEvent = $data['events'][0];
                        @endphp

                        @if($latestEvent['banner_type'] == 'video')
                            <div class="w-full h-96 rounded-3xl overflow-hidden">
                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ getYoutubeVideoId($latestEvent['banner_video']) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <img src="{{ asset($latestEvent['banner_image']) }}" alt="Layanan Event" class="w-full h-96 object-cover rounded-3xl">
                        @endif
                    @else
                        <img src="{{ asset('images/assets/img1.png') }}" alt="Layanan Event" class="w-full h-96 object-cover rounded-3xl">
                    @endif
                    <div class="px-3">
                        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold mt-5"
                            style="font-family: 'Fredoka';">
                            Layanan Event</h1>

                        @if(isset($data['events']) && count($data['events']) > 0)
                            @php
                                $latestEvent = $data['events'][0];
                                $firstDescription = isset($latestEvent['descriptions'][0]) ? $latestEvent['descriptions'][0]['content'] : '';
                            @endphp
                            <div class="flex items-center gap-4 mt-4">
                                @if(isset($latestEvent['about_event']['tanggal']))
                                    <p class="text-white bg-[#7BA5B0] px-3 py-1 rounded-xl w-fit"
                                        style="font-family: 'Fredoka';">{{ $latestEvent['about_event']['tanggal'] }}</p>
                                @endif
                                @if(isset($latestEvent['about_event']['kegiatan']))
                                    <p class="text-[#7BA5B0]" style="font-family: 'Fredoka';">{{ $latestEvent['about_event']['kegiatan'] }}</p>
                                @endif
                            </div>
                            <p class="text-[#A2A2BD] mt-5">{{ $firstDescription }}</p>
                        @else
                            <p class="text-[#A2A2BD] mt-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias
                                facere dolorem nesciunt ratione assumenda natus vitae nemo, dolores voluptatibus ipsum,
                                numquam
                                modi totam unde quas quaerat, rerum quasi voluptates deleniti.</p>
                        @endif
                        <div class="flex gap-5 mt-5">
                            <a href="{{ route('program.event') }}">
                                <button
                                    class="rounded-full cursor-pointer outline outline-[#7BA5B0] hover:outline-[#BDBDCB] flex items-center gap-2 text-[#7BA5B0] px-6 py-2 transition-all duration-300 group">
                                    <span class="group-hover:text-[#BDBDCB] transition-all duration-300">Detail</span>
                                </button>
                            </a>
                            <a href="{{route('welcome')}}">
                                <button
                                    class="bg-[#7BA5B0] rounded-full flex items-center gap-2 text-white px-6 py-2 transition-all duration-300 hover:bg-[#BDBDCB]">Daftar
                                    <svg width="21" height="10" viewBox="0 0 21 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 1.25L19.5 5M19.5 5L15.75 8.75M19.5 5H1.5" stroke="white"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.footer-fe')

    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
