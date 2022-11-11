@extends('layouts.admin')

@section('content')

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
                    <th>Name</th>
                    <th>Role</th>
                    <th>Bar / Restaurant</th>
                    <th>IP Address</th>
                    <th>last Login</th>
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
@endsection


@section('scripts')
  {{-- <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css" /> --}}
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
          url: "{!! route('get.login-activity') !!}",
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
@endsection
