<?php 
	$title = "Buat Petugas / Admin";
	require_once "sources/maintemplate/header.php";
?>
<legend>Buat Petugas / Admin</legend>
<?php 
	if(checkSession("success_add_petugas")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_add_petugas"); ?>
	</div>
	<?php		
		removeSession('success_add_petugas');
	}

	if(checkSession("failed_add_petugas")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_add_petugas"); ?>
	</div>
	<?php		
		removeSession('failed_add_petugas');
	}
	
	if(checkSession("username_already_claimed")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("username_already_claimed"); ?>
	</div>
	<?php		
		removeSession('username_already_claimed');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=inputpetugas" method="POST" class="form-block">
			<div class="form-group">
				<label for="Username">Username</label>
				<input type="text" class="input" id="Username" name="Username" required>
			</div>
			<div class="form-group">
				<label for="Password">Password</label>
				<input type="password" class="input" id="Password" name="Password" required>
			</div>
			<div class="form-group">
				<label for="NamaLengkap">Nama Lengkap</label>
				<input type="text" class="input" id="NamaLengkap" name="NamaLengkap" required>
			</div>
			<div class="form-group">
				<label for="Level">Level</label>
				<select name="Level" class="input" required>
					<option value="">Pilih Level</option>
					<option value="Admin">Admin</option>
					<option value="Petugas">Petugas</option>
				</select>	
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Tambahkan</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
	</div>
</div>
<?php 
	require_once "sources/maintemplate/footer.php";
?>