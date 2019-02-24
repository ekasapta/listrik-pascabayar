<?php 
	
	$title = "Edit Tagihan";
	require_once "sources/maintemplate/header.php";

	if(isset($_GET['NoTagihan'])) { 
		$NoTagihan = mysqli_real_escape_string($connect, $_GET['NoTagihan']);
		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE NoTagihan='$NoTagihan'");
		if(mysqli_num_rows($selectQuery) > 0) {
			$row = mysqli_fetch_assoc($selectQuery);
?>
<legend>Edit Tagihan</legend>
<?php 
	if(checkSession("success_edit_tagihan")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_edit_tagihan"); ?>
	</div>
	<?php		
		removeSession('success_edit_tagihan');
	}

	if(checkSession("failed_edit_tagihan")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_edit_tagihan"); ?>
	</div>
	<?php		
		removeSession('failed_edit_tagihan');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=edittagihan" method="POST" class="form-block">
			<input type="hidden" name="NoPelanggan" value="<?php echo $row['NoPelanggan']; ?>">
			<div class="form-group">
				<label for="NoPelanggan">NoTagihan</label>
				<input type="text" class="input" id="NoTagihan" name="NoTagihan" value="<?php echo $row['NoTagihan']; ?>" readonly>
			</div>
			<div class="form-group">
				<label for="TahunTagih">TahunTagih</label>
				<input type="text" class="input" id="TahunTagih" name="TahunTagih" value="<?php echo date('Y'); ?>">
			</div>
			<div class="form-group">
				<label for="BulanTagih">BulanTagih</label>
				<select name="BulanTagih" id="BulanTagih" class="input">
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
							if($row['BulanTagih'] == $i) {
								echo '<option value="'.$i.'" selected>'.$bulan[$i].'</option>';
							} else {
								echo '<option value="'.$i.'">'.$bulan[$i].'</option>';
							}
						}
					?>
				</select>	
			</div>
			<div class="form-group">
				<label for="JumlahPemakaian">JumlahPemakaian</label>
				<input type="text" class="input" id="JumlahPemakaian" name="JumlahPemakaian" value="<?php echo $row['JumlahPemakaian']; ?>">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Edit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>	
	</div>
</div>
</form>
<?php
		} else {
			echo "No Tagihan Tidak Ditemukan";
		}
	} else {

	}
	require_once "sources/maintemplate/footer.php";
?>
