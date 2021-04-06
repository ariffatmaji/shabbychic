<div class="box box-primary box-solid">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-bug"></i> Konfirmasi pembayaran</div>
		<div class="box-tools pull-right">
			<a href="<?php echo site_url() ?>konfirmasi/tambah" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah </a>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-striped table-hover" id="myTable">
			<thead>
				<tr>
					<th>No</th>
					<th>IDorder</th>
					<th>Rekening Nama</th>
					<th>Tagihan</th>
					<th>Bukti Bayar</th>
					<th>Status</th>
					<th>Waktu</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$nomor = 1; 
				foreach ($data as $row): 
				?>
					
				<tr>
					<td><?php echo $nomor++ ?></td>
					<td>
						<a href="<?php echo site_url() ?>riwayat/detail?id=<?php echo $row->idorder ?>">
						#<?php echo $row->idorder ?></a>
					</td>
					<td>
						<?php echo $row->rek_nama ?> <br>
						<span class="label label-info"><?php echo $row->rek_bank ?></span>
					</td>
					<td>
						Rp<?php echo number_format($row->total_harga,0,".",".") ?> <br>
						<small><i>ongkir Rp	<?php echo number_format($row->ongkir,0,'.','.') ?></i></small>
					</td>
					<td>
						<img src="<?php echo base_url() ?>uploads/bukti/<?php echo $row->bukti_tf ?>" data-action="zoom" width="40px">
					</td>
					<td>
						<?php 
						if ($row->status_bayar =="") {
							echo '<span class="label label-warning">Menunggu verifikasi</span>';
						}else{
							echo $row->status_bayar;
						}
						?>
							
					</td>
					<td><?php echo $row->created_at ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>