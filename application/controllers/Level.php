<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Level extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Level_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $level = $this->Level_model->get_all();

        $data = array(
            'level_data' => $level
        );
        $this->load->view('header');
        $this->load->view('level/level_list', $data);
        $this->load->view('footer');
    }

    public function fetch_data(){
        $starts       = $this->input->post("start");
        $length       = $this->input->post("length");
        $LIMIT        = "LIMIT $starts, $length ";
        $draw         = $this->input->post("draw");
        $search       = $this->input->post("search")["value"];
        $orders       = isset($_POST["order"]) ? $_POST["order"] : ''; 
        
        $where ="WHERE 1=1";
        $result=array();
        if (isset($search)) {
          if ($search != '') {
                $where .= " AND (level LIKE '%$search%'
	 )";
	
              }
          }
    
        if (isset($orders)) {
            if ($orders != '') {
              $order = $orders;
              $order_column =['level',];
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
        $index=1;
        $button="";
        $fetch = $this->db->query("SELECT * from level $where");
        $fetch2 = $this->db->query("SELECT * from level ");
        foreach($fetch->result() as $rows){
            $button1= "<a href=".base_url('level/read/'.$rows->id)." data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
            $button2= "<a href=".base_url('level/update/'.$rows->id)." data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
            $button3 = "<a href=".base_url('level/delete/'.$rows->id)." data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";
            $button4 = "<a href=".base_url('level/hak_akses/'.$rows->id)." data-color='green' style='color: green;' ><i class='icon-copy dw dw-user-13'></i></a>";
        
            $sub_array=array();
            $sub_array[]=$index;$sub_array[]=$rows->level;
	 
            $sub_array[]='<div class="table-actions">'.$button1." ".$button2." ".$button3." ".$button4. '</div>';
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
        $row = $this->Level_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'level' => $row->level,
	    );
            $this->load->view('header');
            $this->load->view('level/level_read', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('level'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('level/create_action'),
	    'id' => set_value('id'),
	    'level' => set_value('level'),
	);

        $this->load->view('header');
        $this->load->view('level/level_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Level_model->insert($data);
            $_SESSION['pesan'] = "Create Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('level'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('level/update_action'),
		'id' => set_value('id', $row->id),
		'level' => set_value('level', $row->level),
	    );
            $this->load->view('header');
            $this->load->view('level/level_form', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('level'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Level_model->update($this->input->post('id', TRUE), $data);
            $_SESSION['pesan'] = "Update Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('level'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $this->Level_model->delete($id);
            $_SESSION['pesan'] = "Delete Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('level'));
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('level'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Level.php */
/* Location: ./application/controllers/Level.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2021-09-18 07:11:07 */
/* https://gocodings.web.com */
