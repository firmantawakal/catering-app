<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends CI_Controller {

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

		$this->load->model('m_barang');
		$this->load->model('m_fungsi');
		$this->load->model('m_satuan');
		$this->load->model('m_user');
	}
	
	public function index(){
		$data['barang'] = $this->m_barang->get_all();
		$this->template->load('template','barang/v_barang_list', $data);
	}

	public function hilang(){
		$data['condition'] = $this->m_barang->get_condition('hilang');
		$data['petugas'] = $this->m_user->get_by_level('petugas');
		$this->template->load('template','barang/v_barang_hilang', $data);
	}

	public function rusak(){
		$data['condition'] = $this->m_barang->get_condition('rusak');
		$data['petugas'] = $this->m_user->get_by_level('petugas');
		$this->template->load('template','barang/v_barang_rusak', $data);
	}

	public function pinjam(){
		$data['condition'] = $this->m_barang->get_condition('pinjam');
		$data['petugas'] = $this->m_user->get_by_level('petugas');
		$this->template->load('template','barang/v_barang_pinjam', $data);
	}

	// LAST WORK ====================
	public function report($cond){
		$range_date = $this->string_->split_date($_GET['date_range']);
		$id_petugas = $_GET['id_user'];
		$data['barang'] = $this->m_barang->get_all_by_range($range_date['date1'],$range_date['date2'],$id_petugas,$cond);
		$data['condition'] = $cond;
		if($cond == 'hilang'){
			$data['title'] = 'Laporan Barang Hilang';
		}else if($cond == 'rusak'){
			$data['title'] = 'Laporan Barang Rusak';
		}else if($cond == 'pinjam'){
			$data['title'] = 'Laporan Barang Pinjam';
		}
		// echo json_encode($data['barang']);die;
		$this->template->load('template','barang/v_barang_report', $data);
	}
	

	public function create()
	{
		$data = array(
				'title' => 'Tambah',
				'action' => site_url('barang/create_action'),
				'id_barang' => '',
				'nama' => '',
				'satuan' => '',
				'jenis' => '',
				'data' => '',
				'fungsi' => ''
		);
		$data['list_fungsi'] = $this->m_fungsi->get_all();
		$data['list_satuan'] = $this->m_satuan->get_all();
		// echo json_encode($data);die;
		$this->template->load('template','barang/v_barang_form',$data);
	}

	public function create_action()
	{
		$data = array(
			'nama' => $this->input->post('f_nama',TRUE),
			'satuan' => $this->input->post('f_satuan',TRUE),
			'jenis' => $this->input->post('f_jenis',TRUE),
			'data' => $this->input->post('f_data',TRUE),
			'fungsi' => $this->input->post('f_fungsi',TRUE)
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries
		$this->m_barang->insert($data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('barang'));
		}
		else {
			$this->session->set_flashdata('message', 'save-failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	public function update($id)
    {
        $row = $this->m_barang->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title'       => 'Edit barang',
				'action'      => site_url('barang/update_action'),
				'id_barang' => $row->id_barang,
				'nama' => $row->nama,
				'satuan' => $row->satuan,
				'jenis' => $row->jenis,
				'data' => $row->data,
				'fungsi' => $row->fungsi
			);
			$data['list_fungsi'] = $this->m_fungsi->get_all();
			$data['list_satuan'] = $this->m_satuan->get_all();
			$this->template->load('template','barang/v_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('barang'));
        }
    }

    public function update_action()
    {
		$id_barang = $this->input->post('f_id_barang',TRUE);
        
		$data = array(
			'nama' => $this->input->post('f_nama',TRUE),
			'satuan' => $this->input->post('f_satuan',TRUE),
			'jenis' => $this->input->post('f_jenis',TRUE),
			'data' => $this->input->post('f_data',TRUE),
			'fungsi' => $this->input->post('f_fungsi',TRUE)
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_barang->update($id_barang, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', 'save-success');
			redirect(site_url('barang'));
		}
		else {
				$this->session->set_flashdata('message', 'save-failed');
				redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

    public function delete($id)
    {
        $row = $this->m_barang->get_by_id($id);

        if ($row) {
            $this->m_barang->delete($id);
			$this->session->set_flashdata('message', 'save-success');

            redirect($_SERVER['HTTP_REFERER']);
        } else {
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
?>