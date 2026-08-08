@extends('admin.layouts.master')

@section('title')
    Service Requests - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Service Requests</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Service Requests</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        @include('flash::message')
                        @include('admin.service_requests.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: UPDATE SERVICE TICKET -->
    <div class="modal fade" id="srvEditModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="srvEditForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Update Service Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Ticket Status</label>
                            <select name="status" id="modalSrvStatus" class="form-control" required>
                                <option value="Pending">Pending</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Technician / Resolution Notes</label>
                            <textarea name="admin_notes" id="modalSrvNotes" class="form-control" rows="3" placeholder="Notes on technician visit, parts replaced, or resolution details"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Ticket Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('stackedScripts')
<script>
    function openSrvEditModal(uuid, status, notes) {
        document.getElementById('srvEditForm').action = "{{ url('admin/service-requests') }}/" + uuid;
        document.getElementById('modalSrvStatus').value = status;
        document.getElementById('modalSrvNotes').value = notes;
        new bootstrap.Modal(document.getElementById('srvEditModal')).show();
    }
</script>
@endpush
