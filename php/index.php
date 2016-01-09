<?PHP
include ("data.php");
$umido = file_get_contents ("http://localhost/arduino/idro");
$tempe = file_get_contents ("http://localhost/arduino/termo");
?>
<HTML>
<HEAD>
<TITLE> Arduino YUN Pagina <?PHP echo $pag/$val; ?></TITLE>
<script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1');
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        var wrapper = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          dataTable: [['', <?PHP for($a = 1; $a < $numero; $a++) { echo "'".$dat[$a]."',"; } echo "'".$dat[$numero]."'"; ?> ],
                      ['', <?PHP for($a = 1; $a < $numero; $a++) { echo $tem[$a].","; } echo $tem[$numero]; ?> ]],
          options: {'temperatura': 'data'},
          containerId: 'temperatura'
        });
        wrapper.draw();
      }
      
      

      google.setOnLoadCallback(drawVisualization);
    </script>
    <script type="text/javascript">
      google.load('visualization', '1');
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        var wrapper = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          dataTable: [['', <?PHP for($a = 1; $a < $numero; $a++) { echo "'".$dat[$a]."',"; } echo "'".$dat[$numero]."'"; ?> ],
                      ['', <?PHP for($a = 1; $a < $numero; $a++) { echo $umi[$a].","; } echo $umi[$numero]; ?> ]],
          options: {'umidita': 'data'},
          containerId: 'umidita'
        });
        wrapper.draw();
      }
      
      

      google.setOnLoadCallback(drawVisualization);
    </script>
<script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['C', <?PHP echo $tempe; ?>],
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 40, redTo: 60,
          yellowFrom:30, yellowTo: 40,
          minorTicks: 5,
          max: 60
        };

        var chart = new google.visualization.Gauge(document.getElementById('tempe'));
        chart.draw(data, options);
      }
    </script>
<script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['%', <?PHP echo $umido; ?>]
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('umido'));
        chart.draw(data, options);
      }
    </script>
    
</HEAD>


<BODY>
<div align="center">
	<table border="0">

<tr><th align="center" colspan="2"><h1>Grafico Temperatura</h1></th></tr>

<tr><td align="right" width="55%"><h2>Temperatura attuale:</h2></td><td><div id='tempe'></div></td></tr>
<tr><th align="center" colspan="2"><div id="temperatura" style="width: 900px; height: 500px;"></div></th></tr>
<tr><th align="center" colspan="2"><h1>Grafico Umidita'</h1></th></tr>
<tr><td align="right" width="55%"><h2>Umidita' attuale:</h2></td><td><div id='umido'></div></td></tr>
<tr><th align="center" colspan="2"><div id="umidita" style="width: 900px; height: 500px;"></div></th></tr>
<tr><form id= "mioForm" action="index.php" method="get">
	<th align ="center">
Pagina: <select name="pag" onchange='this.form.submit()'> 
	<?PHP 
	for($a = 1; $a <= $pp ; $a++) {
		echo '<option value="'.$a.'"';
		if ($a == $pag/$val) echo ' selected';
		echo '>'.$a.'</option>';
	}
	?>
</select>
   Numero Valori: <select name="nrv" onchange='this.form.submit()'>
	<?PHP
	for($a =1; $a <= 50; $a++)  {
		echo '<option value="'.$a.'"';
		if ($a == $val) echo ' selected';
		echo '>'.$a.'</option>';
	}
	?>
</select>
   <noscript><input type="submit" value="Submit"></noscript></th>
</form>
	</table>
</div>
</BODY>
</HTML>
