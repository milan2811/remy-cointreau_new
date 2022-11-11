<a href="<?php echo e(route('items', $category->slug)); ?>" class="category-box <?php echo e(isset($background) ? $background: null); ?>">
    <figure>
        <img src="<?php echo e($category->picture ? asset('/public/images/terms/picture/' . $category->picture) : asset('/public/images/placeholder.png')); ?>" alt="<?php echo e(basename($category->picture)); ?>">
    </figure>
    <p><?php echo e($category->name); ?></p>
</a><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/components/app-category-card.blade.php ENDPATH**/ ?>