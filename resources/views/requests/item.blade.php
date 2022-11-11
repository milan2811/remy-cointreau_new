@extends('layouts.admin')

@section('content')
    @php
    $user = auth()->user();
    @endphp
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="row mb-2 justify-content-between">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Filter by date:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation" readonly autocomplete="off"
                                                   placeholder="Please select date">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                            </div>
                            <a href="javascript:;" class="clearFilter" style="display:none;" onclick="clearFilter()">clear filter</a>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="request-table" class="table table-bordered table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Request type</th>
                                        <th>Bar</th>
                                        {{-- <th>Estado</th> --}}
                                        <th>Requested on</th>
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

            var dataTable = $('#request-table').DataTable({
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
                        sheetName: 'Solicitud De Ingredientes / Marca',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 6],
                            modifier: {
                                search: 'applied',
                                order: 'applied'
                            }
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        sheetName: 'Solicitud De Ingredientes / Marca',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 6]
                        }
                    },
                    'colvis'
                ],
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{!! route('request.getRequests') !!}",
                    data: function(d) {
                        d.date = $('#reservation').val()
                    },
                    type: 'post'
                },
                columns: [{
                        data: null,
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        name: 'email',
                        data: 'email',                        
                    },
                    {
                        data: 'request_for',
                        name: 'request_for',
                    },
                    {
                        data: 'bar',
                        name: 'bar',
                        'searchable': false,
                        'sortable': false,
                    },
                    // {
                    //   data:'status',
                    //   name:'status',
                    //   width:'13%'
                    // },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        'sortable': false,
                        'searchable': false,
                    }
                ],
                order: [
                    [5, "desc"]
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

        });


        function clearFilter() {
            $('#reservation').val('');
            $('#request-table').DataTable().draw();
            $('.clearFilter').css('display', 'none');
        }

        // $(document).on('change', 'form.status-update', (e) => {
        //   let form = $(e.target).closest('form');
        //   let url = form.attr('action');
        //   let data = form.serializeArray();

        //   $.ajax({
        //     headers: {
        //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     type: "PUT",
        //     url: url,
        //     data: {
        //       _method: 'PUT',
        //       status: data[0].value,
        //     },
        //     dataType: "json",
        //     success: function(response) {
        //       Swal.fire({
        //         title: 'Status Updated!',
        //         text: "Status has been Updated.",
        //         icon: 'success',
        //       }).then((result) => {
        //         $('#request-table').DataTable().draw();
        //       });
        //     }
        //   });
        // });

        $(document).on("click", "a.approve, a.reject", (e) => {
            e.preventDefault();
            let elem = e.target.href ? $(e.target) : $(e.target).closest("a");
            let url = elem.data("url");
            let status = 0;
            if (elem.hasClass("approve")) {
                status = 1;
            }
            console.log(url);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: url,
                data: {
                    _method: 'PUT',
                    status: status,
                },
                dataType: "json",
                success: function(response) {
                    Swal.fire({
                        title: 'Status Updated!',
                        text: "Status has been Updated.",
                        icon: 'success',
                    }).then((result) => {
                        $('#request-table').DataTable().draw();
                    });
                }
            });
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
                            Swal.fire({
                                title: 'Deleted!',
                                text: "Yours has been deleted.",
                                icon: 'success',
                            }).then((result) => {
                                $('#request-table').DataTable().draw();
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
