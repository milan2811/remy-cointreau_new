@extends('layouts.admin')

@section('content')
    @php
    $role = roles();
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {!! Form::model($user, $formAttributes) !!}
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                <div class="input-group">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter your name']) !!}
                                </div>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                <div class="input-group">
                                    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter your Email', 'disabled' => $user != null]) !!}
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            @if (!$user)
                                <div class="form-group">
                                    {!! Form::label('password', 'Password') !!}
                                    <div class="input-group">
                                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Enter your Password']) !!}
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password-confirm', 'Confirm Password') !!}
                                    <div class="input-group">
                                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => 'Confirm Password ']) !!}
                                    </div>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('image', 'Profile Image') !!}
                                <div class="input-group">
                                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}
                                </div>
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::label('phone', 'Phone') !!}
                                <div class="input-group">
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Phone Number', 'id' => 'phone']) !!}
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if (!isset($user) || (auth()->user()->role_id <= $role['Account Admin'] && auth()->user()->id != $user->id))
                                <div class="form-group">
                                    {!! Form::label('role_id', 'Select Role') !!}
                                    <div class="input-group">
                                        {!! Form::select('role_id', $roles, $user ? $user->role_id : null, ['class' => 'form-control', 'placeholder' => 'Select User Role', 'id' => 'role_id', 'required' => true]) !!}
                                    </div>
                                    @error('role_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div
                                         class="regional {{ ($user && $role['Regional Admin'] == $user->role_id) || $errors->has('region') ? 'd-block' : 'd-none' }}">
                                        {!! Form::label('region', 'Select Region') !!}
                                        <div class="input-group">
                                            {!! Form::select('region', $regions, $user ? $user->assigned_id : null, ['class' => 'form-control select2', 'placeholder' => 'Select Region']) !!}
                                        </div>
                                        @error('region')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div
                                         class="national {{ ($user && $role['National Admin'] == $user->role_id) || $errors->has('national') ? 'd-block' : 'd-none' }}">
                                        {!! Form::label('national', 'Select National') !!}
                                        <div class="input-group">
                                            {!! Form::select('national', $countries, $user ? $user->assigned_id : null, ['class' => 'form-control select2', 'placeholder' => 'Select National']) !!}
                                        </div>
                                        @error('national')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div
                                         class="bars {{ ($user && $role['Bar Admin'] == $user->role_id) || $errors->has('bar') ? 'd-block' : 'd-none' }}">
                                        {!! Form::label('bars', 'Select Bar / Restaurant') !!}
                                        <div class="input-group">
                                            {!! Form::select('bar', $bars, $user ? $user->assigned_id : null, ['class' => 'form-control select2', 'placeholder' => 'Select Bar / Restaurant']) !!}
                                        </div>
                                        @error('bar')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if (auth()->user()->id != ($user ? $user->id : false))
                                <div class="form-group">
                                    {!! Form::label('approved', 'Approved') !!}
                                    <div class="input-group">
                                        {!! Form::select('approved', ['No', 'Yes'], $user ? $user->approved : null, ['class' => 'form-control', 'placeholder' => 'Select User Status']) !!}
                                    </div>
                                    @error('approved')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                @if ($user)
                                    {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                @else
                                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}                                    
                                    @if (auth()->user()->role_id <= $role['Super Admin'])
                                    <a href="{{route('register')}}" id="registration-link" class="btn btn-outline-primary">Send Registration Link</a>                                        
                                    @endif
                                @endif

                                @if (auth()->user()->id == ($user ? $user->id : false))
                                    <a href="{{ route('users.update-password', $user->id) }}" class="btn btn-outline-success">Update Password</a>
                                @endif
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
        (function() {
            $('#role_id').change((e) => {
                console.log(e.target.value);
                $('.regional, .national, .bars').removeClass('d-block');
                $('.regional, .national, .bars').addClass('d-none');
                switch (e.target.value) {
                    case '3': // Regional Admin
                        $('.regional').addClass('d-block');
                        break;
                    case '4': // National Admin
                        $('.national').addClass('d-block');
                        console.log(e.target.value);
                        break;
                    case '6': // Bar Admin
                        $('.bars').addClass('d-block');
                        break;
                    default:
                        console.log(e.target.value);
                }
            });

            $("#registration-link").click((e) => {
                // let params = $(e.targer).closest("form").serialize();
                // window.create({"url": "{{route('register')}}?" + params, "incognito": true});
                $(e.target).closest('form').attr({"action": "{{route('register')}}", "method" : "GET", "target": "_blank"});
                $(e.target).closest('form').submit();                
                return false;
            });
        })();
    </script>
@endsection
