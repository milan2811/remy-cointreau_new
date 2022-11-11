<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php echo Form::model($promotion, $formAttributes); ?>

                            <div class="form-group">
                                <?php echo Form::label('bar_id', 'Select Bar'); ?>

                                <div class="input-group">
                                    <?php echo Form::select('bar_id', $bars, $promotion ? $promotion->bar_id : null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Bar', 'id' => 'bar_id', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                </div>
                                <?php $__errorArgs = ['bar_id'];
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
                                <?php echo Form::label('title', 'Item'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('title', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Add Item', 'id' => 'title']); ?>

                                </div>
                                <?php $__errorArgs = ['title'];
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
                                <?php echo Form::label('promotion_for', 'Name of the promotion'); ?>

                                <div class="input-group">
                                    <?php echo Form::textarea('promotion_for', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter name of the promotion', 'id' => 'promotion_for']); ?>

                                </div>
                                <?php $__errorArgs = ['promotion_for'];
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
                                <?php echo Form::label('description', 'Short Description'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('short_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Short Description here...', 'maxlength' => 150]); ?>

                                </div>
                                <?php $__errorArgs = ['short_description'];
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
                                    <?php echo Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description here...']); ?>

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
                                <?php echo Form::label('link', 'URL'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Add URL', 'id' => 'link']); ?>

                                </div>
                                <?php $__errorArgs = ['link'];
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
                                <?php echo Form::label('image', 'Image'); ?>

                                <div class="input-group">
                                    <?php echo Form::file('image', ['class' => 'form-control', 'id' => 'image', 'accept' => 'image/*']); ?>

                                </div>
                                <?php if(isset($promotion)): ?>
                                    <img
                                         src='<?php echo e($promotion->image ? asset('/public/images/promotion/' . $promotion->image) : asset('/public/images/placeholder.png')); ?>' width="200" class="pt-2" />
                                <?php endif; ?>
                                <?php $__errorArgs = ['image'];
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
                                        <?php if(isset($promotion) && isset($promotion->price) && !empty($promotion->price)): ?>
                                            <?php
                                                $prices = json_decode($promotion->price);
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

                        <div class="card-footer">
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php if($promotion): ?>
                                            <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                                        <?php else: ?>
                                            <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php if(isset($promotion)): ?>
                                        <p class="float-right"><?php echo e(\Carbon\Carbon::parse($promotion->created_at)->format('F d, Y')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/promotion/form.blade.php ENDPATH**/ ?>