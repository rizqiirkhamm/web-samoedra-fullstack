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
        <!-- FAQ Items -->
        <div class="mt-6 space-y-6 w-full pb-10">
          @forelse($faqs as $index => $faq)
          <div class="faq-item bg-[#EFF5F6] px-6 py-4 rounded-2xl cursor-pointer transition-all duration-300"
            onclick="toggleFAQ({{ $index + 1 }})">
            <div class="flex justify-between items-center">
              <span class="font-semibold text-[#3E5467] text-2xl" style="font-family: 'Fredoka';">{{ $faq->pertanyaan }}</span>
              <div
                class="w-7 h-7 aspect-square flex items-center justify-center rounded-full bg-[#E8A26A] transition-transform duration-300"
                id="icon-{{ $index + 1 }}">
                <svg width="16" height="10" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.0957 2L10.6016 10L2.10751 2" stroke="#F3EEE6" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <p class="mt-2 text-[#A2A2BD] max-w-xl hidden transition-all duration-300 overflow-hidden max-h-0"
              id="desc-{{ $index + 1 }}">
              {{ $faq->jawaban }}
            </p>
          </div>
          @empty
          <div class="text-center text-gray-500">
            Belum ada FAQ yang tersedia
          </div>
          @endforelse
        </div>
      </div>
    </div>

    @include('components.footer-fe')

    <script>
        function toggleFAQ(index) {
            const desc = document.getElementById(`desc-${index}`);
            const icon = document.getElementById(`icon-${index}`);

            if (desc.classList.contains('hidden')) {
                desc.classList.remove('hidden');
                desc.style.maxHeight = desc.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            } else {
                desc.classList.add('hidden');
                desc.style.maxHeight = '0';
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>

</html>
