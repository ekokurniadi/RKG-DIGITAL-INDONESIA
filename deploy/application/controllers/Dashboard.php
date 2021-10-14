<?php

class Dashboard extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('client/header');
        $this->load->view('client/index');
        $this->load->view('client/footer');
    }

    public function lengkapi_data()
    {
        $this->_rule();
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'tempat' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'telepon' => $this->input->post('no_telp', TRUE),
                'lengkap' => 1
            );
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('users', $data);
            $_SESSION['pesan'] = "Selamat anda berhasil melengkapi data anda.";
            $_SESSION['tipe'] = "success";
            redirect(site_url('dashboard'));
        }
    }

    public function _rule()
    {

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function profile()
    {
        $id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
        $row = $this->Users_model->get_by_id($id);
        $data = array(
            'button' => 'Update',
            'action' => site_url('dashboard/update_action'),
            'id' => set_value('id', $row->id),
            'nama' => set_value('nama', $row->nama),
            'username' => set_value('username', $row->username),
            'password' => set_value('password', $row->password),
            'level' => set_value('level', $row->level),
        );
        $this->load->view('client/header');
        $this->load->view('client/profile', $data);
        $this->load->view('client/footer');
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->profile($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password', TRUE),
                'level' => $this->input->post('level', TRUE),
            );

            $this->Users_model->update($this->input->post('id', TRUE), $data);
            $_SESSION['pesan'] = "Update Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('dashboard'));
        }
    }
    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('level', 'level', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
