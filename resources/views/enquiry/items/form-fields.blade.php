@php
$drinks = $terms
    ->where('type', 'drink')
    ->pluck('name', 'id')
    ->toArray();
$category = $terms
    ->where('type', 'category')
    ->pluck('name', 'id')
    ->toArray();
$brands = $terms
    ->where('type', 'brands')
    ->pluck('name', 'id')
    ->toArray();
$ingredients = $terms
    ->where('type', 'ingredients')
    ->pluck('name', 'id')
    ->toArray();
$products = $terms
    ->where('type', 'products')
    ->pluck('name', 'id')
    ->toArray();

$liquor_brands = $terms->where('type', 'brands')
    ->whereIn('name', ['LOUIX XIII', 'Remy martin', 'The Botanist', 'Cointreau', 'Mount gay'])
    ->pluck('name', 'id')
    ->toArray();
// foreach ($terms as $term) {
//     if ($term->type == 'category') {
//         $category[$term->id] = $term->name;
//     }
//     if ($term->type == 'ingredients') {
//         $ingredients[$term->id] = $term->name;
//     }
//     if ($term->type == 'brands') {
//         $brands[$term->id] = $term->name;
//     }
// }

// $bars = [];
// $bars[''] = 'Select Bar';
// foreach ($barsList as $bar) {
//     $bars[$bar->id] = $bar->name;
// }
@endphp

{!! Form::hidden('bar_id', $selectedBar) !!}

