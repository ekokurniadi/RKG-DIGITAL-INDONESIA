<div class="main-container" style="min-height: 100%;">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Dashboard</h2>
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"><?=$this->db->get_where('order_pembacaan',array('id_client'=>$_SESSION['id'],'status'=>6))->num_rows()?></div>
                            <div class="font-14 text-secondary weight-500">Selesai</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-calendar1"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"><?=$this->db->get_where('order_pembacaan',array('id_client'=>$_SESSION['id'],'status'=>4))->num_rows()?></div>
                            <div class="font-14 text-secondary weight-500">Revisi</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b"><span class="icon-copy ti-heart"></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"><?=$this->db->get_where('order_pembacaan',array('id_client'=>$_SESSION['id'],'status'=>0))->num_rows()?></div>
                            <div class="font-14 text-secondary weight-500">Menunggu Konfirmasi</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon"><i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark"><?=$this->db->get_where('order_pembacaan',array('id_client'=>$_SESSION['id'],'status_pembayaran'=>0))->num_rows()?></div>
                            <div class="font-14 text-secondary weight-500">Belum Dibayar</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06"><i class="icon-copy fa fa-money" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
