<?php
session_start();
ob_start(); 
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<?php include("inc/header.inc.php"); ?>
 </head>
 <body>
 	<div class="navbar-fixed nav2">
 		<?php include("inc/nav.inc.php"); ?> 		
 	</div>
 	<div class="row encabezado wow fadeInUp">
 		<div class="container">
 			<div>
 				<h1>      <i class="material-icons">label_outline</i> ingreso clientes</h1>
 			</div>
 		</div>
 	</div>
 	<div class="cuerpoContenedor">
 		<div class="row "> 		
 			<div class="container"> 
					<iframe src="http://www.everweari.com.ar/login.aspx?ReturnUrl=%2fBienvenido.aspx" width="100%" style="min-height: 600px; max-height:700px;height:100%;border:none;"></iframe>
 			</div>
 		</div>
 	</div>
 	<?php include("inc/footer.inc.php"); ?>

 </body>
 </html>