<?php 
	
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$Daya			= mysqli_real_escape_string($connect, $_POST['Daya']);
		$TarifPerKwh 	= mysqli_real_escape_string($connect, $_POST['TarifPerKwh']);
		$Beban		 	= mysqli_real_escape_string($connect, $_POST['Beban']);

		if(!$Daya) {
			echo "Daya Kosong";
		} else if(!$TarifPerKwh) {

		} else if(!$Beban) {

		} else {
			$insertQuery	= mysqli_query($connect, "INSERT INTO tb_tarif VALUES('','$Daya','$TarifPerKwh','$Beban')");

			if($insertQuery) {
				return redirectWith('index.php?pages=tarif', [
						"name" => "success_add_tarif",
						"message" => "Tarif Berhasil ditambahkan"
					]);	
			} else {
				return redirectWith('index.php?pages=tarif', [
						"name" => "failed_add_tarif",
						"message" => "Maaf, gagal menambahkan tarif. Mungkin terjadi kesalahan pada server."
					]);	
			}
		}
	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}