<?php 
	
	if(isset($_GET['KodeTagihan'])) {
		$KodeTagihan = $_GET['KodeTagihan'];
		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE KodeTagihan='$KodeTagihan'");
		if(mysqli_num_rows($selectQuery) > 0) {

		$pmb = mysqli_fetch_assoc($selectQuery);

		if($data['Level'] == "Pelanggan") {
			$title = "Konfirmasi Pembayaran";
		} else {
			$title = "Input Pembayaran";
		}

		require_once "sources/maintemplate/header.php";

?>

<?php 
	if($data['Level'] == "Pelanggan") {
		echo '<legend>Konfirmasi Pembayaran</legend>';
	} else {
		echo '<legend>Input Pembayaran</legend>';
	}
?>
<?php 
	if(checkSession("imagetype_upload")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("imagetype_upload"); ?>
	</div>
	<?php		
		removeSession('imagetype_upload');
	}

	if(checkSession("maxsize_upload")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("maxsize_upload"); ?>
	</div>
	<?php		
		removeSession('maxsize_upload');
	}

	if(checkSession("failed_konfirmasi_tagihan")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_konfirmasi_tagihan"); ?>
	</div>
	<?php		
		removeSession('failed_konfirmasi_tagihan');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=inputpembayaran" class="form-block" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="NoTagihan">No Tagihan</label>
				<input type="text" class="input" id="NoTagihan" name="NoTagihan" value="<?php echo $pmb['NoTagihan']; ?>" readonly required></input>
			</div>
			<div class="form-group">
				<label for="TanggalBayar">Tanggal Bayar</label>
				<input type="date" name="TanggalBayar" id="TanggalBayar" class="input" required></input>
			</div>	
			<div class="form-group">
				<label for="JumlahTagihan">Jumlah Tagihan</label>
				<input type="text" name="JumlahTagihan" id="JumlahTagihan" class="input" required value="<?php echo $pmb['TotalBayar']?>"></input>
			</div>	
			<div class="form-group">
				<label for="BuktiPembayaran">Bukti Pembayaran</label>
				<input type="file" name="BuktiPembayaran" id="BuktiPembayaran" class="input" required></input>
			</div>		
			<div class="form-group">
				<button type="submit" class="btn btn-success">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
	</div>
</div>
<?php 
	require_once "sources/maintemplate/footer.php";
?>

<?php

		} else {
			echo "Kode Pembayaran Tidak ditemukan";
		}
	}	
?>