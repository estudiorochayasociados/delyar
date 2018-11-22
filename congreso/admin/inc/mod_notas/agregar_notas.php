<?php
$random = rand(0, 10000000);
if (isset($_POST["agregar"])) {
	if ($_POST["titulo"] != '' && $_POST["desarrollo"]) {
		$imgInicio = "";
		$destinoImg = "";
		$prefijo = substr(md5(uniqid(rand())), 0, 6);
		$imgInicio = $_FILES["img"]["tmp_name"];
		$tucadena = $_FILES["img"]["name"];
		$partes = explode(".", $tucadena);
		$dominio = $partes[1];

		if ($dominio != '') {
			$destinoImg = "archivos/notas/" . $prefijo . "." . $dominio;
			$destinoFinal = "../archivos/notas/" . $prefijo . "." . $dominio;
			move_uploaded_file($imgInicio, $destinoFinal);
			chmod($destinoImg, 0777);
		} else {
			$destinoImg = $img;
		}

		$titulo = $_POST["titulo"];
		$desarrollo = $_POST["desarrollo"];
		$cita = $_POST["cita"];
		$sql = "
			INSERT INTO `notabase`
			(`TituloNotas`, `DesarrolloNotas`, `ImgPortadaNotas`, `CitaNotas`, `FechaNotas`)
			VALUES ('$titulo','$desarrollo','$destinoImg', '$cita', NOW())";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verNotas");
	} else {
		echo "<br/><center><span class='large-11 button' style='background:#872F30'>* Todos los datos son obligatorios</span></center>";
	}
}
?>

<div class="columns">

	<h4>Agregar Novedades</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">

		<label class="large-12">Título:
			<br/>
			<input type="text" name="titulo" value="">
		</label>

		<label class="large-12">Desarrollo:
			<br/>
			<textarea name="desarrollo" style="height:300px;display:block"></textarea>
			<script>
				CKEDITOR.replace('desarrollo');
			</script> </label>
		<br/>
		<label class="large-12">Cita:
			<br/>
			<input type="text" name="cita" value="">
		</label>

		<label class="large-12">Imagen:
			<br/>
			<br/>
			<input type="file" name="img" />
		</label>

		<label class="columns">
			<input type="submit" class="button right" name="agregar" value="Crear Novedad" />
		</label>
	</form>
</div>