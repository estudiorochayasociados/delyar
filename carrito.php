<?php
session_start();
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
include "inc/header.inc.php";
?>
	<title>Carrito - Delyar</title>
</head>
<body>
	<header class="header">
		<?php include "inc/nav.inc.php";?>
	</header>

	 <div class="row encabezado wow fadeInUp">
      <div class="container">
        <div>
          <h1>  <i class="material-icons">label_outline</i> Carrito </h1>
        </div>
      </div>
    </div>

	<div class="container cuerpoContenedor">
		<div class="row">
			<div class="col-md-12 col-xs-12" style="margin-top:10px">
				<?php include "inc/ver-carrito.inc.php";?>
			</div>
		</div>
	</div>
	<?php include "inc/footer.inc.php";?>
</body>
</html>