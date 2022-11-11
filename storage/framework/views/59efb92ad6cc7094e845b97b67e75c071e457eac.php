<?php $__env->startSection('content'); ?>    
    <?php if(isset($content['banner']) && ($content['banner']->title || $content['banner']->heading || $content['banner']->image)): ?>
        <div class="banner-section">
            <div class="wrap">
                <div class="banner-row">
                    <div class="banner-info">
                        <?php if($content['banner']->title): ?>
                            <span><?php echo e($content['banner']->title); ?></span>                            
                        <?php endif; ?>
                        <?php if($content['banner']->heading): ?>
                            <h1><?php echo $content['banner']->heading; ?></h1>                            
                        <?php endif; ?>
                        <?php if($content['banner']->description): ?>
                            <p><?php echo e($content['banner']->description); ?></p>                            
                        <?php endif; ?>
                        <?php if($content["banner"]->cta && $content["banner"]->cta->text): ?>
                            <a href="<?php echo e($content["banner"]->cta->url ? $content["banner"]->cta->url : '#'); ?>" class="button"><?php echo e($content["banner"]->cta->text); ?></a>                            
                        <?php endif; ?>
                    </div>
                    <div class="banner-image">
                        <?php if($content["banner"]->image): ?>
                            <figure>
                                <img src="<?php echo e($content["banner"]->image ? asset('/public/images/uploads/'.$content['banner']->image) : asset('public/home/images/hero-img.png')); ?>" alt="banner-image">
                            </figure>                            
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--/ banner section End-->        
    <?php endif; ?>

    <?php if(isset($content['available']) && $content['available']): ?>
        <!--/ Restaurantes section Start-->
        <div class="Restaurantes-section">
            <div class="wrap">
                <?php if(isset($content['available']->heading) && isset($content['available']->heading)): ?>
                    <h2><?php echo $content['available']->heading; ?></h2>                    
                <?php endif; ?>
                <div class="Restaurantes-row">

                    <nav class="owl-filter-bar">
                        <a href="#" class="item button btn-outline" data-owl-filter=".restaurant">Restaurante</a>
                        <a href="#" class="item button btn-outline" data-owl-filter=".bar">Bar</a>
                        <a href="#" class="item button btn-outline" data-owl-filter=".night">Nightclub</a>
                    </nav>

                    <div class="owl-carousel category-slider">  
                        <?php if(isset($content['available']->restaurants)): ?>
                            <?php $__currentLoopData = $content['available']->restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item restaurant">
                                    <div class="Restaurantes-images">
                                        <a href="<?php echo e($item->url ? $item->url : 'javascript:void(0)'); ?>">
                                            <figure>
                                                <img src="<?php echo e(isset($item->image) && $item->image ? asset('public/images/uploads/'. $item->image) : asset('public/images/placeholder.png')); ?>" alt="<?php echo e($item->name); ?>">
                                            </figure>
                                            <h4><?php echo e($item->name); ?></h4>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                        <?php endif; ?>  
                        <?php if(isset($content['available']->bars)): ?>
                            <?php $__currentLoopData = $content['available']->bars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item bar">
                                    <div class="Restaurantes-images">
                                        <a href="<?php echo e($item->url ? $item->url : 'javascript:void(0)'); ?>">
                                            <figure>
                                                <img src="<?php echo e(isset($item->image) && $item->image ? asset('public/images/uploads/'. $item->image) : asset('public/images/placeholder.png')); ?>" alt="<?php echo e($item->name); ?>">
                                            </figure>
                                            <h4><?php echo e($item->name); ?></h4>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                        <?php endif; ?>
                        <?php if(isset($content['available']->nightclubs)): ?>
                            <?php $__currentLoopData = $content['available']->nightclubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item night">
                                    <div class="Restaurantes-images">
                                        <a href="<?php echo e($item->url ? $item->url : 'javascript:void(0)'); ?>">
                                            <figure>
                                                <img src="<?php echo e(isset($item->image) && $item->image ? asset('public/images/uploads/'. $item->image) : asset('public/images/placeholder.png')); ?>" alt="<?php echo e($item->name); ?>">
                                            </figure>
                                            <h4><?php echo e($item->name); ?></h4>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                        <?php endif; ?>                                               
                    </div>
                </div>
            </div>
        </div>
        <!--/ Restaurantes section End-->    
    <?php endif; ?>

    <?php if(isset($content['about']) && ($content['about']->heading || $content['about']->description || $content['about']->image)): ?>
        <!--/ about section Start-->
        <div class="about-section" id="cómo-funciona">
            <div class="wrap">
                <div class="about-row">
                    <?php if($content['about']->heading): ?>
                        <h2><?php echo $content['about']->heading; ?></h2>                        
                    <?php endif; ?>
                    <?php if($content['about']->description): ?>
                        <p><?php echo e($content['about']->description); ?></p>                        
                    <?php endif; ?>
                    <?php if($content['about']->image): ?>
                        <figure>
                            <img src="<?php echo e(asset('public/images/uploads/'. $content['about']->image)); ?>" alt="<?php echo e($content['about']->image); ?>">
                        </figure>                        
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--/ about section End-->        
    <?php endif; ?>

    <?php if(isset($content['easy']) && ($content['easy']->heading || $content['easy']->description || $content['easy']->image || $content['easy']->feature)): ?>
    <!--/ manage section Start-->
    <div class="manage-section" id="características">
        <div class="manage-left">
            <div class="manage-info">
                <div class="manage-title">
                    <?php if($content['easy']->heading): ?>
                        <h2><?php echo $content['easy']->heading; ?></h2>                        
                    <?php endif; ?>
                    <?php if($content['easy']->description): ?>
                        <p><?php echo e($content['easy']->description); ?></p>                        
                    <?php endif; ?>
                    <?php if($content['easy']->feature && sizeof($content['easy']->feature)): ?>
                        <ul>
                            <?php $__currentLoopData = $content['easy']->feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <i class="<?php echo e($feature->icon); ?>"></i>
                                    <?php if($feature->heading): ?>
                                        <h4><?php echo e($feature->heading); ?></h4>                                        
                                    <?php endif; ?>
                                    <?php if($feature->description): ?>
                                        <p><?php echo e($feature->description); ?></p>                                        
                                    <?php endif; ?>
                                </li>                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        </ul>                        
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($content['easy']->image): ?>
            <div class="manage-image">
                <figure>
                    <img src="<?php echo e(asset('public/images/uploads/'. $content['easy']->image)); ?>" alt="<?php echo e($content['easy']->image); ?>">
                </figure>
            </div>            
        <?php endif; ?>
    </div>
    <!--/ manage section End-->
    <?php endif; ?>

    <?php if(isset($content['how']) && ($content['how']->heading || $content['how']->description || $content['how']->image || $content['how']->help)): ?>
    <!--/ help section Start-->
    <div class="help-section" id="beneficios">
        <div class="wrap">
            <div class="help-row">
                <div class="cols cols2">
                    <div class="col">
                        <?php if($content['how']->image ): ?>
                            <div class="help-image">
                                <figure>
                                    <img src="<?php echo e(asset('public/images/uploads/'. $content['how']->image)); ?>" alt="<?php echo e($content['how']->image); ?>">
                                </figure>
                            </div>                            
                        <?php endif; ?>
                    </div>
                    <div class="col">
                        <div class="help-info">
                            <?php if($content['how']->heading): ?>
                                <h2><?php echo $content['how']->heading; ?></h2>                                
                            <?php endif; ?>
                            <?php if($content['how']->description): ?>
                                <p><?php echo e($content['how']->description); ?></p>                                
                            <?php endif; ?>
                            <?php if($content['how']->help && sizeof($content['how']->help)): ?>
                                <ul>
                                    <?php $__currentLoopData = $content['how']->help; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $help): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <?php if($help->heading): ?>
                                                <h4><?php echo e($help->heading); ?></h4>                                                
                                            <?php endif; ?>
                                            <?php if($help->description): ?>
                                                <p><?php echo e($help->description); ?></p>                                                
                                            <?php endif; ?>
                                        </li>                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                    
                                </ul>                                
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ help section Start-->
    <?php endif; ?>

    <?php if(isset($content['logos']) && sizeof($content['logos'])): ?> 
    <!--/ brands section Start-->
    <div class="brands-section">
        <div class="wrap">
            <div class="logo-boxes">
                <?php $__currentLoopData = $content['logos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="logo-box item">
                        <img src="<?php echo e($logo->image ? asset('public/images/uploads/'.$logo->image) : asset('public/home/images/brand-1.png')); ?>" alt="<?php echo e($logo->image); ?>">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
            </div>
        </div>
    </div>
    <!--/ brands section End-->
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/homepage.blade.php ENDPATH**/ ?>