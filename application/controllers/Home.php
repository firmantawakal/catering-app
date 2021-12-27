<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
		}

		$this->load->model('m_barang');
		$this->load->model('m_acara');
	}

	public function index(){
		if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='peralatan') {
			$data['acara'] = $this->m_acara->get_all_limit(10);
			$data['dt_barang'] = $this->m_barang->get_all();
			$data['dt_hilang'] = $this->m_barang->get_condition_dashboard('hilang',10);
			$data['dt_rusak'] = $this->m_barang->get_condition_dashboard('rusak',10);
			$data['dt_pinjam'] = $this->m_barang->get_condition_dashboard('pinjam',10);
			$this->template->load('template','home', $data);
		}else{
			$id_user = $this->session->userdata('id_user');
			$data['acara'] = $this->m_acara->get_by_petugas($id_user);
			$data['dt_pinjam'] = $this->m_barang->get_condition_dashboard_petugas('pinjam',10,$id_user);
			// echo json_encode($data);die;
			$this->template->load('template','home_petugas', $data);
		}
	}
}

?>