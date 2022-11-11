<?php $__env->startSection('content'); ?>
    <?php
    $role = roles();
    $user = auth()->user();
    ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <?php if($user->role_id < $role['Bar Admin']): ?>
                            <?php if(isset($allRegion) || isset($countries) || isset($allCities) || isset($bars) || isset($category) || isset($cointreau_brands)): ?>
                                <div class="card-header ">
                                    <form action="" id="analytics-filter">
                                        <div class="row mb-2 justify-content-center">
                                            <?php if($user->role_id <= $role['National Admin']): ?>
                                                <?php if(isset($allRegion) && $user->role_id < $role['Regional Admin']): ?>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><strong>Filter By Región :</strong></label>
                                                            <select id='analytics_region' name="region"
                                                                    class="form-control js-example-tags select2">
                                                                <option value="">Select Región:</option>
                                                                <?php $__currentLoopData = $allRegion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($index); ?>"
                                                                            <?php echo e(request()->get('region') == $index ? 'selected' : ''); ?>>
                                                                        <?php echo e($region); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(isset($countries)): ?>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><strong>Filter By Country :</strong></label>
                                                            <select id='analytics_country' name="country"
                                                                    class="form-control js-example-tags select2">
                                                                <option value="">Select Country:</option>
                                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($index); ?>"
                                                                            <?php echo e(request()->get('country') == $index ? 'selected' : ''); ?>>
                                                                        <?php echo e($country); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(isset($allCities)): ?>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><strong>Filter By City :</strong></label>
                                                            <select id='analytics_city' name="city"
                                                                    class="form-control js-example-tags select2">
                                                                <option value="">Select City:</option>
                                                                <?php $__currentLoopData = $allCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($city); ?>"
                                                                            <?php echo e(request()->get('city') == $city ? 'selected' : ''); ?>>
                                                                        <?php echo e($city); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(isset($bars)): ?>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label><strong>Filter By Bar / Restaurant:</strong></label>
                                                        <select id='analytics_bar_id' name="bar"
                                                                class="form-control js-example-tags select2">
                                                            <option value="">Select Bar / Restaurant</option>
                                                            <?php $__currentLoopData = $bars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($index); ?>"
                                                                        <?php echo e(request()->get('bar') == $index ? 'selected' : ''); ?>>
                                                                    <?php echo e($bar); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(isset($most_viewed)): ?> 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label><strong>Filter By Item:</strong></label>
                                                        <div class="input-group">
                                                            <?php echo Form::text('search', request()->get('search'), ['class' => "form-control", "placeholder" => "Search by Item"]); ?>

                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-search"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($category)): ?> 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label><strong>Filter By Category:</strong></label>
                                                        <div class="input-group">
                                                            <select id='cat' name="cat_id"
                                                                class="form-control js-example-tags select2">
                                                                <option value="">Select Category</option>
                                                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                            
                                                                    <option value="<?php echo e($index); ?>"
                                                                            <?php echo e(request()->get('cat_id') == $index ? 'selected' : ''); ?>>
                                                                        <?php echo e($cat); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($cointreau_brands)): ?> 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label><strong>Using the brand:</strong></label>
                                                        <label for="brand-f1" class="ml-2">
                                                            <input type="checkbox" name="inverse_brand" id="brand-inverse" value="1" <?php echo e(request()->get('inverse_brand') == 1 ? 'checked' : null); ?>> Not using the brand
                                                        </label>         
                                                        <div class="input-group">
                                                            <select id='brand-id' name="brand_id"
                                                                class="form-control js-example-tags select2">
                                                                <option value="">Select Brand</option>
                                                                <?php $__currentLoopData = $cointreau_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($index); ?>"
                                                                            <?php echo e(request()->get('brand_id') == $index ? 'selected' : ''); ?>>
                                                                        <?php echo e($brand); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(isset($busiest_hours) || isset($popular_cities) || isset($popular_countries)): ?>
                                <?php echo $__env->make('analytics._components.activity', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                                                        
                        <div class="card-body">
                            <div class="row">


                                <?php echo $__env->make('analytics._components.items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('analytics._components.drinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('analytics._components.category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('analytics._components.ingredients', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('analytics._components.liquor-brands', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('analytics._components.cointreau-brands', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                                
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css" />
    <script>
        $(function() {
            $("#analytics-filter").change((e) => {
                if ($(e.target).attr('name') == 'region') {
                    $("#analytics-filter #analytics_country").val('');
                    $("#analytics-filter #analytics_city").val('');
                }
                if ($(e.target).attr('name') == 'country') {
                    $("#analytics-filter #analytics_city").val('');
                    $("#analytics-filter #analytics_bar_id").val('');
                }
                if ($(e.target).attr('name') == 'city') {
                    $("#analytics-filter #analytics_bar_id").val('');
                }
                $("#analytics-filter").submit();
            });


            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $popularChart = $('#popular-chart')
            if ($popularChart.length) {
                <?php if(request()->has('country') && request()->get('country') != ''): ?>
                    const data = '<?php echo isset($popular_cities) ? json_encode($popular_cities) : null; ?>';
                <?php else: ?>
                    const data = '<?php echo isset($popular_countries) ? json_encode($popular_countries) : null; ?>';
                <?php endif; ?>
                // eslint-disable-next-line no-unused-vars
                var popularChart = new Chart($popularChart, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(JSON.parse(data)),
                        datasets: [{
                            barThickness: 50,
                            backgroundColor: '#F5ECD6',
                            borderColor: '#F5ECD6',
                            data: Object.values(JSON.parse(data)),
                        }, ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            enabled: false,
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: $.extend({
                                    beginAtZero: true,
                                }, ticksStyle)
                            }],
                        }
                    }
                });
            }

            var $hoursChart = $('#hours-chart')
            if ($hoursChart.length) {
                const hoursData = '<?php echo isset($busiest_hours) ? json_encode($busiest_hours) : null; ?>';
                // eslint-disable-next-line no-unused-vars
                var popularChart = new Chart($hoursChart, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(JSON.parse(hoursData)),
                        datasets: [{
                            barThickness: 20,
                            backgroundColor: '#F5ECD6',
                            borderColor: '#F5ECD6',
                            data: Object.values(JSON.parse(hoursData)),
                        }, ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            enabled: false,
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: $.extend({
                                    beginAtZero: true,
                                }, ticksStyle)
                            }],
                        }
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/analytics/index.blade.php ENDPATH**/ ?>