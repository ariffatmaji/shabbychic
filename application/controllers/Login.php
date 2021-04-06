<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		// $data["title"] = "Login / daftar";
		$data["konten"] = "user/view-login";

		$this->load->view('user/index', $data);
	}

	public function proses_login()
	{
		if ($this->input->post()) {
			$email 		= $this->input->post('email', TRUE);
			$password 	= $this->input->post('password', TRUE);
			$data_login = array(
				"email" => $email,
				"password" => md5($password) // enkripsi md5() biar sama seperti didatabase
			);
			$member = $this->M_member->login($data_login);
			if ($member) {
				# jika berhasil login
				$_SESSION['user']["id"] = $member->idmember;
				$_SESSION['user']["nama"] = $member->nama;
				$this->session->set_flashdata('sukses',"Login berhasil, selamat berbelanja :) ");
			}else{
				# jika gagal login
				$this->session->set_flashdata('gagal',"Kombinasi email & password salah!");
			}

			if ($this->input->post('asal', TRUE)) {
				$asal = $this->input->post('asal', TRUE); // asal halaman login darimana
				header("Location: {$asal}");
			}else{
				redirect(site_url(''),'refresh');
			}
		}else{
			redirect(site_url(),'refresh');
		}	
	}

	public function proses_daftar()
	{
		if ($this->input->post()) {
			$email 	   = $this->input->post('email', TRUE);
			$syaratCek = array("email"=>$email);
			$cekEmail  = $this->M_member->ambil_satu($syaratCek);

			if ($cekEmail) {
				# jika email sudah terdaftar
				$this->session->set_flashdata('gagal',"Email {$email} sudah terdaftar sebagai member, silahkan gunakan email lainnya !");
			}else{
				# email belum terdaftar
				$data_member = array(
					"nama"      => $this->input->post('nama', TRUE),
					"email"     => $email,
					"password"  => md5($this->input->post('password', TRUE)), # enkripsi md5
					"jenis_kel" => $this->input->post('jekel', TRUE),
					"hp"        => $this->input->post('phone', TRUE),
				);
				$daftar = $this->M_member->insert($data_member);
				if ($daftar) {
					# jika berhasil daftar dikasih pesan berahasil
					$this->session->set_flashdata('sukses',"Pendaftaran Member berhasil, silahkan login dan selamat berbelanja :) ");
				}else{
					# jika gagal daftar
					$this->session->set_flashdata('gagal',"Registrasi gagal silahkan coba lagi!");
				}
			}
			$asal = $this->input->post('asal', TRUE); // asal halaman login darimana
			header("Location:{$asal}"); // dialihkan ke asala mula login nya
		}else{
			redirect(site_url(),'refresh');
		}	
	}

	/**
	 * proses logout user 
	*/
	public function logout()
	{
		unset($_SESSION["user"]);
		redirect(site_url(),'refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */