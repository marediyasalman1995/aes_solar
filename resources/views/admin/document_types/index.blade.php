@extends('admin.layouts.master')

@section('title')
    Document Types — {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4 class="mb-0 text-dark fw-bold">Document Types Master</h4>
    <span class="text-muted fs-12">Manage dynamic categories for customer solar document uploads</span>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Document Types</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn shadow-sm" href="{{ route('admin.document-types.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Add Document Type
    </a>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @include('flash::message')
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="document-types-table">
                        <thead class="table-light">
                            <tr class="fs-12 text-muted text-uppercase fw-bold">
                                <th style="padding-left:20px; width: 80px;">ID</th>
                                <th>Document Title Type</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th style="padding-right:20px; text-align:right; width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documentTypes as $type)
                                <tr>
                                    <td style="padding-left:20px;"><b>#{{ $type->id }}</b></td>
                                    <td><b class="text-dark">{{ $type->title }}</b></td>
                                    <td>
                                        <span class="badge {{ $type->status == 1 ? 'bg-success-transparent text-success' : 'bg-secondary-transparent text-secondary' }}">
                                            {{ $type->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $type->created_at->format('M d, Y') }}</td>
                                    <td style="padding-right:20px; text-align:right;">
                                        <a href="{{ route('admin.document-types.edit', $type->uuid) }}" title="Edit Type" data-bs-toggle="tooltip" class="text-secondary me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                        </a>
                                        <a class="text-danger" href="javascript:void(0);" title="Delete Type" data-bs-toggle="tooltip" onclick="ajaxCallDelete('{{ route('admin.document-types.destroy', $type->uuid) }}', 'Delete this document type?', 'document-types-table')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No custom document types configured yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($documentTypes->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    {{ $documentTypes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
