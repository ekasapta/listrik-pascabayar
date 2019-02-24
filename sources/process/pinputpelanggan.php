<?php 

	if($_SERVER['REQUEST_METHOD'] === "POST") {

		$NoPelanggan = mysqli_real_escape_string($connect, $_POST['NoPelanggan']);
		$NoMeter		= mysqli_real_escape_string($connect, $_POST['NoMeter']);
		$KodeTarif		= mysqli_real_escape_string($connect, $_POST['KodeTarif']);
		$NamaLengkap	= mysqli_real_escape_string($connect, $_POST['NamaLengkap']);
		$Telp			= mysqli_real_escape_string($connect, $_POST['Telp']);
		$Alamat			= mysqli_real_escape_string($connect, $_POST['Alamat']);

		$insertQuery 	= mysqli_query($connect, "INSERT INTO tb_login VALUES('','$NoPelanggan','$NoPelanggan','$NamaLengkap','Pelanggan')");
		
		if($insertQuery) {
			$insertPelanggan = mysqli_query($connect, "INSERT INTO tb_pelanggan VALUES('','$NoPelanggan','$NoMeter','$KodeTarif','$NamaLengkap','$Telp','$Alamat')");
			if($insertPelanggan) {
				return redirectWith('index.php?pages=pelanggan', [
							"name" => "success_add_pelanggan",
							"message" => "Pelanggan berhasil di tambahkan."
						]);
			} else {
				return redirectWith('index.php?pages=pelanggan', [
							"name" => "failed_add_pelanggan",
							"message" => "Maaf, gagal menambahkan pelanggan. Silahkan hubungi web administrator."
						]);
			}
		} else {
			return redirectWith('index.php?pages=pelanggan', [
							"name" => "failed_add_pelanggan",
							"message" => "Maaf, gagal menambahkan pelanggan. Silahkan hubungi web administrator."
						]);
		}

	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}