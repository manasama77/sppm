<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

  public function total_admins()
  {
    $this->db->where('deleted_at IS NULL', NULL, FALSE);
    $exec = $this->db->get('admin');

    return $exec->num_rows();
  }

  public function guru_bday($tgl, $bln)
  {
  	$this->db->select('guru.nama');
  	$this->db->where("guru.deleted_at =", NULL, FALSE);
  	$this->db->where("(DAY(guru.tanggal_lahir) = '".$tgl."' and MONTH(guru.tanggal_lahir) = '".$bln."')", NULL, FALSE);
  	$this->db->order_by('guru.nik', 'asc');
  	return $this->db->get('guru');
  }

  public function siswa_bday($tgl, $bln)
  {
  	$this->db->select('siswa.nama, kelas.nama_kelas');
  	$this->db->where("siswa.tanggal_lulus =", NULL, FALSE);
  	$this->db->where("siswa.tanggal_berhenti =", NULL, FALSE);
  	$this->db->where("siswa.deleted_at =", NULL, FALSE);
  	$this->db->where("(DAY(siswa.tanggal_lahir) = '".$tgl."' and MONTH(siswa.tanggal_lahir) = '".$bln."')", NULL, FALSE);
  	$this->db->join('kelas', 'kelas.id = siswa.kelas', 'left');
  	$this->db->order_by('siswa.nis', 'asc');
  	return $this->db->get('siswa');
  }

  

}

/* End of file M_dashboard.php */
/* Location: ./application/models/M_dashboard.php */