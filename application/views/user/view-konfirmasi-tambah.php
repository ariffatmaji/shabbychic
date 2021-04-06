<div class="box">
	<div class="box-header with-border">
		<div class="box-title">Form Konfirmasi</div>
	</div>
	<div class="box-body">
		<div class="well">
			<h5>Hanya menampilkan data order yang belum konfirmas atau data konfirmasi tidak valid</h5>
		</div>
		<form class="form-horizontal" method="post" action="<?php echo site_url() ?>konfirmasi/proses_tambah" enctype="multipart/form-data">
		  <div class="form-group">
		    <label class="control-label col-sm-2" >Data Order:</label>
		    <div class="col-sm-10" >
		    	<select class="form-control" required="" name="idorder">
		    		<?php 
		    		foreach ($data as $row): 
		    			# check apakah order ini sudah dikonfirmasi / tidak valid 
		    			# jika status valid atau sudah ada maka tidak akan ditampilkan
		    			$sudahBayar = $this->db->query("SELECT * FROM tb_konfirmasi WHERE (status_bayar IS NULL OR status_bayar='valid') AND idorder='{$row->idorder}'")->row();
		    			if (!$sudahBayar) : 
		    			# jika  belum ada

		    			# untuk selected tambah konfirmasi
		    			$selected = $this->input->get('id', TRUE) == $row->idorder ? "selected" :"";
		    		?>
		    			<option <?php echo $selected ?>>
		    				<?php echo $row->idorder ?> - Rp<?php echo number_format($row->total_harga + $row->ongkir,0,'.','.'); ?>
		    					
		    			</option>
		    		<?php 
		    			endif;
			    	endforeach ?>
		    	</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" >Nama Rekening :</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="Nama Rekening Pengirim" name="nama">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" >Bank Pengirim :</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="Nama Bank" required="" name="bank">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" >Bukti Transfer :</label>
		    <div class="col-sm-10">
		      <input type="file" class="form-control" required="" name="img">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		  </div>
		</form>
	</div>
	<div class="box-footer">
		<a href="javascript:history.go(-1)"><i class="fa fa-angle-double-left"></i> Kembali</a>
	</div>
</div>