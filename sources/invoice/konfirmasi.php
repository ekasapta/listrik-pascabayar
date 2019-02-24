<!DOCTYPE html>
<html>
<head>
	<title>PT PLN &middot; Invoice - <?php echo $row['NoTagihan']; ?></title>
	<style type="text/css">
		* {
			margin:0;
		}
		tr > th, .content > td {
			border: 1px solid #eee;	
			text-align: center;			
		}
		table {
			border-collapse: collapse;
		}
	</style>
</head>
<body style="font-family: sans-serif;">
	<div style="background-color: #fafafa;padding: 20px;width:80%">
		<table>
		<tr>
			<td colspan="7" style="text-align: right;font-size:14px;"><span style="cursor:pointer;" onclick="window.print();">Cetak Tagihan</span></td>
		</tr>
		<tr>
			<td colspan="4">
				<h2 style="margin-bottom:30px;">PT. PLN Distribusi Bali</h2>
				<tr>
					<td style="font-weight: bold;font-size:14px;">Alamat</td>
					<td colspan="3">Jln. Tukad Citarum No.127</td>			
					<td></td>
					<td style="font-weight: bold;font-size:14px;">Kepada</td>
					<td colspan="4"><?php echo $row['NamaLengkap']; ?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;font-size:14px;">Telepon</td>
					<td colspan="3">(0361) 220539</td>			
					<td></td>
					<td style="font-weight: bold;font-size:14px;">Bulan Tagih</td>
					<td colspan="4">
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
				</tr>
				<tr>
					<td style="font-weight: bold;font-size:14px;">Email</td>
					<td colspan="3">support@pln.co.id</td>			
					<td></td>
					<td style="font-weight: bold;font-size:14px;">Tahun Tagih</td>
					<td colspan="4"><?php echo $row['TahunTagih']; ?></td>
				</tr>
			</td>
		</tr>	
		<tr>
			<td colspan="7" style="padding:20px;"></td>
		</tr>	
		<tr style="background-color: #fff;">
			<th>No Tagihan</th>
			<th>No Pelanggan</th>
			<th>Tahun Tagih</th>
			<th>Bulan Tagih</th>
			<th>Jumlah Pemakaian</th>
			<th>Total Bayar</th>
			<th>Status</th>
		</tr>
		<tr class="content" style="background-color: #fff;">
			<td><?php echo $row['NoTagihan']; ?></td>
			<td><?php echo $row['NoPelanggan']; ?></td>
			<td><?php echo $row['TahunTagih']; ?></td>
			<td><?php echo $bulan[$row['BulanTagih']]; ?></td>
			<td><?php echo $row['JumlahPemakaian']; ?></td>
			<td><?php echo "Rp ".number_format($row['TotalBayar'], 0, '','.'); ?></td>
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
		</tr>
		<tr>
			<td colspan="7" style="padding:20px;"></td>
		</tr>
		<tr>
			<td colspan="7" style="padding:20px 0;">
				Terima kasih telah melakukan pembayaran, pembayaran sedang diverifikasi oleh petugas.
			</td>
		</tr>	
		<tr>
			<td colspan="6"></td>
			<td>
				Denpasar, <?php echo date('d-m-Y'); ?>.
				<br>
				<br>
				<br>
				<br>
				<br>
				Petugas.
			</td>
		</tr>
	</table>
	</div>	
	<small>
		<?php 
			if($data['Level'] == "Admin") {
				echo '<a href="index.php?pages=home-admin">Kembali</a>';
			} else if($data['Level'] == "Petugas") {
				echo '<a href="index.php?pages=home-petugas">Kembali</a>';
			} else {
				echo '<a href="index.php?pages=home-pelanggan">Kembali</a>';
			}
		?>	
	</small>
</body>
</html>