<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_barang_masuk extends CI_Model {

	public $table = 'barang_masuk';
    public $id = 'id_barang_masuk';
    public $order = 'DESC';


	function get_by_id($id)
    {
        $this->db->where('id_barang_masuk', $id);
        $this->db->join('acara b', 'b.id_acara = a.id_acara');
        return $this->db->get('barang_masuk a')->row();
	}

    function get_all_by_range($date1,$date2)
    {
        $this->db->order_by('ac.tanggal', 'DESC');
        $this->db->where('ac.tanggal >=', $date1);
        $this->db->where('ac.tanggal <=', $date2);
        $this->db->join('barang b', 'b.id_barang = a.id_barang');
        $this->db->join('barang_masuk bk', 'bk.id_barang_masuk = a.id_barang_masuk');
        $this->db->join('acara ac', 'ac.id_acara = bk.id_acara');
        return $this->db->get('barang_masuk_detail a')->result();
	}
	
	function get_all()
    {
        $this->db->join('acara b', 'b.id_acara = a.id_acara');
        return $this->db->get('barang_masuk a')->result();
	}
	
	function get_all_by_petugas($id)
    {
        $this->db->where('b.id_user', $id);
        $this->db->join('acara b', 'b.id_acara = a.id_acara');
        return $this->db->get('barang_masuk a')->result();
	}

	function get_barang_masuk_detail($id)
    {
        $this->db->where('id_barang_masuk', $id);
        $this->db->join('barang b', 'b.id_barang = a.id_barang');
        return $this->db->get('barang_masuk_detail a')->result();
	}
	
	function get_all_acara()
    {
        $SQL = 'select c.* from acara c where not exists 
                (select * from barang_masuk a where a.id_acara = c.id_acara)';
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
        $this->db->where('id_barang_masuk', $id);
        return $this->db->get('barang_masuk_detail_temp a')->result();
	}

    function get_by_id_temp($id)
    {
        $this->db->where('id_barang_masuk_detail', $id);
        return $this->db->get('barang_masuk_detail_temp')->row();
	}

    function get_by_id_detail($id)
    {
        $this->db->where('id_barang_masuk_detail', $id);
        return $this->db->get('barang_masuk_detail')->row();
	}

    function delete_temp($id)
    {
        $this->db->where('id_barang_masuk_detail', $id);
        $this->db->delete('barang_masuk_detail_temp');
    }
	
	// insert data
    function insert($data){
        $this->db->insert('barang_masuk', $data);
        $insert_id = $this->db->insert_id();
     
        return  $insert_id;
     }

    function insert_detail($data)
    {
        $this->db->insert('barang_masuk_detail', $data);
    }

    function insert_copy_temp($id)
    {
        $this->db->query('INSERT INTO barang_masuk_detail (id_barang_masuk,id_barang,qty) 
        SELECT id_barang_masuk,id_barang,qty FROM barang_masuk_detail_temp WHERE id_barang_masuk_detail = '.$id);
    }

    function empty_temp($id)
    {
        $this->db->query('DELETE FROM barang_masuk_detail_temp WHERE id_barang_masuk = '.$id);
    }

    function add_temp($data)
    {
        $this->db->insert('barang_masuk_detail_temp', $data);
    }
	
	// update data
    function update($id, $data)
    {
        $this->db->where('id_barang_masuk', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
