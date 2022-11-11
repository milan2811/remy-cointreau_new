<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo e(config('app.name', 'Remy Cointreau')); ?></title>
  <link rel="shortcut icon" href="<?php echo e(asset('public/images/favicon.ico')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('public/images/logo_rounded.png')); ?>" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/Chart.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/app.css')); ?> ">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/daterangepicker.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/sweetalert2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/bootstrap-colorpicker.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/select2-bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/icheck-bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?php echo e(asset('public/css/custom.css')); ?>?v=<?php echo e(rand()); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/summernote-bs4.min.css')); ?>">
  

  <style>
    .buttons-columnVisibility span::before,  .buttons-columnVisibility span:after {
   position: absolute;
   content: "";
   transition: all 200ms;
}
.buttons-columnVisibility span::before, .buttons-columnVisibility span::before {
   left: 0;
   border: 1px solid #e03973;
}
.buttons-columnVisibility span::before {
   top: 5px;
   width: 20px;
   height: 20px;
   background: #fff;
   border: 1px solid rgba(108,117,125,0.5);
   left: 12px;
}
.buttons-columnVisibility span::after {
   content: '\2713';
   font-size: 12px;
   left: 17px;
   top: 6px;
   font-weight: 600;
   color: #fff;
   transform: scale(0);
   opacity: 0;
}
.buttons-columnVisibility.active span::after {
   transform: scale(1);
   opacity: 1;
   color: #6c757d;
}
.dropdown-item { position: relative; padding-left: 40px;}
.dropdown-item.active, .dropdown-item:active {
   color: #424548;
   text-decoration: none;
   background-color: #fff;
}
 </style>
  <script src="<?php echo e(asset('public/js/Chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/app.js')); ?>"></script>

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
        
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        

        <?php echo Form::open(['url' => route('logout'), 'method' => 'POST']); ?>

        <?php echo Form::submit('Cerrar sesión', ['class' => 'btn text-danger']); ?>

        <?php echo Form::close(); ?>


        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.admin-sidebar','data' => []]); ?>
<?php $component->withName('admin-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?php if(isset($barDetails)): ?><?php echo e($barDetails->name); ?>'s <?php endif; ?> <?php echo e(ucwords($title)); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
                <li class="breadcrumb-item active"><?php echo e(ucwords($title)); ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-<?php echo e(date('Y')); ?> Remy Cointreau.</strong>
      All rights reserved.
      <p class="float-right powered-text">powered by
        <a href="https://froztech.com" target="_blank" class="text-dark">
          <img src="<?php echo e(asset('public/images/froztech_dark.png')); ?>" alt="froztech" class="froztech-logo">
        </a>
      </p>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <script src="<?php echo e(asset('public/js/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/daterangepicker.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/dataTables.bootstrap4.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/sweetalert2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/bootstrap-colorpicker.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/select2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('public/js/summernote-bs4.min.js')); ?>"></script>
  
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
  <?php if(request()->is('*dashboard')): ?>
    <script src="<?php echo e(asset('public/js/dashboard3.js')); ?>"></script>
  <?php endif; ?>

  <script>
    $(function() {
      $('.select2').select2({
        theme: 'bootstrap4',
      });

      $('#slug, #name').change((e) => {
        let slug = e.target.value.trim().toLowerCase();
        $('#slug').val(slug.trim().replaceAll(' ', '-'));
      });

      if($('table#price-repeater').length) {
        $(document).on('click', '#add-price', function(e) {
          console.log('added');
          e.preventDefault();
          $('table#price-repeater tbody').append('<tr><td>\
            <div class="form-group"><div class="input-group">\
              <input class="form-control" placeholder="Enter Quantity" required="" name="price[quantity][]" type="text" value="">\
            </div></div></td>\
            <td><div class="form-group"><div class="input-group">\
              <input class="form-control" placeholder="Enter Price" required="" autocomplete="off" name="price[price][]" type="text" value="">\
            </div></div></td>\
            <td><a href="javascript:void(0)" class="btn btn-secondary remove-price">-</a></td>\
          </tr>');
        });

        $(document).on('click', '.remove-price', function(e) {
          e.preventDefault();
          $(e.target).closest('tr').remove();
        });
      }

      var summernoteElement = $('textarea.summernote-description');
      if(summernoteElement.length) {
        summernoteElement.summernote({
            height: 300,
            width:'100%',
            callbacks: {
                onChange: function(contents, $editable) {
                    summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
                    // summernoteValidator.element(summernoteElement);
                }   
            }
        });

        var summernoteAdditionalElement = $('textarea#summernote-add-info');
        summernoteAdditionalElement.summernote({
            height: 300,
            callbacks: {
                onChange: function(contents, $editable) {
                    summernoteAdditionalElement.val(summernoteAdditionalElement.summernote('isEmpty') ? "" : contents);
                    // summernoteValidator.element(summernoteElement);
                }   
            }
        });
      }
    });
  </script>

  <?php if(Session::has('success')): ?>
    <script>
      $(function() {
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          icon: 'success',
          title: "<?php echo e(Session::get('success')); ?>"
        })
      });
    </script>
  <?php endif; ?>
  <?php if(Session::has('error')): ?>
    <script>
      $(function() {
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          icon: 'error',
          title: "<?php echo e(Session::get('error')); ?>"
        })
      });
    </script>
  <?php endif; ?>
  <?php echo $__env->yieldContent('scripts'); ?>


</body>

</html>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/layouts/admin.blade.php ENDPATH**/ ?>