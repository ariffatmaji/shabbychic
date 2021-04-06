<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {


	/*
	 menampilkan semua order
	*/
	public function index()
	{
		$data["title"] 	= "Order";

		# DATA KETERANGAN HEADER TABLE
		$data["ket"] 	= "Semua data order yang telah diorder oleh member atau customer";
		$data["data"]   = $this->M_order->orderjoinmember(); # ambil data dari model/table

		$data["breadcrumb"] = array("Order","Semua");
		$data["konten"] = "admin/order/view-order-semua";
		$this->load->view('admin/index', $data);
	}

	/*
	 method /function menampilkan data order yang hanya status pending
	*/
	public function pending()
	{
		$data["title"] 	= "Order Pending";

		# DATA KETERANGAN HEADER TABLE
		$data["ket"] 	= "Semua data order yang masih <code>pending</code> (belum dibayar oleh customer atau belum dikirimkan oleh penjual) ";
		$data["data"]   = $this->M_order->orderjoinmember("status='pending'"); # ambil data dari model/table

		$data["breadcrumb"] = array("Order","Pending");
		$data["konten"] = "admin/order/view-order-semua";
		$this->load->view('admin/index', $data);
	}

	/*
	 method /function menampilkan data order yang hanya status terkirim
	*/
	public function terkirim()
	{
		$data["title"] 	= "Order Terkirim";
		# DATA KETERANGAN HEADER TABLE
		$data["ket"] 	= "Order <code>terkirim </code> merupakan semua data order yang sudah dikirimkan oleh penjual atau dalam perjalanan oleh kurir tapi belum diterima oleh customer";
		$data["data"]   = $this->M_order->orderjoinmember("status='terkirim'"); # ambil data dari model/table

		$data["breadcrumb"] = array("Order","Terkirim");
		$data["konten"] = "admin/order/view-order-semua";
		$this->load->view('admin/index', $data);
	}

	/*
	 method /function menampilkan data order yang hanya status selesai
	*/
	public function selesai()
	{
		$data["title"] 	= "Order Selesai";

		# DATA KETERANGAN HEADER TABLE
		$data["ket"] 	= "Order <code>selesai </code> merupakan semua data order yang telah diterima oleh customer";
		$data["data"]   = $this->M_order->orderjoinmember("status='selesai'"); # ambil data dari model/table

		$data["breadcrumb"] = array("Order","Selesai");
		$data["konten"] = "admin/order/view-order-semua";
		$this->load->view('admin/index', $data);
	}

	/**
	 *  METHOD / FUNCTION UNTUK MENAMPILKAN DETAIL SETIAP ORDER
	 */
	public function detail()
	{
		if ($this->input->get('id', TRUE)) {
			# JIKA DI URL ADA GET ID
			$id = $this->input->get('id', TRUE);

			$syarat = "idorder = {$id}";
			$data["data"] = $this->M_order->orderjoinmember_satu($syarat);
			$data["detail"] = $this->M_detail_order->detailjoinproduk($syarat);


			$data["konten"] = "admin/order/view-detail-order";
			$this->load->view('admin/index', $data);
		}else{
			# JIKA TIDAK DIAKSES DARI PAGE LIST
			redirect(site_url("admin/order"),'refresh');
		}
	}

	/**
	 * halaman  laporan
	 * 
	 */
	public function laporan()
	{
	  	$data["title"] 	= "Order Laporan";


		$data["breadcrumb"] = array("Order","laporan");
		$data["konten"] = "admin/order/view-order-laporan";
		$this->load->view('admin/index', $data);
	} 

	/*
		untuk input resi
	*/
	public function input_resi()
	{
		if ($this->input->post()) {
			$idorder = $this->input->post('idorder', TRUE);
			# update nomor resi & status order jadi terkirim
			$data_update = array(
			    'no_resi' => $this->input->post('resi', TRUE),
			    "status"  => "terkirim"
			);
			$update = $this->M_order->update($data_update, $idorder);
			if ($update) {
				# JIKA BERHASIL UPDATE DB
				$this->session->set_flashdata('sukses', 'Input nomor resi berhasil');
			}else{
				# JIKA GAGAL UPDATE KE DB
				$this->session->set_flashdata('gagal', 'Input nomor resi gagal');
			}

			redirect(site_url('admin/order/detail?id='.$idorder),'refresh');
		}
	}

	/**
	 * untuk cetak 
	 * 	- data order atau 
	 * 	- data alamat
	 */ 
	public function cetak()
	{
		if ($this->input->get('tipe', TRUE)) {
			$tipe = $this->input->get('tipe', TRUE);

			switch ($tipe) {
				case "order":
					$status = $this->input->get('status', TRUE);
					$awal   = $this->input->get('awal', TRUE);
					$akhir  = $this->input->get('akhir', TRUE);

					if ($status =="semua") {
						# JIKA PILIH CETAK SEMUA STATUS ORDER
						$syarat = "o.created_at >= '{$awal} 00:00:01' AND o.created_at <= '{$akhir} 23:59:59'";
					}else{
						$syarat = "status='{$status}' AND o.created_at >= '{$awal} 00:00:01' AND o.created_at <= '{$akhir} 23:59:59'";
					}
					$data["data"] = $this->M_order->orderjoinmember($syarat);

					$data["awal"]   = $awal;
					$data["akhir"]  = $akhir;
					$data["status"] = $status;
					$this->load->view('admin/order/view-cetak-order', $data);
					break;

				case "alamat":
					# CETAK ALAMAT PENGIRIMAN
					$idorder = $this->input->get('id', TRUE); # ID ORDER
					$syarat  = "idorder = {$idorder}";
					$data["data"] = $this->M_order->orderjoinmember_satu($syarat);
					$this->load->view('admin/order/view-cetak-alamat', $data);
					break;
			}
		}else{
			# JIKA TIDAK ADA GET TIPE DI URL MAKA DIALIHKAN KE LIST ORDER SEMUA
			redirect(site_url("admin/order"),'refresh');
		}
	}

	/*
		untuk mengubah status dari terkirim menjadi selesai 
		jika paket sudah diterima oleh customer
	*/
	public function paketsudahsampai()
	{
		if ($this->input->get('idorder', TRUE)) {
			$idorder = $this->input->get('idorder', TRUE);
			$data_update = array(
			    "status"  => "selesai"
			);
			$update = $this->M_order->update($data_update, $idorder);
			if ($update) {
				# JIKA BERHASIL UPDATE DB
				$this->session->set_flashdata('sukses', 'Status Order berhasil diselesaikan');
			}else{
				# JIKA GAGAL UPDATE KE DB
				$this->session->set_flashdata('gagal', 'Status Order gagal diselesaikan');
			}

			redirect(site_url('admin/order/detail?id='.$idorder),'refresh');
		}
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */