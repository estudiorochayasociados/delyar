<?php
$random = rand(0, 10000000);
if (isset($_POST["agregar"])) {
	if ($_POST["titulo"] != '') {
		$titulo = $_POST["titulo"];
		$url = $_POST["url"];
	
		$sql = "
		INSERT INTO `videos`
		(`TituloVideos`, `UrlVideos`) 
		VALUES 
		('$titulo','$url')";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verVideos");
	} else {
		echo "<br/><center><span class='large-11 button' style='background:#872F30'>* Todos los datos son obligatorios</span></center>";
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
	<h4>Agregar Videos</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<div class="row" >
			<label class="large-6 columns">Título:
				<br/>
				<input type="text" name="titulo" value="">
			</label>		
			<label class="large-6 columns">Url (https://www.youtube.com/watch?v=<b>OCBspLsKTjo</b>):
				<input type="text" name="url" value="">
			</label>
			<div class="clearfix">&zwnj;</div>
			<label>
				<input type="submit" class="button right" name="agregar" value="Subir Video" style="margin-right:20px;"/>
			</label>
		</div>
	</form>
</div>
