<?php 
	
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$KodeLogin		= mysqli_real_escape_string($connect, $_POST['KodeLogin']);
		$Username		= mysqli_real_escape_string($connect, $_POST['Username']);
		$Password 		= mysqli_real_escape_string($connect, $_POST['Password']);
		$NamaLengkap	= mysqli_real_escape_string($connect, $_POST['NamaLengkap']);
		$Level		 	= mysqli_real_escape_string($connect, $_POST['Level']);

		if(!$Username) {
			echo "Daya Kosong";
		} else if(!$NamaLengkap) {

		} else if(!$Level) {

		} else {
			$selectQuery	= mysqli_query($connect, "SELECT * FROM tb_login WHERE KodeLogin='$KodeLogin'");
			if(mysqli_num_rows($selectQuery) > 0) {
				if(!$Password) {
					$updateQuery = mysqli_query($connect, "UPDATE tb_login SET Username='$Username', NamaLengkap='$NamaLengkap', Level='$Level' WHERE KodeLogin='$KodeLogin'");
				} else {
					$updateQuery = mysqli_query($connect, "UPDATE tb_login SET Username='$Username', Password='$Password', NamaLengkap='$NamaLengkap', Level='$Level' WHERE KodeLogin='$KodeLogin'");
				}				

				if($updateQuery) {
					return redirectWith('index.php?pages=editpetugas&KodeLogin='.$KodeLogin, [
						"name" => "success_edit_petugas",
						"message" => "Petugas Berhasil di edit"
					]);
				} else {
					return redirectWith('index.php?pages=editpetugas&KodeLogin='.$KodeLogin, [
						"name" => "failed_edit_petugas",
						"message" => "Maaf, gagal edit petugas, mungkin terjadi kesalahan pada server. silahkan hubungi web administrator."
					]);
				}
			} else {
				echo "404 Not Found";
			}			
		}
	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}