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
        $this->load->view('header');
        $this->load->view('index');
        $this->load->view('footer');
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
        $this->load->view('header');
        $this->load->view('profile', $data);
        $this->load->view('footer');
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
