@extends('layouts.admin')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {!! Form::model($user, $formAttributes) !!}
          <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('current-password', 'Current Password') !!}
                    <div class="input-group">
                    {!! Form::password('current_password', ['class' => 'form-control', 'id' => 'current-password', 'placeholder' => 'Enter your Current Password', 'required' => true]) !!}
                    </div>
                    @error('current_password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    {!! Form::label('password', 'New Password') !!}
                    <div class="input-group">
                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Enter your New Password', 'required' => true]) !!}
                    </div>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('password-confirm', 'Confirm New Password') !!}
                    <div class="input-group">
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => 'Confirm New Password ', 'required' => true]) !!}
                    </div>
                    @error('password_confirmation')
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
