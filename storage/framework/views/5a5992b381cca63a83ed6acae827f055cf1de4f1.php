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
        
  
        
        <?php echo Form::open(['url' => route('login'), "method" => "POST"]); ?>


          <?php if($request->has('otp-verification')): ?>
            <p class="login-box-msg">Please enter the one time password send to your email</p>
              <?php echo Form::hidden('email', old('email')); ?>

              <?php echo Form::hidden('password', old('password')); ?>

              <?php echo Form::hidden('remember', old('remember')); ?>

              <div class="input-group mb-3">
                <?php echo Form::password('otp', ['class' => 'form-control', "placeholder" => "Enter OTP here"]); ?>

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                <?php $__errorArgs = ['otp'];
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
          <?php else: ?> 
            <p class="login-box-msg">Sign in to start your session</p>
            <div class="input-group mb-3">
              <?php echo Form::email("email", old('email'), ['class' => 'form-control', "placeholder" => "Email", "required" => true, 'autofocus' => true, "autocomplete" => 'email']); ?>

                          
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
              <?php echo Form::password('password', ['class' => 'form-control', "required" => true, "autocomplete" => 'current-password', "placeholder"=> "Password"]); ?>            
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

            <div class="form-group">
                <div class="icheck-primary">
                  <?php echo Form::checkbox('remember', old('remember'), false, ['class' => 'form-control', "id" => "remember"]); ?>                
                  <?php echo Form::label('remember', 'Remember Me'); ?>                
                </div>
            </div>
          <?php endif; ?>

          <div class="form-group">
              <?php echo Form::submit("Sign In", ["class" => "btn btn-primary btn-block"]); ?>

          </div>
          
        <?php echo Form::close(); ?>

  
        <?php if(Route::has('password.request')): ?>
        <p class="mb-1">
          <a href="<?php echo e(route('password.request')); ?>">I forgot my password</a>
        </p>
        <?php endif; ?>
        
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/auth/login.blade.php ENDPATH**/ ?>