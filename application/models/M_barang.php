<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_barang extends CI_Model {

	public $table = 'barang';
    public $id = 'id_barang';
    public $order = 'DESC';

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->order_by('id_barang', 'ASC');
        return $this->db->get($this->table)->row();
	}

	function get_by_id_barang($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->order_by('id_barang', 'ASC');
        return $this->db->get('barang_masuk_detail')->row();
	}

	function get_condition($cond)
    {
        $this->db->select('c.nama as nama_customer,nama_acara,a.id_barang as id_barangs,id_barang_masuk_detail,tanggal,b.nama as nama_barang,hilang,pinjam,rusak,satuan');
        $this->db->where($cond.' !=', 0);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->join('barang b', 'b.id_barang = a.id_barang');
        $this->db->join('barang_masuk bm', 'a.id_barang_masuk = bm.id_barang_masuk');
        $this->db->join('acara ac', 'ac.id_acara = bm.id_acara');
        $this->db->join('customer c', 'ac.id_customer = c.id_customer');
        $this->db->join('user u', 'ac.id_user = u.id_user');
        return $this->db->get('barang_masuk_detail a')->result();
	}

	function get_condition_dashboard($cond,$limit)
    {
        $this->db->select('c.nama as nama_customer,nama_acara,a.id_barang as id_barangs,id_barang_masuk_detail,tanggal,b.nama as nama_barang,hilang,pinjam,rusak,satuan');
        $this->db->where($cond.' !=', 0);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit($limit);
        $this->db->join('barang b', 'b.id_barang = a.id_barang');
        $this->db->join('barang_masuk bm', 'a.id_barang_masuk = bm.id_barang_masuk');
        $this->db->join('acara ac', 'ac.id_acara = bm.id_acara');
        $this->db->join('customer c', 'ac.id_customer = c.id_customer');
        $this->db->join('user u', 'ac.id_user = u.id_user');
        return $this->db->get('barang_masuk_detail a')->result();
	}
	
	function get_all()
    {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->table)->result();
	}

    function get_all_by_range($date1,$date2,$petugas,$cond)
    {
        $this->db->order_by('ac.tanggal', 'DESC');
        $this->db->where('a.'.$cond.'>',0);
        $this->db->where('u.id_user >=', $petugas);
        $this->db->where('u.id_user >=', $petugas);
        $this->db->where('ac.tanggal >=', $date1);
        $this->db->where('ac.tanggal <=', $date2);
        $this->db->join('barang b', 'b.id_barang = a.id_barang');
        $this->db->join('barang_masuk bk', 'bk.id_barang_masuk = a.id_barang_masuk');
        $this->db->join('acara ac', 'ac.id_acara = bk.id_acara');
        $this->db->join('user u', 'u.id_user = ac.id_user');
        return $this->db->get('barang_masuk_detail a')->result();
	}
	
	// insert data
    function insert($data)
    {
        $this->db->insert('barang', $data);
    }
	
	// update data
    function update($id, $data)
    {
        $this->db->where('id_barang', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
