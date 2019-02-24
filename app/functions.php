<?php 
	
	require_once "connect.php";

	function dd($data) {
		var_dump($data);
		die();
	}

	function middleware($name, $options = array()) {
		global $connect;

		if($name == "isLoggedIn") {
			if(!isset($_SESSION['Username'])) {
				session_destroy();
				echo "<script>alert('You must login for access this pages'); location.href='index.php?pages=login'</script>";
			} else {
				$data = $options['data'];				
				require_once $options['file'];
			}
		} else if($name == "haveSession") {
			if(isset($_SESSION['Username'])) {
				if($options['data']['Level'] == "Admin") {
					echo "<script>location.href='index.php?pages=home-admin';</script>";
				} else if($options['data']['Level'] == "Petugas") {
					echo "<script>location.href='index.php?pages=home-petugas';</script>";
				} else {
					echo "<script>location.href='index.php?pages=home-pelanggan';</script>";
				}
				echo "<script>location.href='index.php?pages=load'</script>";
			} else {
				$data = $options['data'];
				require_once $options['file'];
			}
		} else if($name == "isLoggedInPelanggan") {
			if(!isset($_SESSION['Username'])) {
				session_destroy();
				echo "<script>alert('You must login for access this pages'); location.href='index.php?pages=login'</script>";
			} else {
				if($options['data']['Level'] == "Pelanggan") {
					$data = $options['data'];							
					require_once $options['file'];
				} else {
					session_destroy();
				echo "<script>alert('Oops, this page is forbbiden.'); location.href='index.php?pages=login'</script>";
				}				
			}
		} else if($name == "isLoggedInPetugas") {
			if(!isset($_SESSION['Username'])) {
				session_destroy();
				echo "<script>alert('You must login for access this pages'); location.href='index.php?pages=login'</script>";
			} else {
				if($options['data']['Level'] == "Petugas") {
					$data = $options['data'];							
					require_once $options['file'];
				} else {
					session_destroy();
				echo "<script>alert('Oops, this page is forbbiden.'); location.href='index.php?pages=login'</script>";
				}				
			}
		} else if($name == "isLoggedInAdmin") {
			if(!isset($_SESSION['Username'])) {
				session_destroy();
				echo "<script>alert('You must login for access this pages'); location.href='index.php?pages=login'</script>";
			} else {
				if($options['data']['Level'] == "Admin") {
					$data = $options['data'];							
					require_once $options['file'];
				} else {
					session_destroy();
				echo "<script>alert('Oops, this page is forbbiden.'); location.href='index.php?pages=login'</script>";
				}				
			}
		} else if($name == "isLoggedInAdminAndPetugas") {
			if(!isset($_SESSION['Username'])) {
				session_destroy();
				echo "<script>alert('You must login for access this pages'); location.href='index.php?pages=login'</script>";
			} else {
				if($options['data']['Level'] == "Admin" || $options['data']['Level'] == "Petugas") {
					$data = $options['data'];							
					require_once $options['file'];
				} else {
					session_destroy();
				echo "<script>alert('Oops, this page is forbbiden.'); location.href='index.php?pages=login'</script>";
				}				
			}
		}
	}

	function redirectWith($redirect, $array = array()) {
		$_SESSION[$array['name']] = $array['message'];

		echo "<script>location.href='".$redirect."'</script>";
	}

	function checkSession($name) {
		if(isset($_SESSION[$name])) {
			return true;
		} else {
			return false;
		}
	}

	function getSession($name) {
		if(checkSession($name)) {
			return $_SESSION[$name];
		} else {
			return false;
		}
	}

	function removeSession($name) {
		unset($_SESSION[$name]);
	}