<?php $__env->startSection('content'); ?>
    <?php
    $title = isset($promotion->title) ? strip_tags($promotion->title) : 'Title here';
    ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-header','data' => ['logo' => 'true','share' => 'true','bar' => isset($bar) && !empty($bar) ? $bar : null]]); ?>
<?php $component->withName('app-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['logo' => 'true','share' => 'true','bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($bar) && !empty($bar) ? $bar : null)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-banner','data' => ['title' => '']]); ?>
<?php $component->withName('app-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => '']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">

                <div class="product-info border-bottom">
                    <div class="wrap">

                        <div class="inner-product-details">
                            <div class="product-banner">
                                <img src="<?php echo e(isset($promotion->image) && !empty($promotion->image)? asset('public/images/promotion/' . $promotion->image): asset('/public/images/placeholder.png')); ?>"
                                     alt="<?php echo e($title); ?>">
                            </div>
                            <div class="title-price">
                                <?php if(isset($title)): ?>
                                    <h2 class="section-title section-title2"><?php echo e($title); ?></h2>
                                <?php endif; ?>                                

                                <div class="ingredients">
                                    <?php echo $promotion->promotion_for; ?>

                                </div>
                                <div class="ingredients">
                                    <?php echo $promotion->short_description; ?>

                                </div>
                                <?php
                                    $prices = json_decode($promotion->price);
                                    $min = 0;
                                    $max = 0;
                                ?>
                                <?php if($prices): ?>
                                    <div class="product-price mt-3">
                                        <?php $__currentLoopData = $prices->price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <h4><?php echo e(sizeof($prices->price) > 1 ? $prices->quantity[$index] : null); ?> <span>$
                                                    <?php echo e($prices->price[$index]); ?></span></h4>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="ingredients">
                                    <?php if(isset($promotion->link) && $promotion->link != ''): ?>
                                        <a href="<?php echo e($promotion->link); ?>" target="_blank" class="button btn-outline">View item regular menu</a>
                                    <?php endif; ?>
                                </div> 
                            </div>
                        </div>
                        <?php echo $promotion->description; ?>

                    </div>
                </div>
            </div>
            <!--/#content-->
        </div>
        <!--/#primary-->
    </div>
    <!--/#main -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['body_class' => 'product-detail'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/promotion-details.blade.php ENDPATH**/ ?>