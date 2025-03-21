@extends('users.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- write your code here-->
<div class="rounded-lg bg-white dark:bg-darkblack-600 px-6 py-8">
    <div class=" justify-between gap-12">
        <!-- Form -->
        <form action="" method="post">
            @csrf
            <div class="grid md:grid-rows-2 gap-8">
                <div>
                    <label for="name" class="block text-base dark:text-bgray-50 font-medium text-bgray-600 mb-2">
                        Add New User
                    </label>
                    <input type="text" name="name" required
                        class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full"
                    value="{{ old('name') }}"    placeholder="Name" />
                </div>

                <div>
                    <label for="email" class="block text-base dark:text-bgray-50 font-medium text-bgray-600 mb-2">
                        Add New Email
                    </label>
                    <input type="email" name="email" required
                        class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full"
                        value="{{ old('email') }}"    placeholder="Email" />
                        <div style="color:red">{{ $errors->first('email') }}</div>
                </div>

                <div>
                    <label for="password" class="block text-base dark:text-bgray-50 font-medium text-bgray-600 mb-2">
                        Add New Password
                    </label>
                    <input type="password" name="password" required
                        class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full"
                        placeholder="Password" />
                </div>

                <div>
                    <label for="role" class="block text-base dark:text-bgray-50 font-medium text-bgray-600 mb-2">
                        Add New Role
                    </label>
                    <select name="role_id" required class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border focus:border-success-300 focus:ring-0 w-full">
                        <option value="">Select Role</option>
                        @foreach ($getRole as $value)
                        <option {{ (old('role_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="rounded-lg bg-success-300 px-12 py-3.5 transition-all text-white font-semibold hover:bg-success-400">
                        Submit
                    </button>
                </div>
            </div>
        </form>

        <!-- Tabs -->

    </div>
</div>
@endsection
