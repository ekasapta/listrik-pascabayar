<?php 

	$Username = mysqli_real_escape_string($connect, $_POST['Username']);
	$Password = mysqli_real_escape_string($connect, $_POST['Password']);

	$SelectQuery = mysqli_query($connect, "SELECT * FROM tb_login WHERE BINARY Username='$Username' AND BINARY Password='$Password'");
	if(mysqli_num_rows($SelectQuery) > 0) {
		$login = mysqli_fetch_assoc($SelectQuery);

		$_SESSION['Username'] = $login['Username'];
		if($login['Level'] == "Admin") {
			echo "<script>location.href='index.php?pages=home-admin';</script>";
		} else if($login['Level'] == "Petugas") {
			echo "<script>location.href='index.php?pages=home-petugas';</script>";
		} else {
			echo "<script>location.href='index.php?pages=home-pelanggan';</script>";
		}
	} else {
		echo "Username / Password yang anda masukan salah";
	}