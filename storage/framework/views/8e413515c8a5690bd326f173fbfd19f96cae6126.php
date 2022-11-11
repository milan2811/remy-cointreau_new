<header id="header">
    <div class="wrap">
        <div class="header-row">
            <?php if(isset($logo) && $logo == 'true'): ?>            
                <a href="<?php echo e(route('home')); ?>" id="logo" title="<?php echo e(config('app.name', 'Remy Cointreau')); ?>">
                    <img src="<?php echo e(asset('public/images/logo.svg')); ?>" width="222" height="71" alt="<?php echo e(config('app.name', 'Remy Cointreau')); ?>">
                </a>            
            <?php endif; ?>
            <?php if( !request()->is('/')): ?> 
                <a href="<?php echo e(url()->previous()); ?>" class="back-btn"><i class="icon-arrow-left"></i></a>                
            <?php endif; ?>
            <?php if(isset($share) && $share == 'true'): ?>
            <a href="javascript:;" class="share-btn">
                <i class="icon-share"></i>
                <div class="share-button-wrap">
                    <div class="share-btn-container">
                    </div>
                </div>
            </a>
            <?php endif; ?>
        </div>
    </div><!--/.wrap-->
</header><!--/#header--><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/components/app-header.blade.php ENDPATH**/ ?>