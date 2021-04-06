<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	/*
	* function / method untuk menampilkan list data member
	*/
	public function index()
	{
		$data["title"] 	= "Member";
		$data["data"]   = $this->M_member->get(); # ambil data dari model/table

		$data["breadcrumb"] = array("Master Data", "Member");
		$data["konten"] = "admin/member/view-member-list";
		$this->load->view('admin/index', $data);
	}

	/*
	* function / method untuk proses hapus
	*/
	public function hapus()
	{
		if ($this->input->get("id")) {
			$id = $this->input->get('id', TRUE);

			$hapus = $this->M_member->hapus($id);
			if ($hapus) {
				# JIKA BERHASIL HAPUS
				$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			}else{
				# JIKA GAGAL HAPUS 
				$this->session->set_flashdata('gagal', 'Data gagal dihapus');
			}
			# DI ALIHKAN KE LIST DATA
			redirect(site_url('admin/member'),"refresh");
		}
	}

}

/* End of file Member.php */
/* Location: ./application/controllers/Member.php */