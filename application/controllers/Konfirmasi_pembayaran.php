<?php

class Konfirmasi_pembayaran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Order_pembacaan_model');
		$this->load->model('Email_model');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('orders/konfirmasi_list');
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
			$where = "WHERE 1=1 AND status_pembayaran not in ('0','3')";
			$where2 = "WHERE 1=1 AND status_pembayaran not in ('0','3')";
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
			$button1 = "<a href=" . base_url('konfirmasi_pembayaran/view/' . $rows->id) . "  class='btn btn-info btn-sm' style='color:white'><i class='icon-copy dw dw-eye'></i> View</a>";

			$state = "";
			if ($rows->status_pembayaran == 1) {
				$state = "Menunggu konfirmasi";
			} elseif ($rows->status_pembayaran == 2) {
				$state = "Ditolak";
			} elseif ($rows->status_pembayaran == 3) {
				$state = "Valid";
			}
			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->id_order;
			$sub_array[] = formatTanggal($rows->created_at);
			$sub_array[] = $rows->nama;
			$sub_array[] = $rows->dokter_pengirim;
			$sub_array[] = $rows->id_pembaca == 0 ? "Belum dipilih" : $this->db->get_where('users', array('id' => $rows->id_pembaca))->row()->nama;
			$sub_array[] = $state;
			$sub_array[] = '<div class="table-actions">' . $button1 . '</div>';
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

	public function view($id)
	{
		$row = $this->Order_pembacaan_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('konfirmasi_pembayaran/update_action'),
				'id' => set_value('id', $row->id),
				'kode_order' => set_value('kode_order', $row->id_order),
				'bukti_pembayaran' => set_value('bukti_pembayaran', $row->bukti_pembayaran),
				'status_pembayaran' => set_value('status_pembayaran', $row->status_pembayaran),
				'total' => set_value('total', $row->tarif + $row->harga_tambahan),
				'nama' => set_value('nama', $this->db->get_where('users', array('id' => $row->id_client))->row()->nama),
			);
			$this->load->view('header');
			$this->load->view('orders/konfirmasi_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('konfirmasi_pembayaran'));
		}
	}

	public function update_action()
	{
		$id = $this->input->post('id');
		$row = $this->Order_pembacaan_model->get_by_id($id);
		$status_pembayaran = $this->input->post('status_pembayaran');
		$status = "Pilih status";
		if ($status_pembayaran == 0) {
			$status = "Belum dibayar";
		} elseif ($status_pembayaran == 1) {
			$status = "Menunggu konfirmasi";
		} elseif ($status_pembayaran == 2) {
			$status = "Ditolak";
		} else {
			$status = "Disetujui";
		}
		$link = base_url() . "order_pembacaan";
		$namaClient = "";
		$namaClient = $this->db->get_where('users', array('id' => $row->id_client))->row();
		$mail = "";
		$mail .= "<h3>Email Pemberitahuan</h3><hr>
			Kepada Yth. <br>
			$namaClient->nama<br><br>
			Kami menginformasikan bahwa pembayaran anda pada kode order $row->id_order $status, klik link $link berikut untuk melihat data .
			";

		$data = array(
			"status_pembayaran" => $status_pembayaran
		);
		$this->db->where('id', $id);
		$update = $this->db->update('order_pembacaan', $data);
		if ($update) {
			$this->Email_model->sendEmail($mail, $namaClient->username);
			$_SESSION['pesan'] = "Successfully";
			$_SESSION['tipe'] = "success";
			redirect(site_url('konfirmasi_pembayaran'));
		} else {
			$_SESSION['pesan'] = "Something when wrong";
			$_SESSION['tipe'] = "error";
			redirect(site_url('konfirmasi_pembayaran'));
		}
	}
}
