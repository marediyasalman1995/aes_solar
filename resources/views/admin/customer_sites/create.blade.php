@extends('admin.layouts.master')

@section('title')
    Add Solar Plant Site - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4><i class="ri-add-line me-1"></i> Add Customer Solar Plant Site</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customer-sites.index') }}">Customer Sites</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Solar Plant Specifications</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customer-sites.store') }}">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Select Customer <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ old('user_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }} ({{ $c->mobile }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Site / Plant Name <span class="text-danger">*</span></label>
                            <input type="text" name="site_name" class="form-control" placeholder="e.g. Primary Residence / Factory Chakan" value="{{ old('site_name') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Capacity (kW) <span class="text-danger">*</span></label>
                            <input type="number" step="0.1" name="capacity_kw" class="form-control" value="{{ old('capacity_kw', '5.0') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">System Type</label>
                            <select name="system_type" class="form-control" required>
                                <option value="On-Grid">On-Grid</option>
                                <option value="Off-Grid">Off-Grid</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Installation Date</label>
                            <input type="date" name="installation_date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Monthly Average Generation (kWh)</label>
                            <input type="number" step="1" name="monthly_avg_kwh" class="form-control" value="600">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Inverter Details</label>
                            <input type="text" name="inverter_details" class="form-control" placeholder="e.g. AES Smart Hybrid 5kW Inverter">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Panel Details</label>
                            <input type="text" name="panel_details" class="form-control" placeholder="e.g. Tier-1 Mono PERC 540W Modules">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Plant physical location">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="Pune">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CO₂ Offset (Tons)</label>
                            <input type="number" step="0.1" name="co2_offset_ton" class="form-control" value="3.1">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Save Solar Site</button>
                    <a href="{{ route('admin.customer-sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
