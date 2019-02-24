<!DOCTYPE html>
<html>
<head>
	<title>PT PLN &middot; Login</title>

	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<style type="text/css">
		.wrapperLogin {
			display: flex;
			width:100%;
			justify-content: center;
			align-items: center;
			height:100vh;
		}
	</style>
</head>
<body style="background-color: #fafafa;">
	<div class="wrapperLogin">
		<div class="card" style="width:350px;">
			<div class="card-body">
				<legend>Halaman Login &middot; Listrik Pascabayar</legend>
				<form action="index.php?process=login" method="POST" class="form-label">
					<div class="form-group">
						<label for="Username">Username</label>
						<input type="text" class="input input-block" id="Username" name="Username">
					</div>
					<div class="form-group">
						<label for="Password">Password</label>
						<input type="password" class="input input-block" id="Password" name="Password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>