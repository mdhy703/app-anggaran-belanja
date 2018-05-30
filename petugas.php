<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "dom": '<"navbar navbar-expand-lg navbar-dark bg-secondary"<"#search.form-inline my-2 my-lg-0"f>r><"#rsT"<"table"t>ip>'
        // "dom":'<"search"fl><"top">rt<"bottom"ip><"clear">'
    } );
 
    $("#search").before('<a class="navbar-brand" href="index.php?p=petugas">PETUGAS</a> <ul class="navbar-nav mr-auto mt-2 mt-lg-0"><li class="nav-item"><a class="nav-link btn btn-success" href="index.php?p=petugas&act=add"><i class="fa fa-plus"></i> Tambah Petugas</a></li></ul>');
} );
</script>


<?php if(empty(isset($_GET['act']))){ ?>
		<table class="table table-sm" id="example">
			<thead>
				<tr>
					<td>No</td><td>Nama Petugas</td><td>Jenis kelamin</td><td>Phone</td><td>Aksi</td>
				</tr>
			</thead>
			<tbody>
				<?php $query="SELECT * FROM petugas"; 
				$q= mysqli_query($con,$query);
				while($r=mysqli_fetch_array($q)){ ?>
				<tr>
					<td><?php echo $r[0]; ?></td>
					<td><?php echo $r[1]; ?></td>
					<td><?php echo ($r[2]=='L'?'Laki-laki':'Perempuan'); ?></td>
					<td><?php echo $r[3]; ?></td>
					<td>
						<a href="index.php?p=petugas&act=edit&id=<?php echo $r[0]; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
						<a href="index.php?p=petugas&act=del&id=<?php echo $r[0]; ?>" onClick="return confirm('yakin mau hapus..?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>	
		</table>	
<?php } else{
if($_GET['act']=='add'){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">TAMBAH DATA PETUGAS</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=petugas"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
   </ul>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
			<form method="post">
				<div class="form-group">
					<label>Kode Petugas</label>
					<input type="text" name="kode" class="form-control" maxlength="10">
				</div>
				<div class="form-group">
					<label>Nama Petugas</label>
					<input type="text" name="nama" class="form-control">
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="jk" class="form-control">
						<option value="L">Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" name="telp" class="form-control">
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="ket" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$kode=$_POST['kode'];
					$nama=$_POST['nama'];
					$jk=$_POST['jk'];
					$telp=$_POST['telp'];
					$ket=$_POST['ket'];
					$query="SELECT * FROM suplayer WHERE id_suplayer='$kode'";
					$cek = mysqli_query($con,$query);
					if(mysqli_num_rows($cek)>0){ ?>
					<script type="text/javascript">
							$('#msg').class('alert alert-danger');
							$('#msg').html('<b>Kode Petugas sudah ada..!</b>');
					</script>
					<?php }else{ 
						$query="INSERT INTO petugas(id_petugas,nama,jk,no_hp,ket) VALUES('$kode','$nama','$jk','$telp','$ket')";
						$q=mysqli_query($con,$query);
						if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Petugas berhasil disimpan..!</b>');
							setTimeout(function(){ window.location="index.php?p=petugas" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data PEtugas gagal di tambah..!</b>');
						</script>
				<?php	}
				 } 
				}//END POST?>
			</form>	

		</div>
	</div>
</div>

<?php	} //END ADD data

if($_GET['act']=='edit'){ 
	$id=$_GET['id'];
	$query ="SELECT * FROM petugas where id_petugas='$id'";
	$q=mysqli_query($con,$query);
	$r=mysqli_fetch_array($q);
	?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">UBAH DATA PETUGAS</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=supplayer"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
			<form method="post">
				<div class="form-group">
					<label>Kode Petugas</label>
					<input type="text" name="kode" class="form-control" maxlength="10" value="<?php echo$r[0]; ?>">
				</div>
				<div class="form-group">
					<label>Nama Petugas</label>
					<input type="text" name="nama" class="form-control" value="<?php echo$r[1]; ?>">
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="jk" class="form-control">
						<option value="L" <?php echo($r[2]=='L'?'selected':''); ?>>Laki-laki</option>
						<option value="P" <?php echo($r[2]=='P'?'selected':''); ?>>Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" name="telp" class="form-control" value="<?php echo$r[3]; ?>">
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="ket" class="form-control" value="<?php echo$r[4]; ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$kode=$_POST['kode'];
					$nama=$_POST['nama'];
					$jk=$_POST['jk'];
					$telp=$_POST['telp'];
					$ket=$_POST['ket'];	
					$query="UPDATE petugas SET nama='$nama',jk='$jk',no_hp='$telp',ket='$ket' WHERE id_petugas='$id'";
					$q=mysqli_query($con,$query);
					if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Petugas berhasil diubah..!</b>');
							setTimeout(function(){ window.location="index.php?p=petugas" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data Petugas gagal di ubah..!</b>');
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
	$query="DELETE FROM petugas where id_petugas='$id'";
	$q=mysqli_query($con,$query);
	if($q){ ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-success');
			$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Petugas berhasil Di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=petugas" }, 3500);
		</script>
		<?php }else{  ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-danger');
			$('#msg').html('<b>Data Petugas gagal di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=petugas" }, 3500);
		</script>
	<?php  	}
}

} ?>