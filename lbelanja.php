<nav class="navbar navbar-light bg-light mb-3">
  <a class="navbar-brand" href="#">LAPORAN BELANJA</a>
</nav>
<div class="container-fluid">
<div class="row">
	<div class="col-md-4">
		<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Laporan Harian
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      	<div class="form-group">
      		<label>Tanggal</label>
        	<input type="date" id="tgl" class="form-control">
      	</div>
      	<div class="form-group">
      		<button class="btn btn-primary" onclick="print('tgl')">CETAK</button>
      	</div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Laporan Per Bulan
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <div class="form-group">
        	<label>Bulan</label>
        	<select id="bulan" class="form-control">
        		<option value="1">Januari</option>
        		<option value="2">Februari</option>
        		<option value="3">Maret</option>
        		<option value="4">April</option>
        		<option value="5">Mei</option>
        		<option value="6">Juni</option>
        		<option value="7">Juli</option>
        		<option value="8">Agustus</option>
        		<option value="9">September</option>
        		<option value="10">Oktober</option>
        		<option value="11">November</option>
        		<option value="12">Desember</option>
        	</select>
        </div>
        <div class="form-group">
        	<label>Tahun</label>
        	<input type="text" id="tahun" maxlength="4" class="form-control">
        </div>
        <div class="form-group">
      		<button class="btn btn-primary"  onclick="print('bulan')">CETAK</button>
      	</div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Laporan Tahunan
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <div class="form-group">
        	<label>Tahun</label>
        	<input type="text" id="th" maxlength="4" class="form-control">
        </div>
        <div class="form-group">
      		<button class="btn btn-primary"  onclick="print('th')">CETAK</button>
      	</div>
      </div>
    </div>
  </div>
</div>
	</div>
</div>
</div>
<script type="text/javascript">
	function print(e){
		if(e=='tgl'){
			let tgl = $('#tgl').val();
			if(tgl){
				console.log('ok');
				window.location="lap-belanja.php?tanggal="+tgl
			}else{
				alert('pilih tanggal dulu...!');
			}
		}else if(e=='bulan'){
			let bln = $('#bulan').val();
			let thn = $('#tahun').val();
			if(bln && thn){
				console.log('ok');
				window.location="lap-belanja.php?bulan="+bln+"&tahun="+thn
			}else{
				alert('pilih Bulan dan tahun  dulu...!');
			}
		}else{
			let th = $('#th').val();
			if(th){
				console.log('ok');
				window.location="lap-belanja.php?tahun="+th
			}else{
				alert('Inputkan Tahun  dulu...!');
			}
		}
	}
</script>