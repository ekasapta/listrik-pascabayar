<?php

	require_once "app/functions.php";

	$data = "";

	if(isset($_SESSION['Username'])) {
		$Username 	= mysqli_real_escape_string($connect, $_SESSION['Username']);
		$selectUser = mysqli_query($connect, "SELECT * FROM tb_login WHERE Username='$Username'");
		$data = mysqli_fetch_assoc($selectUser);
	}

	if(isset($_GET['pages'])) {

		switch ($_GET['pages']) {

			case 'home-admin':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/admin/home.php",
						"data" => $data
					]);
				break;

			case 'home-petugas':
					return middleware("isLoggedInPetugas", [
						"file" => "sources/petugas/home.php",
						"data" => $data
					]);
				break;

			case 'home-pelanggan':
					return middleware("isLoggedInPelanggan", [
						"file" => "sources/pelanggan/home.php",
						"data" => $data
					]);
				break;

			case 'login':
					return middleware("haveSession", [
						"file" => "sources/login.php",
						"data" => $data
					]);
				break;

			// ROUTE PELANGGAN

			case 'pelanggan':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/pelanggan.php",
						"data" => $data
					]);
				break;

			case 'editpelanggan':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/editpelanggan.php",
						"data" => $data
					]);
				break;

			case 'inputpelanggan':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/inputpelanggan.php",
						"data" => $data
					]);
				break;

			case 'cetaktagihan':
					return middleware("isLoggedIn", [
						"file" => "sources/cetaktagihan.php",
						"data" => $data
					]);
				break;

			// END ROUTE

			// ROUTE TARIF

			case 'tarif':
				return middleware("isLoggedInAdmin", [
						"file" => "sources/tarif.php",
						"data" => $data
					]);
				break;

			case 'inputtarif':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/inputtarif.php",
						"data" => $data
					]);
				break;

			case 'edittarif':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/edittarif.php",
						"data" => $data
					]);
				break;

			// END ROUTE

			// ROUTE PETUGAS

			case 'petugas':
				return middleware("isLoggedInAdmin", [
						"file" => "sources/petugas.php",
						"data" => $data
					]);
				break;

			case 'inputpetugas':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/inputpetugas.php",
						"data" => $data
					]);
				break;

			case 'editpetugas':
					return middleware("isLoggedInAdmin", [
						"file" => "sources/editpetugas.php",
						"data" => $data
					]);
				break;

			// END ROUTE

			// ROUTE TAGIHAN

			case 'pilih-pelanggan':
					return middleware("isLoggedInAdminAndPetugas", [
						"file" => "sources/pilihpelanggan.php",
						"data" => $data
					]);
				break;

			case 'tagihan':
					return middleware("isLoggedIn", [
						"file" => "sources/tagihan.php",
						"data" => $data
					]);
				break;

			case 'inputtagihan':
					return middleware("isLoggedInAdminAndPetugas", [
						"file" => "sources/inputtagihan.php",
						"data" => $data
					]);
				break;

			case 'edittagihan':
					return middleware("isLoggedInAdminAndPetugas", [
						"file" => "sources/edittagihan.php",
						"data" => $data
					]);
				break;

			// END ROUTE

			// ROUTE PEMBAYARAN

			case 'pembayaran':
					return middleware("isLoggedIn", [
						"file" => "sources/pembayaran.php",
						"data" => $data
					]);
				break;

			case 'inputpembayaran':
					return middleware("isLoggedIn", [
						"file" => "sources/inputpembayaran.php",
						"data" => $data
					]);
				break;

			case 'editpembayaran':
					return middleware("isLoggedIn", [
						"file" => "sources/editpembayaran.php",
						"data" => $data
					]);
				break;

			case 'detailpembayaran':
					return middleware("isLoggedIn", [
						"file" => "sources/detailpembayaran.php",
						"data" => $data
					]);
				break;

			// END ROUTE

			default:
					echo "404 Not Found!";
				break;
		}

	}

	if(isset($_GET['process'])) {
		switch ($_GET['process']) {
			case 'inputtarif':
					require_once "sources/process/pinputtarif.php";
				break;

			case 'inputpelanggan':
					require_once "sources/process/pinputpelanggan.php";
				break;

			case 'edittarif':
					require_once "sources/process/pedittarif.php";
				break;

			case 'editpelanggan':
					require_once "sources/process/peditpelanggan.php";
				break;

			case 'inputtagihan':
					require_once "sources/process/pinputtagihan.php";
			break;

			case 'edittagihan':
					require_once "sources/process/pedittagihan.php";
				break;

			case 'inputpetugas':
					require_once "sources/process/pinputpetugas.php";
				break;

			case 'editpetugas':
					require_once "sources/process/peditpetugas.php";
				break;

			case 'logout':
				require_once "sources/process/web/plogout.php";
			break;

			case 'login':
				require_once "sources/process/web/plogin.php";
			break;

			case 'inputpembayaran':
				require_once "sources/process/pinputpembayaran.php";
			break;

			case 'deletetarif':
				require_once "sources/process/pdeletetarif.php";
			break;

			case 'deletepelanggan':
				require_once "sources/process/pdeletepelanggan.php";
			break;

			case 'deletepetugas':
				require_once "sources/process/pdeletepetugas.php";
			break;

			case 'detailpembayaran':
				require_once "sources/process/pdetailpembayaran.php";
			break;

			case 'deletetagihan':
				require_once "sources/process/pdeletetagihan.php";
			break;

			case 'deletepembayaran':
				require_once "sources/process/pdeletepembayaran.php";
			break;

			default:
					echo "404 Not Found";
				break;
		}
	}

