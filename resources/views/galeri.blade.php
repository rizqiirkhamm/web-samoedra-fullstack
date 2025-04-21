<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Samoedra</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
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
            <h1 class="text-white font-semibold text-4xl xl:text-5xl" style="font-family: 'Fredoka';">Galeri Rumah
                Samoedra</h1>
            <p class="mt-5 duration-300 text-xl" style="font-family: 'Fuzzy Bubbles';">
                <span class="text-[#E8A26A] text-xl" style="font-family: 'Fuzzy Bubbles', cursive;">Home → Informasi
                    →</span>
                Galeri
            </p>
        </div>
    </div>
    <div class="w-full px-8 md:w-3/4 md:px-0 mx-auto mt-14 flex flex-col justify-center items-center">
        <!-- Filter Categories -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:flex justify-center gap-3 md:gap-5 max-sm:w-full">
            <div class="px-3 md:px-6 h-10 md:h-12 flex justify-center items-center bg-[#E8A26A] rounded-xl category-filter" data-category="all">
                <p class="text-white text-base md:text-lg font-medium whitespace-nowrap" style="font-family: 'Onest';">
                    All</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Daycare">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Daycare</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Area Main">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Area Main</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Bimbel">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Bimbel</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Kelas Stimulasi">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Kelas Stimulasi</p>
            </div>
            <div class="px-3 md:px-6 outline-offset-[-2px] h-10 md:h-12 flex justify-center items-center outline-2 outline-[#E8A26A] rounded-xl category-filter" data-category="Event">
                <p class="text-[#E8A26A] text-base md:text-lg font-medium whitespace-nowrap"
                    style="font-family: 'Onest';">Event</p>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="mt-14">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($galleries as $gallery)
                <div class="w-full gallery-item" data-category="{{ $gallery->category }}">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover rounded-2xl">
                    <p class="text-[#E8A26A] mt-4" style="font-family: 'Onest';">{{ $gallery->category }}</p>
                    <p class="text-2xl font-semibold text-[#3E5467]" style="font-family: 'Fredoka';">{{ $gallery->title }}</p>
                </div>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <img src="{{ asset('images/assets/ikan2.svg') }}" alt="No Galleries" class="w-32 h-32 mb-4 animate-float">
                    <h3 class="text-lg font-semibold text-[#3E5467]">Belum Ada Galeri</h3>
                    <p class="text-gray-500">Silakan kembali lagi nanti</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($galleries->hasPages())
            <div class="flex items-center gap-4 mt-10 pagination-container">
                <p class="font-medium text-xl text-[#E8A26A]">Lihat Lainnya</p>
                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                    @if($page == $galleries->currentPage())
                        <div class="w-10 h-10 bg-[#E8A26A] rounded-full items-center justify-center flex aspect-square">
                            <p class="text-white text-lg font-medium" style="font-family: 'Fredoka';">{{ $page }}</p>
                        </div>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 outline-2 outline-[#E8A26A] outline-offset-[-2px] rounded-full items-center justify-center flex aspect-square hover:bg-[#E8A26A] group transition-all duration-300">
                            <p class="text-[#E8A26A] text-lg font-medium group-hover:text-white transition-all duration-300" style="font-family: 'Fredoka';">{{ $page }}</p>
                        </a>
                    @endif
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @include('components.footer-fe')

    <script src="{{ asset('script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filters = document.querySelectorAll('.category-filter');
            const items = document.querySelectorAll('.gallery-item');
            const paginationContainer = document.querySelector('.pagination-container');
            const categoryCounts = @json($categoryCounts);

            // Hitung total items untuk kategori "all"
            const totalItems = Object.values(categoryCounts).reduce((a, b) => a + b, 0);

            filters.forEach(filter => {
                filter.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');

                    // Remove active class from all filters
                    filters.forEach(f => {
                        f.classList.remove('bg-[#E8A26A]');
                        f.querySelector('p').classList.remove('text-white');
                        f.querySelector('p').classList.add('text-[#E8A26A]');
                    });

                    // Add active class to clicked filter
                    this.classList.add('bg-[#E8A26A]');
                    this.querySelector('p').classList.remove('text-[#E8A26A]');
                    this.querySelector('p').classList.add('text-white');

                    // Filter items
                    items.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') === category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Show/hide pagination based on category count
                    if (paginationContainer) {
                        if (category === 'all') {
                            paginationContainer.style.display = totalItems > 9 ? 'flex' : 'none';
                        } else {
                            const categoryCount = categoryCounts[category] || 0;
                            paginationContainer.style.display = categoryCount > 9 ? 'flex' : 'none';
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
