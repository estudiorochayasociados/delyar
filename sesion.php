<?php
session_start();
if(!isset($_SESSION["carrito"]) ){
	$_SESSION["carrito"] = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("inc/header.inc.php"); ?>
	<?php
	if (@$_SESSION["user"]["id"] == '') {
		header("location:usuarios.php");
	}
	?>
	<title>Ingreso de Usuarios - <?php TITULO; ?></title>

</head>
<body>
	<div id="page">
		<header class="header">
			<?php include("inc/nav.inc.php"); ?>
		</header>

		<div class="row encabezado wow fadeInUp">
			<div class="container">
				<div>
					<h1>  <i class="material-icons">label_outline</i> Panel de usuario</h1>
				</div>
			</div>
		</div>
		<div class="container cuerpoContenedor">
			<div class="row">  
				<div class="col-md-3">
					<div class="titular">
						<h3>Sesión</h3>      					
					</div>
					<div class="menuSesion">
						<a href="<?php echo BASE_URL ?>/sesion.php?op=pedidos"><li><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						Ver Pedidos</li></a>
						<a href="<?php echo BASE_URL ?>/sesion.php?op=mi-cuenta"><li><i class="fa fa-user"></i> Mi cuenta</li></a>
						<a href="<?php echo BASE_URL ?>/sesion.php?op=salir"><li><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar sesión</li></a>
					</div>
				</div>
				<div class="col-md-9">
					<?php
					$op = isset($_GET["op"]) ? $_GET["op"] : '';
					switch($op) {

						case "pedidos":
						include('inc/sesion/pedidos.inc.php');
						break;
						case "mi-cuenta":
						include('inc/sesion/mi-cuenta.inc.php');
						break;
						case "ver-carrito":
						include('inc/sesion/ver-carrito.inc.php');
						break;
						case "salir":
						session_destroy();
						headerMove("usuarios.php");
						break;
						default:
						include('inc/sesion/pedidos.inc.php');
						break;
					}
					?> 
				</div>  
			</div>  
		</div>
		<?php include("inc/footer.inc.php"); ?>
		<script>
			var txt = $("#envio option:selected").text();
			alert(text);
		</script>
	</body>
	</html>
	<?php
	ob_end_flush();
	?>
