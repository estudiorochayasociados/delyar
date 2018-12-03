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
	unset($_SESSION["envio"]);
	unset($_SESSION["envioTipo"]);
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
		<div class="col-md-12">
			<p >
				<?php echo "<b style='font-size:16px'>" . $data["cod_producto"]; ?> | <?php echo $data["patron_producto"]  . " (".$data["marca_producto"].")</b>"; ?><br/>
				<?php echo $data["descripcion_producto"]; ?><br/>
				<?php echo $data["marca_producto"]; ?><br/>
				<?php echo ($data["categoria_producto"]); ?><br/><?php echo ($data["subcategoria_producto"]); ?><br/>
				<h4><b>Precio: </b>$<?php echo $data["precio".$_SESSION["user"]["lista"]."_producto"]; ?></h4>
				<input type="hidden" name="id" class="form-control" value="<?php echo $data["id_producto"] ?>">
				<div class="row mt-0">
					<div class="col-md-6">
						<b  >Cantidad de productos a pedir: </b>
						<input type="number"   name="cantidad" min="1" class="form-control" value="1" required="">
					</div>
					<div class="col-md-6"><br/>
						<input name="agregarSubmitCarro" type="submit" class="btn btn-success btn-block mt-5" value=" AGREGAR AL PEDIDO " />
					</div>
				</div>
			</p> 
		</div>
	</form>
	<div class='clearfix'></div>
<?php }?>
