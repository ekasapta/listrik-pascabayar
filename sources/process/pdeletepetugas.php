<?php 

	if(isset($_GET['KodeLogin'])) {

		$KodeLogin = mysqli_real_escape_string($connect, $_GET['KodeLogin']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_login WHERE KodeLogin='$KodeLogin'");

		if(mysqli_num_rows($selectQuery) > 0) {

			$deleteQuery = mysqli_query($connect, "DELETE FROM tb_login WHERE KodeLogin='$KodeLogin'");
			if($deleteQuery) {
				return redirectWith('index.php?pages=petugas', [
						"name" => "success_delete_petugas",
						"message" => "Petugas/Admin berhasil di hapus."
					]);
			} else {
				return redirectWith('index.php?pages=petugas', [
						"name" => "failed_delete_petugas",
						"message" => "Maaf, mungkin terjadi kesalahan pada server. silahkan hubungi web administrator."
					]);		
			}

		} else {
			echo "Kode Tarif Tidak Ditemukan";
		}

	} else {
		echo "404 Not Found";
	}