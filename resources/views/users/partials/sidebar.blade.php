<aside
    class="sidebar-wrapper fixed top-0 z-30 block h-full w-[308px] bg-white dark:bg-darkblack-600 sm:hidden xl:block">
    <div
        class="sidebar-header relative z-30 flex h-[108px] w-full items-center border-b border-r border-b-[#F7F7F7] border-r-[#F7F7F7] pl-[50px] dark:border-darkblack-400">
        <a href="/">
            <img src="{{ asset('images/logo/logo_samoedra.JPG') }}"
                 class="h-16 w-auto object-contain"
                 alt="Samoedra Logo" />
        </a>
        <button type="button" class="drawer-btn absolute right-0 top-auto" title="Ctrl+b">
            <span>
                <svg width="16" height="40" viewBox="0 0 16 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 10C0 4.47715 4.47715 0 10 0H16V40H10C4.47715 40 0 35.5228 0 30V10Z" fill="#22C55E" />
                    <path d="M10 15L6 20.0049L10 25.0098" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
        </button>
    </div>
    <div
        class="sidebar-body overflow-style-none relative z-30 h-screen w-full overflow-y-scroll pb-[200px] pl-[48px] pt-[14px]">
        <div class="nav-wrapper mb-[36px] pr-[50px]">
            @php
                $PermissionUser = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'User');
                $PermissionRole = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Role');
                $PermissionBermain = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bermain');
                $PermissionBimbel = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel');
                $PermissionLayanan = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Layanan');
                $PermissionJournal = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Journal');
                $PermissionEvent = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event');
                $PermissionDaycare = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare');
                $PermissionStimulasi = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Stimulasi');
                $PermissionArticle = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article');
                $PermissionGallery = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Gallery');
                $PermissionTentang = App\Models\PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Content');
            @endphp

            <!-- Dashboard -->
            <div class="item-wrapper mb-5">
                <h4 class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50">
                    Dashboard
                </h4>
                <ul class="mt-2.5">
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ url('/dashboard') }}"
                           class="flex items-center justify-between {{ Request::is('dashboard*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.33333 8.33333V16.6667H7.5V12.5C7.5 11.5795 8.24619 10.8333 9.16667 10.8333H10.8333C11.7538 10.8333 12.5 11.5795 12.5 12.5V16.6667H16.6667V8.33333L10 3.33333L3.33333 8.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1.66667 10L10 3.33333L18.3333 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Dashboard</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Layanan Anak -->
            @if(!empty($PermissionBermain) || !empty($PermissionBimbel) || !empty($PermissionDaycare) || !empty($PermissionStimulasi))
            <div class="item-wrapper mb-5">
                <h4 class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50">
                    Layanan Anak
                </h4>
                <ul class="mt-2.5">
                    @if(!empty($PermissionBermain))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('bermain.index') }}"
                           class="flex items-center justify-between {{ Request::is('bermain*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 3.33333C7.5 3.33333 5 4.16667 5 6.66667C5 7.5 5.83333 8.33333 5.83333 8.33333C5.83333 8.33333 5 9.16667 5 10C5 10.8333 5.83333 11.6667 5.83333 11.6667C5.83333 11.6667 5 12.5 5 13.3333C5 15.8333 7.5 16.6667 10 16.6667C12.5 16.6667 15 15.8333 15 13.3333C15 12.5 14.1667 11.6667 14.1667 11.6667C14.1667 11.6667 15 10.8333 15 10C15 9.16667 14.1667 8.33333 14.1667 8.33333C14.1667 8.33333 15 7.5 15 6.66667C15 4.16667 12.5 3.33333 10 3.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.5 6.66667H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.5 10H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.5 13.3333H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Bermain</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionBimbel))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('bimbel.index') }}"
                           class="flex items-center justify-between {{ Request::is('bimbel*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.66667 15.8333C6.66667 14.9128 7.01786 14.0295 7.64298 13.4044C8.2681 12.7793 9.15145 12.4281 10.0719 12.4281H16.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.9997 14.1666L16.6663 15.8333L14.9997 17.4999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.33301 7.49992C3.33301 6.57944 3.68421 5.69609 4.30933 5.07097C4.93445 4.44585 5.8178 4.09465 6.73828 4.09465H13.333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M11.6663 5.83325L13.333 4.16659L11.6663 2.49992" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Bimbel</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionDaycare))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('daycare.index') }}"
                           class="flex items-center justify-between {{ Request::is('daycare*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 10.8333C11.3807 10.8333 12.5 9.71396 12.5 8.33325C12.5 6.95254 11.3807 5.83325 10 5.83325C8.61929 5.83325 7.5 6.95254 7.5 8.33325C7.5 9.71396 8.61929 10.8333 10 10.8333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.1663 16.6667C14.1663 13.9053 12.3444 11.6667 9.99967 11.6667C7.65496 11.6667 5.83301 13.9053 5.83301 16.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.8333 3.3335H4.16667C3.24619 3.3335 2.5 4.07969 2.5 5.00016V15.0002C2.5 15.9206 3.24619 16.6668 4.16667 16.6668H15.8333C16.7538 16.6668 17.5 15.9206 17.5 15.0002V5.00016C17.5 4.07969 16.7538 3.3335 15.8333 3.3335Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Daycare</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionStimulasi))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('stimulasi.index') }}"
                           class="flex items-center justify-between {{ Request::is('stimulasi*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.33301 13.3332L11.6663 9.99984L8.33301 6.6665" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.33333 16.6668H16.6667C17.1087 16.6668 17.5326 16.4912 17.8452 16.1786C18.1577 15.8661 18.3333 15.4421 18.3333 15.0002V5.00016C18.3333 4.55814 18.1577 4.13421 17.8452 3.82165C17.5326 3.50909 17.1087 3.3335 16.6667 3.3335H3.33333C2.89131 3.3335 2.46738 3.50909 2.15482 3.82165C1.84226 4.13421 1.66667 4.55814 1.66667 5.00016V15.0002C1.66667 15.4421 1.84226 15.8661 2.15482 16.1786C2.46738 16.4912 2.89131 16.6668 3.33333 16.6668Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Stimulasi</span>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @endif

            <!-- Konten -->
            @if(!empty($PermissionEvent) || !empty($PermissionJournal) || !empty($PermissionArticle) || !empty($PermissionGallery))
            <div class="item-wrapper mb-5">
                <h4 class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50">
                    Konten
                </h4>
                <ul class="mt-2.5">
                    @if(!empty($PermissionGallery))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('gallery.index') }}"
                           class="flex items-center justify-between {{ Request::is('gallery*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 3.3335H3.33333C2.41286 3.3335 1.66667 4.07969 1.66667 5.00016V15.0002C1.66667 15.9206 2.41286 16.6668 3.33333 16.6668H16.6667C17.5871 16.6668 18.3333 15.9206 18.3333 15.0002V5.00016C18.3333 4.07969 17.5871 3.3335 16.6667 3.3335Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1.66667 11.6665L5.83333 7.49984C6.06944 7.28318 6.3731 7.1665 6.6875 7.1665C7.0019 7.1665 7.30556 7.28318 7.54167 7.49984L12.5 12.4998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.5 9.1665L13.75 7.9165C13.9861 7.69984 14.2898 7.58317 14.6042 7.58317C14.9186 7.58317 15.2222 7.69984 15.4583 7.9165L18.3333 10.8332" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M13.3333 13.3335C13.3333 13.7755 12.9753 14.1668 12.5 14.1668C12.0247 14.1668 11.6667 13.7755 11.6667 13.3335C11.6667 12.8915 12.0247 12.5002 12.5 12.5002C12.9753 12.5002 13.3333 12.8915 13.3333 13.3335Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Galeri</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(!empty($PermissionArticle))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('article.master') }}"
                           class="flex items-center justify-between {{ Request::is('article*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 16.6668H3.33333C2.89131 16.6668 2.46738 16.4912 2.15482 16.1786C1.84226 15.8661 1.66667 15.4421 1.66667 15.0002V5.00016C1.66667 4.55814 1.84226 4.13421 2.15482 3.82165C2.46738 3.50909 2.89131 3.3335 3.33333 3.3335H16.6667C17.1087 3.3335 17.5326 3.50909 17.8452 3.82165C18.1577 4.13421 18.3333 4.55814 18.3333 5.00016V15.0002C18.3333 15.4421 18.1577 15.8661 17.8452 16.1786C17.5326 16.4912 17.1087 16.6668 16.6667 16.6668Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5 7.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5 10.8335H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5 14.1665H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Artikel</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionTentang))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('tentang.edit') }}"
                           class="flex items-center justify-between {{ Request::is('tentang/edit*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.99935 13.3332C12.3007 13.3332 14.166 11.4678 14.166 9.1665C14.166 6.86517 12.3007 4.99984 9.99935 4.99984C7.69802 4.99984 5.83268 6.86517 5.83268 9.1665C5.83268 11.4678 7.69802 13.3332 9.99935 13.3332Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 1.6665V2.49984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 3.33301L14.375 3.95801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18.3327 8.33301H17.4993" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 13.333L14.375 12.708" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 16.6665V15.8332" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5 13.333L5.625 12.708" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1.66602 8.33301H2.49935" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5 3.33301L5.625 3.95801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Edit Tentang Kami</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionEvent))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('event.index') }}"
                           class="flex items-center justify-between {{ Request::is('event') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 2.5V5.83333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.66699 2.5V5.83333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M2.5 9.16667H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.6667 7.5V15.8333C16.6667 16.75 15.9167 17.5 15 17.5H5C4.08333 17.5 3.33333 16.75 3.33333 15.8333V7.5C3.33333 6.58333 4.08333 5.83333 5 5.83333H15C15.9167 5.83333 16.6667 6.58333 16.6667 7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9.99609 12.0835H10.0036" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.07031 12.0835H7.07782" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.07031 14.1665H7.07782" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Event</span>
                            </div>
                        </a>
                    </li>

                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('event.master') }}"
                           class="flex items-center justify-between {{ Request::is('event/master*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1.66675 10.0002H4.16675" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.8333 10.0002H18.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.75 15.4167L5.58333 13.5833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.4167 6.41667L16.25 4.58334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.75 4.58334L5.58333 6.41667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.4167 13.5833L16.25 15.4167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Master Event</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionJournal))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('journal.index') }}"
                           class="flex items-center justify-between {{ Request::is('journal*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.8333 1.66667H5.83333C5.39131 1.66667 4.96738 1.84226 4.65482 2.15482C4.34226 2.46738 4.16667 2.89131 4.16667 3.33333V16.6667C4.16667 17.1087 4.34226 17.5326 4.65482 17.8452C4.96738 18.1577 5.39131 18.3333 5.83333 18.3333H14.1667C14.6087 18.3333 15.0326 18.1577 15.3452 17.8452C15.6577 17.5326 15.8333 17.1087 15.8333 16.6667V6.66667L10.8333 1.66667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10.8335 1.66667V6.66667H15.8335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.5002 10.8333H7.5835" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.5002 14.1667H7.5835" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9.16667 7.5H8.33333H7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Journal</span>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @endif

            <!-- Pengaturan -->
            @if(!empty($PermissionUser) || !empty($PermissionRole) || !empty($PermissionLayanan))
            <div class="item-wrapper mb-5">
                <h4 class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50">
                    Pengaturan
                </h4>
                <ul class="mt-2.5">
                    @if(!empty($PermissionUser))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('user.list') }}"
                           class="flex items-center justify-between {{ Request::is('user*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 12.5C12.7614 12.5 15 10.2614 15 7.5C15 4.73858 12.7614 2.5 10 2.5C7.23858 2.5 5 4.73858 5 7.5C5 10.2614 7.23858 12.5 10 12.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M2.5 17.5C2.5 13.9025 5.9025 11 10 11C14.0975 11 17.5 13.9025 17.5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">User</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionRole))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('role.list') }}"
                           class="flex items-center justify-between {{ Request::is('role*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 13.3333C13.6819 13.3333 16.6667 10.3486 16.6667 6.66667C16.6667 2.98477 13.6819 0 10 0C6.31811 0 3.33334 2.98477 3.33334 6.66667C3.33334 10.3486 6.31811 13.3333 10 13.3333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.84166 12.3583L5.83333 20L10 17.5L14.1667 20L13.1583 12.35" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Role</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(!empty($PermissionLayanan))
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="{{ route('layanan') }}"
                           class="flex items-center justify-between {{ Request::is('layanan*') ? 'active' : '' }}">
                            <div class="flex items-center space-x-2.5">
                                <span class="item-ico">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.33333 3.33334H16.6667C17.5833 3.33334 18.3333 4.08334 18.3333 5.00001V15C18.3333 15.9206 17.5833 16.6667 16.6667 16.6667H3.33333C2.41666 16.6667 1.66666 15.9167 1.66666 15V5.00001C1.66666 4.08334 2.41666 3.33334 3.33333 3.33334Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18.3333 5L10 10.8333L1.66666 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="item-text text-lg font-medium leading-none">Layanan</span>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @endif
        </div>
    </div>
