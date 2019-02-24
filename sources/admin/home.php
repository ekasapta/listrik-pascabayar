<?php 

	$title = "Halaman Admin";
	require_once "sources/maintemplate/header.php";

?>

<div class="information-card">
	<div class="card">
		<div class="card-body">
			<span>Total Petugas</span>
			<h1 class="count">
			<?php 
				$selectQuery = mysqli_query($connect, "SELECT * FROM tb_login WHERE Level <> 'Pelanggan'");
				if(mysqli_num_rows($selectQuery) > 0) {
					echo mysqli_num_rows($selectQuery);
				} else {
					echo "0";
				}
			?>
			</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<span>Total Pelanggan</span>
			<h1 class="count">
			<?php 
				$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pelanggan");
				if(mysqli_num_rows($selectQuery) > 0) {
					echo mysqli_num_rows($selectQuery);
				} else {
					echo "0";
				}
			?>
			</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<span>Total Transaksi</span>
			<h1 class="count">
			<?php 
				$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tagihan");
				if(mysqli_num_rows($selectQuery) > 0) {
					echo mysqli_num_rows($selectQuery);
				} else {
					echo "0";
				}
			?>
			</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<span>Total Tarif</span>
			<h1 class="count">
			<?php 
				$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tarif");
				if(mysqli_num_rows($selectQuery) > 0) {
					echo mysqli_num_rows($selectQuery);
				} else {
					echo "0";
				}
			?>
			</h1>
		</div>
	</div>
</div>

<?php 
	$selectPlg = mysqli_query($connect, "SELECT * FROM tb_pelanggan INNER JOIN tb_tarif USING(KodeTarif) ORDER BY KodePelanggan DESC");
	if(mysqli_num_rows($selectPlg) > 0) {
?>
<legend>Quick View Pelanggan</legend>
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
<?php
	} else {	
		echo "Data pelanggan Tidak ada";
	}
	require_once "sources/maintemplate/footer.php";