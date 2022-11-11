<?php $__env->startSection('content'); ?>
    <!--/ default-banner section Start-->
    <?php if(isset($content['banner']) && isset($content['banner']->title) && $content['banner']->title): ?>
      <div class="default-banner-section">
        <div class="wrap">
          <div class="default-banner-row">
            <h1><?php echo e($content['banner']->title); ?></h1>
          </div>
        </div>
      </div>        
    <?php endif; ?>
    <!--/ default-banner section End-->

    <!--/ contact section start-->
    <div class="contact-section">
      <?php if(isset($content['banner']) && isset($content['banner']->heading) || isset($content['banner']->description)): ?>
      <div class="contact-title">
        <?php if($content['banner']->heading): ?>
        <h3><?php echo e($content['banner']->heading); ?></h3>            
        <?php endif; ?>
        <?php if($content['banner']->description): ?>
          <p><?php echo e($content['banner']->description); ?></p>
        <?php endif; ?>
      </div>         
      <?php endif; ?>
        <?php echo Form::open($formAttributes); ?>

        <div class="form-block">
          <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
              <span><?php echo e(session()->get('success')); ?></span>
            </div>                          
          <?php endif; ?>
          <?php if(session()->get('error')): ?>
            <div class="alert alert-danger">
              <span><?php echo e(session()->get('error')); ?></span>
            </div>                          
          <?php endif; ?>
          <div class="details-block">
            <div class="cols cols3">
              <div class="col">
                <div class="form-group">
                  <?php echo Form::label('name', 'Nombre'); ?>

                  <?php echo Form::text('name', null, ['class' => 'textbox', 'placeholder' => 'Tu nombre', 'id' => 'name', 'required' => true]); ?>

                  <i class="icon-user form-icon"></i>
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
              </div>
              <div class="col">
                <div class="form-group">
                  <?php echo Form::label('email', 'Correo electrónico'); ?>

                  <?php echo Form::email('email', null, ['class' => 'textbox', 'placeholder' => 'introduzca su nombre', 'id' => 'email', 'required' => true]); ?>                  
                  <i class="icon-mail form-icon"></i>
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
              </div>
              <div class="col">
                <div class="form-group">
                  <?php echo Form::label('phone', 'Número de teléfono'); ?>

                  <?php echo Form::text('phone', null, ['class' => 'textbox', 'placeholder' => 'Ingrese su número telefónico', 'id' => 'phone', 'required' => true]); ?>                  
                  <i class="icon-call form-icon"></i>
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
              </div>
              <div class="col">
                <div class="form-group">
                  <?php echo Form::label('bar_name', 'Nombre del restaurante'); ?>

                  <?php echo Form::text('bar_name', null, ['class' => 'textbox', 'placeholder' => 'ingrese el nombre del restaurante', 'id' => 'bar_name', 'required' => true]); ?>                    
                  <i class="icon-restaurant form-icon"></i>
                  <?php $__errorArgs = ['bar_name'];
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
              <div class="col">
                <div class="form-group">
                  <?php echo Form::label('bar_city', 'Nombre de la ciudad'); ?>

                  <?php echo Form::text('bar_city', null, ['class' => 'textbox', 'placeholder' => 'ingrese el nombre de la ciudad', 'id' => 'bar_city']); ?>                                   
                  <i class="icon-map form-icon"></i>
                  <?php $__errorArgs = ['bar_city'];
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
              <div class="col">
                <div class="form-group">
                  <?php echo Form::label('bar_country', 'Nombre del país'); ?>

                  <?php echo Form::text('bar_country', null, ['class' => 'textbox', 'placeholder' => 'ingrese el nombre del país', 'id' => 'bar_country']); ?>                   
                  <i class="icon-pin form-icon"></i>
                  <?php $__errorArgs = ['bar_country'];
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
          </div>
          <div class="form-group">
            <div class="details-block">
              <div class="cols cols1">
                <div class="col">
                  <?php echo Form::label('bar_address', 'Dirección'); ?>

                  <?php echo Form::text('bar_address', null, ['class' => 'textbox', 'placeholder' => 'Restaurante Dirección', 'id' => 'bar_address']); ?>                  
                  <i class="icon-location  form-icon"></i>
                  <?php $__errorArgs = ['bar_address'];
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
          </div>
          <div class="form-group">
            <div class="details-block">
              <div class="cols cols1">
                <div class="col">
                  <?php echo Form::label('message', 'Mensaje'); ?>

                  <?php echo Form::textarea('message', null, ['placeholder' => 'Escribe algo...', 'id' => 'message']); ?>                  
                  <?php $__errorArgs = ['message'];
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
          </div>
          <div class="form-group fbtn">
            <div class="form-button">
              <?php echo Form::submit('Enviar', ['class' => 'button']); ?>              
            </div>
          </div>
        </div>
      <?php echo Form::close(); ?>

    </div>
    <!--/ contact section start-->

    <?php if(isset($content['logos']) && sizeof($content['logos'])): ?> 
    <!--/ brands section Start-->
    <div class="brands-section">
        <div class="wrap">
            <div class="logo-boxes">
                <?php $__currentLoopData = $content['logos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="logo-box item">
                        <img src="<?php echo e($logo->image ? asset('public/images/uploads/'.$logo->image) : asset('public/home/images/brand-1.png')); ?>" alt="<?php echo e($logo->image); ?>">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
            </div>
        </div>
    </div>
    <!--/ brands section End-->
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', ['body_class' => 'contact-page'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/enquiry.blade.php ENDPATH**/ ?>