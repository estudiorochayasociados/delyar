<style>
	label, label input {
		font-weight: normal;
		text-align: center;
	}

	label:hover {
		opacity: 1 !important;
	}

	input {
		padding: 10px;
	}
</style>

<?php
$dis = "block";
if (isset($_POST["enviar"])) {
	if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["localidad"]) && !empty($_POST["provincia"]) && !empty($_POST["telefono"]) && !empty($_POST["email"])) {
		include ('fpdf/fpdf.php');
		
		$empresa = isset($_POST["empresa"]) ? $_POST["empresa"] : '';
		$cargo = isset($_POST["cargo"]) ? $_POST["cargo"] : '';
		$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
		$apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : '';
		$localidad = isset($_POST["localidad"]) ? $_POST["localidad"] : '';
		$provincia = isset($_POST["provincia"]) ? $_POST["provincia"] : '';
		$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : '';
		$celular = isset($_POST["celular"]) ? $_POST["celular"] : '';
		$email = isset($_POST["email"]) ? $_POST["email"] : '';
		$cat = isset($_GET["cat"]) ? $_GET["cat"] : '';

		$cod = rand(0, 1000) . "-" . rand(0, 100);
		$archivo = "invitaciones/".$cod.".pdf";

		$catF = iconv('UTF-8', 'windows-1252', strtoupper($cat));
		$nombreF = iconv('UTF-8', 'windows-1252', strtoupper($nombre)) . " " . iconv('UTF-8', 'windows-1252', strtoupper($apellido));		

		$pdf = new FPDF();
		$pdf -> AddPage();
		$pdf -> SetFont('Arial', '', 9);
		//inserto la cabecera poniendo una imagen dentro de una celda
		$pdf -> SetMargins(110, -100);		
		$pdf -> Cell(700, 85, $pdf -> Image('img/invitacion.jpg', 30, 12, 160), 0, 0, 'C');
		$pdf -> Ln(35);
		$pdf -> Cell(40, 12, date('d/m/Y'), 0, "L");
		$pdf -> Cell(60, 12, $cod, 0, "R");
		$pdf -> Ln(7);
		$pdf -> Cell(100, 12, "Nombre : " . $nombreF);
		$pdf -> Ln(7);
		$pdf -> Cell(100, 12, "Tipo: ".$catF);
		$pdf -> Ln(7);

		$pdf -> SetFont('Arial', '', 8);
		$pdf -> Output($archivo);
		

		$con = Conectarse();
		$sql = "
		INSERT INTO `inscripcion_congreso`
		(`NombreInscripcion`, `ApellidoInscripcion`, `LocalidadInscripcion`, `ProvinciaInscripcion`, `TelefonoInscripcion`, `CelularInscripcion`, `EmailInscripcion`, `EmpresaInscripcion`, `CargoInscripcion`, `TipoInscripcion`, `CodInscripcion`, `InvitacionInscripcion`,`FechaInscripcion`)
		VALUES
		('$nombre', '$apellido', '$localidad', '$provincia', '$telefono', '$celular','$email','$empresa','$cargo','$cat','$cod','$archivo',NOW())
		";

		$resultado = mysqli_query($con,$sql);

		if($resultado){
			echo "<span class='alert alert-success ' style='display:block;'><h3>¡Felicitaciones $nombre!</h3>Te inscribiste perfectamente, a continuación te dejamos la entrada para presentar en el ingreso del evento.<br>
			<a href='".$archivo."' target='_blank' class='btn'>IMPRIMIR INVITACIÓN</a><br/>
			Te recordamos que esta entrada también fue enviada por email al correo que acabas de registrar.<br/> Muchas Gracias.</span>";
			echo "<div class='clearfix'></div>";
			
			$asunto = "¡Tu inscripción fue exitosa!";
			$asunto_a = "¡Hay un nuevo inscripto!";
			$mensaje = "
			<br/>La inscripción se cargó exitosamente.<br/>
			Te recordamos la locación y horario del evento:<br/>
			<b>El jueves 26 de julio realizaremos en el Salón Rosado de la Sociedad Rural de San Francisco, el Cuarto Congreso Anual DELYAR S.A. SOJA MAÍZ. <br/></b> 
			<br/><br/><br/>		
			<a href='http://delyar.com.ar/congreso/" . $archivo . "' style='padding:10px; text-decoration:none;background:#336AB1;color:#FFF'>VER INVITACIÓN DE INSCRIPCIÓN</a>				
			<br/><br/><br/><br/>	
			Muchas gracias<br/>";
			$mensaje_a = "
			<br/>Hay un nuevo inscripto y se cargó exitosamente.<br/>Los datos del inscripto son los siguientes:<br/>
			<br/>
			<p style='padding-left:30px'>
				<b>Tipo: </b>" . strtoupper($cat) . "<br/>
				<b>Nombre: </b>" . strtoupper($nombre ." ".$apellido). "<br/>
				<b>Localidad: </b>" .  strtoupper($localidad) . "<br/>
				<b>Provincia: </b>" .  strtoupper($provincia) . "<br/>
				<b>Teléfono: </b>" . $telefono . "<br/>
				<b>Celular: </b>" . $celular . "<br/>
				<b>Email: </b>" . $email . "<br/></p>
				<br/>
				<a href='http://delyar.com.ar/congreso/" . $archivo  . "' target='_blank' style='margin-left:30px;padding:10px; text-decoration:none;background:#336AB1;color:#FFF'>VER FORMULARIO DE INSCRIPCIÓN</a>
				<br/><br/>
			</p><br/><br/>			

			Muchas gracias<br/>";

			$email_a = "emorcos@delyar.com.ar";
			//$developer = "facundo@estudiorochayasoc.com.ar";

			Enviar_User($asunto, $mensaje, $email);
			Enviar_User_Admin($asunto_a, $mensaje_a, $email_a);

			$dis = "none";
		} else {
			echo "<span class='alert alert-danger ' style='display:block;'><h3>¡Lo sentimos $nombre!</h3>
			Ha ocurrido un error en la subida de los datos, necesitariamos que se vuelva a registrar y recuerde que se necesitan todos los campos completos para poder seguir.<br/>Muchas Gracias.</span>";
			$dis = "block";
		}
		
	}
}
?>

