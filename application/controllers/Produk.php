<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function index()
	{
		$this->load->library('pagination');
        // konfigurasi pagination
        $config['base_url'] 	= site_url('produk/index'); //site url
        $config['total_rows'] 	= $this->M_produk->jumlah_semua(); //total row
        $config['per_page'] 	= 6;  // show record per halaman
        $config["uri_segment"] 	= 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v3
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['data'] = $this->M_produk->produk_page_user($config["per_page"], $data['page']);           
        $data["pagination"] = $this->pagination->create_links();
		$data["kategori"] = $this->M_kategori->getOrderNama();

		$data["title"] = "Produk";
		$data["breadcrumb"] = array("Produk");
		$data["konten"] = "user/produk/view-produk";

		$this->load->view('user/index', $data);
	}

    /*
        menampilkan produk per kategori
    */
    public function kategori()
    {
        if ($this->input->get('idkat', TRUE)) {
            $idkat = $this->input->get('idkat', TRUE);

            $syarat = "k.idkategori = '{$idkat}'";
            $data['data']       = $this->M_produk->produkperkategori($syarat);     
            $data["kategori"]   = $this->M_kategori->getOrderNama();

            $data["title"]      = "Produk Kategori";
            $data["konten"]     = "user/produk/view-produk-kategori";
            $data["breadcrumb"] = array("Produk","Kategori");

            $this->load->view('user/index', $data);
        }
    }

    /*
        halaman untuk pencarian produk
    */
    public function pencarian()
    {
        if ($this->input->get('q', TRUE)) {
            $query = $this->input->get('q', TRUE); # kata / nama produk yang dicari
            
            $data['data']     = $this->M_produk->produkPencarian($query);     
            $data["kategori"] = $this->M_kategori->getOrderNama();

            $data["title"]      = "Produk Kategori";
            $data["konten"]     = "user/produk/view-produk-pencarian";
            $data["breadcrumb"] = array("Produk","Kategori");

            $this->load->view('user/index', $data);
        }
    }

    /*
        halaman detail produk
    */
    public function detail()
    {   
        // detail dari idproduk berapa
        if ($this->input->get('idproduk', TRUE)) {
            $idproduk = $this->input->get('idproduk', TRUE);
            $syarat = "idproduk='{$idproduk}'";
            $data["produk"] = $this->M_produk->ambil_satu($syarat);
            $data["kategori"]   = $this->M_kategori->getOrderNama();

            $data["title"]      = "Detail Produk";
            $data["konten"]     = "user/produk/view-produk-detail";
            $data["breadcrumb"] = array("Produk","Detail");

            $this->load->view('user/index', $data);
        }
    }

}

/* End of file Daftar.php */
/* Location: ./application/controllers/Daftar.php */