<div class="col-lg-6">
    <?php if(isset($most_viewed_drinks) && $most_viewed_drinks): ?>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Most Viewed Drinks</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('export', ['type' => 'most_viewed_drink', 'filters' => request()->all()])); ?>"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                </a>                                        
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Drinks</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $most_viewed_drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $category = $terms->term;
                        ?>
                        <tr>
                            <td class="d-flex">
                                <img class="img-circle img-size-32 mr-2"
                                        src="<?php echo e($category->picture ? asset('/public/images/terms/picture/' . $category->picture) : asset('/public/images/placeholder.png')); ?>"
                                        alt="<?php echo e(basename($category->picture)); ?>">
    
                                <?php echo e($category->name); ?>

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
    <?php if(isset($least_viewed_drinks) && $least_viewed_drinks): ?>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Least Viewed Drinks</h3>
                <div class="card-tools">
                    <a href="<?php echo e(route('export', ['type'=>'least_viewed_drink', 'filters' => request()->all()])); ?>"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                               
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Drinks</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $least_viewed_drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $category = $terms->term;
                            ?>
                            <?php if(isset($category)): ?>
                                <tr>
                                    <td class="d-flex">
                                        <img class="img-circle img-size-32 mr-2"
                                            src="<?php echo e($category->picture ? asset('/public/images/terms/picture/' . $category->picture) : asset('/public/images/placeholder.png')); ?>"
                                            alt="<?php echo e(basename($category->picture)); ?>">
                                        <?php echo e($category->name); ?>

                                    </td>
                                    <td>
                                        <?php echo e($terms->total_count); ?> <i
                                        class="fas fa-eye"></i>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/analytics/_components/drinks.blade.php ENDPATH**/ ?>