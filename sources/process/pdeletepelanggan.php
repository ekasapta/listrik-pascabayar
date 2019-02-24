<?php 

	if(isset($_GET['NoPelanggan'])) {

		$NoPelanggan = mysqli_real_escape_string($connect, $_GET['NoPelanggan']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pelanggan WHERE NoPelanggan='$NoPelanggan'");

		if(mysqli_num_rows($selectQuery) > 0) {

			$selectQueryTagihan = mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE NoPelanggan='$NoPelanggan'");

			if(mysqli_num_rows($selectQueryTagihan) > 0) {
				return redirectWith('index.php?pages=pelanggan', [
							"name" => "failed_delete_pelanggan_tagihan",
							"message" => "Pelanggan yang anda hapus masih memiliki tagihan."
						]);
			} else {
				$deleteQuery = mysqli_query($connect, "DELETE FROM tb_pelanggan WHERE NoPelanggan='$NoPelanggan'");
				if($deleteQuery) {
					$deleteQuerySecond = mysqli_query($connect, "DELETE FROM tb_login WHERE Username='$NoPelanggan'");
					if($deleteQuerySecond) {
						return redirectWith('index.php?pages=pelanggan', [
							"name" => "success_delete_pelanggan",
							"message" => "Pelanggan Berhasil Di Hapus"
						]);
					} else {
						return redirectWith('index.php?pages=pelanggan', [
							"name" => "failed_delete_pelanggan",
							"message" => "Maaf, Mungkin terjadi kesalahan pada server."
						]);
					}				
				} else {
					return redirectWith('index.php?pages=pelanggan', [
							"name" => "failed_delete_pelanggan",
							"message" => "Maaf, Mungkin terjadi kesalahan pada server."
						]);		
				}
			}			

		} else {
			echo "Kode Tarif Tidak Ditemukan";
		}

	} else {
		echo "404 Not Found";
	}