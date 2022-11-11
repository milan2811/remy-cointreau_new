<div class="col-lg-6">
    <?php if(isset($most_viewed) && $most_viewed): ?>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Most Viewed Items</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('export', ['type' => 'most_viewed_items', 'filters' => request()->all()])); ?>"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Bar/Restaurant</th>
                        <th>Price</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $most_viewed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $item = $items->item;
                            $image = json_decode($item->media);
                        ?>
                        <tr>
                            <td class="d-flex">
                                <img class="img-circle img-size-32 mr-2"
                                        src="<?php echo e($image ? asset('public/images/items/' . $image[0]) : asset('/public/images/placeholder.png')); ?>"
                                        alt="<?php echo e($image ? $image[0] : null); ?>">
                                <a
                                    href="<?php echo e(route('items.edit', ['item' => $item->id, 'bar' => $item->bar ? $item->bar->id : null, 'analytics' => 1])); ?>"><?php echo e($item->name); ?></a>
                            </td>
                            <td>
                                <?php if($item->bar): ?>
                                    <a
                                        href="<?php echo e(route('bars.edit', ['bar' => $item->bar->id, 'analytics' => 1])); ?>"><?php echo e($item->bar->name); ?></a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(getItemPriceRange($item)); ?></td>
                            <td class="text-center">
                                <?php echo e($items->total_count); ?> <i
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
    <?php if(isset($least_viewed) && $least_viewed): ?>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Least Viewed Items</h3>
                <div class="card-tools">
                    <a href="<?php echo e(route('export', ['type' => 'least_viewed_items', 'filters' => request()->all()])); ?>"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                                          
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Bar/Restaurant</th>
                            <th>Price</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $least_viewed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $item = $items->item;
                                $image = json_decode($item->media);
                            ?>
                            <tr>
                                <td class="d-flex">
                                    <img class="img-circle img-size-32 mr-2"
                                        src="<?php echo e($image ? asset('public/images/items/' . $image[0]) : asset('/public/images/placeholder.png')); ?>"
                                        alt="<?php echo e($image ? $image[0] : null); ?>">
                                    <a
                                    href="<?php echo e(route('items.edit', ['item' => $item->id, 'bar' => $item->bar ? $item->bar->id : '', 'analytics' => 1])); ?>"><?php echo e($item->name); ?></a>
                                </td>
                                <td>
                                    <?php if($item->bar): ?>
                                        <a
                                        href="<?php echo e(route('bars.edit', ['bar' => $item->bar->id, 'analytics' => 1])); ?>"><?php echo e($item->bar->name); ?></a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(getItemPriceRange($item)); ?></td>
                                <td class="text-center">
                                    <?php echo e($items->total_count); ?> <i
                                    class="fas fa-eye"></i>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/analytics/_components/items.blade.php ENDPATH**/ ?>