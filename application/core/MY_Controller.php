<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		# CEK APAKAH ADA SESSION ADMIN
		if (!isset($_SESSION["admin"])) {
			# JIKA BELUM ADA BERARTI BELUM LOGIN MAKA DIARAHKAN KE HALAMAN LOGIN ADMIN
			redirect(site_url("admin/login"),'refresh');
		}
	}


}

/* End of file ADMIN_Controllers.php */
/* Location: ./application/controllers/ADMIN_Controllers.php */