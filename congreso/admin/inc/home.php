<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-briefcase fa-fw"></i> USUARIOS INSCRIPTOS
			</div>
			<?php if (!isset($_GET["inscripto"])) {
			?>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<th>Inscripción</th>
									<th>Tipo</th>
									<th>Empresa</th>
									<th>Nombre</th>
									<th>Localidad</th>
									<th>Provincia</th>
									<th>Teléfono</th>
									<th></th>
								</thead>
								<tbody>
									<?php
									Inscriptos_Read("");
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php } else {
				$data = Ver_Inscripto($_GET["inscripto"]);
				@$date = date_create($data["EmsionInscripcion"]);

				echo "
				<h4 style='padding-left:30px'>	Los datos del inscripto son los siguientes:<br/></h4>
				<p style='padding-left:30px'>
				<b>Tipo: </b>" . strtoupper($data["TipoInscripcion"]) . "<br/>";

				if($data["TipoInscripcion"] == "empresa") {
				echo "<br/><b>Empresa: </b>" .  strtoupper($data["EmpresaInscripcion"]) . "<br/>
				<b>Cargo/Puesto: </b>" .  strtoupper($data["CargoInscripcion"]) . "<br/><br/>";
				}

				echo "
				<b>Nombre: </b>" . strtoupper($data["NombreInscripcion"] ." ".$data["ApellidoInscripcion"]). "<br/>
				<b>Localidad: </b>" .  strtoupper($data["LocalidadInscripcion"]) . "<br/>
				<b>Provincia: </b>" .  strtoupper($data["ProvinciaInscripcion"]) . "<br/>
				<b>Teléfono: </b>" . $data["TelefonoInscripcion"] . "<br/>
				<b>Celular: </b>" . $data["CelularInscripcion"] . "<br/>
				<b>Email: </b>" . $data["EmailInscripcion"] . "<br/></p>
				<br/>
				<a href='../" . $data["InvitacionInscripcion"]  . "' target='_blank' style='margin-left:30px;padding:10px; text-decoration:none;background:#CA1717;color:#FFF'>VER FORMULARIO DE INSCRIPCIÓN</a>
				<br/><br/>
				</p>";
				}
			?>
		</div>
	</div>
</div>

<?php
if (isset($_GET["id"])) {
	$sql = "UPDATE `inscripcion_congreso` SET `EstadoInscripcion` = " . $_GET["upd"] . " WHERE `IdInscripcion` = " . $_GET["id"];
	$link = Conectarse();
	$r = mysqli_query($link,$sql);
	header("location: index.php");
}
?>

<?php
if (isset($_GET["elim"])) {
	$sql = "DELETE FROM `inscripcion_congreso` WHERE `IdInscripcion` = " . $_GET["elim"];
	$link = Conectarse();
	$r = mysqli_query($link,$sql);
	header("location: index.php");
}
?>