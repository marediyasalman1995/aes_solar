@extends('admin.layouts.master')

@section('title')
    Edit Service Issue Type — {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4 class="mb-0 text-dark fw-bold">Edit Service Issue Type: {{ $issueType->title }}</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.issue-types.index') }}">Issue Types</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.issue-types.update', $issueType->uuid) }}" class="submitsByAjax">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Issue Type Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $issueType->title }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $issueType->sort_order }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ $issueType->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $issueType->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 mt-4 d-flex gap-2 justify-content-start">
                            <a href="{{ route('admin.issue-types.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Issue Type</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
