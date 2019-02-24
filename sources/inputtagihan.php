<?php 
	
	$title = "Buat Tagihan Baru";

	require_once "sources/maintemplate/header.php";

	if(isset($_GET['NoPelanggan'])) { 
		$NoPelanggan = mysqli_real_escape_string($connect, $_GET['NoPelanggan']);
		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pelanggan WHERE NoPelanggan='$NoPelanggan'");
		if(mysqli_num_rows($selectQuery) > 0) {
			$row = mysqli_fetch_assoc($selectQuery);
?>
<legend>Buat Tagihan Baru</legend>
<?php 
	if(checkSession("success_input_tagihan")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_input_tagihan"); ?>
	</div>
	<?php		
		removeSession('success_input_tagihan');
	}

	if(checkSession("failed_input_tagihan")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_input_tagihan"); ?>
	</div>
	<?php		
		removeSession('failed_input_tagihan');
	}
	if(checkSession("failed_input_tagihan_same")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_input_tagihan_same"); ?>
	</div>
	<?php		
		removeSession('failed_input_tagihan_same');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=inputtagihan" method="POST" class="form-block">
			<div class="form-group">
				<label for="NoPelanggan">NoPelanggan</label>
				<input type="text" class="input" id="NoPelanggan" name="NoPelanggan" value="<?php echo $row['NoPelanggan']; ?>" readonly required>
			</div>
			<div class="form-group">
				<label for="TahunTagih">TahunTagih</label>
				<input type="text" class="input" id="TahunTagih" name="TahunTagih" value="<?php echo date('Y'); ?>" required>
			</div>
			<div class="form-group">
				<label for="BulanTagih">BulanTagih</label>
				<select name="BulanTagih" id="BulanTagih" class="input"  required>
					<option value="">Pilih Bulan</option>
					<?php 
						$bulan = [
							1 => 'Januari',
							2 => 'Februari',
							3 => 'Maret',
							4 => 'April',
							5 => 'Mei',
							6 => 'Juni',
							7 => 'Juli',
							8 => 'Agustus',
							9 => 'September',
							10 => 'Oktober',
							11 => 'November',
							12 => 'Desember',
						];

						for ($i=1; $i <= 12; $i++) { 
							echo '<option value="'.$i.'">'.$bulan[$i].'</option>';
						}
					?>
				</select>	
			</div>
			<div class="form-group">
				<label for="JumlahPemakaian">JumlahPemakaian</label>
				<input type="text" class="input" id="JumlahPemakaian" name="JumlahPemakaian"  required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Tambahkan</button>
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

	}
	require_once "sources/maintemplate/footer.php";
?>
