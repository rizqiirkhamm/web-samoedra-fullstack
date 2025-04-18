<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>

    <!-- jQuery harus dimuat pertama -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    @stack('head')
    @yield('styles')

    <!-- Tailwind dengan konfigurasi dark mode -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkblack: {
                            300: '#404040',
                            400: '#262626',
                            500: '#171717',
                            600: '#0a0a0a',
                            700: '#000000',
                        },
                        success: {
                            300: '#22c55e',
                        },
                        bgray: {
                            50: '#f9fafb',
                            300: '#d1d5db',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            900: '#111827',
                        },
                    },
                },
            },
        }
    </script>

    <!-- Base CSS untuk dark mode -->
    <style>
        /* Base styles */
        .dark body {
            @apply bg-darkblack-500 text-white;
        }

        /* Card styles */
        .dark .card {
            @apply bg-darkblack-600 border-darkblack-400;
        }

        /* Table styles */
        .dark table {
            @apply bg-darkblack-600;
        }

        .dark tr {
            @apply border-darkblack-400;
        }

        .dark td, .dark th {
            @apply text-white;
        }

        /* Form styles */
        .dark input, .dark select, .dark textarea {
            @apply bg-darkblack-500 border-darkblack-400 text-white;
        }

        /* Button styles */
        .dark .btn-primary {
            @apply bg-success-300 text-white hover:bg-success-400;
        }

        .dark .btn-secondary {
            @apply bg-darkblack-400 text-white hover:bg-darkblack-300;
        }

        /* Status badges */
        .dark .status-badge {
            @apply bg-opacity-20;
        }

        .dark .status-badge.waiting {
            @apply bg-yellow-900 text-yellow-100;
        }

        .dark .status-badge.playing {
            @apply bg-green-900 text-green-100;
        }

        .dark .status-badge.finished {
            @apply bg-gray-900 text-gray-100;
        }

        /* Modal styles */
        .dark .modal {
            @apply bg-darkblack-600;
        }

        .dark .modal-content {
            @apply text-white;
        }

        /* Dropdown styles */
        .dark .dropdown {
            @apply bg-darkblack-500 border-darkblack-400;
        }

        .dark .dropdown-item:hover {
            @apply bg-darkblack-400;
        }

        /* Custom scrollbar for dark mode */
        .dark ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .dark ::-webkit-scrollbar-track {
            @apply bg-darkblack-500;
        }

        .dark ::-webkit-scrollbar-thumb {
            @apply bg-darkblack-400 rounded-full;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            @apply bg-darkblack-300;
        }

        /* Animation classes */
        .fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .animate-modal-pop {
            animation: modalPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes modalPop {
            0% {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Tambahkan CSS untuk memastikan layout yang benar */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .layout-wrapper {
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .body-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }

        main {
            flex: 1;
            width: 100%;
        }

        /* Pastikan dark mode bekerja dengan benar */
        .dark .body-wrapper,
        .dark main {
            background-color: #0a0a0a;
        }

        /* Hilangkan scrollbar yang tidak perlu */
        .body-wrapper {
            overflow-x: hidden;
        }

        /* Pastikan konten mengisi seluruh lebar */
        .content-wrapper {
            width: 100%;
            height: 100%;
        }

        .note-modal-backdrop {
            display: none !important;
        }
    </style>

    <!-- Menggunakan asset() Laravel untuk memanggil file CSS di public/css/ -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body class="dark:bg-darkblack-500">
    <div class="layout-wrapper active">
        <div class="flex min-h-screen w-full">
            @include('users.partials.sidebar')
            <div class="body-wrapper flex-1 overflow-x-hidden bg-white dark:bg-darkblack-500">
                <div class="w-full">
                    @include('users.partials.header')

                    <main class="w-full h-full">
                        <div class="p-4 md:p-6 2xl:p-10 w-full mt-[80px]">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script>
      AOS.init();
    </script>
    <script src="{{ asset('js/quill.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <!-- Page Specific Scripts -->
    @yield('scripts')
    @stack('scripts')

    <script>
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
    }

    // Check user preference
    if (localStorage.getItem('darkMode') === 'true' ||
        (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    </script>
</body>

</html>
