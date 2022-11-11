<?php
    $image = json_decode($item->media);    
?>
<div class="best-item">
    <a href="<?php echo e(route('item.show', $item->slug)); ?>" class="item-img">
        
        <img src="<?php echo e($image ? asset('public/images/items/'. $image[0]) : asset('/public/images/placeholder.png')); ?>" alt="<?php echo e($image ? $image[0] : null); ?>">
    </a>
    <p><a href="<?php echo e(route('item.show', $item->slug)); ?>"><?php echo e($item->name); ?></a></p>
    <div class="price">
        <?php
            $prices = json_decode($item->price);
            $min = 0;
            $max = 0;
            foreach ($prices->price as $index=>$price) {
                if($prices->price[$index] < $min || $index == 0) {
                    $min = $prices->price[$index];                        
                } 
                if($prices->price[$index] > $max) {
                    $max = $prices->price[$index];
                }
            }
            echo "$ $min - $ $max";
        ?>

    </div>
</div><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/components/app-item-card.blade.php ENDPATH**/ ?>