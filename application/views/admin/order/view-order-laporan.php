<div class="row">
	<div class="col-sm-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-title"><i class="fa fa-filter"></i> Filter Laporan </div>
			</div>
			<div class="box-body">
				<form class="form-horizontal" action="<?php echo site_url('admin/order/cetak') ?>">
					<input type="hidden" name="tipe" value="order">
				  <div class="form-group">
				    <label class="control-label col-sm-2">Status:</label>
				    <div class="col-sm-4">
				      <select class="form-control" required="" name="status">
				      	<option value="semua">Semua</option>
				      	<option value="pending">Pending</option>
				      	<option value="terkirim">Terkirim</option>
				      	<option value="selesai">Selesai</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" >Awal:</label>
				    <div class="col-sm-4">
				      <input type="date" name="awal" class="form-control" required="" value="<?php echo date("Y-m-d", strtotime("-1 month")) ?>">
				    </div>
				    <label class="control-label col-sm-2" >Akhir:</label>
				    <div class="col-sm-4">
				      <input type="date" name="akhir" class="form-control" required="" value="<?php echo date("Y-m-d") ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-9 col-sm-3">
				      <button type="submit" class="btn btn-primary btn-block">Cetak</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>