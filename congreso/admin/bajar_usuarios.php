<?php 
include("dal/cnx.php");

$archivo = 'congreso_resumen.csv';
$FileName = "./$archivo";
$Datos = 'Nombre;Apellido;Localidad;Provincia;Telefono;Celular;Email;Empresa;Cargo;Tipo;Cod;Fecha';
$Datos .= "\r\n";

//Descarga el archivo desde el navegador
header('Expires: 0');
header('Cache-control: private');
header('Content-Type: application/x-octet-stream'); // Archivo de Excel
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');
header('Last-Modified: '.date('D, d M Y H:i:s'));
header('Content-Disposition: attachment; filename="'.$archivo.'"');
header("Content-Transfer-Encoding: binary");

$idConn = Conectarse();
$sql = "SELECT * FROM `inscripcion_congreso`";
$resultado = mysqli_query($idConn,$sql);

while ($data = mysqli_fetch_array($resultado)) {
	$Datos .=$data["NombreInscripcion"].";";
	$Datos .=$data["ApellidoInscripcion"].";";
	$Datos .=$data["LocalidadInscripcion"].";";
	$Datos .=$data["ProvinciaInscripcion"].";";
	$Datos .=$data["TelefonoInscripcion"].";";
	$Datos .=$data["CelularInscripcion"].";";
	$Datos .=$data["EmailInscripcion"].";";
	$Datos .=$data["EmpresaInscripcion"].";";
	$Datos .=$data["CargoInscripcion"].";";
	$Datos .=$data["TipoInscripcion"].";";
	$Datos .=$data["CodInscripcion"].";";
	$Datos .=$data["FechaInscripcion"].";";
	$Datos .= "\r\n";
}

echo $Datos;
?>