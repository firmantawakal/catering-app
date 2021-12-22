<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fungsi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
		}

		if ($this->session->userdata('level') != 'admin') {
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->load->model('m_fungsi');
	}
	
	public function index(){
		$data['fungsi'] = $this->m_fungsi->get_all();
		$this->template->load('template','fungsi/v_fungsi_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah',
				'action' => site_url('fungsi/create_action'),
				'id_fungsi' => '',
				'nama_fungsi' => '',
		);
		$this->template->load('template','fungsi/v_fungsi_form',$data);
	}

	public function create_action()
	{
		$data = array(
			'nama_fungsi' => $this->input->post('f_nama_fungsi',TRUE),
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries
		$this->m_fungsi->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('fungsi'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	public function update($id)
    {
        $row = $this->m_fungsi->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title'       => 'Edit Fungsi',
				'action'      => site_url('fungsi/update_action'),
				'id_fungsi'     => $row->id_fungsi,
				'nama_fungsi' => $row->nama_fungsi,
			);
			$this->template->load('template','fungsi/v_fungsi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('fungsi'));
        }
    }

    public function update_action()
    {
		$id_fungsi = $this->input->post('f_id_fungsi',TRUE);

		$data = array(
			'nama_fungsi' => $this->input->post('f_nama_fungsi',TRUE),
		);
	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_fungsi->update($id_fungsi, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('fungsi'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

    public function delete($id)
    {
        $row = $this->m_fungsi->get_by_id($id);

        if ($row) {
            $this->m_fungsi->delete($id);
			$this->session->set_flashdata('message', 'save-success');

            redirect($_SERVER['HTTP_REFERER']);
        } else {
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
?>