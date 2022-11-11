<header id="header">
    <div class="wrap">
        <div class="header-row">
            <?php if(isset($logo) && $logo == 'true'): ?>
                <a href="<?php echo e(isset($bar) && $bar ? route('bar.show', $bar->slug) : route('home')); ?>" id="logo" title="<?php echo e(config('app.name', 'Remy Cointreau')); ?>">
                    <img src="<?php echo e(isset($bar->logo) && $bar->logo ? asset('public/images/bars/logo/'.$bar->logo) : asset('public/images/logo.svg')); ?>" width="222" height="71" alt="<?php echo e(isset($bar->name) && $bar->name ? $bar->name : config('app.name', 'Remy Cointreau')); ?>">
                </a>
            <?php endif; ?>
            <?php
                $path = Request::path();
                $pathArr = explode('/', $path);                
            ?>
            <?php if( sizeof($pathArr) > 1 && Str::length($path) != 1): ?>
                <a href="<?php echo e(session('lastVisited')); ?>" class="back-btn <?php echo e(sizeof($pathArr)); ?>"><i class="icon-arrow-left"></i></a>
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