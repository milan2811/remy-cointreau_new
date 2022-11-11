<?php $__env->startSection('content'); ?>
    <?php
    $role = roles();
    ?>
    <div class="content">
        <div class="container-fluid">
            

            <div class="row">
                <div class="col-12">
                    <?php echo Form::model($bar, $formAttributes); ?>

                    <div class="card">
                        <div class="card-body">
                            <?php if(auth()->user()->role_id >= $role['Account Admin']): ?>
                                <?php echo Form::hidden('user_id', auth()->user()->id); ?>

                            <?php else: ?>
                                <div class="form-group">
                                    <?php echo Form::label('user_id', 'Select Owner'); ?>

                                    <div class="input-group">
                                        <?php echo Form::select('user_id', $users, $bar ? $bar->user_id : null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Account Admin', 'id' => 'user_id', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                    </div>
                                    <?php $__errorArgs = ['user_id'];
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
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('name', 'Bar Name'); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('name', null, ['class' => 'form-control', 'autofocus' => true, 'required' => true, 'id' => 'name', 'placeholder' => 'Enter Bar Name', 'autocomplete' => 'new-name', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

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
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('slug', 'Slug'); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('slug', null, ['class' => 'form-control', 'required' => true, 'id' => 'slug', 'placeholder' => 'Enter Bar slug', 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                        </div>
                                        <?php $__errorArgs = ['slug'];
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
                            </div>
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('logo', 'Logo'); ?>

                                        <div class="input-group">
                                            <?php echo Form::file('logo', ['class' => 'form-control', 'id' => 'logo', 'accept' => 'image/*', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                        </div>
                                        <?php $__errorArgs = ['logo'];
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('background_color', 'Background Color'); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('background_color', null, ['class' => 'form-control', 'id' => 'background_color', 'placeholder' => 'Choose the Background Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

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
                                </div>
                            </div>

                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('fonts', 'Fonts'); ?>

                                        <div class="input-group">
                                            
                                            <?php                                                                 
                                                $fonts->prepend("Default");
                                            ?>
                                            <?php echo Form::select('fonts', $fonts, $bar ? $bar->fonts : 'Select Font Style', ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Bar fonts', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                        </div>
                                        <?php $__errorArgs = ['fonts'];
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('font_size', 'Font Size'); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('font_size', $bar ? $bar->font_size : 12, ['class' => 'form-control', 'id' => 'font_size', 'placeholder' => 'Choose the Font Size', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                        </div>
                                        <?php $__errorArgs = ['font_size'];
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
                            </div>
                            <div class="row mb-2 justify-content-between">     
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('font_color', 'Font Color'); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('font_color', $bar ? $bar->font_color : '#fefefe', ['class' => 'form-control', 'id' => 'font_color', 'placeholder' => 'Choose the Font Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                        </div>
                                        <?php $__errorArgs = ['font_color'];
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

                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('type', 'Type'); ?>

                                        <div class="input-group">
                                            <?php echo Form::select('type', ['Bar' => 'Bar', 'Restaurant' => 'Restaurant'], $bar ? $bar->type : null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Type', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                        </div>
                                        <?php $__errorArgs = ['type'];
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
                                
                            </div>
                            <div class="row mb-2 justify-content-between">
                                <div class="col-12">
                                    <div class="form-group">
                                        <?php echo Form::label('description', 'Description'); ?>

                                        <div class="input-group">
                                            <?php echo Form::textarea('description', null, ['class' => 'form-control textarea', 'id' => 'description', 'placeholder' => 'Enter the Description here...', 'rows' => '5', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

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
                                </div>                                
                            </div>
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('country', 'Country'); ?>

                                        <div class="input-group">
                                            

                                            <?php if(isset($bar)): ?>
                                                <?php echo Form::select('country', $countries, json_decode($bar->country, true), ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Country', 'id' => 'country', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                            <?php else: ?>
                                                <?php echo Form::select('country', $countries, null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Country', 'id' => 'country', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                            <?php endif; ?>

                                        </div>
                                        <?php $__errorArgs = ['country'];
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo Form::label('', 'City'); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'required' => true, 'placeholder' => 'Enter City', 'autocomplete' => 'new-city', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                        </div>
                                        <?php $__errorArgs = ['city'];
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

                                
                                
                                <div class="col-12 item-color-settings">
                                    <h4>Color Settings</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo Form::label('heading_color', 'Heading Color'); ?>

                                                <div class="input-group">
                                                    <?php echo Form::text('settings[color][heading]', (isset($bar) && $bar ? null : '#092D4D'), ['class' => 'form-control', 'id' => 'heading_color', 'placeholder' => 'Choose the Heading Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                                </div>
                                                <?php $__errorArgs = ['settings.color.heading'];
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo Form::label('item_name_color', 'Item Name Color'); ?>

                                                <div class="input-group">                                                    
                                                    <?php echo Form::text('settings[color][item_name]', (isset($bar) && $bar ? null : '#5B6772'), ['class' => 'form-control', 'id' => 'item_name_color', 'placeholder' => 'Choose the Item Name Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                                </div>
                                                <?php $__errorArgs = ['settings.color.item_name'];
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo Form::label('item_price_color', 'Item Price Color'); ?>

                                                <div class="input-group">
                                                    <?php echo Form::text('settings[color][item_price]', (isset($bar) && $bar ? null : '#092D4D'), ['class' => 'form-control', 'id' => 'item_price_color', 'placeholder' => 'Choose the Item Price Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                                </div>
                                                <?php $__errorArgs = ['settings.color.item_price'];
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo Form::label('highlight_color', 'Highlight Color'); ?>

                                                <div class="input-group">
                                                    <?php echo Form::text('settings[color][highlight]', (isset($bar) && $bar ? null : '#FA4616'), ['class' => 'form-control', 'id' => 'highlight_color', 'placeholder' => 'Choose the Highlight Color', 'required' => true, 'autocomplete' => 'off', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                                </div>
                                                <?php $__errorArgs = ['settings.color.highlight'];
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
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <?php if(auth()->user()->role_id < $role['Account Admin']): ?>
                                            <?php echo Form::label('status', 'Status'); ?>

                                            <div class="input-group mb-3">
                                                <?php echo Form::select('status', ['Not Approved', 'Approved'], $bar ? $bar->status == 1 : null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Bar Status', 'disabled' => request()->has('analytics') && request()->get('analytics')]); ?>

                                            </div>
                                            <?php $__errorArgs = ['status'];
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
                                        <?php endif; ?>
                                        <?php if($bar && $bar->status == 1): ?>
                                            <div class="row align-items-center">
                                                <div class="col-12 col-md-3">
                                                    <?php echo QrCode::size(200)->generate(config('app.url') . '/' . $bar->slug); ?>

                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <a href="<?php echo e(route('bar.show', $bar->slug)); ?>" class="mx-2">
                                                        <?php echo e(route('bar.show', $bar->slug)); ?>

                                                    </a>
                                                    <br>
                                                    <a href="<?php echo e(route('download-qr-code', $bar->slug)); ?>" class="btn btn-dark ml-2">Download QR
                                                        Code</a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php if(!request()->has('analytics')): ?>
                                            <?php if($bar): ?>
                                                <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                                            <?php else: ?>
                                                <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php if(isset($bar)): ?>
                                        <p class="float-right"><?php echo e(\Carbon\Carbon::parse($bar->created_at)->format('F d, Y')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function() {
            $('#background_color').colorpicker();
            $('#font_color').colorpicker();
            $('#item_price_color').colorpicker();
            $('#item_name_color').colorpicker();
            $('#highlight_color').colorpicker();
            $('#heading_color').colorpicker();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/bar/bars-form.blade.php ENDPATH**/ ?>