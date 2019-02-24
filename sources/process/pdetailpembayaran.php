<?php 
	
	if(isset($_GET['KodePembayaran'])) {

		$KodePembayaran = mysqli_real_escape_string($connect, $_GET['KodePembayaran']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_pembayaran INNER JOIN tb_tagihan USING(KodeTagihan) WHERE KodePembayaran='$KodePembayaran'");

		if(mysqli_num_rows($selectQuery) > 0) {
			$row = mysqli_fetch_assoc($selectQuery);
			if(isset($_POST['Status'])) {
				$NoTagihan = $row['NoTagihan'];
				mysqli_query($connect, "UPDATE tb_pembayaran SET Status='2' WHERE KodePembayaran='$KodePembayaran'");
				mysqli_query($connect, "UPDATE tb_tagihan SET Status='2' WHERE NoTagihan='$NoTagihan'");
				return redirectWith('index.php?pages=detailpembayaran&KodePembayaran='.$KodePembayaran, [
							"name" => "success_edit_detail_pembayaran",
							"message" => "Pembayaran berhasil diset lunas."
						]);
			} else {
				return redirectWith('index.php?pages=detailpembayaran&KodePembayaran'.$KodePembayaran, [
							"name" => "validasi_pembayaran",
							"message" => "Checkbox belum dicentang."
						]);
			}
		} else {
			return redirectWith('index.php?pages=detailpembayaran&KodePembayaran='.$KodePembayaran, [
							"name" => "failed_edit_detail_pembayaran",
							"message" => "Maaf, gagal edit detail pembayaran. Silahkan hubungi web administrator."
						]);
		}

	} else {
		echo "404 Not Found";
	}

?>