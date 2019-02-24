<?php 
	
	$title = "Daftar Petugas";
	require_once "sources/maintemplate/header.php";

	$selectPetugas = mysqli_query($connect, "SELECT * FROM tb_login WHERE Level <> 'Pelanggan' ORDER BY KodeLogin DESC");

	if(mysqli_num_rows($selectPetugas) > 0) {
?>
<legend>Daftar Petugas</legend>
<?php 
	if(checkSession("success_delete_petugas")) {
	?>
	<div class="alert alert-success">
		<?php echo getSession("success_delete_petugas"); ?>
	</div>
	<?php		
		removeSession('success_delete_petugas');
	}

	if(checkSession("failed_delete_petugas")) {
	?>
	<div class="alert alert-danger">
		<?php echo getSession("failed_delete_petugas"); ?>
	</div>
	<?php		
		removeSession('failed_delete_petugas');
	}
?>
<table style="border-collapse: collapse;" border="1">
	<tr>
		<th>No</th>
		<th>Username</th>
		<th>Nama Lengkap</th>
		<th>Level</th>
		<th>Aksi</th>
	</tr>
	<?php
		$No = 1;
		while($ptg = mysqli_fetch_assoc($selectPetugas)) {
			$msg = "Apakah anda yakin ingin menghapus admin atau petugas dengan nama ".$ptg['NamaLengkap'];
	?>
	<tr>
		<td><?php echo $No; ?></td>
		<td><?php echo $ptg['Username']; ?></td>	
		<td><?php echo $ptg['NamaLengkap']; ?></td>
		<td><?php echo $ptg['Level']; ?></td>
		<td><a href="index.php?pages=editpetugas&KodeLogin=<?php echo $ptg['KodeLogin']; ?>">Edit</a> 
			<?php 
				if($ptg['Username'] != $_SESSION['Username']) {
			?>
			/ <a href="index.php?process=deletepetugas&KodeLogin=<?php echo $ptg['KodeLogin']; ?>" onclick="return deleteAlert('<?php echo $msg; ?>')">Delete</a></td>
			<?php
				}
			?>
	</tr>
	<?php
			$No++;
		}
	?>
</table>
<a href="index.php?pages=inputpetugas" class="button-group">
	<button type="button" class="btn btn-success">Tambah Petugas / Admin</button>
</a>
<?php
	} else {
		echo "Tidak ada ada petugas atau admin";
	}
	require_once "sources/maintemplate/footer.php";
