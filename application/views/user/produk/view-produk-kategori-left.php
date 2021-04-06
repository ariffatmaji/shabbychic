<div class="panel panel-primary">
  <div class="panel-heading ">
    <div class="panel-title"><i class="fa fa-tags"></i> Kategori Produk</div>
  </div>
  <div class="panel-body">
    <div class="list-group">
      <?php foreach ($kategori as $row): 
        $active = (isset($_GET['idkat']) AND $this->input->get('idkat') == $row->idkategori) ? "active" :" ";
        $jumlah_produk = $this->db->query("SELECT * FROM tb_produk WHERE idkategori='{$row->idkategori}'")->num_rows();
        ?>
        <a href="<?php echo site_url() ?>produk/kategori?idkat=<?php echo $row->idkategori ?>" class="list-group-item <?php echo $active ?>"><?php echo $row->nama_kategori ?> <span class="badge"><?php echo $jumlah_produk ?></span></a>
      <?php endforeach ?>
    </div>
  </div>
</div>