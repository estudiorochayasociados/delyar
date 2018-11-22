<?php
session_start();
ob_start(); 
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<?php include("PHPMailer/class.phpmailer.php"); ?>
 	<?php include("inc/header.inc.php"); ?>
 </head>
 <body>
 	<div class="navbar-fixed nav2">
 		<?php include("inc/nav.inc.php"); ?> 		
 	</div>
 	<div class="row encabezado wow fadeInUp">
 		<div class="container">
 			<div>
 				<h1><i class="material-icons">label_outline</i> Inscripción a Evento</h1>
 			</div>
 		</div>
 	</div>
 	<div class="cuerpoContenedor">
 		<div class="row "> 		
 			<div class="container">
 				<div class="col l2 col-md-4   col-xs-12 wow fadeInLeft" style="text-align: center;">
 					<img src="img/bayer.png" width="100px" />
 				</div>
 				<div class="col l10 col-md-8   col-xs-12 wow fadeInLeft">
 					<h4>Nuevo producto de Bayer FAGOLAC</h4><br/>
 				</div>
 				<div class="col col-md-12   col-xs-12 wow fadeInLeft">
 					<h5>Fecha y Hora: <b>25 de Junio 19:00hs en Salón Auditorio</b></h5>
 				</div>

 				<div class="col col-md-12   col-xs-12 wow fadeInLeft">
 					<div class="row">
 						<form class="col col-xs-12" method="post">
 							<?php
 							if(isset($_POST["finalizar"])) {
 								$nombre= antihack_mysqli(isset($_POST["nombre"]) ? $_POST["nombre"] : '');
 								$apellido = antihack_mysqli(isset($_POST["apellido"]) ? $_POST["apellido"] : '');
 								$email = antihack_mysqli(isset($_POST["email"]) ? $_POST["email"] : ''); 
 								$telefono = antihack_mysqli(isset($_POST["telefono"]) ? $_POST["telefono"] : ''); 
 								$empresa = antihack_mysqli(isset($_POST["empresa"]) ? $_POST["empresa"] : ''); 
 								$asunto = "Inscripción a evento";

 								$cuerpo = "¡Ya estás inscripto/a!:<br/>Nuevo producto Bayer FAGOLAC<br/>25 de Junio 19:00hs en Salón Auditorio.<br/><br/>";
 								$cuerpo .= "<b>Nombre: </b>".$nombre." ".$apellido ."<br/>";
 								$cuerpo .= "<b>Email: </b>".$email."<br/>"; 
 								$cuerpo .= "<b>Teléfono: </b>".$telefono."<br/>"; 
 								$cuerpo .= "<b>Empresa: </b>".$empresa."<br/>"; 

 								$cuerpoA = "Rcibimos una nueva inscripción al evento desde la web:<br/>";
 								$cuerpoA .= "<b>Nombre: </b>".$nombre." ".$apellido ."<br/>";
 								$cuerpoA .= "<b>Email: </b>".$email."<br/>";     

 								$receptor = $email;
 								$receptorAdmin = "administracion@delyar.com.ar";

 								$verificacion = (Verificar_Evento($email));

 								if($verificacion == 0) {
 									@Enviar_User($asunto,$cuerpo,$receptor);
 									@Enviar_User_Admin($asunto,$cuerpoA,$receptorAdmin);

 									$sql = "INSERT INTO `evento`(`nombre_evento`, `apellido_evento`, `email_evento`, `telefono_evento`, `empresa_evento`) VALUES ('$nombre','$apellido','$email','$telefono','$empresa')";
 									$link = Conectarse();
 									$r = mysqli_query($link,$sql);

 									echo '<div class="alert alert-danger" role="alert">¡Te has inscripto correctamente!</div>';
 								} else {
 									echo '<div class="alert alert-danger" role="alert">¡Error! Ya estás inscripto.</div>';
 								}
 							}
 							?>
 							<div class="row">
 								<div class="input-field col col-md-6 col-xs-12">
 									<label for="nombre">Nombre</label>
 									<input id="nombre" name="nombre" type="text" class="form-control"> 									
 								</div>
 								<div class="input-field col col-md-6 col-xs-12">
 									<label for="apellido">Apellido</label>
 									<input id="apellido" name="apellido" type="text" class="form-control"> 									
 								</div>
 							</div>  
 							<div class="row">
 								<div class="input-field col col-md-6 col-xs-12">
 									<label for="email">Email</label>
 									<input id="email" name="email" type="email" class="form-control"> 									
 								</div>
 								<div class="input-field col col-md-6 col-xs-12">
 									<label for="telefono">Teléfono</label>
 									<input id="telefono" name="telefono" type="text" class="form-control"> 									
 								</div>
 							</div>
 							<div class="row">
 								<div class="input-field col col-md-12 col-xs-12">
 									<label for="empresa">Empresa</label>
 									<input id="empresa" name="empresa" type="text" class="form-control"> 									
 								</div>
 							</div>
 							<div class="row">
 								<div class="input-field col col-md-12 col-xs-12">
 									<input type="submit" class="btn waves-effect waves-light green" name="finalizar" value="Inscribirse" />
 								</div>
 							</div>
 						</form>
 					</div>

 				</div>
 			</div>
 		</div>
 	</div>
 	<?php include("inc/footer.inc.php"); ?>

 </body>
 </html>