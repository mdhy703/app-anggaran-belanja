<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "dom": '<"navbar navbar-expand-lg navbar-dark bg-secondary"<"#search.form-inline my-2 my-lg-0"f>r><"#rsT"<"table"t>ip>'
        // "dom":'<"search"fl><"top">rt<"bottom"ip><"clear">'
    } );
 
    $("#search").before('<a class="navbar-brand" href="index.php?p=denasi">Donatur</a> <ul class="navbar-nav mr-auto mt-2 mt-lg-0"><li class="nav-item"><a class="nav-link btn btn-success" href="index.php?p=donasi&act=add"><i class="fa fa-plus"></i> Tambah Donasi</a></li></ul>');
} );
</script>


<?php if(empty(isset($_GET['act']))){ ?>
		<table class="table table-sm" id="example">
			<thead>
				<tr>
					<td>No</td><td>Nama Donatur</td><td>Tanggal</td><td>Jumlah</td><td>Aksi</td>
				</tr>
			</thead>
			<tbody>
				<?php $query="SELECT donasi.*,donatur.nama_donatur FROM donasi inner join donatur on donasi.id_donatur = donatur.id_donatur";
				$q= mysqli_query($con,$query);
				while($r=mysqli_fetch_array($q)){ ?>
				<tr>
					<td><?php echo $r[0]; ?></td>
					<td><?php echo $r[4]; ?></td>
					<td><?php echo $r[2]; ?></td>
					<td><?php echo 'Rp.'.number_format($r[3]); ?></td>
					<td>
						<a href="index.php?p=donasi&act=edit&id=<?php echo $r[0]; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
						<a href="index.php?p=donasi&act=del&id=<?php echo $r[0]; ?>" onClick="return confirm('yakin mau hapus..?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>	
		</table>	
<?php } else{
if($_GET['act']=='add'){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">TAMBAH DATA DONASI</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=donasi"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
   </ul>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
			<form method="post">
				<div class="form-group">
					<label>Donatur</label>
					<select name="donatur" class="form-control">
					<?php $q=mysqli_query($con,"SELECT * FROM donatur");
					 while($r=mysqli_fetch_array($q)){ ?>
					 	<option value="<?php echo $r[0]; ?>"><?php echo $r['nama_donatur']; ?></option>
					 <?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tgl" class="form-control">
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$donatur=$_POST['donatur'];
					$tgl=$_POST['tgl'];
					$jumlah=$_POST['jumlah'];
					$query="INSERT INTO donasi(id_donatur,tanggal,nominal) VALUES('$donatur','$tgl','$jumlah')";
						$q=mysqli_query($con,$query);
						if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Donasi berhasil disimpan..!</b>');
							setTimeout(function(){ window.location="index.php?p=donasi" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data Donasi gagal di tambah..!</b>');
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
	$query="SELECT * FROM donasi where id_donasi='$id'";
	$q=mysqli_query($con,$query);
	$r=mysqli_fetch_array($q);
	?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">UBAH DATA DONASI</a>
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
					<label>Donatur</label>
					<select name="donatur" class="form-control">
					<?php $q=mysqli_query($con,"SELECT * FROM donatur");
					 while($v=mysqli_fetch_array($q)){ ?>
					 	<option value="<?php echo $v[0]; ?>" <?php echo ($v[1]==$r[0]?'selected':''); ?>><?php echo $v['nama_donatur']; ?></option>
					 <?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tgl" class="form-control" value="<?php echo $r[2]; ?>">
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control"  value="<?php echo $r[3]; ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$donatur=$_POST['donatur'];
					$tgl=$_POST['tgl'];
					$jumlah=$_POST['jumlah'];
					$query="UPDATE donasi SET id_donatur='$donatur',nominal='$jumlah',tanggal='$tgl' WHERE id_donasi='$id'";
					$q=mysqli_query($con,$query);
					if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Donasi berhasil diubah..!</b>');
							setTimeout(function(){ window.location="index.php?p=donasi" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data Donasi gagal di ubah..!</b>');
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
	$query="DELETE FROM donasi where id_donasi='$id'";
	$q=mysqli_query($con,$query);
	if($q){ ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-success');
			$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Donasi berhasil Di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=donasi" }, 3500);
		</script>
		<?php }else{  ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-danger');
			$('#msg').html('<b>Data Donasi gagal di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=donasi" }, 3500);
		</script>
	<?php  	}
}

} ?>