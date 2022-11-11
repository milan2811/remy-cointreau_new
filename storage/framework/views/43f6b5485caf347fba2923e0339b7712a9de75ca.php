<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-header','data' => ['logo' => 'true','share' => 'true','bar' => (isset($bar) && !empty($bar) ? $bar : null)]]); ?>
<?php $component->withName('app-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['logo' => 'true','share' => 'true','bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((isset($bar) && !empty($bar) ? $bar : null))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-banner','data' => ['bar' => isset($bar)? $bar : null,'title' => (isset($category->name)? $category->name : 'Title here')]]); ?>
<?php $component->withName('app-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($bar)? $bar : null),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((isset($category->name)? $category->name : 'Title here'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-search','data' => ['url' => (isset($category->name) ? route('items', $category->slug) : ''),'bar' => (isset($bar) && !empty($bar) ? $bar : null)]]); ?>
<?php $component->withName('app-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((isset($category->name) ? route('items', $category->slug) : '')),'bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((isset($bar) && !empty($bar) ? $bar : null))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <div class="filter-section section-row border-bottom">
                    <div class="wrap">
                        <div class="filter-row">
                            <ul class="filter-list owl-carousel owl-theme">
                                <li <?php echo e(!request()->has('ingredients') || request()->get("ingredients") == "" ? 'class=active' : ''); ?>><a href="<?php echo e(url()->current()); ?>">All</a></li>
                                <?php if(isset($ingredients) && $ingredients != ''): ?>
                                    <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li <?php echo e(request()->has('ingredients') && request()->get("ingredients") == $ingredient->slug ? 'class=active' : ''); ?>><a href="<?php echo e(url()->current()."?ingredients=$ingredient->slug"); ?>"><?php echo e($ingredient->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                            <?php if(isset($items) && !empty($items)): ?>
                                <div class="best-seller">
                                    <div class="best-items">
                                        <?php if(isset($feature_items) && $feature_items): ?> 
                                            <?php $__currentLoopData = $feature_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php endif; ?>

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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if(isset($drinks) && !empty($drinks)): ?>
                    <div class="category-section section-row">
                        <div class="wrap">
                            <h2 class="section-title">Drinks</h2>
                            <div class="category-boxes">
                                <?php
                                    $i = 0;
                                ?>
                                <?php $__currentLoopData = $drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$drink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.app-category-card','data' => ['category' => $drink,'background' => $drink->background_color,'bar' => (isset($bar) ? $bar : null)]]); ?>
<?php $component->withName('app-category-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($drink),'background' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($drink->background_color),'bar' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((isset($bar) ? $bar : null))]); ?> <?php echo $__env->renderComponent(); ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/items.blade.php ENDPATH**/ ?>