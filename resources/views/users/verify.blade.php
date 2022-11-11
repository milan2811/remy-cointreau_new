@extends('layouts.admin')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {!! Form::open(['url' => route('users.update', $user->id), 'method' => "PUT"]) !!}
          {!! Form::hidden('password', $user->update_password) !!}
          <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('verify-otp', 'OTP (One Time Password)') !!}
                    <div class="input-group">
                    {!! Form::password('verify_otp', ['class' => 'form-control', 'id' => 'verify-otp', 'placeholder' => 'Enter OTP sent to your mail', ]) !!}
                    </div>
                    @error('verify_otp')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>                               
            </div>  
            <div class="card-footer">
              <div class="form-group">                
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}                
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
