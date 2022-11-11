<?php $__env->startSection('content'); ?>
<div class="login-box">
    <div class="login-logo">
      <a href="<?php echo e(route('home')); ?>">
        <img src="<?php echo e(asset('public/images/logo_round.svg')); ?>" alt="logo" class="login-form-logo">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        
        <?php echo Form::open(['url' => route('register'), "method" => "POST"]); ?>


            <p class="login-box-msg">Sign up to start your session</p>
            <?php
                $fields = request()->all();
                unset($fields["_token"],$fields["name"], $fields["email"], $fields["password"], $fields["password_confirmation"], $fields["phone"]);            
            ?>
            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo Form::hidden($key, $field); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="input-group mb-3">                                
                <?php echo Form::text("name", old('name') ? old('name') : request()->get('name'), ['class' => 'form-control', "placeholder" => "Name", "required" => true, 'autofocus' => true, "autocomplete" => 'name']); ?>                                    
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
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
            <div class="input-group mb-3">
                <?php echo Form::email("email", old('email') ? old('email') : request()->get('email'), ['class' => 'form-control', "placeholder" => "Email", "required" => true, "autocomplete" => 'email']); ?>

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
                <?php echo Form::password('password', ['class' => 'form-control', "autocomplete"=>"new-password", "required" => true, "placeholder" => "Password"]); ?>                                
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
                <?php echo Form::password('password_confirmation', ['class' => 'form-control', "autocomplete"=>"new-password", "required" => true, "placeholder" => "Confirm Password"]); ?>                            
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

            <div class="input-group mb-3">                                                
                <?php echo Form::text('phone', old('phone') ? old('phone') : request()->get('phone'), ['class' => 'form-control', 'required' => true, "autocomplete" => "phone", 'placeholder' => "Contact No."]); ?>                
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
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

          <div class="form-group">
              <?php echo Form::submit("Sign up", ["class" => "btn btn-primary btn-block"]); ?>

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

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/auth/register.blade.php ENDPATH**/ ?>