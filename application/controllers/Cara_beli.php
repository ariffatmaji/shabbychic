<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cara_beli extends CI_Controller {

	public function index()
	{
		$data["title"] = "Cara beli";
		$data["konten"] = "user/view-cara-beli";

		$this->load->view('user/index', $data);
	}

}

/* End of file Cara_membeli.php */
/* Location: ./application/controllers/Cara_membeli.php */