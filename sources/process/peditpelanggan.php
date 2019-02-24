<?php 

	if($_SERVER['REQUEST_METHOD'] === "POST") {

		$NoPelanggan 	= mysqli_real_escape_string($connect, $_POST['NoPelanggan']);
		$NoMeter		= mysqli_real_escape_string($connect, $_POST['NoMeter']);
		$KodeTarif		= mysqli_real_escape_string($connect, $_POST['KodeTarif']);
		$NamaLengkap	= mysqli_real_escape_string($connect, $_POST['NamaLengkap']);
		$Telp			= mysqli_real_escape_string($connect, $_POST['Telp']);
		$Alamat			= mysqli_real_escape_string($connect, $_POST['Alamat']);

		$selectQuery	= mysqli_query($connect, "SELECT * FROM tb_pelanggan WHERE NoPelanggan='$NoPelanggan'");

		if(mysqli_num_rows($selectQuery) > 0) {
			$updateQuery 	= mysqli_query($connect, "UPDATE tb_login SET NamaLengkap='$NamaLengkap' WHERE Username='$NoPelanggan'");
		
			if($updateQuery) {
				$updateQuerySecond = mysqli_query($connect, "UPDATE tb_pelanggan SET NoMeter='$NoMeter', KodeTarif='$KodeTarif', NamaLengkap='$NamaLengkap', Telp='$Telp', Alamat='$Alamat' WHERE NoPelanggan='$NoPelanggan'");
				if($updateQuerySecond) {
					return redirectWith('index.php?pages=editpelanggan&NoPelanggan='.$NoPelanggan, [
							"name" => "success_edit_pelanggan",
							"message" => "Pelanggan Berhasil Di Edit."
						]);
				} else {
					return redirectWith('index.php?pages=editpelanggan&NoPelanggan='.$NoPelanggan, [
							"name" => "failed_edit_pelanggan",
							"message" => "Maaf, mungkin terjadi kesalahan pada server, silahkan kontak ke web administrator."
						]);
				}
			} else {
				return redirectWith('index.php?pages=editpelanggan&NoPelanggan='.$NoPelanggan, [
							"name" => "failed_edit_pelanggan",
							"message" => "Maaf, mungkin terjadi kesalahan pada server, silahkan kontak ke web administrator."
						]);
			}

		} else {

		}

	} else {
		echo "Request Method <em>GET</em> Not Allowed";
	}