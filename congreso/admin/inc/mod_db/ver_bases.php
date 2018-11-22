<div class="row">
	<center>
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-briefcase fa-fw"></i> SOCIOS INSCRIPTOS
				</div>
				<div class="panel-body">
					<div class="row">
						<?php
						$data = TraerDatos_DB("inscripcion");
						echo "<h1 style='font-size:50px;text-align:center'>$data[0] </h1>";
						?>
						<h3>socios registrados</h3>
						<br/>
						<a href="index.php?op=verBases&bajar=inscripcion" class="btn btn-success btn-lg">1) ARMAR ARCHIVO DE SOCIOS</a>
						<br/>
						<br/>
						<a href="index.php?op=verInscriptosS" class="btn  btn-default btn-lg">2) VER DATOS DE USUARIOS</a>
					</div>
				</div>
			</div>
		</div>
	</center>
</div>

<?php

if (isset($_GET["bajar"])) {
	include ("../fpdf/fpdf.php");
	switch($_GET["bajar"]) {
		case "inscripcion" :
			$sql = "SELECT `NombreInscripcion`,`ApellidoInscripcion`,`TipoInscripcion`,`EmpresaInscripcion`,`CargoInscripcion`,`CodInscripcion`FROM `inscripcion` ORDER BY NombreInscripcion ASC";
			$link = Conectarse();
			$result = mysql_query($sql, $link);

			$ar = fopen("../dbEx/socios.csv", "w+") or die("Problemas en la creacion");
			$i = 1;

			while ($row = mysql_fetch_array($result)) {
				fputs($ar, $i++ . ") " . iconv('UTF-8', 'windows-1252', strtoupper($row['0'])." ".strtoupper($row['1'])) . "  -  " . 
				iconv('UTF-8', 'windows-1252', strtoupper($row['2'])) . "  -  " . iconv('UTF-8', 'windows-1252', strtoupper($row['3'])) . "  -  " . 
				iconv('UTF-8', 'windows-1252', strtoupper($row['4'])). "  -  " . iconv('UTF-8', 'windows-1252', strtoupper($row['5'])
				));
				fputs($ar, "\n");
			}

			fclose($ar);

			echo "
			<div class='clearfix'></div>
			<center class='col-lg-6'>
			<h1>¡AHORA!</h1>
			<a href='../dbEx/socios.csv' target='_blank' class='btn btn-success btn-lg btn-block'>DESCARGAR ARCHIVO BASE SOCIOS</a>
			</center>";
			break;
	}
}
?>