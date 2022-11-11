<?php
    $type = ['brands' => 'Liqueurs brand', 'ingredients' => 'Non-alcoholic ingredients', 'category' => 'Liqueurs category'];
?>
<div>
    <p>Hi, <?php echo e($data->username); ?></p>
    <div>
        <h4>Your Request for terms "<?php echo e($term->name); ?>" in "<?php echo e($type[$data->request_for]); ?>" has been Approved</h4>        
    </div>
</div><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/mail/request_approved.blade.php ENDPATH**/ ?>