<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-list"></i> List Order <?php echo ucfirst($this->uri->segment(3)) ?></div>
	</div>
	<div class="box-body">
		<div class="well">
			<h4><i class="fa fa-info-circle"></i> Informasi : </h4>
			<p><?php echo $ket ?></p>
		</div>
		<table class="table table-striped table-hover" id="myTable">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th>Nama Member </th>
					<th>Total Harga</th>
					<th>Pengiriman</th>
					<th>Diorder</th>
					<th>Status</th>
					<th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php  foreach ($data as $row):?>
				<tr>
					<td class="text-center" style="vertical-align: middle;"><?php echo $row->idorder ?></td>
					<td>
						<?php echo ucwords($row->nama) ?> <br>
						<small><i><?php echo $row->total_qty ?> produk diorder</i></small>
					</td>
					<td>
						Rp. <?php echo number_format($row->total_harga,0,'.','.') ?> <small><i>(belum ongkir)</i></small><br>
						belum dibayar		
					</td>
					<td>
						<span class="label label-info"><?php echo strtoupper($row->expedisi) ?></span>
						an. <?php echo ucwords($row->atas_nama) ?> (<small><?php echo $row->phone ?> </small>) <br>
						<small><i>ongkos kirim Rp<?php echo number_format($row->ongkir,0,'.','.') ?></i></small>
					</td>
					<td><?php echo $row->created_at ?></td>
					<td>
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
					<td class="text-center">
						<a href="<?php echo site_url() ?>admin/order/detail?id=<?php echo $row->idorder ?>" class="btn btn-info"><i class="fa fa-reply-all"></i> Detail</a>
						<!-- <a href="<?php echo site_url() ?>admin/order/hapus?id=<?php echo $row->idorder ?>" onclick="return confirm('Apa Anda yakin?')"  class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a> -->
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>