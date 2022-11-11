<?php $__env->startSection('content'); ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php echo Form::model($item, $formAttributes); ?>

                        <div class="card-body">

                            <?php echo $__env->make('items.form-fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <div class="card-footer">
                                <div class="row mb-2 justify-content-between">
                                    <div class="col-6">
                                        <?php if(!request()->has('analytics')): ?>
                                            <div class="form-group">
                                                <?php if($item): ?>
                                                    <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                                                <?php else: ?>
                                                    <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <?php if(isset($item)): ?>
                                            <p class="float-right"><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('F d, Y')); ?></p>
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/items/items-form.blade.php ENDPATH**/ ?>