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
	}

	public function index(){
		$data['dt_barang'] = $this->m_barang->get_all();
		$data['dt_hilang'] = $this->m_barang->get_condition_dashboard('hilang',10);
		$data['dt_rusak'] = $this->m_barang->get_condition_dashboard('rusak',10);
		$data['dt_pinjam'] = $this->m_barang->get_condition_dashboard('pinjam',10);
		// echo json_encode($data);die;
		$this->template->load('template','home', $data);
	}
}

?>