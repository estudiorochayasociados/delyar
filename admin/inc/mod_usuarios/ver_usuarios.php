<div class="col-lg-12 col-md-12">
	<h4  style="float:left;">Usuarios</h4>
	
	<div class="clearfix"></div>
	<hr/>
	<table class="table  table-bordered  ">
		<thead>
 			<th>Nombre</th>
			<th>Email</th>
			<th>Activo</th>
			<th>Lista</th>					
			<th style="text-align: right">Ajustes</th>
		</thead>
		<tbody>
			<?php
			Usuarios_Read_Admin();
			
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
			
			if ($borrar != '') {
				$sql = "DELETE FROM `usuarios` WHERE `id` = '$borrar'";
				$link = Conectarse();
				$r = mysqli_query($link,$sql);
				header("location: index.php?op=verUsuarios");
			}
			?>
		</tbody>
	</table>
</div>
