<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_pembaca_model extends CI_Model
{

    private $table = "users";
    private $_data = array('password');

    public function validate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level    = "Pembaca Gambar";


        $query = $this->db->query("SELECT * FROM users where username='$username' and password='$password' and level='$level'");

        if ($query->num_rows()) {
            // found row by username	
            $row = $query->row_array();

            // now check for the password
            if ($row['password'] == $password) {
                // we not need password to store in session
                unset($row['password']);
                $this->_data = $row;
                return ERR_NONE;
            }

            // password not match
            return ERR_INVALID_PASSWORD;
        } else {
            // not found
            return ERR_INVALID_USERNAME;
        }
    }

    public function get_data()
    {
        return $this->_data;
    }
}