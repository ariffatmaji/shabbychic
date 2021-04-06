<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Order</title>
  	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
</head>
<body onload="window.print()">
	<div class="container-fluid">
		<h2 class="text-center">Laporan Order</h2>
		<p>Laporan <?php echo $status ?> dari <?php echo $awal ?> s/d <?php echo $akhir ?></p>
		<hr>
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th>Nama Member </th>
					<th>Total Harga</th>
					<th>Pengiriman</th>
					<th>Diorder</th>
					<th>Status</th>
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
						Rp. <?php echo number_format($row->total_harga,0,'.','.') ?> <small><i>(belum ongkir)</i></small>
						<br>
						belum dibayar		
					</td>
					<td>
						<span class="label label-info"><?php echo strtoupper($row->expedisi) ?></span>
						an. <?php echo ucwords($row->atas_nama) ?> (<small><?php echo $row->phone ?> </small>) <br>
						<small><i>ongkos kirim Rp<?php echo number_format($row->ongkir,0,'.','.') ?></i></small> <br>
						<!-- <small><i><?php echo $row->alamat ?></i></small> -->
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
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>