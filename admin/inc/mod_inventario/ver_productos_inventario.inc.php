<div class="col-md-12">
	<h3>Productos inventario</h3>	
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<table class="table table-bordered table-hover">
			<thead>
				<th>Producto</th>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Inventario</th>
				<th>Usuario</th>
			</thead>
			<tbody>
				<?php			
				$con = Conectarse();		
				$consulta = "SELECT * FROM `productos_inventarios`,`inventarios`,`usuarios`,`productos_final` WHERE `codigo_productoInv` = `cod` AND `inventario_productoInv` = `id_inventario` AND `usuarios`.`id` = `usuario_inventario` ORDER BY cantidad_productoInv ASC";

				$result = mysqli_query($con,$consulta);
				$i = 0;
				while($row = mysqli_fetch_array($result)) {  	
					?>		 
					<tr <?php if($row["cantidad_productoInv"] <= 10) {echo "class='alert alert-danger'";} ?>>		
						<td style="text-transform:uppercase !important">
							<?php echo "(".$row["cod"].") ".$row["titulo"] ?>
						</td>
						<td style="text-transform:uppercase !important">
							<?php echo $row["descripcion"] ?>
						</td>		
						<td style="text-transform:uppercase !important">
							<?php echo $row["cantidad_productoInv"] ?>
						</td>		
						<td style="text-transform:uppercase !important">
							<?php echo $row["nombre_inventario"] ?>
							<a class="btn btn-default btn-sm" style="float:right" data-toggle="modal" data-target="#inventario<?php echo $i ?>">
								<i class="fa fa-home fa-fw"></i>
							</a>
						</td>		
						<td style="text-transform:uppercase !important">		
							<?php echo $row["nombre"] ?> / <?php echo $row["empresa"] ?>
							<a href=""><i class=""></i></a>		
							<a class="btn btn-default btn-sm" style="float:right" data-toggle="modal" data-target="#usuario<?php echo $i ?>">
								<i class="fa fa-user fa-fw"></i>
							</a>	
						</td>
					</tr>


					<div class="modal fade" id="usuario<?php echo $i ?>">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Datos del usuario</h4>
								</div>
								<div class="modal-body" style="font-size:16px">
									<b>Nombre:</b> <?php echo $row["nombre"] ?><br/>
									<hr/>
									<b>Empresa:</b> <?php echo $row["empresa"] ?><br/>
									<hr/>
									<b>Email:</b> <?php echo $row["email"] ?><br/>
									<hr/>
									<b>Contraseña:</b> <?php echo $row["pass"] ?><br/>
									<hr/>
									<b>Telefono:</b> <?php echo $row["telefono"] ?><br/>									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>



					<div class="modal fade" id="inventario<?php echo $i ?>">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Productos del inventario <b style="text-transform:uppercase">"<?php echo $row["nombre_inventario"] ?>"</b></h4>
								</div>
								<div class="modal-body">
									<div class='row' style="padding-top:10px;padding-bottom:10px;border-bottom:1px solid #333">          
										<div class='col-md-6'><b>NOMBRE</b></div>
										<div class='col-md-6'><b>CANTIDAD</b></div>
									</div>
									<?php Inventario_Traer_Por_Usuario( $row["id_inventario"] ) ?>
									<div class="clearfix"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>

					<?php	
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>
</div>