<?php 

	if(isset($_GET['NoTagihan'])) {

		$NoTagihan = mysqli_real_escape_string($connect, $_GET['NoTagihan']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE NoTagihan='$NoTagihan'");

		if(mysqli_num_rows($selectQuery) > 0) {

			$row = mysqli_fetch_assoc($selectQuery);
			$KodeTagihan = $row['KodeTagihan'];

			$deleteQueryFirst = mysqli_query($connect, "SELECT * FROM tb_pembayaran WHERE KodeTagihan='$KodeTagihan'");

			if(mysqli_num_rows($deleteQueryFirst) > 0) {
				return redirectWith('index.php?pages=tagihan', [
							"name" => "have_pembayaran",
							"message" => "Anda tidak bisa menghapus tagihan ini dikarenakan masih memiliki pembayaran."
						]);
			} else {				
				$deleteQuery = mysqli_query($connect, "DELETE FROM tb_tagihan WHERE NoTagihan='$NoTagihan'");
				if($deleteQuery) {
					return redirectWith('index.php?pages=tagihan', [
							"name" => "success_delete_tagihan",
							"message" => "Tagihan berhasil di hapus."
						]);
				} else {
					return redirectWith('index.php?pages=tagihan', [
							"name" => "failed_delete_tagihan",
							"message" => "Maaf, terjadi kesalahan pada server, silahkan menghubungi web administrator."
						]);		
				}
			}			
		} else {
			echo "Kode Tarif Tidak Ditemukan";
		}

	} else {
		echo "404 Not Found";
	}