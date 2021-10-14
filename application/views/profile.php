<div class="main-container" style="min-height:100%">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Form Profile </h4>
                        <p class="mb-30"></p>
                    </div>
                </div>
                <form action="<?php echo $action; ?>" method="post" class="form-horizontal">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama <?php echo form_error('nama') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Username <?php echo form_error('username') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" readonly class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Password <?php echo form_error('password') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Level <?php echo form_error('level') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" readonly class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" />
                        </div>
                    </div>


                    <div class="card-footer text-left">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
                        <a href="<?php echo site_url('panel') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

                </form>
            </div>
        </div>
    </div>
</div>
