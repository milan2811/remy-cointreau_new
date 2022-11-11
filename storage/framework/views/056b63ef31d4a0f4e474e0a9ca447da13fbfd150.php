<?php $__env->startSection('content'); ?>
  <?php
  $user = auth()->user();
  ?>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row mb-2 justify-content-end">
                <div class="col-sm-2">
                  <a href="<?php echo e(route('users.create')); ?>" class="btn btn-block btn-outline-primary">Agregar nuevo</a>
                </div>
              </div>
              <hr />

              <div class="row mb-2 justify-content-between">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Filtrar por fecha:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="reservation" readonly autocomplete="off"
                             placeholder="Seleccione la fecha">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label><strong>Filtrar por roles:</strong></label>
                    <select id='role_id' class="form-control js-example-tags">
                      <option value="">Todo</option>
                      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <option value="<?php echo e($role->role); ?>"><?php echo e($role->role_name); ?></option>
                        
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label><strong>Estado del filtro:</strong></label>
                    <select id='status' class="form-control js-example-tags">
                      <option value="">Seleccionar estado</option>
                      <option value="1">Approved</option>
                      <option value="0">Pending</option>
                    </select>
                  </div>
                </div>

                <?php if(isset($types)): ?>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label><strong>Filtro Restaurante / Bar:</strong></label>
                      <select id='bar' class="form-control js-example-tags">
                        <option value="">Todo</option>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                <?php endif; ?>

              </div>
              <a href="javascript:;" class="clearFilter" style="display:none;" onclick="clearFilter()">Filtro claro</a>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
              <table id="users-table" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Perfil</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Papel</th>
                    <th>Estado</th>
                    <th>Restaurante / Bar</th>
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

      var dataTable = $('#users-table').DataTable({
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
            sheetName: 'UsuariOs',
            exportOptions: {
              columns: [1, 2, 3, 4, 5, 6],
              modifier: {
                search: 'applied',
                order: 'applied'
              }
            },
          },
          {
            extend: 'csvHtml5',
            sheetName: 'UsuariOs',
            exportOptions: {
              columns: [1, 2, 3, 4, 5, 6]
            }
          },
          'colvis'
        ],
        ajax: {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "<?php echo route('users.getUsers'); ?>",
          data: function(d) {
            d.date = $('#reservation').val(),
              d.role_id = $('#role_id').val(),
              d.approved = $("#status").val(),
              d.bar = $("#bar").val()
          },
          type: 'post'
        },
        columns: [{
            data: null,
            searchable: false,
            sortable: false,
          },
          {
            data: 'profile_image',
            name: 'profile_image',
            searchable: false,
            sortable: false,
            "width": "10%",
          },
          {
            data: 'name',
            name: 'name',
            "width": "15%"
          },
          {
            data: 'email',
            name: 'email',
          },
          {
            data: 'role_id',
            name: 'role_id',
          },
          {
            data: 'approved',
            name: 'approved'
          },
          {
            data: 'barName',
            name: 'b.name'
          },
          {
            data: 'actions',
            name: 'actions',
            searchable: false,
            sortable: false,
            "width": "15%"
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
      $('#reservation').change(function() {
        $('.clearFilter').show();
        dataTable.draw();
      });

      $('#role_id').change(function() {
        // $('.clearFilter').show();
        dataTable.draw();
      });

      $('#status').change(function() {
        $('.clearFilter').show();
        dataTable.draw();
      });
      $('#bar').change(function() {
        $('.clearFilter').show();
        dataTable.draw();
      });

    });


    function clearFilter() {
      $('#reservation').val('');
      $("#status").val([' ']).trigger("change");
      $("#bar").val([' ']).trigger("change");
      $("#role_id").val([' ']).trigger("change");
      $('#users-table').DataTable().draw();
      $('.clearFilter').css('display', 'none');
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
                $('#users-table').DataTable().draw();
              });
            }
          });
        }
      });
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/users/users.blade.php ENDPATH**/ ?>