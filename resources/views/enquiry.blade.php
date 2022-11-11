@extends('layouts.home', ['body_class' => 'contact-page'])

@section('content')
    <!--/ default-banner section Start-->
    @if (isset($content['banner']) && isset($content['banner']->title) && $content['banner']->title)
      <div class="default-banner-section">
        <div class="wrap">
          <div class="default-banner-row">
            <h1>{{$content['banner']->title}}</h1>
          </div>
        </div>
      </div>        
    @endif
    <!--/ default-banner section End-->

    <!--/ contact section start-->
    <div class="contact-section">
      @if (isset($content['banner']) && isset($content['banner']->heading) || isset($content['banner']->description))
      <div class="contact-title">
        @if ($content['banner']->heading)
        <h3>{{$content['banner']->heading}}</h3>            
        @endif
        @if ($content['banner']->description)
          <p>{{$content['banner']->description}}</p>
        @endif
      </div>         
      @endif
        {!! Form::open($formAttributes) !!}
        <div class="form-block">
          @if (session()->has('success'))
            <div class="alert alert-success">
              <span>{{ session()->get('success') }}</span>
            </div>                          
          @endif
          @if (session()->get('error'))
            <div class="alert alert-danger">
              <span>{{ session()->get('error') }}</span>
            </div>                          
          @endif
          <div class="details-block">
            <div class="cols cols3">
              <div class="col">
                <div class="form-group">
                  {!! Form::label('name', 'Nombre') !!}
                  {!! Form::text('name', null, ['class' => 'textbox', 'placeholder' => 'Tu nombre', 'id' => 'name', 'required' => true]) !!}
                  <i class="icon-user form-icon"></i>
                  @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  {!! Form::label('email', 'Correo electrónico') !!}
                  {!! Form::email('email', null, ['class' => 'textbox', 'placeholder' => 'introduzca su nombre', 'id' => 'email', 'required' => true]) !!}                  
                  <i class="icon-mail form-icon"></i>
                  @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  {!! Form::label('phone', 'Número de teléfono') !!}
                  {!! Form::text('phone', null, ['class' => 'textbox', 'placeholder' => 'Ingrese su número telefónico', 'id' => 'phone', 'required' => true]) !!}                  
                  <i class="icon-call form-icon"></i>
                  @error('phone')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  {!! Form::label('bar_name', 'Nombre del restaurante') !!}
                  {!! Form::text('bar_name', null, ['class' => 'textbox', 'placeholder' => 'ingrese el nombre del restaurante', 'id' => 'bar_name', 'required' => true]) !!}                    
                  <i class="icon-restaurant form-icon"></i>
                  @error('bar_name')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  {!! Form::label('bar_city', 'Nombre de la ciudad') !!}
                  {!! Form::text('bar_city', null, ['class' => 'textbox', 'placeholder' => 'ingrese el nombre de la ciudad', 'id' => 'bar_city']) !!}                                   
                  <i class="icon-map form-icon"></i>
                  @error('bar_city')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  {!! Form::label('bar_country', 'Nombre del país') !!}
                  {!! Form::text('bar_country', null, ['class' => 'textbox', 'placeholder' => 'ingrese el nombre del país', 'id' => 'bar_country']) !!}                   
                  <i class="icon-pin form-icon"></i>
                  @error('bar_country')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="details-block">
              <div class="cols cols1">
                <div class="col">
                  {!! Form::label('bar_address', 'Dirección') !!}
                  {!! Form::text('bar_address', null, ['class' => 'textbox', 'placeholder' => 'Restaurante Dirección', 'id' => 'bar_address']) !!}                  
                  <i class="icon-location  form-icon"></i>
                  @error('bar_address')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="details-block">
              <div class="cols cols1">
                <div class="col">
                  {!! Form::label('message', 'Mensaje') !!}
                  {!! Form::textarea('message', null, ['placeholder' => 'Escribe algo...', 'id' => 'message']) !!}                  
                  @error('message')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="form-group fbtn">
            <div class="form-button">
              {!! Form::submit('Enviar', ['class' => 'button']) !!}              
            </div>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
    <!--/ contact section start-->

    @if (isset($content['logos']) && sizeof($content['logos'])) 
    <!--/ brands section Start-->
    <div class="brands-section">
        <div class="wrap">
            <div class="logo-boxes">
                @foreach ($content['logos'] as $logo)
                    <div class="logo-box item">
                        <img src="{{$logo->image ? asset('public/images/uploads/'.$logo->image) : asset('public/home/images/brand-1.png')}}" alt="{{$logo->image}}">
                    </div>
                @endforeach                
            </div>
        </div>
    </div>
    <!--/ brands section End-->
    @endif

@endsection