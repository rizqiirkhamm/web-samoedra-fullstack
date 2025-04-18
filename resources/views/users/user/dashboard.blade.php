@extends('users.layouts.app')

@section('title', 'User Management')

@section('content')
<div class="w-full">
    <div class="mb-6">
        <h4 class="text-xl font-semibold text-bgray-900 dark:text-white">
            User Management
        </h4>
        <p class="text-sm text-bgray-600 dark:text-bgray-50">
            Manage all users in the system
        </p>
    </div>

    <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-bgray-200 pb-5 dark:border-darkblack-400">
            <div>
                <h4 class="text-xl font-bold text-bgray-900 dark:text-white">Users List</h4>
                <p class="text-sm font-medium text-bgray-600 dark:text-bgray-50">
                    Manage all user accounts
                </p>
            </div>

                    @if (!empty($PermissionAdd))
            <a href="{{ route('user.add') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-success-300 px-5 text-sm font-medium text-white hover:bg-success-400 lg:px-6 xl:h-12">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                </span>
                Add New User
            </a>
                    @endif
        </div>

                    <div class="flex flex-col space-y-5 mt-5 w-full">
                        <div class="flex h-[56px] w-full space-x-4">
                <div class="hidden h-full rounded-lg border border-transparent bg-bgray-100 px-[18px] focus-within:border-success-300 dark:bg-darkblack-500 sm:block sm:w-70 lg:w-88">
                                <div class="flex h-full w-full items-center space-x-[15px]">
                                    <span>
                            <svg class="stroke-bgray-900 dark:stroke-white" width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="9.80204" cy="10.6761" r="8.98856" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.0537 17.3945L19.5777 20.9094" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <label for="listSearch" class="w-full">
                            <input type="text" id="listSearch" placeholder="Search by name, email, or others..." class="search-input w-full border-none bg-bgray-100 px-0 text-sm tracking-wide text-bgray-600 placeholder:text-sm placeholder:font-medium placeholder:text-bgray-500 focus:outline-none focus:ring-0 dark:bg-darkblack-500 dark:text-white dark:placeholder:text-bgray-400" />
                                    </label>
                                </div>
                            </div>
                            <div class="relative h-full flex-1">
                    <button onclick="dateFilterAction('#table-filter')" type="button" class="flex h-full w-full items-center justify-center rounded-lg border border-bgray-300 bg-bgray-100 dark:border-darkblack-400 dark:bg-darkblack-500">
                                    <div class="flex items-center space-x-3">
                                        <span>
                                <svg class="stroke-bgray-900 dark:stroke-success-400" width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.55169 13.5022H1.25098" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.3623 3.80984H16.663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.94797 3.75568C5.94797 2.46002 4.88981 1.40942 3.58482 1.40942C2.27984 1.40942 1.22168 2.46002 1.22168 3.75568C1.22168 5.05133 2.27984 6.10193 3.58482 6.10193C4.88981 6.10193 5.94797 5.05133 5.94797 3.75568Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2214 13.4632C17.2214 12.1675 16.1641 11.1169 14.8591 11.1169C13.5533 11.1169 12.4951 12.1675 12.4951 13.4632C12.4951 14.7589 13.5533 15.8095 14.8591 15.8095C16.1641 15.8095 17.2214 14.7589 17.2214 13.4632Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span class="text-base font-medium text-success-300">Filters</span>
                                    </div>
                                </button>
                    <div id="table-filter" class="absolute right-0 top-[60px] z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                                    <ul>
                            <li onclick="dateFilterAction('#table-filter')" class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                            January
                                        </li>
                            <li onclick="dateFilterAction('#table-filter')" class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                            February
                                        </li>
                            <li onclick="dateFilterAction('#table-filter')" class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                            March
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="table-content w-full overflow-x-auto">
                            <table class="w-full min-w-full">
                    <thead>
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                            <th class="px-6 py-5 text-left">
                                <div class="flex items-center space-x-2.5">
                                    <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Name</span>
                                            <span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                            </th>
                            <th class="px-6 py-5 text-left">
                                <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Email</span>
                                            <span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                            </th>
                            <th class="px-6 py-5 text-left">
                                <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Role</span>
                                            <span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                            </th>
                            <th class="px-6 py-5 text-left">
                                <div class="flex items-center space-x-2.5">
                                            <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Created</span>
                                            <span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                            </th>
                            <th class="px-6 py-5 text-right">
                                <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Actions</span>
                            </th>
                                </tr>
                    </thead>
                    <tbody>
                                @foreach ($getRecord as $value)
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-2.5">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-bgray-100 dark:bg-darkblack-500">
                                        <span class="text-base font-medium text-bgray-900 dark:text-white">{{ substr($value->name, 0, 1) }}</span>
                                    </div>
                                            <p class="text-base font-semibold text-bgray-900 dark:text-white">
                                                {{ $value->name }}
                                            </p>
                                        </div>
                                    </td>
                            <td class="px-6 py-5">
                                        <p class="text-base font-medium text-bgray-900 dark:text-white">
                                            {{ $value->email }}
                                        </p>
                                    </td>
                            <td class="px-6 py-5">
                                <p class="inline-flex rounded-full bg-success-50 px-3 py-1 text-sm font-medium text-success-500 dark:bg-success-900 dark:text-success-300">
                                            {{ $value->role_name }}
                                        </p>
                                    </td>
                            <td class="px-6 py-5">
                                        <p class="text-base font-medium text-bgray-900 dark:text-white">
                                    {{ $value->created_at->format('d M Y') }}
                                        </p>
                                    </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end space-x-2.5">
                                     @if (!empty($PermissionEdit))
                                    <a href="{{ url('/user/edit/' . $value->id) }}" class="flex h-9 w-9 items-center justify-center rounded-full bg-bgray-100 text-bgray-700 hover:bg-success-300 hover:text-white dark:bg-darkblack-500 dark:text-bgray-300 dark:hover:bg-success-300 dark:hover:text-white">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.823 2.1769C13.529 1.88285 13.1382 1.75 12.7289 1.75C12.3196 1.75 11.9288 1.88285 11.6349 2.1769L4.00002 9.81168V12H6.18831L13.823 4.36509C14.1171 4.07115 14.2499 3.68038 14.2499 3.271C14.2499 2.86162 14.1171 2.47085 13.823 2.1769Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        </a>
                                        @endif
                                     @if (!empty($PermissionDelete))
                                    <a href="{{ url('/user/delete/' . $value->id) }}" class="flex h-9 w-9 items-center justify-center rounded-full bg-bgray-100 text-bgray-700 hover:bg-danger-300 hover:text-white dark:bg-darkblack-500 dark:text-bgray-300 dark:hover:bg-danger-300 dark:hover:text-white"
                                       onclick="return confirm('Are you sure you want to delete this user?')">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.33334 4.00001V2.66668C5.33334 2.31305 5.47381 1.97392 5.72386 1.72387C5.97391 1.47382 6.31305 1.33334 6.66667 1.33334H9.33334C9.68696 1.33334 10.0261 1.47382 10.2761 1.72387C10.5262 1.97392 10.6667 2.31305 10.6667 2.66668V4.00001M12.6667 4.00001V13.3333C12.6667 13.687 12.5262 14.0261 12.2761 14.2762C12.0261 14.5262 11.687 14.6667 11.3333 14.6667H4.66667C4.31305 14.6667 3.97391 14.5262 3.72386 14.2762C3.47381 14.0261 3.33334 13.687 3.33334 13.3333V4.00001H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        </a>
                                        @endif
                                </div>
                                    </td>
                                </tr>
                                @endforeach
                    </tbody>
                            </table>
                        </div>

            <!-- Pagination -->
                        <div class="pagination-content w-full mt-auto">
                            <div class="flex w-full items-center justify-center lg:justify-between">
                                <div class="hidden items-center space-x-4 lg:flex">
                        <span class="text-sm font-semibold text-bgray-600 dark:text-bgray-50">Show result:</span>
                                    <div class="relative">
                                        <button onclick="dateFilterAction('#result-filter')" type="button"
                                            class="flex items-center space-x-6 rounded-lg border border-bgray-300 px-2.5 py-[14px] dark:border-darkblack-400">
                                            <span class="text-sm font-semibold text-bgray-900 dark:text-bgray-50">3</span>
                                            <span>
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.03516 6.03271L8.03516 10.0327L12.0352 6.03271" stroke="#A0AEC0"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </button>
                                        <div id="result-filter"
                                class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                                            <ul>
                                                <li onclick="dateFilterAction('#result-filter')"
                                        class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-medium hover:bg-bgray-100 dark:text-white dark:hover:bg-darkblack-600">
                                                    1
                                                </li>
                                                <li onclick="dateFilterAction('#result-filter')"
                                        class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100 dark:text-white dark:hover:bg-darkblack-600">
                                                    2
                                                </li>
                                                <li onclick="dateFilterAction('#result-filter')"
                                        class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100 dark:text-white dark:hover:bg-darkblack-600">
                                                    3
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-5 sm:space-x-[35px]">
                        <!-- Pagination controls would go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
