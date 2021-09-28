<div class="main-container" style="min-height:100%">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="title">
              <h4>Revisi Order pembacaan</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Revisi Order pembacaan</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <!-- Simple Datatable start -->
      <div class="card-box mb-30">
        <div class="pd-20">
          <h4 class="text-dark h4"><i class="icon-copy dw dw-newspaper"></i> Revisi Order pembacaan</h4>
       
        </div>
        <div class="pb-20">
          <div class="table-responsive">
            <table class="data-table table hover nowrap" id="example1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Order</th>
                  <th>Revisi</th>
                  <th>Tanggal Revisi</th>
                </tr>
              </thead>
              <tbody align="left" style="text-align: left;"></tbody>
            </table>
            <script>
              $(document).ready(function() {
                dataTable = $('#example1').DataTable({
                  "processing": true,
                  "serverSide": true,
                  "scrollX": false,
                  "language": {
                    "infoFiltered": "",
                    "processing": "<td style='text-align:center;width:100%;display:block;'><i class='fa fa-spinner fa-spin' style='font-size:80px'></i> </td>",
                  },
                  "order": [],
                  "lengthMenu": [
                    [10, 25, 50, 75, 100],
                    [10, 25, 50, 75, 100]
                  ],
                  "ajax": {
                    url: "<?php echo site_url('order_pembacaan/fetch_data_revisi'); ?>",
                    type: "POST",
                    dataSrc: "data",
                    data: function(d) {
                      return d;
                    },
                  },
                  "columnDefs": [{
                    "targets": [0],
                    "className": 'text-center'
                  }, ],
                });
                dataTable.on('draw.dt', function() {
                  var info = dataTable.page.info();
                  dataTable.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                  }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start + ".";
                  });
                });
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

