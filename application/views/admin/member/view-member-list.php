<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-list"></i> List Member </div>
	</div>
	<div class="box-body">
		<table class="table table-striped table-hover" id="myTable">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Dibuat</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$nomor = 1;
				foreach ($data as $row):
				?>
				<tr>
					<td><?php echo $nomor++ ?></td>
					<td><?php echo $row->nama ?></td>
					<td><?php echo $row->email ?></td>
					<td><?php echo $row->created_at ?></td>
					<td>
						<a href="<?php echo site_url() ?>admin/member/hapus?id=<?php echo $row->idmember ?>" onclick="return confirm('Apa Anda yakin?')"  class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>