<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encrypt');
	}

	public function index()
	{
		if($this->session->userdata('id') && $this->session->userdata('name') && $this->session->userdata('role')){
			redirect('dashboard','refresh');
		}else{
			$now             = new DateTime('now');
			$expired         = new DateTime();
			$sekolah         = $this->mcore->get('sekolah', '*', NULL, NULL, 'ASC', NULL, NULL);
			$sn              = $sekolah->row()->sn;
			$status          = $sekolah->row()->status;
			$sekolah_expired = $expired->createFromFormat('Y-m-d', $this->encrypt->decode($sn));

			if($now->format('Y-m-d') > $sekolah_expired->format('Y-m-d') || $status == 0){
				redirect('expired', 'refresh');
				exit;
			}

			$data['nama_sekolah'] = $sekolah->row()->nama_sekolah;
			$data['motto']        = $sekolah->row()->motto;
			$data['alamat']       = $sekolah->row()->alamat;
			$data['logo']         = $sekolah->row()->logo;

			$this->load->view('login/form', $data);
		}
	}

	public function auth()
	{
		$nik      = $this->input->post('nik', TRUE);
		$password = $this->input->post('password', TRUE);

		$cek_username = $this->_check_username($nik, $password);
		$xusername    = json_decode($cek_username);

		if($xusername->total == '1'){
			$this->_set_session($xusername->id, $xusername->name, $xusername->role);
			echo json_encode(['code' => 200]);
			exit;
		}else{
			$cek_nik = $this->_check_nik($nik, $password);
			$xnik    = json_decode($cek_nik);

			if($xnik->total == '1'){
				$this->_set_session($xnik->id, $xnik->name, $xnik->role);
				echo json_encode(['code' => 200]);
				exit;
			}else{
				echo json_encode(['code' => 500]);
			}

		}
		exit;

	}

	public function _check_username($username, $password)
	{
		$exec = $this->mcore->get('admin', '*', ['username' => $username, 'deleted_at' => NULL], NULL, 'ASC', NULL, NULL);
		$total_data = $exec->num_rows();
		if(!$exec){
			return http_response_code(500);
		}else{
			if($exec->num_rows() == 0){
				return json_encode(['total' => '0']);
				exit;
			}else{
				return json_encode([
					'total' => $exec->num_rows(),
					'id'    => $exec->row()->id,
					'name'  => $exec->row()->username,
					'role'  => 'super_admin',
				]);
				exit;
			}
		}
	}

	public function _check_nik($nik, $password)
	{
		$exec = $this->mcore->get('guru', '*', ['nik' => $nik, 'flag_admin' => 1, 'tanggal_keluar' => NULL, 'deleted_at' => NULL], NULL, 'ASC', NULL, NULL);
		$total_data = $exec->num_rows();
		if(!$exec){
			return http_response_code(500);
		}else{
			if($exec->num_rows() == 0){
				return json_encode(['total' => '0']);
				exit;
			}else{
				return json_encode([
					'total' => $exec->num_rows(),
					'id'    => $exec->row()->nik,
					'name'  => $exec->row()->nama,
					'role'  => 'admin',
				]);
				exit;
			}
		}
	}

	// public function _check_nik($nik, $password)
	// {
	// 	$exec = $this->mcore->get('employees', '*', ['nik' => $nik], NULL, 'ASC', NULL, NULL);
	// 	$total_data = $exec->num_rows();
	// 	if($total_data == '0'){
	// 		$code   = '201';
	// 		$status = 'info';
	// 		$title  = ucfirst($status);
	// 		$desc   = "NIK Tidak Ditemukan";
	// 	}elseif($total_data > '1'){
	// 		$code   = '201';
	// 		$status = 'warning';
	// 		$title  = ucfirst($status);
	// 		$desc   = "NIK Duplikat, segera laporkan dengan Admin mengenai kendala ini";
	// 	}else{
	// 		$password_db = $exec->row()->password;
	// 		$id_employee = $exec->row()->id;
	// 		$name        = $exec->row()->name;
	// 		$id_role     = $exec->row()->id_role;

	// 		if(md5($password.SALT) == $password_db){
	// 			$code   = '200';
	// 			$status = 'success';
	// 			$title  = ucfirst($status);
	// 			$name   = $name;
	// 			$desc   = "Data Matched, Authentication Success...";

	// 			$arr_session = ['id' => $id_employee, 'name' => $name, 'role' => $id_role];
	// 			$this->session->set_userdata($arr_session);
	// 		}else{
	// 			$code   = '201';
	// 			$status = 'info';
	// 			$title  = ucfirst($status);
	// 			$desc   = "Password Salah";
	// 		}

	// 	}
	// 	return json_encode([
	// 		'code'   => $code,
	// 		'status' => $status,
	// 		'title'  => $title,
	// 		'desc'   => $desc,
	// 	]);
	// }

	

	public function _set_session($id, $name, $role)
	{
		$arr_session = ['id' => $id, 'name' => $name, 'role' => $role];
		$this->session->set_userdata($arr_session);
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('role');
		$this->session->set_flashdata('msg', 'Logout Berhasil');
		redirect('login','refresh');
	}

	public function dummy($pass)
	{
		echo md5($pass.SALT);
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */