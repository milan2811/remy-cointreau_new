<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php echo Form::model($bar, $formAttributes); ?>


          <div class="form-group">
            <?php echo Form::label('name', 'Name'); ?>

            <div class="input-group">
              <?php echo Form::text('name', null, ['class' => 'form-control', 'autofocus' => true, 'required' => true, 'id' => 'name', 'placeholder' => 'Enter Bar Name', 'autocomplete' => 'randomText']); ?>

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
            <?php echo Form::label('slug', 'Slug'); ?>

            <div class="input-group">
              <?php echo Form::text('slug', null, ['class' => 'form-control', 'required' => true, 'id' => 'slug', 'placeholder' => 'Enter Bar slug']); ?>

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

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <?php echo Form::label('logo', 'Logo'); ?>

                <div class="input-group">
                  <?php echo Form::file('logo', ['class' => 'form-control', 'id' => 'logo', 'accept' => 'image/*']); ?>

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
                  <?php echo Form::text('background_color', null, ['class' => 'form-control', 'id' => 'background_color', 'placeholder' => 'Choose the Background Color', 'required' => true]); ?>

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

          <div class="form-group">
            <?php echo Form::label('description', 'Description'); ?>

            <div class="input-group">
              <?php echo Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Enter the Description here...']); ?>

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
            <?php echo Form::label('user_id', 'Select Owner'); ?>

            <div class="input-group">
              <?php echo Form::select('user_id', $users, $bar ? $bar->user_id : null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Bar Owner', 'id' => 'user_id']); ?>

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

          <div class="form-group">
            <?php echo Form::label('images', 'Images'); ?>

            <div class="input-group">
              <?php echo Form::file('images[]', ['class' => 'form-control', 'multiple' => true, 'accept' => 'image/*', 'id' => 'images']); ?>

            </div>
            <?php $__errorArgs = ['images'];
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
            <?php echo Form::label('location', 'Location (lat, long)'); ?>

            <div class="input-group">
              <?php echo Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Enter coordinates here']); ?>

            </div>
            <?php $__errorArgs = ['location'];
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
            <?php echo Form::label('address', 'Address'); ?>

            <div class="input-group">
              <?php echo Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'required' => true, 'placeholder' => 'Enter Address']); ?>

            </div>
            <?php $__errorArgs = ['address'];
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
            <?php echo Form::label('city', 'City'); ?>

            <div class="input-group">
              <?php echo Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'required' => true, 'placeholder' => 'Enter City']); ?>

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
          <?php if(auth()->user()->role_id <= 2): ?>
            <div class="form-group">
              <?php echo Form::label('Status', 'Status'); ?>

              <div class="input-group">
                <?php echo Form::select('Status', ['Not Approved', 'Approved'], $bar ? $bar->status == 1 : null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Bar Status']); ?>

              </div>
              <?php $__errorArgs = ['Status'];
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
            <?php if($bar): ?>
              <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

            <?php else: ?>
              <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

            <?php endif; ?>
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
    });
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/bars-form.blade.php ENDPATH**/ ?>