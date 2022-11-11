<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php echo Form::model($user, $formAttributes); ?>

          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <?php echo Form::label('name', 'Name'); ?>

                <div class="input-group">
                  <?php echo Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter your name']); ?>

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
                <?php echo Form::label('email', 'Email'); ?>

                <div class="input-group">
                  <?php echo Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter your Email', 'disabled' => $user != null]); ?>

                </div>
                <?php $__errorArgs = ['email'];
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
                <?php echo Form::label('image', 'Profile Image'); ?>

                <div class="input-group">
                  <?php echo Form::file('image', ['class' => 'form-control', 'id' => 'image']); ?>

                </div>
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

              <div class="form-group">
                <?php echo Form::label('phone', 'Phone'); ?>

                <div class="input-group">
                  <?php echo Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Phone Number', 'id' => 'phone']); ?>

                </div>
                <?php $__errorArgs = ['phone'];
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
              <?php if(!isset($user) || auth()->user()->role_id == 1): ?>
                <div class="form-group">
                  <?php echo Form::label('role_id', 'Select Role'); ?>

                  <div class="input-group">
                    <?php echo Form::select('role_id', $roles, $user ? $user->role_id : null, ['class' => 'form-control', 'placeholder' => 'Select User Role']); ?>

                  </div>
                  <?php $__errorArgs = ['role_id'];
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
              <?php if(auth()->user()->id != ($user ? $user->id : false)): ?>
                <div class="form-group">
                  <?php echo Form::label('approved', 'Approved'); ?>

                  <div class="input-group">
                    <?php echo Form::select('approved', ['No', 'Yes'], $user ? $user->approved : null, ['class' => 'form-control', 'placeholder' => 'Select User Status']); ?>

                  </div>
                  <?php $__errorArgs = ['approved'];
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
            </div>
            <div class="card-footer">
              <div class="form-group">
                <?php if($user): ?>
                  <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                <?php else: ?>
                  <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                <?php endif; ?>

                <?php if(auth()->user()->id == ($user ? $user->id : false)): ?>
                  <a href="<?php echo e(route('users.update-password', $user->id)); ?>" class="btn btn-outline-success">Update Password</a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/users/user-form.blade.php ENDPATH**/ ?>