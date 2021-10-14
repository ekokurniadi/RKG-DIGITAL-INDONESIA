<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Master_harga_pembaca extends MY_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->load->model('Master_harga_pembaca_model');
		$this->load->library('form_validation');
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

	public function index()
	{
		$master_harga_pembaca = $this->Master_harga_pembaca_model->get_all();

		$data = array(
			'master_harga_pembaca_data' => $master_harga_pembaca
		);
		$this->load->view('header');
		$this->load->view('master_harga_pembaca/master_harga_pembaca_list', $data);
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

		$where = "WHERE 1=1 and id_pembaca='{$_SESSION['id']}' ";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (kode LIKE '%$search%'
	 OR harga LIKE '%$search%'
	 )";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['kode', 'harga',];
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
		$fetch = $this->db->query("SELECT * from master_harga_pembaca $where");
		$fetch2 = $this->db->query("SELECT * from master_harga_pembaca $where");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('master_harga_pembaca/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('master_harga_pembaca/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('master_harga_pembaca/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode;
			$sub_array[] = number_format($rows->harga, 0, ',', '.');

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
		$row = $this->Master_harga_pembaca_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'kode_harga' => $row->kode_harga,
				'kode' => $row->kode,
				'harga' => $row->harga,
			);
			$this->load->view('header');
			$this->load->view('master_harga_pembaca/master_harga_pembaca_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_harga_pembaca'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('master_harga_pembaca/create_action'),
			'id' => set_value('id'),
			'kode_harga' => set_value('kode_harga', $this->acak(8)),
			'kode' => set_value('kode'),
			'harga' => set_value('harga'),
		);

		$this->load->view('header');
		$this->load->view('master_harga_pembaca/master_harga_pembaca_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'kode_harga' => $this->input->post('kode_harga', TRUE),
				'kode' => $this->input->post('kode', TRUE),
				'harga' => $this->input->post('harga', TRUE),
				'id_pembaca' => $_SESSION['id'],
			);

			$this->Master_harga_pembaca_model->insert($data);
			$_SESSION['pesan'] = "Create Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_harga_pembaca'));
		}
	}

	public function update($id)
	{
		$row = $this->Master_harga_pembaca_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('master_harga_pembaca/update_action'),
				'id' => set_value('id', $row->id),
				'kode_harga' => set_value('kode_harga', $row->kode_harga),
				'kode' => set_value('kode', $row->kode),
				'harga' => set_value('harga', $row->harga),
			);
			$this->load->view('header');
			$this->load->view('master_harga_pembaca/master_harga_pembaca_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_harga_pembaca'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'kode_harga' => $this->input->post('kode_harga', TRUE),
				'kode' => $this->input->post('kode', TRUE),
				'harga' => $this->input->post('harga', TRUE),
			);

			$this->Master_harga_pembaca_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_harga_pembaca'));
		}
	}

	public function delete($id)
	{
		$row = $this->Master_harga_pembaca_model->get_by_id($id);

		if ($row) {
			$this->Master_harga_pembaca_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_harga_pembaca'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_harga_pembaca'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('kode_harga', 'kode harga', 'trim|required');
		$this->form_validation->set_rules('kode', 'kode harga', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required|numeric');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Master_harga_pembaca.php */
/* Location: ./application/controllers/Master_harga_pembaca.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2021-09-23 10:39:10 */
/* https://gocodings.web.com */
