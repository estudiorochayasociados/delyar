<div class="large-12 columns">
	<h3>Usuarios</h3>
	<hr/>
	<table width="100%">
		<thead>
			<th>Agencia</th>
			<th>Email</th>			
			<th style="text-align: right">Ajustes</th>
		</thead>
		<tbody>
			<?php
			Usuarios_Read_Admin();
			
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
			
			if ($borrar != '') {
				$sql = "DELETE FROM `usuarios` WHERE `id` = '$borrar'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verUsuarios");
			}
			?>
		</tbody>
	</table>
</div>
