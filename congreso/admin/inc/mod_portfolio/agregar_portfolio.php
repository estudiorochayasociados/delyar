<?php
$random = rand(0, 10000000);
if (isset($_POST["agregar"])) {
	if ($_POST["titulo"] != '') {
		$titulo = $_POST["titulo"];

		$imgInicio = "";
		$destinoImg = "";
		$prefijo = substr(md5(uniqid(rand())), 0, 6);
		$imgInicio = $_FILES["img"]["tmp_name"];
		$tucadena = $_FILES["img"]["name"];
		$partes = explode(".", $tucadena);
		$dominio = $partes[1];

		if ($dominio != '') {
			$destinoImg = "archivos/portfolio/" . $prefijo . "." . $dominio;
			$destinoFinal = "../archivos/portfolio/" . $prefijo . "." . $dominio;
			move_uploaded_file($imgInicio, $destinoFinal);
			chmod($destinoImg, 0777);
		} else {
			$destinoImg = $img;
		}

		$sql = "
		INSERT INTO `portfolio`
		(`nombre_portfolio`, `imagen_portfolio`) 
		VALUES 
		('$titulo','$destinoImg')";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verPortfolio");
	} else {
		echo "<br/><center><span class='large-11 button' style='background:#872F30'>* Todos los datos son obligatorios</span></center>";
	}
}
?>

<div class="large-12 columns">
	<h4>Agregar imágen a galería</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<div class="row" >
			<label class="large-7 columns">Título:
				<br/>
				<input type="text" name="titulo" value="">
			</label>		
			<label class="large-5 columns">Imágen:<br/><br/>
				<input type="file" name="img" />
			</label>
			<div class="clearfix">&zwnj;</div>
			<label>
				<input type="submit" class="button right" name="agregar" value="Subir a Galería" style="margin-right:20px;"/>
			</label>
		</div>
	</form>
</div>
