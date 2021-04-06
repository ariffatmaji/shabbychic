<div class="row">
	<div class="col-sm-3">
	    <?php $this->load->view('user/produk/view-produk-kategori-left'); ?>
	</div>
	<div class="col-sm-9">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo $produk->namaproduk ?></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6">
						<img src="<?php  echo base_url() ?>uploads/produk/<?php echo $produk->gambar ?>" class="img-responsive img-thumbnail" style="width:100%;height: 300px" data-action="zoom">
					</div>
					<div class="col-sm-6">
						<h2 class="well"><b>Rp<?php echo number_format($produk->harga,0,'.','.') ?></b></h2>
						<table class="table table-hover table-striped">
							<tr>
								<td>Kategori</td>
								<td>:</td>
								<td>
									<?php 
									$syarat = "idkategori = {$produk->idkategori}";
									$kategori = $this->M_kategori->ambil_satu($syarat);
									echo $kategori->nama_kategori;
									?>
								</td>
							</tr>
							<tr>
								<td>Stok</td>
								<td>:</td>
								<td><?php echo $produk->stok ?></td>
							</tr>
							<tr>
								<td>Berat</td>
								<td>:</td>
								<td><?php echo $produk->berat ?> gram</td>
							</tr>
						</table>
						<form class="form-horizontal" action="<?php echo site_url() ?>cart/tambah">
							<input type="hidden" name="stok" value="<?php echo $produk->stok ?>">
							<input type="hidden" name="idproduk" value="<?php echo $produk->idproduk ?>">
							<div class="form-group">
								<label class="control-label col-sm-3">Jumlah</label>
								<div class="col-sm-4">
								  <input type="number" name="qty" class="form-control" value="1" required="" max="<?php echo $produk->stok ?>">
								</div>
								<div class="col-sm-5">
								  <button type="submit" class="btn btn-primary">Beli Sekarang</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-12">
						<div class="page-header"><i class="fa fa-newspaper-o"></i> Deskripsi</div>
						<?php echo nl2br($produk->deskripsi) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>