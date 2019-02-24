<?php 
	
	$title = "Pilih Pelanggan";
	require_once "sources/maintemplate/header.php";

	$selectPlg = mysqli_query($connect, "SELECT * FROM tb_pelanggan INNER JOIN tb_tarif USING(KodeTarif) ORDER BY KodePelanggan DESC");

	if(mysqli_num_rows($selectPlg) > 0) {
?>
<legend>Pilih Pelanggan</legend>
<table style="border-collapse: collapse;" border="1">
	<tr>
		<th>No</th>
		<th>No Pelanggan</th>
		<th>No Meter</th>
		<th>Daya / Tarif</th>
		<th>Nama Lengkap</th>
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
		<td>
			<?php 
				if(strlen($row['NamaLengkap']) > 22) {
					echo substr($row['NamaLengkap'], 0, 18)."...";
				} else {
					echo $row['NamaLengkap'];
				}
			?>		
		</td>
		<td><a href="index.php?pages=inputtagihan&NoPelanggan=<?php echo $row['NoPelanggan']; ?>">Buat Tagihan</a></td>
	</tr>
	<?php
			$No++;
		}
	?>
</table>
<?php
	} else {
		echo "Data Tarif Tidak ada";
	}
	require_once "sources/maintemplate/footer.php";