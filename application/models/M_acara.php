<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_acara extends CI_Model {

	public $table = 'acara';
    public $id = 'id_acara';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->order_by('id_acara', 'ASC');
        return $this->db->get($this->table)->row();
	}

	function get_by_id_acara($id)
    {
        $this->db->where('id_acara', $id);
        $this->db->order_by('id_acara', 'ASC');
        return $this->db->get($this->table)->row();
	}
	
	function get_all()
    {
        $this->db->order_by('id_acara', 'DESC');
        $this->db->join('user u', 'u.id_user = a.id_user');
        $this->db->join('customer c', 'c.id_customer = a.id_customer');
        return $this->db->get('acara a')->result();
	}
	
	function get_all_limit($lim)
    {
        $this->db->limit($lim);
        $this->db->order_by('id_acara', 'DESC');
        $this->db->join('user u', 'u.id_user = a.id_user');
        $this->db->join('customer c', 'c.id_customer = a.id_customer');
        return $this->db->get('acara a')->result();
	}

	function get_by_petugas($id_user)
    {
        $this->db->where('u.id_user', $id_user);
        $this->db->limit(5);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->join('user u', 'u.id_user = a.id_user');
        $this->db->join('customer c', 'c.id_customer = a.id_customer');
        return $this->db->get('acara a')->result();
	}

	function get_all_petugas()
    {
        $this->db->order_by('nama_user', 'ASC');
        $this->db->where('level', 'petugas');
        return $this->db->get('user')->result();
	}
	
	// insert data
    function insert($data)
    {
        $this->db->insert('acara', $data);
    }
	
	// update data
    function update($id, $data)
    {
        $this->db->where('id_acara', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
