@extends('layouts.admin')

@section('content')
    @php
    $role = roles();
    @endphp
    <div class="content">
        <div class="container-fluid">
            {{-- @if ($errors->has())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif --}}

            <div class="row">
                <div class="col-12">
                    {!! Form::model($bar, $formAttributes) !!}
                    <div class="card">
                        <div class="card-body">
                            @if (auth()->user()->role_id >= $role['Account Admin'])
                                {!! Form::hidden('user_id', auth()->user()->id) !!}
                            @else
                                <div class="form-group">
                                    {!! Form::label('user_id', 'Select Owner') !!}
                                    <div class="input-group">
                                        {!! Form::select('user_id', $users, $bar ? $bar->user_id : null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Account Admin', 'id' => 'user_id', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                    </div>
                                    @error('user_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Bar Name') !!}
                                        <div class="input-group">
                                            {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => true, 'required' => true, 'id' => 'name', 'placeholder' => 'Enter Bar Name', 'autocomplete' => 'new-name', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('slug', 'Slug') !!}
                                        <div class="input-group">
                                            {!! Form::text('slug', null, ['class' => 'form-control', 'required' => true, 'id' => 'slug', 'placeholder' => 'Enter Bar slug', 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('slug')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('logo', 'Logo') !!}
                                        <div class="input-group">
                                            {!! Form::file('logo', ['class' => 'form-control', 'id' => 'logo', 'accept' => 'image/*', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('logo')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('background_color', 'Background Color') !!}
                                        <div class="input-group">
                                            {!! Form::text('background_color', null, ['class' => 'form-control', 'id' => 'background_color', 'placeholder' => 'Choose the Background Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('background_color')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('fonts', 'Fonts') !!}
                                        <div class="input-group">
                                            {{-- ['NimbuSanTBolCon' => 'Default', 'verdana' => 'Verdana', 'cursive' => 'cursive', 'sans-serif' => 'sans-serif', 'ui-monospace' => 'ui-monospace'] --}}
                                            @php                                                                 
                                                $fonts->prepend("Default");
                                            @endphp
                                            {!! Form::select('fonts', $fonts, $bar ? $bar->fonts : 'Select Font Style', ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Bar fonts', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('fonts')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('font_size', 'Font Size') !!}
                                        <div class="input-group">
                                            {!! Form::text('font_size', $bar ? $bar->font_size : 12, ['class' => 'form-control', 'id' => 'font_size', 'placeholder' => 'Choose the Font Size', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('font_size')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 justify-content-between">     
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('font_color', 'Font Color') !!}
                                        <div class="input-group">
                                            {!! Form::text('font_color', $bar ? $bar->font_color : '#fefefe', ['class' => 'form-control', 'id' => 'font_color', 'placeholder' => 'Choose the Font Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('font_color')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('type', 'Type') !!}
                                        <div class="input-group">
                                            {!! Form::select('type', ['Bar' => 'Bar', 'Restaurant' => 'Restaurant'], $bar ? $bar->type : null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Type', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('type')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                           
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('location', 'Location (lat, long)') !!}
                                        <div class="input-group">
                                            {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Enter coordinates here', 'autocomplete' => 'nope', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('location')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('images', 'Images') !!}
                                        <div class="input-group mb-2">
                                            {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => true, 'accept' => 'image/*', 'id' => 'images', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @if (isset($bar) && isset($bar->images) && !empty($bar->images))
                                            @foreach (json_decode($bar->images) as $key => $image)
                                                <img src="{{asset('public/images/bars/'. $image)}}" alt="{{$image}}" width="100">
                                            @endforeach
                                        @endif
                                        @error('images')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row mb-2 justify-content-between">
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::label('description', 'Description') !!}
                                        <div class="input-group">
                                            {!! Form::textarea('description', null, ['class' => 'form-control textarea', 'id' => 'description', 'placeholder' => 'Enter the Description here...', 'rows' => '5', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('description')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('country', 'Country') !!}
                                        <div class="input-group">
                                            {{-- {!! Form::text('country', null, ['class' => 'form-control', 'id' => 'country', 'required' => true, 'placeholder' => 'Enter Country', 'autocomplete' => 'new-country']) !!} --}}

                                            @if (isset($bar))
                                                {!! Form::select('country', $countries, json_decode($bar->country, true), ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Country', 'id' => 'country', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                            @else
                                                {!! Form::select('country', $countries, null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Country', 'id' => 'country', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                            @endif

                                        </div>
                                        @error('country')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('', 'City') !!}
                                        <div class="input-group">
                                            {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'required' => true, 'placeholder' => 'Enter City', 'autocomplete' => 'new-city', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('city')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('show-brand', 'Show Brand') !!}
                                        <div class="input-group">
                                            {!! Form::select('show_brand', ['No', 'Yes'], $bar ? $bar->show_brand == 1 : null, ['class' => 'form-control select2', 'required', 'placeholder' => 'Select Brand Visibility', 'id' => 'show-brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                        </div>
                                        @error('show_brand')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                
                                <div class="col-12 item-color-settings">
                                    <h4>Color Settings</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                {!! Form::label('heading_color', 'Heading Color') !!}
                                                <div class="input-group">
                                                    {!! Form::text('settings[color][heading]', (isset($bar) && $bar ? null : '#092D4D'), ['class' => 'form-control', 'id' => 'heading_color', 'placeholder' => 'Choose the Heading Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                </div>
                                                @error('settings.color.heading')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                {!! Form::label('item_name_color', 'Item Name Color') !!}
                                                <div class="input-group">                                                    
                                                    {!! Form::text('settings[color][item_name]', (isset($bar) && $bar ? null : '#5B6772'), ['class' => 'form-control', 'id' => 'item_name_color', 'placeholder' => 'Choose the Item Name Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                </div>
                                                @error('settings.color.item_name')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                {!! Form::label('item_price_color', 'Item Price Color') !!}
                                                <div class="input-group">
                                                    {!! Form::text('settings[color][item_price]', (isset($bar) && $bar ? null : '#092D4D'), ['class' => 'form-control', 'id' => 'item_price_color', 'placeholder' => 'Choose the Item Price Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                </div>
                                                @error('settings.color.item_price')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                {!! Form::label('highlight_color', 'Highlight Color') !!}
                                                <div class="input-group">
                                                    {!! Form::text('settings[color][highlight]', (isset($bar) && $bar ? null : '#FA4616'), ['class' => 'form-control', 'id' => 'highlight_color', 'placeholder' => 'Choose the Highlight Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                </div>
                                                @error('settings.color.highlight')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        @if (auth()->user()->role_id < $role['Account Admin'])
                                            {!! Form::label('status', 'Status') !!}
                                            <div class="input-group mb-3">
                                                {!! Form::select('status', ['Not Approved', 'Approved'], $bar ? $bar->status == 1 : null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Bar Status', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                            </div>
                                            @error('status')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                        @if ($bar && $bar->status == 1)
                                            <div class="row align-items-center">
                                                <div class="col-12 col-md-3">
                                                    {!! QrCode::size(200)->generate(config('app.url') . '/' . $bar->slug) !!}
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <a href="{{ route('bar.show', $bar->slug) }}" class="mx-2">
                                                        {{ route('bar.show', $bar->slug) }}
                                                    </a>
                                                    <br>
                                                    <a href="{{ route('download-qr-code', $bar->slug) }}" class="btn btn-dark ml-2">Download QR
                                                        Code</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        @if (!request()->has('analytics'))
                                            @if ($bar)
                                                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                            @else
                                                {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if (isset($bar))
                                        <p class="float-right">{{ \Carbon\Carbon::parse($bar->created_at)->format('F d, Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#background_color').colorpicker();
            $('#font_color').colorpicker();
            $('#item_price_color').colorpicker();
            $('#item_name_color').colorpicker();
            $('#highlight_color').colorpicker();
            $('#heading_color').colorpicker();
        });
    </script>
@endsection
