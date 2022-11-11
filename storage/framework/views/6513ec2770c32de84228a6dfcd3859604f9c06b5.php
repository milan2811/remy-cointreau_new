<?php $__env->startSection('content'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <?php if(auth()->user()->role_id <= 2): ?>
                <div class="row mb-2 justify-content-end">
                  <div class="col-sm-2">
                    <a href="<?php echo e(route('bars.create')); ?>" class="btn btn-outline-primary  float-right">Agregar nuevo</a>
                  </div>
                </div>
                <hr />
              <?php endif; ?>
              <div class="row mb-2 justify-content-between">
                <div class="col-sm-3">
                  <h2>Filtrado por:</h2>
                </div>
                <div class="col-sm-1">
                  <a href="javascript:;" class="clearFilter btn btn-outline-danger float-right" style="display:none;" onclick="clearFilter()">Filtro claro</a>
                </div>
              </div>
              <div class="row mb-2 justify-content-between">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Fecha:</label>
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
                <div class="col-sm-3">
                  <div class="form-group">
                    <label><strong>País:</strong></label>
                    <select id='country' class="form-control js-example-tags">
                      <option value="">Seleccionar país</option>
                      <?php $__currentLoopData = array_unique($countries); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country); ?>"><?php echo e($country); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label><strong>Ciudad:</strong></label>
                    <select id='city' class="form-control js-example-tags">
                      <option value="">Ciudad selecta</option>
                      <?php $__currentLoopData = array_unique($cities); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($city); ?>"><?php echo e($city); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>

                <?php if(auth()->user()->role_id <= 2 && isset($types)): ?>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label><strong>Restaurante / Bar:</strong></label>
                      <select id='bar_type' class="form-control js-example-tags">
                        <option value="">Toda</option>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="bars-table" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Ciudad</th>
                    <th>Dueña</th>
                    <th>Estado</th>
                    
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

      var dataTable = $('#bars-table').DataTable({
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
            sheetName: 'Bar o Restaurantes',
            exportOptions: {
              columns: [2, 3, 4, 5, 6],
              modifier: {
                search: 'applied',
                order: 'applied'
              }
            },
          },
          {
            extend: 'csvHtml5',
            sheetName: 'Bar o Restaurantes',
            exportOptions: {
              columns: [2, 3, 4, 5, 6]
            }
          },
          'colvis'
        ],
        ajax: {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "<?php echo route('bars.getBars'); ?>",
          data: function(d) {
            d.date = $('#reservation').val(),
              d.bar_type = $('#bar_type').val()
            d.country = $('#country').val()
            d.city = $('#city').val()
          },
          type: 'post'
        },
        columns: [{
            data: null,
            searchable: false,
            sortable: false,
            // "width": "1%",
          },
          {
            data: 'logo',
            name: 'logo',
            searchable: false,
            sortable: false,
            // "width": "10%",
          },
          {
            data: 'name',
            name: 'name',
            "width": "15%"
          },
          {
            data: 'country',
            name: 'country',
          },
          {
            data: 'city',
            name: 'city'
          },
          {
            data: 'owner',
            name: 'owner',
            searchable: false,
            sortable: false,
          },
          {
            data: 'status',
            name: 'status'
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
          }
        ],
        order: [
          [2, "asc"]
        ],
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
          $("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
          return nRow;
        }
      });

      dataTable.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

      $('#reservation').change(function() {
        $('.clearFilter').show();
        dataTable.draw();
      });

      $('#bar_type').change(function() {
        $('.clearFilter').show();
        dataTable.draw();
      });
      $('#city').change(function() {
        $('.clearFilter').show();
        dataTable.draw();
      });
      $('#country').change(function() {
        $('.clearFilter').show();
        dataTable.draw();
      });

    });


    function clearFilter() {
      $(".js-example-tags").val([' ']).trigger("change");
      $('#reservation').val('');
      $('#bars-table').DataTable().draw();
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
                $('#bars-table').DataTable().draw();
              });
            }
          });
        }
      });
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/bar/bars.blade.php ENDPATH**/ ?>