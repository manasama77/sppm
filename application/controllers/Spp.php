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

	public function show($id_kelas = NULL, $nis = NULL)
	{
		if($id_kelas == NULL){
			http_response_code(404);
			show_404();
			exit;
		}elseif($nis == NULL){
			http_response_code(404);
			show_404();
			exit;
		}

		$tgl_obj = new DateTime();
		$where   = ['kelas' => $id_kelas, 'tanggal_lulus' => NULL, 'tanggal_berhenti' => NULL];

		if($nis != 'all'){ $where['nis'] = $nis; }

		$siswas              = $this->mcore->get('siswa', '*', $where, 'nama', 'ASC', NULL, NULL);

		$data['total_siswa'] = $siswas->num_rows();
		$data['siswa']       = [];
		$i = 0;

		foreach ($siswas->result() as $siswa) {
			$nis        = $siswa->nis;
			$nama       = $siswa->nama;
			$kelas      = $siswa->kelas;
			$nama_kelas = $this->mcore->get('kelas', '*', ['id' => $kelas], NULL, 'ASC', NULL, NULL)->row()->nama_kelas;
			$data['siswa'][] = [
				'nis'        => $nis,
				'nama'       => $nama,
				'nama_kelas' => $nama_kelas,
			];

			$arr_spp              = $this->mcore->get('spp', '*', ['nis' => $nis], NULL, 'ASC', NULL, NULL);
			$total_data_lunas     = 0;
			$total_data_tunggakan = 0;

			foreach ($arr_spp->result() as $arr) {
				$id            = $arr->id;
				$nominal_spp   = $arr->nominal_spp;
				$flag_bayar    = $arr->flag_bayar;
				$tanggal_bayar = $arr->tanggal_bayar;

				if($tanggal_bayar != NULL) {
					$tanggal_bayar = $tgl_obj->createFromFormat('Y-m-d', $arr->tanggal_bayar)->format('d-M-y');
				}

				if($arr->flag_bayar == '1'){ $total_data_lunas++; }
				if($arr->flag_bayar == '0'){ $total_data_tunggakan++; }

				$data['siswa'][$i]['data'][] = [
					'id'            => $arr->id,
					'bulan'         => $tgl_obj->createFromFormat('Y-m-d', $arr->tahun.'-'.$arr->bulan.'-01')->format('M'),
					'tahun'         => $arr->tahun,
					'tanggal_bayar' => $tanggal_bayar,
					'flag_bayar'    => $arr->flag_bayar,
				];
			}

			$data['siswa'][$i]['total_data_all']       = $arr_spp->num_rows();
			$data['siswa'][$i]['total_data_lunas']     = $total_data_lunas;
			$data['siswa'][$i]['total_data_tunggakan'] = $total_data_tunggakan;

			$i++;
		}

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
			'id_input'      => $this->session->userdata('id'),
			'role'          => $this->session->userdata('role'),
		];

		if($id_bayar_spp == 'all'){
			$arr_spp = $this->mcore->get('spp', 'id', ['nis' => $nis, 'flag_bayar' => '0'], NULL, 'ASC', NULL, NULL);

			foreach ($arr_spp->result() as $key) {
				$data['id'][] = $key->id;
				$where = [
					'nis' => $nis,
					'id'  => $key->id,
				];

				$exec = $this->mcore->update('spp', $object, $where);	
			}

		}else{
			$where = [
				'nis' => $nis,
				'id'  => $id_bayar_spp,
			];

			$exec = $this->mcore->update('spp', $object, $where);
		}

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