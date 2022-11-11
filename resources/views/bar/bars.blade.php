@extends('layouts.admin')

@section('content')
    @php
    $role = roles();
    @endphp
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (auth()->user()->role_id < $role['Account Admin'])
                                <div class="row mb-2 justify-content-end">
                                    <div class="col-sm-2">
                                        <a href="{{ route('bars.create') }}" class="btn btn-outline-primary  float-right">Add New</a>
                                    </div>
                                </div>
                                <hr />
                            @endif
                            <div class="row mb-2 justify-content-between">
                                <div class="col-sm-3">
                                    <h2>Filters:</h2>
                                </div>
                                <div class="col-sm-1">
                                    <a href="javascript:;" class="clearFilter btn btn-outline-danger float-right" style="display:none;"
                                       onclick="clearFilter()">clear filter</a>
                                </div>
                            </div>
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
                                                   placeholder="Please Select Date">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                @if (isset($countries) && !empty($countries))
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label><strong>Filter by country:</strong></label>
                                            <select id='country' class="form-control select2">
                                                <option value="">Select country</option>
                                                @foreach (array_unique($countries) as $country)
                                                    <option value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($cities) && !empty($cities))
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label><strong>Filter by cities:</strong></label>
                                            <select id='city' class="form-control js-example-tags">
                                                <option value="">Select city</option>
                                                @foreach (array_unique($cities) as $city)
                                                    <option value="{{ $city }}">{{ $city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if (auth()->user()->role_id < $role['Account Admin'] && isset($types))
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label><strong>Restaurant / Bar:</strong></label>
                                            <select id='bar_type' class="form-control js-example-tags">
                                                <option value="">All</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if (auth()->user()->role_id < $role['Account Admin'])
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><strong>Filter By Category:</strong></label>
                                            <div class="input-group">
                                                <select id='category' name="category"
                                                    class="form-control js-example-tags select2">
                                                    <option value="">Select Category</option>
                                                    @foreach ($category as $index => $cat)                                                            
                                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><strong>Using the brand:</strong></label>
                                            <label for="brand-f1" class="ml-2">
                                                <input type="checkbox" name="inverse_brand" id="brand-inverse" value="1"> Not using the brand
                                            </label>         
                                            <div class="brand-response mb-1"></div>
                                            <select id='brand' class="form-control js-example-tags select2">
                                                <option value="">All</option>
                                                @foreach (remy_cointreau_brands() as $remy_brand)
                                                    <option value="{{ $remy_brand }}">{{ $remy_brand }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                @endif
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="bars-table" class="table table-bordered table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Owner</th>
                                        <th>Status</th>
                                        {{-- <th>Date</th> --}}
                                        <th>Action</th>
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
            let TOTAL = 0;
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
                "drawCallback": function( settings ) {
                    TOTAL = TOTAL == 0 ? dataTable.page.info().recordsTotal : TOTAL;
                    if($('#brand').val() || $('#brand-inverse').is(":checked")) {
                        $(".brand-response").html(((dataTable.page.info().recordsDisplay / TOTAL) * 100).toFixed(2) + '% '); 
                        $(".brand-response").append($('#brand-inverse').is(":checked") ? ' Not Uses ' : ' Uses '); 
                        $(".brand-response").append($('#brand').val()); 
                    } else {
                        $(".brand-response").html("")
                    }
                    // Output the data for the visible rows to the browser's console
                    // console.log( api.rows( {page:'current'} ).data() );
                },
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{!! route('bars.getBars') !!}",
                    data: function(d) {
                        d.date = $('#reservation').val(),
                        d.bar_type = $('#bar_type').val(),
                        d.country = $('#country').val(),
                        d.city = $('#city').val(),
                        d.category = $('#category').val(),
                        d.brand = $('#brand').val(),
                        d.brand_invert = $('#brand-inverse').is(":checked")
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
                        name: 'c.country_name',
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
                    console.log(aData.categories_usign_brands);
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

            $('#category').change(function() {
                $('.clearFilter').show();
                dataTable.draw();
            });

            $('#brand').change(function() {
                $('.clearFilter').show();
                dataTable.draw();
            });

            $('#brand-inverse').change(function() {
                $('.clearFilter').show();
                dataTable.draw();                
            });

        });


        function clearFilter() {
            $(".js-example-tags").val([' ']).trigger("change");
            $(".select2").val([' ']).trigger("change");
            $('#reservation').val('');
            $('#country').val('');
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
