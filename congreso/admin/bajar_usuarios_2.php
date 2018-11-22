<meta charset="utf-8">
<table style="text-transform: uppercase !important">
<?php 
include("dal/cnx.php");

$archivo = 'congreso_resumen.csv';
$FileName = "./$archivo";

/*Descarga el archivo desde el navegador
header('Expires: 0');
header('Cache-control: private');
header('Content-Type: application/x-octet-stream'); // Archivo de Excel
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');
header('Last-Modified: '.date('D, d M Y H:i:s'));
header('Content-Disposition: attachment; filename="'.$archivo.'"');
header("Content-Transfer-Encoding: binary");
*/
$idConn = Conectarse();
$sql = "SELECT * FROM `inscripcion_congreso` ORDER BY ApellidoInscripcion ASC";
$resultado = mysqli_query($idConn,$sql);

while ($data = mysqli_fetch_array($resultado)) {
	echo "<tr>";
	echo "<td>".mb_strtoupper(htmlspecialchars($data["ApellidoInscripcion"]))." ".mb_strtoupper(htmlspecialchars($data["NombreInscripcion"]))."</td>";	
	echo "<td>".mb_strtoupper(htmlspecialchars($data["TipoInscripcion"]))." ".mb_strtoupper(htmlspecialchars($data["EmpresaInscripcion"]))."</td>";
	echo "</tr>";
}

?>
</table>