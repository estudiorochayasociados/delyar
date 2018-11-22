<?php
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("inc/header.inc.php"); 
	$title = TITULO;
	$keywords = "agropecuario, veterinaria, campo, san francisco, semillas";
	$description = "Delyar S.A. es una empresa posicionada desde hace años en San Francisco hacia la región como uno de los distribuidores de productos para el campo más importantes en la escala nacional.";
	$imagen = LOGO;
	?>
	<title><?php echo $title; ?></title>
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
	<div class="navbar-fixed">
		<?php include("inc/nav.inc.php"); ?>
	</div>
	<div id="themeSlider" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php Slider_Read("inicio"); ?>
		</div>
		<a class="left carousel-control" href="#themeSlider" role="button" data-slide="prev" style="padding-top: 20%">
			<span class="fa fa-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#themeSlider" role="button" data-slide="next" style="padding-top: 20%">
			<span class="fa fa-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="wow fadeInDown" style="background: #fff">
		<div class="container">
			<h5 class="col-sm-12 col-md-12" style="font-size: 18px;color:#333;padding: 15px 0px 15px 0px;text-align: center">
				DELYAR S.A. es una empresa posicionada desde hace años en San Francisco hacia la región como uno de los <br/>
				distribuidores de productos para el campo más importantes en la escala nacional.
			</h5>
			<hr/>

		</div>
	</div>

	<div class="container">
		<div class="col col-xs-12 col-md-4 wow fadeInDown" style="height: 250px">
			<center><img alt="logo" src="<?php echo BASE_URL ?>/img/delyar_agro.png"  width="40%" /></center><hr/>
			<p style="height:100px"> 
				<b>Delyar Agro</b>, dedicada desde el primer momento al abastecimiento de productos fitosanitarios para comercios y productores de la zona, se caracteriza por la cooperación con...
			</p>
			<a href="<?php echo BASE_URL; ?>/empresa" style="display:block" class="btn btn-success  waves-light btnConocer">Ampliar información</a>
		</div>
		<div class="col col-xs-12 col-md-4 wow fadeInDown" style="height: 250px">
			<center><img alt="logo" src="<?php echo BASE_URL ?>/img/delyar_vet.png"  width="40%" /></center><hr/>
			<p style="height:100px">
				<b>Delyar Vet</b>, unidad de negocios dedicada al mercado veterinario. La misma comercializa la más amplia gama de insumos, consiguiendo posicionarse como líder en el mercado...
			</p>
			<a href="<?php echo BASE_URL; ?>/empresa" style="display:block" class="btn btn-success  waves-light btnConocer">Ampliar información</a>
		</div>
		<div class="col col-xs-12 col-md-4 wow fadeInDown" style="height: 250px">
			<center><img alt="logo" src="<?php echo BASE_URL ?>/img/delyar_seed.png"  width="40%" /></center><hr/>
			<p style="height:100px">
				<b>Delyar Seed</b>, unidad de negocios que nace por la necesidad de autosuperación constante de Delyar S.A. dedicada a la comercialización de semillas...
			</p>
			<a href="<?php echo BASE_URL; ?>/empresa" style="display:block" class="btn btn-success  waves-light btnConocer">Ampliar información</a>
		</div>
		<div class="col col-xs-12 col-md-4 wow fadeInDown" style="height: 250px">
			<center><img alt="logo" src="<?php echo BASE_URL ?>/img/delyar_nutricion.png"  width="50%" /></center><hr/>
			<p style="height:100px"> 
				<b>Delyar Nutrición</b>, un nuevo desarrollo empresarial que busca proveer una alimentación de calidad, para el campo argentino, respaldada por las mejores marcas...
			</p>
			<a href="<?php echo BASE_URL; ?>/empresa" style="display:block" class="btn btn-success  waves-light btnConocer">Ampliar información</a>
		</div>
		<div class="col col-xs-12 col-md-4 wow fadeInDown" style="height: 250px">
			<center><img alt="logo" src="<?php echo BASE_URL ?>/img/delyar_plasticos.png"  width="50%" /></center><hr/>
			<p style="height:100px">
				<b>Delyar Plásticos</b>, su más reciente unidad de negocios, a través de la cual, la empresa continúa reforzando el compromiso con la sustentabilidad y apunta a desarrollar...
			</p>
			<a href="<?php echo BASE_URL; ?>/empresa" style="display:block" class="btn btn-success  waves-light btnConocer">Ampliar información</a>
		</div>
		<div class="col col-xs-12 col-md-4 wow fadeInDown" style="height: 250px">
			<center><img alt="logo" src="<?php echo BASE_URL ?>/img/delyar_logistica.png"  width="50%" /></center><hr/>
			<p style="height:100px">
				<b>Delyar Logísitica</b>, se desarrolló el nuevo emprendimiento de la empresa, construyendo nuevas instalaciones en el Parque Industrial de San Francisco...
			</p>
			<a href="<?php echo BASE_URL; ?>/empresa" style="display:block" class="btn btn-success  waves-light btnConocer">Ampliar información</a>

		</div>
		<div class="clearfix"></div><br/><br/> 
	</div>

	<div class="container">
		<h3 class="titularBox">Últimas novedades</h3>
		<div class="row">
			<?php Notas_Read_Front_Index(); ?>
		</div>
	</div> 		

	<?php include("inc/footer.inc.php"); ?>
	<?php
 	/*
 	<div id="modal1" class="modal" style="width:45% !important;box-shadow: 0px 0px 50px 10px #333">	
 		<div class="modal-content">
 			<a href="http://www.congreso.delyar.com.ar" target="_blank"><img src="img/congreso.jpg" width="100%" /></a>
 		</div> 	
 		<div class="modal-footer">
 			<a href="#!" class="modal-action  modal-trigger modal-close waves-effect waves-green btn-flat">CERRAR</a>
 		</div>
 	</div>
 	
 	<script>
 		$(document).ready(function(){
 			$('.modal').modal({
 				dismissible: true, 
 				opacity: .5, 
 				inDuration: 300, 
 				outDuration: 200, 
 				startingTop: '4%', 
 				endingTop: '5%'  
 			});
 			
 			$('#modal1').modal('open');

 			$("body").click(function() {
 				$('#modal1').closeModal();
 			})
 		});
 	</script>
 	*/
 	?>
 </body>
 </html>