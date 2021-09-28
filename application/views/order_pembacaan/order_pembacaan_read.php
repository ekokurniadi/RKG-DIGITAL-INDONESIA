<div class="main-container" style="min-height:100%">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="title">
              <h4>Order Pembacaan</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Pembacaan</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="pd-20 card-box mb-30">
        <div class="clearfix">
          <div class="pull-left">
            <h4 class="text-blue h4">Form Order Pembacaan </h4>
            <p class="mb-30"></p>
          </div>
        </div>
        <form action="" method="post" class="form-horizontal">

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Id Order <?php echo form_error('id_order') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="id_order" id="id_order" placeholder="Id Order" value="<?php echo $id_order; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Id Client <?php echo form_error('id_client') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="id_client" id="id_client" placeholder="Id Client" value="<?php echo $id_client; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">No Rekam Medis <?php echo form_error('no_rekam_medis') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="no_rekam_medis" id="no_rekam_medis" placeholder="No Rekam Medis" value="<?php echo $no_rekam_medis; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Dokter Pengirim <?php echo form_error('dokter_pengirim') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="dokter_pengirim" id="dokter_pengirim" placeholder="Dokter Pengirim" value="<?php echo $dokter_pengirim; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
            <div class="col-sm-12 col-md-10">
              <textarea class="form-control" rows="3" readonly name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Foto <?php echo form_error('foto') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Indikasi Pemeriksaan <?php echo form_error('indikasi_pemeriksaan') ?></label>
            <div class="col-sm-12 col-md-10">
              <textarea class="form-control" rows="3" readonly name="indikasi_pemeriksaan" id="indikasi_pemeriksaan" placeholder="Indikasi Pemeriksaan"><?php echo $indikasi_pemeriksaan; ?></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Dokter Pemeriksa <?php echo form_error('dokter_pemeriksa') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="dokter_pemeriksa" id="dokter_pemeriksa" placeholder="Dokter Pemeriksa" value="<?php echo $dokter_pemeriksa; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Created At <?php echo form_error('created_at') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Id Pembaca <?php echo form_error('id_pembaca') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="id_pembaca" id="id_pembaca" placeholder="Id Pembaca" value="<?php echo $id_pembaca; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Status <?php echo form_error('status') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Tarif <?php echo form_error('tarif') ?></label>
            <div class="col-sm-12 col-md-10">
              <input type="text" class="form-control" readonly name="tarif" id="tarif" placeholder="Tarif" value="<?php echo $tarif; ?>" />
            </div>
          </div>


          <div class="card-footer text-left">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <a href="<?php echo site_url('order_pembacaan') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

        </form>
      </div>
    </div>
  </div>
</div>