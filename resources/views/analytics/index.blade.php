@extends('layouts.admin')

@section('content')
    @php
    $role = roles();
    $user = auth()->user();
    @endphp
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if ($user->role_id < $role['Bar Admin'])
                            @if (isset($allRegion) || isset($countries) || isset($allCities) || isset($bars) || isset($category) || isset($cointreau_brands))
                                <div class="card-header ">
                                    <form action="" id="analytics-filter">
                                        <div class="row mb-2 justify-content-center">
                                            @if ($user->role_id <= $role['National Admin'])
                                                @if (isset($allRegion) && $user->role_id < $role['Regional Admin'])
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><strong>Filter By Región :</strong></label>
                                                            <select id='analytics_region' name="region"
                                                                    class="form-control js-example-tags select2">
                                                                <option value="">Select Región:</option>
                                                                @foreach ($allRegion as $index => $region)
                                                                    <option value="{{ $index }}"
                                                                            {{ request()->get('region') == $index ? 'selected' : '' }}>
                                                                        {{ $region }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (isset($countries))
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><strong>Filter By Country :</strong></label>
                                                            <select id='analytics_country' name="country"
                                                                    class="form-control js-example-tags select2">
                                                                <option value="">Select Country:</option>
                                                                @foreach ($countries as $index => $country)
                                                                    <option value="{{ $index }}"
                                                                            {{ request()->get('country') == $index ? 'selected' : '' }}>
                                                                        {{ $country }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (isset($allCities))
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label><strong>Filter By City :</strong></label>
                                                            <select id='analytics_city' name="city"
                                                                    class="form-control js-example-tags select2">
                                                                <option value="">Select City:</option>
                                                                @foreach ($allCities as $index => $city)
                                                                    <option value="{{ $city }}"
                                                                            {{ request()->get('city') == $city ? 'selected' : '' }}>
                                                                        {{ $city }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (isset($bars))
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label><strong>Filter By Bar / Restaurant:</strong></label>
                                                        <select id='analytics_bar_id' name="bar"
                                                                class="form-control js-example-tags select2">
                                                            <option value="">Select Bar / Restaurant</option>
                                                            @foreach ($bars as $index => $bar)
                                                                <option value="{{ $index }}"
                                                                        {{ request()->get('bar') == $index ? 'selected' : '' }}>
                                                                    {{ $bar }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isset($most_viewed)) 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label><strong>Filter By Item:</strong></label>
                                                        <div class="input-group">
                                                            {!! Form::text('search', request()->get('search'), ['class' => "form-control", "placeholder" => "Search by Item"]) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-search"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (isset($category)) 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label><strong>Filter By Category:</strong></label>
                                                        <div class="input-group">
                                                            <select id='cat' name="cat_id"
                                                                class="form-control js-example-tags select2">
                                                                <option value="">Select Category</option>
                                                                @foreach ($category as $index => $cat)                                                            
                                                                    <option value="{{ $index }}"
                                                                            {{ request()->get('cat_id') == $index ? 'selected' : '' }}>
                                                                        {{ $cat }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (isset($cointreau_brands)) 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label><strong>Using the brand:</strong></label>
                                                        <label for="brand-f1" class="ml-2">
                                                            <input type="checkbox" name="inverse_brand" id="brand-inverse" value="1" {{request()->get('inverse_brand') == 1 ? 'checked' : null}}> Not using the brand
                                                        </label>         
                                                        <div class="input-group">
                                                            <select id='brand-id' name="brand_id"
                                                                class="form-control js-example-tags select2">
                                                                <option value="">Select Brand</option>
                                                                @foreach ($cointreau_brands as $index => $brand)
                                                                    <option value="{{ $index}}"
                                                                            {{ request()->get('brand_id') == $index ? 'selected' : '' }}>
                                                                        {{ $brand }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif

                        @if(isset($busiest_hours) || isset($popular_cities) || isset($popular_countries))
                                @include('analytics._components.activity')
                        @endif
                                                        
                        <div class="card-body">
                            <div class="row">


                                @include('analytics._components.items')
                                @include('analytics._components.drinks')
                                @include('analytics._components.category')
                                @include('analytics._components.ingredients')
                                @include('analytics._components.liquor-brands')
                                @include('analytics._components.cointreau-brands')                                
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
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
            $("#analytics-filter").change((e) => {
                if ($(e.target).attr('name') == 'region') {
                    $("#analytics-filter #analytics_country").val('');
                    $("#analytics-filter #analytics_city").val('');
                }
                if ($(e.target).attr('name') == 'country') {
                    $("#analytics-filter #analytics_city").val('');
                    $("#analytics-filter #analytics_bar_id").val('');
                }
                if ($(e.target).attr('name') == 'city') {
                    $("#analytics-filter #analytics_bar_id").val('');
                }
                $("#analytics-filter").submit();
            });


            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $popularChart = $('#popular-chart')
            if ($popularChart.length) {
                @if (request()->has('country') && request()->get('country') != '')
                    const data = '{!! isset($popular_cities) ? json_encode($popular_cities) : null !!}';
                @else
                    const data = '{!! isset($popular_countries) ? json_encode($popular_countries) : null !!}';
                @endif
                // eslint-disable-next-line no-unused-vars
                var popularChart = new Chart($popularChart, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(JSON.parse(data)),
                        datasets: [{
                            barThickness: 50,
                            backgroundColor: '#F5ECD6',
                            borderColor: '#F5ECD6',
                            data: Object.values(JSON.parse(data)),
                        }, ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            enabled: false,
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: $.extend({
                                    beginAtZero: true,
                                }, ticksStyle)
                            }],
                        }
                    }
                });
            }

            var $hoursChart = $('#hours-chart')
            if ($hoursChart.length) {
                const hoursData = '{!! isset($busiest_hours) ? json_encode($busiest_hours) : null !!}';
                // eslint-disable-next-line no-unused-vars
                var popularChart = new Chart($hoursChart, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(JSON.parse(hoursData)),
                        datasets: [{
                            barThickness: 20,
                            backgroundColor: '#F5ECD6',
                            borderColor: '#F5ECD6',
                            data: Object.values(JSON.parse(hoursData)),
                        }, ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            enabled: false,
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: $.extend({
                                    beginAtZero: true,
                                }, ticksStyle)
                            }],
                        }
                    }
                });
            }
        });
    </script>
@endsection
