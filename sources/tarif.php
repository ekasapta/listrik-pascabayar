<?php 
	
	$title = "Halaman Tarif";
	require_once "sources/maintemplate/header.php";

	$selectTarif = mysqli_query($connect, "SELECT * FROM tb_tarif ORDER BY KodeTarif DESC");

	if(mysqli_num_rows($selectTarif) > 0) {
?>
<legend>Daftar Tarif</legend>
<?php 
	if(checkSession("success_delete_tarif")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_delete_tarif"); ?>
	</div>
	<?php		
		removeSession('success_delete_tarif');
	}

	if(checkSession("failed_delete_tarif")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_delete_tarif"); ?>
	</div>
	<?php		
		removeSession('failed_delete_tarif');
	}
?>

<?php 
	if(checkSession("success_add_tarif")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_add_tarif"); ?>
	</div>
	<?php		
		removeSession('success_add_tarif');
	}

	if(checkSession("failed_add_tarif")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_add_tarif"); ?>
	</div>
	<?php		
		removeSession('failed_add_tarif');
	}
?>
<table>
	<tr>
		<th>No</th>
		<th>Daya</th>
		<th>Tarif Per Kwh</th>
		<th>Beban</th>
		<th>Aksi</th>
	</tr>
	<?php
		$No = 1;
		while($tarif = mysqli_fetch_assoc($selectTarif)) {
			$msg = "Apakah anda yakin ingin menghapus tarif dengan Daya ".$tarif['Daya']." Watt / Rp ".number_format($tarif['TarifPerKwh'], 0, '', '.');
	?>
	<tr>
		<td><?php echo $No; ?></td>
		<td><?php echo $tarif['Daya']; ?> Watt</td>
		<td><?php echo "Rp ".number_format($tarif['TarifPerKwh'], 0, '', '.'); ?></td>
		<td><?php echo "Rp ".number_format($tarif['Beban'], 0, '', '.'); ?></td>
		<td><a href="index.php?pages=edittarif&KodeTarif=<?php echo $tarif['KodeTarif']; ?>">Edit</a> / <a href="index.php?process=deletetarif&KodeTarif=<?php echo $tarif['KodeTarif']; ?>" onclick="return deleteAlert('<?php echo $msg; ?>')">Delete</a></td>
	</tr>
	<?php
			$No++;
		}
	?>
</table>
<a href="index.php?pages=inputtarif" class="button-group">
	<button type="button" class="btn btn-success">Tambah Data</button>
</a>
<?php
	} else {
		echo "Data Tarif Tidak ada";
	}

	require_once "sources/maintemplate/footer.php";