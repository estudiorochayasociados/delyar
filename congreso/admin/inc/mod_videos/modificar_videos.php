<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != '') {
	$data = Video_TraerPorId($id);
	$titulo = isset($data["nombre_portfolio"]) ? $data["nombre_portfolio"] : '';
	$img = isset($data["imagen_portfolio"]) ? $data["imagen_portfolio"] : '';
}

if (isset($_POST['agregar'])) {
	if ($_POST["titulo"] != '' && $_POST["url"] != '') {
		$titulo = $_POST["titulo"];
		$url = $_POST["url"];

		$sql = "
			UPDATE `videos` 
			SET 			
			`TituloVideos`= '$titulo',						
			`UrlVideos`='$url'						
			WHERE `IdVideos`= $id";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verVideos");
	}
}
?>
<div class="clear">
	&zwnj;
</div>
<div class="clear">
	&zwnj;
</div>
<div class="large-12 columns">
	<br/>
	<h4>Modificar video</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<div class="columns" >
			<label class="large-6 columns">Título:
				<br/>
				<input type="text" name="titulo" value="<?php echo $data["TituloVideos"] ?>">
			</label>		
			<label class="large-6 columns">Url (https://www.youtube.com/watch?v=<b>OCBspLsKTjo</b>):
				<input type="text" name="url" value="<?php echo $data["UrlVideos"] ?>">
			</label>
			<div class="clearfix">&zwnj;</div>
			<label>
				<input type="submit" class="button right" name="agregar" value="Modificar Video" style="margin-right:20px;"/>
			</label>
			</div>
		</div>
	</form>
</div>
