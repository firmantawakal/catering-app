<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
		}

		if ($this->session->userdata('level') == 'petugas') {
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->load->model('m_barang_keluar');
		$this->load->model('m_acara');
	}
	
	public function index(){
		$data['barang_keluar'] = $this->m_barang_keluar->get_all();
		$data['acara'] = $this->m_barang_keluar->get_all_acara();
		$this->template->load('template','barang_keluar/v_barang_keluar_list', $data);
	}

	public function report(){
        $range_date = $this->string_->split_date($_GET['date_range']);
		
		$data['barang_keluar'] = $this->m_barang_keluar->get_all_by_range($range_date['date1'],$range_date['date2']);

		$this->template->load('template','barang_keluar/v_barang_keluar_report', $data);
	}

	public function list_product($id_barang_keluar){
		$data['barang_keluar_detail'] = $this->m_barang_keluar->get_barang_keluar_detail($id_barang_keluar);
		$data['barang_keluar'] = $this->m_barang_keluar->get_by_id($id_barang_keluar);
		$this->template->load('template','barang_keluar/v_barang_keluar_detail', $data);
	}

	public function create_action()
	{
		$data = array(
			'id_acara' => $this->input->post('id_acara',TRUE),
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries
		$this->m_barang_keluar->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('barang_keluar'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	public function add_product($id)
    {
        $row = $this->m_barang_keluar->get_by_id($id);
	
        if ($row) {
			$data = array(
				'action'           => site_url('barang_keluar/update_action'),
				'id_barang_keluar' => $row->id_barang_keluar,
				'nama_acara'       => $row->nama_acara,
				'tanggal'          => $row->tanggal,
				'alamat_acara'     => $row->alamat_acara,
				'barang'           => $this->m_barang_keluar->get_all_barang(),
				'barang_temp'      => $this->m_barang_keluar->get_all_barang_temp($id),
			);
			$this->template->load('template','barang_keluar/v_barang_keluar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('barang_keluar'));
        }
    }

    public function add_product_action()
    {
		$id_barang_keluar = $this->input->post('id_barang_keluar',TRUE);

		$data = array(
			'id_barang_keluar' => $this->input->post('id_barang_keluar',TRUE),
			'id_barang' => $this->input->post('id_barang',TRUE),
			'qty' => $this->input->post('qty',TRUE),
		);
	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_barang_keluar->add_temp($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			redirect(site_url('barang_keluar/add_product/'.$id_barang_keluar));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

	public function save($id_barang_keluar)
    {
		$barang_temp = $this->m_barang_keluar->get_all_barang_temp($id_barang_keluar);
		
		// update stok
		foreach ($barang_temp as $brtmp) {
			$this->db->query('UPDATE barang SET data = data-'.$brtmp->qty.
							 ' WHERE id_barang = '.$brtmp->id_barang);
			
			$is_exist = $this->db->query('SELECT * from barang_keluar_detail 
							  where id_barang_keluar = '.$id_barang_keluar.' AND id_barang = '.$brtmp->id_barang)->result();
			
			if (count($is_exist)>0) {
				$this->db->query('UPDATE barang_keluar_detail SET qty = qty+'.$brtmp->qty.
							 ' WHERE id_barang_keluar='.$id_barang_keluar.' AND id_barang = '.$brtmp->id_barang);
			}else{
				$this->m_barang_keluar->insert_copy_temp($id_barang_keluar,$brtmp->id_barang);
			}
		}

		$this->m_barang_keluar->empty_temp($id_barang_keluar);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('barang_keluar'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }

	public function edit_product_action(){
		$id_barang_keluar = $this->input->post('id_barang_keluar',TRUE);
		$id_barang_keluar_det = $this->input->post('id_barang_keluar_det',TRUE);
		$id_barang = $this->input->post('id_barang',TRUE);

		$qty = $this->input->post('qty',TRUE);
		$qty_old = $this->input->post('qty_old',TRUE);
		
		$selisih = $qty_old - $qty;
		$selisih_abs = abs($selisih);

		if ($selisih < 0) {
			$this->db->query('UPDATE barang SET data = data-'.$selisih_abs.
							 ' WHERE id_barang = '.$id_barang);

			$this->db->query('UPDATE barang_keluar_detail SET qty = qty+'.$selisih_abs.
							 ' WHERE id_barang_keluar_detail = '.$id_barang_keluar_det);
			
			$error = $this->db->error();

			if ($error['code'] == 0) {
				$this->session->set_flashdata('message', 'save-success');
				redirect(site_url('barang_keluar/list_product/'.$id_barang_keluar));
			}
			else {
				$this->session->set_flashdata('message', 'save-failed');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->db->query('UPDATE barang SET data = data+'.$selisih_abs.
							 ' WHERE id_barang = '.$id_barang);

			$this->db->query('UPDATE barang_keluar_detail SET qty = qty-'.$selisih_abs.
							 ' WHERE id_barang_keluar_detail = '.$id_barang_keluar_det);

			$error = $this->db->error();

			if ($error['code'] == 0) {
				$this->session->set_flashdata('message', 'save-success');
				redirect(site_url('barang_keluar/list_product/'.$id_barang_keluar));
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
        $row = $this->m_barang_keluar->get_by_id_detail($id);

        if ($row) {
            $this->db->query('UPDATE barang SET data = data+'.$row->qty.
							 ' WHERE id_barang = '.$row->id_barang);

			$this->db->query('DELETE FROM barang_keluar_detail WHERE id_barang_keluar_detail = '.$id);
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
        $row = $this->m_barang_keluar->get_by_id_temp($id);

        if ($row) {
            $this->m_barang_keluar->delete_temp($id);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
?>