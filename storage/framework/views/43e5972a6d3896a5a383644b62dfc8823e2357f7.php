<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-header','data' => ['share' => 'true']]); ?>
<?php $component->withName('app-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['share' => 'true']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php
        $image = json_decode($item->media);
    ?>
    <div class="product-banner" style="background-image:url(<?php echo e(isset($item->media) && !empty($item->media) ? asset('public/images/items/'. $image[0]) : asset('/public/images/placeholder.png')); ?>)"></div>

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">

                <div class="product-info border-bottom">
                    <div class="wrap">
                        <?php if(isset($item->name)): ?>
                            <h2 class="section-title section-title2"><?php echo e($item->name); ?></h2>
                        <?php endif; ?>
                        <?php
                            $prices = json_decode($item->price);
                            $min = 0;
                            $max = 0;                            
                        ?>
                        <?php if($prices): ?> 
                        <div class="product-price">
                            <?php $__currentLoopData = $prices->price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4> <?php echo e($prices->quantity[$index]); ?> <span>$ <?php echo e($prices->price[$index]); ?></span></h4>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                        <?php echo $item->description; ?>                        
                    </div>
                </div>
                <?php if(isset($related_items) && !empty($related_items)): ?>
                    <div class="best-seller section-row">
                        <div class="wrap">
                            <h2 class="section-title">Artículos similares </h2>
                            <div class="best-items">
                                <?php $__currentLoopData = $related_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-item-card','data' => ['item' => $itm]]); ?>
<?php $component->withName('app-item-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itm)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>   
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
                            </div>
                        </div>
                    </div>                    
                <?php endif; ?>
            </div><!--/#content-->
        </div><!--/#primary-->
	</div><!--/#main -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['body_class' => 'product-detail'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/item-single.blade.php ENDPATH**/ ?>