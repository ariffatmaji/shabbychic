<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfirmasi extends MY_Controller {

	/*
	 method / function untuk menampilkan data dari database
	*/
	public function index()
	{
		$data["title"] 	= "Konfirmasi";
		$data["data"]   = $this->M_konfirmasi->get(); # ambil data dari model/table

		$data["breadcrumb"] = array("Konfirmasi");
		$data["konten"] = "admin/konfirmasi/view-konfirmasi-list";
		$this->load->view('admin/index', $data);
	}

	/**
	 * METHOD / FUNCTION UNTUK MENGUBAH STATUS KONFIRMASI
	 * 
	 */ 
	public function ubah_status()
	{
		# CEK APAKAH DIURL ADA GET ID
		if ($this->input->get('id', TRUE)) {
			$id = $this->input->get('id', TRUE);
			$data = array(
				"status_bayar" => $this->input->get('status', TRUE)
			);
			$update = $this->M_konfirmasi->update( $data, $id );
			if ($update) {
				# JIKA BERHASIL UPDATE
				$this->session->set_flashdata('sukses', 'Status berhasil diperbarui');
			}else{
				# GAGAL UPDATE
				$this->session->set_flashdata('gagal', 'Status gagal diperbarui');
			}
			redirect(site_url('admin/konfirmasi'),'refresh');
		}else{
			# JIKA TIDAK ADA GET ID MAKA DIALIHKAN KE LIST KONFIRMASI
			redirect(site_url('admin/konfirmasi'),'refresh');
		}
	}

		/*
	* function / method untuk proses hapus
	*/
	public function hapus()
	{
		if ($this->input->get("id")) {
			$id = $this->input->get('id', TRUE);

			# PROSES HAPUS GAMBAR
			if ($this->input->get('img', TRUE)) {
				$lokasi_gambar = "./uploads/bukti/".$this->input->get('img', TRUE); # LOKASI GMBAR TERSIMPAN
				if (file_exists($lokasi_gambar)) { # CEK APAKAH GAMBAR TERSEDIA DIFOLDER
					unlink($lokasi_gambar); # HAPUS GAMBAR 
				}
			}

			$hapus = $this->M_konfirmasi->hapus($id);
			if ($hapus) {
				# JIKA BERHASIL HAPUS
				$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			}else{
				# JIKA GAGAL HAPUS 
				$this->session->set_flashdata('gagal', 'Data gagal dihapus');
			}
			
			redirect(site_url('admin/konfirmasi'),'refresh');
		}
	}

}

/* End of file Konfirmasi.php */
/* Location: ./application/controllers/Konfirmasi.php */