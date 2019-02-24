<?php 
	
	$title = "Daftar Pembayaran";
	require_once "sources/maintemplate/header.php";

	$KodePembayaran = mysqli_real_escape_string($connect, $_GET['KodePembayaran']);

	$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pembayaran INNER JOIN tb_tagihan USING(KodeTagihan) WHERE KodePembayaran='$KodePembayaran' ORDER BY KodePembayaran DESC");

	if(mysqli_num_rows($selectQuery) > 0) {
		$pmb = mysqli_fetch_assoc($selectQuery);
?>
<style type="text/css">
	label {
		margin-bottom:10px;
	}
</style>
<legend>Detail Pembayaran</legend>
<?php 
	if(checkSession("success_edit_detail_pembayaran")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_edit_detail_pembayaran"); ?>
	</div>
	<?php		
		removeSession('success_edit_detail_pembayaran');
	}

	if(checkSession("failed_edit_detail_pembayaran")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_edit_detail_pembayaran"); ?>
	</div>
	<?php		
		removeSession('failed_edit_detail_pembayaran');
	}

	if(checkSession("validasi_pembayaran")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("validasi_pembayaran"); ?>
	</div>
	<?php		
		removeSession('validasi_pembayaran');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=detailpembayaran&KodePembayaran=<?php echo $pmb['KodePembayaran']; ?>" class="form-block" method="POST">
			<div class="form-group">
				<label for="NoTagihan">No Tagihan</label>
				<span><?php echo $pmb['NoTagihan']; ?></span>
			</div>
			<div class="form-group">
				<label for="TanggalBayar">Tanggal Bayar</label>
				<span><?php echo date('d-m-Y', strtotime($pmb['TglBayar'])); ?></span>
			</div>	
			<div class="form-group">
				<label for="JumlahTagihan">Jumlah Tagihan</label>
				<span><?php echo "Rp ".number_format($pmb['JumlahTagihan'],0 , '','.'); ?></span>
			</div>	
			<div class="form-group">
				<label for="BuktiPembayaran">Bukti Pembayaran</label>
				<img src="assets/images/tagihan/<?php echo $pmb['BuktiPembayaran']; ?>" style="width:250px;height:300px;">
			</div>		
			<?php 
				if($data['Level'] == "Admin" || $data['Level'] == "Petugas") {	
				
					if($pmb['Status'] != "2" ) {			
			?>
			<div class="form-group">				
				<label for="SetStatus">Set Status Pembayaran</label>
				<input type="checkbox" name="Status"> Lunas
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
			<?php
					} else {
			?>
			<div class="form-group">
				<label>Status</label>
				<span>Lunas</span>
			</div>			
			<?php
					}
				} else {
					if($pmb['Status'] == 0) {
						$status = "Menunggu Pembayaran";
					} else if($pmb['Status'] == 1) {
						$status = "Menunggu Konfirmasi";
					} else {
						$status = "Lunas";
					}
			?>
			<div class="form-group">
				<label>Status</label>
				<span><?php echo $status; ?></span>
			</div>
			<?php
				}
			?>			
		</form>
	</div>
</div>
<?php
	} else {
		echo "Data Pembayaran Tidak ada";
	}
	require_once "sources/maintemplate/footer.php";