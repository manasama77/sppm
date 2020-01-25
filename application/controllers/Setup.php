<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_core', 'mcore');
		$this->load->model('M_setup', 'msetup');
		$this->load->library('Template');
		$this->load->library('upload');
	}

	public function aplikasi()
	{
		$data['title']        = 'Setup Aplikasi';
		$data['content']      = 'setup/aplikasi/form';
		$data['vitamin']      = 'setup/aplikasi/form_vitamin';
		$data['applications'] = $this->mcore->get('sekolah', '*', NULL, NULL, 'ASC', NULL, NULL);
		$data['gurus']        = $this->mcore->get('guru', '*', ['tanggal_keluar' => NULL, 'deleted_at' => NULL], 'nama', 'ASC', NULL, NULL);
		$this->template->template($data);
	}

	public function aplikasi_update()
	{
		$id             = $this->input->post('id');
		$nama_sekolah   = $this->input->post('nama_sekolah');
		$motto          = $this->input->post('motto');
		$alamat         = $this->input->post('alamat');
		$kepala_sekolah = $this->input->post('kepala_sekolah');
		$prev_logo      = $this->input->post('prev_logo');

		# PROSES UPLOAD
		$new_images_name = '';

		if($_FILES['logo']['size'] > 0){
			$config = [
				'upload_path'  => './assets/global/img/',
				'allowed_types' => 'jpg|jpeg|png',
				'overwrite'    => TRUE,
				'encrypt_name' => TRUE
			];
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('logo')){
				$this->db->trans_rollback(); 
				echo json_encode(['code' => 400, 'err' => $this->upload->display_errors()]); 
				exit;
			}else{
				$new_images_name = $this->upload->data()['file_name'];
			}
		}else{
			$new_images_name = $prev_logo;
		}
    # END PROSES UPLOAD

		$data = [
			'nama_sekolah'   => $nama_sekolah,
			'motto'          => $motto,
			'alamat'         => $alamat,
			'kepala_sekolah' => $kepala_sekolah,
			'logo'           => $new_images_name,
		];
		$exec = $this->mcore->update('sekolah', $data, ['id' => $id]);
		if($exec){
			echo json_encode(['code' => 200]);
			exit;
		}else{
			echo json_encode(['code' => 500]);
			exit;
		}
	}

	public function periode()
	{
		$data['tgl_obj']      = new DateTime();
		$data['title']        = 'Setup Aplikasi';
		$data['content']      = 'setup/periode/main';
		$data['vitamin']      = 'setup/periode/main_vitamin';
		$data['periode']      = $this->msetup->get_periode();
		$data['log_periodes'] = $this->msetup->get_log_periode();
		$this->template->template($data);
	}

	public function ganti_periode()
	{
		$data['tgl_obj']      = new DateTime();
		$data['title']        = 'Ganti Periode | Setup Periode';
		$data['content']      = 'setup/periode/form';
		$data['vitamin']      = 'setup/periode/form_vitamin';
		$data['periode']      = $this->msetup->get_periode();
		$data['log_periodes'] = $this->msetup->get_log_periode();
		$this->template->template($data);
	}

	public function cutoff_store()
	{
		$tgl_obj    = new DateTime();
		$from_date  = $tgl_obj->createFromFormat('d-m-Y', $this->input->post('from_date'));
		$to_date    = $tgl_obj->createFromFormat('d-m-Y', $this->input->post('to_date'));
		$created_by = $this->session->userdata('id');

		$exec_off = $this->mcore->update('cutoffs', ['active' => FALSE], ['active' => TRUE]);
		if(!$exec_off){ echo json_encode(['code' => 500]); exit; }

		$object = [
			'from_date'  => $from_date->format('Y-m-d'),
			'to_date'    => $to_date->format('Y-m-d'),
			'active'     => TRUE,
			'created_by' => $created_by,
			'created_at' => $tgl_obj->modify('now')->format('Y-m-d H:i:s'),
		];
		$exec_cutoff = $this->mcore->store('cutoffs', $object);
		if(!$exec_cutoff){ echo json_encode(['code' => 500]); exit; }

		echo json_encode(['code' => 200]); 
		exit;
	}

	public function kelas()
	{
		$data['title']   = 'Setup Kelas';
		$data['content'] = 'setup/kelas/main';
		$data['vitamin'] = 'setup/kelas/main_vitamin';
		$data['gurus']   = $this->mcore->get('guru', '*', ['tanggal_keluar' => NULL, 'deleted_at' => NULL], 'nama', 'ASC', NULL, NULL);
		$this->template->template($data);
	}

	public function show_kelas($id)
	{
		$arr = $this->mcore->get('kelas', "*", ['id' => $id], 'id', 'ASC', NULL, NULL);
		echo json_encode([
			'code'  => 200,
			'data'  => $arr->result()
		]);
		exit;
	}

	public function get_kelas()
	{
		$arr = $this->msetup->get_kelas();
		echo json_encode([
			'code'  => 200,
			'total' => $arr->num_rows(),
			'data'  => $arr->result()
		]);
		exit;
	}

	public function store_kelas()
	{
		$nama_kelas = $this->input->post('nama_kelas', TRUE);
		$wali_kelas = $this->input->post('wali_kelas', TRUE);
		$spp        = $this->input->post('spp', TRUE);

		$data = [
			'nama_kelas' => $nama_kelas,
			'wali_kelas' => $wali_kelas,
			'spp'        => $spp
		];
		$exec = $this->mcore->store('kelas', $data);
		if(!$exec){ echo json_encode(['code' => 500]); exit; }

		echo json_encode(['code' => 200]);
		exit;
	}

	public function update_kelas()
	{
		if($this->input->method('put')){
			$id         = $this->input->input_stream('id', TRUE);
			$nama_kelas = $this->input->input_stream('nama_kelas_e', TRUE);
			$wali_kelas = $this->input->input_stream('wali_kelas_e', TRUE);
			$spp        = $this->input->input_stream('spp_e', TRUE);

			$data = [
				'nama_kelas' => $nama_kelas,
				'wali_kelas' => $wali_kelas,
				'spp'        => $spp,
			];
			$exec = $this->mcore->update('kelas', $data, ['id' => $id]);
			if(!$exec){ echo json_encode(['code' => 500]); exit; }

			echo json_encode(['code' => 200]);
			exit;
		}else{
			http_response_code('400');
		}
	}

	public function delete_kelas($id)
	{
		if($this->input->method('delete')){
			$exec = $this->mcore->get('siswa', '*', ['kelas' => $id], NULL, 'ASC', NULL, NULL);
			if($exec->num_rows() > 0){ echo json_encode(['code' => 400]); exit; }

			$exec = $this->mcore->delete('kelas', ['id' => $id]);
			if(!$exec){ echo json_encode(['code' => 500]); exit; }

			echo json_encode(['code' => 200]);
			exit;
		}else{
			http_response_code('400');
		}
	}

}

/* End of file Setup.php */
/* Location: ./application/controllers/Setup.php */