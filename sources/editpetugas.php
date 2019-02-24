<?php 
	
	$title = "Edit Petugas";
	require_once "sources/maintemplate/header.php";

	if(isset($_GET['KodeLogin'])){
		$KodeLogin = mysqli_real_escape_string($connect, $_GET['KodeLogin']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_login WHERE KodeLogin='$KodeLogin'");
		if(mysqli_num_rows($selectQuery) > 0) {
			$row = mysqli_fetch_assoc($selectQuery);
?>
<legend>Edit Petugas</legend>
<?php 
	if(checkSession("success_edit_petugas")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_edit_petugas"); ?>
	</div>
	<?php		
		removeSession('success_edit_petugas');
	}

	if(checkSession("failed_edit_petugas")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_edit_petugas"); ?>
	</div>
	<?php		
		removeSession('failed_edit_petugas');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=editpetugas" method="POST" class="form-block">
			<input type="hidden" name="KodeLogin" value="<?php echo $row['KodeLogin']; ?>">
			<div class="form-group">
				<label for="Username">Username</label>
				<input type="text" class="input" id="Username" name="Username" value="<?php echo $row['Username']; ?>">
			</div>
			<div class="form-group">
				<label for="Password">Password</label>
				<input type="password" class="input" id="Password" name="Password">
			</div>
			<div class="form-group">
				<label for="NamaLengkap">Nama Lengkap</label>
				<input type="text" class="input" id="NamaLengkap" name="NamaLengkap"  value="<?php echo $row['NamaLengkap']; ?>">
			</div>
			<div class="form-group">
				<label for="Level">Level</label>
				<select name="Level" class="input">
					<option value="">Pilih Level</option>
					<option value="Admin" <?php echo ($row['Level'] == "Admin") ? 'selected': ''; ?>>Admin</option>
					<option value="Petugas" <?php echo ($row['Level'] == "Petugas") ? 'selected': ''; ?>>Petugas</option>
				</select>	
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Edit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
	</div>
</div>

<?php
		} else {
			echo "Petugas tidak ditemukan!";
		}
	}
	require_once "sources/maintemplate/footer.php";
?>