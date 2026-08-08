@extends('admin.layouts.master')

@section('title')
    Add New Customer - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4><i class="ri-user-add-line me-1"></i> Add New Solar Customer</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">Add Customer</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">Customer Information &amp; Solar Plant Setup</div>
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

                        <form method="POST" action="{{ route('admin.customers.store') }}">
                            @csrf
                            <h6 class="fw-bold text-primary mb-3">1. Personal &amp; Contact Details</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Rohan Sharma" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Mobile Number (10 Digits) <span class="text-danger">*</span></label>
                                    <input type="tel" name="mobile" class="form-control" placeholder="9876543210" maxlength="10" value="{{ old('mobile') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="rohan@example.com" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Installation Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Street / Society address" value="{{ old('address') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" placeholder="Pune" value="{{ old('city', 'Pune') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Initial Reward Wallet Balance (₹)</label>
                                    <input type="number" name="wallet_balance" class="form-control" value="1500">
                                </div>
                            </div>

                            <h6 class="fw-bold text-primary mb-3">2. Initial Solar Plant Site (Optional)</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Site Name</label>
                                    <input type="text" name="site_name" class="form-control" placeholder="e.g. Primary Residence" value="{{ old('site_name', 'Primary Residence') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Capacity (kW)</label>
                                    <input type="number" step="0.1" name="capacity_kw" class="form-control" value="5.0">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">System Type</label>
                                    <select name="system_type" class="form-control">
                                        <option value="On-Grid">On-Grid</option>
                                        <option value="Off-Grid">Off-Grid</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Installation Date</label>
                                    <input type="date" name="installation_date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Inverter Details</label>
                                    <input type="text" name="inverter_details" class="form-control" placeholder="e.g. AES Smart Hybrid 5kW Inverter">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Panel Details</label>
                                    <input type="text" name="panel_details" class="form-control" placeholder="e.g. Mono PERC 540W Tier-1 (10 Nos)">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Save Customer</button>
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
