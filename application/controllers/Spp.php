<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spp extends CI_Controller {

	public $tabel = 'spp';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('Template');
	}

	public function index()
	{
		$data['kelass']  = $this->mcore->get('kelas', '*', NULL, 'nama_kelas', 'ASC', NULL, NULL);
		$data['title']   = 'Data SPP';
		$data['content'] = 'spp/main';
		$data['vitamin'] = 'spp/main_vitamin';
		$this->template->template($data);
	}

	public function create()
	{
		$data['kelass']  = $this->mcore->get('kelas', '*', NULL, 'nama_kelas', 'ASC', NULL, NULL);
		$data['title']   = 'Bayar SPP';
		$data['content'] = 'spp/form';
		$data['vitamin'] = 'spp/form_vitamin';
		$this->template->template($data);
	}

	public function show($nis)
	{
		$tgl_obj    = new DateTime();
		$arrs       = $this->mcore->get('spp', '*', ['nis' => $nis], NULL, 'ASC', NULL, NULL);
		$no         = 1;
		$total_data = 0;
		foreach ($arrs->result() as $arr) {
			$tanggal_bayar = $arr->tanggal_bayar;

			if($tanggal_bayar != NULL) {
				$tanggal_bayar = $tgl_obj->createFromFormat('Y-m-d', $arr->tanggal_bayar)->format('d-M-y');
			}

			if($arr->flag_bayar == '0'){ $total_data++; }

			$data['data'][] = [
				'no'            => $no,
				'id'            => $arr->id,
				'bulan'         => $tgl_obj->createFromFormat('Y-m-d', $arr->tahun.'-'.$arr->bulan.'-01')->format('M'),
				'tahun'         => $arr->tahun,
				'tanggal_bayar' => $tanggal_bayar,
				'flag_bayar'    => $arr->flag_bayar,
			];
			$no++;
		}

		$data['total_data'] = $total_data;
		echo json_encode($data);
		exit;
	}
	public function show_nominal($id_spp = NULL, $nis = NULL)
	{
		if($id_spp == NULL && $nis == NULL){
			http_response_code(404);
			exit;
		}else{
			if($id_spp == 'all'){
				$nominal_spp = $this->mcore->get('spp', 'sum(nominal_spp) as nominal_spp', ['nis' => $nis, 'flag_bayar' => '0'], NULL, 'ASC', NULL, NULL)->row()->nominal_spp;
			}else{
				$nominal_spp = $this->mcore->get('spp', 'nominal_spp', ['id' => $id_spp], NULL, 'ASC', NULL, NULL)->row()->nominal_spp;
			}
			echo json_encode([
				'nominal_spp'        => $nominal_spp,
				'nominal_spp_format' => number_format($nominal_spp, 0),
			]);
			exit;
		}

	}

	public function store()
	{
		$tgl_bayar_obj   = new DateTime();
		$nis           = $this->input->post('nis', TRUE);
		$tanggal_bayar = $this->input->post('tanggal_bayar', TRUE);
		$id_bayar_spp  = $this->input->post('id_bayar_spp', TRUE);
		$tgl_bayar_obj = $tgl_bayar_obj->createFromFormat('d-m-Y', $tanggal_bayar);

		$object = [
			'flag_bayar'    => '1',
			'tanggal_bayar' => $tgl_bayar_obj->format('Y-m-d'),
			'id_input'      => $this->session->userdata('nik'),
			'role'          => $this->session->userdata('role'),
		];

		$where = [
			'nis' => $nis,
			'id'  => $id_bayar_spp,
		];

		$exec = $this->mcore->update('spp', $object, $where);

		if(!$exec){
			echo json_encode(['code' => '500']);
			exit;
		}else{
			echo json_encode(['code' => '200']);
			exit;
		}
	}

}

/* End of file Spp.php */
/* Location: ./application/controllers/Spp.php */