@extends('admin.layouts.master')

@section('title')
    Edit Customer — {{ $customer->name }}
@endsection

@section('page_headers')
    <h4><i class="ri-edit-line me-1"></i> Edit Customer: {{ $customer->name }}</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">Update Customer Information</div>
                    </div>
                    <div class="card-body">
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.customers.update', $customer->uuid) }}">
                            @csrf
                            @method('PUT')
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="mobile" class="form-control" value="{{ old('mobile', $customer->mobile) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Installation Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', $customer->address) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city', $customer->city) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Account Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Update Customer</button>
                                <a href="{{ route('admin.customers.show', $customer->uuid) }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
