<?php 
	
	$title = "Halaman Pelanggan";
	require_once "sources/maintemplate/header.php";

	if(isset($_GET['q'])) {
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$selectPlg = mysqli_query($connect, "SELECT * FROM tb_pelanggan INNER JOIN tb_tarif USING(KodeTarif) WHERE NoPelanggan LIKE '%$q%' OR NamaLengkap LIKE '%$q%' OR NoMeter LIKE '%$q%' ORDER BY KodePelanggan DESC");
	} else {
		$selectPlg = mysqli_query($connect, "SELECT * FROM tb_pelanggan INNER JOIN tb_tarif USING(KodeTarif) ORDER BY KodePelanggan DESC");
	}	
?>
<form action="index.php" method="GET">
	<div class="pull-right" style="margin-bottom:20px;margin-top:50px;">
		<input type="hidden" name="pages" value="pelanggan">
		<input type="text" name="q" class="input" placeholder="Cari No Pelanggan, Nama dan No Meter." style="width:300px;" <?php echo isset($_GET['q']) ? "value='".$_GET['q']."'": ''; ?>>
		<button type="submit" class="btn btn-default">Cari</button>
	</div>
</form>
<legend>Halaman Pelanggan</legend>
<?php
	if(mysqli_num_rows($selectPlg) > 0) {
?>
<?php 
	if(checkSession("success_delete_pelanggan")) {
	?>
	<div class="alert alert-success" stlye="margin-top: 75px;">
		<?php echo getSession("success_delete_pelanggan"); ?>
	</div>
	<?php		
		removeSession('success_delete_pelanggan');
	}

	if(checkSession("failed_delete_pelanggan")) {
	?>
	<div class="alert alert-danger" stlye="margin-top: 75px;">
		<?php echo getSession("failed_delete_pelanggan"); ?>
	</div>
	<?php		
		removeSession('failed_delete_pelanggan');
	}
?>
<?php
	if(checkSession("failed_delete_pelanggan_tagihan")) {
	?>
	<div class="alert alert-danger" stlye="margin-top: 75px;">
		<?php echo getSession("failed_delete_pelanggan_tagihan"); ?>
	</div>
	<?php		
		removeSession('failed_delete_pelanggan_tagihan');
	}
?>
<?php 
	if(checkSession("success_add_pelanggan")) {
	?>
	<div class="alert alert-success" stlye="margin-top: 75px;">
		<?php echo getSession("success_add_pelanggan"); ?>
	</div>
	<?php		
		removeSession('success_add_pelanggan');
	}

	if(checkSession("failed_add_pelanggan")) {
	?>
	<div class="alert alert-danger" stlye="margin-top: 75px;">
		<?php echo getSession("failed_add_pelanggan"); ?>
	</div>
	<?php		
		removeSession('failed_add_pelanggan');
	}
?>
<table style="border-collapse: collapse;margin-top:20px;" border="1">
	<tr>
		<th>No</th>
		<th>No Pelanggan</th>
		<th>No Meter</th>
		<th>Daya / Tarif</th>
		<th>Nama Lengkap</th>
		<th>Telp</th>
		<th>Alamat</th>
		<th>Aksi</th>
	</tr>
	<?php
		$No = 1;
		while($row = mysqli_fetch_assoc($selectPlg)) {
			$msg = "Apakah anda yakin ingin menghapus pelanggan dengan Nomor Pelanggan ".$row['NoPelanggan'];
	?>
	<tr>
		<td><?php echo $No; ?></td>
		<td><?php echo $row['NoPelanggan']; ?></td>
		<td><?php echo $row['NoMeter']; ?></td>
		<td><?php echo $row['Daya']." Watt / Rp ".number_format($row['TarifPerKwh'], 0, '', '.'); ?></td>
		<td><?php echo $row['NamaLengkap']; ?></td>
		<td><?php echo $row['Telp']; ?></td>
		<td><?php echo $row['Alamat']; ?></td>
		<td><a href="index.php?pages=editpelanggan&NoPelanggan=<?php echo $row['NoPelanggan']; ?>">Edit</a> / <a href="index.php?process=deletepelanggan&NoPelanggan=<?php echo $row['NoPelanggan']; ?>" onclick="return deleteAlert('<?php echo $msg; ?>')">Delete</a></td>
	</tr>
	<?php
			$No++;
		}
	?>
</table>
<a href="index.php?pages=inputpelanggan" class="button-group">
	<button type="button" class="btn btn-success">Tambah Data</button>
</a>
<?php
	} else {
		if(isset($_GET['q'])) {
			echo "<div style='margin-top:80px;text-align:center;'>Pencarian dengan kata kunci '".$_GET['q']."' tidak ditemukan.<div>";
		} else {
			echo "Data Tarif Tidak ada";
		}		
	}
	require_once "sources/maintemplate/footer.php";