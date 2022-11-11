 <div class="col-lg-6">
     <!-- Ingredienst Analytics -->
     <?php if(isset($most_viewed_ingredients) && $most_viewed_ingredients->count()): ?>
     <div class="card">
         <div class="card-header border-0">
             <h3 class="card-title">Most Viewed Ingredients</h3>
             <div class="card-tools">
                 <a href="<?php echo e(route('export', ['type'=>'most_viewed_ingredients', 'filters' => request()->all()])); ?>"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                     <i class="fas fa-download"></i>
                 </a>
    
             </div>
         </div>
         <div class="card-body table-responsive p-0">
             <table class="table table-striped table-valign-middle">
                 <thead>
                     <tr>
                         <th>Ingredient</th>
                         <th>Views</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $__currentLoopData = $most_viewed_ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                             $ingredients = $terms->term;
                         ?>
                         <tr>
                             <td class="d-flex">
                                 
                                 <?php echo e($ingredients->name); ?>

                             </td>
                             <td>
                                 <?php echo e($terms->total_count); ?> <i
                                    class="fas fa-eye"></i>
                             </td>
                         </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </tbody>
             </table>
         </div>
     </div>
    <?php endif; ?>
 </div>

 <div class="col-lg-6">
    <?php if(isset($least_viewed_ingredients) && $least_viewed_ingredients->count()): ?>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Least Viewed Ingredients</h3>
                <div class="card-tools">
                    <a href="<?php echo e(route('export', ['type' => 'least_viewed_ingredients', 'filters' => request()->all()])); ?>"
                    target="_blank" title="Download as CSV"
                    class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                                         
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $least_viewed_ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $ingredients = $terms->term;
                            ?>
                            <tr>
                                <td class="d-flex">
                                    
                                    <?php echo e($ingredients->name); ?>

                                </td>
                                <td>
                                    <?php echo e($terms->total_count); ?> <i
                                    class="fas fa-eye"></i>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <!-- ./Ingredients Analytics -->
 </div>
 <?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/analytics/_components/ingredients.blade.php ENDPATH**/ ?>