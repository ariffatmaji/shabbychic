<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-list"></i> List Karyawan </div>
		<div class="box-tools pull-right">
			<a href="<?php echo site_url() ?>admin/karyawan/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
		</div>
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
						<a href="<?php echo site_url() ?>admin/karyawan/edit?id=<?php echo $row->idkaryawan ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
						<a href="<?php echo site_url() ?>admin/karyawan/hapus?id=<?php echo $row->idkaryawan ?>" onclick="return confirm('Apa Anda yakin?')"  class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>