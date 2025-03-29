@extends('users.layouts.app')

@section('title', 'Master Event')

@section('content')
<div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-bgray-200 pb-4">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-semibold text-bgray-800 dark:text-white">Master Data Event</h2>
            <button onclick="showAddModal()" class="flex items-center justify-center rounded-lg bg-success-300 px-4 py-2 text-sm font-medium text-white hover:bg-success-400 transition-all duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Event
            </button>
        </div>
        <!-- Search Bar -->
        <div class="flex items-center gap-3">
            <form action="{{ route('event.master') }}" method="GET" class="flex items-center gap-3">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama event..."
                       class="w-[250px] rounded-lg border border-bgray-300 p-2 dark:bg-darkblack-500 dark:border-darkblack-400">
                <button type="submit" class="flex items-center gap-2 rounded-lg bg-success-300 px-4 py-2 text-white hover:bg-success-400 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Table Events dengan desain yang lebih modern -->
    <div class="mt-6 overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="border-b border-bgray-200 dark:border-darkblack-400">
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Nama Event</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Deskripsi</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-bgray-600 dark:text-bgray-50">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr class="border-b border-bgray-200 dark:border-darkblack-400 hover:bg-gray-50 dark:hover:bg-darkblack-500">
                    <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $event->name }}</td>
                    <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $event->description }}</td>
                    <td class="px-4 py-3 text-sm text-bgray-900 dark:text-white">{{ $event->event_date->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        <button onclick="showDeleteModal('{{ $event->id }}')"
                                class="flex items-center text-red-500 hover:text-red-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $events->links() }}
    </div>

    <!-- Modal dengan desain yang lebih modern -->
    <div id="addEventModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="relative z-10 mx-auto mt-20 max-w-lg">
            <div class="rounded-xl bg-white p-6 shadow-xl dark:bg-darkblack-600">
                <h3 class="mb-4 text-lg font-semibold text-bgray-900 dark:text-white">Tambah Event Baru</h3>
                <form action="{{ route('event.master.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-bgray-600 dark:text-bgray-50">Nama Event</label>
                            <input type="text" name="name" class="w-full rounded-lg border border-bgray-300 p-2.5 focus:ring-2 focus:ring-success-300" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-bgray-600 dark:text-bgray-50">Deskripsi</label>
                            <textarea name="description" class="w-full rounded-lg border border-bgray-300 p-2.5 focus:ring-2 focus:ring-success-300" rows="3" required></textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-bgray-600 dark:text-bgray-50">Tanggal Event</label>
                            <input type="date" name="event_date" class="w-full rounded-lg border border-bgray-300 p-2.5 focus:ring-2 focus:ring-success-300" required>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-4">
                        <button type="button" onclick="hideAddModal()"
                                class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-200 dark:bg-darkblack-500 dark:text-gray-300 dark:hover:bg-darkblack-400">
                            Batal
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-success-300 px-4 py-2 text-sm font-medium text-white hover:bg-success-400">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan Modal Delete di bawah Modal Add -->
    <div id="deleteEventModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="relative z-10 mx-auto mt-20 max-w-lg">
            <div class="rounded-xl bg-white p-6 shadow-xl dark:bg-darkblack-600">
                <div class="flex flex-col items-center text-center">
                    <!-- Warning Icon -->
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konfirmasi Penghapusan</h3>

                    <div class="mt-2 mb-6">
                        <p class="text-sm text-gray-500 dark:text-gray-300">
                            Apakah Anda yakin ingin menghapus event ini?
                        </p>
                        <p class="text-sm text-red-500 mt-2">
                            <strong>Peringatan:</strong> Menghapus event ini akan menghapus semua data pendaftaran yang terkait!
                        </p>
                    </div>

                    <form id="deleteEventForm" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center gap-4">
                            <button type="button"
                                    onclick="hideDeleteModal()"
                                    class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-200 dark:bg-darkblack-500 dark:text-gray-300 dark:hover:bg-darkblack-400">
                                Batal
                            </button>
                            <button type="submit"
                                    class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                                Ya, Hapus Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showAddModal() {
    document.getElementById('addEventModal').classList.remove('hidden');
}

function hideAddModal() {
    document.getElementById('addEventModal').classList.add('hidden');
}

function showDeleteModal(eventId) {
    const modal = document.getElementById('deleteEventModal');
    const form = document.getElementById('deleteEventForm');
    form.action = `{{ route('event.master.destroy', '') }}/${eventId}`;
    modal.classList.remove('hidden');
}

function hideDeleteModal() {
    document.getElementById('deleteEventModal').classList.add('hidden');
}

// Tambahkan animasi fade untuk modal
document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.fixed.inset-0.z-50');
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideAddModal();
                hideDeleteModal();
            }
        });
    });
});
</script>
@endpush

@endsection