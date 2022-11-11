<?php $__env->startSection('content'); ?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('public/images/logo.png')); ?>" alt="logo" class="login-form-logo">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <?php echo Form::open(['url' => route('password.email'), 'method' => "POST"]); ?>        
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
          <div class="row">
            <div class="col-12">
                <?php echo Form::submit('Request New Password', ['class' => 'btn btn-primary btn-block']); ?>              
            </div>
            <!-- /.col -->
          </div>
        <?php echo Form::close(); ?>

  
        <p class="mt-3 mb-1">
          <a href="<?php echo e(route('login')); ?>">Login</a>
        </p>
        
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>