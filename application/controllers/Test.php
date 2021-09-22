<?php
class Test extends MY_Controller
{


    public function index()
    {
        for ($i = 0; $i < sizeof($_POST['kiri_atas']); $i++) {
            $data = array(
                "id_order" => $_POST['id_order'],
                "angka" => $_POST['kiri_atas'][$i],
                "lokasi" => 1
            );
            $this->db->insert('detail_regio_angka', $data);
        }
        for ($i = 0; $i < sizeof($_POST['kanan_atas']); $i++) {
            $data = array(
                "id_order" => $_POST['id_order'],
                "angka" => $_POST['kanan_atas'][$i],
                "lokasi" => 2
            );
            $this->db->insert('detail_regio_angka', $data);
        }
        for ($i = 0; $i < sizeof($_POST['kiri_bawah']); $i++) {
            $data = array(
                "id_order" => $_POST['id_order'],
                "angka" => $_POST['kiri_bawah'][$i],
                "lokasi" => 3
            );
            $this->db->insert('detail_regio_angka', $data);
        }
        for ($i = 0; $i < sizeof($_POST['kanan_bawah']); $i++) {
            $data = array(
                "id_order" => $_POST['id_order'],
                "angka" => $_POST['kanan_bawah'][$i],
                "lokasi" => 4
            );
            $this->db->insert('detail_regio_angka', $data);
        }
    }

    public function test_video()
    {
        $this->load->view('tes_upload');
    }

    public function test_act()
    {
        $data = array(
            "video" => upload_gambar_biasa('video', 'uploads/user_image/', 'jpeg|png|jpg|gif|svg|SVG|avi|flv|wmv|mp3|mp4', 1000, 'video'),
        );

       redirect(site_url('test/test_video'));
    }
}
