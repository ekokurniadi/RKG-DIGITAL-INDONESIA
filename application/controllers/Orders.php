<?php
class Orders extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Order_pembacaan_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $this->load->view('header');
    $this->load->view('orders/orders_list');
    $this->load->view('footer');
  }
  public function history()
  {
    $this->load->view('header');
    $this->load->view('orders/order_list_history');
    $this->load->view('footer');
  }

  public function fetch_data()
  {
    $starts       = $this->input->post("start");
    $length       = $this->input->post("length");
    $LIMIT        = "LIMIT $starts, $length ";
    $draw         = $this->input->post("draw");
    $search       = $this->input->post("search")["value"];
    $orders       = isset($_POST["order"]) ? $_POST["order"] : '';
    if ($_SESSION['level'] == "Admin") {
      $where = "WHERE 1=1 AND status=0 ";
      $where2 = "WHERE 1=1 AND status=0 ";
    } elseif ($_SESSION['level'] == "Pembaca Gambar") {
      $where = "WHERE 1=1 and a.id_pembaca='{$_SESSION['id']}' and status !=6";
      $where2 = "WHERE 1=1 and a.id_pembaca='{$_SESSION['id']}' and status !=6 ";
    }
    $result = array();
    if (isset($search)) {
      if ($search != '') {
        $where .= " AND (a.id_order LIKE '%$search%'
                           OR b.nama LIKE '%$search%'
                           OR a.no_rekam_medis LIKE '%$search%'
                           OR a.dokter_pengirim LIKE '%$search%'
                        )";
      }
    }

    if (isset($orders)) {
      if ($orders != '') {
        $order = $orders;
        $order_column = [];
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
    $fetch = $this->db->query("SELECT a.*,b.nama from order_pembacaan a join users b on a.id_client=b.id $where");
    $fetch2 = $this->db->query("SELECT a.*,b.nama from order_pembacaan a join users b on a.id_client=b.id $where2 ");
    $func = "1";
    foreach ($fetch->result() as $rows) {
      $func = '1';
      $button1 = "<a href=" . base_url('orders/read/' . $rows->id) . "  class='btn btn-info btn-sm' style='color:white'><i class='icon-copy dw dw-eye'></i> View</a>";
      $button2 = "<a href='#' onClick='openModal(" . $rows->id . "," . $func . ")' class='btn btn-danger btn-sm' style='color:white'>Pilih Pembaca </a>";
      $button3 = "<a href=" . base_url('orders/proses/' . $rows->id) . " class='btn btn-danger btn-sm' style='color:white'>Proses </a>";
      // $button5 = "<a href=" . base_url('orders/complete/' . $rows->id) . " class='btn btn-success btn-sm' style='color:white'>Selesaikan Order </a>";
      $button4 = "<a href=" . base_url('orders/download_form_order/' . $rows->id) . " class='btn btn-success btn-sm' style='color:white'>Download </a>";
      $button5 = "<a href=" . base_url('orders/revisi/' . $rows->id) . " class='btn btn-danger btn-sm' style='color:white'>Proses Revisi </a>";
      if ($_SESSION['level'] == "Admin") {
        $button = $button1 . " " . $button2;
      } else {
        if ($rows->status == 1) {
          $button = $button3 . " " . $button4;
        } elseif ($rows->status == 3) {
          $button = $button4;
        } elseif ($rows->status == 4) {
          $button = $button5 . " " . $button4;
        }
      }
      $state = "";
      if ($rows->status == 0) {
        $state = "Menunggu konfirmasi";
      } elseif ($rows->status == 1) {
        $state = "Belum diproses";
      } elseif ($rows->status == 2) {
        $state = "Dalam Pengerjaan";
      } elseif ($rows->status == 3) {
        $state = "Selesai Pengerjaan";
      } elseif ($rows->status == 4) {
        $state = "Pengajuan Revisi";
      } elseif ($rows->status == 10) {
        $state = "Draft";
      } else {
        $state = "Selesai";
      }
      $sub_array = array();
      $sub_array[] = $index;
      $sub_array[] = $rows->id_order;
      $sub_array[] = formatTanggal($rows->created_at);
      $sub_array[] = $rows->nama;
      $sub_array[] = $rows->dokter_pengirim;
      $sub_array[] = $rows->indikasi_pemeriksaan;
      $sub_array[] = $rows->id_pembaca == 0 ? "Belum dipilih" : $this->db->get_where('users', array('id' => $rows->id_pembaca))->row()->nama;
      $sub_array[] = $state;
      $sub_array[] = '<div class="table-actions">' . $button . '</div>';
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
  public function fetch_history()
  {
    $starts       = $this->input->post("start");
    $length       = $this->input->post("length");
    $LIMIT        = "LIMIT $starts, $length ";
    $draw         = $this->input->post("draw");
    $search       = $this->input->post("search")["value"];
    $orders       = isset($_POST["order"]) ? $_POST["order"] : '';
    if ($_SESSION['level'] == "Admin") {
      $where = "WHERE 1=1 AND status=6 ";
      $where2 = "WHERE 1=1 AND status=6 ";
    } elseif ($_SESSION['level'] == "Pembaca Gambar") {
      $where = "WHERE 1=1 and a.id_pembaca='{$_SESSION['id']}' AND status=6 ";
      $where2 = "WHERE 1=1 and a.id_pembaca='{$_SESSION['id']}' AND status=6 ";
    }
    $result = array();
    if (isset($search)) {
      if ($search != '') {
        $where .= " AND (a.id_order LIKE '%$search%'
                           OR b.nama LIKE '%$search%'
                           OR a.no_rekam_medis LIKE '%$search%'
                           OR a.dokter_pengirim LIKE '%$search%'
                        )";
      }
    }

    if (isset($orders)) {
      if ($orders != '') {
        $order = $orders;
        $order_column = [];
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
    $fetch = $this->db->query("SELECT a.*,b.nama from order_pembacaan a join users b on a.id_client=b.id $where");
    $fetch2 = $this->db->query("SELECT a.*,b.nama from order_pembacaan a join users b on a.id_client=b.id $where2 ");
    $func = "1";
    foreach ($fetch->result() as $rows) {
      $func = '1';
      $button1 = "<a href=" . base_url('orders/read/' . $rows->id) . "  class='btn btn-info btn-sm' style='color:white'><i class='icon-copy dw dw-eye'></i> View</a>";
      $button2 = "<a href='#' onClick='openModal(" . $rows->id . "," . $func . ")' class='btn btn-danger btn-sm' style='color:white'>Pilih Pembaca </a>";
      $button3 = "<a href=" . base_url('orders/proses/' . $rows->id) . " class='btn btn-danger btn-sm' style='color:white'>Proses </a>";
      // $button5 = "<a href=" . base_url('orders/complete/' . $rows->id) . " class='btn btn-success btn-sm' style='color:white'>Selesaikan Order </a>";
      $button4 = "<a href=" . base_url('orders/download_form_order/' . $rows->id) . " class='btn btn-success btn-sm' style='color:white'>Download </a>";
      if ($_SESSION['level'] == "Admin") {
        $button = $button1 . " " . $button2;
      } else {
        if ($rows->status == 1) {
          $button = $button3 . " " . $button4;
        } elseif ($rows->status == 3) {
          $button = $button4;
        } elseif ($rows->status == 4) {
          $button = $button4 . " " . $button4;
        }
      }
      $state = "";
      if ($rows->status == 0) {
        $state = "Menunggu konfirmasi";
      } elseif ($rows->status == 1) {
        $state = "Belum diproses";
      } elseif ($rows->status == 2) {
        $state = "Dalam Pengerjaan";
      } elseif ($rows->status == 3) {
        $state = "Selesai Pengerjaan";
      } elseif ($rows->status == 4) {
        $state = "Pengajuan Revisi";
      } elseif ($rows->status == 10) {
        $state = "Draft";
      } else {
        $state = "Selesai";
      }
      $sub_array = array();
      $sub_array[] = $index;
      $sub_array[] = $rows->id_order;
      $sub_array[] = formatTanggal($rows->created_at);
      $sub_array[] = $rows->nama;
      $sub_array[] = $rows->dokter_pengirim;
      $sub_array[] = $rows->indikasi_pemeriksaan;
      $sub_array[] = $rows->id_pembaca == 0 ? "Belum dipilih" : $this->db->get_where('users', array('id' => $rows->id_pembaca))->row()->nama;
      $sub_array[] = $state;
      $sub_array[] = '<div class="table-actions">' . $button1 . " " . $button4 . '</div>';
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
      $this->load->view('header');
      $this->load->view('order_pembacaan/order_pembacaan_form_read', $data);
      $this->load->view('footer');
    } else {
      $_SESSION['pesan'] = "Record Not Found";
      $_SESSION['tipe'] = "error";
      redirect(site_url('orders'));
    }
  }

  public function simpanPilihPembaca()
  {
    $id = $this->input->post('id');
    $idOrder = $this->input->post('orderId');
    $idClient = $this->input->post('idClient');

    $this->db->where('id', $idOrder);
    $update =  $this->db->update('order_pembacaan', array('id_pembaca' => $id, 'status' => 1));
    date_default_timezone_set('Asia/Jakarta');
    $data = array(
      "pesan" => "Order anda berhasil diteruskan ke pembaca gambar",
      "status" => 0,
      "created_at" => date('Y-m-d H:i:s'),
      "deleted" => 0,
      "link" => "order_pembacaan",
      "id_user" => $idClient,
    );

    if ($update) {
      $insert = $this->db->insert('notifikasi', $data);
      echo json_encode(array(
        "status" => 200,
        "message" => "Order berhasil di teruskan ke pembaca gambar"
      ));
    } else {
      echo json_encode(array(
        "status" => 500,
        "message" => "ERROR"
      ));
    }
  }



  public function proses($id)
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
      $this->load->view('header');
      $this->load->view('order_pembacaan/order_pembacaan_form_pembaca', $data);
      $this->load->view('footer');
    } else {
      $_SESSION['pesan'] = "Record Not Found";
      $_SESSION['tipe'] = "error";
      redirect(site_url('orders'));
    }
  }

  public function revisi($id)
  {
    $row = $this->Order_pembacaan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Read',
        'mode' => 'update',
        'action' => site_url('orders/save'),
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
      $this->load->view('header');
      $this->load->view('order_pembacaan/order_pembacaan_revisi', $data);
      $this->load->view('footer');
    } else {
      $_SESSION['pesan'] = "Record Not Found";
      $_SESSION['tipe'] = "error";
      redirect(site_url('orders'));
    }
  }

  public function download_form_order($id)
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
      'action' => site_url('orders/save'),
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
    $mpdf->Output("$output", 'D');
  }

  public function save()
  {
    $details = $_POST['details'];
    $idOrder = $_POST['idOrder'];
    $idClient = $_POST['id_client'];
    $intraOral = $_POST['intra_oral'];
    $elemenGigi = $_POST['elemen_gigi'];
    $suspek = $_POST['suspek'];
    $hargaPembacaan = $_POST['harga_pembacaan'];
    $id = $_POST['id'];
    $namaBank = $_SESSION['nama_bank'];
    $noRek = $_SESSION['no_rekening'];
    $atasNama = $_SESSION['atas_nama'];
    $revisi = isset($_POST['revisi']) ? $_POST['revisi'] : "";
    foreach ($details as $dj) {
      $detail_pembacaan[] = [
        "id_order" =>  $idOrder,
        "elemen" => $dj['elemen'],
        "keterangan" => $dj['keterangan'],
      ];
    }
    $this->db->where('id_order', $idOrder);
    $this->db->delete('detail_pembacaan');

    if ($revisi == "") {
      $data = array(
        "tarif" => $hargaPembacaan,
        "no_rekening" => $noRek,
        "nama_bank" => $namaBank,
        "atas_nama" => $atasNama,
        "intra_oral" => $intraOral,
        "elemen_gigi" => $elemenGigi,
        "suspek" => $suspek,
        "status" => 3
      );
    } else {
      $data = array(
        "tarif" => $hargaPembacaan,
        "no_rekening" => $noRek,
        "nama_bank" => $namaBank,
        "atas_nama" => $atasNama,
        "intra_oral" => $intraOral,
        "elemen_gigi" => $elemenGigi,
        "suspek" => $suspek,
        "status" => 3,
        "status_revisi" => 1
      );
    }
    $this->db->where('id', $id);
    $update = $this->db->update('order_pembacaan', $data);
    $insert = $this->db->insert_batch('detail_pembacaan', $detail_pembacaan);

    if ($update) {
      $response = [
        'status' => "sukses",
        'link' => base_url('orders')
      ];
      $_SESSION['pesan'] = "Pengisian Form Pembacaan berhasil dilakukan";
      $_SESSION['tipe'] = "success";
    } else {
      $response = [
        'status' => "ERROR",
        "pesan" => "Terjadi kesalahan",
      ];
    }
    date_default_timezone_set('Asia/Jakarta');
    if ($revisi == "") {
      $message = array(
        "pesan" => $_SESSION['nama'] . " sudah menyelesaikan pembacaan gambar.",
        "status" => 0,
        "created_at" => date('Y-m-d H:i:s'),
        "deleted" => 0,
        "link" => "order_pembacaan/view_hasil/" . $id,
        "id_user" => $idClient,
      );
    } else {
      $message = array(
        "pesan" => $_SESSION['nama'] . " sudah menyelesaikan revisi pembacaan gambar.",
        "status" => 0,
        "created_at" => date('Y-m-d H:i:s'),
        "deleted" => 0,
        "link" => "order_pembacaan/view_hasil/" . $id,
        "id_user" => $idClient,
      );
    }

    if ($update) {
      $this->db->insert('notifikasi', $message);
    }

    echo json_encode($response);
  }
}
