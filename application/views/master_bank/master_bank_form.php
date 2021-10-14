
<div class="main-container" style="min-height:100%">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Master Bank</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Master Bank</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Form Master Bank </h4>
                        <p class="mb-30"></p>
                    </div>
                </div>
                <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama Bank <?php echo form_error('nama_bank') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama Bank" value="<?php echo $nama_bank; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nomor Rekening <?php echo form_error('nomor_rekening') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="nomor_rekening" id="nomor_rekening" placeholder="Nomor Rekening" value="<?php echo $nomor_rekening; ?>" />
                          </div>
                    </div>
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Atas Nama <?php echo form_error('atas_nama') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="atas_nama" id="atas_nama" placeholder="Atas Nama" value="<?php echo $atas_nama; ?>" />
                          </div>
                    </div>
	
            
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_bank') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
          </form>
          </div>
      </div>
  </div>
</div>
