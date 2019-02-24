<?php 

	if($_SERVER['REQUEST_METHOD'] === "POST") {

		$NoPelanggan 		= mysqli_real_escape_string($connect, $_POST['NoPelanggan']);
		$TahunTagih			= mysqli_real_escape_string($connect, $_POST['TahunTagih']);
		$BulanTagih			= mysqli_real_escape_string($connect, $_POST['BulanTagih']);
		$JumlahPemakaian	= mysqli_real_escape_string($connect, $_POST['JumlahPemakaian']);		

		$selectQuery		= mysqli_query($connect, "SELECT * FROM tb_tagihan ORDER BY KodeTagihan DESC LIMIT 1");

		if(mysqli_num_rows($selectQuery) > 0) {
			// KALAU DI TAGIHAN ADA DATA
			$kt 			= mysqli_fetch_assoc($selectQuery);
			$NoTagihan 		= explode('TGH', $kt['NoTagihan'])[1] + 1;
			$NoTagihan		= "TGH".$NoTagihan;
			
			//GET DATA PELANGGAN 
			$selectQuery 	= mysqli_query($connect, "SELECT * FROM tb_pelanggan INNER JOIN tb_tarif USING (KodeTarif) WHERE NoPelanggan='$NoPelanggan'");

			$data = mysqli_fetch_assoc($selectQuery);
			
			$TotalBayar 	= ($JumlahPemakaian * $data['TarifPerKwh']) + $data['Beban'];

			//SELECT SAMA BULAN DAN TAHUN DAN NOPELANGGAN
			$selectQueryTagihanFirst = mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE TahunTagih='$TahunTagih' AND BulanTagih='$BulanTagih' AND NoPelanggan='$NoPelanggan'");

			if(mysqli_num_rows($selectQueryTagihanFirst) > 0) {
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

				return redirectWith('index.php?pages=inputtagihan&NoPelanggan='.$NoPelanggan, [
							"name" => "failed_input_tagihan_same",
							"message" => "Tagihan dengan No Pelanggan <em><b>".$NoPelanggan."</b></em> di Bulan <em><b>".$bulan[$BulanTagih]."</b></em> sudah diterbitkan sebelumnya."
						]);
			} else {
				$insertQuery	= mysqli_query($connect, "INSERT INTO tb_tagihan VALUES('','$NoTagihan','$NoPelanggan','$TahunTagih','$BulanTagih','$JumlahPemakaian','$TotalBayar','0')");

				if($insertQuery) {
					return redirectWith('index.php?pages=inputtagihan&NoPelanggan='.$NoPelanggan, [
							"name" => "success_input_tagihan",
							"message" => "Tagihan Berhasil diterbitkan."
						]);
				} else {
					return redirectWith('index.php?pages=inputtagihan&NoPelanggan='.$NoPelanggan, [
							"name" => "failed_input_tagihan",
							"message" => "Maaf, gagal input tagihan, mungkin terjadi kesalahan pada server. silahkan hubungi web administrator."
						]);
				}
			}			
		} else {
			// KALAU DI TAGIHAN TIDAK ADA DATA

			$NoTagihan		= "TGH100000000";

			$selectQuery 	= mysqli_query($connect, "SELECT * FROM tb_pelanggan INNER JOIN tb_tarif USING (KodeTarif) WHERE NoPelanggan='$NoPelanggan'");

			$data = mysqli_fetch_assoc($selectQuery);
			

			$TotalBayar 	= ($JumlahPemakaian * $data['TarifPerKwh']) + $data['Beban'];

			$insertQuery	= mysqli_query($connect, "INSERT INTO tb_tagihan VALUES('','$NoTagihan','$NoPelanggan','$TahunTagih','$BulanTagih','$JumlahPemakaian','$TotalBayar','0')");

			if($insertQuery) {
				echo "Berhasil 1";
			} else {
				echo "Gagal 1";
			}
		}

	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}