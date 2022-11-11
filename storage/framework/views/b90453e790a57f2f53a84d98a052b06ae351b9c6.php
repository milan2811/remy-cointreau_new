<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>    
    <link rel="shortcut icon" href="<?php echo e(asset('public/images/logo_rounded.png')); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/icheck-bootstrap.min.css')); ?>">

    <!-- Scripts -->
    <script src="<?php echo e(asset('public/js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('public/css/all.min.css')); ?>">
    <link href="<?php echo e(asset('public/css/app.css')); ?>" rel="stylesheet">
</head>
<body class="hold-transition login-page">
    <?php echo $__env->yieldContent('content'); ?>
    <p class="powered-text">powered by
        <a href="https://froztech.com" target="_blank" class="text-dark">
            <img src="<?php echo e(asset('public/images/froztech_dark.png')); ?>" alt="froztech" class="froztech-logo">
        </a>
    </p>

</body>
</html>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/layouts/login.blade.php ENDPATH**/ ?>