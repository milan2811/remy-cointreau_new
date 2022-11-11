<?php $__env->startSection('content'); ?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('public/images/logo.png')); ?>" alt="logo">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <?php echo Form::open(['url' => route('password.update'), 'method' => "POST"]); ?>        
        <?php echo Form::hidden('token', $token); ?>

          <div class="input-group mb-3">
            <?php echo Form::email('email', null, ['class' => 'form-control', "required" => true, "autofocus" => true, "placeholder" => "Email"]); ?>            
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
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

          <div class="input-group mb-3">
            <?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => "New Password"]); ?>            
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <?php $__errorArgs = ['password'];
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

          <div class="input-group mb-3">
            <?php echo Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => "New Password"]); ?>            
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <?php $__errorArgs = ['password_confirmation'];
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
            <div class="col-12">
                <?php echo Form::submit('Reset Password', ['class' => 'btn btn-primary btn-block']); ?>              
            </div>
            <!-- /.col -->
          </div>
        <?php echo Form::close(); ?>

  
        <p class="mt-3 mb-1">
          <a href="<?php echo e(route('login')); ?>">Login</a>
        </p>
        <p class="mb-0">
          <a href="<?php echo e(route('register')); ?>" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>