@extends('users.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- write your code here-->
<div class="rounded-lg bg-white dark:bg-darkblack-600 px-6 py-8">
    <div class=" justify-between gap-12">
        <!-- Form -->
        <form action="" method="post">
            @csrf
            <div class="grid md:rid-rows-2 gap-8">

                <div>
                    <label for="fn" class="block text-basse dark:text-bgray-50 font-medium text-bgray-600 mb-2">Add New
                        Role</label>
                    <input type="text"
                        class="bg-bgray-50 dark:bg-darkblack-500 dark:text-white p-4 rounded-lg border-0 focus:border focus:border-success-300 focus:ring-0 w-full space-y-4"
                        placeholder="Name" required name="name" />
                </div>

                <div>
                    <label for="fn"
                        class="block text-basse dark:text-bgray-50 font-medium text-bgray-600 mb-2">Permission</label>
                    @foreach ($getPermission as $value)
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-3 border-b dark:border-darkblack-300">
                        <div class="text-bgray-900 dark:text-bgray-50 font-medium w-full md:w-1/3">
                            {{ $value['name'] }}
                        </div>
                        <div class="w-full md:w-2/3 space-x-8 text-sm text-bgray-500 dark:text-bgray-400">
                            @if (!empty($value['group']) && is_array($value['group']))
                            @foreach ($value['group'] as $group)
                            <label class="inline-flex items-center bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded-md mr-1 mb-1">
                                <input type="checkbox" name="permission_id[]" value="{{ $group['id'] }}"
                                    class="w-4 h-4 text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 dark:focus:ring-blue-400 mr-2">
                                <span class="text-gray-900 dark:text-gray-100">{{ $group['name'] }}</span>
                            </label>
                            @endforeach
                            @else
                            <span class="text-gray-400 italic">No group</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="flex justify-end">
                    <button
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
