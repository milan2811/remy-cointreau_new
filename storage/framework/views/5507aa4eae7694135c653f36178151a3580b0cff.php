<?php
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

$remy_brands = $terms->where('type', 'brands')
    ->whereIn('name', remy_cointreau_brands())
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
?>

<?php echo Form::hidden('bar_id', $selectedBar); ?>


<div class="form-group">
    <?php echo Form::label('name', 'Name'); ?>

    <div class="input-group">
        <?php echo Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Item Name', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

    </div>
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback d-block" role="alert">
            <strong><?php echo e($message); ?></strong>
        </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <?php echo Form::label('description', 'Description'); ?>

    <div class="input-group">
        <?php echo Form::textarea('description', null, ['class' => request()->has('analytics') && request()->get('analytics') ? 'form-control' : 'form-control summernote-description', 'id' => 'description', 'placeholder' => 'Enter Item Description here...', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

    </div>
    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback d-block" role="alert">
            <strong><?php echo e($message); ?></strong>
        </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <?php echo Form::label('drink', 'Select Drink'); ?>

    <div class="input-group">
        <?php echo Form::select('drink_id', $drinks, $item ? $item->drink_id : null, ['class' => 'form-control select2', 'id' => 'drink', 'data-placeholder' => 'Select Drink', 'required' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

    </div>
    <?php $__errorArgs = ['drink_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback d-block" role="alert">
            <strong><?php echo e($message); ?></strong>
        </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <?php echo Form::label('ingredients', 'Ingredients'); ?>

    <div class="input-group">
        <?php echo Form::select('ingredients[]', $ingredients, $item ? $selectedIngredients : [], ['class' => 'form-control select2', 'data-placeholder' => 'Select Ingredients', 'placeholder' => 'Select Ingredients', 'multiple' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

    </div>
    <?php $__errorArgs = ['ingredients'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback d-block" role="alert">
            <strong><?php echo e($message); ?></strong>
        </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="row">
    
    <div class="col-4">
        <?php echo Form::label('ingredient_category', 'Select Category'); ?>

    </div>
    <div class="col-4">
        <?php echo Form::label('brand', 'Select Brand'); ?>

    </div>
    <div class="col-3">
        <?php echo Form::label('brand', 'Products'); ?>

    </div>
</div>

<div class="ingredients-container">

    <?php if(!$item || empty($selectedBrandsCates)): ?>
        <div class="row">
            <div class="col-4 category">
                <div class="form-group">
                    <div class="input-group">
                        <?php echo Form::select('ingredient_category[cate][]', $category, null, ['class' => 'form-control custom-select2', 'placeholder' => 'Select Category', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                    </div>
                    <?php $__errorArgs = ['ingredient_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-4 brands">
                <div class="form-group">
                    <div class="input-group">
                        <?php echo Form::select('ingredient_category[brand][]', $remy_brands, null, ['class' => 'form-control custom-select2 parent-brand', 'placeholder' => 'Select Brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                    </div>
                </div>
            </div>
            <div class="col-3 brands">
                <div class="form-group">
                    <div class="input-group">
                        <?php echo Form::select('ingredient_category[child_brand][]', $products, null, ['class' => 'form-control custom-select2 child-brand', 'placeholder' => 'Select Product', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                    </div>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <a href="javascript:void(0)" class="btn btn-danger add-ingredient">+</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php
            $brandsIndex = 0;
        ?>
        

        <?php $__currentLoopData = $selectedBrandsCates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $selectedBrandsCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <?php if(isset($selectedBrandsCate[0])): ?>
                    <div class="col-4 category">
                        <div class="form-group">
                            <div class="input-group">
                                <?php echo Form::select('ingredient_category[cate][]', $category, $selectedBrandsCate[0]->id, ['class' => 'form-control custom-select2', 'placeholder' => 'Select Category', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                            </div>
                            <?php $__errorArgs = ['ingredient_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-4 category">
                        <div class="form-group">
                            <div class="input-group">
                                <?php echo Form::select('ingredient_category[cate][]', $category, null, ['class' => 'form-control custom-select2', 'placeholder' => 'Select Category', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                            </div>
                            <?php $__errorArgs = ['ingredient_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($selectedBrandsCate[1])): ?>
                    <div class="col-4 brands">
                        <div class="form-group">
                            <div class="input-group">
                                <?php echo Form::select('ingredient_category[brand][]', $item->drink_id == 42 ? $brands : $remy_brands, $selectedBrandsCate[1]->id, ['class' => 'form-control custom-select2 parent-brand', 'placeholder' => 'Select Brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-4 brands">
                        <div class="form-group">
                            <div class="input-group">
                                <?php echo Form::select('ingredient_category[brand][]', $item->drink_id == 42 ? $brands : $remy_brands, null, ['class' => 'form-control custom-select2 parent-brand', 'placeholder' => 'Select Brand', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>                
                <?php if(isset($selectedBrandsCate[2]) || isset($selectedBrandsCate[1])): ?>
                    <div class="col-3 brands">
                        <div class="form-group">
                            <div class="input-group">                                
                                <?php if($selectedBrandsCate[1]): ?>
                                    <select name="ingredient_category[child_brand][]" class="form-control custom-select2 child-brand"
                                            placeholder="Select Product"
                                            <?php echo e(request()->has('analytics') && request()->get('analytics') ? 'disabled' : null); ?>>
                                        <option value="">Select Product</option>                                    
                                        <?php if($selectedBrandsCate[1]->children): ?>
                                            <?php $__currentLoopData = $selectedBrandsCate[1]->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($child->id); ?>" <?php if($selectedBrandsCate[2] && $selectedBrandsCate[2]->id == $child->id): ?> selected <?php endif; ?>> <?php echo e($child->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                                                    
                                        <?php endif; ?>
                                    </select>
                                <?php else: ?>                                     
                                    <?php echo Form::select('ingredient_category[child_brand][]', $products, $selectedBrandsCate[2]->id, ['class' => 'form-control custom-select2 child-brand', 'placeholder' => 'Select Product', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>                                    
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-3 brands">
                        <div class="form-group">
                            <div class="input-group">
                                <?php echo Form::select('ingredient_category[child_brand][]', $products, null, ['class' => 'form-control custom-select2 child-brand', 'placeholder' => 'Select Product', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-1">
                    <div class="form-group">
                        <a href="javascript:void(0)"
                           class="btn <?php echo e($index == 0 ? 'btn-danger add-ingredient' : 'btn-secondary remove-ingredient'); ?>">
                            <?php echo e($index == 0 ? '+' : '-'); ?>

                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <?php endif; ?>
</div>

<div class="form-group">
    <?php echo Form::label('Upload Media'); ?>

    <?php echo Form::hidden('media_type', 'image'); ?>

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
            <?php echo Form::label('upload-image', 'Upload Image'); ?>

            <?php echo Form::file('images[]', ['class' => 'form-control', 'id' => 'upload-image', 'multiple' => true, 'accept' => 'image/*', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

        </div>
        <div id="media2" class="tab-pane mt-2 fade">
            <?php echo Form::label('upload-video', 'Upload Video'); ?>

            <?php echo Form::file('video', ['class' => 'form-control', 'id' => 'upload-video', 'accept' => 'video/*', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

        </div>
    </div>


    <div class="container">
        <table class="table" id="price-repeater">
            <thead>
                <tr>
                    <th>Quantity
                        <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </th>
                    <th>Price
                        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </th>
                    <th style="width:1%"></th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($item) && isset($item->price) && !empty($item->price)): ?>
                    <?php
                        $prices = json_decode($item->price);
                    ?>
                    <?php $__currentLoopData = $prices->price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php echo Form::text('price[quantity][]', $prices->quantity[$index], ['class' => 'form-control', 'placeholder' => 'Enter Quantity', 'required' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php echo Form::text('price[price][]', $prices->price[$index], ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($index == 0): ?>
                                    <a href="javascript:void(0)" class="btn btn-success" id="add-price">+</a>
                                <?php else: ?>
                                    <a href="javascript:void(0)" class="btn btn-secondary remove-price">-</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <?php echo Form::text('price[quantity][]', null, ['class' => 'form-control', 'placeholder' => 'Enter Quantity', 'required' => true, 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <?php echo Form::text('price[price][]', null, ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-success" id="add-price">+</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php $__env->startSection('scripts'); ?>
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
                    url: `<?php echo route('term.getchildren'); ?>?id=${e.target.value}`,
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

        const liquorBrands = JSON.parse('<?php echo json_encode($remy_brands); ?>');        
        const allBrands = JSON.parse('<?php echo str_replace("'", "\'", json_encode($brands)); ?>'); 
        
        $("select#drink").change((e) => {                        
            let options = '<option>Select Brand</option>';
            if(e.target.value == 42) { // Liquor brands
                Object.keys(allBrands).map((key) => {
                    options += '<option value="'+key+'">'+allBrands[key]+'</option>';
                });
            } else {
                Object.keys(liquorBrands).map((key) => {
                    options += '<option value="'+key+'">'+liquorBrands[key]+'</option>';
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
        //     url: "<?php echo e(route('get.items.category')); ?>",
        //     data: {
        //       bar_id: bar_id
        //     },
        //     success: function(res) {
        //       $('#cate-and-in').html(res.data);
        //     }
        //   });
        // }
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/items/form-fields.blade.php ENDPATH**/ ?>