<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Team extends MY_Controller
{



    function __construct()
    {
        parent::__construct();
        $this->load->model('Team_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $team = $this->Team_model->get_all();

        $data = array(
            'team_data' => $team
        );
        $this->load->view('header');
        $this->load->view('team/team_list', $data);
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
                $where .= " AND (foto LIKE '%$search%'
	 OR nama LIKE '%$search%'
	 OR jabatan LIKE '%$search%'
	 )";
            }
        }

        if (isset($orders)) {
            if ($orders != '') {
                $order = $orders;
                $order_column = ['foto', 'nama', 'jabatan',];
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
        $fetch = $this->db->query("SELECT * from team $where");
        $fetch2 = $this->db->query("SELECT * from team ");
        foreach ($fetch->result() as $rows) {
            $button1 = "<a href=" . base_url('team/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
            $button2 = "<a href=" . base_url('team/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
            $button3 = "<a href=" . base_url('team/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";

            $sub_array = array();
            $sub_array[] = $index;
            $sub_array[] = "<img src='" . base_url('uploads/user_image/') . $rows->foto . "' class='img-fluid' width='80px'>";
            $sub_array[] = $rows->nama;
            $sub_array[] = $rows->jabatan;

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
        $row = $this->Team_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'foto' => $row->foto,
                'nama' => $row->nama,
                'jabatan' => $row->jabatan,
            );
            $this->load->view('header');
            $this->load->view('team/team_read', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('team'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('team/create_action'),
            'id' => set_value('id'),
            'foto' => set_value('foto'),
            'nama' => set_value('nama'),
            'jabatan' => set_value('jabatan'),
        );

        $this->load->view('header');
        $this->load->view('team/team_form', $data);
        $this->load->view('footer');
    }

    public function create_action()
    {

        $data = array(
            'foto' => upload_gambar_biasa('foto', 'uploads/user_image/', 'jpeg|png|jpg|gif|svg|SVG', 10000, 'foto'),
            'nama' => $this->input->post('nama', TRUE),
            'jabatan' => $this->input->post('jabatan', TRUE),
        );

        $this->Team_model->insert($data);
        $_SESSION['pesan'] = "Create Record Success";
        $_SESSION['tipe'] = "success";
        redirect(site_url('team'));
    }

    public function update($id)
    {
        $row = $this->Team_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('team/update_action'),
                'id' => set_value('id', $row->id),
                'foto' => set_value('foto', $row->foto),
                'nama' => set_value('nama', $row->nama),
                'jabatan' => set_value('jabatan', $row->jabatan),
            );
            $this->load->view('header');
            $this->load->view('team/team_form', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('team'));
        }
    }

    public function update_action()
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->Team_model->get_by_id($id);

        $data = array(
            'foto' => $_FILES['foto']['name'] == "" ? $row->foto : upload_gambar_biasa('foto', 'uploads/user_image/', 'jpeg|png|jpg|gif|svg|SVG', 10000, 'foto'),
            'nama' => $this->input->post('nama', TRUE),
            'jabatan' => $this->input->post('jabatan', TRUE),
        );

        $this->Team_model->update($this->input->post('id', TRUE), $data);
        $_SESSION['pesan'] = "Update Record Success";
        $_SESSION['tipe'] = "success";
        redirect(site_url('team'));
    }

    public function delete($id)
    {
        $row = $this->Team_model->get_by_id($id);

        if ($row) {
            $this->Team_model->delete($id);
            $_SESSION['pesan'] = "Delete Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('team'));
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('team'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('foto', 'foto', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Team.php */
/* Location: ./application/controllers/Team.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2021-09-20 08:25:18 */
/* https://gocodings.web.com */