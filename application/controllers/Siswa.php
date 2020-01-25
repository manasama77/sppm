<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public $table = 'siswa';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_siswa', 'msiswa');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('Template');
	}

	public function index()
	{
		$data['title']   = 'List Siswa Aktif';
		$data['content'] = 'siswa/main';
		$data['vitamin'] = 'siswa/main_vitamin';
		$this->template->template($data);
	}

	public function berhenti()
	{
		$data['title']   = 'List Siswa Berhenti';
		$data['content'] = 'siswa/berhenti/main';
		$data['vitamin'] = 'siswa/berhenti/main_vitamin';
		$this->template->template($data);
	}

	public function show($tipe)
	{
		if($tipe == 'all'){
			$where = ['siswa.tanggal_lulus =' => NULL, 'siswa.tanggal_berhenti =' => NULL, 'siswa.deleted_at' => NULL];
		}elseif($tipe == 'lulus'){
			$where = ['siswa.tanggal_lulus !=' => NULL, 'siswa.deleted_at' => NULL];
		}elseif($tipe == 'berhenti'){
			$where = ['siswa.tanggal_berhenti !=' => NULL, 'siswa.deleted_at' => NULL];
		}

		$arr_siswa = $this->msiswa->get_siswa($where);

		echo json_encode([
			'code'  => 200,
			'total' => $arr_siswa->num_rows(),
			'data'  => $arr_siswa->result()
		]);
	}

	public function create()
	{
		$data['obj_date'] = new DateTime();
		$data['title']    = 'Buat Siswa Baru';
		$data['content']  = 'siswa/form';
		$data['vitamin']  = 'siswa/form_vitamin';
		$data['kotas']    = $this->mcore->get('kota', '*', NULL, 'nama_kota', 'ASC', NULL, NULL);
		$data['kelass']   = $this->mcore->get('kelas', '*', NULL, 'id', 'ASC', NULL, NULL);
		$this->template->template($data);
	}

	public function store()
	{
		extract($this->input->post());
		$tgl_obj   = new DateTime();
		$dt_curr   = $tgl_obj->modify('now')->format('Y-m-d H:i:s');
		$check_nis = $this->mcore->get('siswa', '*', ['nis' => $nis], NULL, 'ASC', NULL, NULL);

		if($check_nis->num_rows() > 0){
			echo json_encode(['code' => 400]);
			exit;
		}

		$this->db->trans_start();

		# PROSES UPLOAD
		$new_images_name = '';

		if($_FILES['images']['size'] > 0){
			$config = [
				'upload_path'   => './assets/pages/img/avatars/siswa/',
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

	  # INSERT SISWA
		$data = [
			'nis'           => $nis,
			'nama'          => $nama,
			'tempat_lahir'  => $tempat_lahir,
			'tanggal_lahir' => $tgl_obj->createFromFormat('d-m-Y', $tanggal_lahir)->format('Y-m-d'),
			'nama_wali'     => $nama_wali,
			'alamat'        => $alamat,
			'kota'          => $kota,
			'kecamatan'     => $kecamatan,
			'desa'          => $desa,
			'kelas'         => $kelas,
			'tanggal_masuk' => $tgl_obj->createFromFormat('d-m-Y', $tanggal_masuk)->format('Y-m-d'),
			'jenis_kelamin' => $jenis_kelamin,
			'photo'         => $new_images_name,
			'created_at'    => $dt_curr,
			'updated_at'    => $dt_curr
		];
		$exec = $this->mcore->store('siswa', $data);
		if(!$exec){ $this->db->trans_rollback(); echo json_encode(['code' => 500]); exit; }
    # END INSERT SISWA
    
    # GENERATE SPP
		$kelass        = $this->mcore->get('kelas', 'spp', ['id' => $kelas], NULL, 'ASC', NULL, NULL);
		$nominal_spp   = $kelass->row()->spp;
		$periodes      = $this->mcore->get('periode', '*', ['is_active' => '1'], NULL, 'ASC', NULL, NULL);
		$periode_awal  = new DateTime($periodes->row()->periode_awal);
		$periode_akhir = new DateTime($periodes->row()->periode_akhir);
		$intv_bulan    = clone $periode_awal;
		$total_bulan   = ($periode_awal->diff($periode_akhir)->m + ($periode_awal->diff($periode_akhir)->y * 12) + 1);

		for($i = 0; $i < $total_bulan; $i++)
		{
			$object = [
				'nis'           => $nis,
				'bulan'         => $intv_bulan->format('m'),
				'tahun'         => $intv_bulan->format('Y'),
				'nominal_spp'   => $nominal_spp,
				'flag_bayar'    => '0',
				'tanggal_bayar' => NULL,
				'id_input'      => $this->session->userdata('id'),
				'role'          => $this->session->userdata('role'),
			];
			$this->mcore->store('spp', $object);
			$intv_bulan = $intv_bulan->add(new DateInterval("P1M"));
		}
    # END GENERATE SPP

		$this->db->trans_commit();
		echo json_encode(['code' => 200]); 
		exit;
	}

	public function edit($nis)
	{
		# CHECK AVAIL NIK
		$arr = $this->mcore->get('siswa', '*', ['nis' => $nis], NULL, 'ASC', NULL, NULL);
		# END CHECK AVAIL NIK
		
		if($arr->num_rows() == 0){
			show_error('NIS Tidak Ditemukan');
		}else{
			$data['tgl_obj'] = new DateTime();
			$data['siswas']  = $arr;
			$data['title']   = 'Edit Siswa';
			$data['content'] = 'siswa/form_edit';
			$data['vitamin'] = 'siswa/form_edit_vitamin';
			$data['kotas']   = $this->mcore->get('kota', '*', NULL, 'nama_kota', 'ASC', NULL, NULL);
			$data['kelass']  = $this->mcore->get('kelas', '*', NULL, 'id', 'ASC', NULL, NULL);
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
			$nis        = $this->input->post('nis');

			# PROSES UPLOAD
			$new_images_name = $this->input->post('prev_images');

			if($_FILES['images']['size'] > 0){
				$config = [
					'upload_path'  => './assets/pages/img/avatars/siswa/',
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
				'nama'          => $nama,
				'tempat_lahir'  => $tempat_lahir,
				'tanggal_lahir' => $tgl_obj->createFromFormat('d-m-Y', $tanggal_lahir)->format('Y-m-d'),
				'nama_wali'     => $nama_wali,
				'alamat'        => $alamat,
				'kota'          => $kota,
				'kecamatan'     => $kecamatan,
				'desa'          => $desa,
				'kelas'         => $kelas,
				'tanggal_masuk' => $tgl_obj->createFromFormat('d-m-Y', $tanggal_masuk)->format('Y-m-d'),
				'jenis_kelamin' => $jenis_kelamin,
				'photo'         => $new_images_name,
				'updated_at'    => $dt_curr
			];
			$exec = $this->mcore->update('siswa', $data, ['nis' => $nis]);
			if(!$exec){ $this->db->trans_rollback(); echo json_encode(['code' => 500]); exit; }
	    # END UPDATE GURU

			$this->db->trans_commit();
			echo json_encode(['code' => 200]);
			exit;
		}else{
			http_response_code(405);
		}

	}

	public function berhentis()
	{
		$tanggal_keluar = new DateTime();
		$now            = new DateTime('now');

		if($this->input->method() == 'put'){
			$nis            = $this->input->input_stream('nis', TRUE);
			$tanggal_keluar = $tanggal_keluar->createFromFormat('d-m-Y', $this->input->input_stream('tanggal_keluar', TRUE))->format('Y-m-d');
			$exec           = $this->mcore->update('siswa', ['tanggal_berhenti' => $tanggal_keluar, 'updated_at' => $now->format('Y-m-d H:i:s')], ['nis' => $nis]);

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

	public function delete($nis)
	{
		$now = new DateTime('now');

		if($this->input->method() == 'delete'){
			$exec = $this->mcore->update('siswa', ['deleted_at' => $now->format('Y-m-d H:i:s')], ['nis' => $nis]);

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

	public function chk_nis($nis)
	{
		$exec = $this->mcore->get($this->table, '*', ['nis' => $nis], NULL, 'ASC', NULL, NULL);
		if(!$exec){
			echo json_encode(['code' => 500]);
			exit;
		}else{
			if($exec->num_rows() == 1){
				echo json_encode(['code' => 400]);
				exit;
			}else{
				echo json_encode(['code' => 200]);
				exit;
			}
		}
	}

	public function get_kecamatan($id)
	{
		$exec = $this->mcore->get('kecamatan', '*', ['id_kota' => $id], 'nama_kecamatan', 'ASC', NULL, NULL);

		if($exec){
			echo json_encode(['code' => 200, 'data' => $exec->result()]);
			exit;
		}else{
			echo json_encode(['code' => 500]);
		}
	}

	public function get_desa($id)
	{
		$exec = $this->mcore->get('desa', '*', ['id_kecamatan' => $id], 'nama_desa', 'ASC', NULL, NULL);

		if($exec){
			echo json_encode(['code' => 200, 'data' => $exec->result()]);
			exit;
		}else{
			echo json_encode(['code' => 500]);
		}
	}

	public function get_siswa($type, $id = NULL)
	{
		if($type == 'by_kelas')
		{
			$where = ['kelas' => $id, 'tanggal_lulus' => NULL, 'tanggal_berhenti' => NULL, 'deleted_at' => NULL];
			$arr   = $this->mcore->get($this->table, '*', $where, 'nama', 'ASC', NULL, NULL);
			echo json_encode(['data' => $arr->result()]);
			exit;
		}
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */