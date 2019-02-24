<?php 

	if(isset($_GET['KodeTarif'])) {

		$KodeTarif = mysqli_real_escape_string($connect, $_GET['KodeTarif']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tarif WHERE KodeTarif='$KodeTarif'");

		if(mysqli_num_rows($selectQuery) > 0) {

			$deleteQuery = mysqli_query($connect, "DELETE FROM tb_tarif WHERE KodeTarif='$KodeTarif'");
			if($deleteQuery) {
				return redirectWith('index.php?pages=tarif', [
						"name" => "success_delete_tarif",
						"message" => "Tarif berhasil di hapus."
					]);
			} else {
				return redirectWith('index.php?pages=tarif', [
						"name" => "failed_delete_tarif",
						"message" => "Maaf, anda tidak bisa menghapus tarif ini karena ada pelanggan yang menggunakan tarif ini."
					]);		
			}

		} else {
			echo "Kode Tarif Tidak Ditemukan";
		}

	} else {
		echo "404 Not Found";
	}