<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title"><i class="fa fa-list"></i> List Produk </div>
		<div class="box-tools pull-right">
			<a href="<?php echo site_url() ?>admin/produk/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-striped table-hover" id="myTable">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Kategori</th>
					<th>Deskripsi</th>
					<th>Harga</th>
					<th>Gambar</th>
					<th>Dibuat</th>
					<th class="text-center" style="width: 160px">Aksi</th>
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
						<?php echo $row->namaproduk ?> <br>
						<small>
							<label class="label label-info">stok : <?php echo $row->stok ?></label>
							<label class="label label-warning">berat : <?php echo $row->berat ?>gr</label>
						</small>
					</td>
					<td><?php echo $row->nama_kategori ?></td>
					<td><?php echo substr($row->deskripsi,0,50) ?>...</td>
					<td>Rp <?php echo number_format($row->harga,0,'-',".") ?></td>
					<td>
						<img src="<?php echo base_url("uploads/produk/{$row->gambar}") ?>" width="50px" data-action="zoom">
					</td>
					<td><?php echo $row->created_at ?></td>
					<td class="text-center">
						<a href="<?php echo site_url() ?>admin/produk/edit?id=<?php echo $row->idproduk ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
						<a href="<?php echo site_url() ?>admin/produk/hapus?id=<?php echo $row->idproduk ?>&img=<?php echo $row->gambar ?>" onclick="return confirm('Apa Anda yakin?')"  class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>