@extends('layouts.login')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{{route('home')}}">
            <img src="{{ asset('public/images/logo.png') }}" alt="logo" class="login-form-logo">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        {!! Form::open(['url' => route('password.email'), 'method' => "POST"]) !!}        
          <div class="input-group mb-3">
            {!! Form::email('email', null, ['class' => 'form-control', "required" => true, "autofocus" => true, "placeholder" => "Email"]) !!}            
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
          <div class="row">
            <div class="col-12">
                {!! Form::submit('Request New Password', ['class' => 'btn btn-primary btn-block']) !!}              
            </div>
            <!-- /.col -->
          </div>
        {!! Form::close() !!}
  
        <p class="mt-3 mb-1">
          <a href="{{ route('login') }}">Login</a>
        </p>
        {{-- <p class="mb-0">
          <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
        </p> --}}
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
