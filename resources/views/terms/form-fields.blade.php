{!! Form::hidden('type', strtolower($title)) !!}
<div class="form-group">
    {!! Form::label('term-name', 'Name') !!}
    <div class="input-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Add ' . ucwords($title) . ' Name', 'id' => 'name', 'disabled' => request()->has('analytics')]) !!}
    </div>
    @error('name')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    <div class="input-group">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description here...', 'disabled' => request()->has('analytics')]) !!}
    </div>
    @error('description')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
@if ($title == 'drink')
<div class="form-group">
    {!! Form::label('background_color', "Background Color") !!}
    <div class="input-group">
        @php
            $colors = ['orange' => 'Orange', 'sky-blue' =>'Sky blue', 'green' => 'Green', 'pink' => 'Pink'];
        @endphp
        {!! Form::text('background_color', null, ['class' => 'form-control select2', 'id' => 'background_color', "placeholder" => "Select Background Color"]) !!}
    </div>
    @error('background_color')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
@endif

@if ($title != 'ingredients' && $title != 'products' && $title != "brands" && $title != 'category')
    <div class="form-group">
        {!! Form::label('picture', 'Picture') !!}
        <div class="input-group">
            {!! Form::file('picture', ['class' => 'form-control', 'id' => 'picture', 'accept' => 'image/*', 'disabled' => request()->has('analytics')]) !!}
        </div>
        @if (isset($term))
            @php
                $picture = $term->picture ? asset('/public/images/terms/picture/' . $term->picture) : asset('/public/images/placeholder.png');
            @endphp
            <img src='{{ $picture }}' width="150" />
        @endif
        @error('picture')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endif

@if ($title == 'brands')
    <div class="form-group">
        {!! Form::label('parent', 'Select Parent') !!}
        <div class="input-group">
            {!! Form::select('parent', $parents, isset($term) && !empty($term) ? $term->parent : null, ['class' => 'form-control select2', 'placeholder' => '-- No Parent', 'disabled' => request()->has('analytics')]) !!}
        </div>
        @error('parent')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endif
