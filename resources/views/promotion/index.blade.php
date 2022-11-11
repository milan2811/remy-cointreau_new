@extends('layouts.admin')

@section('content')

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
                        <label>Filter by date:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservation" readonly autocomplete="off"
                                placeholder="Please Select date">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>            
                <div class="col-sm-2">
                  <a href="{{ route('promotion.create') }}" class="btn btn-block btn-outline-primary">Create promotion</a>
                </div>
              </div>              
              <a href="javascript:;" class="clearFilter" style="display:none;" onclick="clearFilter()">clear filter</a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="promotion-table" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Promotion</th>
                    {{-- <th>Date</th> --}}
                    <th>Actions</th>
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
  <script>
    $(function() {
      $('#reservation').daterangepicker();
      $("#reservation").val('');

      var dataTable = $('#promotion-table').DataTable({
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
            sheetName: '{{ $title }}',
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
            sheetName: '{{ $title }}',
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
          url: "{!! route('get.promotions') !!}",
          data: function(d) {
            d.date = $('#reservation').val()            
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
            data: 'title',
            name: 'title',            
          },
          {
            data: 'image',
            name: 'image',
            sortable: false,
          },
          {
            data: 'promotion_for',
            name: 'promotion_for',            
            sortable: false,
          },          
          {
            data: 'actions',
            name: 'actions',
            searchable: false,
            sortable: false,
            "width": "15%"
          }
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


    function clearFilter() {
      $(".js-example-tags").val([' ']).trigger("change");
      $('#reservation').val('');
      $('#promotion-table').DataTable().draw();
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
                  $('#promotion-table').DataTable().draw();
                });
              }
            }
          });
        }
      });
    }
  </script>
@endsection
