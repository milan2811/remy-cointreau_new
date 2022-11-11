<?php $__env->startSection('content'); ?>
    <?php
    $user = auth()->user();
    ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php echo Form::model($home, ['url' => route('page.update', 'privacy-policy'), 'class' => 'repeater', 'method' => 'POST', 'files' => true]); ?>

            <div class="row">
                <div class="col-12">
                    
                    <div class="accordion" id="banner-accordian">
                        <div class="card">
                            <div class="card-header" id="banner-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#banner-collapse">
                                        <h4>Page Content</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="banner-collapse" class="collapse" aria-labelledby="banner-heading"
                                data-parent="#banner-accordian">
                                <div class="card-body">
                                    <div class="form-group">
                                        <?php echo Form::label('page_content', 'Text Content'); ?>

                                        <div class="input-group">
                                            <?php echo Form::textarea('page_content', null, ['class' => 'form-control summernote-description', 'id' => 'page-content']); ?>

                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                                        

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-right">
                                    <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <style>
        .accordion {
            margin: 15px;
        }

        .accordion .fa {
            margin-right: 0.2rem;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which
            // is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".card-header").find(".fa")
                    .addClass("fa-minus").removeClass("fa-plus");
            });
            // Toggle plus minus icon on show hide
            // of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-minus").addClass("fa-plus");
            });


            $(document).ready(function() {

                const repeater = $('.repeater .table-responsive').repeater({
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    ready: function (setIndexes) {

                    }
                });

                $('.repeater').submit(() => {
                    $('.repeater .table-responsive').repeater();
                })

                // let repeaterHTML = $(".bars.table-responsive .sortable-table tbody tr:first").parent().html();
                // let featureRepeaterHtml = $(".feature.table-responsive .sortable-table tbody tr:first").parent().html();
                // let helpRepeaterHtml = $(".help.table-responsive .sortable-table tbody tr:first").parent().html();
                
                $('.sortable-table .sortable-list').sortable({
                    connectWith: '.sortable-table .sortable-list',
                    placeholder: 'placeholder',   
                    helper: (e, ui) => {
                        ui.children().each(function() {
                            $(this).width($(this).width());                        
                        });
                        return ui;
                    },
                    start: (e, ui) => {
                        ui.placeholder.height(ui.item.height());
                        ui.placeholder.width(ui.item.width());
                    }        
                });

                function fixWidthHelper(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());                        
                    });
                    return ui;
                }

                $(document).on("change", 'input[accept="image/*"]', (e) => {                    
                    if(e.target.files[0]) {
                        let url = URL.createObjectURL(e.target.files[0]);
                        console.log($(e.target).prev());
                        $(e.target).prev().attr('src', url);
                    }
                });                

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/pages/privacy-policy-form.blade.php ENDPATH**/ ?>