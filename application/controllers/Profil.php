<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

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
		
	}

}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */