<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('M_core', 'mcore');
	}

	public function template($data)
	{
		if(!$this->ci->session->userdata('name')){
			$this->ci->session->unset_userdata(['id', 'name', 'role']);
			$this->ci->session->set_flashdata('logout', TRUE);
			redirect('/','refresh');
			exit;
		}else{
			$name         = $this->ci->session->userdata('name');
			$role         = $this->ci->session->userdata('role');
			$data['name'] = $name;

			if($role == 'admin'){
				$data['pp'] = base_url().'assets/layouts/layout/img/avatar.png';
			}else{
				$data['pp'] = base_url().'assets/layouts/layout/img/avatar.png';
			}

			if(file_exists(APPPATH.'views/'.$data['content'].EXT)){
				$arr_periode          = $this->ci->mcore->get('periode', '*', ['is_active' => '1'], NULL, 'ASC', NULL, NULL);
				$arr_sekolah          = $this->ci->mcore->get('sekolah', '*', ['status' => '1'], NULL, 'ASC', NULL, NULL);
				$tgl_obj              = new DateTime();
				$periode_awal         = $arr_periode->row()->periode_awal;
				$periode_akhir        = $arr_periode->row()->periode_akhir;
				$data['cutoffs_from'] = $tgl_obj->createFromFormat('Y-m-d', $periode_awal);
				$data['cutoffs_to']   = $tgl_obj->createFromFormat('Y-m-d', $periode_akhir);
				$data['sekolah']      = $arr_sekolah;
				$this->ci->load->view('template', $data, FALSE);
			}else{
				show_404();
			}
		}
	}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */
