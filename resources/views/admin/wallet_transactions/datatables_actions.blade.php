@if($type == 'Payout' && $status == 'Pending')
    <form method="POST" action="{{ route('admin.wallet-transactions.update-status', $uuid) }}" class="d-inline">
        @csrf
        <input type="hidden" name="status" value="Approved">
        <button type="submit" class="btn btn-link p-0 text-success me-2" title="Approve Payout" data-bs-toggle="tooltip" onclick="return confirm('Approve this payout request?')">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
        </button>
    </form>
    <form method="POST" action="{{ route('admin.wallet-transactions.update-status', $uuid) }}" class="d-inline">
        @csrf
        <input type="hidden" name="status" value="Rejected">
        <button type="submit" class="btn btn-link p-0 text-danger me-2" title="Reject Payout" data-bs-toggle="tooltip" onclick="return confirm('Reject this payout request?')">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
        </button>
    </form>
@else
    <span class="text-muted fs-11">—</span>
@endif
