<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/core.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendors/styles/style.css">
<div style="background-color: black !important;width:100%;padding:0">
    <div class="invoice-box">
        <div class="invoice-header">
            <div class="logo text-left" style="display: flex;">
                <img src="<?php echo base_url() ?>uploads/logo/LOGO.png" alt="" width="80px">
                <h5>RKG DIGITAL INDONESIA</h5>
            </div>
        </div>
        <h4 class="text-center mb-30 weight-600">INVOICE</h4>
        <div class="row pb-30">
            <div class="col-md-6">
                <h5 class="mb-15">Data Klien</h5>
                <p class="font-14 mb-5">Tanggal: <strong class="weight-600"><?=formatTanggal(substr($tanggal,0,10))?></strong></p>
                <p class="font-14 mb-5">No Order: <strong class="weight-600"><?=$id_order?></strong></p>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <p class="font-14 mb-5"><?=$nama?> </strong></p>
                    <p class="font-14 mb-5"><?=$alamat?></p>
                </div>
            </div>
        </div>
        <div class="invoice-desc pb-30">
            <div class="invoice-desc-head clearfix">
                <div class="invoice-sub">Deskripsi</div>
                <div class="invoice-rate">Tarif</div>
                <div class="invoice-rate">Tambahan</div>
                <div class="invoice-subtotal">Subtotal</div>
            </div>
            <div class="invoice-desc-body">
                <ul>
                    <li class="clearfix">
                        <div class="invoice-sub">Pembacaan Radiologi</div>
                        <div class="invoice-rate">Rp.<?php echo number_format($tarif,0,',','.') ?></div>
                        <div class="invoice-rate">Rp.<?php echo number_format($harga_tambahan,0,',','.') ?></div>
                        <div class="invoice-subtotal"><span class="weight-600" >Rp.<?php echo number_format($tarif+$harga_tambahan,0,',','.') ?></span></div>
                    </li>

                </ul>
            </div>
            <div class="invoice-desc-footer">
                <div class="invoice-desc-head clearfix">
                    <div class="invoice-sub">Bank Info</div>
                    <div class="invoice-subtotal">Total Tagihan</div>
                </div>
                <div class="invoice-desc-body">
                    <ul>
                        <li class="clearfix">
                            <div class="invoice-sub">
                                <p class="font-14 mb-5">Nama Bank: <strong class="weight-600"><?= $nama_bank ?></strong></p>
                                <p class="font-14 mb-5">No Rekening: <strong class="weight-600"><?= $no_rekening ?></strong></p>
                                <p class="font-14 mb-5">Atas Nama: <strong class="weight-600"><?= $atas_nama ?></strong></p>
                            </div>

                            <div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">Rp.<?php echo number_format($tarif+$harga_tambahan	,0,',','.') ?></span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h4 class="text-center pb-20">Thank You!!</h4>
    </div>
</div>
