<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_member extends CI_Model {

	public $table = "tb_member";

	# AMBIL SEMUA DATA DARI TABLE DI DATABASE
	public function get()
	{
		return $this->db->get($this->table)->result();
	}

	/*
	* hapus data berdasarkan id
	*/
	public function hapus($idtable)
	{
		return $this->db->delete($this->table, ["idmember"=>$idtable]);
	}

	/*
		proses login member
	*/
	public function login($data_login)
	{
		$this->db->where($data_login);
		return $this->db->get($this->table)->row();
	}

	/*
		Memasukan data ke database / proses daftar
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

}

/* End of file M_member.php */
/* Location: ./application/models/M_member.php */