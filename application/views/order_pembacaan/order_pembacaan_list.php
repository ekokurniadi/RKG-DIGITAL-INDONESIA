<div class="main-container" style="min-height:100%">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="title">
              <h4>Order pembacaan</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order pembacaan</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <!-- Simple Datatable start -->
      <div class="card-box mb-30">
        <div class="pd-20">
          <h4 class="text-dark h4"><i class="icon-copy dw dw-newspaper"></i> Order pembacaan</h4>
          <?php echo anchor(site_url('order_pembacaan/create'), '<i class="icon-copy dw dw-add-file-1"></i> Add New', 'class="btn btn-primary bg-dark"'); ?>
					<?php echo anchor(site_url('order_pembacaan/history'), ' History', 'class="btn btn-danger"'); ?>
				</div>
        <div class="pb-20">
          <div class="table-responsive">
            <table class="data-table table hover nowrap" id="example1">
              <thead>
                <tr>
                  <!-- <th>No</th> -->
                  <th>Order</th>
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
                    url: "<?php echo site_url('order_pembacaan/fetch_data'); ?>",
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
                    // cell.innerHTML = i + 1 + info.start + ".";
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

<?php $this->load->view('modal_upload') ?>
<?php $this->load->view('modal_revisi') ?>

<script>
  function open_modal(id) {

    $.ajax({
      url: '<?php echo base_url('order_pembacaan/upload_bukti/') ?>',
      type: 'POST',
      dataType: 'JSON',
      cache: false,
      data:{id:id},
      success: function(response) {
        $('[name="idOrder"]').val(response.data.id);
        $('#modalUploadFoto').modal('show');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('something when wrong');
      }
    });
  }

  function open_modalRevisi(id) {
    $.ajax({
      url: '<?php echo base_url('order_pembacaan/upload_bukti/') ?>' ,
      type: 'POST',
      dataType: 'JSON',
      cache: false,
      data:{id:id},
      success: function(response) {
        $('[name="id"]').val(response.data.id);
        $('[name="idOrder"]').val(response.data.idOrder);
        $('#modalRevisi').modal('show');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('something when wrong');
      }
    });
  }

  function getKota(id) {
    $.ajax({
      beforeSend: function() {
        $('#searchKota').attr('disabled', true);
        $('#searchKota').html('<i class="fa fa-spinner fa-spin">');
      },
      url: '<?= base_url('publics/getByIdKota') ?>',
      type: "POST",
      data: {
        id
      },
      cache: false,
      dataType: 'JSON',
      success: function(response) {
        if (response.status == 'sukses') {
          $('#kota_id').val(response.value.id);
          $('#kota').val(response.value.name);
        } else {
          alert(response.pesan);
        }
        $('#searchKota').attr('disabled', false);
        $('#searchKota').html('<i class="fa fa-search">');
      },
      error: function() {
        alert("Something Went Wrong !");
        $('#searchKota').attr('disabled', false);
        $('#searchKota').html('<i class="fa fa-search">');
      }
    });
  }
</script>
