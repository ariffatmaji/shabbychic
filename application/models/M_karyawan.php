<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* REFERNSI BISA DILIHAT DI
* https://codeigniter.com/userguide3/database/query_builder.html
*/

class M_karyawan extends CI_Model {

	public $table = "tb_karyawan"; # nama table yang akan dimanipulasi

	public function get()
	{
		# AMBIL SEMUA DATA DARI TABLE DI DATABASE
		return $this->db->get($this->table)->result();
	}

	/*
		Memasukan data ke database
	*/
	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	/*
		$syarat = array
		contoh array("nama kolom"=> "valuenya")
	*/
	public function ambil_satu($syarat)
	{
		$this->db->where($syarat);
		return $this->db->get($this->table)->row();
	}

	/*
	* hapus data berdasarkan id
	*/
	public function hapus($idtable)
	{
		return $this->db->delete($this->table, ["idkaryawan"=>$idtable]);
	}

	/*
	* proses update ke database
	*/
	public function update($data, $idtable)
	{
		return $this->db->update($this->table, $data, ["idkaryawan"=>$idtable]);
	}

	/**
	 * PROSES LOGIN KE DATABASE PENGECEKAN EMAIL DAN PASSWORD
	 */
	public function login($data)
	{
		$this->db->where($data);
		return $this->db->get($this->table)->row();
	} 
}

/* End of file M_karyawan.php */
/* Location: ./application/models/M_karyawan.php */