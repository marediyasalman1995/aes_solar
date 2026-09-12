@extends('admin.layouts.master')

@section('title')
    Inquiries - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Inquiries</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Inquiries</li>
@endsection

@section('page_buttons')

@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">

                    <div class="card-body">
                        @include('flash::message')
                        @include('admin.inquiries.table')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).on('change', '.inquiry-status-select', function() {
        let uuid = $(this).data('uuid');
        let status = $(this).val();
        
        $.ajax({
            url: "{{ url('admin/inquiries') }}/" + uuid + "/update-status",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function(res) {
                if (typeof toastr !== 'undefined') {
                    toastr.success(res.message);
                }
                if (typeof window.LaravelDataTables !== 'undefined' && window.LaravelDataTables["dataTableBuilder"]) {
                    window.LaravelDataTables["dataTableBuilder"].ajax.reload(null, false);
                } else {
                    location.reload();
                }
            },
            error: function(err) {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Error updating inquiry status');
                } else {
                    alert('Error updating status');
                }
            }
        });
    });
</script>
@endsection
