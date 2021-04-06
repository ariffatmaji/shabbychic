<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Alamat </title>
  	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
</head>
<body onload="window.print()">
	<div class="container">
		<div class="jumbotron">
			<p><b><?php echo ucwords($data->atas_nama) ?></b> <br>
			<?php echo $data->phone ?> <br>
			<?php echo $data->alamat ?></p>
		</div>
		
	</div>
</body>
</html>