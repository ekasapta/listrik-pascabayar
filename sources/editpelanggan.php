<?php 
	
	$title = "Edit Pelanggan";
	require_once "sources/maintemplate/header.php";

	if(isset($_GET['NoPelanggan'])) {	
	$NoPelanggan = mysqli_real_escape_string($connect, $_GET['NoPelanggan']);

	$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pelanggan WHERE NoPelanggan='$NoPelanggan'");

		if(mysqli_num_rows($selectQuery) > 0) {
			$plg = mysqli_fetch_assoc($selectQuery);
?>
<legend>Edit Pelanggan</legend>
<?php 
	if(checkSession("success_edit_pelanggan")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_edit_pelanggan"); ?>
	</div>
	<?php		
		removeSession('success_edit_pelanggan');
	}

	if(checkSession("failed_edit_pelanggan")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_edit_pelanggan"); ?>
	</div>
	<?php		
		removeSession('failed_edit_pelanggan');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=editpelanggan" method="POST" class="form-block">
			<div class="form-group">
				<label for="NoPelanggan">No Pelanggan</label>
				<input type="text" class="input" name="NoPelanggan" value="<?php echo $NoPelanggan; ?>" id="NoPelanggan" readonly>
			</div>
			<div class="form-group">
				<label for="NoMeter">No Meter</label>
				<input type="text" class="input" id="NoMeter" name="NoMeter"value="<?php echo $plg['NoMeter']; ?>">
			</div>
			<div class="form-group">
				<label for="KodeTarif">Daya / Tarif Per Kwh</label>
				<select name="KodeTarif" class="input" id="KodeTarif">
					<option value="">Pilih Tarif</option>
					<?php 
					//Select Tarif
					$selectQueryTarif = mysqli_query($connect, "SELECT * FROM tb_tarif ORDER BY KodeTarif DESC");
					if(mysqli_num_rows($selectQueryTarif) > 0) {
						while($tarif = mysqli_fetch_assoc($selectQueryTarif)) {
							if($plg['KodeTarif'] == $tarif['KodeTarif']) {
								echo '<option value="'.$tarif['KodeTarif'].'" selected>'.$tarif['Daya'].' Watt / Rp '.number_format($tarif['TarifPerKwh'], 0, '', '.').'</option>';
							} else {
								echo '<option value="'.$tarif['KodeTarif'].'">'.$tarif['Daya'].' Watt / Rp '.number_format($tarif['TarifPerKwh'], 0, '', '.').'</option>';
							}
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="NamaLengkap">Nama Lengkap</label>
				<input type="text" class="input" id="NamaLengkap" name="NamaLengkap" value="<?php echo $plg['NamaLengkap']; ?>">
			</div>
			<div class="form-group">
				<label for="Telp">Telp</label>
				<input type="text" class="input" id="Telp" name="Telp" value="<?php echo $plg['Telp']; ?>">
			</div>
			<div class="form-group">
				<label for="Alamat">Alamat</label>
				<textarea name="Alamat" id="Alamat" class="input" cols="30" rows="2"><?php echo $plg['Alamat']; ?></textarea>			
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Edit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
	</div>
</div>
<?php
		} else {
			echo "No Pelanggan Tidak Ditemukan";
		}
	} else {
		echo "File Not Found";
	}
	require_once "sources/maintemplate/footer.php";
?>