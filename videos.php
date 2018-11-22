<?php
session_start();
ob_start(); 
?>
 <!DOCTYPE html>
<html lang="es">
 <head>
 	<?php include("inc/header.inc.php"); 
	$title = TITULO;
	$keywords = "videos, agropecuario, veterinaria, campo, san francisco, semillas";
	$description = "Videos informativos acerca de nuestra empresa y el mundo agropecuario.";
	$imagen = LOGO;
	?>
	<title>Videos | <?php echo $title; ?></title>
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
 				<h1><i class="material-icons">label_outline</i> videos</h1>
 			</div>
 		</div>
 	</div>
 	<div class="cuerpoContenedor">		
 			<div class="container">  
 				<?php Videos_Read_Front(); ?>
 			</div>

 	</div>
 	<?php include("inc/footer.inc.php"); ?>

 </body>
 </html>