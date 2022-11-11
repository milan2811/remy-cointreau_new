<div class="search-section">
    <div class="wrap">
        <div class="search-row">
            <?php echo Form::open(['url' => url()->current(), 'method' => 'GET', 'id' => 'search-form']); ?>

            <div class="form-group">
                <?php if(request()->has('ingredients')): ?>
                    <?php echo Form::hidden('ingredients', request()->get('ingredients')); ?>

                <?php endif; ?>
                <?php if(isset($bar)): ?>
                    <?php echo Form::hidden('bar_id', $bar->id); ?>

                <?php endif; ?>
                <?php echo Form::text('search', request()->has('search') ? request()->get('search') : null, ['class' => 'textbox', 'placeholder' => 'Look for your favorite drink....']); ?>

                <a href="javascript:void(0)" class="search-button" onclick="$('#search-form').submit()"><i
                        class="icon-search"></i></a>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/components/app-search.blade.php ENDPATH**/ ?>