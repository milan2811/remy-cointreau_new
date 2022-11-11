<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php echo Form::model($term, $formAttributes); ?>

          <div class="card">
            <div class="card-body">
                <?php echo $__env->make('terms.form-fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              
                <?php if($title == "brands"): ?>
                  <?php echo $__env->make("terms.children", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                                                    
                <?php endif; ?>
            </div>

            <div class="card-footer">
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    <?php if($term): ?>
                      <?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

                    <?php else: ?>
                      <?php echo Form::submit('Create', ['class' => 'btn btn-success']); ?>

                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-6">
                  <?php if(isset($term)): ?>
                   <p class="float-right"><?php echo e(\Carbon\Carbon::parse($term->created_at)->format('F d, Y')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          </div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

  <script>
    (function() {
      $('#background_color').colorpicker();
    })();
  </script>

  <?php if($term): ?>
    <script>            

      $(function() {      
        var dataTable = $('#<?php echo e($title); ?>-table').DataTable({
          dom: '<"btn-container d-flex align-items-center justify-content-center justify-content-sm-between flex-wrap flex-md-nowrap pb-3"B><"d-flex align-items-center justify-content-center justify-content-sm-between flex-wrap flex-md-nowrap pt-2"lf>r<"table-responsive pb-3"t><"d-flex align-items-center justify-content-center justify-content-sm-between flex-wrap flex-md-nowrap pt-3"ip>',
          serverSide: true,
          processing: true,
          deferRender: true,
          lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
          ],
          pageLength: 10,
          buttons: [{
              extend: 'excelHtml5',
              autoFilter: true,
              sheetName: '<?php echo e($title); ?>',
              exportOptions: {
                columns: [2, 3],
                modifier: {
                  search: 'applied',
                  order: 'applied'
                }
              },
            },
            {
              extend: 'csvHtml5',
              sheetName: '<?php echo e($title); ?>',
              exportOptions: {
                columns: [2, 3]
              }
            },
            'colvis'
          ],
          ajax: {
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo route('get.' . $title . '-terms'); ?>",
            data: {
              parent: "<?php echo e($term->id); ?>",
            },
            type: 'post'
          },
          columns: [{
              data: null,
              searchable: false,
              sortable: false,
              "width": "1%"
            },            
            {
              data: 'name',
              name: 'name',
            },
            {
              data: 'slug',
              name: 'slug',
            },
            // {
            //   data: 'created_at',
            //   name: 'created_at',
            //   "width": "10%"
            // },
            {
              data: 'actions',
              name: 'actions',
              searchable: false,
              sortable: false,
              "width": "15%"
            }
          ],
          order: [
            [3, "asc"]
          ],
          "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
            return nRow;
          }
        });
        $('#reservation').change(function() {
          $('.clearFilter').show();
          dataTable.draw();
        });

        //   $('#role_id').change(function() {
        //     $('.clearFilter').show();
        //     dataTable.draw();
        //   });

      });    

      function deleteRecorded(id) {
        var url = $('.delete_' + id).data('url');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "POST",
              url: url,
              data: {
                _method: 'DELETE'
              },
              dataType: "json",
              success: function(response) {
                if (response.status == 0) {
                  Swal.fire({
                    title: 'Alert!',
                    text: response.msg,
                    icon: 'warning',
                  });
                } else {
                  Swal.fire({
                    title: 'Deleted!',
                    text: "Yours has been deleted.",
                    icon: 'success',
                  }).then((result) => {
                    $('#<?php echo e($title); ?>-table').DataTable().draw();
                  });
                }
              }
            });
          }
        });
      }
    </script>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/terms/terms-form.blade.php ENDPATH**/ ?>