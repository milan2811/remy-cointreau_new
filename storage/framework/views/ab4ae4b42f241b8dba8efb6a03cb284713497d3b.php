<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php echo Form::open($formAttributes); ?>

          <div class="card">
            <div class="card-body">
              <?php
                $user = auth()->user();
              ?>
              <?php echo Form::hidden('username', $user->name); ?>

              <?php echo Form::hidden('email', $user->email); ?>

              <?php echo Form::hidden('bar_id', $_REQUEST['bar']); ?>


              <div class="form-group">
                <?php echo Form::label('request_for', 'Request For'); ?>

                <div class="input-group">
                  <?php echo Form::select('request_for', ['brand' => 'Brand', 'ingredients' => 'Ingredients', 'category' => 'Category', 'item' => 'Item'], null, ['class' => 'form-control select2', 'id' => 'request_for', 'data-placeholder' => 'please Select ', 'required' => true]); ?>

                </div>
                <?php $__errorArgs = ['request_for'];
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
                <?php echo Form::label('subject', 'Subject'); ?>

                <div class="input-group">
                  <?php echo Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject', 'placeholder' => 'Enter Subject here']); ?>

                </div>
                <?php $__errorArgs = ['subject'];
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
                <?php echo Form::label('message', 'Message'); ?>

                <div class="input-group">
                  <?php echo Form::textarea('message', null, ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Enter your messsage here']); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/requests/item-form.blade.php ENDPATH**/ ?>