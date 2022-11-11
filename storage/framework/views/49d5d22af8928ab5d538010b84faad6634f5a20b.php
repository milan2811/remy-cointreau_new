<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <?php echo Form::model($term, $formAttributes); ?>


              <?php echo Form::hidden('type', strtolower($title)); ?>

              <div class="form-group">
                <?php echo Form::label('term-name', 'Name'); ?>

                <div class="input-group">
                  <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Add ' . ucwords($title) . ' Name', 'id' => 'name']); ?>

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
              <?php if(!isset($term)): ?>
                <div class="form-group">
                  <?php echo Form::label('term-slug', 'Slug'); ?>

                  <div class="input-group">
                    <?php echo Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'Add ' . ucwords($title) . ' Slug', 'required' => true]); ?>

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
              <?php endif; ?>
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
                <?php echo Form::label('picture', 'Picture'); ?>

                <div class="input-group">
                  <?php echo Form::file('picture', ['class' => 'form-control', 'id' => 'picture', 'accept' => 'image/*']); ?>

                </div>
                <?php if(isset($term)): ?>
                  <?php
                    $picture = $term->picture ? asset('/public/images/terms/picture/' . $term->picture) : asset('/public/images/placeholder.png');
                  ?>
                  <img src='<?php echo e($picture); ?>' />
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
            </div>

            <div class="card-footer">
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php if($term): ?>
                      <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                    <?php else: ?>
                      <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-6">
                  <?php if(isset($term)): ?>
                   <p class="float-right"><?php echo e(\Carbon\Carbon::parse($term->created_at)->format('F d, Y')); ?></p>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/terms/terms-form.blade.php ENDPATH**/ ?>