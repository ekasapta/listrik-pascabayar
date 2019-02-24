<?php 
	
	$title = "Daftar Pembayaran";
	require_once "sources/maintemplate/header.php";

	if($data['Level'] == "Pelanggan") {
		$Username = $data['Username'];
		$selectTarif = mysqli_query($connect, "SELECT * FROM tb_pembayaran INNER JOIN tb_tagihan USING(KodeTagihan) WHERE NoPelanggan = '$Username' ORDER BY KodePembayaran DESC");
	} else {
		$selectTarif = mysqli_query($connect, "SELECT * FROM tb_pembayaran INNER JOIN tb_tagihan USING(KodeTagihan) ORDER BY KodePembayaran DESC");
	}	
?>
<legend>Daftar Pembayaran</legend>
<?php
	if(mysqli_num_rows($selectTarif) > 0) {
?>
<?php 
	if(checkSession("success_delete_pembayaran")) {
	?>
	<div class="alert alert-success" stlye="margin-top: 75px;">
		<?php echo getSession("success_delete_pembayaran"); ?>
	</div>
	<?php		
		removeSession('success_delete_pembayaran');
	}

	if(checkSession("success_konfirmasi_tagihan")) {
	?>
	<div class="alert alert-success" stlye="margin-top: 75px;">
		<?php echo getSession("success_konfirmasi_tagihan"); ?>
	</div>
	<?php		
		removeSession('success_konfirmasi_tagihan');
	}
	
	if(checkSession("failed_delete_pembayaran")) {
	?>
	<div class="alert alert-danger" stlye="margin-top: 75px;">
		<?php echo getSession("failed_delete_pembayaran"); ?>
	</div>
	<?php		
		removeSession('failed_delete_pembayaran');
	}
?>
<table style="border-collapse: collapse;" border="1">
	<tr>
		<th>No</th>
		<th>No Tagihan</th>
		<th>Tanggal Bayar</th>
		<th>Jumlah Tagihan</th>
		<th>Status</th>
		<th>Aksi</th>
	</tr>
	<?php
		$No = 1;
		while($pmb = mysqli_fetch_assoc($selectTarif)) {
			$msg = "Apakah anda yakin ingin menghapus Pembayaran dengan No Tagihan ".$pmb['NoTagihan'];
	?>
	<tr>
		<td><?php echo $No; ?></td>
		<td><?php echo $pmb['NoTagihan']; ?></td>
		<td><?php echo date('d/m/Y', strtotime($pmb['TglBayar'])); ?></td>
		<td><?php echo "Rp ".number_format($pmb['JumlahTagihan'], 0, '', '.'); ?></td>
		<td>
			<?php 
				if($pmb['Status'] == 0) {
					echo "Menunggu Pembayaran";
				} else if($pmb['Status'] == 1) {
					echo "Menunggu Konfirmasi";
				} else {
					echo "Lunas";
				}
			?>
		</td>
		<td>			
			<?php 
				if($data['Level'] == "Pelanggan") {
			?>
				<?php 
					if($pmb['NoPelanggan'] == $data['Username']) {
				?>
				<a href="index.php?pages=detailpembayaran&KodePembayaran=<?php echo $pmb['KodePembayaran']; ?>">Detail</a>
				<?php
					}
				?>
			<!-- <a href="index.php?pages=inputpembayaran&KodePembayaran=<?php echo $pmb['KodePembayaran']; ?>">Konfirmasi Pembayaran</a> -->
			<?php
				} else {
			?>
			<a href="index.php?pages=detailpembayaran&KodePembayaran=<?php echo $pmb['KodePembayaran']; ?>">Detail</a> /
			<!-- <a href="index.php?pages=editpembayaran&KodePembayaran=<?php echo $pmb['KodePembayaran']; ?>" style="color:#777">Edit</a> --> <a href="index.php?process=deletepembayaran&KodePembayaran=<?php echo $pmb['KodePembayaran']; ?>" onclick="return deleteAlert('<?php echo $msg; ?>')">Delete</a>
			<?php
				}
			?>			
		</td>
	</tr>
	<?php
			$No++;
		}
	?>
</table>
<?php
	} else {
		echo "<div style='text-align:center;'>Data Pembayaran Tidak ada</div>";
	}
	require_once "sources/maintemplate/footer.php";