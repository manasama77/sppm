<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_dashboard', 'mdashboard');
    $this->load->model('M_guru', 'mguru');
    $this->load->library('Template');
  }

  public function index()
  {
		$data['title']   = 'Dashboard';
		$data['content'] = 'dashboard/main';
		$data['vitamin'] = 'dashboard/main_vitamin';
    $this->template->template($data);
  }

  public function total_admins()
  {
    echo json_encode([
			'code'  => 200,
			'total' => $this->mdashboard->total_admins()
		]);
		exit;
  }

  public function total_guru()
  {
    $arr_guru = $this->mcore->get('guru', '*', ['tanggal_keluar' => NULL, 'deleted_at' => NULL], NULL, 'ASC', NULL, NULL);
    echo json_encode([
			'code'  => 200,
			'total' => $arr_guru->num_rows()
		]);
		exit;
  }

  public function total_siswa()
  {
    $arr_siswa = $this->mcore->get('siswa', '*', ['tanggal_lulus' => NULL, 'tanggal_berhenti' => NULL, 'deleted_at' => NULL], NULL, 'ASC', NULL, NULL);
    echo json_encode([
			'code'  => 200,
			'total' => $arr_siswa->num_rows()
		]);
		exit;
  }

  public function data_bday_guru()
  {
		$tgl_obj      = new DateTime('now');
		$tgl          = $tgl_obj->format('d');
		$bln          = $tgl_obj->format('m');
		$arr_employee = $this->mdashboard->guru_bday($tgl, $bln);
		if(!$arr_employee){ echo json_encode(['code' => 500]); exit; }

		$data['code']  = 200;
		$data['total'] = $arr_employee->num_rows();
		$data['data']  = $arr_employee->result();

		echo json_encode($data);
		exit;
  }

  public function data_bday_siswa()
  {
		$tgl_obj      = new DateTime('now');
		$tgl          = $tgl_obj->format('d');
		$bln          = $tgl_obj->format('m');
		$arr_siswa = $this->mdashboard->siswa_bday($tgl, $bln);
		if(!$arr_siswa){ echo json_encode(['code' => 500]); exit; }

		$data['code']  = 200;
		$data['total'] = $arr_siswa->num_rows();
		$data['data']  = $arr_siswa->result();

		echo json_encode($data);
		exit;
  }

  public function test()
  {
  	print_r($this->session->userdata());
  // 	$periode_awal  = new DateTime('2019-07-15');
		// $periode_akhir = new DateTime('2020-06-27');
		// $intv_bulan    = clone $periode_awal;
		// $total_bulan   = ($periode_awal->diff($periode_akhir)->m + ($periode_awal->diff($periode_akhir)->y * 12) + 1);

		// for($i = 0; $i < $total_bulan; $i++)
		// {
		// 	echo $intv_bulan->format('m')."<br>";
		// 	echo $intv_bulan->format('Y')."<br>";
		// 	$intv_bulan = $intv_bulan->add(new DateInterval("P1M"));
		// }
  }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */