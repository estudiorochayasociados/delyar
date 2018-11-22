<?php
ob_start();
session_start();
include "../../admin/dal/data.php";
$_SESSION["carrito"] = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : array();
$op                  = isset($_GET["op"]) ? $_GET["op"] : '';
if ($op == 1) {
    $id       = isset($_POST["id"]) ? $_POST["id"] : '';
    $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : '1';
    $var      = $id . "|" . $cantidad;
    array_push($_SESSION["carrito"], $var);
    echo "<span class='alert alert-success btn-block'> <i class='fa fa-cart-plus'> </i> Excelente, añadiste un nuevo producto a tu carro. <a href='" . BASE_URL . "/carrito'>Ir a mi carrito</a></span><div class='clearfix'></div>";
    headerMove(BASE_URL . "/carrito");

} else {
    $idProducto = isset($_GET["idProducto"]) ? $_GET["idProducto"] : '';
    $data       = Productos_TraerPorCod($idProducto);
    ?>
	<form id="formAjax" onsubmit="ajaxPost('<?php echo BASE_URL ?>/api/carrito/agregar_a_carrito.php?op=1');">
		<div id="resultado">
		</div>
		<div class="col-md-4">
			<img src="<?php echo BASE_URL ?>/img/sin_imagen.jpg" width="100%"/>
		</div>
		<div class="col-md-8">
			<p >
				<?php echo "<b style='font-size:16px'>" . $data["cod_producto"]; ?> | <?php echo $data["patron_producto"] . "</b>"; ?><br/>
				<?php echo $data["descripcion_producto"]; ?><br/>
				Línea: <?php echo ($data["categoria_producto"]); ?> | <?php echo ($data["subcategoria_producto"]); ?><br/>
				Stock: <?php echo $data["stock_producto"]; ?> | Precio: $<?php echo $data["precio".$_SESSION["user"]["lista"]."_producto"]; ?>
			</p>
			<i>¿Cuántos estás necesitando?</i>
			<div class="clearfix">
			</div>
			<i style="float:left;margin-right: 10px;margin-top: 6px">Cantidad: </i>
			<input type="hidden" style="float:left;width: 100px;" name="id" class="form-control" value="<?php echo $data["id_producto"] ?>">
			<input type="number" style="float:left;width: 100px;" name="cantidad" min="1" class="form-control" value="1" required="">
		</div>
		<div class="col-md-12 mt-30">
			<div class="clearfix">
			</div>
			<div class="hidden-md hidden-lg">
				<div class="mt-20"></div>
			</div>
			<input name="agregarSubmitCarro" type="submit" class="btn btn-success" value=" AGREGAR A CARRITO " />
		</div>
	</form>
	<div class='clearfix'></div>
<?php }?>
