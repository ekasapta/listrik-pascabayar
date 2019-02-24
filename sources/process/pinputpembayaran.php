<?php 

	$NoTagihan 		= mysqli_real_escape_string($connect, $_POST['NoTagihan']);
	$TglBayar 		= mysqli_real_escape_string($connect, $_POST['TanggalBayar']);
	$JumlahTagihan 	= mysqli_real_escape_string($connect, $_POST['JumlahTagihan']);
	$BuktiPembayaran= $_FILES['BuktiPembayaran'];

	//IMAGE INFO
	$FileName 		= $BuktiPembayaran['name'];
	$TmpName 		= $BuktiPembayaran['tmp_name'];
	$FileSize 		= $BuktiPembayaran['size'];
	$FileType 		= $BuktiPembayaran['type'];

	$extension		= pathinfo($FileName, PATHINFO_EXTENSION);	

	$FileName		= $NoTagihan."_".substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8)."_".time().".".$extension;

	$destination	= "assets/images/tagihan/".$FileName;

	$selectTagihan = mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE NoTagihan='$NoTagihan'");

	$row = mysqli_fetch_assoc($selectTagihan);

	$KodeTagihan = $row['KodeTagihan'];

	if($FileSize > 1024000) {
		return redirectWith('index.php?pages=tagihan&KodeTagihan='.$KodeTagihan, [
			"name" => "maxsize_upload",
			"message" => "Maaf, foto harus dibawah atau sama dengan 1 Mb."
		]);
	} else {
		if($FileType == "image/jpeg" || $FileType == "image/jpg" || $FileType == "image/png") {

			//GET KODE TAGIHAN
			$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tagihan WHERE NoTagihan='$NoTagihan'");

			$kode = mysqli_fetch_assoc($selectQuery);

			$KodeTagihan = $kode['KodeTagihan'];

			$insertQuery = mysqli_query($connect, "INSERT INTO tb_pembayaran VALUES('','$KodeTagihan','$TglBayar','$JumlahTagihan','$FileName', '1')");

			if($insertQuery) {
				$updateTagihan = mysqli_query($connect, "UPDATE tb_tagihan SET Status='1' WHERE NoTagihan='$NoTagihan'");
				if($updateTagihan) {
					if(move_uploaded_file($TmpName, $destination)) {
						return redirectWith('index.php?pages=pembayaran', [
							"name" => "success_konfirmasi_tagihan",
							"message" => "Bukti Pembayaran Berhasil di Upload."
						]);
					} else {
						return redirectWith('index.php?pages=inputpembayaran&KodeTagihan='.$KodeTagihan, [
							"name" => "failed_konfirmasi_tagihan",
							"message" => "Maaf, terjadi kesalahan pada server, silahkan menghubungi web administrator."
						]);
					}
				} else {
					return redirectWith('index.php?pages=inputpembayaran&KodeTagihan='.$KodeTagihan, [
							"name" => "failed_konfirmasi_tagihan",
							"message" => "Maaf, terjadi kesalahan pada server, silahkan menghubungi web administrator."
						]);
				}
			} else {
				return redirectWith('index.php?pages=inputpembayaran&KodeTagihan='.$KodeTagihan, [
							"name" => "failed_konfirmasi_tagihan",
							"message" => "Maaf, terjadi kesalahan pada server, silahkan menghubungi web administrator."
						]);
			}
		} else {
			return redirectWith('index.php?pages=inputpembayaran&KodeTagihan='.$KodeTagihan, [
					"name" => "imagetype_upload",
					"message" => "File Image harus berupa .jpg, .jpeg, .png"
				]);			
		}
	}