<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($title); ?></title>
</head>
<body style="text-align:center">
    <h1><?php echo e($title); ?></h1>
    <figure>
        <img src="data:image/png;base64, <?php echo $qrcode; ?>" style="text-align:center">
    </figure>
    <div>
        <a href="<?php echo e($url); ?>"><?php echo e($url); ?></a>
    </div>
</body> 
</html><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/bar/downloadPDF.blade.php ENDPATH**/ ?>