@extends('layouts.admin')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {!! Form::model(isset($requestItem) ? $requestItem->object : null, $formAttributes) !!}
          <div class="card">
            <div class="card-body">
              @if (!isset($requestItem) || !$requestItem)
                @php
                  $user = auth()->user();
                @endphp
                {!! Form::hidden('username', $user->name) !!}
                {!! Form::hidden('email', $user->email) !!}
                {!! Form::hidden('bar_id', request()->get('bar')) !!}                  
              @endif
              
              <div class="form-group">
                {!! Form::label('request_for', 'Request For') !!}
                <div class="input-group">
                  {!! Form::select('request_for', ['brands' => 'Liqueurs brand', 'ingredients' => 'Non-alcoholic ingredients', 'category' => 'Liqueurs category'], (isset($requestType) && !empty($requestType) ? $requestType : null), ['class' => 'form-control select2', 'id' => 'request_for', 'data-placeholder' => 'please Select ', 'required' => true, 'disabled' => request()->has('analytics')]) !!}
                </div>
                @error('request_for')
                  <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              {{-- @if (isset($requestType) && $requestType != 'item')
                @php
                  $title = $requestType;
                  $parents = \App\Models\Term::select("id", "name")->where('type', $title)->where('status', 1)->pluck("name", "id")->toArray();
                @endphp
                @include('terms.form-fields', ['title' => $title, 'parents' => $parents])         
              @else 
                @php
                  $terms = \App\Models\Term::where('status', 1)->get();
                @endphp
                @include('items.form-fields', ['terms', $terms, 'item' => isset($requestItem) && !empty($requestItem) ? $requestItem->object : null,  'selectedBar' => request()->get('bar') ])                
              @endif --}}

              @php
                $title = $requestType ? $requestType : 'brands';
                $parents = \App\Models\Term::select("id", "name")->where('type', $title)->where('status', 1)->pluck("name", "id")->toArray();
              @endphp
              @include('terms.form-fields', ['title' => $title, 'parents' => $parents])         
              
              <div class="form-group">
                {!! Form::label('message', 'Message') !!}
                <div class="input-group">
                  {!! Form::textarea('message', (isset($requestItem) ? $requestItem->message : null), ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Enter your messsage here', 'disabled' => request()->has('analytics')]) !!}
                </div>
                @error('message')
                  <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="card-footer">
              <div class="form-group">
                @if(isset($requestItem) && $requestItem->status !== null) 
                  @if ($requestItem->status == 1)
                    <div class="text-success text-right">Approved</div>
                  @endif
                  @if ($requestItem->status == 0)
                    <div class="text-danger text-right">Rejected</div>
                  @endif
                @elseif (isset($requestItem) && $requestItem->object)                
                  {!! Form::submit('Approve', ['class' => 'btn btn-success', 'name' => 'status']) !!}    
                  {!! Form::submit('Reject', ['class' => 'btn btn-success', 'name' => 'status']) !!}    
                @else 
                  {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                @endif
              </div>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <script>
    (function() {
      const currentPageUrl = "{{route('request.create', ['bar' => request()->get('bar')])}}";
      $("#request_for").change((e) => {        
        window.location.href = currentPageUrl + "&request="+ e.target.value;
      });
    })();
  
  </script>
@endsection


