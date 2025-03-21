@extends('users.layouts.app')

@section('title', 'Journal')

@section('content')
<div class="2xl:flex 2xl:space-x-[48px]">
    <section class="mb-6 2xl:mb-0 2xl:flex-1">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-semibold text-black dark:text-white">Journal Bimbel</h2>
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative w-[230px]">
                    <input
                        type="text"
                        id="searchInput"
                        class="h-[44px] w-full rounded-lg border border-bgray-300 pl-14 pr-4 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white"
                        placeholder="Search"
                    />
                    <span class="absolute left-5 top-1/2 -translate-y-1/2">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#7F8995" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19 19L14.65 14.65" stroke="#7F8995" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                @if(!empty($PermissionAdd))
                <button type="button" id="addJournalBtn" class="btn-primary bg-success-300 hover:bg-success-400 px-4 py-2 text-white rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-success-300/50">
                    + Tambah Journal
                </button>
                @endif
            </div>
        </div>

        <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
            <div class="flex flex-col space-y-5">
                <div class="table-content w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Tanggal</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Nama Guru</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Nama Siswa</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Pelajaran</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Pembahasan</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Periode Ke-</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Pertemuan Ke-</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <span class="text-base font-medium text-bgray-600 dark:text-white">Created By</span>
                                </th>
                                <th class="px-6 py-5 text-left">
                                    <div class="flex items-center space-x-2.5">
                                        <span class="text-base font-medium text-bgray-600 dark:text-bgray-50">Aksi</span>
                                        <span>
                                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.332 1.31567V13.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3.66602 13.3157V1.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="journalTableBody">
                            @forelse($journals as $journal)
                            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->tanggal->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->nama_guru }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->bimbel->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->pelajaran }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->pembahasan }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->periode_ke }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->pertemuan_ke }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-base text-bgray-900 dark:text-white">
                                        {{ $journal->created_by }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex gap-2">
                                        @if(!empty($PermissionEdit))
                                        <button onclick="showEditModal({{ $journal->id }})"
                                                class="flex items-center px-3 py-1.5 bg-warning-500 text-white rounded-lg hover:bg-warning-600 transition-all duration-200 shadow-lg hover:shadow-warning-500/30">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        @endif

                                        @if(!empty($PermissionDelete))
                                        <button onclick="deleteJournal({{ $journal->id }})"
                                                class="flex items-center px-3 py-1.5 bg-danger-500 text-white rounded-lg hover:bg-danger-600 transition-all duration-200 shadow-lg hover:shadow-danger-500/30">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-5 text-center">
                                    <span class="text-base text-bgray-500 dark:text-white">Tidak ada data</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-content w-full">
                    <div class="flex w-full items-center justify-between">
                        <!-- Show Result Dropdown -->
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-semibold text-bgray-600 dark:text-white">Show result:</span>
                            <div class="relative">
                                <button type="button" onclick="togglePerPageDropdown()"
                                    class="flex items-center space-x-6 rounded-lg border border-bgray-300 px-2.5 py-[14px] dark:border-darkblack-400">
                                    <span class="text-sm font-semibold text-bgray-900 dark:text-white">{{ $per_page }}</span>
                                    <span>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.03516 6.03271L8.03516 10.0327L12.0352 6.03271" stroke="#A0AEC0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>
                                <div id="per-page-dropdown" class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                                    <ul>
                                        <li onclick="changePerPage(3)" class="cursor-pointer px-5 py-2 text-sm font-medium hover:bg-bgray-100 dark:hover:bg-darkblack-400">3</li>
                                        <li onclick="changePerPage(5)" class="cursor-pointer px-5 py-2 text-sm font-medium hover:bg-bgray-100 dark:hover:bg-darkblack-400">5</li>
                                        <li onclick="changePerPage(7)" class="cursor-pointer px-5 py-2 text-sm font-medium hover:bg-bgray-100 dark:hover:bg-darkblack-400">7</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination Buttons -->
                        <div class="flex items-center space-x-4" id="pagination-buttons">
                            @if($journals->lastPage() > 1)
                                <button onclick="changePage({{ $journals->currentPage() - 1 }})"
                                        {{ $journals->currentPage() == 1 ? 'disabled' : '' }}
                                        class="flex items-center justify-center px-4 h-8 text-sm font-medium {{ $journals->currentPage() == 1 ? 'text-gray-400 cursor-not-allowed' : 'text-gray-700 hover:bg-gray-50' }} dark:text-gray-400">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Previous
                                </button>

                                <div class="flex items-center space-x-2">
                                    @for($i = 1; $i <= $journals->lastPage(); $i++)
                                        <button onclick="changePage({{ $i }})"
                                                class="px-3 py-1 rounded-md {{ $journals->currentPage() == $i ? 'bg-success-300 text-white' : 'text-gray-700 hover:bg-gray-50' }} dark:text-gray-400">
                                            {{ $i }}
                                        </button>
                                    @endfor
                                </div>

                                <button onclick="changePage({{ $journals->currentPage() + 1 }})"
                                        {{ $journals->currentPage() == $journals->lastPage() ? 'disabled' : '' }}
                                        class="flex items-center justify-center px-4 h-8 text-sm font-medium {{ $journals->currentPage() == $journals->lastPage() ? 'text-gray-400 cursor-not-allowed' : 'text-gray-700 hover:bg-gray-50' }} dark:text-gray-400">
                                    Next
                                    <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Add Journal -->
<div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow-lg max-w-2xl w-full">
            <div class="flex justify-between items-center p-6 border-b border-bgray-200 dark:border-darkblack-400">
                <h3 class="text-xl font-semibold text-bgray-900 dark:text-white">Tambah Journal</h3>
                <button onclick="closeAddModal()" class="text-bgray-500 hover:text-red-500 dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('journal.store') }}" id="journalForm" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Tanggal</label>
                        <input type="date" name="tanggal" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Nama Guru</label>
                        <input type="text" name="nama_guru" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Siswa</label>
                        <select name="bimbel_id" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                            <option value="">Pilih Siswa</option>
                            @foreach($bimbels as $bimbel)
                                <option value="{{ $bimbel->id }}">{{ $bimbel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Pelajaran</label>
                        <input type="text" name="pelajaran" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Pembahasan</label>
                        <textarea name="pembahasan" required rows="3"
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Periode Ke-</label>
                        <input type="number" name="periode_ke" required min="1"
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Pertemuan Ke-</label>
                        <input type="number" name="pertemuan_ke" required min="1"
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-bgray-500 text-white rounded-lg hover:bg-bgray-600 mr-2">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-success-300 text-white rounded-lg hover:bg-success-400">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan Modal Edit -->
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-darkblack-600 rounded-lg shadow-lg max-w-2xl w-full">
            <div class="flex justify-between items-center p-6 border-b border-bgray-200 dark:border-darkblack-400">
                <h3 class="text-xl font-semibold text-bgray-900 dark:text-white">Edit Journal</h3>
                <button onclick="closeEditModal()" class="text-bgray-500 hover:text-red-500 dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editJournalForm" class="p-6">
                @csrf
                <input type="hidden" id="edit_journal_id" name="id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Tanggal</label>
                        <input type="date" id="edit_tanggal" name="tanggal" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Nama Guru</label>
                        <input type="text" id="edit_nama_guru" name="nama_guru" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Siswa</label>
                        <select id="edit_bimbel_id" name="bimbel_id" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                            <option value="">Pilih Siswa</option>
                            @foreach($bimbels as $bimbel)
                                <option value="{{ $bimbel->id }}">{{ $bimbel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Pelajaran</label>
                        <input type="text" id="edit_pelajaran" name="pelajaran" required
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Pembahasan</label>
                        <textarea id="edit_pembahasan" name="pembahasan" required rows="3"
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Periode Ke-</label>
                        <input type="number" id="edit_periode_ke" name="periode_ke" required min="1"
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Pertemuan Ke-</label>
                        <input type="number" id="edit_pertemuan_ke" name="pertemuan_ke" required min="1"
                            class="w-full rounded-lg border border-bgray-300 p-2 focus:border-success-300 focus:ring-0 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-bgray-500 text-white rounded-lg hover:bg-bgray-600 mr-2">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-success-300 text-white rounded-lg hover:bg-success-400">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Definisikan semua fungsi di scope global (window)
window.showAddModal = function() {
    const modal = document.getElementById('addModal');
    if (modal) {
        modal.classList.remove('hidden');
    }
};

window.closeAddModal = function() {
    const modal = document.getElementById('addModal');
    if (modal) {
        modal.classList.add('hidden');
        const form = document.getElementById('journalForm');
        if (form) {
            form.reset();
        }
    }
};

// Fungsi untuk menampilkan modal edit
window.showEditModal = function(id) {
    const modal = document.getElementById('editModal');
    if (modal) {
        modal.classList.remove('hidden');

        // Ambil data journal untuk edit
        fetch(`/journal/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const journal = data.data;
                    // Isi form dengan data yang ada
                    document.getElementById('edit_journal_id').value = journal.id;
                    document.getElementById('edit_tanggal').value = journal.tanggal;
                    document.getElementById('edit_nama_guru').value = journal.nama_guru;
                    document.getElementById('edit_bimbel_id').value = journal.bimbel_id;
                    document.getElementById('edit_pelajaran').value = journal.pelajaran;
                    document.getElementById('edit_pembahasan').value = journal.pembahasan;
                    document.getElementById('edit_periode_ke').value = journal.periode_ke;
                    document.getElementById('edit_pertemuan_ke').value = journal.pertemuan_ke;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data journal');
            });
    }
};

// Fungsi untuk menutup modal edit
window.closeEditModal = function() {
    const modal = document.getElementById('editModal');
    if (modal) {
        modal.classList.add('hidden');
        document.getElementById('editJournalForm').reset();
    }
};

// Event listener untuk form edit
document.getElementById('editJournalForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const journalId = document.getElementById('edit_journal_id').value;
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;

    // Kumpulkan data form
    const formData = {
        tanggal: document.getElementById('edit_tanggal').value,
        nama_guru: document.getElementById('edit_nama_guru').value,
        bimbel_id: document.getElementById('edit_bimbel_id').value,
        pelajaran: document.getElementById('edit_pelajaran').value,
        pembahasan: document.getElementById('edit_pembahasan').value,
        periode_ke: document.getElementById('edit_periode_ke').value,
        pertemuan_ke: document.getElementById('edit_pertemuan_ke').value
    };

    // Kirim request update
    fetch(`/journal/${journalId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeEditModal();
            location.reload();
        } else {
            throw new Error(data.message || 'Gagal mengupdate journal');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Gagal mengupdate journal');
    })
    .finally(() => {
        submitBtn.disabled = false;
    });
});

// Pindahkan fungsi deleteJournal ke scope global
window.deleteJournal = function(id) {
    if (confirm('Apakah Anda yakin ingin menghapus journal ini?')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/journal/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Gagal menghapus journal');
        });
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan event listener untuk tombol tambah
    const addButton = document.getElementById('addJournalBtn');
    if (addButton) {
        addButton.addEventListener('click', function() {
            showAddModal();
        });
    }

    // Definisikan fungsi global
    window.togglePerPageDropdown = function() {
        const dropdown = document.getElementById('per-page-dropdown');
        dropdown.classList.toggle('hidden');
    };

    window.changePerPage = function(value) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('per_page', value);
        currentUrl.searchParams.set('page', 1); // Reset ke halaman pertama
        window.location.href = currentUrl.toString();
    };

    window.changePage = function(page) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('page', page);
        window.location.href = currentUrl.toString();
    };

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('per-page-dropdown');
        const button = document.querySelector('[onclick="togglePerPageDropdown()"]');

        if (dropdown && button && !dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Variabel global
    let currentPage = 1;
    let perPage = 10;
    let searchQuery = '';
    let dateStart = '';
    let dateEnd = '';

    // Handler untuk pencarian
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchQuery = this.value;
                currentPage = 1;
                fetchData();
            }, 500);
        });
    }

    // Handler untuk filter tanggal
    document.getElementById('dateStart').addEventListener('change', function() {
        dateStart = this.value;
        fetchData();
    });

    document.getElementById('dateEnd').addEventListener('change', function() {
        dateEnd = this.value;
        fetchData();
    });

    // Fungsi untuk fetch data
    function fetchData() {
        const url = `/journal?page=${currentPage}&per_page=${perPage}&search=${searchQuery}&date_start=${dateStart}&date_end=${dateEnd}`;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateTable(data.data);
                updatePagination(data.data);
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat data');
        });
    }

    // Fungsi untuk update tabel
    function updateTable(data) {
        const tbody = document.querySelector('#journalTableBody');
        if (!tbody) return;

        if (!data.data || !data.data.length) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-5 text-center">
                        <span class="text-base text-bgray-500 dark:text-white">Tidak ada data</span>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = data.data.map(journal => `
            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${new Date(journal.tanggal).toLocaleDateString('id-ID')}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${journal.nama_guru}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${journal.bimbel.name}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${journal.pelajaran}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${journal.pembahasan}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${journal.periode_ke}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${journal.pertemuan_ke}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-base text-bgray-900 dark:text-white">
                        ${journal.created_by}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <div class="flex gap-2">
                        @if(!empty($PermissionEdit))
                        <button onclick="showEditModal(${journal.id})"
                                class="flex items-center px-3 py-1.5 bg-warning-500 text-white rounded-lg hover:bg-warning-600 transition-all duration-200 shadow-lg hover:shadow-warning-500/30">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </button>
                        @endif

                        @if(!empty($PermissionDelete))
                        <button onclick="deleteJournal(${journal.id})"
                                class="flex items-center px-3 py-1.5 bg-danger-500 text-white rounded-lg hover:bg-danger-600 transition-all duration-200 shadow-lg hover:shadow-danger-500/30">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                        @endif
                    </div>
                </td>
            </tr>
        `).join('');
    }

    // Fungsi untuk update pagination
    function updatePagination(data) {
        // Implementasi pagination sesuai kebutuhan
    }
});
</script>
@endpush

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('styles')
<style>
/* Styling untuk table dan aksi */
.table-content {
    @apply rounded-lg bg-white dark:bg-darkblack-600;
}

