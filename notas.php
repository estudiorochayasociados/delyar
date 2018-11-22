<?php
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("inc/header.inc.php");
	$id = isset($_GET["id"]) ? $_GET["id"] : '';
	$notas = Nota_TraerPorId($id);
	$fecha = explode("-", $notas["FechaNotas"]);
	$titulo = $notas["TituloNotas"];
	$cod = $notas["CodNotas"];
	$sqlImagen = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
	$idConn = Conectarse();
	$resultadoImagen = mysqli_query($idConn,$sqlImagen);
	$i=0;
	while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
		$imagen[$i] = BASE_URL . "/" . $imagenes[0];
		$i++;
	} 
	?>
	<?php  
	$title = TITULO;
	$keywords = "novedad, noticia, agropecuario, veterinaria, campo, san francisco, semillas";
	$description = "Delyar S.A. es una empresa posicionada desde hace años en San Francisco hacia la región como uno de los distribuidores de productos para el campo más importantes en la escala nacional.";
	?>
	<title><?php echo $titulo; ?> | <?php echo $title; ?></title>
	<meta http-equiv="title" content="<?php echo $title; ?>" />
	<meta name="description" lang=es content="<?php echo $description; ?>" />
	<meta name="keywords" lang=es content="<?php echo $keywords; ?>" />
	<link href="<?php echo $imagen[0] ?>" rel="Shortcut Icon" />
	<meta name="DC.title" content="<?php echo $title; ?>" />
	<meta name="DC.subject" content="<?php echo $description; ?>" />
	<meta name="DC.description" content="<?php echo $description; ?>" />

	<meta property="og:title" content="<?php echo $title; ?>" />
	<meta property="og:description" content="<?php echo $description; ?>" />
	<meta property="og:image" content="<?php echo $imagen[0] ?>" />
	<meta property="fb:app_id" content="<?php echo APP_ID_FACEBOOK; ?>" />
</head>
<body>
	<div class="navbar-fixed nav2">
		<?php include("inc/nav.inc.php"); ?> 		
	</div>
	<div class="row encabezado wow fadeInUp">
		<div class="container">
			<div>
				<h1><i class="material-icons">label_outline</i> novedades</h1>
			</div>
		</div>
	</div>
	<div class="cuerpoContenedor notasContenedor">
		<div class="row "> 		
			<div class="container">  
				<div class="col-md-9 col-sm-12">
					<p>
						<span class="left meta-date"><i class="fa fa-tags"></i> <?php echo utf8_encode($notas["CategoriaNotas"]) ?></span>     
						<span class="right meta-date"><i class="fa fa-calendar"></i> <?php echo $fecha[2]."-".$fecha[1]."-".$fecha[0] ?></span>     
					</p>
					<h1 class="titularNotas"><?php echo $notas["TituloNotas"]; ?></h1> 		
					<hr/>
					<br/> 
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php
							for($j=0;$j<$i;$j++) { ?>
								<div class="item <?php if($j==0) {echo "active";} ?>">
									<div style="height: 500px; background: url('<?php echo $imagen[$j] ?>')center/cover;"></div>
								</div>
							<?php }
							?>
						</div>
						<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div>	
					<p>	
						<br/>	
						<?php echo $notas["DesarrolloNotas"]; ?>
					</p>
					<?php include("inc/comentariofb.inc.php"); ?>
				</div>
				<div class="col-md-3 col-sm-12"> 
					<div class="sideSide">
						<center><h4>Cambio Hoy</h4></center>
						<div style="margin-top:10px;"> 
							<style type="text/css">
							.cotizacion_personalizada {color:#006699; }
							.cotizacion_personalizada A {color:#666600; text-decoration:none}
						</style>
						<span id="cotizacion_personalizada" class="cotizacion_personalizada">
							<div class="row">
								<div class="col-md-6">
									<a href="http://www.dolarcito.com.ar/?ver=cotizacion_de_divisa&divisa=1"><b>Dólar</b></a>
								</div> 
								<div class="col-md-6">${dolar_c} / ${dolar_v}</div>
								<br>
								<div class="col-md-6">
									<a href="http://www.dolarcito.com.ar/?ver=cotizacion_de_divisa&divisa=1"><b>Euro</b></a>
								</div> 
								<div class="col-md-6">${euro_c} / ${euro_v}</div>
								<br>
								<div class="col-md-6">
									<a href="http://www.dolarcito.com.ar/?ver=cotizacion_de_divisa&divisa=1"><b>Real</b></a>
								</div> 
								<div class="col-md-6">${real_c} / ${real_v}</div>
								<br>
								<div class="col-md-6">
									<a href="http://www.dolarcito.com.ar/?ver=cotizacion_de_divisa&divisa=1"><b>Peso Uruguayo</b></a>
								</div> 
								<div class="col-md-6">${urug_c} / ${urug_v}</div>
								<br>
							</div>
						</span>
						<script src="http://www.dolarcito.com.ar/scripts/cotizacion_personalizada.js" language="javascript" type="text/javascript"></script>
						<script language="javascript" type="text/javascript">show(s_cotizacion_personalizada)</script>
						<!-- FIN codigo cotizacion personalizado -->				
					</div>
					<center>
						<hr/>
						<div class="col-md-12">
							<h4>Cotización de Cereales</h4>
							<a class="btn btn-success orange" style="display:block" href="http://www.acabase.com.ar/" target="_blank">
								VER COTIZACIONES
							</a>
							<br/>
						</div>

						<div class="col-md-12">
							<h4>Cotización de Ganado</h4>
							<a class="btn btn-success orange" style="display:block" href="http://www.mercadodeliniers.com.ar/dll/hacienda1.dll/haciinfo000002?OPCIONMENU=2&OPCIONSUBMENU=0" target="_blank">
								VER COTIZACIONES
							</a>
						</div>
					</center>
				</div>
			</div>
		</div>
	</div>
	<?php include("inc/footer.inc.php"); ?>
	<script>
 			//$('.sideSide').pushpin({ top: $('.sideSide').offset().top });
 		</script>
 	</body>
 	</html>