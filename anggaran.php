<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "dom": '<"navbar navbar-expand-lg navbar-dark bg-secondary"<"#search.form-inline my-2 my-lg-0"f>r><"#rsT"<"table"t>ip>'
        // "dom":'<"search"fl><"top">rt<"bottom"ip><"clear">'
    } );
 
    $("#search").before('<a class="navbar-brand" href="index.php?p=anggaran">ANGGARAN</a> <ul class="navbar-nav mr-auto mt-2 mt-lg-0"><li class="nav-item"><a class="nav-link btn btn-success" href="index.php?p=anggaran&act=add"><i class="fa fa-plus"></i> Anggaran Baru</a></li></ul>');
} );
</script>


<?php if(empty(isset($_GET['act']))){ ?>
		<table class="table table-sm" id="example">
			<thead>
				<tr>
					<td>Kode Anggaran</td>
					<td>Judul Anggaran</td>
					<td>Nominal</td>
					<td>Tanggal dibuat</td>
					<td>Tanggal Selesai</td>
					<td>Status</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody>
				<?php $query="SELECT * FROM anggaran";
				$q= mysqli_query($con,$query);
				while($r=mysqli_fetch_array($q)){ ?>
				<tr>
					<td><?php echo $r[0]; ?></td>
					<td><?php echo $r[1]; ?></td>
					<td>Rp.<?php echo number_format($r[2]); ?></td>
					<td><?php echo date('d-m-Y',strToTime($r[3])); ?></td>
					<td><?php echo date('d-m-Y',strToTime($r[4])); ?></td>
					<td><?php echo $r[6]; ?></td>
					<td>
						<a href="index.php?p=anggaran&act=edit&id=<?php echo $r[0]; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
						<a href="index.php?p=anggaran&act=del&id=<?php echo $r[0]; ?>" onClick="return confirm('yakin mau hapus..?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>	
		</table>	
<?php } else{
if($_GET['act']=='add'){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">ANGGARAN BARU</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=anggaran"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
   </ul>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
			<form method="post">
				<div class="form-group">
					<label>Judul Anggaran</label>
					<input type="text" name="judul" class="form-control">
				</div>
				<div class="form-group">
					<label>Tanggal Dibuat</label>
					<input type="date" name="create"  class="form-control">
				</div>
				<div class="form-group">
					<label>Tanggal Selesai</label>
					<input type="date" name="tgl"  class="form-control">
				</div>
				<div class="form-group">
					<label>Nominal</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp.</span>
						</div>
						<input type="number" name="nominal" class="form-control">
					</div>
				</div>
							
				<div class="form-group">
					<label>Status</label>
					<select class="form-control" name="status">
						<option value="Tunggu">Tunggu</option>
						<option value="Dalam Proses">Dalam Proses</option>
						<option value="Terlaksana">Terlaksana</option>
						<option value="Dibatalkan">Dibatalkan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="ket" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$judul=$_POST['judul'];
					$nominal=$_POST['nominal'];
					$create=$_POST['create'];
					$tgl=$_POST['tgl'];
					$status=$_POST['status'];
					$ket=$_POST['ket'];
					$query="INSERT INTO anggaran(judul_anggaran,nominal,tanggal,tgl_selesai,status,ket)
						 VALUES('$judul','$nominal','$create','$tgl','$status','$ket')";
						$q=mysqli_query($con,$query);
						if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Anggaran berhasil disimpan..!</b>');
							setTimeout(function(){ window.location="index.php?p=anggaran" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data Anggaran gagal di tambah..!</b>');
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
	$query="SELECT * FROM anggaran where id_anggaran='$id'";
	$q=mysqli_query($con,$query);
	$r=mysqli_fetch_array($q);
	?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">UBAH DATA PETUGAS</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=anggaran"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
			<form method="post">
				<div class="form-group">
					<label>Judul Anggaran</label>
					<input type="text" name="judul" class="form-control" value="<?php echo$r[1]; ?>">
				</div>
				<div class="form-group">
					<label>Tanggal Dibuat</label>
					<input type="date" name="create"  class="form-control"  value="<?php echo$r['tanggal']; ?>">
				</div>
				<div class="form-group">
					<label>Tanggal Selesai</label>
					<input type="date" name="tgl"  class="form-control"  value="<?php echo$r['tgl_selesai']; ?>">
				</div>
				<div class="form-group">
					<label>Nominal</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp.</span>
						</div>
						<input type="number" name="nominal" class="form-control" value="<?php echo$r['nominal']; ?>">
					</div>
				</div>
							
				<div class="form-group">
					<label>Status</label>
					<select class="form-control" name="status">
						<option value="Tunggu" <?php echo($r['status']=='Tunggu'?'selected':''); ?>>Tunggu</option>
						<option value="Dalam Proses" <?php echo($r['status']=='Dalam Proses'?'selected':''); ?>>Dalam Proses</option>
						<option value="Terlaksana" <?php echo($r['status']=='Terlaksana'?'selected':''); ?>>Terlaksana</option>
						<option value="Dibatalkan" <?php echo($r['status']=='Dibatalkan'?'selected':''); ?>>Dibatalkan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="ket" class="form-control" value="<?php echo$r['ket']; ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div>
				<?php if(isset($_POST['simpan'])){
					$judul=$_POST['judul'];
					$nominal=$_POST['nominal'];
					$create=$_POST['create'];
					$tgl=$_POST['tgl'];
					$status=$_POST['status'];
					$ket=$_POST['ket'];
					$query="UPDATE anggaran set judul_anggaran='$judul',nominal='$nominal',tanggal='$create',tgl_selesai='$tgl',status='$status',ket='$ket' where id_anggaran='$id'";
					$q=mysqli_query($con,$query);
					if($q){  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-success');
							$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Anggaran berhasil diubah..!</b>');
							setTimeout(function(){ window.location="index.php?p=anggaran" }, 3500);
						</script>
						<?php }else{  ?>
						<script type="text/javascript">
							$('#msg').attr('class','alert alert-danger');
							$('#msg').html('<b>Data Anggaran gagal di ubah..!</b>');
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
	$query="DELETE FROM anggaran where id_anggaran='$id'";
	$q=mysqli_query($con,$query);
	if($q){ ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-success');
			$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Anggaran berhasil Di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=anggaran" }, 3500);
		</script>
		<?php }else{  ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-danger');
			$('#msg').html('<b>Data Anggaran gagal di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=anggaran" }, 3500);
		</script>
	<?php  	}
}

} ?>