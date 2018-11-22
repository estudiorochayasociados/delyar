<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != '') {
	$data = Nota_TraerPorId($id);
	$titulo = isset($data["TituloNotas"]) ? $data["TituloNotas"] : '';
	$desarrollo = isset($data["DesarrolloNotas"]) ? $data["DesarrolloNotas"] : '';
	$img = isset($data["ImgPortadaNotas"]) ? $data["ImgPortadaNotas"] : '';
}

if (isset($_POST['agregar'])) {
	if ($_POST["titulo"] != '' && $_POST["desarrollo"] != '') {

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
			UPDATE `notabase` 
			SET 			
			`TituloNotas`= '$titulo',
			`DesarrolloNotas`='$desarrollo',
			`ImgPortadaNotas`='$destinoImg',
			`CitaNotas`='$cita'
			WHERE `IdNotas`= $id";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verNotas");
	}
}
?>

<div class="columns">

	<h4>Modificar &rarr; <?php echo $data["TituloNotas"]; ?></h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">

		<label>Título:
			<br/>
			<input type="text" name="titulo" value="<?php echo $data["TituloNotas"]; ?>">
		</label>
		<label >Desarrollo:
			<br/>
			<textarea name="desarrollo"><?php echo $data["DesarrolloNotas"]; ?></textarea>
			<script>
				CKEDITOR.replace('desarrollo');
			</script> </label>
		<label>Cita:
			<br/>
			<input type="text" name="cita" value="<?php echo $data["CitaNotas"]; ?>">
		</label>	
		<label> <?php if($img === '') {
			?>
			<input type="file" name="img" />
			<?php }else { ?>
			<div style="width:300px;overflow: hidden">
				<br/>
				<label>Imagen
					<br/>
					<br/>
					<img src="../<?php echo $img ?>" width="100%"; ></label>
				<br/>
				<p onclick="">
					&rarr; Cambiar
				</p>
			</div>
			<div id="imgDiv" style="display:none">
				<input type="file" name="img" id="img2" />
			</div> <?php } ?></label>
		<label>
			<input type="submit" class="button right" name="agregar" value="Modificar Nota" />
		</label>
</form>
</div>
