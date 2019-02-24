<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title) ? "PT PLN &middot; ".$title: 'Halaman Baru'; ?></title>

	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
	<div class="navbar">
		<div class="pull-right">
			<li class="loggedAs">Halo, <?php echo $data['NamaLengkap']; ?></li>
			<li><a href="index.php?process=logout">Logout</a></li>
		</div>
	</div>
	<div class="sidebar">
		<li class="brand">
			<?php 
				if($data['Level'] == "Pelanggan") {
					echo '<a href="index.php?pages=home-pelanggan">PT PLN</a>';
				} else if($data['Level'] == "Petugas") {
					echo '<a href="index.php?pages=home-petugas">PT PLN</a>';
				} else {
					echo '<a href="index.php?pages=home-admin">PT PLN</a>';
				}
			?>			
		</li>
		<?php 
			if($data['Level'] == "Pelanggan" || $data['Level'] == "Petugas") {
		?>
		<li><a href="index.php?pages=tagihan" <?php echo $_GET['pages'] == "tagihan" ? 'class="active"': ''; ?>>Tagihan</a></li>
		<li><a href="index.php?pages=pembayaran" <?php echo $_GET['pages'] == "pembayaran" ? 'class="active"': ''; ?>>Pembayaran</a></li>
		<?php	
			} else {
		?>
		<li><a href="index.php?pages=tarif" <?php echo $_GET['pages'] == "tarif" ? 'class="active"': ''; ?>>Tarif</a></li>
		<li><a href="index.php?pages=pelanggan" <?php echo $_GET['pages'] == "pelanggan" ? 'class="active"': ''; ?>>Pelanggan</a></li>
		<li><a href="index.php?pages=petugas" <?php echo $_GET['pages'] == "petugas" ? 'class="active"': ''; ?>>Petugas</a></li>
		<li><a href="index.php?pages=tagihan" <?php echo $_GET['pages'] == "tagihan" ? 'class="active"': ''; ?>>Tagihan</a></li>
		<li><a href="index.php?pages=pembayaran" <?php echo $_GET['pages'] == "pembayaran" ? 'class="active"': ''; ?>>Pembayaran</a></li>
		<?php
			}
		?>
	</div>

	<div class="content">
		
		
	