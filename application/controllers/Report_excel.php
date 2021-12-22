<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// End load library phpspreadsheet

class Report_ksr extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Silahkan Login terlebih dahulu</p>
			</div>');
				 redirect(site_url('login'));
			 }
		$this->load->model('m_report_ksr');
		$this->load->model('m_login');
	}
	
	public function index(){
		if (@$this->input->post('tgl',TRUE)==null) {
			$date1 = date('Y-m-d');
			$date2 = date('Y-m-d');
		}else {
			$range_date = $this->input->post('tgl',TRUE);
			
			$string = explode(' - ',$range_date);

			$date11 = explode('/',$string[0]);
			$date22 = explode('/',$string[1]);

			$date1 = $date11[2].'-'.$date11[1].'-'.$date11[0];
			$date2 = $date22[2].'-'.$date22[1].'-'.$date22[0];
		}
		$dash_date = null;
		if ($date1 == $date2) {
			$phpdate = strtotime( $date1 );
			$dash_date = date( 'd/m/Y', $phpdate );
		}else {
			$phpdate = strtotime( $date1 );
			$date11 = date( 'd/m/Y', $phpdate );

			$phpdate2 = strtotime( $date2 );
			$date22 = date( 'd/m/Y', $phpdate2 );

			$dash_date = $date11.' - '.$date22;
		}
		$id_shift = $this->session->userdata('id_shift');
		$data['dn_date1'] = $date1;
		$data['dn_date2'] = $date2;
		$data['report_date'] = $dash_date;
		$report_tiket = $this->m_report_ksr->get_by_date_tkt($date1,$date2,$id_shift);
		$report_produk = $this->m_report_ksr->get_by_date_prd($date1,$date2,$id_shift);

		$data['report_chart'] = $this->m_report_ksr->chart_by_date($date1,$date2,$id_shift);
		$data['tiket'] = $this->m_report_ksr->get_tiket();
		$data['shift'] = $this->m_report_ksr->get_shift($id_shift);

		$report = [];
		$n=0;
		foreach ($report_tiket as $report1) {
			$report[$n]['tgl_transaksi'] = $report1->tgl_transaksi;
			$report[$n]['jam_transaksi'] = $report1->jam_transaksi;
			$report[$n]['nama_tiket'] = $report1->nama_tiket;
			$report[$n]['jumlah'] = $report1->jumlah;
			$report[$n]['subtotal'] = $report1->subtotal;
			$n++;
		};

		foreach ($report_produk as $report2) {
			$report[$n]['tgl_transaksi'] = $report2->tgl_transaksi;
			$report[$n]['jam_transaksi'] = $report2->jam_transaksi;
			$report[$n]['nama_tiket'] = $report2->nama_tiket;
			$report[$n]['jumlah'] = $report2->jumlah;
			$report[$n]['subtotal'] = $report2->subtotal;
			$n++;
		};
		// echo json_encode($report);die;
		$data['report'] = json_decode(json_encode($report), FALSE);
		// print_r($data['report']);die;
		$this->template->load('template','report_ksr/v_report_ksr_list', $data);
	}

	public function update($id)
    {
        $row = $this->m_report_ksr->get_by_id($id);
	
        if ($row) {
			$data = array(
				'title' => 'Edit report_ksr',
				'action' => site_url('report_ksr/update_action'),
				'id_report_ksr' => $row->id_report_ksr,
				'nama_report_ksr' => $row->nama_report_ksr,
				'harga_report_ksr' => $row->harga_report_ksr
			);
            $this->template->load('template','report_ksr/v_report_ksr_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('report_ksr'));
        }
    }

    public function update_action()
    {
		$id_report_ksr = $this->input->post('f_id_report_ksr',TRUE);

		$data = array(
			'nama_report_ksr' => $this->input->post('f_nama_report_ksr',TRUE),
			'harga_report_ksr' => $this->input->post('f_harga_report_ksr',TRUE)
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_report_ksr->update($id_report_ksr, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					<p>Data Berhasil Diubah!</p>
			</div>');
			redirect(site_url('report_ksr'));
		}
		elseif ($error['code'] == 1062) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. report_ksrname sudah ada!</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		else {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Error</strong></h4>
						<p>Data Gagal Disimpan. '.$error['message'].'</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		$this->db->db_debug = $db_debug; //set it back
    }

    public function delete($id)
    {
        $row = $this->m_report_ksr->get_by_id($id);
		// print_r($row);die;
        if ($row) {
            $this->m_report_ksr->delete($id);
        }
	}

    public function delete2()
    {
		$id = $this->input->post('id_report_ksr');
        $row = $this->m_report_ksr->get_by_id($id);
        if ($row) {
			$username = $this->session->nama;
			$password = crypt($this->input->post('f_password'),"64r4m");
			
			$cek = $this->m_login->cek_login($username,$password)->num_rows();
			// print_r($cek);die;
			if ($cek>0) {
				$this->m_report_ksr->delete($id);
				if ($error['code'] == 0) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-success alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><strong>Sukses</strong></h4>
						<p>Data Berhasil Dihapus!</p>
				</div>');
				redirect(site_url('report_ksr'));
				}
			}
        }
	}
	
	public function excel()
	{
		$date1 = $this->uri->segment(3);
		$date2 = $this->uri->segment(4);

		// print_r($download_ex);die;
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Tanggal / Jam');
		$sheet->setCellValue('C1', 'No. Faktur');
		$sheet->setCellValue('D1', 'Item');
		$sheet->setCellValue('E1', 'Jumlah');
		$sheet->setCellValue('F1', 'Total');
		$sheet->setCellValue('G1', 'Asal');
		$sheet->setCellValue('H1', 'Metode Pembayaran');
		$sheet->setCellValue('I1', 'Referensi');
		$sheet->setCellValue('J1', 'Group');
		$sheet->setCellValue('K1', 'Noted');
		$sheet->setCellValue('L1', 'Kasir');

		$id_comp = $this->session->userdata('id_company');
		$pjl = $this->m_report_ksr->dn_get_by_date($date1,$date2,$id_comp);
		$no = 1;
		$x = 2;
		foreach($pjl as $row)
		{
			$asal=null;
			if ($row->asal_indonesia != null) {
				$asal = $row->asal_indonesia;
			}else {
				$asal = $row->asal_internasional;
			}
			$phpdate = strtotime( $row->tgl_transaksi );
			$date11 = date( 'd/m/Y', $phpdate );
			$jam2 = strtotime($row->jam_transaksi);
			$jam = date('H:i',$jam2);

			$no_pjl = strtoupper(substr(md5($row->id_report_ksr), 0, 5));

			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValue('B'.$x, $date11.' '.$jam);
			$sheet->setCellValue('C'.$x, '#'.$no_pjl);
			$sheet->setCellValue('D'.$x, $row->nama_tiket);
			$sheet->setCellValue('E'.$x, $row->jumlah);
			$sheet->setCellValue('F'.$x, $row->subtotal);
			$sheet->setCellValue('G'.$x, strtoupper($asal));
			$sheet->setCellValue('H'.$x, $row->nama_payment);
			$sheet->setCellValue('I'.$x, $row->nama_referensi);
			$sheet->setCellValue('J'.$x, $row->nama_group);
			$sheet->setCellValue('K'.$x, $row->noted);
			$sheet->setCellValue('L'.$x, $row->user_kasir);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'laporan-report_ksr-manaya';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function kasir(){
		if (@$this->input->post('tgl',TRUE)==null) {
			$date1 = date('Y-m-d');
			$date2 = date('Y-m-d');
		}else {
			$range_date = $this->input->post('tgl',TRUE);
			
			$string = explode(' - ',$range_date);

			$date11 = explode('/',$string[0]);
			$date22 = explode('/',$string[1]);

			$date1 = $date11[2].'-'.$date11[1].'-'.$date11[0];
			$date2 = $date22[2].'-'.$date22[1].'-'.$date22[0];
		}
		$dash_date = null;
		if ($date1 == $date2) {
			$phpdate = strtotime( $date1 );
			$dash_date = date( 'd/m/Y', $phpdate );
		}else {
			$phpdate = strtotime( $date1 );
			$date11 = date( 'd/m/Y', $phpdate );

			$phpdate2 = strtotime( $date2 );
			$date22 = date( 'd/m/Y', $phpdate2 );

			$dash_date = $date11.' - '.$date22;
		}
		$id_comp = $this->session->userdata('id_company');
		$data['dn_date1'] = $date1;
		$data['dn_date2'] = $date2;
		$data['report_date'] = $dash_date;
		$data['report_ksr'] = $this->m_report_ksr->get_by_date($date1,$date2,$id_comp);
		$data['report_chart'] = $this->m_report_ksr->chart_by_date($date1,$date2,$id_comp);
		$data['tiket'] = $this->m_report_ksr->get_tiket();
		
		$this->template->load('template','report_ksr/v_report_ksr_list', $data);
	}
}
?>