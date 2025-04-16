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
  <link href="{{ asset('css/public.css') }}" rel="stylesheet">
</head>

<body class="font-[Onest]">
    @include('components.navbar-fe')



    <!-- FAQ Section -->
    <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto py-20">
      <div class="text-center">
        <p class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">FAQ</p>
        <h1 class="text-[#3E5467] text-3xl md:text-4xl font-semibold" style="font-family: 'Fredoka';">Pertanyaan Sering
          Ditanyakan</h1>
      </div>
      <div class="flex flex-col md:flex-col justify-between items-center md:py-16">
        <!-- Container dengan clip-path -->
        <!-- <div class="w-full md:w-1/2 relative">
          <div class="w-full max-w-[500px] h-[500px] mx-auto p-3 xl:p-5 bg-[#EFF5F6] mask-faq relative z-10">
            <div class="mask-faq h-full">
              <img src="assets/img_faq.png" class="w-full h-full object-cover object-center" alt="">
            </div>
          </div>
          <img src="assets/vector_line_faq.svg" alt="Vector FAQ"
            class="absolute w-full max-w-[540px] h-[540px] -z-10 mx-auto bottom-0 left-0 right-0 top-1">
          <img src="assets/ikan_pari.svg" alt="Ikan Pari"
            class="absolute top-15 md:left-10 md:top-7 animate-float w-32 md:w-52">
          <img src="assets/ikan_biru.svg" alt="Ikan Biru"
            class="absolute bottom-10 right-0 md:right-12 md:bottom-0 animate-float-ikan w-24 md:w-44">
        </div> -->

        <!-- FAQ Items -->
        <div class="mt-6 space-y-6 w-full pb-10">
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
        </div>
      </div>
    </div>

    @include('components.footer-fe')




<script src="{{ asset('js/script.js') }}"></script>




</body>

</html>
