@extends('admin.layouts.master')

@section('title')
    Referrals - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Referrals</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Referrals</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        @include('flash::message')
                        @include('admin.referrals.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: UPDATE REFERRAL -->
    <div class="modal fade" id="refEditModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="refEditForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Update Referral Stage &amp; Reward</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Stage</label>
                            <select name="stage" id="modalStage" class="form-control" required>
                                <option value="Contacted">Contacted</option>
                                <option value="Site Survey Done">Site Survey Done</option>
                                <option value="Quotation Shared">Quotation Shared</option>
                                <option value="Installed">Installed (Auto-Credits Reward to Wallet!)</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reward Amount (₹)</label>
                            <input type="number" name="reward_amount" id="modalRewardAmount" class="form-control" value="500">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reward Status</label>
                            <select name="reward_status" id="modalRewardStatus" class="form-control" required>
                                <option value="Pending">Pending</option>
                                <option value="Credited">Credited</option>
                                <option value="None">None</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" id="modalNotes" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('stackedScripts')
<script>
    function openRefEditModal(uuid, stage, reward, status, notes) {
        document.getElementById('refEditForm').action = "{{ url('admin/referrals') }}/" + uuid;
        document.getElementById('modalStage').value = stage;
        document.getElementById('modalRewardAmount').value = reward;
        document.getElementById('modalRewardStatus').value = status;
        document.getElementById('modalNotes').value = notes;
        new bootstrap.Modal(document.getElementById('refEditModal')).show();
    }
</script>
@endpush
