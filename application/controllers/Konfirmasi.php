<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// jika belum login maka tidak boleh mengakses halaman ini
		if (!isset($_SESSION["user"])) {
			# dialihkan ke halaman awal
			redirect(site_url(),'refresh');
		}
	}

	public function index()
	{
		$data["title"] = "Konfirmasi Pembayaran";
		$data["konten"] = "user/view-konfirmasi-bayar";

		$idmember = $_SESSION['user']["id"];
		$syarat = "idmember = '{$idmember}'";
		$data["data"] = $this->M_konfirmasi->getKonfirmasiJoinOrder($syarat);
		$this->load->view('user/index', $data);
	}

	/*
		UNTUK MENAMPILKAN FORM TAMBAH KONFIRMASI
	*/
	public function tambah()
	{
		$data["title"] = "Tambah Konfirmasi";
		$data["konten"] = "user/view-konfirmasi-tambah";
		$data["breadcrumb"] = array("Konfirmasi","Tambah");

		$idmember = $_SESSION['user']["id"];
		$syarat = "o.idmember = '{$idmember}'";
		$data["data"] = $this->M_order->orderjoinmember($syarat);
		$this->load->view('user/index', $data);
	}

	/*
		proses tambah konfirmasi
	*/
	public function proses_tambah()
	{
		if ($this->input->post()) {
			$config['upload_path'] 		= './uploads/bukti/'; # FOLDER UPLOAD
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
					"idorder"      => $this->input->post('idorder', TRUE),
					"rek_nama"     => $this->input->post('nama', TRUE),
					"rek_bank"     => $this->input->post('bank', TRUE),
					"bukti_tf"     => $this->upload->data("file_name"),
					"waktu_upload" => date("Y-m-d H:i:s")
				);

				$insert = $this->M_konfirmasi->insert($data);
				if ($insert) {
					# JIKA BERHASIL MASUKAN DB
					$this->session->set_flashdata('sukses', 'Data baru berhasil ditambahkan');
				}else{
					# JIKA GAGAL MASUKAN KE DB
					$this->session->set_flashdata('gagal', 'Data baru gagal ditambahkan');
				}
			}
			redirect(site_url('konfirmasi'),'refresh');
		}
	}
}

/* End of file Konfirmasi.php */
/* Location: ./application/controllers/Konfirmasi.php */