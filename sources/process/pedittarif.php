<?php 
	
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$KodeTarif			= mysqli_real_escape_string($connect, $_POST['KodeTarif']);
		$Daya			= mysqli_real_escape_string($connect, $_POST['Daya']);
		$TarifPerKwh 	= mysqli_real_escape_string($connect, $_POST['TarifPerKwh']);
		$Beban		 	= mysqli_real_escape_string($connect, $_POST['Beban']);

		if(!$Daya) {
			echo "Daya Kosong";
		} else if(!$TarifPerKwh) {

		} else if(!$Beban) {

		} else {
			$selectQuery	= mysqli_query($connect, "SELECT * FROM tb_tarif WHERE KodeTarif='$KodeTarif'");
			if(mysqli_num_rows($selectQuery) > 0) {
				$updateQuery	= mysqli_query($connect, "UPDATE tb_tarif SET Daya='$Daya', TarifPerKwh='$TarifPerKwh', Beban='$Beban' WHERE KodeTarif='$KodeTarif'");

				if($updateQuery) {
					return redirectWith('index.php?pages=edittarif&KodeTarif='.$KodeTarif, [
						"name" => "success_tarif",
						"message" => "Tarif Berhasil di edit"
					]);
				} else {
					return redirectWith('index.php?pages=edittarif&KodeTarif='.$KodeTarif, [
						"name" => "failed_tarif",
						"message" => "Tarif Gagal di edit, Mungkin terjadi kesalahan pada server."
					]);
				}
			} else {

			}			
		}
	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}