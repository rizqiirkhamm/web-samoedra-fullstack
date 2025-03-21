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
                        Edit New User
                    </label>
                    <input type="text" name="name" required
                        class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full"
                    value="{{ $getRecord->name }}"    placeholder="Name" />
                </div>
`
                <div>
                    <label for="email" class="block text-base dark:text-bgray-50 font-medium text-bgray-600 mb-2">
                        Edit New Email
                    </label>
                    <input type="email" name="email" required
                        class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full"
                        value="{{ $getRecord->email }}" readonly  placeholder="Email" />

                </div>

                <div>
                    <label for="password" class="block text-base dark:text-bgray-50 font-medium text-bgray-600 mb-2">
                        Edit New Password
                    </label>
                    <input type="password" name="password"
                        class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full"
                        placeholder="Password" />
                        <p class="mt-1 text-sm text-bgray-500 dark:text-bgray-400">
                            (Jika Anda ingin mengubah kata sandi, silakan tambahkan. Jika tidak, biarkan saja)
                        </p>
                </div>

                <div>
                    <label for="role" class="block text-base dark:text-bgray-50 font-medium text-bgray-600 mb-2">
                        Edit New Role
                    </label>
                    <select name="role_id" required class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border focus:border-success-300 focus:ring-0 w-full">
                        <option value="">Select Role</option>
                        @foreach ($getRole as $value)
                        <option {{ $getRecord->role_id == $value->id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="rounded-lg bg-success-300 px-12 py-3.5 transition-all text-white font-semibold hover:bg-success-400">
                        Update
                    </button>
                </div>
            </div>
        </form>

        <!-- Tabs -->

    </div>
</div>
@endsection
