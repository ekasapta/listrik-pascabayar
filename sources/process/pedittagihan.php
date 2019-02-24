<?php 

	if($_SERVER['REQUEST_METHOD'] === "POST") {

		$NoTagihan 		= mysqli_real_escape_string($connect, $_POST['NoTagihan']);
		$NoPelanggan 		= mysqli_real_escape_string($connect, $_POST['NoPelanggan']);
		$TahunTagih			= mysqli_real_escape_string($connect, $_POST['TahunTagih']);
		$BulanTagih			= mysqli_real_escape_string($connect, $_POST['BulanTagih']);
		$JumlahPemakaian	= mysqli_real_escape_string($connect, $_POST['JumlahPemakaian']);		

		$selectQuery		= mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE NoTagihan='$NoTagihan'");

		if(mysqli_num_rows($selectQuery) > 0) {
			// KALAU DI TAGIHAN ADA DATA
			
			//GET DATA PELANGGAN 
			$selectQuery 	= mysqli_query($connect, "SELECT * FROM tb_pelanggan INNER JOIN tb_tarif USING (KodeTarif) WHERE NoPelanggan='$NoPelanggan'");

			$data = mysqli_fetch_assoc($selectQuery);
			
			$TotalBayar 	= ($JumlahPemakaian * $data['TarifPerKwh']) + $data['Beban'];

			$updateQuery	= mysqli_query($connect, 
				"UPDATE tb_tagihan SET TahunTagih='$TahunTagih', 
				BulanTagih='$BulanTagih', 
				JumlahPemakaian='$JumlahPemakaian', 
				TotalBayar='$TotalBayar', Status='0'
				WHERE NoTagihan='$NoTagihan'"
			);

			if($updateQuery) {
				return redirectWith('index.php?pages=edittagihan&NoTagihan='.$NoTagihan, [
							"name" => "success_edit_tagihan",
							"message" => "Tagihan berhasil di edit."
						]);
			} else {
				return redirectWith('index.php?pages=tagihan', [
							"name" => "failed_edit_tagihan",
							"message" => "Maaf, terjadi kesalahan pada server, silahkan menghubungi web administrator."
						]);	
			}
		} else {
			// KALAU DI TAGIHAN TIDAK ADA DATA
			echo "<em>No Tagihan</em> Tidak Ditemukan";
		}

	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}