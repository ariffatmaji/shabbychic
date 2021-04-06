<div class="row">
	<div class="col-sm-8">
		<div class="box box-solid box-warning">
			<div class="box-header with-border">
				<div class="box-title"><i class="fa fa-shopping-bag"></i> Keranjang Anda</div>
			</div>
			<div class="box-body">
				<div class="well">
					<p><i class="fa fa-info-circle"></i> Keterangan : </p>
					<ul>
						<li>Minimal quantity 1</li>
						<li>Quantity tidak bisa melebihi stok yang tersedia</li>
						<li>Silahkan hitung ongkos kirim pada panel sebelah kanan</li>
					</ul>
				</div>
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Produk</th>
							<th>Berat</th>
							<th>Quantity</th>
							<th>Satuan</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$nomor = 1;
						$total = 0;
						$total_berat = 0 ;
						foreach ($_SESSION['order'] as $idbrg => $qty): 
							$syarat = array("idproduk"=> $idbrg);
							$produk = $this->M_produk->ambil_satu($syarat);
							$subtotal = $produk->harga*$qty;
							$total += $subtotal;

							$sub_berat = $produk->berat* $qty; // sub berat = berat x quantity
							$total_berat += $sub_berat; // total berat = sub berat +  sub berat
							?>
							<tr>
								<td><?php echo $nomor++ ?></td>
								<td>
									<?php echo $produk->namaproduk ?> 
									(<a href="<?php echo site_url() ?>cart/hapus?idproduk=<?php echo $idbrg ?>" onclick="return confirm('Apa Anda yakin?')" title="Hapus" ><i class="fa fa-trash" style="color: red"></i></a>) <br>
									<small><i>stok : <?php echo $produk->stok ?></i></small>
								</td>
								<td><?php echo $sub_berat ?>gr</td>
								<td style="width: 140px">
									<div class="input-group">
										<span class="input-group-addon">
											<a href="<?php echo site_url() ?>cart/kurangi_qty?idproduk=<?php echo $idbrg ?>"><i class="fa fa-minus"></i></a>
										</span>
										<input type="text" readonly="" class="form-control" value="<?php echo $qty ?>">
										<span class="input-group-addon">
											<a href="<?php echo site_url() ?>cart/tambah_qty?idproduk=<?php echo $idbrg ?>&stok=<?php echo $produk->stok ?>"><i class="fa fa-plus-circle"></i></a>
										</span>
									</div>
								</td>
								<td>Rp<?php echo number_format($produk->harga,0,".",".") ?></td>
								<td>Rp<?php echo number_format($subtotal,0,".",".") ?></td>
							</tr>
						<?php endforeach ?>
						<tr>
							<td colspan="4"></td>
							<td class="text-center"><b>Total</b></td>
							<td>Rp<?php echo number_format($total,0,".",".") ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer text-right">
				<a href="<?php echo site_url() ?>produk" class="btn btn-primary"><i class="fa fa-shopping-bag"></i> Lanjutkan Belanja</a>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<div class="box-title"><i class="fa fa-car"></i> Estimasi OngKir <small><i>(dari kebumen)</i></small></div>
			</div>
			<div class="box-body">
				<form id="checkout" method="post" action="<?php echo site_url('cart/checkout') ?>">
				  <div class="form-group">
				    <!-- <label for="">Provinsi tujuan :</label> -->
				    <select class="form-control" name="provinsi">
				    	<option class="hidden">- Pilih Provinsi -</option>
				    	<?php foreach ($provinsi as $prov): ?>
					    	<option value="<?php echo $prov["province_id"] ?>"><?php echo $prov["province"] ?></option>
				    	<?php endforeach ?>
				    </select>
				  </div>
				  <div class="form-group">
				  	<div class="row">
				  		<div class="col-sm-8">
						    <!-- <label for="">Kabupaten tujuan :</label> -->
						    <select class="form-control" name="kabupaten">
						    	<option class="hidden">- Pilih Kabupaten -</option>
						    </select>
				  		</div>
				  		<div class="col-sm-4">
				  			<!-- <label>Kurir :</label> -->
				  			<select class="form-control" required="" name="kurir">
				  				<option value="jne" hidden="">- Kurir -</option>
					  			<option value="jne">JNE</option>
					  			<option value="pos">POS</option>
					  			<option value="tiki">TIKI</option>
				  			</select>
				  		</div>
				  	</div>
				  </div>
				  <div class="form-group">
				  	<select class="form-control" required="" name="paket"></select>
				  	<div class="help-block"><small>Total berat produk yang Anda order <b><?php echo $total_berat/1000 ?>kg</b></small></div>
				  </div>
				</form>
			</div>
		</div>

		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<div class="box-title"><i class="fa fa-map-marker"></i> Data Penerima</div>
			</div>
			<div class="box-body">
				<form action=""  method="post">
				  <div class="form-group">
				  	<div class="row">
				  		<div class="col-sm-6">
						    <input type="text" name="penerima" class="form-control" required="" placeholder="Penerima" form="checkout">
				  		</div>
				  		<div class="col-sm-6">
						    <input type="text" name="phone" class="form-control" required="" placeholder="Nomor hp" form="checkout">
				  		</div>
				  	</div>
				  </div>
				  <div class="form-group">
				    <textarea class="form-control" form="checkout" required="" name="alamat"></textarea>
				  </div>
				  <div class="form-group text-right">
				  	<?php if (isset($_SESSION['user'])) :?>
				  		<!-- sudah login -->
						<button type="submit" class="btn btn-warning" form="checkout">Checkout</button>
			  		<?php else: ?>
			  			<!-- belum login -->
						<button onclick="alert('Anda belum Login')" type="button" class="btn btn-warning">Checkout</button>
				  	<?php endif ?>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("[name=provinsi]").change(function (e) {
		var idprov = $(this).val();
		$.LoadingOverlay("show");
		$.ajax({
			url: '<?php echo site_url('cart/ajax_getKotaRajaOngkir')  ?>',
			type: 'POST',
			data: {idprov: idprov},
			success : function (result) {
				$.LoadingOverlay("hide")
				// memasukan hasil ambil kabupaten ke form pilihan /dropdown
				$("[name=kabupaten]").html(result);
			}
		});
	})

	function hitung_ongkir() {
		
	}

	$("[name=kurir]").change(function (e) {
		$.LoadingOverlay("show");
		var idprov = $("[name=provinsi]").val(); // provinsi yg dipilih
		var idkab  = $("[name=kabupaten]").val(); // idkabupaten
		var berat  = '<?php echo $total_berat ?>'; // ambil total berat
		var kurir  = $(this).val(); // ambil kurir yg dipilih

		$.ajax({
			url: '<?php echo site_url('cart/get_biayaRajaOngkir')  ?>',
			type: 'POST',
			data: {idprov: idprov, idkab : idkab, berat : berat, kurir : kurir},
			success : function (result) {
				$.LoadingOverlay("hide");
				$("[name=paket]").html(result)
			}
		});
	})
</script>