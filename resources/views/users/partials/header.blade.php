<header class="header-wrapper fixed z-30 hidden w-full md:block">
    <div
        class="relative flex h-[108px] w-full items-center justify-between bg-white px-10 dark:bg-darkblack-600 2xl:px-[76px]">
        <button title="Ctrl+b" type="button"
            class="drawer-btn absolute left-0 top-auto rotate-180 transform">
            <span>
                <svg width="16" height="40" viewBox="0 0 16 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 10C0 4.47715 4.47715 0 10 0H16V40H10C4.47715 40 0 35.5228 0 30V10Z"
                        fill="#22C55E" />
                    <path d="M10 15L6 20.0049L10 25.0098" stroke="#ffffff" stroke-width="1.2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </button>
        <!--              page-title-->
        <div>
            <h3
                class="text-xl font-bold text-bgray-900 dark:text-bgray-50 lg:text-3xl lg:leading-[36.4px]">
                Dashboard
            </h3>
            <p
                class="text-xs font-medium text-bgray-600 dark:text-bgray-50 lg:text-sm lg:leading-[25.2px]">
                Selamat Datang di Samoedra
            </p>
        </div>
        <!--              search-bar-->

        <!--  quick access-->
        <div class="quick-access-wrapper relative">
            <div class="flex items-center space-x-[43px]">
                <div class="hidden items-center space-x-5 xl:flex">
                    <button type="button" id="theme-toggle"
                        class="relative flex h-[52px] w-[52px] items-center justify-center rounded-[12px] border border-success-300 dark:border-darkblack-400">
                        <span class="block dark:hidden">
                            <svg class="stroke-bgray-900" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.3284 14.8687C13.249 14.8687 9.13135 10.751 9.13135 5.67163C9.13135 4.74246 9.26914 3.84548 9.5254 3C5.74897 4.14461 3 7.65276 3 11.803C3 16.8824 7.11765 21 12.197 21C16.3472 21 19.8554 18.251 21 14.4746C20.1545 14.7309 19.2575 14.8687 18.3284 14.8687Z"
                                    stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="hidden dark:block">
                            <svg class="stroke-bgray-900 dark:stroke-bgray-50" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="5" stroke-width="1.5" />
                                <path d="M12 2V4" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M12 20V22" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M20.6602 7L18.9281 8" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M5.07178 16L3.33973 17" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M3.33984 7L5.07189 8" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M18.9282 16L20.6603 17" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="hidden h-[48px] w-[1px] bg-bgray-300 dark:bg-darkblack-400 xl:block"></div>
                <!--                author-->
                <div class="relative group">
                    <div class="flex cursor-pointer space-x-0 lg:space-x-3">
                        <div class="h-[52px] w-[52px] overflow-hidden rounded-xl border border-bgray-300">
                            <div class="flex h-full w-full items-center justify-center rounded-xl bg-bgray-100 dark:bg-darkblack-500">
                                <span class="text-lg font-medium text-bgray-900 dark:text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="hidden 2xl:block">
                            <div class="flex items-center space-x-2.5">
                                <h3 class="text-base font-bold leading-[28px] text-bgray-900 dark:text-white">
                                    {{ Auth::user()->name }}
                                </h3>
                                <span>
                                    <svg class="stroke-bgray-900 dark:stroke-white" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M7 10L12 14L17 10" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                            <p class="text-sm font-medium leading-[20px] text-bgray-600 dark:text-bgray-50">
                                {{ Auth::user()->role->name }}
                            </p>
                        </div>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="invisible group-hover:visible absolute right-0 top-[60px] w-[280px] rounded-lg bg-white shadow-lg dark:bg-darkblack-600 z-50 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <div class="p-4">
                            <ul class="space-y-2">
                                <!-- Profile Settings -->
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-darkblack-500">
                                        <svg class="h-5 w-5 text-gray-500 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="text-sm font-medium dark:text-white">Edit Profil</span>
                                    </a>
                                </li>

                                <!-- Change Password -->
                                <li>
                                    <a href="{{ route('password.change') }}" class="flex items-center space-x-3 rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-darkblack-500">
                                        <svg class="h-5 w-5 text-gray-500 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                        <span class="text-sm font-medium dark:text-white">Ganti Password</span>
                                    </a>
                                </li>

                                <!-- Logout -->
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center space-x-3 rounded-lg p-2 text-red-500 hover:bg-red-50">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span class="text-sm font-medium">Keluar</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<header class="mobile-wrapper fixed z-20 block w-full md:hidden">
<div class="flex h-[80px] w-full items-center justify-between bg-white dark:bg-darkblack-600">
    <div class="flex h-full w-full items-center space-x-5">
        <button type="button" class="drawer-btn rotate-180 transform">
            <span>
                <svg width="16" height="40" viewBox="0 0 16 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 10C0 4.47715 4.47715 0 10 0H16V40H10C4.47715 40 0 35.5228 0 30V10Z"
                        fill="#F7F7F7" />
                    <path d="M10 15L6 20.0049L10 25.0098" stroke="#A0AEC0" stroke-width="1.2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </button>
        <div>
            <a href="/">
                <img src="{{ asset('images/logo/logo_samoedra.JPG') }}"
                     class="h-12 w-auto object-contain"
                     alt="Samoedra Logo" />
            </a>
        </div>
    </div>
    <div class="mr-2">
        <div class="relative group">
            <div class="flex cursor-pointer space-x-0 lg:space-x-3">
                <div class="hidden 2xl:block">
                    <div class="flex items-center space-x-2.5">
                        <h3 class="text-base font-bold leading-[28px] text-bgray-900">
                            John Doe
                        </h3>
                        <span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 10L12 14L17 10" stroke="#28303F" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <p class="text-sm font-medium leading-[20px] text-bgray-600">
                        Super Admin
                    </p>
                </div>
            </div>

            <div class="profile-wrapper">
                <div class="profile-outside fixed -left-[43px] top-0 hidden h-full w-full"></div>
                <div style="
          filter: drop-shadow(12px 12px 40px rgba(0, 0, 0, 0.08));
        " class="profile-box absolute right-0 top-[81px] hidden w-[300px] overflow-hidden rounded-lg bg-white">
                    <div class="relative w-full px-3 py-2">
                        <div>
                            <ul>
                                <li class="w-full">
                                    <a href="settings.html">
                                        <div
                                            class="flex items-center space-x-[18px] rounded-lg p-[14px] text-bgray-600 hover:bg-bgray-100 hover:text-bgray-900">
                                            <div class="w-[20px]">
                                                <span>
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.1197 12.7805C12.0497 12.7705 11.9597 12.7705 11.8797 12.7805C10.1197 12.7205 8.71973 11.2805 8.71973 9.51047C8.71973 7.70047 10.1797 6.23047 11.9997 6.23047C13.8097 6.23047 15.2797 7.70047 15.2797 9.51047C15.2697 11.2805 13.8797 12.7205 12.1197 12.7805Z"
                                                            stroke="#111827" stroke-width="1.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M18.7398 19.3796C16.9598 21.0096 14.5998 21.9996 11.9998 21.9996C9.39977 21.9996 7.03977 21.0096 5.25977 19.3796C5.35977 18.4396 5.95977 17.5196 7.02977 16.7996C9.76977 14.9796 14.2498 14.9796 16.9698 16.7996C18.0398 17.5196 18.6398 18.4396 18.7398 19.3796Z"
                                                            stroke="#111827" stroke-width="1.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                            stroke="#111827" stroke-width="1.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <span class="text-sm font-semibold">My Profile</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a href="messages.html">
                                        <div
                                            class="flex items-center space-x-[18px] rounded-lg p-[14px] text-bgray-600 hover:bg-bgray-100 hover:text-bgray-900">
                                            <div class="w-[20px]">
                                                <span>
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M2 12V7C2 4.79086 3.79086 3 6 3H18C20.2091 3 22 4.79086 22 7V17C22 19.2091 20.2091 21 18 21H8M6 8L9.7812 10.5208C11.1248 11.4165 12.8752 11.4165 14.2188 10.5208L18 8M2 15H8M2 18H8"
                                                            stroke="#2A313C" stroke-width="1.5"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <span class="text-sm font-semibold">Inbox</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a href="#">
                                        <div
                                            class="flex items-center space-x-[18px] rounded-lg p-[14px] text-success-300">
                                            <div class="w-[20px]">
                                                <span>
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15 10L13.7071 11.2929C13.3166 11.6834 13.3166 12.3166 13.7071 12.7071L15 14M14 12L22 12M6 20C3.79086 20 2 18.2091 2 16V8C2 5.79086 3.79086 4 6 4M6 20C8.20914 20 10 18.2091 10 16V8C10 5.79086 8.20914 4 6 4M6 20H14C16.2091 20 18 18.2091 18 16M6 4H14C16.2091 4 18 5.79086 18 8"
                                                            stroke="#22C55E" stroke-width="1.5"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <span class="text-sm font-semibold">Log Out</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="my-[14px] h-[1px] w-full bg-bgray-300"></div>
                        <div>
                            <ul>
                                <li class="w-full">
                                    <a href="settings.html">
                                        <div
                                            class="rounded-lg p-[14px] text-bgray-600 hover:bg-bgray-100 hover:text-bgray-900">
                                            <span class="text-sm font-semibold">Settings</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a href="users.html">
                                        <div
                                            class="rounded-lg p-[14px] text-bgray-600 hover:bg-bgray-100 hover:text-bgray-900">
                                            <span class="text-sm font-semibold">Users</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>

<script>
function profileAction() {
    const profileDropdown = document.querySelector('.profile-dropdown');
    console.log('Profile dropdown clicked');
    console.log('Dropdown element:', profileDropdown);
    // Toggle dropdown
    if (profileDropdown) {
        profileDropdown.classList.toggle('hidden');

        // Jika dropdown terbuka, tambahkan event listener untuk menutup saat klik di luar
        if (!profileDropdown.classList.contains('hidden')) {
            setTimeout(() => {
                document.addEventListener('click', function closeMenu(e) {
                    if (!profileDropdown.contains(e.target) &&
                        !e.target.closest('[onclick="profileAction()"]')) {
                        profileDropdown.classList.add('hidden');
                        document.removeEventListener('click', closeMenu);
                    }
                });
            }, 100);
        }
    }
}

// Pastikan script dijalankan setelah DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    const profileDropdown = document.querySelector('.profile-dropdown');
    if (profileDropdown) {
        profileDropdown.classList.add('hidden');
    }

    // Inisialisasi tema sesuai dengan preferensi yang disimpan
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // Tambahkan event listener untuk toggle tema
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            // Toggle class dark pada html element
            const isDark = document.documentElement.classList.toggle('dark');

            // Simpan preferensi ke localStorage
            localStorage.setItem('darkMode', isDark);

            // Custom event untuk memberitahu komponen lain tentang perubahan tema
            document.dispatchEvent(new CustomEvent('themeChanged', {
                detail: { isDark }
            }));
        });
    }
});
</script>

@vite(['resources/js/app.js'])
