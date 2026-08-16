<!-- Address & Contact Fields -->
<div class="col-sm-12">
    <div class="row">
        <div class="form-group col-sm-12">
            {!! Form::label('address', 'Address:') !!}
            {!! Form::textarea('address', @$setting->address, ['class' => 'form-control', 'rows' => 3]) !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('mobile', 'Mobile 1:') !!}
            {!! Form::number('mobile', @$setting->mobile, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3">
            {!! Form::label('mobile_2', 'Mobile 2:') !!}
            {!! Form::number('mobile_2', @$setting->mobile_2, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('mobile_3', 'Mobile 3:') !!}
            {!! Form::number('mobile_3', @$setting->mobile_3, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('whatsapp', 'WhatsApp Link:') !!}
            {!! Form::text('whatsapp', @$setting->whatsapp, ['class' => 'form-control', 'placeholder' => 'e.g. https://wa.me/919876543210']) !!}
        </div>
    </div>
</div>

<!-- Upload Logos Row -->
<div class="col-sm-12 mb-4" style="margin-top: 15px;">
    <label class="fw-bold d-block mb-3" style="font-size: 1.1rem; color: var(--primary-dark); font-weight: 700;">Upload Company Logos &amp; Favicon</label>
    <div class="row">
        <!-- Main Logo -->
        <div class="col-sm-3">
            <label style="font-size: 0.85rem; font-weight: 600; color: #475569; display: block; margin-bottom: 8px;">Main Logo</label>
            @php $hasAvatar = !empty($setting) ? $setting->hasMedia('avatar') : false @endphp
            @include('admin.layouts.scripts.dzSingleImageField', [
                'record' => isset($setting) ? $setting : '',
                'hasMedia' => $hasAvatar,
                'previewUrl' => $hasAvatar ? $setting->avatarUrl['250'] : route('images_default',['resolution' => '250x250']),
                'mediaUuid' => $hasAvatar ? $setting->getFirstMedia('avatar')->uuid ?? '' : '',
                'fieldName' => 'avatar',
                'elementId' => 'user_avatar',
                'className' => 'w-100',
                'placeHolderText' => "Drop/Select Logo<br/>(Max: 1 MB)"
            ])
        </div>
        
        <!-- Favicon -->
        <div class="col-sm-3">
            <label style="font-size: 0.85rem; font-weight: 600; color: #475569; display: block; margin-bottom: 8px;">Favicon</label>
            @php $hasFavicon = !empty($setting) ? $setting->hasMedia('favicon') : false @endphp
            @include('admin.layouts.scripts.dzSingleImageField', [
                'record' => isset($setting) ? $setting : '',
                'hasMedia' => $hasFavicon,
                'previewUrl' => $hasFavicon ? $setting->getFirstMedia('favicon')->getUrl() : route('images_default',['resolution' => '250x250']),
                'mediaUuid' => $hasFavicon ? $setting->getFirstMedia('favicon')->uuid ?? '' : '',
                'fieldName' => 'favicon',
                'elementId' => 'setting_favicon',
                'className' => 'w-100',
                'placeHolderText' => "Drop/Select Favicon<br/>(Max: 1 MB)"
            ])
        </div>

        <!-- Header Logo -->
        <div class="col-sm-3">
            <label style="font-size: 0.85rem; font-weight: 600; color: #475569; display: block; margin-bottom: 8px;">Header Logo (Transparent)</label>
            @php $hasHeaderLogo = !empty($setting) ? $setting->hasMedia('header_logo') : false @endphp
            @include('admin.layouts.scripts.dzSingleImageField', [
                'record' => isset($setting) ? $setting : '',
                'hasMedia' => $hasHeaderLogo,
                'previewUrl' => $hasHeaderLogo ? $setting->getFirstMedia('header_logo')->getUrl() : route('images_default',['resolution' => '250x250']),
                'mediaUuid' => $hasHeaderLogo ? $setting->getFirstMedia('header_logo')->uuid ?? '' : '',
                'fieldName' => 'header_logo',
                'elementId' => 'setting_header_logo',
                'className' => 'w-100',
                'placeHolderText' => "Header Logo<br/>(Max: 1 MB)"
            ])
        </div>

        <!-- Footer Logo -->
        <div class="col-sm-3">
            <label style="font-size: 0.85rem; font-weight: 600; color: #475569; display: block; margin-bottom: 8px;">Footer Logo (White/Light)</label>
            @php $hasFooterLogo = !empty($setting) ? $setting->hasMedia('footer_logo') : false @endphp
            @include('admin.layouts.scripts.dzSingleImageField', [
                'record' => isset($setting) ? $setting : '',
                'hasMedia' => $hasFooterLogo,
                'previewUrl' => $hasFooterLogo ? $setting->getFirstMedia('footer_logo')->getUrl() : route('images_default',['resolution' => '250x250']),
                'mediaUuid' => $hasFooterLogo ? $setting->getFirstMedia('footer_logo')->uuid ?? '' : '',
                'fieldName' => 'footer_logo',
                'elementId' => 'setting_footer_logo',
                'className' => 'w-100',
                'placeHolderText' => "Footer Logo<br/>(Max: 1 MB)"
            ])
        </div>
    </div>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', @$setting->email, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('email_2', 'Email 2:') !!}
    {!! Form::email('email_2', @$setting->email_2, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('facebook', 'Facebook:') !!}
    {!! Form::url('facebook', @$setting->facebook, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('twitter', 'Twitter:') !!}
    {!! Form::url('twitter', @$setting->twitter, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('linkedin', 'Linkedin:') !!}
    {!! Form::url('linkdin', @$setting->linkdin, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('youtube', 'Youtube:') !!}
    {!! Form::url('youtube', @$setting->youtube, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('instagram', 'Instagram:') !!}
    {!! Form::url('instagram', @$setting->instagram, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('telegram', 'Telegram:') !!}
    {!! Form::url('telegram', @$setting->telegram, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('pay_store_url', 'Pay Store URL:') !!}
    {!! Form::url('pay_store_url', @$setting->pay_store_url, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('app_store_url', 'App Store URL:') !!}
    {!! Form::url('app_store_url', @$setting->app_store_url, ['class' => 'form-control']) !!}
</div>
<!-- Meta Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_title', 'Meta Title:') !!}
    {!! Form::textarea('meta_title', @$setting->meta_title, ['class' => 'form-control', 'rows'=>'4']) !!}
</div>

<!-- Meta Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_description', 'Meta Description:') !!}
    {!! Form::textarea('meta_description', @$setting->meta_description, ['class' => 'form-control', 'rows'=>'4']) !!}
</div>

<!-- Meta Keyword Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_keyword', 'Meta Keyword:') !!}
    {!! Form::textarea('meta_keyword', @$setting->meta_keyword, ['class' => 'form-control', 'rows'=>'4']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary rspSuccessBtns']) !!}
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')

    <script>
        Dropzone.autoDiscover = false;
        uploadImageByDropzone('#user_avatar');
        uploadImageByDropzone('#setting_favicon');
        uploadImageByDropzone('#setting_header_logo');
        uploadImageByDropzone('#setting_footer_logo');
        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = '{{ $type ?? '' }}'
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'create' ? postCreate : undefined);
        });

        function postCreate(){
            switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
        }
    </script>
@endpush
