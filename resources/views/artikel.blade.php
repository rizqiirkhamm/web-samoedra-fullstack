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
        <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto relative overflow-x-hidden md:overflow-x-visible">
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
                <div class="w-full h-165 border-3 border-[#E8A26A] border-dashed rounded-3xl p-5 md:p-7 flex flex-col">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-96 object-cover rounded-3xl">
                    <div class="px-3 mt-5">
                        <div class="flex items-center gap-2">
                            <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.2454 18.9C13.4768 18.9 15.6168 18.015 17.1946 16.4397C18.7725 14.8644 19.6589 12.7278 19.6589 10.5C19.6589 8.27218 18.7725 6.13561 17.1946 4.5603C15.6168 2.985 13.4768 2.1 11.2454 2.1C9.01399 2.1 6.87398 2.985 5.29614 4.5603C3.71831 6.13561 2.83189 8.27218 2.83189 10.5C2.83189 12.7278 3.71831 14.8644 5.29614 16.4397C6.87398 18.015 9.01399 18.9 11.2454 18.9ZM11.2454 0C12.6265 0 13.994 0.271591 15.27 0.799265C16.546 1.32694 17.7054 2.10036 18.6819 3.07538C19.6585 4.05039 20.4332 5.2079 20.9617 6.48182C21.4902 7.75574 21.7623 9.12112 21.7623 10.5C21.7623 13.2848 20.6542 15.9555 18.6819 17.9246C16.7096 19.8938 14.0346 21 11.2454 21C5.42956 21 0.728516 16.275 0.728516 10.5C0.728516 7.71523 1.83654 5.04451 3.80883 3.07538C5.78113 1.10625 8.45614 0 11.2454 0ZM11.7712 5.25V10.7625L16.5038 13.566L15.7151 14.8575L10.1937 11.55V5.25H11.7712Z" fill="#E8A26A"/>
                            </svg>
                            <p class="text-[#E8A26A] font-medium text-lg">{{ $article->created_at->format('d F Y') }}</p>
                        </div>
                        <h1 class="text-[#3E5467] font-semibold text-2xl mt-2" style="font-family: 'Fredoka';">{{ $article->title }}</h1>
                        <p class="text-[#A2A2BD] mt-2">{{ Str::limit(strip_tags($article->content), 150) }}</p>
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
                            <svg width="23" height="24" viewBox="0 0 23 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
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
                            <svg width="11" height="20" viewBox="0 0 11 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.4067 0.0949119L7.65395 0.0913086C4.98443 0.0913086 3.25999 2.00459 3.25999 4.96909V7.21656H0.498047V11.2836H3.25999L3.25666 19.9087H7.12105L7.12438 11.2836H10.2935L10.291 7.21746H7.12438V5.31049C7.12438 4.39348 7.32505 3.92958 8.42833 3.92958L10.3984 3.92867L10.4067 0.0949119Z"
                                    fill="#EFF5F6" />
                            </svg>
                        </div>
                        <div
                            class="w-9 h-9 p-2 aspect-square bg-[#3E5467] hover:bg-[#BDBDCB] transition-all rounded-xl flex justify-center items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18.9986 5.08086C18.0969 4.17865 17.0255 3.46372 15.8464 2.97722C14.6672 2.49072 13.4034 2.24226 12.1278 2.24614C6.7745 2.24614 2.41661 6.58226 2.41444 11.9129C2.41207 13.6103 2.8595 15.278 3.71118 16.7463L2.33301 21.7539L7.48209 20.4097C8.90738 21.1818 10.5029 21.5859 12.1239 21.5854H12.1278C17.4807 21.5854 21.8381 17.2488 21.8407 11.9186C21.844 10.6473 21.5944 9.38814 21.1065 8.21426C20.6185 7.04038 19.902 5.97525 18.9986 5.08086ZM12.1278 19.9538H12.1243C10.6793 19.9542 9.26048 19.5675 8.01551 18.8338L7.72071 18.6596L4.66523 19.4574L5.48081 16.4924L5.28878 16.1876C4.48077 14.9084 4.05267 13.426 4.0543 11.9129C4.0543 7.48318 7.67761 3.87904 12.1309 3.87904C14.2671 3.87523 16.3174 4.72011 17.8308 6.22786C19.3442 7.73561 20.1967 9.78275 20.2009 11.919C20.1991 16.3492 16.5776 19.9538 12.1278 19.9538ZM16.5558 13.9364C16.3133 13.8154 15.1188 13.231 14.8976 13.1504C14.6764 13.0699 14.5132 13.0294 14.3516 13.2715C14.1901 13.5136 13.7246 14.0553 13.583 14.2186C13.4415 14.3819 13.3 14.3997 13.0575 14.2787C12.8149 14.1576 12.0324 13.9029 11.1054 13.0799C10.3839 12.4394 9.89705 11.6486 9.75553 11.4069C9.61401 11.1653 9.74029 11.0342 9.86177 10.914C9.97107 10.8056 10.1043 10.6319 10.2258 10.4908C10.3473 10.3497 10.3878 10.2487 10.4683 10.0876C10.5489 9.92644 10.5088 9.78536 10.4483 9.66474C10.3878 9.54412 9.90227 8.35493 9.70023 7.87116C9.50297 7.40001 9.3031 7.46402 9.15418 7.45662C9.01267 7.44965 8.84938 7.44791 8.6887 7.44791C8.56587 7.45111 8.44501 7.47959 8.33368 7.53159C8.22235 7.58358 8.12293 7.65797 8.04163 7.75011C7.81912 7.99221 7.19209 8.57744 7.19209 9.76533C7.19209 10.9532 8.06297 12.1028 8.18315 12.2639C8.30333 12.425 9.89443 14.8648 12.329 15.9111C12.7811 16.1047 13.243 16.2745 13.7128 16.4197C14.2941 16.6035 14.8232 16.5778 15.2412 16.5155C15.7076 16.4463 16.6782 15.9312 16.8798 15.3668C17.0814 14.8025 17.0818 14.3192 17.0213 14.2186C16.9608 14.118 16.7988 14.057 16.5558 13.9364Z"
                                    fill="#EFF5F6" />
                            </svg>
                        </div>
                        <div
                            class="w-9 h-9 p-2.5 aspect-square bg-[#3E5467] hover:bg-[#BDBDCB] transition-all rounded-xl flex justify-center items-center">
                            <svg width="19" height="23" viewBox="0 0 19 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.1543 0.182617C12.751 0.182617 13.3233 0.414405 13.7453 0.826991C14.1672 1.23958 14.4043 1.79916 14.4043 2.38265C14.4049 3.14288 14.6735 3.87967 15.1649 4.46879C15.6564 5.05791 16.3405 5.46333 17.102 5.61669C17.6868 5.7328 18.2005 6.07131 18.5301 6.55775C18.8596 7.04419 18.978 7.63871 18.8593 8.21052C18.7405 8.78234 18.3943 9.28461 17.8969 9.60684C17.3994 9.92906 16.7913 10.0449 16.2065 9.92875C15.5837 9.80442 14.9785 9.60681 14.4043 9.34024V15.5828C14.4042 16.8173 14.0501 18.027 13.3821 19.0745C12.7141 20.1221 11.7591 20.9654 10.6255 21.5088C9.49184 22.0522 8.22508 22.2738 6.96909 22.1485C5.7131 22.0232 4.51823 21.556 3.5202 20.7999C2.52218 20.0439 1.76102 19.0293 1.32319 17.8714C0.885362 16.7135 0.78841 15.4588 1.04335 14.2498C1.29829 13.0407 1.8949 11.9258 2.76542 11.0317C3.63593 10.1376 4.74544 9.50015 5.96792 9.19174C6.54214 9.05633 7.14778 9.14714 7.65411 9.44457C8.16044 9.742 8.52685 10.2222 8.67425 10.7815C8.82164 11.3408 8.73819 11.9343 8.44191 12.434C8.14564 12.9336 7.6603 13.2993 7.09067 13.4521C6.56324 13.5889 6.10456 13.9084 5.79986 14.351C5.49517 14.7936 5.36518 15.3294 5.43407 15.8587C5.50295 16.388 5.76602 16.8748 6.17438 17.2287C6.58274 17.5826 7.10862 17.7795 7.65429 17.7829C8.25103 17.7829 8.82333 17.5511 9.24528 17.1385C9.66724 16.7259 9.90429 16.1663 9.90429 15.5828V2.38265C9.90429 1.79916 10.1413 1.23958 10.5633 0.826991C10.9853 0.414405 11.5576 0.182617 12.1543 0.182617Z"
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
    </div>

    <script src="script.js"></script>
    </div>
</body>

</html>
