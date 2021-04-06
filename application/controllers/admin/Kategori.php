<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends MY_Controller {

	/*
	 method / function untuk menampilkan data dari database
	*/
	public function index()
	{
		$data["title"] 	= "Kategori";
		$data["data"]   = $this->M_kategori->get(); # ambil data dari model/table

		$data["breadcrumb"] = array("Master Data", "Kategori");
		$data["konten"] = "admin/kategori/view-kategori-list";
		$this->load->view('admin/index', $data);
	}

	/*
	* function / method untuk menampilkan halaman tambah
	*/
	public function tambah()
	{
		$data["title"] 	= "Kategori Tambah";
		$data["breadcrumb"] = array("Master Data", "Kategori", "Tambah");
		$data["konten"] = "admin/kategori/view-kategori-tambah";
		$this->load->view('admin/index', $data);
	}

	/*
	* function / method untuk proses tambah ke database
	*/
	public function proses_tambah()
	{
		if ($this->input->post()){
			
			$nama = $this->input->post('nama', TRUE);

			# CEK APAKAH DIDATABASE ADA EMAIL YANG SAMA
			$syarat = array("nama_kategori"=>$nama);
			$sama 	= $this->M_kategori->ambil_satu($syarat);
			if ($sama) {
				# JIKA ADA YANG SAMA
				$this->session->set_flashdata('gagal', "Data {$nama} sudah ada didatabase silahkan gunakan yang lain.");
			}else{
				#JIKA TIDAK ADA YANG SAMA
				$data = array(
					"nama_kategori"     => $nama,
					"keterangan"   		=> $this->input->post('ket', TRUE)
				);

				$insert = $this->M_kategori->insert($data);
				if ($insert) {
					# JIKA BERHASIL MASUKAN DB
					$this->session->set_flashdata('sukses', 'Data baru berhasil ditambahkan');
				}else{
					# JIKA GAGAL MASUKAN KE DB
					$this->session->set_flashdata('gagal', 'Data baru gagal ditambahkan');
				}
			}

			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/kategori'),"refresh");
		}
	}

	/*
	* function / method untuk proses hapus
	*/
	public function hapus()
	{
		if ($this->input->get("id")) {
			$id = $this->input->get('id', TRUE);

			# cek apakah dikategori yang akan dihapus masih ada produknya
			$syarat 	= array("idkategori"=>$id);
			$adaProduk 	= $this->M_produk->ambil_satu($syarat);

			if ($adaProduk) {
				# MASIH ADA PRODUK DIBAWAHNYA MAKA GAGAL HAPUS
				$this->session->set_flashdata('gagal', 'Kategori masih ada produk nya tidak dapat dihapus.');
			}else{
				# TIDAK ADA PRODUK MAKA BISA HAPUS
				$hapus = $this->M_kategori->hapus($id);
				if ($hapus) {
					# JIKA BERHASIL HAPUS
					$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
				}else{
					# JIKA GAGAL HAPUS 
					$this->session->set_flashdata('gagal', 'Data gagal dihapus');
				}
			}

			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/kategori'),"refresh");
		}
	}

	/*
	* menampilkan halaman edit
	*/
	public function edit()
	{
		if ($this->input->get('id', TRUE)) {
			$id = $this->input->get('id', TRUE);
			$data["data"] = $this->M_kategori->ambil_satu(["idkategori"=>$id]);

			$data["breadcrumb"] = array("Master Data", "Kategori", "Edit");
			$data["konten"] = "admin/kategori/view-kategori-edit";
			$this->load->view('admin/index', $data);

		}
	}

	/*
	* function / method untuk proses edit data
	*/
	public function proses_edit()
	{
		if ($this->input->post()) {
			# data baru yang akan diupdate
			$id 	= $this->input->post('id', TRUE);
			$data 	= array(
				"nama_kategori" => $this->input->post('nama', TRUE),
				"keterangan"    => $this->input->post('ket', TRUE)
			);
			$update = $this->M_kategori->update($data,$id);
			if ($update) {
				# JIKA BERHASIL PERBARUI DB
				$this->session->set_flashdata('sukses', 'Data baru berhasil diperbarui');
			}else{
				# JIKA GAGAL PERBARUI KE DB
				$this->session->set_flashdata('gagal', 'Data baru gagal diperbarui');
			}
			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/kategori'),"refresh");
		}
	}

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */