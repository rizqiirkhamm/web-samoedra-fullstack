<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Samoedra</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="icon" href="{{ asset('images/assets/logo-doang.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Fredoka:wght@300..700&family=Fuzzy+Bubbles:wght@400;700&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style untuk memotong teks deskripsi */
        .truncate-description {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Jumlah baris yang ditampilkan */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5;
            max-height: 4.5em; /* 3 baris * 1.5 line-height */
        }

        /* Style untuk mobile */
        @media (max-width: 768px) {
            .truncate-description {
                -webkit-line-clamp: 2; /* Kurangi jumlah baris di mobile */
                max-height: 3em;
            }
        }
    </style>
</head>

<body>
     @include('components.navbar-fe')


    <!-- Banner -->
    <div class="w-full ">
        <!-- Overlay & Text -->
        <div class="w-full h-110 flex flex-col items-center justify-center text-white text-center"
            style="background-image: url('images/assets/banner.png'); background-repeat: no-repeat; background-position: center;">
            <h1 class="text-white font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Artikel Rumah
                Samoedra</h1>
            <p class="mt-5 duration-300 text-xl" style="font-family: 'Fuzzy Bubbles';">
                <span class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Home → Informasi
                    →</span>
                Artikel
            </p>
        </div>
    </div>
    <div class="w-full relative">
        <!-- Container untuk card dan hewan laut -->
        <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto relative overflow-y-hidden md:overflow-y-visible overflow-x-hidden md:overflow-x-visible">
            <!-- Hewan laut dengan posisi relatif terhadap container -->
            <img src="images/assets/kura2.svg" alt="Kura-kura"
                class="absolute w-28 md:w-36 top-16 block md:hidden -left-16 transform animate-float">

            <img src="images/assets/ikan_pari.svg" alt="Ikan Pari"
                class="absolute w-28 md:w-46 top-[860px] block md:hidden md:top-[750px] -left-10 md:-left-20 rotate-45 transform animate-float">

            <img src="images/assets/lobster.svg" alt="Lobster"
                class="absolute w-22 md:w-30 top-[750px] block md:hidden -right-5 md:right-0 transform animate-float">
            <img src="images/assets/hiu.svg" alt="Hiu" class="absolute w-40 top-[1490px] block md:hidden -right-16 transform animate-float">
            <img src="images/assets/bintang_laut_pink.svg" alt="Bintang Laut" class="absolute w-22 top-[2200px] block md:hidden -left-7 transform animate-float -scale-x-[1]">
            <img src="images/assets/bintang_laut_kuning.svg" alt="Bintang Laut" class="absolute w-22 top-[2880px] block md:hidden -right-7 transform animate-float -scale-x-[1]">
            <!-- Konten card -->
            <p class="text-[#E8A26A] text-xl text-center mt-12" style="font-family: 'Fuzzy Bubbles';">Artikel Terkini
            </p>
            </p>
            <h1 class="text-[#3E5467] font-semibold text-4xl xl:text-5xl text-center mb-12"
                style="font-family: 'Fredoka';">Rumah Samoedra</h1>

            @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @foreach($articles as $article)
                <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-96 object-cover rounded-3xl">
                    <div class="px-3 mt-5">
                        <div class="flex items-center gap-2">
                            <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.2454 18.9C13.4768 18.9 15.6168 18.015 17.1946 16.4397C18.7725 14.8644 19.6589 12.7278 19.6589 10.5C19.6589 8.27218 18.7725 6.13561 17.1946 4.5603C15.6168 2.985 13.4768 2.1 11.2454 2.1C9.01399 2.1 6.87398 2.985 5.29614 4.5603C3.71831 6.13561 2.83189 8.27218 2.83189 10.5C2.83189 12.7278 3.71831 14.8644 5.29614 16.4397C6.87398 18.015 9.01399 18.9 11.2454 18.9ZM11.2454 0C12.6265 0 13.994 0.271591 15.27 0.799265C16.546 1.32694 17.7054 2.10036 18.6819 3.07538C19.6585 4.05039 20.4332 5.2079 20.9617 6.48182C21.4902 7.75574 21.7623 9.12112 21.7623 10.5C21.7623 13.2848 20.6542 15.9555 18.6819 17.9246C16.7096 19.8938 14.0346 21 11.2454 21C5.42956 21 0.728516 16.275 0.728516 10.5C0.728516 7.71523 1.83654 5.04451 3.80883 3.07538C5.78113 1.10625 8.45614 0 11.2454 0ZM11.7712 5.25V10.7625L16.5038 13.566L15.7151 14.8575L10.1937 11.55V5.25H11.7712Z" fill="#E8A26A"/>
                            </svg>
                            <p class="text-[#E8A26A] font-medium text-lg">{{ $article->created_at->format('d F Y') }}</p>
                        </div>
                        <h1 class="text-[#3E5467] font-semibold text-2xl mt-2" style="font-family: 'Fredoka';">{{ $article->title }}</h1>
                        <p class="text-[#A2A2BD] mt-2 truncate-description">{{ Str::limit(strip_tags($article->content), 150) }}</p>
                        <a href="{{ route('artikel.detail', ['slug' => $article->slug]) }}">
                            <div class="flex items-center group gap-2 mt-5">
                                <p class="text-[#E8A26A] group-hover:text-[#EACDB5] text-lg font-semibold" style="font-family: 'Onest';">Lihat Artikel</p>
                                <svg width="21" height="10" viewBox="0 0 21 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.2178 1L20.0005 4.75M20.0005 4.75L16.2178 8.5M20.0005 4.75H1.84375" class="stroke-[#E8A26A] group-hover:stroke-[#EACDB5]" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            @if($articles->hasPages())
            <div class="flex items-center gap-4 mt-10">
                <p class="font-medium text-xl text-[#7BA5B0]">Lihat Lainnya</p>
                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                    @if($page == $articles->currentPage())
                        <div class="w-10 h-10 bg-[#7BA5B0] rounded-full items-center justify-center flex aspect-square">
                            <p class="text-white text-lg font-medium" style="font-family: 'Fredoka';">{{ $page }}</p>
                        </div>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 outline-2 outline-[#7BA5B0] outline-offset-[-2px] rounded-full items-center justify-center flex aspect-square hover:bg-[#7BA5B0] group transition-all duration-300">
                            <p class="text-[#7BA5B0] text-lg font-medium group-hover:text-white transition-all duration-300" style="font-family: 'Fredoka';">{{ $page }}</p>
                        </a>
                    @endif
                @endforeach
            </div>
            @endif
            @else
            <div class="flex flex-col items-center justify-center py-20">
                <img src="{{ asset('images/assets/ikan2.svg') }}" alt="No Articles" class="w-40 h-40 mb-8 animate-float">
                <h2 class="text-[#3E5467] font-semibold text-2xl mb-4" style="font-family: 'Fredoka';">Belum Ada Artikel</h2>
                <p class="text-[#A2A2BD] text-center max-w-md">Mohon maaf, saat ini belum ada artikel yang tersedia. Silakan kunjungi kembali nanti untuk membaca artikel terbaru dari kami.</p>
            </div>
            @endif
    </div>
    @include('components.footer-fe')

     <script src="{{ asset('js/script.js') }}"></script>
    </div>
</body>

</html>