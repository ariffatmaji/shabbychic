<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-list"></i> List Konfirmasi </div>
		<div class="box-tools pull-right">
			<a href="<?php echo site_url() ?>admin/kategori/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
		</div>
	</div>
	<div class="box-body">
		<div class="well">
			<p><i class="fa fa-info-circle"></i> Penting</p>
			<ul>
				<li>Silahkan Anda cek bukti transfer & rekening apakah sudah masuk dana nya atau belum.</li>
				<li>Jika sudah masuk pilih status bukti <code>valid</code> </li>
				<li>Jika belum/tidak masuk pilih status bukti <code>tidak  valid </code></li>
				<li>Setelah Anda ubah statusnya maka tidak dapat dikembalikan lagi</li>
			</ul>
		</div>
		<table class="table table-striped table-hover" id="myTable">
			<thead>
				<tr>
					<th>No</th>
					<th>ID Order</th>
					<th>Nama Pengirim</th>
					<th>Bank</th>
					<th>Bukti </th>
					<th class="text-center" width="192px">Aksi</th>
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
						#<?php echo $row->idorder ?> <br>
						<a href="<?php echo site_url() ?>admin/order/detail?id=<?php echo $row->idorder ?>" target="_blank">[ lihat ]</a>
					</td>
					<td>
						<?php echo $row->rek_nama ?> <br>
						<i>@ <?php echo $row->waktu_upload ?></i>		
					</td>
					<td>
						<?php echo strtoupper($row->rek_bank) ?> <br>
						<small><i>Bukti
						<?php if ($row->status_bayar !=""): ?>
							<!-- JIKA STATUS DIDATABASE TIDAK KOSONG -->
							<?php if ($row->status_bayar == "valid"): ?>
								<!-- JIKA STATUS VALIDA  -->
								<i class="fa fa-check"></i> Valid
							<?php else: ?>
								<!-- JIKA TIDAK VALID -->
								<i class="fa fa-close"></i> Tidak Valid
								<?php endif ?>
						<?php endif ?>
						</i></small>
					</td>
					<td>
						<img src="<?php echo base_url() ?>uploads/bukti/<?php echo $row->bukti_tf ?>" data-action="zoom" width="50px">							
					</td>
					<td class="text-center">
						<div class="btn-group">
							<?php if ($row->status_bayar==""): ?>
								<!-- JIKA DITABASE STATUS BAYAR NYA KOSONG / NULL -->
							  <div class="btn-group">
							    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							    <i class="fa fa-bug"></i> Status Bukti <span class="caret"></span></button>
							    <ul class="dropdown-menu" role="menu">
								    <li>
								    	<a href="<?php echo site_url() ?>admin/konfirmasi/ubah_status?id=<?php echo $row->idkonfirmasi ?>&status=valid" onclick="return confirm('Anda yakin ? tidak dapat dikembalikan')">Valid</a>
								    </li>
								    <li>
								    	<a href="<?php echo site_url() ?>admin/konfirmasi/ubah_status?id=<?php echo $row->idkonfirmasi ?>&status=tidak valid" onclick="return confirm('Anda yakin ? tidak dapat dikembalikan')">Tidak Valid</a>
								    </li>
							    </ul>
							  </div>
							<?php endif ?>

						  	<a href="<?php echo site_url() ?>admin/konfirmasi/hapus?id=<?php echo $row->idkonfirmasi ?>&img=<?php echo $row->bukti_tf ?>" onclick="return confirm('Apa Anda yakin? tidak dapat dikembalikan')"  class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
						</div>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>