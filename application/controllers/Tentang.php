<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tentang extends CI_Controller {

	public function index()
	{
		$data["title"]  = "Tentang Kami";
		$data["konten"] = "user/view-tentang";

		$this->load->view('user/index', $data);
	}

}

/* End of file Tentang.php */
/* Location: ./application/controllers/Tentang.php */