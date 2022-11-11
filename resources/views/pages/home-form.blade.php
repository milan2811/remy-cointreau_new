@extends('layouts.admin')

@section('content')
    @php
    $user = auth()->user();
    @endphp
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {!! Form::model($home, ['url' => route('page.update', 'home'), 'class' => 'repeater', 'method' => 'POST', 'files' => true]) !!}
            <div class="row">
                <div class="col-12">
                    {{-- Banner Section --}}
                    <div class="accordion" id="banner-accordian">
                        <div class="card">
                            <div class="card-header" id="banner-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#banner-collapse">
                                        <h4>Banner Section</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="banner-collapse" class="collapse" aria-labelledby="banner-heading"
                                data-parent="#banner-accordian">
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('banner-title', 'Title') !!}
                                        <div class="input-group">
                                            {!! Form::text('banner[title]', null, ['class' => 'form-control', 'id' => 'banner-title']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('banner-heading', 'Heading') !!}
                                        <div class="input-group">
                                            {!! Form::text('banner[heading]', null, ['class' => 'form-control', 'id' => 'banner-heading']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('banner-description', 'Description') !!}
                                        <div class="input-group">
                                            {!! Form::textarea('banner[description]', null, ['class' => 'form-control', 'rows' => 4]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('banner-image', 'Image') !!}
                                        <div class="input-group">
                                            <label>
                                                <img src="{{ isset($home) && isset($home['banner']->image) && $home['banner']->image ? asset('public/images/uploads/'.$home['banner']->image) : asset('public/images/placeholder.png')}}" alt="" width="150" height="100">
                                                {!! Form::file('banner[image]', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            {!! Form::label('banner-cta', 'CTA Text') !!}
                                            <div class="input-group">
                                                {!! Form::text('banner[cta][text]', null, ['class' => 'form-control', 'id' => 'banner-cta']) !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('banner-cta-url', 'CTA URL') !!}
                                            <div class="input-group">
                                                {!! Form::text('banner[cta][url]', null, ['class' => 'form-control', 'id' => 'banner-cta-url']) !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Banner Section --}}

                    {{-- Availble Bars Accordian --}}
                    <div class="accordion" id="available-bars-accordian">
                        <div class="card">
                            <div class="card-header" id="available-bars-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#available-bars-collapse">
                                        <h4>Available Restaurants</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="available-bars-collapse" class="collapse" aria-labelledby="available-bars-heading"
                                    data-parent="#available-bars-accordian">
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('available-heading', 'Heading') !!}
                                        {!! Form::text('available[heading]', null, ['class' => 'form-control']) !!}
                                    </div>    
                                    <div class="bars table-responsive">
                                        <h4>Bars</h4>
                                        <table class="table sortable-table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="10px">#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>URL</th>
                                                    <th width="10px"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-list" data-repeater-list="available[bars]">                                                
                                                @if (isset($home) && isset($home['available']->bars))
                                                    @foreach ($home['available']->bars as $bar)
                                                        <tr class="sortable-item" data-repeater-item>
                                                            <td><i class="fa fa-bars"></i></td>
                                                            <td><label>
                                                                <img src="{{isset($bar->image) && $bar->image ? asset('public/images/uploads/'. $bar->image) : asset('public/images/placeholder.png')}}" width="100" height="100" alt="">
                                                                {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                                {!! Form::hidden('image_name', isset($bar->image) ? $bar->image : null) !!}
                                                            </label> </td>
                                                            <td>
                                                                {!! Form::text('name', $bar->name, ['class' => 'form-control']) !!}
                                                            </td>
                                                            <td>{!! Form::text('url', $bar->url, ['class' => 'form-control', 'accept' => 'image/*']) !!}</td>
                                                            <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                        </tr>                                                    
                                                    @endforeach
                                                @else 
                                                    <tr class="sortable-item" data-repeater-item>
                                                        <td><i class="fa fa-bars"></i></td>
                                                        <td><label>
                                                            <img src="{{asset('public/images/placeholder.png')}}" width="100" height="100" alt="">
                                                            {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                            {!! Form::hidden('image_name', null) !!}
                                                        </label> </td>
                                                        <td>
                                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                                        </td>
                                                        <td>{!! Form::text('url', null, ['class' => 'form-control', 'accept' => 'image/*']) !!}</td>
                                                        <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        <div class="text-right">
                                            <button class="btn btn-secondary add" data-repeater-create type="button">
                                                + Add
                                            </button>
                                        </div>
                                        
                                    </div>

                                    <div class="bars table-responsive">
                                        <h4>Restaurants</h4>
                                        <table class="table sortable-table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="10px">#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>URL</th>
                                                    <th width="10px"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-list" data-repeater-list="available[restaurants]">
                                                @if (isset($home) && isset($home['available']->restaurants))
                                                    @foreach ($home['available']->restaurants as $restaurant)
                                                        <tr class="sortable-item" data-repeater-item>
                                                            <td><i class="fa fa-bars"></i></td>
                                                            <td><label>
                                                                <img src="{{isset($restaurant->image) && $restaurant->image ? asset('public/images/uploads/'. $restaurant->image) : asset('public/images/placeholder.png')}}" width="100" height="100" alt="">
                                                                {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                                {!! Form::hidden('image_name', isset($restaurant->image) ? $restaurant->image : null) !!}
                                                            </label> </td>
                                                            <td>
                                                                {!! Form::text('name', $restaurant->name, ['class' => 'form-control']) !!}
                                                            </td>
                                                            <td>{!! Form::text('url', $restaurant->url, ['class' => 'form-control', 'accept' => 'image/*']) !!}</td>
                                                            <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                        </tr>    
                                                    @endforeach
                                                @else
                                                    <tr class="sortable-item" data-repeater-item>
                                                        <td><i class="fa fa-bars"></i></td>
                                                        <td><label>
                                                            <img src="{{asset('public/images/placeholder.png')}}" width="100" height="100" alt="">
                                                            {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                            {!! Form::hidden('image_name', null) !!}
                                                        </label> </td>
                                                        <td>
                                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                                        </td>
                                                        <td>{!! Form::text('url', null, ['class' => 'form-control', 'accept' => 'image/*']) !!}</td>
                                                        <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        <div class="text-right">
                                            <button class="btn btn-secondary add" data-repeater-create type="button">
                                                + Add
                                            </button>
                                        </div>
                                        
                                    </div>

                                    <div class="bars table-responsive">
                                        <h4>Nightclubs</h4>
                                        <table class="table sortable-table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="10px">#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>URL</th>
                                                    <th width="10px"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-list" data-repeater-list="available[nightclubs]">
                                                @if (isset($home) && isset($home['available']->nightclubs))
                                                    @foreach ($home['available']->nightclubs as $nightclub)
                                                        <tr class="sortable-item" data-repeater-item>
                                                            <td><i class="fa fa-bars"></i></td>
                                                            <td><label>
                                                                <img src="{{isset($nightclub->image) && $nightclub->image ? asset('public/images/uploads/'. $nightclub->image) : asset('public/images/placeholder.png')}}" width="100" height="100" alt="">
                                                                {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                                {!! Form::hidden('image_name', isset($nightclub->image) ? $nightclub->image : null) !!}
                                                            </label> </td>
                                                            <td>
                                                                {!! Form::text('name', $nightclub->name, ['class' => 'form-control']) !!}
                                                            </td>
                                                            <td>{!! Form::text('url', $nightclub->url, ['class' => 'form-control', 'accept' => 'image/*']) !!}</td>
                                                            <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                        </tr>    
                                                    @endforeach
                                                @else
                                                    <tr class="sortable-item" data-repeater-item>
                                                        <td><i class="fa fa-bars"></i></td>
                                                        <td><label>
                                                            <img src="{{asset('public/images/placeholder.png')}}" width="100" height="100" alt="">
                                                            {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                            {!! Form::hidden('image_name', null) !!}
                                                        </label> </td>
                                                        <td>
                                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                                        </td>
                                                        <td>{!! Form::text('url', null, ['class' => 'form-control', 'accept' => 'image/*']) !!}</td>
                                                        <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        <div class="text-right">
                                            <button class="btn btn-secondary add" data-repeater-create type="button">
                                                + Add
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>                        
                            </div>
                        </div>
                    </div>
                    {{-- Availble Bars Accordian --}}


                    {{-- About us --}}
                    <div class="accordion" id="about-us-accordian">
                        <div class="card">
                            <div class="card-header" id="about-us-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#about-us-collapse">
                                        <h4>About us</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="about-us-collapse" class="collapse" aria-labelledby="about-us-heading"
                                data-parent="#about-us-accordian">
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('about-heading', 'Heading') !!}
                                        <div class="input-group">
                                            {!! Form::text('about[heading]', null, ['class' => 'form-control', 'id' => 'about-heading']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('about-description', 'Description') !!}
                                        <div class="input-group">
                                            {!! Form::textarea('about[description]', null, ['class' => 'form-control', 'rows' => 4]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('about-image', 'Image') !!}
                                        <div class="input-group">
                                            <label>
                                                <img src="{{ isset($home) && isset($home['about']->image) && $home['about']->image ? asset('public/images/uploads/'.$home['about']->image) : asset('public/images/placeholder.png')}}" alt="" width="150" height="100">
                                                {!! Form::file('about[image]', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- About us --}}


                    {{-- Easy to manage --}}
                    <div class="accordion" id="easy-manage-accordian">
                        <div class="card">
                            <div class="card-header" id="easy-manage-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#easy-manage-collapse">
                                        <h4>Easy to manage</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="easy-manage-collapse" class="collapse" aria-labelledby="easy-manage-heading"
                                data-parent="#easy-manage-accordian">
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('easy-heading', 'Heading') !!}
                                        <div class="input-group">
                                            {!! Form::text('easy[heading]', null, ['class' => 'form-control', 'id' => 'easy-heading']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('easy-description', 'Description') !!}
                                        <div class="input-group">
                                            {!! Form::textarea('easy[description]', null, ['class' => 'form-control', 'rows' => 4]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('easy-image', 'Image') !!}
                                        <div class="input-group">
                                            <label>
                                                <img src="{{ isset($home) && isset($home['easy']->image) && $home['easy']->image ? asset('public/images/uploads/'.$home['easy']->image) : asset('public/images/placeholder.png')}}" alt="" width="150" height="100">
                                                {!! Form::file('easy[image]', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                            </label>
                                            
                                        </div>
                                    </div>

                                    <div class="feature table-responsive">
                                        <table class="table sortable-table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="10px">#</th>
                                                    <th>Icon</th>
                                                    <th>Heading</th>
                                                    <th>Description</th>
                                                    <th width="10px"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-list" data-repeater-list="easy[feature]">
                                                @if (isset($home) && isset($home['easy']->feature))
                                                    @foreach ($home['easy']->feature as $feature)
                                                        <tr class="sortable-item" data-repeater-item>
                                                            <td><i class="fa fa-bars"></i></td>
                                                            <td>{!! Form::select('icon', ["icon-mobile" => 'Mobile', 
                                                            "icon-list" => "List", 
                                                            "icon-glass" => 'Glass', 
                                                            "icon-money" => 'Money'], $feature->icon, ["class" => 'form-control']) !!}</td>
                                                            <td>{!! Form::text('heading', $feature->heading, ['class' => 'form-control']) !!}</td>
                                                            <td>{!! Form::text('description', $feature->description, ['class' => 'form-control']) !!}</td>
                                                            <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                        </tr>                                                        
                                                    @endforeach
                                                @else 
                                                    <tr class="sortable-item" data-repeater-item>
                                                        <td><i class="fa fa-bars"></i></td>
                                                        <td>{!! Form::select('icon', ["icon-mobile" => 'Mobile', 
                                                        "icon-list" => "List", 
                                                        "icon-glass" => 'Glass', 
                                                        "icon-money" => 'Money'], null, ["class" => 'form-control']) !!}</td>
                                                        <td>{!! Form::text('heading', null, ['class' => 'form-control']) !!}</td>
                                                        <td>{!! Form::text('description', null, ['class' => 'form-control']) !!}</td>
                                                        <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            <button class="btn btn-secondary add" data-repeater-create type="button">
                                                + Add
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Easy to manage --}}

                    {{-- How it works --}}
                    <div class="accordion" id="how-works-accordian">
                        <div class="card">
                            <div class="card-header" id="how-works-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#how-works-collapse">
                                        <h4>How it Works</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="how-works-collapse" class="collapse" aria-labelledby="how-works-heading"
                                data-parent="#how-works-accordian">
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('how-heading', 'Heading') !!}
                                        <div class="input-group">
                                            {!! Form::text('how[heading]', null, ['class' => 'form-control', 'id' => 'how-heading']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('how-description', 'Description') !!}
                                        <div class="input-group">
                                            {!! Form::textarea('how[description]', null, ['class' => 'form-control', 'rows' => 4]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('how-image', 'Image') !!}
                                        <div class="input-group">
                                            <label>
                                                <img src="{{ isset($home) && isset($home['how']->image) && $home['how']->image ? asset('public/images/uploads/'.$home['how']->image) : asset('public/images/placeholder.png')}}" alt="" width="150" height="100">
                                                {!! Form::file('how[image]', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                            </label>                                            
                                        </div>
                                    </div>

                                    <div class="help table-responsive">
                                        <table class="table sortable-table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="10px">#</th>
                                                    <th>Heading</th>
                                                    <th>Description</th>
                                                    <th width="10px"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-list" data-repeater-list="how[help]">
                                                @if (isset($home) && isset($home['how']->help))
                                                    @foreach ($home['how']->help as $help)
                                                        <tr class="sortable-item" data-repeater-item>
                                                            <td><i class="fa fa-bars"></i></td>          
                                                            <td>{!! Form::text('heading', $help->heading, ['class' => 'form-control']) !!}</td>
                                                            <td>{!! Form::text('description', $help->description, ['class' => 'form-control']) !!}</td>
                                                            <td><button data-repeater-delete type="button" class="btn btn-danger remove"> - </button></td>
                                                        </tr>
                                                    @endforeach
                                                @else 
                                                <tr class="sortable-item" data-repeater-item>
                                                    <td><i class="fa fa-bars"></i></td>          
                                                    <td>{!! Form::text('heading', null, ['class' => 'form-control']) !!}</td>
                                                    <td>{!! Form::text('description', null, ['class' => 'form-control']) !!}</td>
                                                    <td><button data-repeater-delete type="button" class="btn btn-danger remove"> - </button></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            <button class="btn btn-secondary add" data-repeater-create type="button">
                                                + Add
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- How it works --}}

                    <div class="accordion" id="logos-accordian">
                        <div class="card">
                            <div class="card-header" id="logos-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#logos-collapse">
                                        <h4>Logos</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="logos-collapse" class="collapse" aria-labelledby="logos-heading"
                                    data-parent="#logos-accordian">
                                <div class="card-body">
                                    <div class="bars table-responsive">                                        
                                        <table class="table sortable-table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="10px">#</th>
                                                    <th>Image</th>                                                    
                                                    <th width="10px"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-list" data-repeater-list="logos">
                                                @if (isset($home) && isset($home['logos']))
                                                    @foreach ($home['logos'] as $logo)
                                                        <tr class="sortable-item" data-repeater-item>
                                                            <td><i class="fa fa-bars"></i></td>
                                                            <td><label>
                                                                <img src="{{isset($logo->image) && $logo->image ? asset('public/images/uploads/'. $logo->image) : asset('public/images/placeholder.png')}}" width="150" height="100" alt="">
                                                                {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                                {!! Form::hidden('image_name', isset($logo->image) ? $logo->image : null) !!}
                                                            </label> </td>                                                            
                                                            <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                        </tr>    
                                                    @endforeach
                                                @else
                                                    <tr class="sortable-item" data-repeater-item>
                                                        <td><i class="fa fa-bars"></i></td>
                                                        <td><label>
                                                            <img src="{{asset('public/images/placeholder.png')}}" width="150" height="100" alt="">
                                                            {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                            {!! Form::hidden('image_name', null) !!}
                                                        </label> </td>                                                       
                                                        <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        <div class="text-right">
                                            <button class="btn btn-secondary add" data-repeater-create type="button">
                                                + Add
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>                        
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-right">
                                    {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        .accordion {
            margin: 15px;
        }

        .accordion .fa {
            margin-right: 0.2rem;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which
            // is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".card-header").find(".fa")
                    .addClass("fa-minus").removeClass("fa-plus");
            });
            // Toggle plus minus icon on show hide
            // of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-minus").addClass("fa-plus");
            });


            $(document).ready(function() {

                const repeater = $('.repeater .table-responsive').repeater({
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    ready: function (setIndexes) {

                    }
                });

                $('.repeater').submit(() => {
                    $('.repeater .table-responsive').repeater();
                })

                // let repeaterHTML = $(".bars.table-responsive .sortable-table tbody tr:first").parent().html();
                // let featureRepeaterHtml = $(".feature.table-responsive .sortable-table tbody tr:first").parent().html();
                // let helpRepeaterHtml = $(".help.table-responsive .sortable-table tbody tr:first").parent().html();
                
                $('.sortable-table .sortable-list').sortable({
                    connectWith: '.sortable-table .sortable-list',
                    placeholder: 'placeholder',   
                    helper: (e, ui) => {
                        ui.children().each(function() {
                            $(this).width($(this).width());                        
                        });
                        return ui;
                    },
                    start: (e, ui) => {
                        ui.placeholder.height(ui.item.height());
                        ui.placeholder.width(ui.item.width());
                    }        
                });

                function fixWidthHelper(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());                        
                    });
                    return ui;
                }

                $(document).on("change", 'input[accept="image/*"]', (e) => {                    
                    if(e.target.files[0]) {
                        let url = URL.createObjectURL(e.target.files[0]);
                        console.log($(e.target).prev());
                        $(e.target).prev().attr('src', url);
                    }
                });

                // $(".add").click((e) =>  {
                //     e.preventDefault();                    
                //     let table = $(e.target).closest(".table-responsive");
                //     if(table.attr("class").includes("feature")) {
                //         table.find("tbody").append(featureRepeaterHtml)
                //         table.find("tbody tr:last input").val("")
                //     } else if(table.attr("class").includes("help")) {
                //         table.find("tbody").append(helpRepeaterHtml)
                //         table.find("tbody tr:last input").val("")
                //     } else {
                //         table.find("tbody").append(repeaterHTML)                    
                //         table.find("tbody tr:last input").val("")
                //     }
                // })

                // $(document).on("click", "button.remove", (e) => {
                //     e.preventDefault();
                //     console.log(e);
                //     $(e.target).closest("tr").remove();
                // });

            });
        });
    </script>
@endsection
