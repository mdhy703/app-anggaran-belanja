<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "dom": '<"navbar navbar-expand-lg navbar-dark bg-secondary"<"#search.form-inline my-2 my-lg-0"f>r><"#rsT"<"table"t>ip>'
        // "dom":'<"search"fl><"top">rt<"bottom"ip><"clear">'
    } );
 
    $("#search").before('<a class="navbar-brand" href="index.php?p=donaturonatur">Donatur</a> <ul class="navbar-nav mr-auto mt-2 mt-lg-0"><li class="nav-item"><a class="nav-link btn btn-success" href="index.php?p=donatur&act=add"><i class="fa fa-plus"></i> Tambah Donatur</a></li></ul>');
} );
</script>


<?php if(empty(isset($_GET['act']))){ ?>
		<table class="table table-sm" id="example">
			<thead>
				<tr>
					<td>No</td><td>Nama Donatur</td><td>Alamat</td><td>Telepon</td><td>Aksi</td>
				</tr>
			</thead>
			<tbody>
				<?php $query="SELECT * FROM donatur";
				$q= mysqli_query($con,$query);
				while($r=mysqli_fetch_array($q)){ ?>
				<tr>
					<td><?php echo $r[0]; ?></td>
					<td><?php echo $r[1]; ?></td>
					<td><?php echo $r[2]; ?></td>
					<td><?php echo $r[3]; ?></td>
					<td>
						<a href="index.php?p=donatur&act=edit&id=<?php echo $r[0]; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
						<a href="index.php?p=donatur&act=del&id=<?php echo $r[0]; ?>" onClick="return confirm('yakin mau hapus..?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>	
		</table>	
<?php } else{
if($_GET['act']=='add'){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">TAMBAH DATA DONATUR</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=donatur"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
   </ul>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
			<form method="post">
				<div class="form-group">
					<label>Nama Donatur</label>
					<input type="text" name="nama" class="form-control">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control">
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" name="telp" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$nama=$_POST['nama'];
					$alamat=$_POST['alamat'];
					$telp=$_POST['telp'];
					$query="INSERT INTO donatur(nama_donatur,alamat,no_hp) VALUES('$nama','$alamat','$telp')";
						$q=mysqli_query($con,$query);
						if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Donatur berhasil disimpan..!</b>');
							setTimeout(function(){ window.location="index.php?p=donatur" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data Donatur gagal di tambah..!</b>');
						</script>
				<?php	}
				}//END POST?>
			</form>	

		</div>
	</div>
</div>

<?php	} //END ADD data

if($_GET['act']=='edit'){ 
	$id=$_GET['id'];
	$query="SELECT * FROM donatur where id_donatur='$id'";
	$q=mysqli_query($con,$query);
	$r=mysqli_fetch_array($q);
	?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">UBAH DATA DONATUR</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=donatur"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
			<form method="post">
				<div class="form-group">
					<label>Nama Donatur</label>
					<input type="text" name="nama" class="form-control" value="<?php echo$r[1]; ?>">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control" value="<?php echo$r[2]; ?>">
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" name="telp" class="form-control" value="<?php echo$r[3]; ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$nama=$_POST['nama'];
					$alamat=$_POST['alamat'];
					$telp=$_POST['telp'];	
					$query="UPDATE donatur SET nama_donatur='$nama',no_hp='$telp',alamat='$alamat' WHERE id_donatur='$id'";
					$q=mysqli_query($con,$query);
					if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Donatur berhasil diubah..!</b>');
							setTimeout(function(){ window.location="index.php?p=donatur" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data Donatur gagal di ubah..!</b>');
						</script>
				<?php	}
				}//END POST?>
			</form>	

		</div>
	</div>
</div>

<?php	}
if($_GET['act']=='del'){ ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
		</div>
	</div>
</div>
	<?php $id=$_GET['id'];
	$query="DELETE FROM donatur where id_donatur='$id'";
	$q=mysqli_query($con,$query);
	if($q){ ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-success');
			$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Donatur berhasil Di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=donatur" }, 3500);
		</script>
		<?php }else{  ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-danger');
			$('#msg').html('<b>Data Donatur gagal di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=donatur" }, 3500);
		</script>
	<?php  	}
}

} ?>