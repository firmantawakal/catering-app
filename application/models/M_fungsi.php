<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_fungsi extends CI_Model {

	public $table = 'fungsi';
    public $id = 'id_fungsi';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->order_by('id_fungsi', 'ASC');
        return $this->db->get($this->table)->row();
	}

	function get_by_id_fungsi($id)
    {
        $this->db->where('id_fungsi', $id);
        $this->db->order_by('id_fungsi', 'ASC');
        return $this->db->get($this->table)->row();
	}
	
	function get_all()
    {
        $this->db->order_by('nama_fungsi', 'asc');
        return $this->db->get($this->table)->result();
	}
	
	function get_all_by_name()
    {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->table)->result();
	}
	
	// insert data
    function insert($data)
    {
        $this->db->insert('fungsi', $data);
    }
	
	// update data
    function update($id, $data)
    {
        $this->db->where('id_fungsi', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
