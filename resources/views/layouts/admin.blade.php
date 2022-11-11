<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Remy Cointreau') }}</title>
  {{-- <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}"> --}}
  <link rel="shortcut icon" href="{{ asset('public/images/logo_rounded.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/Chart.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/app.css') }} ">
  <link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}?v={{ rand() }}">
  <link rel="stylesheet" href="{{ asset('public/css/summernote-bs4.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}"> --}}

  <script src="{{ asset('public/js/Chart.min.js') }}"></script>
  <script src="{{ asset('public/js/app.js') }}"></script>

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
        </li> --}}
        {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li> --}}

        {!! Form::open(['url' => route('logout'), 'method' => 'POST']) !!}
        {!! Form::submit('Sign off', ['class' => 'btn text-danger']) !!}
        {!! Form::close() !!}

        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <x-admin-sidebar></x-admin-sidebar>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@if (isset($barDetails)){{ $barDetails->name }}'s @endif {{ ucwords($title) }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ ucwords($title) }}</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-{{ date('Y') }} Remy Cointreau.</strong>
      All rights reserved.
      <p class="float-right powered-text">powered by
        <a href="https://froztech.com" target="_blank" class="text-dark">
          <img src="{{ asset('public/images/froztech_dark.png') }}" alt="froztech" class="froztech-logo">
        </a>
      </p>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <script src="{{ asset('public/js/moment.min.js') }}"></script>
  <script src="{{ asset('public/js/daterangepicker.js') }}"></script>
  <script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('public/js/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('public/js/select2.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery.repeater.min.js') }}"></script>
  <script src="{{ asset('public/js/summernote-bs4.min.js') }}"></script>
  {{-- <script src="{{ asset('public/js/toastr.min.js') }}"></script> --}}
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
  @if (request()->is('*dashboard'))
    <script src="{{ asset('public/js/dashboard3.js') }}"></script>
  @endif

  <script>
    $(function() {
      $('.select2').select2({
        theme: 'bootstrap4',
        escapeMarkup: function(markup) {
          return markup;
        }
      });

      $('#slug, #name').change((e) => {
        let slug = e.target.value.trim().toLowerCase();
        $('#slug').val(slug.trim().replaceAll(' ', '-'));
      });

      if($('table#price-repeater').length) {
        $(document).on('click', '#add-price', function(e) {
          console.log('added');
          e.preventDefault();
          $('table#price-repeater tbody').append('<tr><td>\
            <div class="form-group"><div class="input-group">\
              <input class="form-control" placeholder="Enter Quantity" required="" name="price[quantity][]" type="text" value="">\
            </div></div></td>\
            <td><div class="form-group"><div class="input-group">\
              <input class="form-control" placeholder="Enter Price" required="" autocomplete="off" name="price[price][]" type="text" value="">\
            </div></div></td>\
            <td><a href="javascript:void(0)" class="btn btn-secondary remove-price">-</a></td>\
          </tr>');
        });

        $(document).on('click', '.remove-price', function(e) {
          e.preventDefault();
          $(e.target).closest('tr').remove();
        });
      }

      var summernoteElement = $('textarea.summernote-description');
      if(summernoteElement.length) {
        summernoteElement.summernote({
            height: 300,
            width:'100%',
            callbacks: {
                onChange: function(contents, $editable) {
                    summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
                    // summernoteValidator.element(summernoteElement);
                }   
            }
        });

        var summernoteAdditionalElement = $('textarea#summernote-add-info');
        summernoteAdditionalElement.summernote({
            height: 300,
            callbacks: {
                onChange: function(contents, $editable) {
                    summernoteAdditionalElement.val(summernoteAdditionalElement.summernote('isEmpty') ? "" : contents);
                    // summernoteValidator.element(summernoteElement);
                }   
            }
        });
      }
    });
  </script>

  @if (Session::has('success'))
    <script>
      $(function() {
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          icon: 'success',
          title: "{{ Session::get('success') }}"
        })
      });
    </script>
  @endif
  @if (Session::has('error'))
    <script>
      $(function() {
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          icon: 'error',
          title: "{{ Session::get('error') }}"
        })
      });
    </script>
  @endif
  @yield('scripts')


</body>

</html>
