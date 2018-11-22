<div class="col-lg-12">
	<h4>Eventos</h4>
	<hr/>
	<table class="table  table-bordered table-striped">
		<thead>
			<th>Id</th>
			<th>Nombre y Apellido</th>
			<th>Email</th>
			<th>Teléfono</th>
			<th>Empresa</th>
			<th style="text-align: center;"><i class="fa fa-times-circle" aria-hidden="true"></i></th>
		</thead>
		<tbody>
			<?php
			Evento_Read();
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
			$estado = isset($_GET["estado"]) ? $_GET["estado"] : '';
			$id = isset($_GET["id"]) ? $_GET["id"] : '';

			if ($borrar != '') {
				$sql = "DELETE FROM `evento` WHERE `id_evento` = '$borrar'";
				$link = Conectarse();
				$r = mysqli_query($link,$sql);
				header("location: index.php?op=verEvento");
			}
			?>
		</tbody>
	</table>
</div>

