<!DOCTYPE html>
<!-- saved from url=(0047)http://getbootstrap.com/examples/justified-nav/ -->
<html lang="en">
<script id="tinyhippos-injected">
	if (window.top.ripple) {
		window.top.ripple("bootstrap").inject(window, document);
	}
</script>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Delyar</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/justified-nav.css" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
	.jumbotron label:hover {

		opacity: 0.8;
	}
</style>

<?php include("../PHPMailer/class.phpmailer.php"); ?>

<?php include("admin/dal/data.php"); ?>

</head>

<body style="background-image:url('img/bkg.jpg');">
	<div class="container"  style="margin-top: 0;padding-top:0;background:rgba(255,255,255,0.5)">
		<div class="masthead">
			<div class="col-lg-12">
				<h3 class="text-muted text-center"><img src="img/logo.png" style="max-width: 400px;"></h3>
			</div>
			<div class="clearfix"></div>
			<ul class="nav nav-justified">
				<li>
					<a href="index.html">inicio</a>
				</li>
				<li class="active" >
					<a href="inscripcion.php">inscripciones</a>
				</li>
				<li>
					<a href="info.html">información</a>
				</li>
				<li>
					<a href="http://delyar.com.ar/contacto.php" target="_blank">contacto</a>
				</li>
			</ul>
		</div>

		<!-- Jumbotron -->
		<div class="jumbotron" style="position: relative;">
			<?php 
			if(!isset($_GET["cat"])){
				?>
				<h1 style="font-weight: bold;color:#fff;text-shadow:0px 5px 5px #333">¿A qué segmento perteneces?</h1>
				<p class="lead">
					Elegí el segmento al que perteneces para inscribirte.
					<br/>
					<br/>
					<br/>
					<a href="inscripcion.php?cat=empresa"><label class="col-lg-3 " style="color:#fff;background:#27ae60;padding-top:20px;padding-bottom:20px" >EMPRESAS
						<br/>
						<img src="img/iconos/empresa.png" width="40%"></label></a>
						<a href="inscripcion.php?cat=productor"><label class="col-lg-3 col-md-offset-1" style="color:#fff;background:#2980b9;padding-top:20px;padding-bottom:20px" >PRODUCTORES<img src="img/iconos/productor.png" width="40%"></label></a>
						<a href="inscripcion.php?cat=profesional"><label class="col-lg-3 col-md-offset-1" style="color:#fff;background:#8e44ad;padding-top:20px;padding-bottom:20px" >PROFESIONALES<img src="img/iconos/profesional.png" width="40%"></label></a>
						<div class="col-md-offset-1"></div>
					</p>
					<?php } else {
						switch($_GET["cat"]){
							case "empresa":
							include("inc/empresa.inc.php");
							break;
							case "productor":
							include("inc/productor.inc.php");
							break;
							case "profesional":
							include("inc/productor.inc.php");
							break;
						}
					} 
					?>
					<div class="clearfix"></div>
					<!--<h1>¡Ya cerramos las inscripciones!</h1>
					<h2>Pero si te gustaría poder ingresar al evento presentate en la Rural e inscribirse en el Salón Rosado.</h2>-->
					<br/><br/><br/>
				</div>
			</div>

			<div class="clearfix"></div><br/>
			<center>
				<a href="http://sitio.estudiorochayasoc.com/" target="_blank"><img src="http://sitio.estudiorochayasoc.com/images/agencia/logo.png" width="120" /></a>
				<br/><br/><br/>
			</center>
		</body>
		<style type="text/css">
		.disabled {
			cursor: not-allowed;
			opacity: 0.4;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	</html>
