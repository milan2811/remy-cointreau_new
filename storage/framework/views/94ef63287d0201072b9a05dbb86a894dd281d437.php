<?php $__env->startSection('content'); ?>    
    <div class="page-content">
        <div class="wrap">
            <?php if(isset($content['page_content'])): ?>
                <?php echo $content['page_content']; ?>

            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/privacy-policy.blade.php ENDPATH**/ ?>