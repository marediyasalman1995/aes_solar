@extends('admin.layouts.master')

@section('title')
    Manage Permissions for {{ $role->name }} - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4 class="mb-0 text-dark fw-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-key me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-2.239 .08a1 1 0 0 1 -1.032 -1.037l.08 -2.238a2 2 0 0 1 .578 -1.24l6.558 -6.557l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /><path d="M10 14l4 4" /></svg> 
        Role Permissions
    </h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Manage Permissions</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-bold mb-0 text-dark">Manage Permissions for: <span class="text-primary">{{ $role->name }}</span></h5>
                    <p class="text-muted fs-12 mb-0">Check group checkbox to select all actions under that module category</p>
                </div>
                <!-- Toggle Collapse/Expand Button -->
                <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center fw-semibold" id="toggleGlobalBtn" style="border-radius: 8px; padding: 8px 16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg> Collapse All
                </button>
            </div>

            <div class="card-body p-4">
                {!! Form::open(['route' => ['admin.roles.permissions.manage.update', $role->name], 'id' => 'permission-form', 'class' => 'submitsByAjax']) !!}
                @csrf
                
                @php $roleName = str_replace(' ', '-', $role->name) @endphp

                <!-- Dynamic Permission Groups -->
                <div class="permission-groups-container">
                    @foreach($allPermissions as $group => $groupedPermissions)
                        <div class="permission-group-card mb-4" style="background: #fff; border: 1px solid var(--sky-200); border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.015);">
                            <!-- Group Title Block -->
                            <div class="group-header d-flex align-items-center justify-content-between p-3" style="background: var(--sky-50); border-bottom: 1px solid var(--sky-100);">
                                <div class="form-check" style="padding-left: 2rem; margin-bottom: 0;">
                                    <input id="{{ $group }}_id" type="checkbox" class="form-check-input group-checkbox" name="{{ $group }}" value="{{ $group }}" style="transform: scale(1.2); cursor: pointer;">
                                    <label for="{{ $group }}_id" class="form-check-label fw-bold text-dark fs-14" style="cursor: pointer; padding-left: 8px; user-select: none;">
                                        {{ Str::title(str_replace('_', ' ', $group)) }}
                                    </label>
                                </div>
                                <button type="button" class="btn btn-sm btn-icon btn-light text-primary group-toggle-btn" onclick="toggleGroup('{{ $group }}')" style="border-radius: 50%; width: 32px; height: 32px; padding:0; display:flex; align-items:center; justify-content:center; border: 1px solid var(--sky-100);">
                                    <span class="arrow-symbol" style="transition: transform 0.2s; transform: rotate(0deg); font-weight: bold; font-size: 0.8rem;">▼</span>
                                </button>
                            </div>
                            
                            <!-- Group Permissions List -->
                            <div class="group-body p-4" id="group_list_{{ $group }}">
                                <div class="row g-3">
                                    @foreach($groupedPermissions as $permission)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-check" style="padding-left: 2rem;">
                                                <input id="chkBx_permission_{{ $permission->id }}" type="checkbox" class="form-check-input child-checkbox" name="{{ $roleName }}[]" value="{{ $permission->id }}" {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }} style="transform: scale(1.1); cursor: pointer;">
                                                <label for="chkBx_permission_{{ $permission->id }}" class="form-check-label text-muted fs-13" style="cursor: pointer; padding-left: 6px; user-select: none; line-height: 1.4;">
                                                    {{ $permission->label }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button Bar -->
                <div class="border-top pt-4 mt-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary px-5 py-3 fw-bold" style="border-radius: 12px; font-size: 1.05rem; box-shadow: 0 8px 20px rgba(11, 61, 92, 0.2);">
                        Update Permissions
                    </button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary px-4 py-3 ms-2 fw-bold" style="border-radius: 12px; font-size: 1.05rem;">
                        Cancel
                    </a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        // Toggle individual group body visibility
        function toggleGroup(group) {
            let body = $('#group_list_' + group);
            let arrow = body.prev().find('.arrow-symbol');
            body.slideToggle(200, function() {
                if (body.is(':visible')) {
                    arrow.css('transform', 'rotate(0deg)');
                } else {
                    arrow.css('transform', 'rotate(-90deg)');
                }
            });
        }

        $(document).ready(function () {
            // Ajax submission handler
            $('.submitsByAjax').submit(function (e) {
                e.preventDefault();
                let dataToPass = new FormData($(this)[0]);
                ajaxCallFormSubmit($(this), false, 'Updating Permissions! Please wait...', dataToPass);
            });

            // 1. Group Checkbox check-all / uncheck-all logic
            $('.group-checkbox').on('change', function() {
                let isChecked = $(this).prop('checked');
                let card = $(this).closest('.permission-group-card');
                card.find('.child-checkbox').prop('checked', isChecked).trigger('change');
            });

            // 2. Child Checkbox update parent state (checks if all, some, or none are selected)
            function updateGroupStates() {
                $('.group-checkbox').each(function() {
                    let parent = $(this);
                    let card = parent.closest('.permission-group-card');
                    let children = card.find('.child-checkbox');
                    let checkedChildren = children.filter(':checked');

                    if (checkedChildren.length === children.length && children.length > 0) {
                        parent.prop('checked', true).prop('indeterminate', false);
                    } else if (checkedChildren.length > 0) {
                        parent.prop('checked', false).prop('indeterminate', true);
                    } else {
                        parent.prop('checked', false).prop('indeterminate', false);
                    }
                });
            }

            $('.child-checkbox').on('change', function() {
                updateGroupStates();
            });

            // Initialize checkbox states on page load
            updateGroupStates();

            // 3. Global Toggle (Expand All / Collapse All)
            let allExpanded = true;
            $('#toggleGlobalBtn').on('click', function() {
                allExpanded = !allExpanded;
                if (allExpanded) {
                    $('.group-body').slideDown(200);
                    $('.arrow-symbol').css('transform', 'rotate(0deg)');
                    $(this).html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg> Collapse All');
                } else {
                    $('.group-body').slideUp(200);
                    $('.arrow-symbol').css('transform', 'rotate(-90deg)');
                    $(this).html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Expand All');
                }
            });
        });
    </script>
@endpush
