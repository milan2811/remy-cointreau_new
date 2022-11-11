@extends('layouts.admin')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {!! Form::model($term, $formAttributes) !!}
          <div class="card">
            <div class="card-body">
                @include('terms.form-fields')
              
                @if ($title == "brands")
                  @include("terms.children")                                                    
                @endif
            </div>

            <div class="card-footer">
              <div class="row mb-2 justify-content-between">
                <div class="col-6">
                  <div class="form-group">
                    @if ($term)
                      {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                    @else
                      {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                    @endif
                  </div>
                </div>
                <div class="col-6">
                  @if (isset($term))
                   <p class="float-right">{{ \Carbon\Carbon::parse($term->created_at)->format('F d, Y') }}</p>
                  @endif
                </div>
              </div>
            </div>

          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>  
@endsection


@section('scripts')

  <script>
    (function() {
      $('#background_color').colorpicker();
    })();
  </script>

  @if($term)
    <script>            

      $(function() {      
        var dataTable = $('#{{ $title }}-table').DataTable({
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
            url: "{!! route('get.' . $title . '-terms') !!}",
            data: {
              parent: "{{$term->id}}",
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
                    $('#{{ $title }}-table').DataTable().draw();
                  });
                }
              }
            });
          }
        });
      }
    </script>
  @endif
@endsection
