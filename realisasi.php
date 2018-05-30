<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "dom": '<"navbar navbar-expand-lg navbar-dark bg-secondary"<"#search.form-inline my-2 my-lg-0"f>r><"#rsT"<"table"t>ip>'
        // "dom":'<"search"fl><"top">rt<"bottom"ip><"clear">'
    } );
 
    $("#search").before('<a class="navbar-brand" href="index.php?p=realisasi">REALISASI</a> <ul class="navbar-nav mr-auto mt-2 mt-lg-0"><li class="nav-item"><a class="nav-link btn btn-success" href="index.php?p=realisasi&act=add"><i class="fa fa-plus"></i> Realisasi Anggaran</a></li></ul>');
} );
</script>


<?php if(empty(isset($_GET['act']))){ ?>
		<table class="table table-sm" id="example">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul Anggaran</th>
					<th>Petugas</th>
					<th>Tanggal dibuat</th>
					<th>Nominal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $query="SELECT realisasi.*,anggaran.`judul_anggaran`,petugas.`nama` FROM realisasi INNER JOIN anggaran ON realisasi.`id_anggaran` = anggaran.`id_anggaran` INNER JOIN petugas ON realisasi.`id_petugas`=petugas.`id_petugas`"; 
				$q= mysqli_query($con,$query);
				$no=1;
				while($r=mysqli_fetch_array($q)){ ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $r[5]; ?></td>
					<td><?php echo $r[6]; ?></td>
					<td><?php echo date('d-m-Y',strToTime($r[2])); ?></td>
					<td>Rp.<?php echo number_format($r[4]); ?></td>
					<td>
						<a href="index.php?p=realisasi&act=detail&id=<?php echo $r[0]; ?>" class="btn btn-sm btn-info" title="Detail Realisasi"><i class="fa fa-list"></i></a>
						<!-- <a href="index.php?p=realisasi&act=edit&id=<?php echo $r[0]; ?>" class="btn btn-warning btn-sm" title="Ubah Data Realisasi"><i class="fa fa-pencil"></i></a> -->
						<a href="index.php?p=realisasi&act=del&id=<?php echo $r[0]; ?>" onClick="return confirm('yakin mau hapus..?');" class="btn btn-danger btn-sm" title="Hapus Data"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>	
		</table>	
<?php } else{
if($_GET['act']=='add'){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">ANGGARAN BARU</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=realisasi"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
   </ul>
</nav>
<div class="container-fluid">
	<div id="msg"></div>
		<form method="post" class="">
			<div class="row mt-2">
				<div class="form-group col-md-3">
					<label>Anggaran</label>
					<select class="form-control" name="suplayer" id="anggaran">
						<?php $query="SELECT * FROM anggaran";
						$s=mysqli_query($con,$query);
						while($r=mysqli_fetch_array($s)){ ?>
						<option value="<?php echo $r[0]; ?>"><?php echo $r[1]; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label>Tanggal Dibuat</label>
					<input type="date" name="create" class="form-control" id="tanggal">
				</div>
				<div class="form-group col-md-2">
					<label>Petugas</label>
					<select class="form-control" name="suplayer" id="petugas">
						<?php $query="SELECT * FROM petugas";
						$s=mysqli_query($con,$query);
						while($r=mysqli_fetch_array($s)){ ?>
						<option value="<?php echo $r[0]; ?>"><?php echo $r[1]; ?></option>
						<?php } ?>
					</select>
				</div>
				<!-- <div class="form-group col-md-1">
					<button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
				</div> -->
				<div class="form-group col-md-1">
				</div>
				<div class="col-md-12">
					<table class="table table-sm table-bordered table-striped mt-1">
						<thead>
						<tr><th>Supplayer</th><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
						<tr id="sumber">
							<td>
								<select class="form-control" name="suplayer" id="suplayer">
									<?php $query="SELECT * FROM suplayer"; 
									$s=mysqli_query($con,$query);
									while($r=mysqli_fetch_array($s)){ ?>
									<option value="<?php echo $r[0]; ?>"><?php echo $r[1]; ?></option>
									<?php } ?>
								</select>
							</td>
							<td>
								<input type="text" id="barang" class="form-control">
							</td>
							<td>
								<input type="number" id="harga" class="form-control" onkeyup="hitung()" min="0" value="0">
							</td>
							<td>
								<input type="number" id="jumlah" class="form-control" onkeyup="hitung()" min="0" value="0">
							</td>
							<td>
								<input type="text" id="subtotal" class="form-control" value="0">
							</td>
							<td>
								<button type="button" id="push" onclick="addItem()" class="btn btn-primary"><i class="fa fa-plus"></i></button>
							</td>
						</tr>
						</thead>
						<tbody id="inputan">
							
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4" class="text-right" >Total</th>
								<th id="total"></th>
							</tr>
						</tfoot>	
					</table>
					<div class="row justify-content-md-end">
						<div class="col-md-2">
							<button type="button" class="btn btn-primary btn-lg form-control" onclick="proses()" id="btn-proses">
								<i class="fa fa-spinner fa-pulse" id="load"></i>
							Simpan</button>
						</div>
					</div>	
					<script type="text/javascript">
						var data = [];
						var Total=0;
						$('#load').hide();
						function hitung(){
							var hrg = $('#harga').val();
							var jml = $('#jumlah').val();
							var sub = jml * hrg
							$('#subtotal').val(sub);
						}
						
						function addItem(){
							var sup = $('#suplayer').val();
							var brg = $('#barang').val();
							var hrg = $('#harga').val();
							var jml = $('#jumlah').val();
							var sub = $('#subtotal').val();
							if(!sup||!brg||hrg==0||jml==0||sub==0){
								$('#msg').attr('class','alert alert-warning alert-dismissible fade show mt-2');
								$('#msg').html('<strong>Data item harus lengkap!</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>')
							}else{
								var i = data.length;
								var dt={
									supplayer : sup,
									barang : brg,
									harga:parseInt(hrg),
									jumlah:parseInt(jml),
									subtotal:parseInt(sub)
								}
								data.push(dt);
								$('#inputan').append('<tr><td>'+sup+'</td><td>'+brg+'</td><td>'+hrg+'</td><td>'+jml+'</td><td>'+sub+'</td><td><button type="button" onclick="rmItem('+i+')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td></tr>');
								$('#suplayer').val('');
								$('#barang').val('');
								$('#harga').val(0);
								$('#jumlah').val(0);
								$('#subtotal').val(0);
								var total = 0;
								for (var i = 0; i < data.length; i++){
							  		total += data[i].subtotal;
								}
								$('#total').html(total);
								Total = total;
							}
						}

						function rmItem(x){
							data.splice(x,1);
							console.log(data);
							var total = 0;
							$('#inputan').html('');
							for (var i = 0; i < data.length; i++){
							  $('#inputan').append('<tr><td>'+data[i].supplayer+'</td><td>'+data[i].barang+'</td><td>'+data[i].harga+'</td><td>'+data[i].jumlah+'</td><td>'+data[i].subtotal+'</td><td><button type="button" onclick="rmItem('+i+')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td></tr>');
							  total += data[i].subtotal;
							}
							$('#total').html(total);
							console.log(total);
							Total = total;
						}

						function proses(){
							$('#btn-proses').addClass('disabled');
							$('#load').show();
				            $('#msg').hide();

							var anggaran = $('#anggaran').val();
							var tanggal = $('#tanggal').val();
							var petugas = $('#petugas').val();
							if(data.length == 1||!anggaran||!tanggal||!petugas){
								console.log('data belum lengkap')
							}else{
								let post = {
									anggaran :anggaran,
									tanggal:tanggal,
									petugas:petugas,
									total:Total,
									item:data
								}
								console.log(post);
								$.ajax({
				                url : 'config/s_trx.php',
				                data : post,
				                type:'POST',
				                dataType:'json',
				                success : function(pesan){
				                    //console.log(pesan);
									$('#load').hide();
									$('#btn-proses').removeClass('disabled');

				                    if(pesan['sukses']==true){
				                        $('#msg').addClass('alert alert-success');
				                        $('#msg').html('Data Realisasi berhasil diproses');
				                        $('#msg').show();
				                        setTimeout(function(){
				                                window.location="index.php?p=realisasi";
				                         },3500);
				                    }
				                    if(pesan['sukses']==false){
				                        console.log('ini ok')
				                        $('#msg').addClass('alert alert-danger');
				                        $('#msg').html('Data Realisasi gagal diproses');
				                        $('#msg').show();
				                    }
				                },
				                error:function(error){
				                    console.log(error);
				                }
				            	});
							}
						}
					</script>
				</div>	
			  </div>
			</form>	
		</div>
</div>

<?php	} //END ADD data

if($_GET['act']=='detail'){ 
	$id=$_GET['id'];
	$q=mysqli_query($con,"SELECT realisasi.*,anggaran.`judul_anggaran`,petugas.nama FROM realisasi INNER JOIN anggaran 
ON realisasi.id_anggaran=anggaran.`id_anggaran` INNER JOIN petugas ON realisasi.`id_petugas`=petugas.`id_petugas` where realisasi.id_anggaran='$id'");
	$e=mysqli_fetch_array($q);
	?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="#">DETAIL DATA REALISASI</a>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
       <a class="nav-link btn btn-dark" href="index.php?p=realisasi"><i class="fa fa-chevron-left"></i> Kembali</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
	  <div id="output" class="row">
		<div class="col-md-4" >
			<span>Judul Anggaran</span><br>
			<b><?php echo$e['judul_anggaran']; ?></b></div>
		<div class="col-md-2">
			<span>Tanggal</span><br>
			<b><?php echo$e['tanggal']; ?></b></div>
		<div class="col-md-3">
			<span>Petugas</span><br>
			<b><?php echo$e['nama']; ?></b></div>
		<div class="col-md-3">
			<br>
			<button class="btn btn-warning" id="ubahData" onclick="ubah()">Ubah</button>
		</div>
	  </div>
	  <div id="inputan" class="row">
		<div class="col-md-4" >
			<div class="form-group">
				<label>Judul aggaran</label>
				<select class="form-control" name="suplayer" id="i_judul">
						<?php $query="SELECT * FROM anggaran";
						$s=mysqli_query($con,$query);
						while($r=mysqli_fetch_array($s)){ ?>
						<option value="<?php echo $r[0]; ?>" <?php echo ($r[0]==$e['id_anggaran']?'selected':''); ?>><?php echo $r[1]; ?></option>
						<?php } ?>
				</select>
				<!-- <input type="text" name="judul" class="form-control" id="i_judul" value="<?php echo$e['judul_anggaran']; ?>"> -->
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label>Tanggal</label>
				<input type="date" name="tgl" class="form-control" id="i_tgl" value="<?php echo$e['tanggal']; ?>">
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label>Petugas</label>
				<select class="form-control" name="suplayer" id="i_petugas">
				<?php $query="SELECT * FROM petugas";
					$s=mysqli_query($con,$query);
					while($r=mysqli_fetch_array($s)){ ?>
					<option value="<?php echo $r[0]; ?>" <?php echo $e['id_petugas']==$r[0]?'selected':''; ?>><?php echo $r[1]; ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<br>
			<button class="btn btn-warning" onclick="simpan()">SIMPAN</button>
			<button class="btn btn-secondary" onclick="batal()">BATAL</button>
		</div>
	  </div>
	  <hr class="my-2">
	<div class="row mt-2">
	  <div class="col-md-10">
	  	<h4>Detail Realisasi</h4>
	  </div>
	  <div class="col-md-2">
	  	<a href="#" data-toggle="modal" data-target="#mdl-detail" class="btn btn-success">Tambah Item</a>
	  </div>	
	  <div class="col-md-12 mt-2">
	  	<table class="table table-sm table-bordered table-striped">
	  		<thead>
				<tr><th>Supplayer</th><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><td>Aksi</td></tr>
			</thead>
			<tbody id="inputan">
							<?php $query="SELECT detail_realisasi.*,suplayer.nama FROM detail_realisasi INNER JOIN suplayer on detail_realisasi.id_suplayer=suplayer.id_suplayer where detail_realisasi.id_realisasi='$id'";
								$q=mysqli_query($con,$query);
								while($res=mysqli_fetch_array($q)){ ?>
								<tr>
									<td><?php echo $res['nama']; ?></td>
									<td><?php echo $res['nama_pembelian']; ?></td>
									<td><?php echo'Rp.'.number_format($res['harga']); ?></td>
									<td><?php echo $res['jumlah']; ?></td>
									<td><?php echo'Rp.'.number_format( $res['subtotal']); ?></td>
									<td>
										<button class="btn btn-sm btn-warning" title="Edit" onclick="edit(<?php echo $res[0]; ?>)"><i class="fa fa-pencil"></i></button>
										<a class="btn btn-sm btn-danger" title="Hapus" href="index.php?p=realisasi&act=delDetail&id=<?php echo $res[0].'&idr='.$id; ?>"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4" class="text-right" >Total</th>
					<th id="total"><?php echo'Rp.'.number_format($e['nominal']); ?></th><th></th>
				</tr>
			</tfoot>	
		 </table>
	  </div>
	</div>
</div>
<div class="modal fade" id="mdl-detail" tabindex="-1" role="dialog" aria-labelledby="mdl-detail" aria-hidden="true">
  <form class="modal-dialog" role="document" method="post">
  	<input type="hidden" name="iddetail" id="iddetail">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Realisasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label">Supplayer</label>
		    <div class="col-sm-10">
		      <select class="form-control" name="suplayer" id="suplayer">
				<?php $query="SELECT * FROM suplayer"; 
				$s=mysqli_query($con,$query);
				while($r=mysqli_fetch_array($s)){ ?>
					<option value="<?php echo $r[0]; ?>"><?php echo $r[1]; ?></option>
					<?php } ?>
			  </select>
		    </div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Nama Barang</label>
		    <div class="col-sm-10">
		      <input type="text" id="barang" class="form-control" name="brg">
		    </div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Harga</label>
		    <div class="col-sm-10">
				<input type="number" id="harga" class="form-control" onkeyup="hitung()" min="0" value="0" name="hrg">
		    </div>
		</div>
		<div class="form-group row">
		    <label for="inputPassword" class="col-sm-2 col-form-label">Jumlah</label>
		    <div class="col-sm-10">
		      <input type="number" id="jumlah" class="form-control" onkeyup="hitung()" min="0" value="0" name="jml">
		    </div>
		</div>
		<div class="form-group row">
		    <label for="inputPassword" class="col-sm-2 col-form-label">Subtotal</label>
		    <div class="col-sm-10">
			  <input type="text" id="subtotal" class="form-control" readonly="" name="sub">
		    </div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan" id="btn-save">Simpan</button>
        <button type="submit" class="btn btn-primary" name="ubah"  id="btn-ubah">Ubah</button>
      </div>
      <?php 
      	if(isset($_POST['simpan'])){
      		$sup=$_POST['suplayer'];
      		$brg=$_POST['brg'];
      		$hrg=$_POST['hrg'];
      		$jml=$_POST['jml'];
      		$sub=$_POST['sub'];
      		// mysqli_query($con,"BEGIN");
      		$save="INSERT INTO detail_realisasi(id_realisasi,id_suplayer,nama_pembelian,harga,jumlah,subtotal) VALUES('$id','$sup','$brg','$hrg','$jml','$sub')";
      		if(mysqli_query($con,$save)){ 

      			$sum = mysqli_query($con,"SELECT SUM(subtotal) FROM detail_realisasi WHERE id_realisasi='$id'");
      			$re = mysqli_fetch_array($sum);
      			$total = $re[0];
      			mysqli_query($con,"UPDATE realisasi set nominal=$total where id_realisasi='$id'");
      			?>
      			<script type="text/javascript">
					window.location="index.php?p=realisasi&act=detail&id=<?php echo $id; ?>"            
      			</script>
      		<?php } 
      	}
       	if(isset($_POST['ubah'])){
      		$iddetail=$_POST['iddetail'];
      		$sup=$_POST['suplayer'];
      		$brg=$_POST['brg'];
      		$hrg=$_POST['hrg'];
      		$jml=$_POST['jml'];
      		$sub=$_POST['sub'];
      		// mysqli_query($con,"BEGIN");
      		$save="UPDATE detail_realisasi set id_suplayer='$sup',nama_pembelian='$brg',harga='$hrg',jumlah='$jml',subtotal='$sub' WHERE id='$iddetail'";
      		if(mysqli_query($con,$save)){ 

      			$sum = mysqli_query($con,"SELECT SUM(subtotal) FROM detail_realisasi WHERE id_realisasi='$id'");
      			$re = mysqli_fetch_array($sum);
      			$total = $re[0];
      			mysqli_query($con,"UPDATE realisasi set nominal=$total where id_realisasi='$id'");
      			?>
      			<script type="text/javascript">
					window.location="index.php?p=realisasi&act=detail&id=<?php echo $id; ?>"            
      			</script>
      		<?php } 
      	}
       ?>

    </form>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#inputan').hide();
	})

	function ubah(){
		$('#output').hide();
		$('#inputan').show();
	}
	function batal(){
		$('#output').show();
		$('#inputan').hide();
	}
	function hitung(){
		var hrg = $('#harga').val();
		var jml = $('#jumlah').val();
		var sub = jml * hrg
		$('#subtotal').val(sub);
	}
	function simpan(){
		let post = {
					anggaran :$('#i_judul').val(),
					tanggal:$('#i_tgl').val(),
					petugas:$('#i_petugas').val(),
					id:<?php echo $id; ?>
				   }
		$.ajax({
			url : 'config/ubahRealisasi.php',
			data : post,
			type:'POST',
			dataType:'json',
			success : function(pesan){     
			console.log(pesan);  
				window.location="index.php?p=realisasi&act=detail&id=<?php echo $id; ?>"            
			},
			error:function(error){
				console.log(error);
			}
		});
	}
	function edit(a){
		$.ajax({
			url : 'config/getDetailRealisasi.php',
			data : {id:a},
			type:'POST',
			dataType:'json',
			success : function(pesan){     
				console.log(pesan);  
				$('#suplayer').val(pesan.id_suplayer);    
				$('#barang').val(pesan.nama_pembelian);    
				$('#harga').val(pesan.harga);    
				$('#jumlah').val(pesan.jumlah);    
				$('#subtotal').val(pesan.subtotal); 
				$('#iddetail').val(pesan.id); 
				$('#btn-save').hide();
				$('#mdl-detail').modal('show');   
			},
			error:function(error){
				console.log(error);
			}
		});
	}

	$('#mdl-detail').on('hidden.bs.modal', function (e) {
				$('#btn-save').show();
				$('#btn-ubah').hide();
  		
	})
</script>

<?php }//	end detail
if($_GET['act']=='del'){ ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 mt-2">
			<div id="msg"></div>
		</div>
	</div>
</div>
	<?php $id=$_GET['id'];
	$q=mysqli_query($con,"DELETE FROM realisasi where id_realisasi='$id'");
	if($q){ 
	$q=mysqli_query($con,"DELETE FROM detail_realisasi where id_realisasi='$id'");
		?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-success');
			$('#msg').html('<i class="fa fa-spinner fa-pulse"></i> <b>Data Realisasi berhasil Di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=realisasi" }, 3500);
		</script>
		<?php }else{  ?>
		<script type="text/javascript">
			$('#msg').attr('class','alert alert-danger');
			$('#msg').html('<b>Data Realisasi gagal di hapus..!</b>');
			setTimeout(function(){ window.location="index.php?p=realisasi" }, 3500);
		</script>
	<?php  	}
}
if($_GET['act']=='delDetail'){ ?>
	<?php 
	$id=$_GET['id'];
	$idr=$_GET['idr'];
	$q=mysqli_query($con,"DELETE FROM detail_realisasi where id='$id'");
	if($q){ 
		$sum = mysqli_query($con,"SELECT SUM(subtotal) FROM detail_realisasi WHERE id_realisasi='$idr'");
      			$re = mysqli_fetch_array($sum);
      			$total = $re[0];
      			mysqli_query($con,"UPDATE realisasi set nominal=$total where id_realisasi='$idr'");
		?>
		<script type="text/javascript">
			window.location="index.php?p=realisasi&act=detail&id=<?php echo $idr; ?>";
		</script>
		<?php }else{  ?>
		<script type="text/javascript">
			alert('gagal');
			window.location="index.php?p=realisasi&act=detail&id=<?php echo $idr; ?>"
		</script>
	<?php  	}
}
} ?>