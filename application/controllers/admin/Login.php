<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/*
		METHOD / FUNCTION UNTUK MENAMPILKAN HALAMAN LOGIN
	*/
	public function index()
	{
		# CEK JIKA SUDAH LOGIN MAKA HALAMAN LOGIN TIDAK BISA DIBUKA LAGI 
		# HARUS LOGOUT DULU
		if (isset($_SESSION["admin"])) {
			# JIKA SUDAH LOGIN
			# DIALIHKAN KE HALAMAN DASHBOARD ADMIN
			redirect(site_url('admin/dashboard'),'refresh');
		}

		$this->load->view('admin/view-login');
	}

	/**
	 * METHOD / FUNCTION UNTUK MEMPROSES LOGIN 
	 * DENGAN MENGECEK KE DATABASE APAKAH DATA YANG DIINPUTKAN (EMAIL & PASSWORD)
	 * COCOK DENGAN YANG ADA DIDATABASE
	 */
	public function proses_login()
	{
		if ($this->input->post()) {
			# JIKA ADA POST AN DATA BERUPA EMAIL DAN PASSWORD DARI HALAMAN LOGIN
			$data = array(
				"email" 	=> $this->input->post('email', TRUE),
				"password" 	=> md5($this->input->post('password', TRUE)) # DIENKRIPSI MD5 BIAR SAMA DENGAN DIDB
			);
			$admin = $this->M_karyawan->login($data);

			if ($admin) {
				# JIKA LOGIN BERHASIL / EMAIL & PASSWORD NYA SAMA DENGAN DI DATABASE
				# MEMBUAT SESSION DULU 
				$_SESSION["admin"]["id"] = $admin->idkaryawan;
				$_SESSION["admin"]["nama"] = $admin->nama;
				$_SESSION["admin"]["email"] = $admin->email;

				# LALU DIALIHKAN KE HALAMAN DASHBOARD ADMIN
				redirect(site_url('admin/dashboard'),'refresh');
			}else{
				# JIKA LOGIN GAGAL MAKA DIALIHKAN KE HALAMAN LOGIN LAGI
				$this->session->set_flashdata('gagal', 'Kombinasi email & password salah!');
				redirect(site_url('admin/login'),'refresh');
			}

		}else{
			# JIKA METHOD INI DIBUKA LANGSUNG TANPA MELALUI HALAMAN LOGIN
			# MAKA DIARAHAKAN / ALIHKAN KE HALAMAN LOGIN
			redirect(site_url('admin/login'),'refresh');
		}
	}

	/**
	* PROSES LOGOUT ADMIN, DESTROY ALL SESSION ADMIN
	* LALU AKAN DIALIHKAN KEHALAMAN LOGIN LAGI
	*/
	public function logout()
	{
		unset($_SESSION["admin"]); # HAPUS SESSION ADMIN
		redirect(site_url('admin/login'),'refresh'); # MENGALIHKAN KEHALAMAN LOGIN
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */