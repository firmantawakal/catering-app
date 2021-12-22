<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

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

		$this->load->model('m_customer');
	}
	
	public function index(){
		$data['customer'] = $this->m_customer->get_all();
		$this->template->load('template','customer/v_customer_list', $data);
	}

	public function create()
	{
		$data = array(
				'title' => 'Tambah',
				'action' => site_url('customer/create_action'),
				'id_customer' => '',
				'nama' => '',
				'telp' => '',
				'alamat' => '',
				'email' => '',
		);
		$this->template->load('template','customer/v_customer_form',$data);
	}

	public function create_action()
	{
		$data = array(
			'nama' => $this->input->post('f_nama',TRUE),
			'telp' => $this->input->post('f_telp',TRUE),
			'alamat' => $this->input->post('f_alamat',TRUE),
			'email' => $this->input->post('f_email',TRUE),
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries
		$this->m_customer->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('customer'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	public function update($id)
    {
        $row = $this->m_customer->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title'       => 'Edit customer',
				'action'      => site_url('customer/update_action'),
				'id_customer'     => $row->id_customer,
				'nama' => $row->nama,
				'telp' => $row->telp,
				'alamat' => $row->alamat,
				'email' => $row->email,
			);
			$this->template->load('template','customer/v_customer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('customer'));
        }
    }

    public function update_action()
    {
		$id_customer = $this->input->post('f_id_customer',TRUE);

		$data = array(
			'nama' => $this->input->post('f_nama',TRUE),
			'telp' => $this->input->post('f_telp',TRUE),
			'alamat' => $this->input->post('f_alamat',TRUE),
			'email' => $this->input->post('f_email',TRUE),
		);
	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_customer->update($id_customer, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('customer'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

    public function delete($id)
    {
        $row = $this->m_customer->get_by_id($id);

        if ($row) {
            $this->m_customer->delete($id);
			$this->session->set_flashdata('message', 'save-success');

            redirect($_SERVER['HTTP_REFERER']);
        } else {
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
?>