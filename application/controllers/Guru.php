<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public $tabel = 'guru';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_guru', 'mguru');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('Template');
	}

	public function index()
	{
		$data['title']   = 'List Guru Aktif';
		$data['content'] = 'guru/main';
		$data['vitamin'] = 'guru/main_vitamin';
		$this->template->template($data);
	}

	public function resign()
	{
		$data['title']   = 'List Guru Resign';
		$data['content'] = 'guru/resign/main';
		$data['vitamin'] = 'guru/resign/main_vitamin';
		$this->template->template($data);
	}

	public function show($tipe)
	{
		if($tipe == 'all'){
			$where = ['tanggal_keluar =' => NULL, 'deleted_at' => NULL];
		}elseif($tipe == 'resign'){
			$where = ['tanggal_keluar !=' => NULL];
		}

		$arr_guru = $this->mguru->get_guru($where);

		echo json_encode([
			'code'  => 200,
			'total' => $arr_guru->num_rows(),
			'data'  => $arr_guru->result()
		]);
	}

	public function create()
	{
		$data['obj_date']    = new DateTime();
		$data['title']       = 'Buat Guru Baru';
		$data['content']     = 'guru/form';
		$data['vitamin']     = 'guru/form_vitamin';
		$data['pendidikans'] = $this->mcore->get('parameter', '*', ['kategori' => 'pendidikan'], 'kode', 'ASC', NULL, NULL);
		$this->template->template($data);
	}

	public function store()
	{
		extract($this->input->post());
		$tgl_obj   = new DateTime();
		$dt_curr   = $tgl_obj->modify('now')->format('Y-m-d H:i:s');
		$nik       = $nik;
		$check_nik = $this->mcore->get('guru', '*', ['nik' => $nik], NULL, 'ASC', NULL, NULL);

		if($check_nik->num_rows() > 0){
			echo json_encode(['code' => 400]);
			exit;
		}

		$this->db->trans_start();

		# PROSES UPLOAD
		$new_images_name = '';

		if($_FILES['images']['size'] > 0){
			$config = [
				'upload_path'   => './assets/pages/img/avatars/',
				'allowed_types' => 'jpg|jpeg|png',
				'overwrite'     => TRUE,
				'encrypt_name'  => TRUE
			];
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('images')){
				$this->db->trans_rollback(); echo json_encode(['code' => 400, 'err' => $this->upload->display_errors()]); exit;
			}else{
				$new_images_name = $this->upload->data()['file_name'];
			}
		}
    # END PROSES UPLOAD

	  # INSERT GURU
		$data = [
			'nik'                 => $nik,
			'nama'                => $nama,
			'alamat'              => $alamat,
			'tempat_lahir'        => $tempat_lahir,
			'tanggal_lahir'       => $tgl_obj->createFromFormat('d-m-Y', $tanggal_lahir)->format('Y-m-d'),
			'no_telepon'          => $no_telepon,
			'photo'               => $new_images_name,
			'jenis_kelamin'       => $jenis_kelamin,
			'pendidikan_terakhir' => $pendidikan_terakhir,
			'tanggal_masuk'       => $tgl_obj->createFromFormat('d-m-Y', $tanggal_masuk)->format('Y-m-d'),
			'password'            => $this->encrypt->encode($password),
			'flag_admin'          => $flag_admin,
			'created_at'          => $dt_curr,
			'updated_at'          => $dt_curr
		];
		$exec = $this->mcore->store('guru', $data);
		if(!$exec){ $this->db->trans_rollback(); echo json_encode(['code' => 500]); exit; }
    # END INSERT EMPLOYEES

		$this->db->trans_commit();
		echo json_encode(['code' => 200]); 
		exit;
	}

	public function edit($nik)
	{
		# CHECK AVAIL NIK
		$arr_employees = $this->mcore->get('guru', '*', ['nik' => $nik], NULL, 'ASC', NULL, NULL);
		# END CHECK AVAIL NIK
		
		if($arr_employees->num_rows() == 0){
			show_error('NIK Tidak Ditemukan');
		}else{
			$data['tgl_obj']     = new DateTime();
			$data['employees']   = $arr_employees;
			$data['title']       = 'Edit Guru';
			$data['content']     = 'guru/form_edit';
			$data['vitamin']     = 'guru/form_edit_vitamin';
			$data['pendidikans'] = $this->mcore->get('parameter', '*', ['kategori' => 'pendidikan'], 'kode', 'ASC', NULL, NULL);
			$this->template->template($data);
		}

	}

	public function update()
	{
		if($this->input->method() == 'post'){
			$this->db->trans_start(TRUE);
			extract($this->input->post());
			$tgl_obj    = new DateTime();
			$dt_curr    = $tgl_obj->modify('now')->format('Y-m-d H:i:s');
			$nik        = $this->input->post('nik');

			# PROSES UPLOAD
			$new_images_name = $this->input->post('prev_images');

			if($_FILES['images']['size'] > 0){
				$config = [
					'upload_path'  => './assets/pages/img/avatars/',
					'allowed_types' => 'jpg|jpeg|png',
					'overwrite'    => TRUE,
					'encrypt_name' => TRUE
				];
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('images')){
					$this->db->trans_rollback(); echo json_encode(['code' => 400, 'err' => $this->upload->display_errors()]); exit;
				}else{
					$new_images_name = $this->upload->data()['file_name'];
				}
			}
	    # END PROSES UPLOAD

		  # UPDATE GURU
			$data = [
				'nik'                 => $nik,
				'nama'                => $nama,
				'alamat'              => $alamat,
				'tempat_lahir'        => $tempat_lahir,
				'tanggal_lahir'       => $tgl_obj->createFromFormat('d-m-Y', $tanggal_lahir)->format('Y-m-d'),
				'no_telepon'          => $no_telepon,
				'photo'               => $new_images_name,
				'jenis_kelamin'       => $jenis_kelamin,
				'pendidikan_terakhir' => $pendidikan_terakhir,
				'tanggal_masuk'       => $tgl_obj->createFromFormat('d-m-Y', $tanggal_masuk)->format('Y-m-d'),
				'password'            => $this->encrypt->encode($password),
				'flag_admin'          => $flag_admin,
				'updated_at'          => $dt_curr
			];
			$exec = $this->mcore->update('guru', $data, ['nik' => $nik]);
			if(!$exec){ $this->db->trans_rollback(); echo json_encode(['code' => 500]); exit; }
	    # END UPDATE GURU

			$this->db->trans_commit();
			echo json_encode(['code' => 200]);
			exit;
		}else{
			http_response_code(405);
		}

	}

	public function resigned()
	{
		$tanggal_keluar = new DateTime();
		$now            = new DateTime('now');

		if($this->input->method() == 'put'){
			$nik            = $this->input->input_stream('nik', TRUE);
			$tanggal_keluar = $tanggal_keluar->createFromFormat('d-m-Y', $this->input->input_stream('tanggal_keluar', TRUE))->format('Y-m-d');
			$exec           = $this->mcore->update('guru', ['tanggal_keluar' => $tanggal_keluar, 'updated_at' => $now->format('Y-m-d H:i:s')], ['nik' => $nik]);

			if($exec){
				echo json_encode(['code' => 200]);
				exit;
			}else{
				echo json_encode(['code' => 500]);
				exit;
			}
		}else{
			echo json_encode(['code' => 405]);
			exit;
		}

	}

	public function delete($nik)
	{
		$now = new DateTime('now');

		if($this->input->method() == 'delete'){
			$exec = $this->mcore->update('guru', ['deleted_at' => $now->format('Y-m-d H:i:s')], ['nik' => $nik]);

			if($exec){
				echo json_encode(['code' => 200]);
				exit;
			}else{
				echo json_encode(['code' => 500]);
				exit;
			}
		}else{
			echo json_encode(['code' => 405]);
			exit;
		}

	}

	public function reset()
	{
		if($this->input->method() == 'put'){
			$nik = $this->input->input_stream('nik', TRUE);
			$new_password = $this->encrypt->encode($this->input->input_stream('new_password',TRUE));

			$exec = $this->mcore->update('guru', ['password' => $new_password], ['nik' => $nik]);

			if($exec){
				echo json_encode(['code' => 200, 'nik' => $nik, 'p' => $new_password]);
				exit;
			}else{
				echo json_encode(['code' => 500]);
				exit;
			}
		}else{
			http_response_code(405);
		}
	}

	public function chk_nik($nik)
	{
		$exec = $this->mcore->get($this->table, '*', ['nik' => $nik], NULL, 'ASC', NULL, NULL);
		if($exec->num_rows() == 1){
			http_response_code(400);
		}else{
			http_response_code(200);
		}
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */