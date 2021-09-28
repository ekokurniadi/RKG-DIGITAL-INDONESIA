<style>
    label.error {
        color: red;
    }
</style>
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
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>panel">Home</a></li>
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
                <!-- <form method="post" action="<?= $action ?>" class="form-horizontal" enctype="multipart/form-data" id="form_"> -->

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Id Order <?php echo form_error('id_order') ?></label>
                    <div class="col-sm-12 col-md-10">
                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" readonly class="form-control" name="id_order" id="id_order" placeholder="Id Order" value="<?php echo $id_order; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">No Rekam Medis <?php echo form_error('no_rekam_medis') ?></label>
                    <div class="col-sm-12 col-md-10">
                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" placeholder="No Rekam Medis" value="<?php echo $no_rekam_medis; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Dokter Pengirim <?php echo form_error('dokter_pengirim') ?></label>
                    <div class="col-sm-12 col-md-10">
                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="dokter_pengirim" id="dokter_pengirim" placeholder="Dokter Pengirim" value="<?php echo $dokter_pengirim; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea readonly class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Lampiran(Foto/Video) <?php echo form_error('foto') ?></label>
                    <div class="col-sm-12 col-md-10">
                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
                    </div>
                    <?php if ($button == "Update" or $button == "Read") { ?>
                        <label class="col-sm-12 col-md-2 col-form-label">Preview <?php echo form_error('foto') ?></label>
                        <?php
                        $file_parts = pathinfo($foto);
                        if ($file_parts) {

                            if ($file_parts['extension'] == "jpg" || $file_parts['extension'] == "png" || $file_parts['extension'] == "PNG" || $file_parts['extension'] == "JPEG" || $file_parts['extension'] == "jpeg") { ?>
                                <div class="col-md-12 col-md-10">
                                    <img src="<?= base_url('uploads/user_image/' . $foto) ?>" width="100%" alt="">
                                </div>
                            <?php  } else { ?>
                                <div class="col-md-12 col-md-10">
                                    <video src="<?= base_url('uploads/user_image/' . $foto) ?>" width="100%" controls>
                                    </video>
                                </div>
                            <?php  } ?>
                        <?php } ?>
                    <?php } ?>
                </div>



                <div class="form-group row">
                    <input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-success btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="PEMERIKSAAN">
                </div>

                <div class="form-group row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="table-responsive">

                            <table style="vertical-align: text-top;border-collapse:collapse;padding:0px 2px 0px 2px;font-size:9pt" width="100%">
                                <tr>
                                    <td width="50%">
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="1" <?= $pemeriksaan == 1 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>3D CBCT</p>
                                        </label>
                                    </td>
                                    <td width="50%"><input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="2" <?= $pemeriksaan == 2 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>ANALISIS BONE DENSITY ALVEOLAR (HU)</p>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="3" <?= $pemeriksaan == 3 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>PANORAMIK</p>
                                        </label>
                                    </td>
                                    <td>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="4" <?= $pemeriksaan == 4 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>PERIAPIKAL</p>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="5" <?= $pemeriksaan == 5 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>TMJ</p>
                                        </label>
                                    </td>
                                    <td>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="6" <?= $pemeriksaan == 6 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>BITE-WING</p>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="7" <?= $pemeriksaan == 7 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>CHEPALOMETRI</p>
                                        </label>
                                    </td>
                                    <td>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="radio" name="pemeriksaan" value="8" <?= $pemeriksaan == 8 ? "checked" : "" ?>>
                                        <label for="">
                                            <p>OCCLUSAL</p>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $st = "";
                                    $st1 = "";
                                    $st2 = "";

                                    $detail = $this->db->query("SELECT detail from detail_pemeriksaan where no_order='$id_order'") ?>
                                    <?php if ($detail->num_rows() > 0) {
                                        foreach ($detail->result() as $row) {
                                            if ($row->detail == "PA") {
                                                $st = "checked";
                                            }
                                            if ($row->detail == "Lateral") {
                                                $st1 = "checked";
                                            }
                                            if ($row->detail == "Waters") {
                                                $st2 = "checked";
                                            }
                                        }
                                    } ?>
                                    <td colspan="2">&nbsp;
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" name="detail[]" value="PA" <?= $st ?>>
                                        <label for="">
                                            <p>PA</p>
                                        </label>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" name="detail[]" value="Lateral" <?= $st1 ?>>
                                        <label for="">
                                            <p>Lateral</p>
                                        </label>
                                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" name="detail[]" value="Waters" <?= $st2 ?>>
                                        <label for="">
                                            <p>Waters</p>
                                        </label>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2"><input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="catatan" value="<?= $catatan ?>" id="catatan" placeholder="Catatan"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-success btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="REGIO">
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table width="100%">
                                <tr>
                                    <?php
                                    $kiri = $this->db->query("SELECT * from regio_kiri_atas order by id DESC")->result() ?>


                                    <?php foreach ($kiri as $ka) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $ka->id && $rows->lokasi == 1) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td style="border-bottom: 2px solid green;">
                                            <?php echo $ka->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="kiri_atas[]">
                                        </td>
                                    <?php endforeach; ?>
                                    <td width="20px" rowspan="2" align="center">
                                        <div style="background-color: green;width:2px">&nbsp;</div>
                                    </td>
                                    <?php
                                    $kanan = $this->db->query("SELECT * from regio_kanan_atas order by id ASC")->result() ?>

                                    <?php foreach ($kanan as $kn) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $kn->id && $rows->lokasi == 2) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td style="border-bottom: 2px solid green;">
                                            <?php echo $kn->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="kanan_atas[]">
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <?php
                                    $kiri = $this->db->query("SELECT * from regio_kiri_bawah order by id DESC")->result() ?>
                                    <?php foreach ($kiri as $ka) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $ka->id && $rows->lokasi == 3) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td>
                                            <?php echo $ka->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="kiri_bawah[]">
                                        </td>
                                    <?php endforeach; ?>
                                    <!-- <td width="5px" rowspan="2" align="left"><div style="background-color: green;width:2px">&nbsp;</div></td> -->
                                    <?php
                                    $kanan = $this->db->query("SELECT * from regio_kanan_bawah order by id ASC")->result() ?>
                                    <?php foreach ($kanan as $kn) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $kn->id && $rows->lokasi == 4) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td>
                                            <?php echo $kn->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="kanan_bawah[]">
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-block">
                    <hr style="border: 1px solid gray">
                </div>
                <!-- Romawi -->
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="table-responsive d-flex justify-content-center">
                            <table width="90%">
                                <tr>
                                    <?php
                                    $kiri = $this->db->query("SELECT * from regio_romawi_kiri_atas order by id DESC")->result() ?>


                                    <?php foreach ($kiri as $ka) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $ka->id && $rows->lokasi == 5) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td style="border-bottom: 2px solid green;">
                                            <?php echo $ka->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="romawi_kiri_atas[]">
                                        </td>
                                    <?php endforeach; ?>
                                    <td width="20px" rowspan="2" align="center">
                                        <div style="background-color: green;width:2px">&nbsp;</div>
                                    </td>
                                    <?php
                                    $kanan = $this->db->query("SELECT * from regio_romawi_kanan_atas order by id ASC")->result() ?>

                                    <?php foreach ($kanan as $kn) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $kn->id && $rows->lokasi == 6) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td style="border-bottom: 2px solid green;">
                                            <?php echo $kn->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="romawi_kanan_atas[]">
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <?php
                                    $kiri = $this->db->query("SELECT * from regio_romawi_kiri_bawah order by id DESC")->result() ?>
                                    <?php foreach ($kiri as $ka) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $ka->id && $rows->lokasi == 7) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td>
                                            <?php echo $ka->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $ka->id ?>" name="romawi_kiri_bawah[]">
                                        </td>
                                    <?php endforeach; ?>
                                    <!-- <td width="5px" rowspan="2" align="left"><div style="background-color: green;width:2px">&nbsp;</div></td> -->
                                    <?php
                                    $kanan = $this->db->query("SELECT * from regio_romawi_kanan_bawah order by id ASC")->result() ?>
                                    <?php foreach ($kanan as $kn) : ?>
                                        <?php $state = "";
                                        $cekKiriAtas = $this->db->get_where('detail_regio_angka', array('id_order' => $id_order));
                                        if ($cekKiriAtas->num_rows() > 0) {
                                            foreach ($cekKiriAtas->result() as $rows) {
                                                if ($rows->angka == $kn->id && $rows->lokasi == 8) {
                                                    $state = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <td>
                                            <?php echo $kn->angka ?>
                                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="checkbox" <?= $state ?> value="<?php echo $kn->id ?>" name="romawi_kanan_bawah[]">
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Dokter Pemeriksa <?php echo form_error('dokter_pemeriksa') ?></label>
                    <div class="col-sm-12 col-md-10">
                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="dokter_pemeriksa" id="dokter_pemeriksa" placeholder="Dokter Pemeriksa" value="<?php echo $dokter_pemeriksa; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Indikasi Pemeriksaan <?php echo form_error('indikasi_pemeriksaan') ?></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea readonly class="form-control" rows="3" name="indikasi_pemeriksaan" id="indikasi_pemeriksaan" placeholder="Indikasi Pemeriksaan"><?php echo $indikasi_pemeriksaan; ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-info btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="Form Pembacaan">
                </div>
                <form method="POST" id="form_" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama Pasien <?php echo form_error('dokter_pengirim') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Dokter Pengirim" value="<?php echo $this->db->get_where('users', array('id' => $id_client))->row()->nama; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Umur <?php echo form_error('dokter_pengirim') ?></label>
                        <?php
                        $level = $_SESSION['level'];
                        date_default_timezone_set('Asia/Jakarta');
                        $dt = $this->db->get_where('users', array('id' => $id_client))->row();
                        $date = new DateTime('today');
                        $tgl_lahir = new DateTime($dt->tanggal_lahir);
                        $umur = $date->diff($tgl_lahir)->y; ?>
                        <div class="col-sm-12 col-md-10">
                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="umur" id="umur" placeholder="Dokter Pengirim" value="<?php echo $umur ?> Tahun" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin <?php echo form_error('dokter_pengirim') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Dokter Pengirim" value="<?php echo $dt->jenis_kelamin ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Alamat <?php echo form_error('dokter_pengirim') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input <?= $button == 'Read' ? 'readonly' : "" ?> type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Dokter Pengirim" value="<?php echo $dt->alamat ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-info btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="Jenis Radiograf">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Intra Oral <?php echo form_error('dokter_pengirim') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" readonly class="form-control" <?= $level == "Client" ? "readonly" : "" ?> required name="intra_oral" id="intra_oral" placeholder="Intra Oral" value="<?php echo $intra_oral ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Elemen Gigi <?php echo form_error('dokter_pengirim') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" readonly class="form-control" <?= $level == "Client" ? "readonly" : "" ?> required name="elemen_gigi" id="elemen_gigi" placeholder="Elemen gigi" value="<?php echo $elemen_gigi ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <input <?= $button == 'Read' ? 'readonly' : "" ?> type="button" class="btn btn-info btn-block col-sm-12 col-md-12 col-form-label" style="text-align:left" value="Interpretasi">
                    </div>
                    <?php $detail = $this->db->get_where('detail_pembacaan', array('id_order' => $id_order))->result() ?>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="20px">No</th>
                                            <th>Elemen</th>
                                            <th>Keterangan</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(js, index) of details">
                                            <td class="text-center">{{index+1}}</td>
                                            <td>{{js.elemen}}</td>
                                            <td>
                                                {{js.keterangan}}
                                            </td>

                                            <!-- <td align="center" v-if="mode=='update'|| mode=='create'"> -->
                                                <!-- <?php if ($_SESSION['level'] != "Client") { ?>
                                                    <button @click.prevent="delDetails(index)" type="button" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i></button>
                                                <?php } ?> -->
                                            <!-- </td>
                                        </tr> -->
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Suspek Radiodiagnosis <?php echo form_error('dokter_pengirim') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" readonly class="form-control" <?= $level == "Client" ? "readonly" : "" ?> name="suspek" id="suspek" required placeholder="Suspek Radiodiagnosis" value="<?php echo $suspek ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Harga Pembacaan <?php echo form_error('dokter_pengirim') ?></label>
                        <div class="col-sm-12 col-md-10">
                            <select name="harga_pembacaan" readonly <?= $level == "Client" ? "readonly" : "" ?> id="harga_pembacaan" class="form-control">
                                <option value="<?= $tarif ?>"><?= $tarif == 0 ? "Choose an option" : number_format($tarif, 0, ',', '.') ?></option>
                                <?php foreach ($this->db->get_where('master_harga_pembaca', array('id_pembaca' => $_SESSION['id']))->result() as $rows) : ?>
                                    <option value="<?= $rows->harga ?>"><?= number_format($rows->harga, 0, ',', '.') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                    <input type="hidden" name="id_client" id="id_client" value="<?php echo $id_client; ?>" />
                </form>

                <div class="text-left">
                    <?php if ($button != "Read") : ?>
                        <button type="submit" id="btnSubmit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
                    <?php endif; ?>
                    <?php if ($level == "Pembaca Gambar") { ?>
                        <!-- <button type="submit" id="btnSave" class="btn btn-icon icon-left btn-primary">Simpan Form Pembacaan</button> -->
                        <a href="<?php echo site_url('orders/history') ?>" class="btn btn-icon icon-left btn-danger">Cancel</a>
                    <?php } else { ?>
                        <a href="<?php echo site_url('order_pembacaan') ?>" class="btn btn-icon icon-left btn-danger">Cancel</a>
                    <?php } ?>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        var form_ = new Vue({
            el: '#form_',
            data: {
                mode: '<?= $mode ?>',
                detail: {
                    elemen: '',
                    keterangan: '',
                },
                details: <?= isset($detail) ? json_encode($detail) : '[]' ?>,
            },
            methods: {
                clearDetail: function() {
                    this.detail = {}
                },
                addDetail: function() {
                    if (this.detail.elemen === '' || this.detail.keterangan === '') {
                        alert('mohon isi elemen dan keterangan dengan lengkap');
                        return false;
                    } else {
                        this.details.push(this.detail);
                        this.clearDetail();
                    }
                },
                delDetails: function(index) {
                    this.details.splice(index, 1);
                },
            }
        });
    </script>

    <script>
        $(':checkbox[readonly]').click(function() {
            return false;
        });
        $(':radio[readonly]').click(function() {
            return false;
        });
    </script>
    <script>
        $('#btnSave').click(function() {
            $('#form_').validate({
                rules: {
                    'checkbox': {
                        required: true
                    }
                },
                highlight: function(input) {
                    $(input).parents('label').addClass('has-error');
                },
                unhighlight: function(input) {
                    $(input).parents('.validation').removeClass('has-error');
                }
            })
            var values = {
                details: form_.details,
                idOrder: $('#id_order').val(),
            }
            var form_user_profile = $('#form_').serializeArray();
            var form = $('#form_');
            for (field of form_user_profile) {
                values[field.name] = field.value;
            }

            if (form.valid()) {

                $.ajax({
                    beforeSend: function() {
                        $('#btnSave').attr('disabled', true);
                        $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i> Process');
                    },
                    url: '<?php echo base_url('orders/save') ?>',
                    type: 'POST',
                    data: values,
                    cache: false,
                    dataType: 'JSON',
                    success: function(response) {
                        $('#btnSave').html('<i class="fa fa-save"></i> Simpan Form Pembacaan');
                        $('#btnSave').attr('disabled', false);
                        if (response.status == 'sukses') {
                            window.location = response.link;
                        } else {
                            $('#btnSave').attr('disabled', false);
                            alert(response.pesan);
                        }
                    },
                    error: function() {
                        alert("Gagal");
                        $('#btnSave').attr('disabled', false);
                    }
                });

            } else {
                validationError();

            }
        });
    </script>