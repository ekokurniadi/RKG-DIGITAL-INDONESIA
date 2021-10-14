<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Master_harga extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->library('form_validation');
		require APPPATH . '/third_party/Google/autoload.php';
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('master_harga_pembaca/master_harga_pembaca_list_admin');
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

		$where = "WHERE 1=1 AND level='Pembaca Gambar' ";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (nama LIKE '%$search%'
	 OR username LIKE '%$search%'
	 OR password LIKE '%$search%'
	 OR level LIKE '%$search%'
	 )";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['nama', 'username', 'password', 'level',];
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
		$fetch = $this->db->query("SELECT * from users $where");
		$fetch2 = $this->db->query("SELECT * from users ");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('master_harga/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i> View</a>";
			$button2 = "<a href=" . base_url('master_harga/tetapkan_harga/' . $rows->id) . " data-color='red' style='color: red'><i class='icon-copy dw dw-edit1'></i> Harga</a>";
			// $button3 = "<a href=" . base_url('master_harga/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='icon-copy dw dw-delete-3'></i></a>";
			date_default_timezone_set('Asia/Jakarta');
			$date = new DateTime('today');
			$tgl_lahir = new DateTime($rows->tanggal_lahir);
			$umur = $date->diff($tgl_lahir)->y;
			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->sip;
			$sub_array[] = $rows->nama;
			$sub_array[] = '<div class="table-actions">' . $button1 . " " . $button2 . '</div>';
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

	public function tetapkan_harga($id)
	{
		$row = $this->Users_model->get_by_id($id);

		if ($row) {
			$data = array(
				'mode' => 'create',
				'id' => set_value('id', $row->id),
				'nama' => set_value('nama', $row->nama),
				'sip' => set_value('sip', $row->sip),
				'username' => set_value('username', $row->username),
				'password' => set_value('password', $row->password),
				'nama_bank' => set_value('nama_bank', $row->nama_bank),
				'atas_nama' => set_value('atas_nama', $row->atas_nama),
				'no_rek' => set_value('no_rek', $row->no_rekening),
				'level' => set_value('level', $row->level),
			);
			$this->load->view('header');
			$this->load->view('master_harga_pembaca/form_harga', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_harga'));
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

	public function save()
	{
		$id = $this->input->post('id');
		$details = $this->input->post('details');
		foreach ($details as $dt) {
			$insert[] = [
				"kode_harga" => $this->acak(10),
				"harga" => $dt['harga'],
				"id_pembaca" => $id,
				"kode" => $dt['kode'],
			];
		}
		$this->db->where('id_pembaca', $id);
		$this->db->delete('master_harga_pembaca');
		$insert = $this->db->insert_batch('master_harga_pembaca', $insert);
		if ($insert) {
			$response = [
				"status" => 200,
				"link" => base_url('master_harga'),
			];
			$_SESSION['pesan'] = "Pengaturan Harga berhasil dilakukan";
			$_SESSION['tipe'] = "success";
		} else {
			$response = [
				"status" => 500,
				"message" => "Internal Server Error"
			];
		}
		echo json_encode($response);
	}
}
