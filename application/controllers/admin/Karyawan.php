<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends MY_Controller {

	public function index()
	{
		$data["title"] 	= "Karyawan";
		$data["data"]   = $this->M_karyawan->get(); # ambil data dari model/table

		$data["breadcrumb"] = array("Master Data", "Karyawan");
		$data["konten"] = "admin/karyawan/view-karyawan-list";
		$this->load->view('admin/index', $data);
	}

	/*
	* function / method untuk menampilkan halaman tambah
	*/
	public function tambah()
	{
		$data["title"] 	= "Karyawan";

		$data["breadcrumb"] = array("Master Data", "Karyawan", "Tambah");
		$data["konten"] = "admin/karyawan/view-karyawan-tambah";
		$this->load->view('admin/index', $data);
	}

	/*
	* function / method untuk proses tambah ke database
	*/
	public function proses_tambah()
	{
		if ($this->input->post()){
			
			$email = $this->input->post('mail', TRUE);

			# CEK APAKAH DIDATABASE ADA EMAIL YANG SAMA
			$syarat = array("email"=>$email);
			$sama 	= $this->M_karyawan->ambil_satu($syarat);
			if ($sama) {
				# JIKA ADA YANG SAMA
				$this->session->set_flashdata('gagal', "Data email {$email} sudah ada didatabase silahkan gunakan yang lain.");
			}else{
				#JIKA TIDAK ADA YANG SAMA
				$data = array(
					"nama"     => $this->input->post('nama', TRUE),
					"email"    => $email,
					"password" => md5("12345")
				);

				$insert = $this->M_karyawan->insert($data);
				if ($insert) {
					# JIKA BERHASIL MASUKAN DB
					$this->session->set_flashdata('sukses', 'Data baru berhasil ditambahkan');
				}else{
					# JIKA GAGAL MASUKAN KE DB
					$this->session->set_flashdata('gagal', 'Data baru gagal ditambahkan');
				}
			}

			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/karyawan'),"refresh");
		}
	}

	/*
	* function / method untuk proses hapus
	*/
	public function hapus()
	{
		if ($this->input->get("id")) {
			$id = $this->input->get('id', TRUE);

			$hapus = $this->M_karyawan->hapus($id);
			if ($hapus) {
				# JIKA BERHASIL HAPUS
				$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			}else{
				# JIKA GAGAL HAPUS 
				$this->session->set_flashdata('gagal', 'Data gagal dihapus');
			}
			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/karyawan'),"refresh");
		}
	}

	/*
	* menampilkan halaman edit
	*/
	public function edit()
	{
		if ($this->input->get('id', TRUE)) {
			$id = $this->input->get('id', TRUE);
			$data["data"] = $this->M_karyawan->ambil_satu(["idkaryawan"=>$id]);

			$data["breadcrumb"] = array("Master Data", "Karyawan", "Edit");
			$data["konten"] = "admin/karyawan/view-karyawan-edit";
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
				"nama"     => $this->input->post('nama', TRUE),
				"email"    => $this->input->post('mail', TRUE)
			);
			$update = $this->M_karyawan->update($data,$id);
			if ($update) {
				# JIKA BERHASIL PERBARUI DB
				$this->session->set_flashdata('sukses', 'Data baru berhasil diperbarui');
			}else{
				# JIKA GAGAL PERBARUI KE DB
				$this->session->set_flashdata('gagal', 'Data baru gagal diperbarui');
			}
			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/karyawan'),"refresh");
		}
	}
}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */