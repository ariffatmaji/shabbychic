<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-plus-circle"></i> Tambah Data </div>
	</div>
	<div class="box-body">

		<form class="form-horizontal" action="<?php echo site_url('admin/kategori/proses_tambah') ?>" method="post">
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="text">Nama Kategori</label>
		    <div class="col-sm-4">
		      <input type="text" name="nama" class="form-control" id="text" placeholder="Masukan nama lengkap" required="">
		      <span class="help-block">Harus unik tidak boleh sama.</span>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="text">Keterangan</label>
		    <div class="col-sm-8">
		      <textarea class="form-control" placeholder="Tidak wajib diisi" name="ket"></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="reset" class="btn btn-danger">Reset</button>
		      <button type="submit" class="btn btn-success">Submit</button>
		    </div>
		  </div>
		</form>

	</div>
	<div class="box-footer">
		<a href="<?php echo site_url() ?>admin/kategori"><i class="fa fa-angle-double-left"></i> back to list</a>
	</div>
</div>