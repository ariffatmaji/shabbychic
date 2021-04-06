<div class="row">
  <!-- sidebar kategori -->
  <div class="col-sm-3">
    <?php $this->load->view('user/produk/view-produk-kategori-left'); ?>
  </div>
  
  <!-- right bar list produk -->
  <div class="col-sm-9">

    <?php if ($data): ?>
    <div class="row">
      <?php foreach ($data as $row): ?>
        
      <div class="col-sm-4">
        <div class="panel panel-primary ">
          <div class="panel-heading"><?php echo $row->namaproduk ?></div>
          <div class="panel-body">
              <i class="fa fa-tags"></i> <?php echo $row->nama_kategori ?><small> <code>[<?php echo $row->stok ?>]</code></small> <br> <br>
            <div class="text-center">
              <img src="<?php echo base_url() ?>uploads/produk/<?php echo $row->gambar  ?>" style="width: 95%;height: 140px; cursor: pointer !important;" class="img-thumbnail hvr-glow" data-action="zoom" >
                <br>
                <b style="font-size: 2em">Rp<?php echo number_format($row->harga,0,'.','.') ?></b>
            </div>
          </div>
          <div class="panel-footer text-center">
            <!-- <a href="<?php echo site_url() ?>cart/tambah?idproduk=<?php echo $row->idproduk ?>" class=" hvr-sweep-to-right " style="cursor: pointer;">Beli</a> -->
            
            <a href="<?php echo site_url() ?>produk/detail?idproduk=<?php echo $row->idproduk ?>" class="hvr-icon-forward">
              Selengkapnya
              <i class="fa fa-chevron-circle-right hvr-icon"></i>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach ?>

    </div>
    <?php else: ?>
      <!-- JIKA  PRODUK TIDAK ADA HASIL / TERSEDIA-->
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title"><i class="fa fa-search"></i> Produk Kategori</b></div>
        </div>
        <div class="panel-body text-center">
          <h4>Maaf, produk kategori yang Anda cari tidak tersedia</h4>
        </div>
      </div>
    <?php endif ?>
  </div>
</div>