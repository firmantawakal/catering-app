<?php
Class Login extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_user');
    }

    function index(){
        $this->load->view('login/v_login');
	}

	function aksi_login(){
		$secret_key = "6LfC7q8dAAAAAEq9Dwqx8pThhMgpdwwv4uqtgCu9";

		$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
		$response = json_decode($verify);
		if($response->success){
			$username = $this->input->post('login-username');
			$password = crypt($this->input->post('login-password'),"64r4m");
			
			$cek = $this->m_login->cek_login($username,$password)->num_rows();
			if($cek > 0){
					$data = $this->m_login->get_by_id($username);
					$data_session = array(
						'nama'   => $username,
						'level'  => $data->level,
						'nama-user'  => $data->nama_user,
						'status' => "login",
						'id_user' => $data->id_user,
					);
					
					$this->session->set_userdata($data_session);
					redirect(site_url("barang_masuk"));
			}
			else{
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger" id="success-alert">
					<p>Username / Password Salah</p>
				</div>');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('message', '
			<div class="alert alert-danger" id="success-alert">
				<p>Captcha Tidak Valid</p>
			</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
	  
	function change_password(){
		$id = $this->input->post('f_username',TRUE);
        $password = $this->input->post('f_password',TRUE);
		
		$data = array(
			'password' => crypt($password,"64r4m")
		);
		
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->m_user->update($id, $data);
		$error = $this->db->error();

		if ($error['code'] == 0) {
			$this->session->set_flashdata('message', '
			<div class="alert alert-success alert-dismissable" id="success-alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><strong>Sukses</strong></h4>
					Password Berhasil Diubah! Silahkan login
			</div>');
			redirect(site_url('login'));
		}
		$this->db->db_debug = $db_debug; //set it back
	}

	function reset(){
        $this->load->view('login/v_reset');
	}

	function aksi_reset(){
		$random_str = $this->string_->generateRandomString();
		$send_to = $this->input->post('f_email',TRUE);
		 // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
		$url = base_url('reset_validation/'.$random_str);
		// print_r($url);die;
		$data['reset_id'] = $random_str;
		$this->m_login->reset($send_to,$data);

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dapuldes@gmail.com';
        $mail->Password = 'd4puld35';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('no-reply@catering-app.id', 'Catering App');
        // Add a recipient
        $mail->addAddress($send_to);
        // Email subject
        $mail->Subject = 'Reset Password Login';
        // Set email format to HTML
        $mail->isHTML(true);
        // Email body content
        $mailContent = "Silahkan klik link berikut untuk melakukan reset password.<br><a href='".$url."' target='_blank'>Reset Password</a>";
		$mail->Body = $mailContent;
		$mail->send();

		redirect(site_url('login/reset/success'));
	}
	
	function reset_validation(){
		$data = $this->uri->segment(2);
		$cek = $this->m_login->validate_reset_id($data)->num_rows();
		if($cek > 0){
			$row = $this->m_login->get_by_reset_id($data);
			if ($row) {
				$data = array(
					'action' => site_url('login/change_password'),
					'username' => $row->username,
				);
				$this->load->view('login/v_change_password', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('login/reset'));
        }	
		}
		
	}
}

?>