.table-content th {
    @apply bg-gray-50 dark:bg-darkblack-500;
}

.table-content tr:hover {
    @apply bg-gray-50 dark:bg-darkblack-500;
}

/* Button styles */
.btn-warning {
    @apply bg-yellow-500 hover:bg-yellow-600;
}

.btn-danger {
    @apply bg-red-500 hover:bg-red-600;
}

/* Dark mode improvements */
.dark .table-content {
    @apply bg-darkblack-600;
}

.dark .table-content th {
    @apply bg-darkblack-500;
}

.dark .table-content tr:hover {
    @apply bg-darkblack-500;
}

/* Animation */
.fade-enter {
    opacity: 0;
    transform: scale(0.9);
}

.fade-enter-active {
    opacity: 1;
    transform: scale(1);
    transition: opacity 300ms, transform 300ms;
}

.fade-exit {
    opacity: 1;
    transform: scale(1);
}

.fade-exit-active {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 300ms, transform 300ms;
}

/* Tambahan styling untuk tombol */
.btn-primary {
    @apply inline-flex items-center justify-center;
    @apply font-medium;
    @apply focus:outline-none focus:ring-2 focus:ring-success-300 focus:ring-offset-2;
}

/* Animasi hover */
.btn-primary:hover {
    @apply transform transition-all duration-300;
}

/* Dark mode */
.dark .btn-primary {
    @apply hover:bg-success-500;
    @apply focus:ring-success-400;
}
</style>
@endpush
