<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_barang_keluar extends CI_Model {

	public $table = 'barang_keluar';
    public $id = 'id_barang_keluar';
    public $order = 'DESC';


	function get_by_id($id)
    {
        $this->db->where('id_barang_keluar', $id);
        $this->db->join('acara b', 'b.id_acara = a.id_acara');
        return $this->db->get('barang_keluar a')->row();
	}

	function get_all_by_status($status)
    {
        $this->db->where('status', $status);
        $this->db->join('acara b', 'b.id_acara = a.id_acara');
        return $this->db->get('barang_keluar a')->result();
	}

	function get_all_by_petugas($status,$id)
    {
        $this->db->where('id_user', $id);
        $this->db->where('status', $status);
        $this->db->join('acara b', 'b.id_acara = a.id_acara');
        return $this->db->get('barang_keluar a')->result();
	}
	
	function get_all()
    {
        $this->db->order_by('id_barang_keluar', 'DESC');
        $this->db->join('acara b', 'b.id_acara = a.id_acara');
        return $this->db->get('barang_keluar a')->result();
	}
	function get_barang_keluar_detail($id)
    {
        $this->db->where('id_barang_keluar', $id);
        $this->db->join('barang b', 'b.id_barang = a.id_barang');
        return $this->db->get('barang_keluar_detail a')->result();
	}
	
	function get_all_acara()
    {
        $SQL = 'SELECT c.*,u.* from acara c, customer u where u.id_customer = c.id_customer and not exists 
                (select * from barang_keluar a where a.id_acara = c.id_acara)';
        $query = $this->db->query($SQL);
        return $query->result();
	}
	// function get_all_acara()
    // {
    //     $SQL = 'select c.* from customer c where not exists (select * from acara a where a.id_customer = c.id_customer)';
    //     $query = $this->db->query($SQL);
    //     return $query->result();
	// }
	
	function get_all_by_name()
    {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->table)->result();
	}
	
	function get_all_barang()
    {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('barang')->result();
	}
	
	function get_all_barang_temp($id)
    {
        $this->db->join('barang c', 'c.id_barang = a.id_barang');
        $this->db->where('id_barang_keluar', $id);
        return $this->db->get('barang_keluar_detail_temp a')->result();
	}

    function get_by_id_temp($id)
    {
        $this->db->where('id_barang_keluar_detail', $id);
        return $this->db->get('barang_keluar_detail_temp')->row();
	}

    function get_by_id_detail($id)
    {
        $this->db->where('id_barang_keluar_detail', $id);
        return $this->db->get('barang_keluar_detail')->row();
	}

    function delete_temp($id)
    {
        $this->db->where('id_barang_keluar_detail', $id);
        $this->db->delete('barang_keluar_detail_temp');
    }
	
	// insert data
    function insert($data)
    {
        $this->db->insert('barang_keluar', $data);
    }

    function insert_copy_temp($id_barang_keluar,$id_barang)
    {
        $this->db->query('INSERT INTO barang_keluar_detail (id_barang_keluar,id_barang,qty) 
        SELECT id_barang_keluar,id_barang,qty FROM barang_keluar_detail_temp WHERE id_barang_keluar = '.$id_barang_keluar.' AND id_barang='.$id_barang);
    }

    function empty_temp($id)
    {
        $this->db->query('DELETE FROM barang_keluar_detail_temp WHERE id_barang_keluar = '.$id);
    }

    function add_temp($data)
    {
        $this->db->insert('barang_keluar_detail_temp', $data);
    }
	
	// update data
    function update($id, $data)
    {
        $this->db->where('id_barang_keluar', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
