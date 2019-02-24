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
	$selectTagihan = mysqli_query($connect, "SELECT * FROM tb_tagihan ORDER BY KodeTagihan DESC");
	if(mysqli_num_rows($selectTagihan) > 0) {
?>
<legend>Quick view tagihan</legend>
<table style="border-collapse: collapse;" border="1">
	<tr>
		<th>No</th>
		<th>No Tagihan</th>
		<th>Tahun Tagih</th>
		<th>Bulan Tagih</th>
		<th>Jumlah Pemakaian</th>
		<th>Total Bayar</th>
		<th>Status</th>
		<th>Aksi</th>
	</tr>
	<?php
		$No = 1;
		while($row = mysqli_fetch_assoc($selectTagihan)) {
			$msg = "Apakah anda yakin ingin menghapus No Tagihan ".$row['NoTagihan'];
	?>
	<tr>
		<td><?php echo $No; ?></td>
		<td><?php echo $row['NoTagihan']; ?></td>
		<td><?php echo $row['TahunTagih']; ?></td>
		<td>
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

				echo $bulan[$row['BulanTagih']];
			?>
		</td>
		<td><?php echo $row['JumlahPemakaian']; ?></td>
		<td><?php echo "Rp ".number_format($row['TotalBayar'], 0, '', '.'); ?></td>
		<td>
			<?php 
				if($row['Status'] == 0) {
					echo "Menunggu Pembayaran";
				} else if($row['Status'] == 1) {
					echo "Menunggu Konfirmasi";
				} else {
					echo "Lunas";
				}
			?>
		</td>
		<td>			
			<a href="index.php?pages=cetaktagihan&amp;NoPelanggan=<?php echo $row['NoPelanggan']; ?>&amp;NoTagihan=<?php echo $row['NoTagihan']; ?>">Cetak</a>
			<?php 
				if($row['Status'] != 2) {

			?>	
			/ <a href="index.php?pages=inputpembayaran&KodeTagihan=<?php echo $row['KodeTagihan']; ?>" style="color: #777;">Konfirmasi Tagihan</a>		
			<?php 
				}
				if($data['Level'] == "Admin" || $data['Level'] == "Petugas") {
					if($row['Status'] != 2) {
			?>
			/ <a href="index.php?pages=edittagihan&NoTagihan=<?php echo $row['NoTagihan']; ?>" style="color: #000;">Edit</a>
			<?php 
				}
			?> / <a href="index.php?process=deletetagihan&NoTagihan=<?php echo $row['NoTagihan']; ?>" onclick="return deleteAlert('<?php echo $msg; ?>')">Delete</a>	
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
		echo "Data Tagihan Tidak ada";
	}
	require_once "sources/maintemplate/footer.php";