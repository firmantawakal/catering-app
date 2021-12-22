<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satuan extends CI_Controller {

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

		$this->load->model('m_satuan');
	}
	
	public function index(){
		$data['satuan'] = $this->m_satuan->get_all();
		$this->template->load('template','satuan/v_satuan_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah',
				'action' => site_url('satuan/create_action'),
				'id_satuan' => '',
				'nama_satuan' => '',
		);
		$this->template->load('template','satuan/v_satuan_form',$data);
	}

	public function create_action()
	{
		$data = array(
			'nama_satuan' => $this->input->post('f_nama_satuan',TRUE),
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries
		$this->m_satuan->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('satuan'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	public function update($id)
    {
        $row = $this->m_satuan->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title'       => 'Edit satuan',
				'action'      => site_url('satuan/update_action'),
				'id_satuan'     => $row->id_satuan,
				'nama_satuan' => $row->nama_satuan,
			);
			$this->template->load('template','satuan/v_satuan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('satuan'));
        }
    }

    public function update_action()
    {
		$id_satuan = $this->input->post('f_id_satuan',TRUE);

		$data = array(
			'nama_satuan' => $this->input->post('f_nama_satuan',TRUE),
		);
	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_satuan->update($id_satuan, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('satuan'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

    public function delete($id)
    {
        $row = $this->m_satuan->get_by_id($id);

        if ($row) {
            $this->m_satuan->delete($id);
			$this->session->set_flashdata('message', 'save-success');

            redirect($_SERVER['HTTP_REFERER']);
        } else {
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
?>