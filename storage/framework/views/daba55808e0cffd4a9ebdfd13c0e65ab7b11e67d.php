<?php $__env->startSection('content'); ?>
  <?php
  $category = [];
  $brands = [];
  $ingredients = [];
  foreach ($terms as $term) {
      if ($term->type == 'category') {
          $category[$term->id] = $term->name;
      }
      if ($term->type == 'ingredients') {
          $ingredients[$term->id] = $term->name;
      }
      if ($term->type == 'brands') {
          $brands[$term->id] = $term->name;
      }
  }

  // $bars = [];
  // $bars[''] = 'Select Bar';
  // foreach ($barsList as $bar) {
  //     $bars[$bar->id] = $bar->name;
  // }

  ?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <?php echo Form::model($item, $formAttributes); ?>


              <?php echo Form::hidden('bar_id', $selectedBar); ?>


              <div class="form-group">
                <?php echo Form::label('name', 'Name'); ?>

                <div class="input-group">
                  <?php echo Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Item Name', 'required' => true, 'autocomplete' => 'off']); ?>

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
                <?php echo Form::label('slug', 'Slug'); ?>

                <div class="input-group">
                  <?php echo Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'Enter Item slug', 'required' => true, 'autocomplete' => 'off']); ?>

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

              <div class="form-group">
                <?php echo Form::label('description', 'Description'); ?>

                <div class="input-group">
                  <?php echo Form::textarea('description', null, ['class' => 'form-control summernote-description', 'id' => 'description', 'placeholder' => 'Enter Item Description here...']); ?>

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

              <div id="cate-and-in"></div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <?php echo Form::label('category', 'Category'); ?>

                    <div class="input-group">
                      <?php echo Form::select('category', $category, $relationships, ['class' => 'form-control select2', 'id' => 'category', 'data-placeholder' => 'Select Category', 'required' => true]); ?>

                    </div>
                    <?php $__errorArgs = ['category'];
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
                    <?php echo Form::label('ingredients', 'Ingredients'); ?>

                    <div class="input-group">
                      <?php echo Form::select('ingredients[]', $ingredients, $relationships, ['class' => 'form-control select2', 'id' => 'ingredients', 'data-placeholder' => 'Select Ingredients', 'multiple' => true, 'required' => true]); ?>

                    </div>
                    <?php $__errorArgs = ['ingredients'];
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

              <div class="form-group">
                <?php echo Form::label('brand', 'Brand'); ?>

                <div class="input-group">
                  <?php echo Form::select('brand', $brands, $relationships, ['class' => 'form-control select2', 'id' => 'brand', 'data-placeholder' => 'Select Brand', 'required' => true]); ?>

                </div>
                <?php $__errorArgs = ['brand'];
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
                <?php echo Form::label('Upload Media'); ?>

                <?php echo Form::hidden('media_type', 'image'); ?>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs justify-content-around">
                  <li class="nav-item w-50 text-center">
                    <a class="nav-link active" data-toggle="tab" href="#media1" data-type="image">
                      Image
                    </a>
                  </li>
                  
                </ul>

                <!-- Tab panes -->
                <div class="tab-content media-type-container">
                  <div id="media1" class="tab-pane mt-2 active">
                    <?php echo Form::label('upload-image', 'Upload Image'); ?>

                    <?php echo Form::file('images[]', ['class' => 'form-control', 'id' => 'upload-image', 'multiple' => true, 'accept' => 'image/*']); ?>

                  </div>
                  <div id="media2" class="tab-pane mt-2 fade">
                    <?php echo Form::label('upload-video', 'Upload Video'); ?>

                    <?php echo Form::file('video', ['class' => 'form-control', 'id' => 'upload-video', 'accept' => 'video/*']); ?>

                  </div>
                </div>
              </div>
              
              <div class="container">
                <table class="table" id="price-repeater">
                  <thead>
                      <tr>
                        <th>Quantity
                            <?php $__errorArgs = ['quantity'];
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
                        </th>
                        <th>Price
                          <?php $__errorArgs = ['price'];
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
                        </th>
                        <th style="width:1%"></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($item) && isset($item->price) && !empty($item->price)): ?>
                      <?php
                          $prices = json_decode($item->price);
                      ?>
                        <?php $__currentLoopData = $prices->price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                         
                          <tr>
                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <?php echo Form::text('price[quantity][]', $prices->quantity[$index], ['class' => 'form-control', 'placeholder' => 'Enter Quantity', 'required' => true]); ?>

                                </div>                          
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <?php echo Form::text('price[price][]', $prices->price[$index], ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required' => true, 'autocomplete' => 'off']); ?>

                                </div>                                
                              </div>      
                            </td>
                            <td>
                              <?php if($index == 0): ?>
                                <a href="javascript:void(0)" class="btn btn-success" id="add-price">+</a>
                              <?php else: ?>
                                <a href="javascript:void(0)" class="btn btn-secondary remove-price">-</a> 
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                    
                      <tr>
                        <td>
                          <div class="form-group">
                            <div class="input-group">
                              <?php echo Form::text('price[quantity][]', null, ['class' => 'form-control', 'placeholder' => 'Enter Quantity', 'required' => true]); ?>

                            </div>                          
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <div class="input-group">
                              <?php echo Form::text('price[price][]', null, ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required' => true, 'autocomplete' => 'off']); ?>

                            </div>                            
                          </div>      
                        </td>
                        <td>
                          <a href="javascript:void(0)" class="btn btn-success" id="add-price">+</a>
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              

            <div class="card-footer">
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php if($item): ?>
                      <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                    <?php else: ?>
                      <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-6">
                  <?php if(isset($item)): ?>
                    <p class="float-right"><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('F d, Y')); ?></p>
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
      // $('.bar-select').select2({
      //   theme: 'bootstrap4'
      // });

      // getCate($('.bar-select').val());
      $('.form-group .nav-link').click((e) => {
        $('input[name="media_type"]').val($(e.target).data('type'));
      });
    });


    // $('.bar-select').change(function(e) {
    //   e.preventDefault();
    //   getCate($(this).val());
    // });

    // function getCate(bar_id) {
    //   $.ajax({
    //     headers: {
    //       'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    //     },
    //     type: "post",
    //     dataType: "json",
    //     url: "<?php echo e(route('get.items.category')); ?>",
    //     data: {
    //       bar_id: bar_id
    //     },
    //     success: function(res) {
    //       $('#cate-and-in').html(res.data);
    //     }
    //   });
    // }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/items/items-form.blade.php ENDPATH**/ ?>