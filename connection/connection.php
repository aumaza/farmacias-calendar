<?php

//$dbhost = 'slackzone.ddns.net'; // host de desarrollo
$dbhost = 'localhost'; // host de produccion
$dbuser = 'root'; // usuario
// $dbpass = 'slack142'; // password para servidor de desarrollo
$dbpass = 'proteo601'; // password para el servidor de produccion
$dbase = 'farmacia_calendar'; // nombre de la base de datos
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbase);


?>

