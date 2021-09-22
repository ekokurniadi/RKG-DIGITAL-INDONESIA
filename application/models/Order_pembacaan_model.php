<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_pembacaan_model extends CI_Model
{

    public $table = 'order_pembacaan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('id_order', $q);
	$this->db->or_like('id_client', $q);
	$this->db->or_like('no_rekam_medis', $q);
	$this->db->or_like('dokter_pengirim', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('foto', $q);
	$this->db->or_like('indikasi_pemeriksaan', $q);
	$this->db->or_like('dokter_pemeriksa', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('id_pembaca', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('tarif', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_order', $q);
	$this->db->or_like('id_client', $q);
	$this->db->or_like('no_rekam_medis', $q);
	$this->db->or_like('dokter_pengirim', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('foto', $q);
	$this->db->or_like('indikasi_pemeriksaan', $q);
	$this->db->or_like('dokter_pemeriksa', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('id_pembaca', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('tarif', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}





/* End of file Order_pembacaan_model.php */
/* Location: ./application/models/Order_pembacaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2021-09-21 17:43:08 */
/* https://gocodings.web.app */