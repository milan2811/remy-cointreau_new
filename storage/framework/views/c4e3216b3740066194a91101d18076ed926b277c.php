<?php $__env->startSection('content'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="login-activity" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Papel</th>
                    <th>Bar / Restaurante</th>
                    <th>Dirección IP</th>
                    <th>Fecha de inicio de sesión</th>
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

      var dataTable = $('#login-activity').DataTable({
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
            sheetName: 'Actividad De Inicio De Sesión',
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
            sheetName: 'Actividad De Inicio De Sesión',
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
          url: "<?php echo route('get.login-activity'); ?>",
          //   data: function(d) {
          //     d.date = $('#reservation').val(),
          //       d.user_id = $('#user_id').val()
          //     d.country = $('#country').val()
          //     d.city = $('#city').val()
          //   },
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
            name: 'users.name',
            "width": "15%"
          },
          {
            data: 'role_name',
            name: 'roles.role_name',
            "width": "15%"
          },
          {
            data: 'barName',
            name: 'bars.name',
            "width": "15%"
          },
          {
            data: 'ip_address',
            name: 'ip_address',
            "width": "15%"
          },
          {
            data: 'created_at',
            name: 'created_at',
            "width": "10%"
          },
        ],
        order: [
          [5, "desc"]
        ],
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
          $("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
          return nRow;
        }
      });

      dataTable.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/login-activity/index.blade.php ENDPATH**/ ?>