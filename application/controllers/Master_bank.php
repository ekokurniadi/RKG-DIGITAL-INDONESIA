<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Master_bank extends MY_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->load->model('Master_bank_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$master_bank = $this->Master_bank_model->get_all();

		$data = array(
			'master_bank_data' => $master_bank
		);
		$this->load->view('header');
		$this->load->view('master_bank/master_bank_list', $data);
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

		$where = "WHERE 1=1";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (nama_bank LIKE '%$search%'
				OR nomor_rekening LIKE '%$search%'
				OR atas_nama LIKE '%$search%'
	 )";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['nama_bank', 'nomor_rekening', 'atas_nama',];
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
		$fetch = $this->db->query("SELECT * from master_bank $where");
		$fetch2 = $this->db->query("SELECT * from master_bank ");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('master_bank/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('master_bank/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('master_bank/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='icon-copy dw dw-delete-3'></i></a>";

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->nama_bank;
			$sub_array[] = $rows->nomor_rekening;
			$sub_array[] = $rows->atas_nama;

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
		$row = $this->Master_bank_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'nama_bank' => $row->nama_bank,
				'nomor_rekening' => $row->nomor_rekening,
				'atas_nama' => $row->atas_nama,
			);
			$this->load->view('header');
			$this->load->view('master_bank/master_bank_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_bank'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('master_bank/create_action'),
			'id' => set_value('id'),
			'nama_bank' => set_value('nama_bank'),
			'nomor_rekening' => set_value('nomor_rekening'),
			'atas_nama' => set_value('atas_nama'),
		);

		$this->load->view('header');
		$this->load->view('master_bank/master_bank_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nama_bank' => $this->input->post('nama_bank', TRUE),
				'nomor_rekening' => $this->input->post('nomor_rekening', TRUE),
				'atas_nama' => $this->input->post('atas_nama', TRUE),
			);

			$this->Master_bank_model->insert($data);
			$_SESSION['pesan'] = "Create Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_bank'));
		}
	}

	public function update($id)
	{
		$row = $this->Master_bank_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('master_bank/update_action'),
				'id' => set_value('id', $row->id),
				'nama_bank' => set_value('nama_bank', $row->nama_bank),
				'nomor_rekening' => set_value('nomor_rekening', $row->nomor_rekening),
				'atas_nama' => set_value('atas_nama', $row->atas_nama),
			);
			$this->load->view('header');
			$this->load->view('master_bank/master_bank_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_bank'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'nama_bank' => $this->input->post('nama_bank', TRUE),
				'nomor_rekening' => $this->input->post('nomor_rekening', TRUE),
				'atas_nama' => $this->input->post('atas_nama', TRUE),
			);

			$this->Master_bank_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_bank'));
		}
	}

	public function delete($id)
	{
		$row = $this->Master_bank_model->get_by_id($id);

		if ($row) {
			$this->Master_bank_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_bank'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_bank'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_bank', 'nama bank', 'trim|required');
		$this->form_validation->set_rules('nomor_rekening', 'nomor rekening', 'trim|required');
		$this->form_validation->set_rules('atas_nama', 'atas nama', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Master_bank.php */
/* Location: ./application/controllers/Master_bank.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2021-10-14 10:54:53 */
/* https://gocodings.web.com */
