<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
		}

		// if ($this->session->userdata('level') != 'admin') {
		// 	redirect($_SERVER['HTTP_REFERER']);
		// }

		$this->load->model('m_barang_masuk');
		$this->load->model('m_barang_keluar');
		$this->load->model('m_acara');
	}
	
	public function index(){
		if ($this->session->userdata('level')=='petugas') {
			$data['barang_masuk'] = $this->m_barang_masuk->get_all_by_petugas($this->session->userdata('id_user'));
			// $data['acara'] = $this->m_barang_masuk->get_all_acara();
			// $data['acara'] = $this->m_barang_masuk->get_all_acara_by_petugas($this->session->userdata('id_user'));
			$this->template->load('template','barang_masuk/v_barang_masuk_list', $data);
		}else{
			$data['barang_masuk'] = $this->m_barang_masuk->get_all();
			$data['acara'] = $this->m_barang_masuk->get_all_acara();
			$this->template->load('template','barang_masuk/v_barang_masuk_list', $data);
		}
		
	}

	public function report(){
        $range_date = $this->string_->split_date($_GET['date_range']);
		
		$data['barang_masuk'] = $this->m_barang_masuk->get_all_by_range($range_date['date1'],$range_date['date2']);

		$this->template->load('template','barang_masuk/v_barang_masuk_report', $data);
	}

	public function create(){
		if ($this->session->userdata('level')=='petugas') {
			$data['barang_keluar'] = $this->m_barang_keluar->get_all_by_petugas(0,$this->session->userdata('id_user'));
			$data['acara'] = $this->m_barang_masuk->get_all_acara();
			$this->template->load('template','barang_masuk/v_barang_masuk_create', $data);
		}else{
			$data['barang_keluar'] = $this->m_barang_keluar->get_all_by_status(0);
			$data['acara'] = $this->m_barang_masuk->get_all_acara();
			$this->template->load('template','barang_masuk/v_barang_masuk_create', $data);
		}
		
	}

	public function list_product($id_barang_keluar){
		$data['barang_keluar'] = $this->m_barang_keluar->get_by_id($id_barang_keluar);
		$data['barang_keluar_detail'] = $this->m_barang_keluar->get_barang_keluar_detail($id_barang_keluar);
		$this->template->load('template','barang_masuk/v_barang_masuk_detail', $data);
	}

	public function detail($id_barang_masuk){
		$data['barang_masuk'] = $this->m_barang_masuk->get_by_id($id_barang_masuk);
		$data['barang_masuk_detail'] = $this->m_barang_masuk->get_barang_masuk_detail($id_barang_masuk);
		// echo json_encode($data['barang_masuk_detail']);die;
		$this->template->load('template','barang_masuk/v_barang_masuk_list_detail', $data);
	}

	public function create_action()
	{
		$id_barang = $this->input->post('id_barang',TRUE);
		$qty = $this->input->post('qty',TRUE);
		$masuk = $this->input->post('masuk',TRUE);
		$rusak = $this->input->post('rusak',TRUE);
		$pinjam = $this->input->post('pinjam',TRUE);
		$hilang = $this->input->post('hilang',TRUE);

		$data = array(
			'id_acara' => $this->input->post('id_acara',TRUE),
		);

		$id_br_masuk = $this->m_barang_masuk->insert($data);
		for ($i=0; $i < count($id_barang); $i++) { 
			$data2 = array(
				'id_barang_masuk' => $id_br_masuk,
				'id_barang' => $id_barang[$i],
				'qty' => $qty[$i],
				'masuk' => $masuk[$i],
				'pinjam' => $pinjam[$i],
				'hilang' => $hilang[$i],
				'rusak' => $rusak[$i],
			);

			if ($masuk[$i]>0) {
				$this->db->query('UPDATE barang SET data = data+'.$masuk[$i].
							 ' WHERE id_barang = '.$id_barang[$i]);
			}

			$this->m_barang_masuk->insert_detail($data2);
		}

		$id_acr = $this->input->post('id_acara',TRUE);
		$this->db->query('UPDATE barang_keluar SET status = 1 WHERE id_acara = '.$id_acr);
		
		$this->session->set_flashdata('message', 'save-success');
		redirect(site_url('barang_masuk/create'));
	}

	public function add_product($id)
    {
        $row = $this->m_barang_masuk->get_by_id($id);
	
        if ($row) {
			$data = array(
				'action'           => site_url('barang_masuk/update_action'),
				'id_barang_masuk' => $row->id_barang_masuk,
				'nama_acara'       => $row->nama_acara,
				'tanggal'          => $row->tanggal,
				'alamat_acara'     => $row->alamat_acara,
				'barang'           => $this->m_barang_masuk->get_all_barang(),
				'barang_temp'      => $this->m_barang_masuk->get_all_barang_temp($id),
			);
			$this->template->load('template','barang_masuk/v_barang_masuk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('barang_masuk'));
        }
    }

    public function add_product_action()
    {
		$id_barang_masuk = $this->input->post('id_barang_masuk',TRUE);

		$data = array(
			'id_barang_masuk' => $this->input->post('id_barang_masuk',TRUE),
			'id_barang' => $this->input->post('id_barang',TRUE),
			'qty' => $this->input->post('qty',TRUE),
		);
	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_barang_masuk->add_temp($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			redirect(site_url('barang_masuk/add_product/'.$id_barang_masuk));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

	public function save($id_barang_masuk)
    {
		$this->db->query('UPDATE barang_masuk SET status = 1
						  WHERE id_barang_masuk = '.$id_barang_masuk);
						  
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('barang_masuk'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }

	public function edit_product_action(){
		$id_barang_masuk = $this->input->post('id_barang_masuk',TRUE);
		$id_barang_masuk_det = $this->input->post('id_barang_masuk_det',TRUE);
		$id_barang = $this->input->post('id_barang',TRUE);

		$masuk = $this->input->post('masuk',TRUE);
		$masuk_old = $this->input->post('masuk_old',TRUE);
		$pinjam = $this->input->post('pinjam',TRUE);
		$hilang = $this->input->post('hilang',TRUE);
		$rusak = $this->input->post('rusak',TRUE);
		
		$selisih = $masuk_old - $masuk;
		$selisih_abs = abs($selisih);

		if ($selisih < 0) {
			$this->db->query('UPDATE barang SET data = data+'.$selisih_abs.
							 ' WHERE id_barang = '.$id_barang);

			$this->db->query('UPDATE barang_masuk_detail SET masuk = '.$masuk.', pinjam = '.$pinjam.
							', hilang = '.$hilang.', rusak = '.$rusak.
							 ' WHERE id_barang_masuk_detail = '.$id_barang_masuk_det);
			
			$error = $this->db->error();

			if ($error['code'] == 0) {
				$this->session->set_flashdata('message', 'save-success');
				redirect(site_url('barang_masuk/detail/'.$id_barang_masuk));
			}
			else {
				$this->session->set_flashdata('message', 'save-failed');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->db->query('UPDATE barang SET data = data-'.$selisih_abs.
							 ' WHERE id_barang = '.$id_barang);

			$this->db->query('UPDATE barang_masuk_detail SET masuk = '.$masuk.', pinjam = '.$pinjam.
							 ', hilang = '.$hilang.', rusak = '.$rusak.
							  ' WHERE id_barang_masuk_detail = '.$id_barang_masuk_det);
			 
			$error = $this->db->error();

			if ($error['code'] == 0) {
				$this->session->set_flashdata('message', 'save-success');
				redirect(site_url('barang_masuk/detail/'.$id_barang_masuk));
			}
			else {
				$this->session->set_flashdata('message', 'save-failed');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function edit_pinjam(){
		$id_barang_masuk_det = $this->input->post('id_barang_masuk_det',TRUE);
		$id_barang = $this->input->post('id_barang',TRUE);

		$kembali = $this->input->post('kembali',TRUE);
		$pinjam = $this->input->post('pinjam',TRUE);
		$selisih = $pinjam - $kembali;
		
		if ($kembali > $pinjam) {
			$this->session->set_flashdata('message', 'save-failed');
				redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->db->query('UPDATE barang SET data = data+'.$kembali.
							 ' WHERE id_barang = '.$id_barang);

			$this->db->query('UPDATE barang_masuk_detail SET pinjam = '.$selisih.
							  ' WHERE id_barang_masuk_detail = '.$id_barang_masuk_det);
			 
			$error = $this->db->error();

			if ($error['code'] == 0) {
				$this->session->set_flashdata('message', 'save-success');
				redirect(site_url('pinjam'));
			}
			else {
				$this->session->set_flashdata('message', 'save-failed');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	// remove product dari page list product
    public function remove_list_product($id)
    {
        $row = $this->m_barang_masuk->get_by_id_detail($id);

        if ($row) {
            $this->db->query('UPDATE barang SET data = data+'.$row->qty.
							 ' WHERE id_barang = '.$row->id_barang);

			$this->db->query('DELETE FROM barang_masuk_detail WHERE id_barang_masuk_detail = '.$id);
			$this->session->set_flashdata('message', 'save-success');

            redirect($_SERVER['HTTP_REFERER']);
        } else {
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}

	// remove product dari page add product
    public function remove_product($id)
    {
        $row = $this->m_barang_masuk->get_by_id_temp($id);

        if ($row) {
            $this->m_barang_masuk->delete_temp($id);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
?>