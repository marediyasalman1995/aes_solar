<!-- Heading Field -->
<div class="col-sm-9">
    <div class="row" style="padding: 0 7px">
        <div class="form-group col-sm-4">
            {!! Form::label('heading', 'Heading:') !!}
            {!! Form::text('heading', null, ['class' => 'form-control', 'required']) !!}
        </div>

        <!-- Sub Heading Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('sub_heading', 'Sub Heading:') !!}
            {!! Form::text('sub_heading', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Type Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('type', 'Website Section Type:') !!}
            {!! Form::select('type', [
                '' => 'Select Section Type',
                'Top_Banner' => 'Top Banner / Hero Section',
                'About_Us' => 'About Us Story & Banner',
                'Our_Vision' => 'Our Vision',
                'Our_Mission' => 'Our Mission',
                'Why_Choose_Us' => 'Why Choose Us / Values',
                'Stats' => 'Milestones & Statistics',
                'Solar_Plans' => 'Solar Plan Package (3kW, 5kW, 10kW)',
                'Solar_Solutions' => 'Solar Solution (On-Grid, Off-Grid, Hybrid)',
                'Products' => 'Solar Product / Hardware (Panels, Inverters, Battery)',
                'Services' => 'Service Highlight Tile',
                'AMC_Plans' => 'AMC Maintenance Plan (Basic, Standard, Premium)',
                'Process_Steps' => 'How It Works Step (1, 2, 3, 4)',
                'PM_Surya_Ghar' => 'PM Surya Ghar Scheme Banner',
                'Subsidy_Slabs' => 'Subsidy Slab Tier',
                'Reviews' => 'Customer Review / Testimonial',
            ], null, ['class' => 'form-control custom-select', 'required']) !!}
        </div>
    </div>

    @include('admin.layouts.editor',
    [
        'editorId' => 'editor',
        'editorFieldName' => 'description',
        'editorFieldLabelName' => 'Description',
    ])
</div>
@php $hasAvatar = !empty($website) ? $website->hasMedia('avatar') : false @endphp
@include('admin.layouts.scripts.dzSingleImageField', [
    'record' => isset($website) ? $website : '',
    'hasMedia' => $hasAvatar,
    'previewUrl' => $hasAvatar ? $website->avatarUrl['250'] : route('images_default',['resolution' => '250x250']),
    'mediaUuid' => $hasAvatar ? $website->getFirstMedia('avatar')->uuid ?? '' : '',
    'fieldName' => 'avatar',
    'elementId' => 'user_avatar',
    'placeHolderText' => "Drop/Select Image<br/>(Max: 1 MB)"
])
<!-- Submit Field -->
<div class="form-group col-sm-12">
    <button class="btn btn-primary rspSuccessBtns" type="submit"><i class="fa-duotone fa-floppy-disk"></i> Save
    </button>
    <a href="{{ route('admin.websites.index') }}" class="btn btn-outline-danger">
        <i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        Dropzone.autoDiscover = false;
        uploadImageByDropzone('#user_avatar');
        let instance = 'editor';
        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = '';
            if (CKEDITOR.instances[instance]) {
                CKEDITOR.instances[instance].updateElement();
            }
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'create' ? postCreate : undefined);
        });

        function postCreate() {
            switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
        }
    </script>
@endpush
