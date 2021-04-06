<!-- SLIDER -->
<div class="row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-8">
      <ul class="bxslider">
        <li><img src="<?php echo base_url() ?>uploads/slider/1.png" /></li>
        <li><img src="<?php echo base_url() ?>uploads/slider/2.png" /></li>
        <li><img src="<?php echo base_url() ?>uploads/slider/3.png" /></li>
        <li><img src="<?php echo base_url() ?>uploads/slider/4.png" /></li>
        <li><img src="<?php echo base_url() ?>uploads/slider/5.png" /></li>
      </ul>
  </div>
  <div class="col-sm-2">&nbsp;</div>
</div>

<!-- slider product -->
<div class="row">
   <?php foreach ($data as $row): ?>
        
     <div class="col-sm-3">
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


<div class="panel panel-default">
  <div class="panel-body text-center">
    <a href="<?php echo site_url() ?>produk">Lihat semua produk <i class="fa fa-angle-double-right"></i></a>
  </div>
</div>