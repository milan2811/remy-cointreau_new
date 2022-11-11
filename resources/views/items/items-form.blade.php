@extends('layouts.admin')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {!! Form::model($item, $formAttributes) !!}
                        <div class="card-body">

                            @include('items.form-fields')

                            <div class="card-footer">
                                <div class="row mb-2 justify-content-between">
                                    <div class="col-6">
                                        @if (!request()->has('analytics'))
                                            <div class="form-group">
                                                @if ($item)
                                                    {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                                @else
                                                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        @if (isset($item))
                                            <p class="float-right">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</p>
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
    </div>
@endsection
