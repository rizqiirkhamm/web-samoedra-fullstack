@forelse($stimulasis as $stimulasi)
<tr class="border-b border-bgray-300 dark:border-darkblack-400">
    <td class="px-6 py-5">
        <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->name }}</p>
    </td>
    <td class="px-6 py-5">
        <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->age }} tahun</p>
    </td>
    <td class="px-6 py-5">
        <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->height }}</p>
    </td>
    <td class="px-6 py-5">
        <p class="text-base font-medium text-bgray-900 dark:text-white">{{ $stimulasi->weight }}</p>
    </td>
    <td class="px-6 py-5">
        <span class="px-3 py-1 rounded-full text-xs {{ $stimulasi->status == 'active' ? 'bg-success-50 text-success-500' : 'bg-error-50 text-error-500' }}">
            {{ ucfirst($stimulasi->status) }}
        </span>
    </td>
    <td class="px-6 py-5">
        <div class="flex items-center justify-center gap-2">
            @if(!empty($PermissionDetail))
            <button onclick="showDetail({{ $stimulasi->id }})"
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors duration-200">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
            @endif
            @if(!empty($PermissionDelete))
            <button onclick="confirmDelete({{ $stimulasi->id }})"
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-50 hover:bg-red-100 transition-colors duration-200">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
            @endif
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="px-6 py-5 text-center text-gray-500">
        Tidak ada data
    </td>
</tr>
@endforelse

<script>
// Handle per page change
document.getElementById('perPageSelect').addEventListener('change', function() {
    loadData(1, this.value);
});

// Handle pagination click
document.addEventListener('click', function(e) {
    if (e.target.matches('.pagination-link')) {
        e.preventDefault();
        const page = e.target.getAttribute('data-page');
        const perPage = document.getElementById('perPageSelect').value;
        loadData(page, perPage);
    }
});

function loadData(page, perPage) {
    const searchQuery = document.getElementById('searchInput').value;
    const statusFilter = document.getElementById('statusFilter').value;

    fetch(`/stimulasi?page=${page}&per_page=${perPage}&search=${searchQuery}&status=${statusFilter}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector('tbody').innerHTML = data.data;
            document.querySelector('.pagination-content').innerHTML = data.pagination;

            // Update URL tanpa reload
            const url = new URL(window.location);
            url.searchParams.set('page', page);
            url.searchParams.set('per_page', perPage);
            window.history.pushState({}, '', url);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>