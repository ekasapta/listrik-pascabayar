<?php 
	
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$Username		= mysqli_real_escape_string($connect, $_POST['Username']);
		$Password 		= mysqli_real_escape_string($connect, $_POST['Password']);
		$NamaLengkap	= mysqli_real_escape_string($connect, $_POST['NamaLengkap']);
		$Level	= mysqli_real_escape_string($connect, $_POST['Level']);

		if(!$Username) {
			echo "Daya Kosong";
		} else if(!$Password) {

		} else if(!$NamaLengkap) {

		} else if(!$Level) {

		} else {

			$selectQuery	= mysqli_query($connect, "SELECT * FROM tb_login WHERE Username='$Username'");

			if(mysqli_num_rows($selectQuery) > 0) {
				return redirectWith('index.php?pages=inputpetugas', [
						"name" => "username_already_claimed",
						"message" => "Username sudah terdaftar."
					]);
			} else {
				$insertQuery	= mysqli_query($connect, "INSERT INTO tb_login VALUES('','$Username','$Password','$NamaLengkap','$Level')");

				if($insertQuery) {
					return redirectWith('index.php?pages=inputpetugas', [
						"name" => "success_add_petugas",
						"message" => "Petugas Berhasil Ditambahkan."
					]);
				} else {
					return redirectWith('index.php?pages=inputpetugas', [
						"name" => "failed_add_petugas",
						"message" => "Maaf, gagal tambah petugas, mungkin terjadi kesalahan pada server. silahkan hubungi web administrator."
					]);
				}
			}			
		}
	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}