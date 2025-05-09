@extends('users.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- write your code here-->
<div class="2xl:flex 2xl:space-x-[48px]">
    <section class="mb-6 2xl:mb-0 2xl:flex-1">

        <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600 shadow-md border border-gray-100 dark:border-darkblack-400 hover:shadow-lg transition-all duration-200">
            @if (!empty($PermissionAdd))
                <a href="{{ route('role.add') }}"> <button
                    class="h-12 w-full rounded-md border border-success-300 text-base font-medium text-success-300 transition duration-300 ease-in-out hover:bg-success-300 hover:text-white">
                    Add
                </button></a>
                @endif
            <div class="flex flex-col space-y-5 mt-5">
                <div class="flex h-[56px] w-full space-x-4">
                    <div
                        class="hidden h-full rounded-lg border border-transparent bg-bgray-100 px-[18px] focus-within:border-success-300 dark:bg-darkblack-500 sm:block sm:w-70 lg:w-88">
                        <div class="flex h-full w-full items-center space-x-[15px]">
                            <span>
                                <svg class="stroke-bgray-900 dark:stroke-white" width="21" height="22"
                                    viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9.80204" cy="10.6761" r="8.98856" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.0537 17.3945L19.5777 20.9094" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <label for="listSearch" class="w-full">
                                <input type="text" id="listSearch" placeholder="Search by name, email, or others..."
                                    class="search-input w-full border-none bg-bgray-100 px-0 text-sm tracking-wide text-bgray-600 placeholder:text-sm placeholder:font-medium placeholder:text-bgray-500 focus:outline-none focus:ring-0 dark:bg-darkblack-500" />
                            </label>
                        </div>
                    </div>
                    <div class="relative h-full flex-1">
                        <button onclick="dateFilterAction('#table-filter')" type="button"
                            class="flex h-full w-full items-center justify-center rounded-lg border border-bgray-300 bg-bgray-100 dark:border-darkblack-500 dark:bg-darkblack-500">
                            <div class="flex items-center space-x-3">
                                <span>
                                    <svg class="stroke-bgray-900 dark:stroke-success-400" width="18" height="17"
                                        viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.55169 13.5022H1.25098" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10.3623 3.80984H16.663" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.94797 3.75568C5.94797 2.46002 4.88981 1.40942 3.58482 1.40942C2.27984 1.40942 1.22168 2.46002 1.22168 3.75568C1.22168 5.05133 2.27984 6.10193 3.58482 6.10193C4.88981 6.10193 5.94797 5.05133 5.94797 3.75568Z"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17.2214 13.4632C17.2214 12.1675 16.1641 11.1169 14.8591 11.1169C13.5533 11.1169 12.4951 12.1675 12.4951 13.4632C12.4951 14.7589 13.5533 15.8095 14.8591 15.8095C16.1641 15.8095 17.2214 14.7589 17.2214 13.4632Z"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="text-base font-medium text-success-300">Filters</span>
                            </div>
                        </button>
                        <div id="table-filter"
                            class="absolute right-0 top-[60px] z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                            <ul>
                                <li onclick="dateFilterAction('#table-filter')"
                                    class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    January
                                </li>
                                <li onclick="dateFilterAction('#table-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    February
                                </li>

                                <li onclick="dateFilterAction('#table-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    March
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="table-content w-full overflow-x-auto">
                    <table class="w-full">
                        <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                            <td class="inline-block w-[250px] px-6 py-5 lg:w-auto ">
                                <div class="flex w-full items-center space-x-2.5">
                                    <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">
                                        Name</span>
                                    <span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-5 ">
                                <div class="flex w-full items-center space-x-2.5">
                                    <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Date</span>
                                    <span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                            </td>

                        @foreach ($getRecord as $value)

                        <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                            <td class="px-6 py-5 ">
                                <div class="flex w-full items-center space-x-2.5">
                                    <p class="text-base font-semibold text-bgray-900 dark:text-white">
                                        {{ $value->name }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 ">
                                <p class="text-base font-medium text-bgray-900 dark:text-white">
                                    {{ $value->created_at }}
                                </p>
                            </td>
                            <td class="px-6 py-5  flex justify-end space-x-2.5">
                             @if (!empty($PermissionEdit))
                                <a href="{{  url('/role/edit/' . $value->id) }}"> <button class="h-12 w-32 rounded-md border border-bgray-600 bg-white text-base text-bgray-600 transition duration-300 ease-in-out hover:bg-bgray-600 hover:text-white dark:bg-darkblack-600 dark:text-bgray-300">
                                    Edit
                                  </button>
                                </a>
                                @endif
                            @if (!empty($PermissionDelete))
                                <a href="{{ url('/role/delete/' . $value->id) }}"><button class="h-12 w-32 rounded-md border border-bgray-600 bg-white text-base text-bgray-600 transition duration-300 ease-in-out hover:bg-bgray-600 hover:text-white dark:bg-darkblack-600 dark:text-bgray-300">
                                    Delete
                                  </button>
                                </a>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="pagination-content w-full">
                    <div class="flex w-full items-center justify-center lg:justify-between">
                        <div class="hidden items-center space-x-4 lg:flex">
                            <span class="text-sm font-semibold text-bgray-600 dark:text-bgray-50">Show
                                result:</span>
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
                                    class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg">
                                    <ul>
                                        <li onclick="dateFilterAction('#result-filter')"
                                            class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-medium hover:bg-bgray-100">
                                            1
                                        </li>
                                        <li onclick="dateFilterAction('#result-filter')"
                                            class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100">
                                            2
                                        </li>

                                        <li onclick="dateFilterAction('#result-filter')"
                                            class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100">
                                            3
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-5 sm:space-x-[35px]">
                            <button type="button">
                                <span>
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.7217 5.03271L7.72168 10.0327L12.7217 15.0327" stroke="#A0AEC0"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </button>
                            <div class="flex items-center">
                                <button type="button"
                                    class="rounded-lg bg-success-50 px-4 py-1.5 text-xs font-bold text-success-300 dark:bg-darkblack-500 dark:text-bgray-50 lg:px-6 lg:py-2.5 lg:text-sm">
                                    1
                                </button>
                                <button type="button"
                                    class="rounded-lg px-4 py-1.5 text-xs font-bold text-bgray-500 transition duration-300 ease-in-out hover:bg-success-50 hover:text-success-300 dark:hover:bg-darkblack-500 lg:px-6 lg:py-2.5 lg:text-sm">
                                    2
                                </button>

                                <span class="text-sm text-bgray-500">. . . .</span>
                                <button type="button"
                                    class="rounded-lg px-4 py-1.5 text-xs font-bold text-bgray-500 transition duration-300 ease-in-out hover:bg-success-50 hover:text-success-300 dark:hover:bg-darkblack-500 lg:px-6 lg:py-2.5 lg:text-sm">
                                    20
                                </button>
                            </div>
                            <button type="button">
                                <span>
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.72168 5.03271L12.7217 10.0327L7.72168 15.0327" stroke="#A0AEC0"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
