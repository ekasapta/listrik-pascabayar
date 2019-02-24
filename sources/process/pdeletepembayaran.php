<?php 

	if(isset($_GET['KodePembayaran'])) {

		$KodePembayaran = mysqli_real_escape_string($connect, $_GET['KodePembayaran']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pembayaran WHERE KodePembayaran='$KodePembayaran'");

		if(mysqli_num_rows($selectQuery) > 0) {

			$deleteQuery = mysqli_query($connect, "DELETE FROM tb_pembayaran WHERE KodePembayaran='$KodePembayaran'");
			if($deleteQuery) {
				return redirectWith('index.php?pages=pembayaran', [
						"name" => "success_delete_pembayaran",
						"message" => "Pembayaran berhasil di hapus."
					]);
			} else {
				return redirectWith('index.php?pages=pembayaran', [
						"name" => "failed_delete_pembayaran",
						"message" => "Maaf, mungkin terjadi kesalahan pada server, silahkan hubungin web administrator."
					]);		
			}

		} else {
			echo "Kode Tarif Tidak Ditemukan";
		}

	} else {
		echo "404 Not Found";
	}