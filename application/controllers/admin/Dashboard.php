<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		$data["title"]  = "Dashboard";
		$data["konten"] = "admin/view-dashboard";
		$this->load->view('admin/index', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */