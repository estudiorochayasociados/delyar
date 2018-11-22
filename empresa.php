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
	<title>Empresa | <?php echo $title; ?></title>
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
 	<div class="row encabezado wow fadeInUp">
 		<div class="container">
 			<div>
 				<h1>  <i class="material-icons">label_outline</i> empresa</h1>
 			</div>
 		</div>
 	</div>
 	<div class="cuerpoContenedor">		
 			<div class="container"> 
 				<div class="col col-md-12  wow fadeInUp">
 					<?php Traer_Contenidos("empresa"); ?>		
 				</div>
 				<div class="col col-xs-12 col-md-4 boxServicios wow fadeInDown" style="height: 350px">
 					<center><img src="<?php echo BASE_URL ?>/img/delyar_agro.png"  width="40%" /></center><hr/>
 					<p> 
 						<b>Delyar Agro</b>, dedicada desde el primer momento al abastecimiento de productos fitosanitarios para comercios y productores de la zona, se caracteriza por la cooperación con marcas líderes, la presencia constante y la confiabilidad. Esta unidad de negocios, se ha convertido en la insignia de la compañía.<br/>
 						Con la responsabilidad de ser el número uno en la venta de insumos para el agro, Delyar S.A. asumió desde hace más de una década el desafío de mantener el liderazgo que le otorgó el productor agropecuario, adelantándose siempre a las necesidades de un mercado que cada día es más dinámico. <br/>
 					</p>
 				</div>
 				<div class="col col-xs-12 col-md-4 boxServicios wow fadeInDown" style="height: 350px">
 					<center><img src="<?php echo BASE_URL ?>/img/delyar_vet.png"  width="40%" /></center><hr/>
 					<p>
 						
 						<b>Delyar Vet</b>, unidad de negocios dedicada al mercado veterinario. La misma comercializa la más amplia gama de insumos, consiguiendo posicionarse como líder en el mercado local. <br/>
 						El constante asesoramiento profesional, la capacitación permanente para su equipo comercial, y el compromiso de trabajar conjuntamente con los médicos veterinarios de la región, para mejorar la calidad de vida del mundo animal, hacen de Delyar Vet una solución integral. <br/>

 					</p>
 				</div>
 				<div class="col col-xs-12 col-md-4 boxServicios wow fadeInDown" style="height: 350px">
 					<center><img src="<?php echo BASE_URL ?>/img/delyar_seed.png"  width="40%" /></center><hr/>
 					<p>
 						<b>Delyar Seed</b>, unidad de negocios que nace por la necesidad de autosuperación constante de Delyar S.A. dedicada a la comercialización de semillas. La misma, continúa creciendo en este sector a través del trabajo en conjunto con los establecimientos agropecuarios de la región y proveedores de primer nivel, destacados por su trayectoria.<br/>
 						Seguir creciendo, ampliando el ámbito de desarrollo profesional, es uno de los grandes objetivos de Delyar S.A., trabajando siempre con las mejores firmas y los más capacitados profesionales del sector.<br/>
 					</p>
 				</div>
 				<div class="col col-xs-12 col-md-4 boxServicios wow fadeInDown" style="height: 350px">
 					<center><img src="<?php echo BASE_URL ?>/img/delyar_nutricion.png"  width="50%" /></center><hr/>
 					<p> 
 						<b>Delyar Nutrición</b>, un nuevo desarrollo empresarial que busca proveer una alimentación de calidad, para el campo argentino, respaldada por las mejores marcas. Permitiendo desarrollar por completo su potencial.
 					</p>
 				</div>
 				<div class="col col-xs-12 col-md-4 boxServicios wow fadeInDown" style="height: 350px">
 					<center><img src="<?php echo BASE_URL ?>/img/delyar_plasticos.png"  width="50%" /></center><hr/>
 					<p>
 						<b>Delyar Plásticos</b>, su más reciente unidad de negocios, a través de la cual, la empresa continúa reforzando el compromiso con la sustentabilidad y apunta a desarrollar un sistema de reciclaje de los envases que se transforman en desperdicio contaminante, convirtiéndolos en materia prima para otros procesos productivos. Esta unidad se origina del trabajo constante con su línea comercial y del análisis de necesidades de los clientes.
 					</p>
 				</div>
 				<div class="col col-xs-12 col-md-4 boxServicios wow fadeInDown" style="height: 350px">
 					<center><img src="<?php echo BASE_URL ?>/img/delyar_logistica.png"  width="50%" /></center><hr/>
 					<p>
 						<b>Delyar Logísitica</b>, se desarrolló el nuevo emprendimiento de la empresa, construyendo nuevas instalaciones en el Parque Industrial de San Francisco, emplazándose en el lugar, un nuevo centro de distribución de Delyar Agro, junto al centro de logística y distribución y primer centro de acopio de Delyar Plásticos, demostrando la capacidad de crecimiento de la empresa que continúa hasta la actualidad.
 					</p>
 				</div>
 			</div>
 	</div>
 	<?php include("inc/footer.inc.php"); ?>

 </body>
 </html>