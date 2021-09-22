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
        $result = array();
        if (isset($search)) {
            if ($search != '') {
                $where .= " AND (id_order LIKE '%$search%'
	                        id_client LIKE '%$search%'
	                        no_rekam_medis LIKE '%$search%'
	                        dokter_pengirim LIKE '%$search%'
	                        alamat LIKE '%$search%'
	                        foto LIKE '%$search%'
	                        indikasi_pemeriksaan LIKE '%$search%'
	                        dokter_pemeriksa LIKE '%$search%'
	                        created_at LIKE '%$search%'
	                        id_pembaca LIKE '%$search%'
	                        status LIKE '%$search%'
	                        tarif LIKE '%$search%'
	 )";
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
        $fetch2 = $this->db->query("SELECT * from order_pembacaan ");
        foreach ($fetch->result() as $rows) {
            $button1 = "<a href=" . base_url('order_pembacaan/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
            $button2 = "<a href=" . base_url('order_pembacaan/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
            $button3 = "<a href=" . base_url('order_pembacaan/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";

            $sub_array = array();
            $sub_array[] = $index;
            $sub_array[] = $rows->id_order;
            // $sub_array[] = $rows->id_client;
            $sub_array[] = $rows->no_rekam_medis;
            // $sub_array[] = $rows->dokter_pengirim;
            // $sub_array[] = $rows->alamat;
            // $sub_array[] = $rows->foto;
            // $sub_array[] = $rows->indikasi_pemeriksaan;
            // $sub_array[] = $rows->dokter_pemeriksa;
            $sub_array[] = $rows->created_at;
            // $sub_array[] = $rows->id_pembaca;
            $sub_array[] = $rows->status;
            $sub_array[] = $rows->tarif;

            $sub_array[] = '<div class="table-actions">' . $button1 . " " . $button2 . " " . $button3 . '</div>';
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
                'status' => "input",
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
                    "angka" => $_POST['kanan_bawah'][$i],
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
            redirect(site_url('order_pembacaan'));
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