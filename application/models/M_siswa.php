<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function get_siswa($where)
  {
  	$this->db->select('
  		siswa.nis,
  		siswa.nama,
  		siswa.tempat_lahir,
  		DATE_FORMAT(siswa.tanggal_lahir, "%d-%b-%Y") as tanggal_lahir,
  		siswa.nama_wali,
  		siswa.alamat,
  		desa.nama_desa as desa,
  		kecamatan.nama_kecamatan as kecamatan,
  		kota.nama_kota as kota,
  		kelas.nama_kelas as kelas,
  		DATE_FORMAT(siswa.tanggal_masuk, "%d-%b-%Y") as tanggal_masuk,
  		siswa.jenis_kelamin,
  		DATE_FORMAT(siswa.tanggal_lulus, "%d-%b-%Y") as tanggal_lulus,
  		siswa.photo
  	');
  	$this->db->from('siswa');
  	$this->db->join('kota', 'kota.id = siswa.kota', 'left');
  	$this->db->join('kecamatan', 'kecamatan.id = siswa.kecamatan', 'left');
  	$this->db->join('desa', 'desa.id = siswa.desa', 'left');
  	$this->db->join('kelas', 'kelas.id = siswa.kelas', 'left');
  	$this->db->where($where);
  	return $this->db->get();
  }

}

/* End of file M_employees.php */
/* Location: ./application/models/M_employees.php */