<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    <div class="input-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Item Name', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
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
        {!! Form::textarea('description', null, ['class' => request()->has('analytics') && request()->get('analytics') ? 'form-control' : 'form-control summernote-description', 'id' => 'description', 'placeholder' => 'Enter Item Description here...', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
    </div>
    @error('description')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('drink', 'Select Drink') !!}
    <div class="input-group">
        {!! Form::select('drink_id', $drinks, $item ? $item->drink_id : null, ['class' => 'form-control select2', 'id' => 'drink', 'data-placeholder' => 'Select Drink', 'required' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
    </div>
    @error('drink_id')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('ingredients', 'Ingredients') !!}
    <div class="input-group">
        {!! Form::select('ingredients[]', $ingredients, $item ? $selectedIngredients : [], ['class' => 'form-control select2', 'data-placeholder' => 'Select Ingredients', 'placeholder' => 'Select Ingredients', 'multiple' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
    </div>
    @error('ingredients')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="row">
    {{-- <div class="col-3">
    {!! Form::label('ingredients', 'Select Ingredients (Alcholic)') !!}
</div> --}}
    <div class="col-4">
        {!! Form::label('ingredient_category', 'Select Category') !!}
    </div>
    <div class="col-4">
        {!! Form::label('brand', 'Select Brand') !!}
    </div>
    <div class="col-3">
        {!! Form::label('brand', 'Products') !!}
    </div>
</div>

<div class="ingredients-container">

    @if (!$item || empty($selectedBrandsCates))
        <div class="row">
            <div class="col-4 category">
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::select('ingredient_category[cate][]', $category, null, ['class' => 'form-control custom-select2', 'placeholder' => 'Select Category', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                    </div>
                    @error('ingredient_category')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-4 brands">
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::select('ingredient_category[brand][]', $brands, null, ['class' => 'form-control custom-select2 parent-brand', 'placeholder' => 'Select Brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                    </div>
                </div>
            </div>
            <div class="col-3 brands">
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::select('ingredient_category[child_brand][]', $products, null, ['class' => 'form-control custom-select2 child-brand', 'placeholder' => 'Select Product', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                    </div>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <a href="javascript:void(0)" class="btn btn-danger add-ingredient">+</a>
                </div>
            </div>
        </div>
    @else
        @php
            $brandsIndex = 0;
        @endphp
        {{-- @foreach ($selectedCategory as $index => $cat)
            <div class="row">
                <div class="col-4 category">
                    <div class="form-group">
                        <div class="input-group">
                            {!! Form::select('ingredient_category[]', $category, $cat, ['class' => 'form-control custom-select2', 'placeholder' => 'Select Category', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                        </div>
                        @error('ingredient_category')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4 brands">
                    <div class="form-group">
                        <div class="input-group">
                            {!! Form::select('brand[]', $brands, isset($selectedBrands[$brandsIndex]) ? $selectedBrands[$brandsIndex]->id : null, ['class' => 'form-control custom-select2 parent-brand', 'placeholder' => 'Select Brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-3 brands">
                    <div class="form-group">
                        <div class="input-group">
                            <select name="brand[]" class="form-control custom-select2 child-brand" placeholder="Select Product"
                                    {{ request()->has('analytics') && request()->get('analytics') ? 'disabled' : null }}>
                                <option value="">Select Product</option>
                                @if (isset($selectedBrands[$brandsIndex]) && $selectedBrands[$brandsIndex]->children)
                                    @foreach ($selectedBrands[$brandsIndex]->children as $child)
                                        <option value="{{ $child->id }}"
                                                {{ isset($selectedBrands[$brandsIndex + 1]) && $selectedBrands[$brandsIndex + 1]->id == $child->id ? 'selected' : null }}>
                                            {{ $child->name }}</option>
                                    @endforeach
                                @endif
                                @php
                                    $brandsIndex = $brandsIndex + 2;
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-group">
                        <a href="javascript:void(0)"
                           class="btn {{ $index == 0 ? 'btn-danger add-ingredient' : 'btn-secondary remove-ingredient' }}">
                            {{ $index == 0 ? '+' : '-' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach --}}

        @foreach ($selectedBrandsCates as $index => $selectedBrandsCate)
            <div class="row">
                @if (isset($selectedBrandsCate[0]))
                    <div class="col-4 category">
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::select('ingredient_category[cate][]', $category, $selectedBrandsCate[0]->id, ['class' => 'form-control custom-select2', 'placeholder' => 'Select Category', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                            </div>
                            @error('ingredient_category')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="col-4 category">
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::select('ingredient_category[cate][]', $category, null, ['class' => 'form-control custom-select2', 'placeholder' => 'Select Category', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                            </div>
                            @error('ingredient_category')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif
                @if (isset($selectedBrandsCate[1]))
                    <div class="col-4 brands">
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::select('ingredient_category[brand][]', $item->drink_id == 42 ? $liquor_brands : $brands, $selectedBrandsCate[1]->id, ['class' => 'form-control custom-select2 parent-brand', 'placeholder' => 'Select Brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-4 brands">
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::select('ingredient_category[brand][]', $item->drink_id == 42 ? $liquor_brands : $brands, null, ['class' => 'form-control custom-select2 parent-brand', 'placeholder' => 'Select Brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                            </div>
                        </div>
                    </div>
                @endif                
                @if (isset($selectedBrandsCate[2]) || isset($selectedBrandsCate[1]))
                    <div class="col-3 brands">
                        <div class="form-group">
                            <div class="input-group">                                
                                @if ($selectedBrandsCate[1])
                                    <select name="ingredient_category[child_brand][]" class="form-control custom-select2 child-brand"
                                            placeholder="Select Product"
                                            {{ request()->has('analytics') && request()->get('analytics') ? 'disabled' : null }}>
                                        <option value="">Select Product</option>                                    
                                        @if ($selectedBrandsCate[1]->children)
                                            @foreach ($selectedBrandsCate[1]->children as $child)
                                                <option value="{{ $child->id }}" @if ($selectedBrandsCate[2] && $selectedBrandsCate[2]->id == $child->id) selected @endif> {{ $child->name }}
                                                </option>
                                            @endforeach                                                                                    
                                        @endif
                                    </select>
                                @else                                     
                                    {!! Form::select('ingredient_category[child_brand][]', $products, $selectedBrandsCate[2]->id, ['class' => 'form-control custom-select2 child-brand', 'placeholder' => 'Select Product', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}                                    
                                @endif
                                
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-3 brands">
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::select('ingredient_category[child_brand][]', $products, null, ['class' => 'form-control custom-select2 child-brand', 'placeholder' => 'Select Product', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-1">
                    <div class="form-group">
                        <a href="javascript:void(0)"
                           class="btn {{ $index == 0 ? 'btn-danger add-ingredient' : 'btn-secondary remove-ingredient' }}">
                            {{ $index == 0 ? '+' : '-' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach


    @endif
</div>

<div class="form-group">
    {!! Form::label('Upload Media') !!}
    {!! Form::hidden('media_type', 'image') !!}
    <!-- Nav tabs -->
    <ul class="nav nav-tabs justify-content-around">
        <li class="nav-item w-50 text-center">
            <a class="nav-link active" data-toggle="tab" href="#media1" data-type="image">
                Image
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content media-type-container">
        <div id="media1" class="tab-pane mt-2 active">
            {!! Form::label('upload-image', 'Upload Image') !!}
            {!! Form::file('images[]', ['class' => 'form-control', 'id' => 'upload-image', 'multiple' => true, 'accept' => 'image/*', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
        </div>
        <div id="media2" class="tab-pane mt-2 fade">
            {!! Form::label('upload-video', 'Upload Video') !!}
            {!! Form::file('video', ['class' => 'form-control', 'id' => 'upload-video', 'accept' => 'video/*', 'disabled' => request()->has('analytics') && request()->get('analytics')]) !!}
        </div>
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
                @if (isset($item) && isset($item->price) && !empty($item->price))
                    @php
                        $prices = json_decode($item->price);
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


@section('scripts')
    <script>
        $(function() {

            const INGREDIENT_ROW = $(".ingredients-container .row").first().html().replaceAll("btn-danger add", "btn-secondary remove").replace(
                "+", "-");

            $('.form-group .nav-link').click((e) => {
                $('input[name="media_type"]').val($(e.target).data('type'));
            });

            $(".custom-select2").select2({
                theme: 'bootstrap4',
                escapeMarkup: function(markup) {
                    return markup;
                }
            });
            $(document).on("click", ".add-ingredient", (e) => {
                $(".ingredients-container").append('<div class="row">' + INGREDIENT_ROW + '</div>');
                $(".custom-select2").select2({
                    theme: 'bootstrap4',
                    escapeMarkup: function(markup) {
                        return markup;
                    }
                });
                $(".ingredients-container .row:last select").val('').trigger('change');
            });

            $(document).on("click", ".remove-ingredient", (e) => {
                $(e.target).closest(".row").remove();
            });

            $(document).on("change", "select.parent-brand", (e) => {
                // if (e.target.value == '') {
                //     return $(e.target).closest('.row').find("select.child-brand").html('<option value="">Select Product</option>');
                // }
                $.ajax({
                    url: `{!! route('term.getchildren') !!}?id=${e.target.value}`,
                    method: 'GET',
                    body: {
                        id: e.target.value,
                    },
                    success: function(result) {
                        if (result.success == 1) {
                            let html = '<option value="">Select Product</option>';
                            $.each(result.terms, (index, term) => {
                                html += `<option value="${index}">${term}</option>`;
                            });
                            $(e.target).closest('.row').find("select.child-brand").html(html);
                        }
                    },
                    error: function(err) {
                        console.error(err)
                    }
                });
            });            

        });

        const liquorBrands = JSON.parse('{!! json_encode($liquor_brands) !!}');        
        const allBrands = JSON.parse('{!! str_replace("'", "\'", json_encode($brands)) !!}'); 
        
        $("select#drink").change((e) => {                        
            let options = '<option>Select Brand</option>';
            if(e.target.value == 42) {
                Object.keys(liquorBrands).map((key) => {
                    options += '<option value="'+key+'">'+liquorBrands[key]+'</option>';
                });                
            } else {
                Object.keys(allBrands).map((key) => {
                    options += '<option value="'+key+'">'+allBrands[key]+'</option>';
                });
            }
            $(".parent-brand").html(options);
        })        


        // $('.bar-select').change(function(e) {
        //   e.preventDefault();
        //   getCate($(this).val());
        // });

        // function getCate(bar_id) {
        //   $.ajax({
        //     headers: {
        //       'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        //     },
        //     type: "post",
        //     dataType: "json",
        //     url: "{{ route('get.items.category') }}",
        //     data: {
        //       bar_id: bar_id
        //     },
        //     success: function(res) {
        //       $('#cate-and-in').html(res.data);
        //     }
        //   });
        // }
    </script>
@endsection
