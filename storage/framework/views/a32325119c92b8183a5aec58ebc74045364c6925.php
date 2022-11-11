<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php echo Form::model($region, $formAttributes); ?>

                            <div class="form-group">
                                <?php echo Form::label('title', 'Title'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('title', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Add Title', 'id' => 'title']); ?>

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
                                <?php echo Form::label('country', 'Country'); ?>

                                <div class="input-group">
                                    <?php if(isset($region)): ?>
                                        <?php echo Form::select('country[]', $countries, json_decode($region->country, true), ['class' => 'form-control select2', 'required' => true, 'id' => 'country', 'multiple' => true]); ?>

                                    <?php else: ?>
                                        <?php echo Form::select('country[]', $countries, null, ['class' => 'form-control select2', 'required' => true, 'id' => 'country', 'multiple' => true]); ?>

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

                        <div class="card-footer">
                            <div class="row mb-2 justify-content-between">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php if($region): ?>
                                            <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                                        <?php else: ?>
                                            <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php if(isset($region)): ?>
                                        <p class="float-right">
                                            <?php echo e(\Carbon\Carbon::parse($region->created_at)->format('F d, Y')); ?></p>
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/region/form.blade.php ENDPATH**/ ?>