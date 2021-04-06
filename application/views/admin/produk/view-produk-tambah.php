<div class="box box-primary">
  <div class="box-header with-border">
    <div class="box-title"><i class="fa fa-plus-circle"></i> Tambah Produk </div>
  </div>
  <div class="box-body">
    <form class="form-horizontal" action="<?php echo site_url('admin/produk/proses_tambah') ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label class="control-label col-sm-2" >Nama Produk</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Masukan nama produk" required="" name="nama" value="">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" >Harga</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" required="" name="harga" value="">
        </div>
        <label class="control-label col-sm-1" >Stok</label>
        <div class="col-sm-2">
          <input type="number" class="form-control " required name="stok" value="">
        </div>
        <label class="control-label col-sm-1" >Berat</label>
        <div class="col-sm-2">
          <div class="input-group">
            <input type="number" class="form-control" required="" name="berat" value="">
            <div class="input-group-addon">gram</div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" >Kategori</label>
        <div class="col-sm-4">
          <select class="form-control" required="" name="kat">
            <?php 
            foreach ($kategori as $row) {
              echo "<option value='{$row->idkategori}'>{$row->nama_kategori}</option>";
            }
            ?>
          </select>
        </div>
        <label class="control-label col-sm-1" >Gambar</label>
        <div class="col-sm-5">
          <input type="file" class="form-control" name="img">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" >Deskripsi</label>
        <div class="col-sm-10">
          <textarea required class="form-control" id="summernote" name="deskripsi"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>