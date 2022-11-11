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
                             placeholder="Select the date">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

              </div>
              <a href="javascript:;" class="clearFilter" style="display:none;" onclick="clearFilter()">clear filter</a>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
              <table id="enquiry-table" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Name of the restaurant</th>
                    <th>Status</th>
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
  <script>
    $(function() {
      $('#reservation').daterangepicker();
      $("#reservation").val('');

      var dataTable = $('#enquiry-table').DataTable({
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
            sheetName: 'Consulta',
            exportOptions: {
              columns: [1, 2, 3, 4],
              modifier: {
                search: 'applied',
                order: 'applied'
              }
            },
          },
          {
            extend: 'csvHtml5',
            sheetName: 'Consulta',
            exportOptions: {
              columns: [1, 2, 3, 4]
            }
          },
          'colvis'
        ],
        ajax: {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "<?php echo route('enquiry.getEnquiries'); ?>",
          data: function(d) {
            d.date = $('#reservation').val()
              // d.role_id = $('#role_id').val(),
              // d.approved = $("#status").val(),
              // d.bar = $("#bar").val()
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
          },
          {
            data: 'email',
            name: 'email',
          },
          {
            data: 'phone',
            name: 'phone',
          },          
          {
            data:'bar_name',
            name:'bar_name',
          },
          {
            data: 'status',
            name: 'status',
          },
          {
            data:'actions',
            name: 'actions',
            sortable:false,
            searchable:false,
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
      $('#enquiry-table').DataTable().draw();
      $('.clearFilter').css('display','none');
    }

    $(document).on('change', 'form.status-update', (e) => {
      let form = $(e.target).closest('form');
      let url = form.attr('action');
      let data = form.serializeArray();

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "PUT",
        url: url,
        data: {
          _method: 'PUT',
          status: data[0].value,
        },
        dataType: "json",
        success: function(response) {
          Swal.fire({
            title: 'Status Updated!',
            text: "Status has been Updated.",
            icon: 'success',
          }).then((result) => {
            $('#enquiry-table').DataTable().draw();
          });
        }
      });
    });

  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/enquiry/index.blade.php ENDPATH**/ ?>