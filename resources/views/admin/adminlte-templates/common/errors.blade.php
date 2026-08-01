@if(!empty($errors))
    @if($errors->any())
        <div class="alert alert-danger" style="padding: 10px 20px; border-radius: 8px; margin-bottom: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
            <ul class="mb-0" style="list-style: none; padding-left: 0; margin: 0;">
                @foreach($errors->all() as $error)
                    <li>⚠️ {!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
