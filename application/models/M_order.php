<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_order extends CI_Model {

	public $table = "tb_order";


	public function get()
	{
		# AMBIL SEMUA DATA DARI TABLE DI DATABASE
		return $this->db->get($this->table)->result();
	}

	/**
	 * AMBIL SEMUA DATA JOIN DENGAN TABLE MEMEBR
	 */ 
	public function orderjoinmember($syarat = false)
	{
		$query = "SELECT o.*, m.nama FROM tb_order o JOIN tb_member m ON o.idmember=m.idmember ";
		if ($syarat) {
			$query .= "WHERE {$syarat}";
		}
		return $this->db->query($query)->result();
	}

	public function orderjoinmember_satu($syarat)
	{
		$query = "SELECT o.*, m.nama FROM tb_order o JOIN tb_member m ON o.idmember=m.idmember where $syarat";
		return $this->db->query($query)->row();
	}

	/*
		Memasukan data ke database
	*/
	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	/*
	* proses update ke database
	*/
	public function update($data, $idtable)
	{
		return $this->db->update($this->table, $data, ["idorder"=>$idtable]);
	}
}

/* End of file M_order.php */
/* Location: ./application/models/M_order.php */