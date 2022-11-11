<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php echo Form::model(isset($requestItem) ? $requestItem->object : null, $formAttributes); ?>

          <div class="card">
            <div class="card-body">
              <?php if(!isset($requestItem) || !$requestItem): ?>
                <?php
                  $user = auth()->user();
                ?>
                <?php echo Form::hidden('username', $user->name); ?>

                <?php echo Form::hidden('email', $user->email); ?>

                <?php echo Form::hidden('bar_id', request()->get('bar')); ?>                  
              <?php endif; ?>
              
              <div class="form-group">
                <?php echo Form::label('request_for', 'Request For'); ?>

                <div class="input-group">
                  <?php echo Form::select('request_for', ['brands' => 'Liqueurs brand', 'ingredients' => 'Non-alcoholic ingredients', 'category' => 'Liqueurs category'], (isset($requestType) && !empty($requestType) ? $requestType : null), ['class' => 'form-control select2', 'id' => 'request_for', 'data-placeholder' => 'please Select ', 'required' => true, 'disabled' => request()->has('analytics')]); ?>

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

              

              <?php
                $title = $requestType ? $requestType : 'brands';
                $parents = \App\Models\Term::select("id", "name")->where('type', $title)->where('status', 1)->pluck("name", "id")->toArray();
              ?>
              <?php echo $__env->make('terms.form-fields', ['title' => $title, 'parents' => $parents], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>         
              
              <div class="form-group">
                <?php echo Form::label('message', 'Message'); ?>

                <div class="input-group">
                  <?php echo Form::textarea('message', (isset($requestItem) ? $requestItem->message : null), ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Enter your messsage here', 'disabled' => request()->has('analytics')]); ?>

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
                <?php if(isset($requestItem) && $requestItem->status !== null): ?> 
                  <?php if($requestItem->status == 1): ?>
                    <div class="text-success text-right">Approved</div>
                  <?php endif; ?>
                  <?php if($requestItem->status == 0): ?>
                    <div class="text-danger text-right">Rejected</div>
                  <?php endif; ?>
                <?php elseif(isset($requestItem) && $requestItem->object): ?>                
                  <?php echo Form::submit('Approve', ['class' => 'btn btn-success', 'name' => 'status']); ?>    
                  <?php echo Form::submit('Reject', ['class' => 'btn btn-success', 'name' => 'status']); ?>    
                <?php else: ?> 
                  <?php echo Form::submit('Submit', ['class' => 'btn btn-success']); ?>

                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
  <script>
    (function() {
      const currentPageUrl = "<?php echo e(route('request.create', ['bar' => request()->get('bar')])); ?>";
      $("#request_for").change((e) => {        
        window.location.href = currentPageUrl + "&request="+ e.target.value;
      });
    })();
  
  </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/requests/item-form.blade.php ENDPATH**/ ?>