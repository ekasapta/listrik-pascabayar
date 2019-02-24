<?php 
	$title = "Tambah Pelanggan Baru";
	require_once "sources/maintemplate/header.php";

	$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pelanggan ORDER BY NoPelanggan DESC");
	if(mysqli_num_rows($selectQuery) > 0) {
		$NoPLG = mysqli_fetch_assoc($selectQuery);
		$NoPelanggan = explode('PLG', $NoPLG['NoPelanggan'])[1] + 1;
	} else {
		$NoPelanggan = "PLG100000000";
	}
?>
<legend>Tambah Pelanggan Baru</legend>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=inputpelanggan" method="POST" class="form-block">
			<div class="form-group">
				<label for="NoPelanggan">No Pelanggan</label>
				<input type="text" class="input" name="NoPelanggan" value="<?php echo "PLG".$NoPelanggan; ?>" id="NoPelanggan" readonly required>
			</div>
			<div class="form-group">
				<label for="NoMeter">No Meter</label>
				<input type="text" class="input" id="NoMeter" name="NoMeter" required>
			</div>
			<div class="form-group">
				<label for="KodeTarif">Daya / Tarif Per Kwh</label>
				<select name="KodeTarif" class="input" id="KodeTarif" required>
					<option value="">Pilih Tarif</option>
					<?php 
					//Select Tarif
					$selectQueryTarif = mysqli_query($connect, "SELECT * FROM tb_tarif ORDER BY KodeTarif DESC");
					if(mysqli_num_rows($selectQueryTarif) > 0) {
						while($tarif = mysqli_fetch_assoc($selectQueryTarif)) {
							echo '<option value="'.$tarif['KodeTarif'].'">'.$tarif['Daya'].' Watt / Rp '.number_format($tarif['TarifPerKwh'], 0, '', '.').'</option>';
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="NamaLengkap">Nama Lengkap</label>
				<input type="text" class="input" id="NamaLengkap" name="NamaLengkap" required>
			</div>
			<div class="form-group">
				<label for="Telp">Telp</label>
				<input type="text" class="input" id="Telp" name="Telp" required>
			</div>
			<div class="form-group">
				<label for="Alamat">Alamat</label>
				<textarea name="Alamat" id="Alamat" class="input" cols="30" rows="2" required></textarea>			
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Tambahkan</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
	</div>
</div>