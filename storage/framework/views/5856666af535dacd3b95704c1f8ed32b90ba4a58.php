<?php $__env->startSection('content'); ?>
    <?php
    $role = roles();
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php echo Form::model($user, $formAttributes); ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <?php echo Form::label('name', 'Name'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter your name']); ?>

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
                                <?php echo Form::label('email', 'Email'); ?>

                                <div class="input-group">
                                    <?php echo Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter your Email', 'disabled' => $user != null]); ?>

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

                            <?php if(!$user): ?>
                                <div class="form-group">
                                    <?php echo Form::label('password', 'Password'); ?>

                                    <div class="input-group">
                                        <?php echo Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Enter your Password']); ?>

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
                                    <?php echo Form::label('password-confirm', 'Confirm Password'); ?>

                                    <div class="input-group">
                                        <?php echo Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => 'Confirm Password ']); ?>

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
                            <?php endif; ?>

                            <div class="form-group">
                                <?php echo Form::label('image', 'Profile Image'); ?>

                                <div class="input-group">
                                    <?php echo Form::file('image', ['class' => 'form-control', 'id' => 'image']); ?>

                                </div>
                                <?php $__errorArgs = ['image'];
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
                                <?php echo Form::label('phone', 'Phone'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Phone Number', 'id' => 'phone']); ?>

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
                            <?php if(!isset($user) || (auth()->user()->role_id <= $role['Account Admin'] && auth()->user()->id != $user->id)): ?>
                                <div class="form-group">
                                    <?php echo Form::label('role_id', 'Select Role'); ?>

                                    <div class="input-group">
                                        <?php echo Form::select('role_id', $roles, $user ? $user->role_id : null, ['class' => 'form-control', 'placeholder' => 'Select User Role', 'id' => 'role_id', 'required' => true]); ?>

                                    </div>
                                    <?php $__errorArgs = ['role_id'];
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
                                    <div
                                         class="regional <?php echo e(($user && $role['Regional Admin'] == $user->role_id) || $errors->has('region') ? 'd-block' : 'd-none'); ?>">
                                        <?php echo Form::label('region', 'Select Region'); ?>

                                        <div class="input-group">
                                            <?php echo Form::select('region', $regions, $user ? $user->assigned_id : null, ['class' => 'form-control select2', 'placeholder' => 'Select Region']); ?>

                                        </div>
                                        <?php $__errorArgs = ['region'];
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
                                    <div
                                         class="national <?php echo e(($user && $role['National Admin'] == $user->role_id) || $errors->has('national') ? 'd-block' : 'd-none'); ?>">
                                        <?php echo Form::label('national', 'Select National'); ?>

                                        <div class="input-group">
                                            <?php echo Form::select('national', $countries, $user ? $user->assigned_id : null, ['class' => 'form-control select2', 'placeholder' => 'Select National']); ?>

                                        </div>
                                        <?php $__errorArgs = ['national'];
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
                                    <div
                                         class="bars <?php echo e(($user && $role['Bar Admin'] == $user->role_id) || $errors->has('bar') ? 'd-block' : 'd-none'); ?>">
                                        <?php echo Form::label('bars', 'Select Bar / Restaurant'); ?>

                                        <div class="input-group">
                                            <?php echo Form::select('bar', $bars, $user ? $user->assigned_id : null, ['class' => 'form-control select2', 'placeholder' => 'Select Bar / Restaurant']); ?>

                                        </div>
                                        <?php $__errorArgs = ['bar'];
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
                            <?php if(auth()->user()->id != ($user ? $user->id : false)): ?>
                                <div class="form-group">
                                    <?php echo Form::label('approved', 'Approved'); ?>

                                    <div class="input-group">
                                        <?php echo Form::select('approved', ['No', 'Yes'], $user ? $user->approved : null, ['class' => 'form-control', 'placeholder' => 'Select User Status']); ?>

                                    </div>
                                    <?php $__errorArgs = ['approved'];
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
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <?php if($user): ?>
                                    <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                                <?php else: ?>
                                    <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>                                    
                                    <?php if(auth()->user()->role_id <= $role['Super Admin']): ?>
                                    <a href="<?php echo e(route('register')); ?>" id="registration-link" class="btn btn-outline-primary">Send Registration Link</a>                                        
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if(auth()->user()->id == ($user ? $user->id : false)): ?>
                                    <a href="<?php echo e(route('users.update-password', $user->id)); ?>" class="btn btn-outline-success">Update Password</a>
                                <?php endif; ?>
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
        (function() {
            $('#role_id').change((e) => {
                console.log(e.target.value);
                $('.regional, .national, .bars').removeClass('d-block');
                $('.regional, .national, .bars').addClass('d-none');
                switch (e.target.value) {
                    case '3': // Regional Admin
                        $('.regional').addClass('d-block');
                        break;
                    case '4': // National Admin
                        $('.national').addClass('d-block');
                        console.log(e.target.value);
                        break;
                    case '6': // Bar Admin
                        $('.bars').addClass('d-block');
                        break;
                    default:
                        console.log(e.target.value);
                }
            });

            $("#registration-link").click((e) => {
                // let params = $(e.targer).closest("form").serialize();
                // window.create({"url": "<?php echo e(route('register')); ?>?" + params, "incognito": true});
                $(e.target).closest('form').attr({"action": "<?php echo e(route('register')); ?>", "method" : "GET", "target": "_blank"});
                $(e.target).closest('form').submit();                
                return false;
            });
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/users/user-form.blade.php ENDPATH**/ ?>