<div class="row">
	<div class="col-sm-6">
		
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-title"><i class="fa fa-shopping-bag"></i> Data Order (<b><?php echo $data->status ?></b>) </div>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped">
					<caption>Rincian order ID #<?php echo $data->idorder ?> :</caption>
					<thead>
						<tr>
							<th>No</th>
							<th>Produk</th>
							<th>Qty</th>
							<th>Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach ($detail as $row): ?>
							
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row->namaproduk ?> <i>(@Rp<?php echo number_format($row->harga,0,".",".") ?>)</i></td>
							<td><?php echo $row->qty ?></td>
							<td>Rp<?php echo number_format($row->harga*$row->qty,0,".",".") ?></td>
						</tr>
						<?php endforeach ?>
						<tr>
							<td colspan="3" class="text-right"><b>Sub Total</b></td>
							<td><b>Rp<?php echo  number_format($data->total_harga,0,".",".") ?></b></td>
						</tr>
						<tr>
							<td colspan="3" class="text-right"><b>Ongkos Kirim</b></td>
							<td><b>Rp<?php echo  number_format($data->ongkir,0,".",".") ?></b></td>
						</tr>
						<tr>
							<td colspan="3" class="text-right"><b>Grand total</b></td>
							<td><b>Rp<?php echo number_format($data->total_harga+$data->ongkir,0,".",".") ?></b></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer">
				<a href="javascript:history.go(-1)"><i class="fa fa-angle-double-left"></i> Kembali</a>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-title"><i class="fa fa-car"></i> Data Pengiriman </div>
				<div class="box-tools pull-right">
					
				</div>
			</div>
			<div class="box-body">
				<?php if ($data->status == "pending"): ?>
					<div class="well">
						Input nomor resi hanya tampil ketika sudah bayar / konfirmasi & valid
					</div>
				<?php elseif ($data->status == "terkirim"): ?>
					<div class="well">
						Jika Paket sudah sampai ke customer silahkan klik tombol berikut: <br>
						<a href="<?php echo site_url() ?>admin/order/paketsudahsampai?idorder=<?php echo $data->idorder ?>" onclick="return confirm('Anda yakin paket sudah sampai ke customer ?')" class="btn btn-primary">Paket sudah sampai</a>
					</div>
				<?php endif ?>
				<?php 
				if ($data->status == "pending"): 
					$sudahBayar = $this->db->query("SELECT * FROM tb_konfirmasi WHERE (status_bayar IS NULL OR status_bayar='valid') AND idorder='{$row->idorder}'")->row();
					if ($sudahBayar):
				?>
				<form class="form-horizontal" method="post" action="<?php echo site_url() ?>admin/order/input_resi">
					<input type="hidden" name="idorder" value="<?php echo $data->idorder; ?>">
					<div class="form-group">
						<label class="control-label col-sm-3">Nomor Resi</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="resi" placeholder="Nomor resi tidak bisa diubah" required="">
						</div>
						<div class="col-sm-3">
							<button type="submit" class="btn btn-block btn-success">Simpan</button>
						</div>
					</div>
				</form> <br>
				<?php 
					endif;
				endif; ?>

				<div class="well">
					<p>
						<b><?php echo ucwords($data->atas_nama); ?></b> <i><?php echo $data->phone; ?></i>
						<a target="_blank" class="pull-right" href="<?php echo site_url() ?>admin/order/cetak?tipe=alamat&id=<?php echo $data->idorder ?>"><i class="fa fa-print"></i> Cetak </a>
					</p>
					<p><?php echo $data->alamat; ?></p>
					<hr>
					<p>
						<?php echo strtoupper($data->expedisi); ?> 
						<small>(<i>Rp<?php echo number_format($data->ongkir,0,".",".") ?></i>)</small>
					</p>
					<p><?php echo empty($data->no_resi) ? "<i>belum ada no resi</i>" : "Nomor resi <i><code>".$data->no_resi."</code></i>"; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>