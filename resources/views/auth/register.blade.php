@extends('layouts.login')

@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="{{route('home')}}">
        <img src="{{ asset('public/images/logo_round.svg') }}" alt="logo" class="login-form-logo">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        
        {!! Form::open(['url' => route('register'), "method" => "POST"]) !!}

            <p class="login-box-msg">Sign up to start your session</p>
            @php
                $fields = request()->all();
                unset($fields["_token"],$fields["name"], $fields["email"], $fields["password"], $fields["password_confirmation"], $fields["phone"]);            
            @endphp
            @foreach ($fields as $key=>$field)
                {!! Form::hidden($key, $field) !!}
            @endforeach
            <div class="input-group mb-3">                                
                {!! Form::text("name", old('name') ? old('name') : request()->get('name'), ['class' => 'form-control', "placeholder" => "Name", "required" => true, 'autofocus' => true, "autocomplete" => 'name']) !!}                                    
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
            </div>
            <div class="input-group mb-3">
                {!! Form::email("email", old('email') ? old('email') : request()->get('email'), ['class' => 'form-control', "placeholder" => "Email", "required" => true, "autocomplete" => 'email']) !!}
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>                    
            <div class="input-group mb-3">                
                {!! Form::password('password', ['class' => 'form-control', "autocomplete"=>"new-password", "required" => true, "placeholder" => "Password"]) !!}                                
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
            </div>

            <div class="input-group mb-3">                
                {!! Form::password('password_confirmation', ['class' => 'form-control', "autocomplete"=>"new-password", "required" => true, "placeholder" => "Confirm Password"]) !!}                            
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
            </div>

            <div class="input-group mb-3">                                                
                {!! Form::text('phone', old('phone') ? old('phone') : request()->get('phone'), ['class' => 'form-control', 'required' => true, "autocomplete" => "phone", 'placeholder' => "Contact No."]) !!}                
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                </div>
                @error('phone')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
            </div>            

          <div class="form-group">
              {!! Form::submit("Sign up", ["class" => "btn btn-primary btn-block"]) !!}
          </div>

        {!! Form::close() !!}

        @if (Route::has('password.request'))
        <p class="mb-1">
          <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
        @endif
        {{-- @if (Route::has('register'))
        <p class="mb-0">
          <a href="{{  route('register') }}" class="text-center">Register a new membership</a>
        </p>
        @endif --}}
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->




{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Contact No.') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __("Register as:") }}</label>
                            <div class="col-md-6">
                                <select name="role" id="role" class="form-control" required>
                                    @foreach (App\Models\Role::all() as $role)
                                        <option value="{{$role->role}}">{{ $role->role_name }}</option>                                        
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
