<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_pembacaan extends MY_Controller
{



    function __construct()
    {
        parent::__construct();
        $this->load->model('Order_pembacaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $order_pembacaan = $this->Order_pembacaan_model->get_all();

        $data = array(
            'order_pembacaan_data' => $order_pembacaan
        );
        $this->load->view('client/header');
        $this->load->view('order_pembacaan/order_pembacaan_list', $data);
        $this->load->view('client/footer');
    }

    public function ajukan($id)
    {
        $this->db->where('id', $id);
        $update = $this->db->update('order_pembacaan', array('status' => 0));

        $data = array(
            "pesan" => $_SESSION['nama'] . " Mengajukan order pembacaan gambar.",
            "status" => 0,
            "created_at" => date('Y-m-d H:i:s'),
            "deleted" => 0,
            "link" => "orders/detail/",
            "id_user" => 0,
        );

        if ($update) {
            $insert = $this->db->insert('notifikasi', $data);
            $_SESSION['pesan'] = "Order anda berhasil di ajukan";
            $_SESSION['tipe'] = "success";
            redirect(site_url('order_pembacaan'));
        } else {
            $_SESSION['pesan'] = "Terjadi kesalahan, mohon coba kembali";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }
    public function complete($id)
    {
        $this->db->where('id', $id);
        // complete order
        $update = $this->db->update('order_pembacaan', array('status' => 6));
        $row = $this->Order_pembacaan_model->get_by_id($id);
        $data = array(
            "pesan" => $_SESSION['nama'] . " sudah menyelesaikan order pembacaan gambar.",
            "status" => 0,
            "created_at" => date('Y-m-d H:i:s'),
            "deleted" => 0,
            "link" => "#",
            "id_user" => $row->id_pembaca,
        );

        if ($update) {
            $insert = $this->db->insert('notifikasi', $data);
            $_SESSION['pesan'] = "Order anda berhasil di selesaikan";
            $_SESSION['tipe'] = "success";
            redirect(site_url('order_pembacaan'));
        } else {
            $_SESSION['pesan'] = "Terjadi kesalahan, mohon coba kembali";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }

    public function view_hasil($id)
    {
        $row = $this->Order_pembacaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Read',
                'mode' => 'update',
                'action' => site_url('order_pembacaan/update_action'),
                'id' => set_value('id', $row->id),
                'id_order' => set_value('id_order', $row->id_order),
                'id_client' => set_value('id_client', $row->id_client),
                'no_rekam_medis' => set_value('no_rekam_medis', $row->no_rekam_medis),
                'dokter_pengirim' => set_value('dokter_pengirim', $row->dokter_pengirim),
                'alamat' => set_value('alamat', $row->alamat),
                'pemeriksaan' => set_value('pemeriksaan', $row->pemeriksaan),
                'catatan' => set_value('catatan', $row->catatan_pemeriksaan),
                'foto' => set_value('foto', $row->foto),
                'indikasi_pemeriksaan' => set_value('indikasi_pemeriksaan', $row->indikasi_pemeriksaan),
                'dokter_pemeriksa' => set_value('dokter_pemeriksa', $row->dokter_pemeriksa),
                'created_at' => set_value('created_at', $row->created_at),
                'id_pembaca' => set_value('id_pembaca', $row->id_pembaca),
                'status' => set_value('status', $row->status),
                'intra_oral' => set_value('intra_oral', $row->intra_oral),
                'elemen_gigi' => set_value('elemen_gigi', $row->elemen_gigi),
                'suspek' => set_value('suspek', $row->suspek),
                'tarif' => set_value('tarif', $row->tarif),
            );
            $this->load->view('client/header');
            $this->load->view('order_pembacaan/order_pembacaan_form_pembaca', $data);
            $this->load->view('client/footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }

    public function fetch_data()
    {
        $id = $_SESSION['id'];
        $starts       = $this->input->post("start");
        $length       = $this->input->post("length");
        $LIMIT        = "LIMIT $starts, $length ";
        $draw         = $this->input->post("draw");
        $search       = $this->input->post("search")["value"];
        $orders       = isset($_POST["order"]) ? $_POST["order"] : '';

        $where = "WHERE 1=1 and id_client='$id' ";
        $where2 = "WHERE 1=1 and id_client='$id' ";
        $result = array();
        if (isset($search)) {
            if ($search != '') {
                $where .= " AND (id_order LIKE '%$search%' OR
	                        id_client LIKE '%$search%' OR
	                        no_rekam_medis LIKE '%$search%' OR
	                        dokter_pengirim LIKE '%$search%' OR
	                        alamat LIKE '%$search%' OR
	                        foto LIKE '%$search%' OR
	                        indikasi_pemeriksaan LIKE '%$search%' OR
	                        dokter_pemeriksa LIKE '%$search%' OR
	                        created_at LIKE '%$search%' OR
	                        id_pembaca LIKE '%$search%' OR
	                        status LIKE '%$search%' OR
	                        tarif LIKE '%$search%')";
            }
        }

        if (isset($orders)) {
            if ($orders != '') {
                $order = $orders;
                $order_column = ['id_order', 'id_client', 'no_rekam_medis', 'dokter_pengirim', 'alamat', 'foto', 'indikasi_pemeriksaan', 'dokter_pemeriksa', 'created_at', 'id_pembaca', 'status', 'tarif',];
                $order_clm  = $order_column[$order[0]['column']];
                $order_by   = $order[0]['dir'];
                $where .= " ORDER BY $order_clm $order_by ";
            } else {
                $where .= " ORDER BY id ASC ";
            }
        } else {
            $where .= " ORDER BY id ASC ";
        }
        if (isset($LIMIT)) {
            if ($LIMIT != '') {
                $where .= ' ' . $LIMIT;
            }
        }
        $index = 1;
        $button = "";
        $fetch = $this->db->query("SELECT * from order_pembacaan $where");
        $fetch2 = $this->db->query("SELECT * from order_pembacaan $where2");
        foreach ($fetch->result() as $rows) {

            $button1 = "<a href=" . base_url('order_pembacaan/update2/' . $rows->id) . " data-color='white' class='btn btn-light bg-dark btn-flat btn-sm' style='color: white;'> View</a>";
            $button2 = "<a href=" . base_url('order_pembacaan/update/' . $rows->id) . " data-color='white' class='btn btn-warning btn-flat btn-sm' style='color: dark;'>Edit</a>";
            $button3 = "<a href=" . base_url('order_pembacaan/cetak/' . $rows->id) . " data-color='white' class='btn btn-danger btn-flat btn-sm' style='color: white;' target='_blank'>Download</a>";
            $button4 = "<a href=" . base_url('order_pembacaan/ajukan/' . $rows->id) . " data-color='white' class='btn btn-danger btn-flat btn-sm' style='color: white;'>Ajukan</a>";
            $button5 = "<button type='button' onclick='open_modalRevisi(" . $rows->id . ")' data-color='white' class='btn btn-info btn-flat btn-sm' style='color: white;'>Ajukan Revisi</button>";
            $button7 = "<a href=" . base_url('order_pembacaan/view_hasil/' . $rows->id) . " data-color='white' class='btn btn-warning btn-flat btn-sm' style='color: white;'>Lihat Hasil</a>";
            $button8 = "<a href=" . base_url('order_pembacaan/view_invoice/' . $rows->id) . " data-color='white' class='btn btn-success btn-flat btn-sm' style='color: white;'>Invoice</a>";
            $button9 = "<a href=" . base_url('order_pembacaan/complete/' . $rows->id) . " data-color='white' class='btn btn-primary btn-flat btn-sm' onclick='javascript: return confirm(\"Are You Sure ?\")' style='color: white;'>Selesaikan Order</a>";
            $button6 = "<button type='button' onclick='open_modal(" . $rows->id . ")' data-color='white' class='btn btn-info btn-flat btn-sm' style='color: white;'>Upload Bukti Pembayaran</button>";
            if ($rows->status == 10) {
                $button = $button1 . " " . $button2 . " " . $button4 . " " . $button3;
            } elseif ($rows->status == 0) {
                $button = $button1 . " " . $button3;
            } elseif ($rows->status == 3 and $rows->status_pembayaran == 0) {
                $button = $button1 . " " . $button6 . " " . $button7 . " " . $button8 . " " . $button3;
            } elseif ($rows->status == 4) {
                $button = $button1 . " " . $button7 . " " . $button8 . " " . $button3;
            } elseif ($rows->status == 3 and $rows->status_pembayaran == 1) {
                $button = $button1 . " " . $button5 . " " . $button7 . "<br> " . $button8 . " " . $button3 . " " . $button9;
            } elseif ($rows->status == 1) {
                $button = $button1 . " " . $button3;
            }
            $sub_array = array();
            // $sub_array[] = $index;
            // $sub_array[] = $rows->id_order;
            // // $sub_array[] = $rows->id_client;
            // $sub_array[] = $rows->no_rekam_medis;
            // // $sub_array[] = $rows->dokter_pengirim;
            // // $sub_array[] = $rows->alamat;
            // // $sub_array[] = $rows->foto;
            // // $sub_array[] = $rows->indikasi_pemeriksaan;
            // // $sub_array[] = $rows->dokter_pemeriksa;
            // $sub_array[] = $rows->created_at;
            // // $sub_array[] = $rows->id_pembaca;
            // $sub_array[] = $rows->status;
            // $sub_array[] = $rows->tarif;
            $pembaca =  $rows->id_pembaca == 0 ? 'Belum ditentukan oleh admin' : $this->db->get_where('users', array('id' => $rows->id_pembaca))->row()->nama;
            $status = "";
            if ($rows->status == 0) {
                $status = "Menunggu Konfirmasi";
            } elseif ($rows->status == 1) {
                $status = "Proses";
            } elseif ($rows->status == 2) {
                $status = "Dalam Pengerjaan";
            } elseif ($rows->status == 3) {
                $status = "Selesai Pengerjaan";
            } elseif ($rows->status == 4) {
                $status = "Pengajuan Revisi";
            } elseif ($rows->status == 10) {
                $status = "Draft";
            } else {
                $status = "Selesai";
            }
            $status_pembayaran = "";
            if ($rows->status_pembayaran == 0) {
                $status_pembayaran = "Belum dibayar";
            } else {
                $status_pembayaran = "Sudah dibayar";
            }
            $infoPembayaran = "
            <div class='col-md-12 col-sm-6 col-xs-6 mt-2'>
                <span class='badge bg-info text-white'>Status Pembayaran : " . $status_pembayaran . "</span>
            </div>";
            // $notif = "";
            // if ($rows->status == 3 && $rows->status_pembayaran == 1) {
            //     $notif = $infoPembayaran;
            // }elseif($rows->status == 3 && $rows->status_pembayaran == 0){

            // }
            if ($rows->no_rekening == "" || $rows->no_rekening == NULL) {
                $nama_bank = " - ";
                $atas_nama = " - ";
                $no_rek = " - ";
            } else {
                $nama_bank = $rows->nama_bank;
                $atas_nama = $rows->atas_nama;
                $no_rek = $rows->no_rekening;
            }
            $sub_array[] = "<div class='row' style='text-align:left  !important'>
            <div class='col-md-12' style='font-weight:bold;'>" .
                "<i class='icon-copy dw dw-name' style='font-size:20px'></i> Order ID : " . $rows->id_order
                . "</div>
                <div class='col-md-12'><i class='icon-copy dw dw-agenda1' style='font-size:20px'></i> No.Rekam Medis : " . $rows->no_rekam_medis . "</div>
               
                <div class='col-md-12'><i class='icon-copy dw dw-calendar-1' style='font-size:20px'></i> Tanggal Order : " . tgl_indo(substr($rows->created_at, 0, 10)) . "</div>
                <div class='col-md-12'><i class='icon-copy dw dw-money-2' style='font-size:20px'></i> Tarif : <span class='badge badge-md bg-danger text-white' style='font-size:15px'>Rp. " . number_format($rows->tarif, 0, ',', '.') . "</span></div>
                <div class='col-md-12'><i class='icon-copy dw dw-house-11' style='font-size:18px'></i> Nama Bank : " . $nama_bank . "</div>
                <div class='col-md-12'><i class='icon-copy dw dw-agenda' style='font-size:18px'></i> Atas Nama : " . $atas_nama . "</div>
                <div class='col-md-12'><i class='icon-copy dw dw-wallet-1' style='font-size:18px'></i> No Rekening : " . $no_rek . "</div>
                <div class='col-md-12'><i class='icon-copy dw dw-user1' style='font-size:18px'></i> Pembaca : " . $pembaca . "</div>
                <div class='col-md-12 col-xs-6 col-sm-6'><i class='icon-copy dw dw-syringe' style='font-size:20px'></i> Indikasi : " . $rows->indikasi_pemeriksaan . "</div>
                <div class='col-md-12'>&nbsp;</div>
                <div class='col-md-12 col-sm-6 col-xs-6'>
                    <span class='badge bg-success text-white'>Status Order : " . $status . "</span>
                </div>
              " . $infoPembayaran . "
                <div class='col-md-12'>&nbsp;</div>
                    <div class='col-md-12'>
                   
                    " . $button . "
                   
                    </div>
            </div>";

            // $sub_array[] = '<div class="table-actions">' . $button1 . " " . $button2 . " " . $button3 . '</div>';
            $result[]      = $sub_array;
            $index++;
        }
        $output = array(
            "draw"            =>     intval($this->input->post("draw")),
            "recordsFiltered" =>     $fetch2->num_rows(),
            "data"            =>     $result,

        );
        echo json_encode($output);
    }

    public function view_invoice($id)
    {
        $row = $this->Order_pembacaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Read',
                'mode' => 'update',
                'action' => site_url('order_pembacaan/update_action'),
                'id' => set_value('id', $row->id),
                'id_order' => set_value('id_order', $row->id_order),
                'id_client' => set_value('id_client', $row->id_client),
                'no_rekam_medis' => set_value('no_rekam_medis', $row->no_rekam_medis),
                'dokter_pengirim' => set_value('dokter_pengirim', $row->dokter_pengirim),
                'alamat' => set_value('alamat', $row->alamat),
                'pemeriksaan' => set_value('pemeriksaan', $row->pemeriksaan),
                'catatan' => set_value('catatan', $row->catatan_pemeriksaan),
                'foto' => set_value('foto', $row->foto),
                'indikasi_pemeriksaan' => set_value('indikasi_pemeriksaan', $row->indikasi_pemeriksaan),
                'dokter_pemeriksa' => set_value('dokter_pemeriksa', $row->dokter_pemeriksa),
                'created_at' => set_value('created_at', $row->created_at),
                'id_pembaca' => set_value('id_pembaca', $row->id_pembaca),
                'status' => set_value('status', $row->status),
                'intra_oral' => set_value('intra_oral', $row->intra_oral),
                'elemen_gigi' => set_value('elemen_gigi', $row->elemen_gigi),
                'suspek' => set_value('suspek', $row->suspek),
                'tarif' => set_value('tarif', $row->tarif),
                'nama_bank' => set_value('nama_bank', $row->nama_bank),
                'no_rekening' => set_value('no_rekening', $row->no_rekening),
                'atas_nama' => set_value('atas_nama', $row->atas_nama),
                'tanggal' => set_value('tanggal', $row->created_at),
                'nama' => $this->db->get_where('users', array('id' => $row->id_client))->row()->nama,
                'alamat' => $this->db->get_where('users', array('id' => $row->id_client))->row()->alamat,
            );
            $this->load->library('pdf');
            $mpdf                           = $this->pdf->load();
            $mpdf->allow_charset_conversion = true;  // Set by default to TRUE
            $mpdf->charset_in               = 'UTF-8';
            $mpdf->autoLangToFont           = true;
            $mpdf->AddPage('P');
            $html = $this->load->view('invoice', $data, true);
            $mpdf->WriteHTML($html);
            $output = 'Invoice Pembacaan Gambar' . '.pdf';
            $mpdf->Output("$output", 'I');
            // $this->load->view('client/header');
            // $this->load->view('invoice', $data);
            // $this->load->view('client/footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }

    public function cetak($id)
    {
        $row = $this->Order_pembacaan_model->get_by_id($id);
        date_default_timezone_set('Asia/Jakarta');
        $dt = $this->db->get_where('users', array('id' => $row->id_client))->row();
        $date = new DateTime('today');
        $tgl_lahir = new DateTime($dt->tanggal_lahir);
        $umur = $date->diff($tgl_lahir)->y;
        $data = array(
            'button' => 'Read',
            'mode' => 'update',
            'action' => site_url('order_pembacaan/update_action'),
            'id' => set_value('id', $row->id),
            'id_order' => set_value('id_order', $row->id_order),
            'id_client' => set_value('id_client', $row->id_client),
            'no_rekam_medis' => set_value('no_rekam_medis', $row->no_rekam_medis),
            'dokter_pengirim' => set_value('dokter_pengirim', $row->dokter_pengirim),
            'alamat' => set_value('alamat', $row->alamat),
            'pemeriksaan' => set_value('pemeriksaan', $row->pemeriksaan),
            'catatan' => set_value('catatan', $row->catatan_pemeriksaan),
            'foto' => set_value('foto', $row->foto),
            'indikasi_pemeriksaan' => set_value('indikasi_pemeriksaan', $row->indikasi_pemeriksaan),
            'dokter_pemeriksa' => set_value('dokter_pemeriksa', $row->dokter_pemeriksa),
            'created_at' => set_value('created_at', $row->created_at),
            'id_pembaca' => set_value('id_pembaca', $row->id_pembaca),
            'status' => set_value('status', $row->status),
            'intra_oral' => set_value('intra_oral', $row->intra_oral),
            'elemen_gigi' => set_value('elemen_gigi', $row->elemen_gigi),
            'suspek' => set_value('suspek', $row->suspek),
            'tarif' => set_value('tarif', $row->tarif),
            'nama_bank' => set_value('nama_bank', $row->nama_bank),
            'no_rekening' => set_value('no_rekening', $row->no_rekening),
            'atas_nama' => set_value('atas_nama', $row->atas_nama),
            'tanggal' => set_value('tanggal', $row->created_at),
            'nama' => $this->db->get_where('users', array('id' => $row->id_client))->row()->nama,
            'alamat' => $this->db->get_where('users', array('id' => $row->id_client))->row()->alamat,
            'tempat' => $this->db->get_where('users', array('id' => $row->id_client))->row()->tempat,
            'tanggal' => $this->db->get_where('users', array('id' => $row->id_client))->row()->tanggal_lahir,
            'jk' => $this->db->get_where('users', array('id' => $row->id_client))->row()->jenis_kelamin,
            'tlp' => $this->db->get_where('users', array('id' => $row->id_client))->row()->telepon,
            'umur' => $umur,

        );
        $this->load->library('pdf');
        $mpdf                           = $this->pdf->load();
        $mpdf->allow_charset_conversion = false;  // Set by default to TRUE
        $mpdf->charset_in               = 'UTF-8';
        $mpdf->autoLangToFont           = true;
        $mpdf->AddPage('P');
        $mpdf = new mPDF(
            '',    // mode - default ''
            '',    // format - A4, for example, default ''
            0,     // font size - default 0
            '',    // default font family
            0,    // margin_left
            0,    // margin right
            0,     // margin top
            0,    // margin bottom
            0,     // margin header
            0,     // margin footer
            'P'
        );
        $mpdf->SetDisplayMode('fullwidth');
        $stylesheet = file_get_contents(base_url('assets/styles.css'), true);

        $html = $this->load->view('client/cetak_order', $data, true);
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html);
        $output = 'Form Order Pembacaan Gambar' . '.pdf';
        $mpdf->Output("$output", 'I');
    }

    public function uploadFotoAction()
    {
        if (upload_gambar_biasa('foto_profil', 'uploads/user_image/', 'jpeg|png|jpg|gif|svg|SVG', 10000, 'foto_profil')) {
            $this->db->where('id', $_POST['id']);
            $this->db->update('order_pembacaan', array('status_pembayaran' => 1, 'bukti_pembayaran' => upload_gambar_biasa('foto_profil', 'uploads/user_image/', 'jpeg|png|jpg|gif|svg|SVG', 10000, 'foto_profil')));
            echo json_encode(array(
                "status" => 200,
                "data" => base_url() . "uploads/user_image/" . upload_gambar_biasa('foto_profil', 'image/', 'jpeg|png|jpg|gif|svg|SVG', 10000, 'foto_profil')
            ));
        } else {
            echo json_encode(array(
                "status" => 500,
                "pesan" => "Gagal"
            ));
        }
    }

    public function read($id)
    {
        $row = $this->Order_pembacaan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_order' => $row->id_order,
                'id_client' => $row->id_client,
                'no_rekam_medis' => $row->no_rekam_medis,
                'dokter_pengirim' => $row->dokter_pengirim,
                'alamat' => $row->alamat,
                'foto' => $row->foto,
                'indikasi_pemeriksaan' => $row->indikasi_pemeriksaan,
                'dokter_pemeriksa' => $row->dokter_pemeriksa,
                'created_at' => $row->created_at,
                'id_pembaca' => $row->id_pembaca,
                'status' => $row->status,
                'tarif' => $row->tarif,
            );
            $this->load->view('client/header');
            $this->load->view('order_pembacaan/order_pembacaan_read', $data);
            $this->load->view('client/footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }

    function acak($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{
                $pos};
        }
        return $string;
    }


    public function fetch_data_revisi()
    {
        $starts       = $this->input->post("start");
        $length       = $this->input->post("length");
        $LIMIT        = "LIMIT $starts, $length ";
        $draw         = $this->input->post("draw");
        $search       = $this->input->post("search")["value"];
        $orders       = isset($_POST["order"]) ? $_POST["order"] : '';

        $where = "WHERE 1=1 and b.id_client='{$_SESSION['id']}' ";
        $where2 = "WHERE 1=1 and b.id_client='{$_SESSION['id']}' ";
        $result = array();
        if (isset($search)) {
            if ($search != '') {
                $where .= " AND (a.revisi LIKE '%$search%')";
            }
        }

        if (isset($orders)) {
            if ($orders != '') {
                $order = $orders;
                $order_column = ['a.revisi',];
                $order_clm  = $order_column[$order[0]['column']];
                $order_by   = $order[0]['dir'];
                $where .= " ORDER BY $order_clm $order_by ";
            } else {
                $where .= " ORDER BY a.id ASC ";
            }
        } else {
            $where .= " ORDER BY a.id ASC ";
        }
        if (isset($LIMIT)) {
            if ($LIMIT != '') {
                $where .= ' ' . $LIMIT;
            }
        }
        $index = 1;
        $button = "";
        $fetch = $this->db->query("SELECT a.id_order,a.revisi,a.tanggal_revisi,b.id_client from revisi a join order_pembacaan b on a.id_order=b.id_order $where");
        $fetch2 = $this->db->query("SELECT a.id_order,a.revisi,a.tanggal_revisi,b.id_client from revisi a join order_pembacaan b on a.id_order=b.id_order $where2");
        foreach ($fetch->result() as $rows) {
            $sub_array = array();
            $sub_array[] = $index;
            $sub_array[] = $rows->id_order;
            $sub_array[] = $rows->revisi;
            $sub_array[] = $rows->tanggal_revisi;
            $result[]      = $sub_array;
            $index++;
        }
        $output = array(
            "draw"            =>     intval($this->input->post("draw")),
            "recordsFiltered" =>     $fetch2->num_rows(),
            "data"            =>     $result,

        );
        echo json_encode($output);
    }


    public function save_revisi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id_order = $_POST['idOrder'];
        $revisi   = $_POST['revisi'];
        $id   = $_POST['id'];
        $tanggal  = date('Y-m-d');
        $data = array(
            "id_order" => $id_order,
            "revisi" => $revisi,
            "tanggal_revisi" => $tanggal,
            "jawaban_revisi" => "",
            "tanggal_jawab" => "",
        );
        $insert = $this->db->insert('revisi', $data);
        $row = $this->Order_pembacaan_model->get_by_id($id);
        $message = array(
            "pesan" => $_SESSION['nama'] . " mengajukan revisi order pembacaan gambar.",
            "status" => 0,
            "created_at" => date('Y-m-d H:i:s'),
            "deleted" => 0,
            "link" => "panel",
            "id_user" => $row->id_pembaca,
        );
        if ($insert) {
            $this->db->where('id', $id);
            $this->db->update('order_pembacaan', array('status' => 4));
            $insert = $this->db->insert('notifikasi', $message);
            echo json_encode(array(
                "status" => 200,
                "pesan" => "Order berhasil di teruskan ke pembaca gambar",
                "link" => base_url('order_pembacaan'),
            ));
        } else {
            echo json_encode(array(
                "status" => 500,
                "pesan" => "ERROR"
            ));
        }
    }

    public function order_revisi_pembacaan()
    {
        $this->load->view('client/header');
        $this->load->view('order_pembacaan/order_revisi_list');
        $this->load->view('client/footer');
    }

    public function upload_bukti()
    {
        // $data = array("id" => $id);
        // echo json_encode(array(
        //     "data" => $data,
        // ));
        $id = $this->input->post('id');
        $row = $this->db->get_where('order_pembacaan', array('id' => $id))->row();
        $fun = $this->input->post('fun');
        $data = array(
            "id" => $id,
            "func" => $fun,
            "idClient" => $row->id_client,
            "idOrder" => $row->id_order
        );
        echo json_encode(array(
            "data" => $data
        ));
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('order_pembacaan/create_action'),
            'id' => set_value('id'),
            'id_order' => set_value('id_order', $this->acak(10)),
            'id_client' => set_value('id_client'),
            'no_rekam_medis' => set_value('no_rekam_medis'),
            'dokter_pengirim' => set_value('dokter_pengirim'),
            'alamat' => set_value('alamat'),
            'foto' => set_value('foto'),
            'indikasi_pemeriksaan' => set_value('indikasi_pemeriksaan'),
            'dokter_pemeriksa' => set_value('dokter_pemeriksa'),
            'pemeriksaan' => set_value('pemeriksaan'),
            'catatan' => set_value('catatan'),
            'created_at' => set_value('created_at'),
            'id_pembaca' => set_value('id_pembaca'),
            'status' => set_value('status'),
            'tarif' => set_value('tarif'),
        );

        $this->load->view('client/header');
        $this->load->view('order_pembacaan/order_pembacaan_form', $data);
        $this->load->view('client/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_order' => $this->input->post('id_order', TRUE),
                'id_client' => $_SESSION['id'],
                'no_rekam_medis' => $this->input->post('no_rekam_medis', TRUE),
                'dokter_pengirim' => $this->input->post('dokter_pengirim', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'foto' => upload_gambar_biasa('foto', 'uploads/user_image/', 'jpeg|png|jpg|gif|svg|SVG|avi|flv|wmv|mp3|mp4', 600000, 'foto'),
                'indikasi_pemeriksaan' => $this->input->post('indikasi_pemeriksaan', TRUE),
                'dokter_pemeriksa' => $this->input->post('dokter_pemeriksa', TRUE),
                'pemeriksaan' => $this->input->post('pemeriksaan', TRUE),
                'catatan_pemeriksaan' => $this->input->post('catatan', TRUE),
                'status' => 10,
                'tarif' => 0,
            );

            for ($i = 0; $i < sizeof($_POST['kiri_atas']); $i++) {
                $kiriatas = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['kiri_atas'][$i],
                    "lokasi" => 1
                );
                $this->db->insert('detail_regio_angka', $kiriatas);
            }
            for ($i = 0; $i < sizeof($_POST['kanan_atas']); $i++) {
                $kananatas = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['kanan_atas'][$i],
                    "lokasi" => 2
                );
                $this->db->insert('detail_regio_angka', $kananatas);
            }
            for ($i = 0; $i < sizeof($_POST['kiri_bawah']); $i++) {
                $kiri_bawah = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['kiri_bawah'][$i],
                    "lokasi" => 3
                );
                $this->db->insert('detail_regio_angka', $kiri_bawah);
            }
            for ($i = 0; $i < sizeof($_POST['kanan_bawah']); $i++) {
                $kanan_bawah = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['kanan_bawah'][$i],
                    "lokasi" => 4
                );
                $this->db->insert('detail_regio_angka', $kanan_bawah);
            }
            for ($i = 0; $i < sizeof($_POST['romawi_kiri_atas']); $i++) {
                $romawikiriatas = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['romawi_kiri_atas'][$i],
                    "lokasi" => 5
                );
                $this->db->insert('detail_regio_angka', $romawikiriatas);
            }
            for ($i = 0; $i < sizeof($_POST['romawi_kanan_atas']); $i++) {
                $romawi_kanan_atas = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['romawi_kanan_atas'][$i],
                    "lokasi" => 6
                );
                $this->db->insert('detail_regio_angka', $romawi_kanan_atas);
            }
            for ($i = 0; $i < sizeof($_POST['romawi_kiri_bawah']); $i++) {
                $romawi_kiri_bawah = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['romawi_kiri_bawah'][$i],
                    "lokasi" => 7
                );
                $this->db->insert('detail_regio_angka', $romawi_kiri_bawah);
            }
            for ($i = 0; $i < sizeof($_POST['romawi_kanan_bawah']); $i++) {
                $romawi_kanan_bawah = array(
                    "id_order" => $_POST['id_order'],
                    "angka" => $_POST['romawi_kanan_bawah'][$i],
                    "lokasi" => 8
                );
                $this->db->insert('detail_regio_angka', $romawi_kanan_bawah);
            }
            for ($i = 0; $i < sizeof($_POST['detail']); $i++) {
                $detail = array(
                    "no_order" => $_POST['id_order'],
                    "detail" => $_POST['detail'][$i],

                );
                $this->db->insert('detail_pemeriksaan', $detail);
            }

            $this->Order_pembacaan_model->insert($data);
            $_SESSION['pesan'] = "Create Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('order_pembacaan'));
        }
    }

    public function update($id)
    {
        $row = $this->Order_pembacaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('order_pembacaan/update_action'),
                'id' => set_value('id', $row->id),
                'id_order' => set_value('id_order', $row->id_order),
                'id_client' => set_value('id_client', $row->id_client),
                'no_rekam_medis' => set_value('no_rekam_medis', $row->no_rekam_medis),
                'dokter_pengirim' => set_value('dokter_pengirim', $row->dokter_pengirim),
                'alamat' => set_value('alamat', $row->alamat),
                'pemeriksaan' => set_value('pemeriksaan', $row->pemeriksaan),
                'catatan' => set_value('catatan', $row->catatan_pemeriksaan),
                'foto' => set_value('foto', $row->foto),
                'indikasi_pemeriksaan' => set_value('indikasi_pemeriksaan', $row->indikasi_pemeriksaan),
                'dokter_pemeriksa' => set_value('dokter_pemeriksa', $row->dokter_pemeriksa),
                'created_at' => set_value('created_at', $row->created_at),
                'id_pembaca' => set_value('id_pembaca', $row->id_pembaca),
                'status' => set_value('status', $row->status),
                'tarif' => set_value('tarif', $row->tarif),
            );
            $this->load->view('client/header');
            $this->load->view('order_pembacaan/order_pembacaan_form', $data);
            $this->load->view('client/footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }
    public function update2($id)
    {
        $row = $this->Order_pembacaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Read',
                'action' => site_url('order_pembacaan/update_action'),
                'id' => set_value('id', $row->id),
                'id_order' => set_value('id_order', $row->id_order),
                'id_client' => set_value('id_client', $row->id_client),
                'no_rekam_medis' => set_value('no_rekam_medis', $row->no_rekam_medis),
                'dokter_pengirim' => set_value('dokter_pengirim', $row->dokter_pengirim),
                'alamat' => set_value('alamat', $row->alamat),
                'pemeriksaan' => set_value('pemeriksaan', $row->pemeriksaan),
                'catatan' => set_value('catatan', $row->catatan_pemeriksaan),
                'foto' => set_value('foto', $row->foto),
                'indikasi_pemeriksaan' => set_value('indikasi_pemeriksaan', $row->indikasi_pemeriksaan),
                'dokter_pemeriksa' => set_value('dokter_pemeriksa', $row->dokter_pemeriksa),
                'created_at' => set_value('created_at', $row->created_at),
                'id_pembaca' => set_value('id_pembaca', $row->id_pembaca),
                'status' => set_value('status', $row->status),
                'tarif' => set_value('tarif', $row->tarif),
            );
            $this->load->view('client/header');
            $this->load->view('order_pembacaan/order_pembacaan_form', $data);
            $this->load->view('client/footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_order' => $this->input->post('id_order', TRUE),
                'id_client' => $this->input->post('id_client', TRUE),
                'no_rekam_medis' => $this->input->post('no_rekam_medis', TRUE),
                'dokter_pengirim' => $this->input->post('dokter_pengirim', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'foto' => $this->input->post('foto', TRUE),
                'indikasi_pemeriksaan' => $this->input->post('indikasi_pemeriksaan', TRUE),
                'dokter_pemeriksa' => $this->input->post('dokter_pemeriksa', TRUE),
                'status' => $this->input->post('status', TRUE),
                'tarif' => $this->input->post('tarif', TRUE),
            );

            $this->Order_pembacaan_model->update($this->input->post('id', TRUE), $data);
            $_SESSION['pesan'] = "Update Record Success";
            $_SESSION['tipe'] = "success";
            if ($_SESSION['level'] == "Client") {
                redirect(site_url('order_pembacaan'));
            } else {
                redirect(site_url('orders'));
            }
        }
    }

    public function delete($id)
    {
        $row = $this->Order_pembacaan_model->get_by_id($id);

        if ($row) {
            $this->Order_pembacaan_model->delete($id);
            $_SESSION['pesan'] = "Delete Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('order_pembacaan'));
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('order_pembacaan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_order', 'id order', 'trim|required');
        $this->form_validation->set_rules('id_client', 'id client', '');
        $this->form_validation->set_rules('no_rekam_medis', 'no rekam medis', 'trim|required');
        $this->form_validation->set_rules('dokter_pengirim', 'dokter pengirim', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('foto', 'foto', '');
        $this->form_validation->set_rules('indikasi_pemeriksaan', 'indikasi pemeriksaan', 'trim|required');
        $this->form_validation->set_rules('dokter_pemeriksa', 'dokter pemeriksa', 'trim|required');
        $this->form_validation->set_rules('status', 'status', '');
        $this->form_validation->set_rules('tarif', 'tarif', '');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Order_pembacaan.php */
/* Location: ./application/controllers/Order_pembacaan.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2021-09-21 17:43:08 */
/* https://gocodings.web.com */