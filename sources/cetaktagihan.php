<?php 

	if(isset($_GET['NoPelanggan']) && isset($_GET['NoTagihan'])) {
		$NoPelanggan 	= mysqli_real_escape_string($connect, $_GET['NoPelanggan']);
		$NoTagihan		= mysqli_real_escape_string($connect, $_GET['NoTagihan']);
		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tagihan INNER JOIN tb_pelanggan USING(NoPelanggan) WHERE NoPelanggan='$NoPelanggan' AND NoTagihan='$NoTagihan'");
		if(mysqli_num_rows($selectQuery) > 0) {
			$row = mysqli_fetch_assoc($selectQuery);

			if($row['Status'] == 0) {
				require_once "sources/invoice/belumbayar.php";
			} else if($row['Status'] == 1) {
				require_once "sources/invoice/konfirmasi.php";
			} else if($row['Status'] == 2) {
				require_once "sources/invoice/lunas.php";
			} else {
				echo "Status Tidak Ditemukan";
			}

		} else {
			echo "Tidak Ditemukan";
		}
	}