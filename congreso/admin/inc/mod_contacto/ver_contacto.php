<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-comment fa-fw"></i> Mensajes de Contacto
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<th>Fecha</th>
									<th>Nombre</th>
									<th>Email</th>
									<th>Teléfono</th>
									<th>Celular</th>
									<th>Mensaje</th>
									<th></th>
								</thead>
								<tbody>
									<?php
									Contacto_Read("inicio");
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_GET["borrar"])) {	
	$sql = "UPDATE `consultas_contacto` SET `estado_consulta` = ".$_GET["upd"]." WHERE `id_consulta` = ".$_GET["borrar"] ;
	$link = Conectarse();
	$r = mysql_query($sql, $link);
	header("location: index.php?op=verContacto");
}
?>