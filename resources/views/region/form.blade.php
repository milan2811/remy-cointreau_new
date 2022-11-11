@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::model($region, $formAttributes) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'Title') !!}
                                <div class="input-group">
                                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Add Title', 'id' => 'title']) !!}
                                </div>
                                @error('title')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description') !!}
                                <div class="input-group">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description here...']) !!}
                                </div>
                                @error('description')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Country') !!}
                                <div class="input-group">
                                    @if (isset($region))
                                        {!! Form::select('country[]', $countries, json_decode($region->country, true), ['class' => 'form-control select2', 'required' => true, 'id' => 'country', 'multiple' => true]) !!}
                                    @else
                                        {!! Form::select('country[]', $countries, null, ['class' => 'form-control select2', 'required' => true, 'id' => 'country', 'multiple' => true]) !!}
                                    @endif
                                </div>
                                @error('country')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        @if ($region)
                                            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                        @else
                                            {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if (isset($region))
                                        <p class="float-right">
                                            {{ \Carbon\Carbon::parse($region->created_at)->format('F d, Y') }}</p>
                                    @endif
                                </div>
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
