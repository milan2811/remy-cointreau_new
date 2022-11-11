<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      

      <div class="row">
        <div class="col-12">
          <?php echo Form::model($bar, $formAttributes); ?>

          <div class="card">
            <div class="card-body">
              <?php if(isset($bar->user_id)): ?>
                <?php echo Form::hidden('user_id', $bar->user_id); ?>

              <?php elseif(auth()->user()->role_id == 3): ?>
                <?php echo Form::hidden('user_id', auth()->user()->id); ?>

              <?php else: ?>
                <div class="form-group">
                  <?php echo Form::label('user_id', 'Select Owner'); ?>

                  <div class="input-group">
                    <?php echo Form::select('user_id', $users, $bar ? $bar->user_id : null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Select Bar Owner', 'id' => 'user_id']); ?>

                  </div>
                  <?php $__errorArgs = ['user_id'];
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
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('name', 'Bar Name'); ?>

                    <div class="input-group">
                      <?php echo Form::text('name', null, ['class' => 'form-control', 'autofocus' => true, 'required' => true, 'id' => 'name', 'placeholder' => 'Enter Bar Name', 'autocomplete' => 'new-name']); ?>

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
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('slug', 'Slug'); ?>

                    <div class="input-group">
                      <?php echo Form::text('slug', null, ['class' => 'form-control', 'required' => true, 'id' => 'slug', 'placeholder' => 'Enter Bar slug', 'autocomplete' => 'off']); ?>

                    </div>
                    <?php $__errorArgs = ['slug'];
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
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('logo', 'Logo'); ?>

                    <div class="input-group">
                      <?php echo Form::file('logo', ['class' => 'form-control', 'id' => 'logo', 'accept' => 'image/*']); ?>

                    </div>
                    <?php $__errorArgs = ['logo'];
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
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('background_color', 'Background Color'); ?>

                    <div class="input-group">
                      <?php echo Form::text('background_color', null, ['class' => 'form-control', 'id' => 'background_color', 'placeholder' => 'Choose the Background Color', 'required' => true, 'autocomplete' => 'off']); ?>

                    </div>
                    <?php $__errorArgs = ['background_color'];
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

              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('fonts', 'Fonts'); ?>

                    <div class="input-group">
                      <?php echo Form::select('fonts', ['Font Awesome 5 Free' => 'Font Awesome 5 Free', 'Verdana' => 'Verdana', 'Circular-Loom' => 'Circular-Loom', 'cursive' => 'cursive', 'sans-serif' => 'sans-serif', 'ui-monospace' => 'ui-monospace'], $bar ? $bar->fonts : 'Font Awesome 5 Free', ['class' => 'form-control', 'required', 'placeholder' => 'Select Bar fonts']); ?>

                    </div>
                    <?php $__errorArgs = ['fonts'];
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
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('font_size', 'Font Size'); ?>

                    <div class="input-group">
                      <?php echo Form::text('font_size', $bar ? $bar->font_size : 12, ['class' => 'form-control', 'id' => 'font_size', 'placeholder' => 'Choose the Font Size', 'required' => true, 'autocomplete' => 'off']); ?>

                    </div>
                    <?php $__errorArgs = ['font_size'];
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
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('font_color', 'Font Color'); ?>

                    <div class="input-group">
                      <?php echo Form::text('font_color', $bar ? $bar->font_color : '#fefefe', ['class' => 'form-control', 'id' => 'font_color', 'placeholder' => 'Choose the Font Color', 'required' => true, 'autocomplete' => 'off']); ?>

                    </div>
                    <?php $__errorArgs = ['font_color'];
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
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('location', 'Location (lat, long)'); ?>

                    <div class="input-group">
                      <?php echo Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Enter coordinates here', 'autocomplete' => 'nope']); ?>

                    </div>
                    <?php $__errorArgs = ['location'];
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
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('description', 'Description'); ?>

                    <div class="input-group">
                      <?php echo Form::textarea('description', null, ['class' => 'form-control textarea', 'id' => 'description', 'placeholder' => 'Enter the Description here...', 'rows' => '5']); ?>

                    </div>
                    <?php $__errorArgs = ['description'];
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
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('images', 'Images'); ?>

                    <div class="input-group">
                      <?php echo Form::file('images[]', ['class' => 'form-control', 'multiple' => true, 'accept' => 'image/*', 'id' => 'images']); ?>

                    </div>
                    <?php $__errorArgs = ['images'];
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
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('country', 'Country'); ?>

                    <div class="input-group">
                      <?php echo Form::text('country', null, ['class' => 'form-control', 'id' => 'country', 'required' => true, 'placeholder' => 'Enter Country', 'autocomplete' => 'new-country']); ?>

                    </div>
                    <?php $__errorArgs = ['country'];
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
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('', 'City'); ?>

                    <div class="input-group">
                      <?php echo Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'required' => true, 'placeholder' => 'Enter City', 'autocomplete' => 'new-city']); ?>

                    </div>
                    <?php $__errorArgs = ['city'];
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

                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('show-brand', 'Show Brand'); ?>

                    <div class="input-group">
                      <?php echo Form::select('show_brand', ['No', 'Yes'], $bar ? $bar->show_brand == 1 : null, ['class' => 'form-control select2', 'required', 'placeholder' => 'Select Brand Visibility', 'id' => 'show-brand']); ?>

                    </div>
                    <?php $__errorArgs = ['show_brand'];
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

                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('type', 'Type'); ?>

                    <div class="input-group">
                      <?php echo Form::select('type', ['Bar' => 'Bar', 'Restaurant' => 'Restaurant'], $bar ? $bar->type : null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Type']); ?>

                    </div>
                    <?php $__errorArgs = ['type'];
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
                <?php if(auth()->user()->role_id <= 2): ?>
                  <div class="col-12">
                    <div class="form-group">
                      <?php echo Form::label('status', 'Status'); ?>

                      <div class="input-group">
                        <?php echo Form::select('status', ['Not Approved', 'Approved'], $bar ? $bar->status == 1 : null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Bar Status']); ?>

                      </div>
                      <?php $__errorArgs = ['status'];
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
                <?php endif; ?>
              </div>
            </div>
            <div class="card-footer">
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php if($bar): ?>
                      <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                    <?php else: ?>
                      <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-6">
                  <?php if(isset($bar)): ?>
                   <p class="float-right"><?php echo e(\Carbon\Carbon::parse($bar->created_at)->format('F d, Y')); ?></p>
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

<?php $__env->startSection('scripts'); ?>

  <script>
    $(function() {
      $('#background_color').colorpicker();
      $('#font_color').colorpicker();
    });
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/bar/bars-form.blade.php ENDPATH**/ ?>