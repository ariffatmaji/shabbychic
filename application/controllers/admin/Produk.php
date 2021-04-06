<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends MY_Controller {

	/*
	 method / function untuk menampilkan data dari database
	*/
	public function index()
	{
		$data["title"] 	= "Produk";
		$data["data"]   = $this->M_produk->joinkategori(); # ambil data dari model/table

		$data["breadcrumb"] = array("Master Data", "Produk");
		$data["konten"] = "admin/produk/view-produk-list";
		$this->load->view('admin/index', $data);
	}

	/*
	* function / method untuk menampilkan halaman tambah
	*/
	public function tambah()
	{
		$data["title"] 	= "Produk Tambah";
		$data["kategori"] = $this->M_kategori->get();

		$data["breadcrumb"] = array("Produk", "Tambah");
		$data["konten"] = "admin/produk/view-produk-tambah";
		$this->load->view('admin/index', $data);
	}

	/*
	* function / method untuk proses tambah ke database
	*/
	public function proses_tambah()
	{
		if ($this->input->post()){
			$config['upload_path'] 		= './uploads/produk/'; # FOLDER UPLOAD
			$config['allowed_types'] 	= 'gif|jpg|png'; # FILE YANG DIIZINKAN
			$config['max_size']  		= '2000'; # MAKSIMAL 2MB
			$config['encrypt_name']  	= true; # ENKRIPSI NAMA FILE BIAR UNIK
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload("img")){
				# JIKA GAGAL UPLOAD GAMBAR
				$this->session->set_flashdata('gagal', $this->upload->display_errors());
			}else{
				# JIKA BERHASIL UPLOAD GAMBAR MAKA SIMPAN KE DATABASE
				$data = array(
					"idkategori" => $this->input->post('kat', TRUE),
					"namaproduk" => $this->input->post('nama', TRUE),
					"berat"      => $this->input->post('berat', TRUE),
					"gambar"     => $this->upload->data("file_name"),
					"stok"       => $this->input->post('stok', TRUE),
					"harga"      => $this->input->post('harga', TRUE),
					"deskripsi"  => $this->input->post('deskripsi', TRUE)
				);

				$insert = $this->M_produk->insert($data);
				if ($insert) {
					# JIKA BERHASIL MASUKAN DB
					$this->session->set_flashdata('sukses', 'Data baru berhasil ditambahkan');
				}else{
					# JIKA GAGAL MASUKAN KE DB
					$this->session->set_flashdata('gagal', 'Data baru gagal ditambahkan');
				}
			}
		}

		# DI ALIHKAN KE LIST DATA
		redirect(site_url('admin/produk'),"refresh");
	}

	/*
	* function / method untuk proses hapus
	*/
	public function hapus()
	{
		if ($this->input->get("id")) {
			$id = $this->input->get('id', TRUE);

			# cek apakah dikategori yang akan dihapus masih ada produknya
			$syarat 	= array("idproduk"=>$id);
			$adaOrder 	= $this->M_detail_order->ambil_satu($syarat);

			if ($adaOrder) {
				# JIKA PRODUK SUDAH PERNAH DIBELI OLEH CUSTOMER MAKA TIDAK DAPAT DIHAPUS
				$this->session->set_flashdata('gagal', 'Produk sudah pernah dibeli oleh customer, tidak dapat dihapus!');

			}else{
				#  PRODUK BELUM PERNAH TERBELI MAKA BISA HAPUS

				# PROSES HAPUS GAMBAR
				if ($this->input->get('img', TRUE)) {
					$lokasi_gambar = "./uploads/produk/".$this->input->get('img', TRUE); # LOKASI GMBAR TERSIMPAN
					if (file_exists($lokasi_gambar)) { # CEK APAKAH GAMBAR TERSEDIA DIFOLDER
						unlink($lokasi_gambar); # HAPUS GAMBAR 
					}
				}

				$hapus = $this->M_produk->hapus($id);
				if ($hapus) {
					# JIKA BERHASIL HAPUS
					$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
				}else{
					# JIKA GAGAL HAPUS 
					$this->session->set_flashdata('gagal', 'Data gagal dihapus');
				}
			}

			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/produk'),"refresh");
		}
	}

	/*
	* menampilkan halaman edit
	*/
	public function edit()
	{
		if ($this->input->get('id', TRUE)) {

			$data["kategori"] = $this->M_kategori->get();

			$id = $this->input->get('id', TRUE);
			$data["data"] = $this->M_produk->ambil_satu(["idproduk"=>$id]);

			$data["breadcrumb"] = array("Produk", "Edit");
			$data["konten"] = "admin/produk/view-produk-edit";
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
			# JIKA GAMBAR DIEDIT MAKA UPLOAD GAMBAR BARU DAN HAPUS GAMBAR LAMA
			if (!empty($_FILES["img"]["name"])) {
				$lokasi_produk = "./uploads/produk/";

				$config['upload_path']     = $lokasi_produk;
				$config['allowed_types']   = 'gif|jpg|png'; # FILE YANG DIIZINKAN
				$config['max_size']        = '2000';# MAKSIMAL 2MB
				$config['encrypt_name']    = true; # ENKRIPSI NAMA FILE BIAR UNIK
				
				$this->load->library('upload', $config);
				
				if ( $this->upload->do_upload("img")){
					# JIKA BERHASIL UPLOAD
					$gambar_lama = $this->input->post('oldimg', TRUE); # NAMA GAMBAR YANG LAMA
					if (file_exists($lokasi_produk.$gambar_lama)) { # CEK KE FOLDER APAKAH GAMBAR LAMA ADA
						unlink($lokasi_produk.$gambar_lama); # HAPUS GAMBAR LAMA
					}

					$data["gambar"] = $this->upload->data("file_name");
				}else{
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('gagal', 'Upload foto : '. $error);
				}
			}

			# SELESAI UPLOAD
			$data["namaproduk"] = $this->input->post('nama', TRUE);
			$data["idkategori"] = $this->input->post('kat', TRUE);
			$data["berat"]      = $this->input->post('berat', TRUE);
			$data["stok"]       = $this->input->post('stok', TRUE);
			$data["harga"]      = $this->input->post('harga', TRUE);
			$data["deskripsi"]  = $this->input->post('deskripsi', TRUE);

			$update = $this->M_produk->update($data,$id);
			if ($update) {
				# JIKA BERHASIL PERBARUI DB
				$this->session->set_flashdata('sukses', 'Data baru berhasil diperbarui');
			}else{
				# JIKA GAGAL PERBARUI KE DB
				$this->session->set_flashdata('gagal', 'Data baru gagal diperbarui');
			}

			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/produk'),"refresh");
		}
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */