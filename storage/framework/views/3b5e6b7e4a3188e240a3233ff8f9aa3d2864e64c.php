<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-header','data' => ['logo' => 'true','bar' => isset($bar) ? $bar : null]]); ?>
<?php $component->withName('app-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['logo' => 'true','bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($bar) ? $bar : null)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-banner','data' => ['bar' => isset($bar) ? $bar : null]]); ?>
<?php $component->withName('app-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($bar) ? $bar : null)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-search','data' => []]); ?>
<?php $component->withName('app-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if(isset($drinks) && !empty($drinks) && count($drinks)): ?>
                    <div class="category-section section-row">
                        <div class="wrap">
                            <?php if(request()->has('search')): ?>
                                <h2 class="section-title">Drinks</h2>
                            <?php endif; ?>
                            <div class="category-boxes">
                                <?php
                                    $i = 0;
                                ?>
                                <?php $__currentLoopData = $drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                   
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-category-card','data' => ['category' => $drink,'background' => $drink->background_color,'bar' => isset($bar) ? $bar : null]]); ?>
<?php $component->withName('app-category-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($drink),'background' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($drink->background_color),'bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($bar) ? $bar : null)]); ?> <?php echo $__env->renderComponent(); ?>
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

                <?php if(isset($bar) && isset($promotions) && !empty($promotions) && count($promotions) && !request()->has('search')): ?>
                    <div class="promotion-section section-row border-bottom">
                        <div class="wrap">
                            <h2 class="section-title">Deals</h2>

                            <div class="promotion-row owl-carousel owl-theme">
                                <?php $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <a href="<?php echo e(route('promotion-details', ['bar' => $bar->slug, $promotion->id])); ?>"
                                           class="promotion-box"
                                           <?php echo e($promotion->image ? 'style=background-image:url(' . asset('public/images/promotion/' . $promotion->image) . ')' : null); ?>>
                                            <div class="promotion-content">
                                                <div class="discount-box">
                                                    <h2><?php echo $promotion->promotion_for; ?></h2>
                                                </div>
                                                <p><?php echo e($promotion->title); ?></p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>                           
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(isset($items) && !empty($items) && count($items)): ?>
                    <div class="best-seller section-row">
                        <div class="wrap">
                            <h2 class="section-title">Recommended</h2>
                            <div class="best-items">
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-item-card','data' => ['item' => $item]]); ?>
<?php $component->withName('app-item-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?> <?php echo $__env->renderComponent(); ?>
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


                <?php if(isset($categories) && count($categories) == 0 && isset($items) && count($items) == 0): ?>
                    <h2 class="text-center mt-4">Nada Encontrado</h2>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/home.blade.php ENDPATH**/ ?>