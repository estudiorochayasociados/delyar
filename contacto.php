<?php
session_start();
ob_start(); 
?>
 <!DOCTYPE html>
<html lang="es">
 <head>
 	<?php include("inc/header.inc.php"); 
	$title = TITULO;
	$keywords = "agropecuario, veterinaria, campo, san francisco, semillas, contacto";
	$description = "Contactanos por cualquier consulta a través de nuestro teléfono, email, o formulario de contacto web.";
	$imagen = LOGO;
	?>
	<title>Contacto | <?php echo $title; ?></title>
	<meta http-equiv="title" content="<?php echo $title; ?>" />
	<meta name="description" lang=es content="<?php echo $description; ?>" />
	<meta name="keywords" lang=es content="<?php echo $keywords; ?>" />
	<link href="<?php echo $imagen ?>" rel="Shortcut Icon" />
	<meta name="DC.title" content="<?php echo $title; ?>" />
	<meta name="DC.subject" content="<?php echo $description; ?>" />
	<meta name="DC.description" content="<?php echo $description; ?>" />

	<meta property="og:title" content="<?php echo $title; ?>" />
	<meta property="og:description" content="<?php echo $description; ?>" />
	<meta property="og:image" content="<?php echo $imagen ?>" />
 </head>
 <body>
 	<div class="navbar-fixed nav2">
 		<?php include("inc/nav.inc.php"); ?> 		
 	</div>
 	<div class=" encabezado wow fadeInUp">
 		<div class="container">
 			<div>
 				<h1><i class="material-icons">label_outline</i> Contacto</h1>
 			</div>
 		</div>
 	</div>
 	<div class="cuerpoContenedor"> 		
 			<div class="container">
 				<div class="col col-md-6   col-xs-12 wow fadeInLeft">
 					<div class="row">
 						<form class="col col-xs-12" method="post">
 							<?php
 							if(isset($_POST["finalizar"])) {
 								$nombre = $_POST["nombre"];
 								$apellido = $_POST["apellido"];
 								$email = $_POST["email"]; 
 								$asunto = "Mensaje de contacto del Sitio Web";
 								$mensaje = $_POST["mensaje"];

 								$provincia = '';
 								$localidad = '';
 								$celular = '';

 								$cuerpo = "Gracias por mandarnos un nuevo mensaje desde nuestra web:<br/>";
 								$cuerpo .= "<b>Nombre: </b>".$nombre." ".$apellido ."<br/>";
 								$cuerpo .= "<b>Email: </b>".$email."<br/>"; 
 								$cuerpo .= "<b>Mensaje: </b>".$mensaje."<br/>";

 								$cuerpoA = "Recibimos un nuevo mensaje desde la web:<br/>";
 								$cuerpoA .= "<b>Nombre: </b>".$nombre." ".$apellido ."<br/>";
 								$cuerpoA .= "<b>Email: </b>".$email."<br/>";     
 								$cuerpoA .= "<b>Mensaje: </b>".$mensaje."<br/>";

 								Agregar_Cuenta($nombre." ".$apellido,$email,$provincia,$localidad,$celular);

 								$receptor = $email;
 								$receptorAdmin = "administracion@delyar.com.ar";

 								@Enviar_User($asunto,$cuerpo,$receptor);
 								@Enviar_User_Admin($asunto,$cuerpoA,$receptorAdmin);
 							}
 							?>
 							<div class="row">
 								<div class="input-field col col-xs-6">
 									<label for="nombre">Nombre</label>
 									<input id="nombre" name="nombre" type="text" class="form-control">
 								</div>
 								<div class="input-field col col-xs-6">
 									<label for="apellido">Apellido</label>
 									<input id="apellido" name="apellido" type="text" class="form-control">
 								</div>
 							</div>  
 							<div class="row">
 								<div class="input-field col col-xs-12">
 									<label for="email">Email</label>
 									<input id="email" name="email" type="email" class="form-control">
 								</div>
 							</div>
 							<div class="row">
 								<div class="input-field col col-xs-12">
 									<label for="textarea1">Mensaje</label>
 									<textarea id="textarea1" name="mensaje" class="form-control"></textarea>
 								</div>
 								<div class="input-field col col-xs-12">
 									<br/><input type="submit" class="btn btn-info waves-effect waves-light green" name="finalizar" value="Enviar Mensaje" />
 								</div>
 							</div>
 						</form>
 					</div>

 				</div>
 				<div class="col col-md-6  col-xs-12 wow fadeInLeft">
 					<br class="hidden-md hidden-lg hidden-sm" />
 					<i class="material-icons">location_on</i>  <span class="direccion">CASA CENTRAL: Bv Roca 3103, San Francisco, Córdoba</span><br/>
 					<i class="material-icons">location_on</i> <span class="direccion">DEPÓSITO PARQUE INDUSTRIAL: Juan Venier esq. Finazzi, San Francisco, Córdoba</span><br/>
 					<i class="material-icons">location_on</i> <span class="direccion">DEPÓSITO PARQUE INDUSTRIAL: Calle 6 nº 861, Sunchales, Santa Fe</span><br/>
 					<br/>
 					<i class="material-icons">perm_phone_msg</i> 
 					<span class="direccion">  03564 427633 / 437047 / 436226</span>
 					<br/>
 					<i class="material-icons">email</i> 
 					<span class="direccion">  administracion@delyar.com.ar</span>
 					<br/><br/>
 					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13618.798637225766!2d-62.099327!3d-31.4224!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xedfc14226737ec14!2sDelyar+Sa!5e0!3m2!1ses!2sar!4v1472500091503"   frameborder="0" style="border:0;width:100%;height:300px"></iframe>
 				</div>
 			</div>
 	</div>
 	<?php include("inc/footer.inc.php"); ?>

 </body>
 </html>