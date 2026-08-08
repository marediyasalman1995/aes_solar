@extends('admin.layouts.master')

@section('title')
    Edit Document — {{ $customerDocument->title }}
@endsection

@section('page_headers')
    <h4>Edit Document: {{ $customerDocument->title }}</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customer-documents.index') }}">Customer Documents</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white"><h5 class="card-title mb-0">Update Document Information</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customer-documents.update', $customerDocument->uuid) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Document Type <span class="text-danger">*</span></label>
                            <select name="doc_type" class="form-control" required>
                                <option value="Panel Warranty" {{ $customerDocument->doc_type == 'Panel Warranty' ? 'selected' : '' }}>Panel Warranty</option>
                                <option value="Inverter Warranty" {{ $customerDocument->doc_type == 'Inverter Warranty' ? 'selected' : '' }}>Inverter Warranty</option>
                                <option value="Installation Agreement" {{ $customerDocument->doc_type == 'Installation Agreement' ? 'selected' : '' }}>Installation Agreement</option>
                                <option value="Net-Metering Approval" {{ $customerDocument->doc_type == 'Net-Metering Approval' ? 'selected' : '' }}>Net-Metering Approval</option>
                                <option value="Invoice" {{ $customerDocument->doc_type == 'Invoice' ? 'selected' : '' }}>Invoice</option>
                                <option value="Other" {{ $customerDocument->doc_type == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Document Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $customerDocument->title) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Document File (PDF / DOC / Image)</label>
                            <input type="file" name="document_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            @if(!empty($customerDocument->file_path))
                                <div class="mt-2">
                                    <a href="{{ asset($customerDocument->file_path) }}" target="_blank" download class="badge bg-danger-transparent text-danger p-2" style="font-size:0.85rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-download me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 17v-6" /><path d="M9.5 14.5l2.5 2.5l2.5 -2.5" /></svg> Current File: Download / View PDF
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Valid Until</label>
                            <input type="date" name="valid_until" class="form-control" value="{{ optional($customerDocument->valid_until)->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Notes / Description</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $customerDocument->notes) }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Update Document</button>
                    <a href="{{ route('admin.customer-documents.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
