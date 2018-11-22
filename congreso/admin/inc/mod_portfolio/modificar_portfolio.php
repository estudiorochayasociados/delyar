<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != '') {
	$data = Portfolio_TraerPorId($id);
	$titulo = isset($data["nombre_portfolio"]) ? $data["nombre_portfolio"] : '';
	$img = isset($data["imagen_portfolio"]) ? $data["imagen_portfolio"] : '';
}

if (isset($_POST['agregar'])) {
	if ($_POST["titulo"] != '') {
		$titulo = $_POST["titulo"];

		$imgInicio = "";
		$destinoImg = "";
		$prefijo = substr(md5(uniqid(rand())), 0, 6);
		$imgInicio = $_FILES["img"]["tmp_name"];
		$tucadena = $_FILES["img"]["name"];
		$partes = explode(".", $tucadena);
		$dominio = $partes[1];

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
			UPDATE `portfolio` 
			SET 			
			`nombre_portfolio`= '$titulo',						
			`imagen_portfolio`='$destinoImg'						
			WHERE `id_portfolio`= $id";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verPortfolio");
	}
}
?>
<div class="large-12 columns">

	<h4>Modificar Portfolio</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<div class="columns" >
			<label>Título:
				<br/><br/>
				<input type="text" name="titulo" value="<?php echo $data["nombre_portfolio"]; ?>">
			</label>		
			<div class="clearfix">&zwnj;</div>		
				<label>
					<?php if($img === '') { ?>
					<input type="file" name="img" />
					<?php }else { ?> 
						<div style="width:300px;overflow: hidden">
							<br/><label>Imágen<br/><br/><img src="../<?php echo $img ?>" width="100%"; ></label><br/>
							<p onclick="">&rarr; Cambiar</p>	
						</div>
						<div id="imgDiv" style="display:none">
							<input type="file" name="img" id="img2" />
						</div>
						
					<?php } ?>
				</label>
				<label>
					<input type="submit" class="button left" name="agregar" value="Modificar Imágen" />
				</label>
			</div>
		</div>
	</form>
</div>
