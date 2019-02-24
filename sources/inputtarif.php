<?php 
	$title = "Buat Data Tarif";

	require_once "sources/maintemplate/header.php";
?>
<legend>Buat Data Tarif</legend>
<div class="card">
	<div class="card-body">
		<form action="index.php?process=inputtarif" method="POST" class="form-block">	
			<div class="form-group">
				<label>Daya</label>
				<input type="text" class="input" name="Daya" required="">
			</div>
			<div class="form-group">
				<label>TarifPerKwh</label>
				<input type="text" class="input" name="TarifPerKwh" required="">
			</div>
			<div class="form-group">
				<label>Beban</label>
				<input type="text" class="input" name="Beban" required="">
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