@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if (isset($bars) && !empty($bars))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="{{ route('bars.index') }}" style="text-decoration: none;">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $bars }}</h3>

                                    <p>Bars / Restaurants</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-glass-cheers"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                @endif
                @if (isset($items) && !empty($items))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box sidebar-dark-primary text-white">
                            <div class="inner">
                                <h3>{{ $items }}</h3>
                                <p>Items</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-glass-martini-alt"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                @endif
                @if (isset($category) && !empty($category))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="@if (auth()->user()->role_id < 5) {{ route('category.index') }} @else Javascript:; @endif"
                           style="text-decoration: none;">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $category }}</h3>
                                    <p>Categories </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-th"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                @endif

                @if (isset($ingredients) && !empty($ingredients))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="@if (auth()->user()->role_id < 5) {{ route('ingredients.index') }} @else Javascript:; @endif"
                           style="text-decoration: none;">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $ingredients }}</h3>

                                    <p>Ingredients</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-copy"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                @endif

                @if (isset($brands) && !empty($brands))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <a href="@if (auth()->user()->role_id < 5) {{ route('brands.index') }} @else Javascript:; @endif"
                           style="text-decoration: none;">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $brands }}</h3>
                                    <p>Brands</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-copy"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                @endif
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css" />
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
                        sheetName: 'Bar or Restaurants',
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
                        sheetName: 'Bar or Restaurants',
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
                    url: "{!! route('bars.getBars') !!}",
                    data: function(d) {
                        d.date = $('#reservation').val(),
                            d.user_id = $('#user_id').val(),
                            d.country = $('#country').val(),
                            d.city = $('#city').val()
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
                        data: 'logo',
                        name: 'logo',
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
                    {
                        data: 'created_at',
                        name: 'created_at',
                        "width": "10%"
                    },
                    // {
                    //   data: 'actions',
                    //   name: 'actions',
                    //   searchable: false,
                    //   sortable: false,
                    // }
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

            $('#user_id').change(function() {
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
@endsection
