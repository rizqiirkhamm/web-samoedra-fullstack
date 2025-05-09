<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Samoedra</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="icon" href="{{ asset('images/assets/logo-doang.png') }}" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Fredoka:wght@300..700&family=Fuzzy+Bubbles:wght@400;700&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">
    <style>
        /* Style untuk video YouTube responsive */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            margin: 1rem 0;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Style untuk wrapping text */
        .prose {
            max-width: 100%;
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
        }

        .prose img {
            max-width: 100%;
            height: auto;
        }

        /* Style untuk konten artikel di mobile */
        @media (max-width: 768px) {
            .w-full.px-8 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .text-4xl {
                font-size: 1.875rem;
                line-height: 2.25rem;
            }

            .text-5xl {
                font-size: 2.25rem;
                line-height: 2.5rem;
            }

            .text-lg {
                font-size: 1rem;
                line-height: 1.5rem;
            }

            .h-130 {
                height: 200px;
            }

            .rounded-2xl {
                border-radius: 1rem;
            }

            .my-10 {
                margin-top: 2.5rem;
                margin-bottom: 2.5rem;
            }

            .mb-20 {
                margin-bottom: 5rem;
            }

            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .py-3 {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }
        }
    </style>
</head>

<body>

    @include('components.navbar-fe')
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
   @include('components.footer-fe')
    <a href="#form-daftar"
    class="fixed bottom-14 right-7 z-50 bg-green-100  hover:bg-green-200 text-white font-semibold py-5 px-5 rounded-full shadow-lg transition-colors duration-300">
    <img class="w-8" src="{{ asset('images/assets/wa.svg') }}" alt="">
  </a>

    <script src="script.js"></script>
    <script>
        // Script untuk membuat video YouTube responsive
        document.addEventListener('DOMContentLoaded', function() {
            // Temukan semua iframe YouTube
            const iframes = document.querySelectorAll('iframe[src*="youtube.com"]');

            iframes.forEach(iframe => {
                // Buat container untuk iframe
                const container = document.createElement('div');
                container.className = 'video-container';

                // Pindahkan iframe ke dalam container
                iframe.parentNode.insertBefore(container, iframe);
                container.appendChild(iframe);
            });
        });
    </script>
</body>

</html>
