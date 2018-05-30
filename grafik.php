<?php 
	$th=2018;
	$donasi=array();
	$pengeluaran=array();
	for ($i=1; $i <=12 ; $i++) { 
		$q=mysqli_query($con,"SELECT SUM(nominal) AS total FROM donasi WHERE YEAR(tanggal)=$th AND MONTH(tanggal)=$i");
		$res=mysqli_fetch_row($q);
		$donasi[]=($res[0]==null?0:floatval($res[0]));

		$q=mysqli_query($con,"SELECT SUM(nominal) AS total FROM realisasi WHERE YEAR(tanggal)=$th AND MONTH(tanggal)=$i");
		$res=mysqli_fetch_row($q);
		$pengeluaran[]=($res[0]==null?0:floatval($res[0]));
	}
	
?>
<script type="text/javascript" src="assets/highchart.js"></script>
<script type="text/javascript">
	$(function () { 
    var myChart = Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Grafik Donasi Dan Pengeluaran Tahun <?php echo $th; ?>'
        },
        xAxis: {
            categories: ['Januari', 'Februari', 'Maret','April','Juni','Juli','Agustus','September','Oktober','November','Desember']
        },
        yAxis: {
            title: {
                text: 'Dalam Juta Rupiah'
            }
        },
        series: [{
            name: 'DONASI',
            data: <?php echo json_encode($donasi); ?>
        }, {
            name: 'PENGELUARAN',
            data: <?php echo json_encode($pengeluaran); ?>
        }]
    });
});
</script>
<div id="container" class="container" style="width:100%; height:500px;"></div>