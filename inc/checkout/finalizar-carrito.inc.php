<?php
$precio      = (float) $_SESSION["precioFinal"];
$codigo      = rand(1, 999999999);
$pagar       = $precio;
$user        = $_SESSION["user"]["id"];
$carrito     = $_SESSION["carritoFinal"];
$con         = Conectarse();
$sql         = "INSERT INTO `pedidos`(`productos_pedidos`, `usuario_pedidos`, `estado_pedidos`, `fecha_pedidos`, `cod_pedidos`) VALUES ('$carrito','$user',9,NOW(),'$codigo')";
$mysql_query = mysqli_query($con, $sql);
?>
<div class="mb-20" style="font-size:20px">
	<b><?php echo ucwords($_SESSION["user"]["nombre"]) ?></b>, el monto total del carrito es de: <b>$<?php echo $_SESSION["precioFinal"] ?></b>
</div>
<table>
	<table class="table table-bordered table-striped">
		<thead>
			<th><b>Nombre producto</b></th>
			<th><b>Cantidad</b></th>
			<th><b>Precio unidad</b></th>
			<th><b>Precio total</b></th>
		</thead>
		<tbody>
			<?php echo $_SESSION["carritoFinal"]; ?>
		</tbody>
	</table>
	<div class="mb-20 text-center" >
		<h2 class='text-uppercase'><b>Métodos de Pago</b></h2>
	</div>
	<hr/>
	<?php
	/*
require_once 'inc/mercadopago/mercadopago.php';
if($pagar == 0) {$pagar = 1;}
$mp              = new MP('3982285456024788', 'cpf7lz1dsRa2iPDC1M0h8QLeqeFRamdj');
$preference_data = array(
    "items"       => array(
        array(
            "title"       => "COMPRA:" . $codigo,
            "currency_id" => "ARS",
            "unit_price"  => $pagar,
            "quantity"    => 1,
        ),
    ),
    "auto_return" => "approved",
    "back_urls"   => array(
        //"failure" => BASE_URL."/cierre-checkout.php?pago=2&estado=2&cod=".$codigo,
        //"pending" => BASE_URL."/cierre-checkout.php?pago=2&estado=0&cod=".$codigo,
        //"success" => BASE_URL."/cierre-checkout.php?pago=2&estado=1&cod=".$codigo
        "failure" => "/cierre-checkout.php?pago=2&estado=2&cod=" . $codigo,
        "pending" => "/cierre-checkout.php?pago=2&estado=0&cod=" . $codigo,
        "success" => "/cierre-checkout.php?pago=2&estado=1&cod=" . $codigo,
    ),
);

$preference = $mp->create_preference($preference_data);*/

/*	<div class="row">*/
/*		<div class="col-md-12">*/
/*			<a href="<?php echo $preference['response']['sandbox_init_point']; ?>" class="btn btn-info btn-block <?php echo $display ?>" name="MP-Checkout" mp-mode="modal">*/
/*				<i class="fa fa-credit-card"></i>*/
/*				PAGO CON TARJETAS DE CRÉDITO*/
/*			</a>*/
/*		</div>*/
/*	</div>*/
?> 
<div class="row">
	<div class="col-md-12">
		<a href="<?php echo BASE_URL ?>/cierre-checkout.php?pago=1&cod=<?php echo $codigo ?>"  class="btn btn-block btn-success">
			<i class="fa fa-bank"></i>
			Pagar con Transferencia Bancaria
		</a><br/>
	</div>
	<div class="col-md-12">
		<a href="<?php echo BASE_URL ?>/cierre-checkout.php?pago=3&cod=<?php echo $codigo ?>"  class="btn btn-block btn-warning">
			<i class="fa fa-money"></i>
			Pagar de contado en sucursal
		</a><br/>
	</div>
</div>
<div class="clearfix"></div>
<br/>
<img src="https://imgmp.mlstatic.com/org-img/banners/ar/medios/785X40.jpg" title="MercadoPago - Medios de pago" alt="MercadoPago - Medios de pago" width="100%" />
<script type="text/javascript">
	(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
		s.src = document.location.protocol+"//resources.mlstatic.com/mptools/render.js";
		var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}
		window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
	</script>