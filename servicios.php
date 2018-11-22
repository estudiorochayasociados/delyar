<?php
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("inc/header.inc.php"); 
	$title = TITULO;
	$keywords = "servicios, agropecuario, veterinaria, campo, san francisco, semillas";
	$description = "En Delyar S.A. ofrecemos servicios de alta calidad y profesionalismo con una relación personalizada con el cliente.";
	$imagen = LOGO;
	?>
	<title>Servicios | <?php echo $title; ?></title>
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
				<h1>      <i class="material-icons">label_outline</i> Servicios</h1>
			</div>
		</div>
	</div>
	<div class="cuerpoContenedor"> 		
		<div class="container">
			<div class="col-md-6 boxServicios col-sm-12 wow fadeInLeft">
				<img src="<?php echo BASE_URL; ?>/img/consultar.jpg" width="100%" />
				<h3 class="subtituloIndex"> PROFESIONALISMO DE LOS ASESORES COMERCIALES</h3>
				<p>
					El equipo comercial de Delyar recibe capacitación permanente con el objetivo de estar a la vanguardia del asesoramiento en innovaciones de productos, para asesorar de la manera más eficiente a los clientes.
				</p>
			</div>
			<div class="col-md-6 boxServicios col-sm-12 wow fadeInRight">
				<img src="<?php echo BASE_URL; ?>/img/envio.jpg" width="100%" />
				<h3 class="subtituloIndex"> ENTREGA PERMANENTE</h3>
				<p>
					La empresa cuenta con un stock consolidado y controlado por personal capacitado en logística y distribución, posibilitando contar con la entrega de la mercadería en tiempo y forma, solucionando, en cualquier horario, entregas en carácter de urgencia.
				</p>
			</div> 
			<div class="col-md-6 boxServicios col-sm-12 wow fadeInLeft">
				<img src="<?php echo BASE_URL; ?>/img/compromiso.jpg" width="100%" />
				<h3 class="subtituloIndex">COMPROMISO DE REPUESTA</h3>
				<p>
					Todas las unidades de negocios de Delyar S.A. trabajan conjuntamente para asistir al cliente de manera permanente y especialmente ante urgencias. Estamos para brindar una respuesta integral al sector agropecuario.
				</p>
			</div>
			<div class="col-md-6 boxServicios col-sm-12 wow fadeInRight">
				<img src="<?php echo BASE_URL; ?>/img/visitas.jpg" width="100%" />
				<h3 class="subtituloIndex"> VISITAS PERSONALIZADAS</h3>
				<p>
					Con un cronograma ordenado cada 15 días, nuestros clientes (que se encuentran a 150 km a la redonda de la ciudad de San Francisco) son visitados por alguno de los viajantes que integran nuestro capacitado equipo de ventas.
				</p>
			</div>

			<div class="col-md-6 boxServicios col-sm-12 wow fadeInRight">
				<img src="<?php echo BASE_URL; ?>/img/capacitacion.jpg" width="100%" />
				<h3 class="subtituloIndex"> JORNADAS DE CAPACITACIÓN</h3>
				<p>
					Capacitamos constantemente, tanto a los profesionales que trabajan en la empresa como a otros que son contratados por la misma, brindándoles las herramientas para mantenerlos actualizados en lo que respecta a nuevos productos o exposiciones vinculadas al agro. 
				</p>
			</div>
			<div class="col-md-6 boxServicios col-sm-12 wow fadeInLeft" style="float:left !important">
				<img src="<?php echo BASE_URL; ?>/img/relacion.jpg" width="100%" />
				<h3 class="subtituloIndex">RELACIÓN PERSONALIZADA</h3>
				<p>
					Con el concepto que los productores agropecuarios son personas que valoran las relaciones humanas, desde la empresa se desarrolla la política de asistir de manera personal a todos y cada uno de ellos, incluso organizando viajes con grupos de clientes para consolidar las relaciones personales.
				</p>
			</div>
			<div class="col-md-6 boxServicios col-sm-12 wow fadeInLeft">
				<img src="<?php echo BASE_URL; ?>/img/cooperacion.jpg" width="100%" />
				<h3 class="subtituloIndex">COOPERACIÓN PROFESIONAL</h3>
				<p>
					Una verdadera vocación de servicio permite la puesta a disposición del profesional contratado por el cliente de toda la información que éste necesite para realizar un trabajo eficiente. Se trabaja en equipo con todos los profesionales agrónomos, para colaborar desde la experiencia.
				</p>
			</div>
		</div>
	</div>
	<?php include("inc/footer.inc.php"); ?>

</body>
</html>