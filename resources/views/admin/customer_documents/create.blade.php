@extends('admin.layouts.master')

@section('title')
    Add Customer Document - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Add Warranty / Document</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customer-documents.index') }}">Customer Documents</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white"><h5 class="card-title mb-0">Document Details</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customer-documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Customer <span class="text-danger">*</span></label>
                            <select name="user_id" id="userSelect" class="form-control" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ old('user_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }} ({{ $c->mobile }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Document Type <span class="text-danger">*</span></label>
                            <select name="doc_type" class="form-control" required>
                                @foreach($documentTypes as $type)
                                    <option value="{{ $type->title }}" {{ old('doc_type') == $type->title ? 'selected' : '' }}>
                                        {{ $type->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Document Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. 25-Year Panel Warranty Certificate" value="{{ old('title') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Document File (PDF / DOC / Image)</label>
                            <input type="file" name="document_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small class="text-muted fs-11">Supported formats: PDF, DOC, DOCX, JPG, PNG (Max: 20MB)</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Valid Until</label>
                            <input type="date" name="valid_until" class="form-control" value="{{ date('Y-m-d', strtotime('+10 years')) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Notes / Description</label>
                            <input type="text" name="notes" class="form-control" placeholder="Optional notes for customer">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Save Document</button>
                    <a href="{{ route('admin.customer-documents.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
