<?PHP
if (isset($_GET['nrv'])) {
	$val = intval($_GET['nrv']);
	if ($val < 1) $val = 10;
	if ($val > 50) $val = 50;
} else {
	$val = 10;
}
if (isset($_GET['pag'])) {
	$pag = intval($_GET['pag'])*$val;
	if ($pag == 0) $pag = 10;
} else {
	$pag = 10;
}
$linee = file("datilog.txt");
foreach($linee as $line)
{
   $nr++;
   if ($nr <= $pag && $nr > $pag-$val-1) $numero++;
   list($dat[$numero],$umi[$numero],$tem[$numero]) = explode("|", $line);
 }
if ($numero > $val) $numero = $val;
$pp = $nr/$val;
if ($pp-intval($pp) != 0) {
	$pp = intval($pp)+1;
} else {
	$pp = intval($pp);
}
if (($pag/$val) > $pp) {
	$pag = $pp*$val;
	echo '<meta http-equiv="refresh" content="0; url=?pag='.($pag/$val).'&nrv='.$val.'">';
}
?>
