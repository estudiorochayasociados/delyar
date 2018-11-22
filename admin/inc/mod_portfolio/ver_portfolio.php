<div class="col-lg-12">
	<h4>Productos</h4>
	<hr/>
	<table class="table  table-bordered table-striped">
		<thead>
			<th>Cod</th>
			<th width="60%">Título</th>
			<th>Categoría</th>
			<th>Estado</th>
			<th>Ajustes</th>
		</thead>
		<tbody>
			<?php
			Portfolio_Read();
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
			$estado = isset($_GET["estado"]) ? $_GET["estado"] : '';
			$id = isset($_GET["id"]) ? $_GET["id"] : '';

			if ($borrar != '') {
				$sql = "DELETE FROM `portfolio` WHERE `id_portfolio` = '$borrar'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verPortfolio");
			}

			if ($estado != '') {
				$sql = "UPDATE `portfolio` SET 	`estado_portfolio`= '$estado' WHERE `id_portfolio` = '$id'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verPortfolio");
			}
			?>
		</tbody>
	</table>
</div>

