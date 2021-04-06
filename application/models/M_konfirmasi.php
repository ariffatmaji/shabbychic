<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* REFERNSI BISA DILIHAT DI
* https://codeigniter.com/userguide3/database/query_builder.html
*/

class M_konfirmasi extends CI_Model {

	public $table = "tb_konfirmasi"; # nama table yang akan dimanipulasi

	public function get()
	{
		# AMBIL SEMUA DATA DARI TABLE DI DATABASE
		return $this->db->get($this->table)->result();
	}

	/*
	* hapus data berdasarkan id
	*/
	public function hapus($idtable)
	{
		return $this->db->delete($this->table, ["idkonfirmasi"=>$idtable]);
	}

	/*
	* proses update ke database
	*/
	public function update($data, $idtable)
	{
		return $this->db->update($this->table, $data, ["idkonfirmasi"=>$idtable]);
	}

	/*
		ambil data konfirmasi
	*/
	public function getKonfirmasiJoinOrder($syarat)
	{
		$query = "SELECT * FROM tb_order o JOIN tb_konfirmasi k ON o.idorder=k.idorder where $syarat";
		return $this->db->query($query)->result();
		// return $this->db->get($this->table)->result();
	}

	/*
		Memasukan data ke database
	*/
	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}
}

/* End of file M_karyawan.php */
/* Location: ./application/models/M_karyawan.php */