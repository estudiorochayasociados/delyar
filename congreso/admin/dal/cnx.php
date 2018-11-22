<?php

function Conectarse() {
	$connId = mysqli_connect("localhost","root","","delyar_website") or die("Error en el server".mysqli_error($con));
	mysqli_set_charset($connId,'utf8');
	return $connId;
}


function Conectarse_Mysqli() {
	$connId = mysqli_connect("localhost","root","","delyar_website") or die("Error en el server".mysqli_error($con));
	mysqli_set_charset($connId,'utf8');
	return $connId;
}



?>
