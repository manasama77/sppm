<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function get_guru($where)
  {
  	$this->db->select('
  		nik,
  		nama,
  		alamat,
  		tempat_lahir,
  		DATE_FORMAT(tanggal_lahir, "%d-%b-%Y") as tanggal_lahir,
  		no_telepon,
  		photo,
  		jenis_kelamin,
  		(select parameter.keterangan from parameter where parameter.kode = guru.pendidikan_terakhir ) as pendidikan_terakhir,
  		DATE_FORMAT(tanggal_masuk, "%d-%b-%Y") as tanggal_masuk,
  		flag_admin
  	');
  	$this->db->from('guru');
  	$this->db->where($where);
  	return $this->db->get();
  }

}

/* End of file M_employees.php */
/* Location: ./application/models/M_employees.php */