<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {


	public function index()
	{
		if (isset($_SESSION['order'])) {
			# jika ada pesanan

			$data["title"] = "Cart";
			$data["breadcrumb"] = array("Keranjang");
			$data["konten"] = "user/view-keranjang";
			$data["provinsi"] = $this->get_ProvinsiRajaOngkir();
			// $this->get_ProvinsiRajaOngkir();

			$this->load->view('user/index', $data);

		}else{
			# DIALIHKAN KE HOME, JIKA BELUM MEMBELI PRODUK
			redirect(site_url(),'refresh');

		}
	}

	// menambhakan produk ke keranjang
	public function tambah()
	{
		if ($this->input->get('idproduk', TRUE)) {
			$idproduk = $this->input->get('idproduk', TRUE);

			if ($this->input->get('qty', TRUE)) {
				$_SESSION['order'][$idproduk] = $this->input->get('qty', TRUE);
			}else{
				$_SESSION['order'][$idproduk] = 1; # quantity 1
			}
			redirect(site_url('cart'),'refresh');
		}else{
			# jika diurl tidak ada get idproduk
			# DIALIHKAN KE HOME,
			redirect(site_url(''),'refresh');
		}
	}

	// menambah quantity produk
	public function tambah_qty()
	{
		if ($this->input->get("idproduk", TRUE)) {
			$idproduk = $this->input->get('idproduk', TRUE);
			$stok 	  = $this->input->get('stok', TRUE);

			$quantity = $_SESSION["order"][$idproduk]; // ambil qty yang dibeli
			if ($quantity + 1 <= $stok) { // jika qty + 1 masih kurang = stok maka masih bisa tmabah stok
				$_SESSION["order"][$idproduk] += 1;
			}
			redirect(site_url('cart'),'refresh');
		}
	}

	// mengurangi quantity produk
	public function kurangi_qty()
	{
		if ($this->input->get("idproduk", TRUE)) {
			$idproduk = $this->input->get('idproduk', TRUE);

			$quantity = $_SESSION["order"][$idproduk]; // ambil qty yang dibeli
			// jika qty - 1 hasilnya diatas = 1 maka masih bisa dikurangi, 
			// simple nya quantity tidak boleh kosong
			if ($quantity - 1 >= 1 ) { 
				$_SESSION["order"][$idproduk] -= 1;
			}
			redirect(site_url('cart'),'refresh');
		}
	}

	/*
		hapus data keranjang
	*/
	public function hapus()
	{
		if ($this->input->get('idproduk', TRUE)) {
			$idproduk = $this->input->get('idproduk', TRUE);
			unset($_SESSION['order'][$idproduk]); // hapus session produk 
			redirect(site_url('cart'),'refresh');
		}
	}

	/**
	 * proses checkout
	 * 
	 */
	public function checkout()
	{
		if ($this->input->post()) {
		 	if (isset($_SESSION['order'])) {
		 		if (isset($_SESSION['user'])) {
		 			$idmember = $_SESSION['user']["id"];

		 			$paket = $this->input->post('paket', TRUE);
		 			$pisah = explode(",",$paket);
		 			$kurir = $this->input->post('kurir', TRUE);
		 			$expedisi = $kurir." - ".$pisah[0]; # expedisi dan nama ppaket
		 			$ongkir = $pisah[1]; # ongkos kirim

		 			$idorder = date("ymd").rand(1,999);

		 			$data_order = array(
		 				"idorder"	  => $idorder,
		 				"idmember"    => $idmember,
		 				"total_harga" => 0,
		 				"ongkir"      => $ongkir,
		 				"status"      => "pending",
		 				"atas_nama"   => $this->input->post('penerima', TRUE),
		 				"alamat"      => $this->input->post('alamat', TRUE),
		 				"phone"       => $this->input->post('phone', TRUE),
		 				"expedisi"    => $expedisi,
		 				"total_berat" => 0,
		 				"total_qty"   => count($_SESSION['order']),
		 				"created_at"  => date("Y-m-d H:i:s"),
		 			);
		 			$this->M_order->insert($data_order); # data order

		 			$total_harga = 0;
		 			$total_berat = 0;
		 			foreach ($_SESSION['order'] as $idbrg => $qty) {

		 				$syarat = array("idproduk"=> $idbrg);
						$produk = $this->M_produk->ambil_satu($syarat);

						$subtotal = $produk->harga*$qty;
						$total_harga += $subtotal;
						$sub_berat 	 = $produk->berat* $qty; // sub berat = berat x quantity
						$total_berat += $sub_berat; // total berat = sub berat +  sub berat

						$data_detail_order = array(
							"idorder"  => $idorder,
							"idproduk" => $idbrg,
							"qty"      => $qty,
							"subtotal" => $subtotal
						);
						$this->M_detail_order->insert($data_detail_order);

						# UPDATE STOK, DIKURANGI QUANTITY YANG DIBELI
						$stok_awal  = $produk->stok;
						$stok_akhir = $stok_awal - $qty; # stok awal - qty yang dibeli
						$update_stok = array(
							"stok" => $stok_akhir
						);
						$this->M_produk->update($update_stok, $idbrg);
		 			}

		 			$order_update = array(
		 				"total_harga" => $total_harga,
		 				"total_berat" => $total_berat,
		 			);
		 			$this->M_order->update($order_update, $idorder);

		 			unset($_SESSION["order"]); # delete orderan
		 			$this->session->set_flashdata('sukses', 'Checkout berhasil, silahkan lakukan pembayaran');
		 			redirect(site_url("riwayat"),'refresh');
		 		}else{
		 			# MEMBER BELUM LOGIN
					redirect(site_url(''),'refresh');
		 		}		
		 	}else{
		 		# MEMBER BELUM BELANJA / KERANJANG KOSONG
				redirect(site_url(''),'refresh');
		 	}	
		}else{
			# TIDAK ADA KIRIMAN POST
			redirect(site_url(''),'refresh');
		} 	
	} 


	/*
		untuk rajaongkir ambil nama provinsi indonesia
	*/
	public function get_ProvinsiRajaOngkir()
	{
		$json = file_get_contents("assets/provinsi.json");
		$data = json_decode($json,true);
		return $data;
	}

	// ambil data kota / kabupaten berdasarkan provinsi yang dipilih
	public function ajax_getKotaRajaOngkir()
	{
		$idprov = $this->input->post('idprov', TRUE);
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api.rajaongkir.com/starter/city?province='.$idprov);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Key: 866e4175fe817779914e89bc840768ad']);

		$result = curl_exec($ch);
		curl_close($ch);

		$result_arr = json_decode($result,true);
		$kabupaten = "";
		foreach ($result_arr["rajaongkir"]["results"] as $kab) {
			$idkab = $kab["city_id"] ? $kab["city_id"] : 00;
			$nmkab = $kab["city_name"];
			$kabupaten .= "<option value='{$idkab}'>{$nmkab}</option>";
		}
		echo $kabupaten;
	}

	// ambil biaya pengiriman
	public function get_biayaRajaOngkir()
	{
		if ($this->input->post()) {
			$idprov = $this->input->post('idprov', TRUE);
			$idkab  = $this->input->post('idkab', TRUE);
			$berat  = $this->input->post('berat', TRUE);
			$kurir  = $this->input->post('kurir', TRUE);

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, 'https://api.rajaongkir.com/starter/cost');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "origin=177&destination={$idkab}&weight={$berat}&courier={$kurir}");

			$headers = array();
			$headers[] = 'Content-Type: application/x-www-form-urlencoded';
			$headers[] = 'Key: 866e4175fe817779914e89bc840768ad';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			curl_close($ch);
			$result_arr = json_decode($result, true);

			$paket = "";
			foreach ($result_arr["rajaongkir"]["results"][0]["costs"] as $row) {
				$text  = "{$row["service"]}  Rp{$row["cost"][0]["value"]} ( {$row["cost"][0]["etd"]} hari )";
				$value  = "{$row["service"]}, {$row["cost"][0]["value"]}, {$row["cost"][0]["etd"]} hari";
				$paket .= "<option value='{$value}'>{$text}</option>";
			}
			echo $paket;
		}
	}

}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */