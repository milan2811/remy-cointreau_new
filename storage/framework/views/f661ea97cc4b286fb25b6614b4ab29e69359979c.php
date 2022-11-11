<div>
    <p>Hi, <?php echo e(auth()->user()->name); ?></p>
    <div style="text-align:center">
        <p>Your OTP is</p>
        <h3><?php echo e(session()->get('otp')['pin']); ?></h3>
        <p>Please enter this otp to Update Password</p>
    </div>
</div><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/mail/verify.blade.php ENDPATH**/ ?>