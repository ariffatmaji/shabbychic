<div class="box box-primary box-solid">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-truck"></i> List Belanja </div>
	</div>
	<div class="box-body">
		<div class="well">
			<p><i class="fa fa-info-circle"></i> Penting :  penjelasan tentang status</p>
			<ul>
				<li>
					<span class="label label-warning">Pending</span> : Anda belum melakukan pembayaran / konfirmasi / sedang dalam verifikasi penjual. 
				</li>
				<li><span class="label label-primary">Terkirim</span> : Order an Anda sedang dalam proses pengiriman</li>
				<li><span class="label label-success">Selesai</span> : Anda telah menerima Order</li>
				<li>Silahkan transfer ke <b>BCA</b> an. <b>John Doe</b> norek <b>00-09394-4343-111</b></li>
			</ul>
		</div>
		<table class="table table-striped table-hover" id="myTable">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th>Nama Member </th>
					<th>Pengiriman</th>
					<th>Waktu Order</th>
					<th>Total Tagihan</th>
					<th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				foreach ($data as $row):

				$sudahBayar = $this->db->query("SELECT * FROM tb_konfirmasi WHERE (status_bayar IS NULL OR status_bayar='valid') AND idorder='{$row->idorder}'")->row();
				?>
				<tr>
					<td class="text-center" style="vertical-align: middle;">
						<?php echo $row->idorder ?> <br>
							<?php
						$status = $row->status;
						if ($status == "pending") {
							echo '<span class="label label-warning">Pending</span>';
						}
						if ($status == "terkirim") {
							echo '<span class="label label-primary">Terkirim</span>';
						}
						if ($status == "selesai") {
							echo '<span class="label label-success">Selesai</span>';
						}
						?>
						</td>
					<td>
						<?php echo ucwords($row->nama) ?> <br>
						<small><i><?php echo $row->total_qty ?> produk diorder</i></small>
					</td>
					<td>
						<span class="label label-info"><?php echo strtoupper($row->expedisi) ?></span>
						an. <?php echo ucwords($row->atas_nama) ?> (<small><?php echo $row->phone ?> </small>) <br>
						<small><i>ongkos kirim Rp<?php echo number_format($row->ongkir,0,'.','.') ?></i></small>
					</td>
					<td><?php echo $row->created_at ?></td>
					<td>
						Rp<?php echo number_format($row->total_harga + $row->ongkir, 0,'.','.') ?>
					</td>
					<td class="text-center">
						<a href="<?php echo site_url() ?>riwayat/detail?id=<?php echo $row->idorder ?>" class="btn btn-info"><i class="fa fa-reply-all"></i> Detail</a>

						<?php if (!$sudahBayar): ?>
							<a href="<?php echo site_url() ?>konfirmasi/tambah?id=<?php echo $row->idorder ?>"  class="btn btn-danger"><i class="fa fa-plus-circle"></i> Konfirmasi</a>
						<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>