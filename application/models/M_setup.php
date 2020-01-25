<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_setup extends CI_Model {

	public function get_kelas()
	{
		$this->db->select('kelas.id, kelas.nama_kelas, guru.nama AS wali_kelas, FORMAT(kelas.spp, 0, \'id_ID\') AS spp');
		$this->db->join('guru', 'guru.nik = kelas.wali_kelas', 'left');
		return $this->db->get('kelas');
	}

	public function get_periode_aktif()
	{
		return $this->db->get('sekolah');
	}

	public function get_periode()
	{
		$arr = $this->get_periode_aktif();
		$s = $arr->row()->periode_tahun_awal.'-'.$arr->row()->periode_bulan_awal.'-01';
		$e = $arr->row()->periode_tahun_akhir.'-'.$arr->row()->periode_bulan_akhir.'-01';

		$this->db->select('
			sekolah.periode_bulan_awal,
			sekolah.periode_tahun_awal,
			sekolah.periode_bulan_akhir,
			sekolah.periode_tahun_akhir,
			(
				SELECT COUNT(*) FROM siswa WHERE deleted_at IS NULL AND tanggal_berhenti IS NULL GROUP BY nis
			) AS total_siswa,
			(
				SELECT COUNT(*) 
				FROM siswa 
				WHERE deleted_at IS NULL AND 
				(tanggal_lulus BETWEEN \''.$s.'\' AND \''.$e.'\')
				GROUP BY nis
			) AS total_siswa_lulus,
			(
				SELECT COUNT(*) 
				FROM siswa 
				WHERE deleted_at IS NULL AND 
				(tanggal_berhenti BETWEEN \''.$s.'\' AND \''.$e.'\')
				GROUP BY nis
			) AS total_siswa_berhenti,
		');
		return $this->db->get('sekolah');
	}

	public function get_log_periode()
	{
		return $this->db->get('log_periode');
	}



}

/* End of file M_setup.php */
/* Location: ./application/models/M_setup.php */