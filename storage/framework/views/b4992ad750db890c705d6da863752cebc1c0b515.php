<?php if(isset($busiest_hours)): ?>
    <div class="card-body">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Activity</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="hours-chart" height="200"></canvas>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
<?php endif; ?>
<?php if(auth()->user()->role_id <= $role['Super Admin'] && (isset($popular_cities) || isset($popular_countries))): ?>
    
    <div class="card-body">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <?php if(request()->has('country') && request()->get('country') != ''): ?>
                        <h3 class="card-title">Popular Cities</h3>
                    <?php else: ?>
                        <h3 class="card-title">Popular Countries</h3>
                    <?php endif; ?>
                    <a
                        href="<?php echo e(route('export', ['type' => 'popular_regions', 'filters' => request()->all()])); ?>">Download
                        Report as CSV</a>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="popular-chart" height="200"></canvas>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    
<?php endif; ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/analytics/_components/activity.blade.php ENDPATH**/ ?>