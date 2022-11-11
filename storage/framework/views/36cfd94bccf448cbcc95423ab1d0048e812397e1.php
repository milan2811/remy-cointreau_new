<?php $__env->startSection('content'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row mb-2 justify-content-between">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Filter By Date:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="reservation" readonly autocomplete="off"
                             placeholder="Please Select Date">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label><strong>Bar :</strong></label>
                    <select id='bar_id' class="form-control js-example-tags">
                      
                      <?php $__currentLoopData = $bars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($selectedBar) && $selectedBar == $index): ?>
                          <option value="<?php echo e($index); ?>" selected><?php echo e($bar); ?></option>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-2">
                  <?php if(auth()->user()->role_id > 2): ?>
                    <a href="<?php echo e(route('request.create')); ?>?bar=<?php echo e($selectedBar); ?>" class="btn btn-block btn-outline-primary">Request New Item</a>
                  <?php else: ?>
                    <a href="<?php echo e(route('items.create')); ?>?bar=<?php echo e($selectedBar); ?>" class="btn btn-block btn-outline-primary">Add New</a>
                  <?php endif; ?>
                </div>
              </div>
              <a href="javascript:;" class="clearFilter" style="display:none;" onclick="clearFilter()">Clear Filter</a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="items-table" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Ingredientes</th>
                    <th>Precio</th>
                    
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
  <script>
    $(function() {
      $('#reservation').daterangepicker();
      $("#reservation").val('');

      var dataTable = $('#items-table').DataTable({
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
            sheetName: 'Elementos',
            exportOptions: {
              columns: [1, 2, 3, 4, 5],
              modifier: {
                search: 'applied',
                order: 'applied'
              }
            },
          },
          {
            extend: 'csvHtml5',
            sheetName: 'Elementos',
            exportOptions: {
              columns: [1, 2, 3, 4, 5]
            }
          },
          'colvis'
        ],
        ajax: {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "<?php echo route('items.getItems'); ?>",
          data: function(d) {
            d.date = $('#reservation').val(),
              d.bar_id = $('#bar_id').val()
          },
          type: 'post'
        },
        columns: [{
            data: null,
            searchable: false,
            sortable: false,
            "width": "1%",
          },
          {
            data: 'name',
            name: 'name',
            "width": "15%"
          },
          // {
          //   data: 'brand',
          //   name: 'brand',
          //   searchable: false,
          //   sortable: false,
          // },
          {
            data: 'category',
            name: 'category',
            searchable: false,
            sortable: false,
          },
          {
            data: 'ingredients',
            name: 'ingredients',
            searchable: false,
            sortable: false,
          },
          {
            data: 'price',
            name: 'price',
            sortable: false,
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
          [1, "asc"]
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

      $('#bar_id').change(function() {
        // $('.clearFilter').show();
        dataTable.draw();
      });

    });


    function clearFilter() {
      // $(".js-example-tags").val([' ']).trigger("change");
      $('#reservation').val('');
      $('#items-table').DataTable().draw();
      $('.clearFilter').hide();
    }

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
              Swal.fire({
                title: 'Deleted!',
                text: "Yours has been deleted.",
                icon: 'success',
              }).then((result) => {
                $('#items-table').DataTable().draw();
              });
            }
          });
        }
      });
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/items/items.blade.php ENDPATH**/ ?>