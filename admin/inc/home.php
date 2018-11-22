 
<div class="col-lg-12">
	<h4>Productos</h4>
	<hr/>
	<table class="table  table-bordered table-striped">
		<thead>
			<th>Id</th>
			<th width="50%">Título</th>
			<th>Categoría</th>
			<th>Ajustes</th>
		</thead>
		<tbody>
			<?php
			Portfolio_Read();
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';

			if ($borrar != '') {
				$sql = "DELETE FROM `portfolio` WHERE `id_portfolio` = '$borrar'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verPortfolio");
			}
			?>
		</tbody>
	</table>
</div>

<div class="col-lg-12">
	<hr/>
	<div>
		Iconografía
		<a href="#" data-toggle="tooltip" alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog" style="width: 20px"></i></a>
		<a href="#" data-toggle="tooltip" alt="Borrar" title="Borrar"><i class="glyphicon glyphicon-trash" style="width: 20px"></i></a>
	</div>
	<hr/>
</div>
</div>
