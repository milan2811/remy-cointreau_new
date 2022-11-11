<?php echo Form::hidden('type', strtolower($title)); ?>

<div class="form-group">
    <?php echo Form::label('term-name', 'Name'); ?>

    <div class="input-group">
        <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Add ' . ucwords($title) . ' Name', 'id' => 'name', 'disabled' => request()->has('analytics')]); ?>

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
        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description here...', 'disabled' => request()->has('analytics')]); ?>

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
<?php if($title == 'drink'): ?>
<div class="form-group">
    <?php echo Form::label('background_color', "Background Color"); ?>

    <div class="input-group">
        <?php
            $colors = ['orange' => 'Orange', 'sky-blue' =>'Sky blue', 'green' => 'Green', 'pink' => 'Pink'];
        ?>
        <?php echo Form::text('background_color', null, ['class' => 'form-control select2', 'id' => 'background_color', "placeholder" => "Select Background Color"]); ?>

    </div>
    <?php $__errorArgs = ['background_color'];
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
<?php endif; ?>

<?php if($title != 'ingredients' && $title != 'products' && $title != "brands" && $title != 'category'): ?>
    <div class="form-group">
        <?php echo Form::label('picture', 'Picture'); ?>

        <div class="input-group">
            <?php echo Form::file('picture', ['class' => 'form-control', 'id' => 'picture', 'accept' => 'image/*', 'disabled' => request()->has('analytics')]); ?>

        </div>
        <?php if(isset($term)): ?>
            <?php
                $picture = $term->picture ? asset('/public/images/terms/picture/' . $term->picture) : asset('/public/images/placeholder.png');
            ?>
            <img src='<?php echo e($picture); ?>' width="150" />
        <?php endif; ?>
        <?php $__errorArgs = ['picture'];
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
<?php endif; ?>

<?php if($title == 'brands'): ?>
    <div class="form-group">
        <?php echo Form::label('parent', 'Select Parent'); ?>

        <div class="input-group">
            <?php echo Form::select('parent', $parents, isset($term) && !empty($term) ? $term->parent : null, ['class' => 'form-control select2', 'placeholder' => '-- No Parent', 'disabled' => request()->has('analytics')]); ?>

        </div>
        <?php $__errorArgs = ['parent'];
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
<?php endif; ?>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/terms/form-fields.blade.php ENDPATH**/ ?>