<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_detail_order extends CI_Model {

	public $table = "tb_detail_order";

	/*
		$syarat = array
		contoh array("nama kolom"=> "valuenya")
	*/
	public function ambil_satu($syarat)
	{
		$this->db->where($syarat);
		return $this->db->get($this->table)->row();
	}

	/**
	 * MENGAMBIL DATA DARI TB DETAIL ORDER DIJOINKAN DG PRODUK YANG IDORDERNYA SESUAI PARAMETER
	 */ 
	public function detailjoinproduk($syarat)
	{
		$query = "SELECT * FROM tb_detail_order do JOIN tb_produk p ON do.idproduk=p.idproduk WHERE {$syarat}";
		return $this->db->query($query)->result();
	}

	/*
		Memasukan data ke database
	*/
	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

}

/* End of file M_detail_order.php */
/* Location: ./application/models/M_detail_order.php */