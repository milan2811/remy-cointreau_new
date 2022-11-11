<?php
    $image = json_decode($item->media);    
?>
<div class="best-item">
    <a href="<?php echo e(route('item.show', ['bar' => $item->bar ? $item->bar->slug : null, 'item' => $item ? $item->slug : null])); ?>" class="item-img">
        
        <img src="<?php echo e($image ? asset('public/images/items/'. $image[0]) : asset('/public/images/placeholder.png')); ?>" alt="<?php echo e($image ? $image[0] : null); ?>">
    </a>
    <p><a href="<?php echo e(route('item.show', ['bar' => $item->bar ? $item->bar->slug : null, 'item' => $item ? $item->slug : null])); ?>"><?php echo e($item->name); ?></a></p>
    <div class="price">
        <?php echo e(getItemPriceRange($item)); ?>

    </div>
</div><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/components/app-item-card.blade.php ENDPATH**/ ?>