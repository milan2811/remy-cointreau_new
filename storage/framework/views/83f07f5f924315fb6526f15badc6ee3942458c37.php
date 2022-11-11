<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-header','data' => ['logo' => 'true','backurl' => route('home')]]); ?>
<?php $component->withName('app-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['logo' => 'true','backurl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('home'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    

    <div id="main">
      <div id="primary" class="content-area one-column">
        <div id="content" class="site-content">
          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="section-title">
                    <h4>Enquiry Form</h4>
                  </div>
                  <?php echo Form::open($formAttributes); ?>

                  <div class="card">
                    <div class="card-body">                                          
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
                      <div class="form-group">
                        <?php echo Form::label('name', 'Nombre*'); ?>

                        <div class="input-group">
                          <?php echo Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required' => true]); ?>

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
                        <?php echo Form::label('email', 'Correo electrónico*'); ?>

                        <div class="input-group">
                          <?php echo Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required' => true]); ?>

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
                        <?php echo Form::label('phone', 'Teléfono*'); ?>

                        <div class="input-group">
                          <?php echo Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'required' => true]); ?>

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
                        <?php echo Form::label('bar-name', 'Nombre del restaurante*'); ?>

                        <div class="input-group">
                          <?php echo Form::text('bar_name', null, ['class' => 'form-control', 'id' => 'bar-name', 'required' => true]); ?>

                        </div>
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

                      <div class="form-group">                        
                        <?php echo Form::label('bar-address', 'Dirección del restaurante'); ?>

                        <div class="input-group">
                          <?php echo Form::text('bar_address', null, ['class' => 'form-control', 'id' => 'bar-address']); ?>

                        </div>
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

                      <div class="form-group">                        
                        <?php echo Form::label('bar-city', 'Nombre de la ciudad'); ?>

                        <div class="input-group">
                          <?php echo Form::text('bar_city', null, ['class' => 'form-control', 'id' => 'bar-city']); ?>

                        </div>
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
                      
                      <div class="form-group">                        
                        <?php echo Form::label('bar-country', 'Nombre del país'); ?>

                        <div class="input-group">
                          <?php echo Form::text('bar_country', null, ['class' => 'form-control', 'id' => 'bar-country']); ?>

                        </div>
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
                      
                      <div class="form-group">
                        <?php echo Form::label('message', 'Mensaje*'); ?>

                        <div class="input-group">
                          <?php echo Form::textarea('message', null, ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Enter your messsage here', 'required'=> true]); ?>                  
                        </div>
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
                    <div class="card-footer">
                      <div class="form-group">
                          <?php echo Form::submit('Submit', ['class' => 'btn btn-success']); ?>               
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
    </div>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/enquiry/enquiry-form.blade.php ENDPATH**/ ?>