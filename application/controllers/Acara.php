<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acara extends CI_Controller {

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

		$this->load->model('m_acara');
		$this->load->model('m_customer');
	}
	
	public function index(){
		$data['acara'] = $this->m_acara->get_all();
		$this->template->load('template','acara/v_acara_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah',
				'action' => site_url('acara/create_action'),
				'id_acara' => '',
				'id_user' => '',
				'id_customer' => '',
				'nama_acara' => '',
				'tanggal' => '',
				'alamat' => '',
				'jumlah_pax' => '',
		);
		$data['customer'] = $this->m_customer->get_all_by_name();
		$data['petugas'] = $this->m_acara->get_all_petugas();

		$this->template->load('template','acara/v_acara_form',$data);
	}

	public function create_action()
	{
		$data = array(
			'id_customer' => $this->input->post('f_id_customer',TRUE),
			'id_user' => $this->input->post('f_id_user',TRUE),
			'nama_acara' => $this->input->post('f_nama_acara',TRUE),
			'tanggal' => $this->string_->date_to_db($this->input->post('f_tanggal',TRUE)),
			'alamat_acara' => $this->input->post('f_alamat',TRUE),
			'jumlah_pax' => $this->input->post('f_jumlah_pax',TRUE),
		);

		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries
		$this->m_acara->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('acara'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	public function update($id)
    {
        $row = $this->m_acara->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title'       => 'Edit acara',
				'action'      => site_url('acara/update_action'),
				'id_acara'     => $row->id_acara,
				'id_customer' => $row->id_customer,
				'nama_acara' => $row->nama_acara,
				'tanggal' => $this->string_->dbdate_to_indo($row->tanggal),
				'alamat' => $row->alamat_acara,
				'jumlah_pax' => $row->jumlah_pax,
			);
			// print_r($data);die;
			$data['customer'] = $this->m_customer->get_all_by_name();
			$data['petugas'] = $this->m_acara->get_all_petugas();

			$this->template->load('template','acara/v_acara_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('acara'));
        }
    }

    public function update_action()
    {
		$id_acara = $this->input->post('f_id_acara',TRUE);

		$data = array(
			'id_acara' => $this->input->post('f_id_acara',TRUE),
			'id_customer' => $this->input->post('f_id_customer',TRUE),
			'id_user' => $this->input->post('f_id_user',TRUE),
			'nama_acara' => $this->input->post('f_nama_acara',TRUE),
			'tanggal' => $this->string_->date_to_db($this->input->post('f_tanggal',TRUE)),
			'alamat_acara' => $this->input->post('f_alamat',TRUE),
			'jumlah_pax' => $this->input->post('f_jumlah_pax',TRUE),
		);

		// print_r($data);die;
	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_acara->update($id_acara, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('acara'));
		}
		else {
			// print_r($error);die;
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

    public function delete($id)
    {
        $row = $this->m_acara->get_by_id($id);

        if ($row) {
            $this->m_acara->delete($id);
			$this->session->set_flashdata('message', 'save-success');

            redirect($_SERVER['HTTP_REFERER']);
        } else {
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
?>