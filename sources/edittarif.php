<?php 
	
	$title = "Edit Tarif";
	require_once "sources/maintemplate/header.php";

	if(isset($_GET['KodeTarif'])){
		$KodeTarif = mysqli_real_escape_string($connect, $_GET['KodeTarif']);

		$selectQuery = mysqli_query($connect, "SELECT * FROM tb_tarif WHERE KodeTarif='$KodeTarif'");
		if(mysqli_num_rows($selectQuery) > 0) {
			$row = mysqli_fetch_assoc($selectQuery);
?>
<legend>Edit Tarif</legend>
<?php 
	if(checkSession("success_tarif")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_tarif"); ?>
	</div>
	<?php		
		removeSession('success_tarif');
	}

	if(checkSession("failed_tarif")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_tarif"); ?>
	</div>
	<?php		
		removeSession('failed_tarif');
	}
?>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=edittarif" method="POST" class="form-block">	
			<input type="hidden" name="KodeTarif" value="<?php echo $row['KodeTarif']; ?>">
			<div class="form-group">
				<label>Daya</label>
				<input type="text" class="input" name="Daya" value="<?php echo $row['Daya']; ?>">
			</div>
			<div class="form-group">
				<label>TarifPerKwh</label>
				<input type="text" class="input" name="TarifPerKwh" value="<?php echo $row['TarifPerKwh']; ?>">
			</div>
			<div class="form-group">
				<label>Beban</label>
				<input type="text" class="input" name="Beban" value="<?php echo $row['Beban']; ?>">
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

		}
	}
	require_once "sources/maintemplate/footer.php";
?>