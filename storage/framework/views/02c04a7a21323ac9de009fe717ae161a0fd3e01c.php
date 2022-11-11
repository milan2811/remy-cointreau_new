<div class="table-container mt-5">
  <?php if($term && $term->children->count() != 0): ?>
  <div class="form-group float-right">
    <a href="<?php echo e(route($title . '.create')); ?>" class="btn btn-block btn-outline-primary">Add Sub <?php echo e($title); ?></a>
  </div>
  <table id="<?php echo e($title); ?>-table" class="table table-bordered table-hover" style="width: 100%;">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Slug</th>
        
        <th>Actions</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  <?php endif; ?>
</div><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/terms/children.blade.php ENDPATH**/ ?>