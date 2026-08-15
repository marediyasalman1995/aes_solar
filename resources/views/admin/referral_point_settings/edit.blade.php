@extends('admin.layouts.master')

@section('title')
    Edit Referral Rule — {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4 class="mb-0 text-dark fw-bold">Edit Referral Point Rule</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.referral-point-settings.index') }}">Referral Rules</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.referral-point-settings.update', $referralPointSetting->uuid) }}" class="submitsByAjax">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Rule Title / Description</label>
                            <input type="text" name="title" class="form-control" value="{{ $referralPointSetting->title }}" placeholder="e.g. Initial Referral Credit / Special Bonus Offer" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Transaction Type</label>
                            <select name="type" class="form-control" required>
                                <option value="Credit" {{ $referralPointSetting->type == 'Credit' ? 'selected' : '' }}>Credit (Add Balance)</option>
                                <option value="Debit" {{ $referralPointSetting->type == 'Debit' ? 'selected' : '' }}>Debit (Deduct Balance)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Point Amount (₹)</label>
                            <input type="number" step="1" min="0" name="amount" class="form-control" value="{{ $referralPointSetting->amount }}" placeholder="e.g. 500" required>
                        </div>
                        <div class="col-12 mt-4 d-flex gap-2 justify-content-start">
                            <a href="{{ route('admin.referral-point-settings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Referral Rule</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
