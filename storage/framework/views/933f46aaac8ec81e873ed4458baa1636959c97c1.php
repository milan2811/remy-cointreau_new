<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php echo Form::open(['url' => route('users.update', $user->id), 'method' => "PUT"]); ?>

          <?php echo Form::hidden('password', $user->update_password); ?>

          <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <?php echo Form::label('verify-otp', 'OTP (One Time Password)'); ?>

                    <div class="input-group">
                    <?php echo Form::password('verify_otp', ['class' => 'form-control', 'id' => 'verify-otp', 'placeholder' => 'Enter OTP sent to your mail', ]); ?>

                    </div>
                    <?php $__errorArgs = ['verify_otp'];
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
              <div class="form-group">                
                <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>                
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/users/verify.blade.php ENDPATH**/ ?>