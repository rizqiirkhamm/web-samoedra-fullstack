@extends('users.layouts.app')

@section('title', 'Add User')

@section('content')
<div class="w-full">
    <div class="mb-6">
        <h4 class="text-xl font-semibold text-bgray-900 dark:text-white">
                        Add New User
        </h4>
        <p class="text-sm text-bgray-600 dark:text-bgray-50">
            Create a new user account
        </p>
                </div>

    <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-bgray-200 pb-5 dark:border-darkblack-400">
                <div>
                <h4 class="text-xl font-bold text-bgray-900 dark:text-white">User Details</h4>
                <p class="text-sm font-medium text-bgray-600 dark:text-bgray-50">
                    Fill in the information below to create a new user
                </p>
            </div>
            <a href="{{ route('user') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-bgray-200 px-5 text-sm font-medium text-bgray-700 hover:bg-bgray-300 lg:px-6 xl:h-12 dark:bg-darkblack-500 dark:text-white dark:hover:bg-darkblack-400">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                </span>
                Back to Users
            </a>
        </div>

        <div class="mt-6">
            <form method="post" action="">
                @csrf
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-bgray-900 dark:text-white">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-bgray-50 border border-bgray-200 text-bgray-900 text-sm rounded-lg focus:ring-success-300 focus:border-success-300 block w-full p-3 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white" placeholder="Enter full name" required>
                        <div class="text-red-500">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-bgray-900 dark:text-white">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-bgray-50 border border-bgray-200 text-bgray-900 text-sm rounded-lg focus:ring-success-300 focus:border-success-300 block w-full p-3 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white" placeholder="name@example.com" required>
                        <div class="text-red-500">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-bgray-900 dark:text-white">Password</label>
                        <input type="password" id="password" name="password" class="bg-bgray-50 border border-bgray-200 text-bgray-900 text-sm rounded-lg focus:ring-success-300 focus:border-success-300 block w-full p-3 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white" placeholder="•••••••••" required>
                        <div class="text-red-500">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                </div>

                    <div class="mb-5">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-bgray-900 dark:text-white">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="bg-bgray-50 border border-bgray-200 text-bgray-900 text-sm rounded-lg focus:ring-success-300 focus:border-success-300 block w-full p-3 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white" placeholder="•••••••••" required>
                </div>

                    <div class="mb-5">
                        <label for="user_type" class="block mb-2 text-sm font-medium text-bgray-900 dark:text-white">Role</label>
                        <select id="user_type" name="user_type" class="bg-bgray-50 border border-bgray-200 text-bgray-900 text-sm rounded-lg focus:ring-success-300 focus:border-success-300 block w-full p-3 dark:bg-darkblack-500 dark:border-darkblack-400 dark:placeholder-gray-400 dark:text-white">
                        <option value="">Select Role</option>
                        @foreach ($getRole as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                        <div class="text-red-500">
                            @error('user_type')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('user') }}" class="inline-flex h-12 items-center justify-center rounded-md border border-bgray-200 bg-white px-6 text-base font-medium text-bgray-700 hover:bg-bgray-50 dark:border-darkblack-400 dark:bg-darkblack-600 dark:text-white dark:hover:bg-darkblack-500">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex h-12 items-center justify-center rounded-md bg-success-300 px-6 text-base font-medium text-white hover:bg-success-400">
                        Create User
                    </button>
                </div>
            </form>
            </div>
    </div>
</div>
@endsection
