<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Riwayat extends CI_Controller {

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
		$data["title"] = "Riwayat Belanja";
		$data["konten"] = "user/view-riwayat";

		$idmember = $_SESSION['user']["id"];
		$syarat = "o.idmember = '{$idmember}'";
		$data["data"] = $this->M_order->orderjoinmember($syarat);
		$this->load->view('user/index', $data);
	}

	public function detail()
	{
		if ($this->input->get('id', TRUE)) {
			# JIKA DI URL ADA GET ID
			$id = $this->input->get('id', TRUE);

			$syarat = "idorder = {$id}";
			$data["data"] = $this->M_order->orderjoinmember_satu($syarat);
			$data["detail"] = $this->M_detail_order->detailjoinproduk($syarat);


			$data["konten"] = "user/view-detail-riwayat";
			$this->load->view('user/index', $data);
		}else{
			# JIKA TIDAK DIAKSES DARI PAGE LIST
			redirect(site_url("admin/order"),'refresh');
		}
	}

}

/* End of file Riwayat.php */
/* Location: ./application/controllers/Riwayat.php */