</aside>

<div style="z-index: 25" class="aside-overlay fixed left-0 top-0 block h-full w-full bg-black bg-opacity-30 sm:hidden">
</div>

<aside class="relative hidden w-[96px] bg-white dark:bg-black sm:block">
    <div class="sidebar-wrapper-collapse relative top-0 z-30 w-full">
        <div class="sidebar-header sticky top-0 z-20 flex h-[108px] w-full items-center justify-center border-b border-r border-b-[#F7F7F7] border-r-[#F7F7F7] bg-white dark:border-darkblack-500 dark:bg-darkblack-600">
            <a href="/">
                <img src="{{ asset('images/logo/logo-icon.svg') }}"
                     class="h-10 w-10 object-contain"
                     alt="Little Star Kids Icon" />
            </a>
        </div>
        <div class="sidebar-body w-full pt-[14px]">
            <div class="flex flex-col items-center">
                <div class="nav-wrapper mb-[36px]">
                    <div class="item-wrapper mb-5">
                        <ul class="mt-2.5 flex flex-col items-center justify-center">
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ url('/dashboard') }}" class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33333 8.33333V16.6667H7.5V12.5C7.5 11.5795 8.24619 10.8333 9.16667 10.8333H10.8333C11.7538 10.8333 12.5 11.5795 12.5 12.5V16.6667H16.6667V8.33333L10 3.33333L3.33333 8.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M1.66667 10L10 3.33333L18.3333 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @if(!empty($PermissionBermain))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('bermain.index') }}" class="{{ Request::is('bermain*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 3.33333C7.5 3.33333 5 4.16667 5 6.66667C5 7.5 5.83333 8.33333 5.83333 8.33333C5.83333 8.33333 5 9.16667 5 10C5 10.8333 5.83333 11.6667 5.83333 11.6667C5.83333 11.6667 5 12.5 5 13.3333C5 15.8333 7.5 16.6667 10 16.6667C12.5 16.6667 15 15.8333 15 13.3333C15 12.5 14.1667 11.6667 14.1667 11.6667C14.1667 11.6667 15 10.8333 15 10C15 9.16667 14.1667 8.33333 14.1667 8.33333C14.1667 8.33333 15 7.5 15 6.66667C15 4.16667 12.5 3.33333 10 3.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.5 6.66667H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.5 10H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.5 13.3333H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionBimbel))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('bimbel.index') }}" class="{{ Request::is('bimbel*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.66667 15.8333C6.66667 14.9128 7.01786 14.0295 7.64298 13.4044C8.2681 12.7793 9.15145 12.4281 10.0719 12.4281H16.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.9997 14.1666L16.6663 15.8333L14.9997 17.4999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3.33301 7.49992C3.33301 6.57944 3.68421 5.69609 4.30933 5.07097C4.93445 4.44585 5.8178 4.09465 6.73828 4.09465H13.333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11.6663 5.83325L13.333 4.16659L11.6663 2.49992" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionUser))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('user.list') }}" class="{{ Request::is('user*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 12.5C12.7614 12.5 15 10.2614 15 7.5C15 4.73858 12.7614 2.5 10 2.5C7.23858 2.5 5 4.73858 5 7.5C5 10.2614 7.23858 12.5 10 12.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2.5 17.5C2.5 13.9025 5.9025 11 10 11C14.0975 11 17.5 13.9025 17.5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionRole))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('role.list') }}" class="{{ Request::is('role*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 13.3333C13.6819 13.3333 16.6667 10.3486 16.6667 6.66667C16.6667 2.98477 13.6819 0 10 0C6.31811 0 3.33334 2.98477 3.33334 6.66667C3.33334 10.3486 6.31811 13.3333 10 13.3333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.84166 12.3583L5.83333 20L10 17.5L14.1667 20L13.1583 12.35" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionLayanan))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('layanan') }}" class="{{ Request::is('layanan*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33333 3.33334H16.6667C17.5833 3.33334 18.3333 4.08334 18.3333 5.00001V15C18.3333 15.9206 17.5833 16.6667 16.6667 16.6667H3.33333C2.41666 16.6667 1.66666 15.9167 1.66666 15V5.00001C1.66666 4.08334 2.41666 3.33334 3.33333 3.33334Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.3333 5L10 10.8333L1.66666 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionJournal))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('journal.index') }}" class="{{ Request::is('journal*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.8333 1.66667H5.83333C5.39131 1.66667 4.96738 1.84226 4.65482 2.15482C4.34226 2.46738 4.16667 2.89131 4.16667 3.33333V16.6667C4.16667 17.1087 4.34226 17.5326 4.65482 17.8452C4.96738 18.1577 5.39131 18.3333 5.83333 18.3333H14.1667C14.6087 18.3333 15.0326 18.1577 15.3452 17.8452C15.6577 17.5326 15.8333 17.1087 15.8333 16.6667V6.66667L10.8333 1.66667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10.8335 1.66667V6.66667H15.8335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12.5002 10.8333H7.5835" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12.5002 14.1667H7.5835" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.16667 7.5H8.33333H7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionEvent))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('event.index') }}" class="{{ Request::is('event') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.3333 2.5V5.83333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.66699 2.5V5.83333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2.5 9.16667H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16.6667 7.5V15.8333C16.6667 16.75 15.9167 17.5 15 17.5H5C4.08333 17.5 3.33333 16.75 3.33333 15.8333V7.5C3.33333 6.58333 4.08333 5.83333 5 5.83333H15C15.9167 5.83333 16.6667 6.58333 16.6667 7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.99609 12.0835H10.0036" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.07031 12.0835H7.07782" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.07031 14.1665H7.07782" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('event.master') }}" class="{{ Request::is('event/master*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M1.66675 10.0002H4.16675" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.8333 10.0002H18.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3.75 15.4167L5.58333 13.5833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.4167 6.41667L16.25 4.58334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3.75 4.58334L5.58333 6.41667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.4167 13.5833L16.25 15.4167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionDaycare))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('daycare.index') }}" class="{{ Request::is('daycare*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 10.8333C11.3807 10.8333 12.5 9.71396 12.5 8.33325C12.5 6.95254 11.3807 5.83325 10 5.83325C8.61929 5.83325 7.5 6.95254 7.5 8.33325C7.5 9.71396 8.61929 10.8333 10 10.8333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.1663 16.6667C14.1663 13.9053 12.3444 11.6667 9.99967 11.6667C7.65496 11.6667 5.83301 13.9053 5.83301 16.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.8333 3.3335H4.16667C3.24619 3.3335 2.5 4.07969 2.5 5.00016V15.0002C2.5 15.9206 3.24619 16.6668 4.16667 16.6668H15.8333C16.7538 16.6668 17.5 15.9206 17.5 15.0002V5.00016C17.5 4.07969 16.7538 3.3335 15.8333 3.3335Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($PermissionStimulasi))
                            <li class="item px-[43px] py-[11px]">
                                <a href="{{ route('stimulasi.index') }}" class="{{ Request::is('stimulasi*') ? 'active' : '' }}">
                                    <span class="item-ico">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.33301 13.3332L11.6663 9.99984L8.33301 6.6665" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3.33333 16.6668H16.6667C17.1087 16.6668 17.5326 16.4912 17.8452 16.1786C18.1577 15.8661 18.3333 15.4421 18.3333 15.0002V5.00016C18.3333 4.55814 18.1577 4.13421 17.8452 3.82165C17.5326 3.50909 17.1087 3.3335 16.6667 3.3335H3.33333C2.89131 3.3335 2.46738 3.50909 2.15482 3.82165C1.84226 4.13421 1.66667 4.55814 1.66667 5.00016V15.0002C1.66667 15.4421 1.84226 15.8661 2.15482 16.1786C2.46738 16.4912 2.89131 16.6668 3.33333 16.6668Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
<style>
    /* Sidebar Container */
    .sidebar-wrapper {
        width: 308px;
        position: fixed;
        height: 100vh;
        transition: all 0.3s ease;
    }

    /* Logo */
    .sidebar-header img {
        height: 60px;
        width: auto;
        object-fit: contain;
    }

    /* Menu Items */
    .nav-wrapper .item {
        padding: 0.75rem 1rem;
        margin-bottom: 0.25rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .nav-wrapper .item:hover {
        background-color: rgba(34, 197, 94, 0.1);
    }

    .nav-wrapper .item a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: inherit;
        text-decoration: none;
    }

    /* Active State */
    .nav-wrapper .item a.active {
        color: #22C55E;
    }

    .nav-wrapper .item a.active .item-ico svg {
        stroke: #22C55E;
    }

    /* Dark Mode */
    .dark .sidebar-wrapper {
        background-color: #1a1a1a;
        border-right: 1px solid #2d2d2d;
    }

    .dark .nav-wrapper .item:hover {
        background-color: rgba(34, 197, 94, 0.05);
    }

    /* Scrollbar */
    .sidebar-body::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-body::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 4px;
    }

    .dark .sidebar-body::-webkit-scrollbar-thumb {
        background: #404040;
    }
</style>
