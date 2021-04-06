<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-edit"></i> Edit Data </div>
	</div>
	<div class="box-body">

		<form class="form-horizontal" action="<?php echo site_url('admin/kategori/proses_edit') ?>" method="post">
			<input type="hidden" name="id" value="<?php echo $data->idkategori ?>">
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="text">Nama Kategori</label>
		    <div class="col-sm-4">
		      <input type="text" name="nama" class="form-control" id="text" placeholder="Masukan nama lengkap" required="" value="<?php echo $data->nama_kategori ?>">
		      <span class="help-block">Harus unik tidak boleh sama.</span>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="text">Keterangan</label>
		    <div class="col-sm-8">
		      <textarea class="form-control" placeholder="Tidak wajib diisi" name="ket"><?php echo $data->keterangan ?></textarea>
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