@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::model($promotion, $formAttributes) !!}
                            <div class="form-group">
                                {!! Form::label('bar_id', 'Select Bar') !!}
                                <div class="input-group">
                                    {!! Form::select('bar_id', $bars, $promotion ? $promotion->bar_id : null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Bar', 'id' => 'bar_id', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                </div>
                                @error('bar_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('title', 'Item') !!}
                                <div class="input-group">
                                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Add Item', 'id' => 'title']) !!}
                                </div>
                                @error('title')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('promotion_for', 'Name of the promotion') !!}
                                <div class="input-group">
                                    {!! Form::textarea('promotion_for', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter name of the promotion', 'id' => 'promotion_for']) !!}
                                </div>
                                @error('promotion_for')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Short Description') !!}
                                <div class="input-group">
                                    {!! Form::text('short_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Short Description here...', 'maxlength' => 150]) !!}
                                </div>
                                @error('short_description')
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
                                {!! Form::label('link', 'URL') !!}
                                <div class="input-group">
                                    {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Add URL', 'id' => 'link']) !!}
                                </div>
                                @error('link')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('image', 'Image') !!}
                                <div class="input-group">
                                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image', 'accept' => 'image/*']) !!}
                                </div>
                                @if (isset($promotion))
                                    <img
                                         src='{{ $promotion->image ? asset('/public/images/promotion/' . $promotion->image) : asset('/public/images/placeholder.png') }}' width="200" class="pt-2" />
                                @endif
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="container">
                                <table class="table" id="price-repeater">
                                    <thead>
                                        <tr>
                                            <th>Quantity
                                                @error('quantity')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <th>Price
                                                @error('price')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <th style="width:1%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($promotion) && isset($promotion->price) && !empty($promotion->price))
                                            @php
                                                $prices = json_decode($promotion->price);
                                            @endphp
                                            @foreach ($prices->price as $index => $price)
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                {!! Form::text('price[quantity][]', $prices->quantity[$index], ['class' => 'form-control', 'placeholder' => 'Enter Quantity', 'required' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                {!! Form::text('price[price][]', $prices->price[$index], ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($index == 0)
                                                            <a href="javascript:void(0)" class="btn btn-success" id="add-price">+</a>
                                                        @else
                                                            <a href="javascript:void(0)" class="btn btn-secondary remove-price">-</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            {!! Form::text('price[quantity][]', null, ['class' => 'form-control', 'placeholder' => 'Enter Quantity', 'required' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            {!! Form::text('price[price][]', null, ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-success" id="add-price">+</a>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        @if ($promotion)
                                            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                        @else
                                            {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if (isset($promotion))
                                        <p class="float-right">{{ \Carbon\Carbon::parse($promotion->created_at)->format('F d, Y') }}</p>
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
@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js" referrerpolicy="origin"></script>
    <script>
        $(function() {
            CKEDITOR.replace('description');
            // CKEDITOR.replace('promotion_for');
        });
    </script>
    <style>
        div#cke_description {
            width: 100%;
        }
        div#cke_promotion_for {
            width: 100%;
        }

    </style>
@endsection