<div id="cargando" style="background: rgba(255,255,255,0.5);height:100vh;width: 100%;position: absolute;left:0;z-index: 999;display: none">
	<br/><br/><br/><br/><br/><br/><br/>
	<img src="img/logo.png" width="200" /><br/>
	<b>Cargando tu inscripción...</b>
</div>
<form method="post" style="display:<?php echo $dis ?>"  id="form" onsubmit="$('#submit').val('CARGANDO INSCRIPCIÓN...');$('#cargando').show()">
	<h1 style="font-weight: bold;color:#fff;text-shadow:0px 5px 5px #333">Inscripción para <br/>productores y profesionales</h1>
	<br/>
	<center class="col-lg-8 col-lg-offset-2">		
		<label class="col-lg-6 ">Nombre:
			<br/>
			<input type="text" name="nombre" placeholder="Nombre" value="<?php echo (isset($_POST["nombre"]) ? $_POST["nombre"] : '') ?>" style="width: 100%" required/>
		</label>
		<label class="col-lg-6 ">Apellido:
			<br/>
			<input type="text" name="apellido" placeholder="Apellido" value="<?php echo (isset($_POST["apellido"]) ? $_POST["apellido"] : '') ?>" style="width: 100%" required/>
		</label>
		<label class="col-lg-6 ">Localidad:
			<br/>
			<input type="text" name="localidad" placeholder="Localidad" value="<?php echo (isset($_POST["localidad"]) ? $_POST["localidad"] : '') ?>" style="width: 100%" required/>
		</label>
		<label class="col-lg-6 ">Provincia:
			<br/>
			<input type="text" name="provincia" placeholder="Provincia" value="<?php echo (isset($_POST["provincia"]) ? $_POST["provincia"] : '') ?>" style="width: 100%" required/>
		</label>
		<label class="col-lg-6 ">Teléfono:
			<br/>
			<input type="text" name="telefono" placeholder="Teléfono" value="<?php echo (isset($_POST["telefono"]) ? $_POST["telefono"] : '') ?>" style="width: 100%" required />
		</label>
		<label class="col-lg-6 ">Celular:
			<br/>
			<input type="text" name="celular" placeholder="Celular" value="<?php echo (isset($_POST["celular"]) ? $_POST["celular"] : '') ?>" style="width: 100%" />
		</label>
		<label class="col-lg-12 ">Correo Electrónico:
			<br/>
			<input type="email" name="email" placeholder="E-mail" value="<?php echo (isset($_POST["email"]) ? $_POST["email"] : '') ?>" style="width: 100%" required />
		</label>
		<label class="col-lg-12 ">
			<br/>
			<input type="submit" name="enviar" class="btn btn-primary" id="submit" value="INSCRIBIRME" style="width: 100%" />
		</label>
	</center>
</form>
