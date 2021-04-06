<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data["data"] = $this->M_produk->produkHome();
		
		$data["title"] = "Beranda";
		$data["konten"] = "user/view-home";
		$this->load->view('user/index', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */