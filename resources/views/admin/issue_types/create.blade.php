@extends('admin.layouts.master')

@section('title')
    Create Service Issue Type — {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4 class="mb-0 text-dark fw-bold">Add New Service Issue Type</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.issue-types.index') }}">Issue Types</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.issue-types.store') }}" class="submitsByAjax">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Issue Type Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Inverter Fault / Grid Trip / Cable Repair" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 mt-4 d-flex gap-2 justify-content-start">
                            <a href="{{ route('admin.issue-types.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Issue Type</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
