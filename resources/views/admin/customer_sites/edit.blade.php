@extends('admin.layouts.master')

@section('title')
    Edit Solar Plant Site - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4><i class="ri-edit-line me-1"></i> Edit Solar Plant: {{ $customerSite->site_name }}</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customer-sites.index') }}">Customer Sites</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Update Solar Plant Details</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customer-sites.update', $customerSite->uuid) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Site / Plant Name <span class="text-danger">*</span></label>
                            <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $customerSite->site_name) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Capacity (kW) <span class="text-danger">*</span></label>
                            <input type="number" step="0.1" name="capacity_kw" class="form-control" value="{{ old('capacity_kw', $customerSite->capacity_kw) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">System Type</label>
                            <select name="system_type" class="form-control" required>
                                <option value="On-Grid" {{ $customerSite->system_type == 'On-Grid' ? 'selected' : '' }}>On-Grid</option>
                                <option value="Off-Grid" {{ $customerSite->system_type == 'Off-Grid' ? 'selected' : '' }}>Off-Grid</option>
                                <option value="Hybrid" {{ $customerSite->system_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Inverter Details</label>
                            <input type="text" name="inverter_details" class="form-control" value="{{ old('inverter_details', $customerSite->inverter_details) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Panel Details</label>
                            <input type="text" name="panel_details" class="form-control" value="{{ old('panel_details', $customerSite->panel_details) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Monthly Average Generation (kWh)</label>
                            <input type="number" step="1" name="monthly_avg_kwh" class="form-control" value="{{ old('monthly_avg_kwh', $customerSite->monthly_avg_kwh) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CO₂ Offset (Tons)</label>
                            <input type="number" step="0.1" name="co2_offset_ton" class="form-control" value="{{ old('co2_offset_ton', $customerSite->co2_offset_ton) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Installation Date</label>
                            <input type="date" name="installation_date" class="form-control" value="{{ optional($customerSite->installation_date)->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ $customerSite->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $customerSite->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Update Solar Site</button>
                    <a href="{{ route('admin.customer-sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('stackedScripts')
<script>
$(document).ready(function() {
    function updateCalculations() {
        let capacity = parseFloat($('input[name="capacity_kw"]').val());
        if (!isNaN(capacity) && capacity > 0) {
            let generation = Math.round(capacity * 120);
            let co2 = parseFloat((capacity * 0.62).toFixed(1));
            $('input[name="monthly_avg_kwh"]').val(generation);
            $('input[name="co2_offset_ton"]').val(co2);
        }
    }
    $('input[name="capacity_kw"]').on('input change', updateCalculations);
});
</script>
@endpush
