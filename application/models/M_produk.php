<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* REFERNSI BISA DILIHAT DI
* https://codeigniter.com/userguide3/database/query_builder.html
*/

class M_produk extends CI_Model {

	public $table = "tb_produk"; # nama table yang akan dimanipulasi

	public function get()
	{
		# AMBIL SEMUA DATA DARI TABLE DI DATABASE
		return $this->db->get($this->table)->result();
	}


	public function joinkategori()
	{
		return $this->db->query("SELECT * FROM tb_produk p JOIN tb_kategori k ON p.idkategori=k.idkategori")->result();
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
	public function hapus($idproduk)
	{
		return $this->db->delete($this->table, ["idproduk"=>$idproduk]);
	}

	/*
	* proses update ke database
	*/
	public function update($data, $idproduk)
	{
		return $this->db->update($this->table, $data, ["idproduk"=>$idproduk]);
	}

	/*
		jumlah semua data produk untuk pagination
	*/
	public function jumlah_semua()
	{
		return $this->db->count_all($this->table);
	}

	public function produk_page_user($limit, $start){
		return $this->db->query("SELECT * FROM tb_produk p JOIN tb_kategori k ON p.idkategori=k.idkategori Limit {$start},{$limit}")->result();

        // return $this->db->get($this->table, $limit, $start)->result();
    }

    /*
    	produk untuk home user
    */
	public function produkHome()
	{
		return $this->db->query("SELECT * FROM tb_produk p JOIN tb_kategori k ON p.idkategori=k.idkategori order by idproduk desc limit 8 ")->result();
	}

	/*	
		untuk menampilkan data produk jika diklik menu kategori
	*/
	public function produkperkategori($syarat)
	{
		$query = $this->db->query("SELECT * FROM tb_produk p JOIN tb_kategori k ON p.idkategori=k.idkategori WHERE {$syarat}");
		return $query->result();
	}

	public function produkPencarian($kalimat)
	{
		$query = $this->db->query("SELECT * FROM tb_produk p JOIN tb_kategori k ON p.idkategori=k.idkategori WHERE namaproduk like '%{$kalimat}%'");
		return $query->result();
	}
}

/* End of file M_karyawan.php */
/* Location: ./application/models/M_karyawan.php */