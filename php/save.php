<?PHP
$umido = file_get_contents ("http://localhost/arduino/idro");
$tempe = file_get_contents ("http://localhost/arduino/termo");
date_default_timezone_set('UTC');
$save= date( 'd.M.Y H:i')."|".$umido."|".$tempe."\n";
$write_file = fopen("/mnt/sda1/php/datilog.txt","r+");
fwrite($write_file,$save);
fclose($write_file);
?> 
