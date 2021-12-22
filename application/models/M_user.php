<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

	public $table = 'user';
    public $id = 'id_user';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->order_by('username', 'ASC');
        return $this->db->get($this->table)->row();
	}

	function get_by_username($id)
    {
        $this->db->where('username', $id);
        $this->db->order_by('username', 'ASC');
        return $this->db->get($this->table)->row();
	}

	function get_by_level($level)
    {
        $this->db->where('level', $level);
        $this->db->order_by('nama_user', 'ASC');
        return $this->db->get($this->table)->result();
	}
	
	function get_all()
    {
        $this->db->order_by('username', 'ASC');
        return $this->db->get($this->table)->result();
	}
	
	// insert data
    function insert($data)
    {
        $this->db->insert('user', $data);
    }
	
	// update data
    function update($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
