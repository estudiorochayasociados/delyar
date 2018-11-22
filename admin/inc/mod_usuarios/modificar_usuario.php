<div class="col-md-12">
	<div class="main-content blog">
		<h4  style="float:left;">Usuarios</h4>
 	<div class="clearfix"></div>
	<hr/>
		<div class="row">
			<?php
			$id = $_GET["id"];
			$data = Usuario_TraerPorId($id);
			$img = isset($data["imagen"]) ? $data["imagen"] : 'img/sin_imagen_perfil.png';
			?>
			<form method="post" class="form-group"  enctype="multipart/form-data" onsubmit="showLoading()">
				<?php
				if (isset($_POST["enviar"])) { 
					$emailRevisar = Revisar_Email("usuarios", "email", $_POST["email"]);
					if ($emailRevisar != "si" || $_POST["email"] == $data["email"] ) {

						$nombre = $_POST["nombre"];
						$email = $_POST["email"];
						$pass = $_POST["password1"];
						$localidad = $_POST["localidad"];
						$provincia = $_POST["provincia"];
						$domicilio = $_POST["domicilio"];
						$estado = $_POST["estado"];
						$lista = $_POST["lista"];
						$telefono = $_POST["telefono"];

						$sql = "
						UPDATE `usuarios` 
						SET `nombre`= '$nombre',
						`email`= '$email',
						`pass`='$pass',
						`direccion`= '$domicilio',
						`telefono`= '$telefono',
						`estado`= '$estado',
						`lista`= '$lista',
						`localidad`= '$localidad',
						`provincia`= '$provincia'
						WHERE `id`= '$id'";

						$link = Conectarse();
						$r = mysqli_query($link,$sql); 
						header("location:index.php?op=verUsuarios");
					} else {
						echo "<div class='alert alert-danger col-md-12'>Lo sentimos el correo electrónico ya existe.</div>";
					} 
				}
				?>
				<label class="col-md-4">Nombre y Apellido:
					<br />
					<input class="form-control" required type="text" onkeypress="return textonly(event);"   name="nombre" placeholder="Nombre" value="<?php echo isset($data["nombre"]) ? $data["nombre"] : '' ?>"  />
				</label>
				<label class="col-md-4">E-mail:
					<br />
					<input class="form-control" required type="email" name="email" placeholder="E-mail" value="<?php echo isset($data["email"]) ? $data["email"] : '' ?>" />
				</label>
				<label class="col-md-4">Lista:
					<br />
					<select class="form-control" required name="lista">
						<option value="0" <?php if($data["lista"] == 0){echo "selected";} ?>>Lista Normal</option>
						<option value="1" <?php if($data["lista"] == 1){echo "selected";} ?>>Lista Selecta</option>
					</select>
				</label>
				<label class="col-md-4">Estado:
					<br />
					<select class="form-control" required name="estado">
						<option value="0" <?php if($data["estado"] == 0){echo "selected";} ?>>Desactivado</option>
						<option value="1" <?php if($data["estado"] == 1){echo "selected";} ?>>Activado</option>
					</select>
				</label>
				<label class="col-md-4">Provincia
					<br/>
					<input class="form-control"  type="text" name="provincia" placeholder="Provincia" value="<?php echo isset($data["provincia"]) ? $data["provincia"] : '' ?>"  />
				</label>
				<label class="col-md-4">Localidad
					<br/> 
					<input class="form-control"  type="text" name="localidad" placeholder="Localidad" value="<?php echo isset($data["localidad"]) ? $data["localidad"] : '' ?>"  />
				</label> 
				<label class="col-md-12">Domicilio:
					<br />
					<input class="form-control"  type="text" name="domicilio" placeholder="Domicilio" value="<?php echo isset($data["direccion"]) ? $data["direccion"] : '' ?>"  />
				</label>
				<label class="col-md-6">Teléfono:
					<br />
					<input class="form-control"  type="text" name="telefono" placeholder="011 4959..." onkeypress="return isNumberKey(event)" value="<?php echo isset($data["telefono"]) ? $data["telefono"] : '' ?>"  />
				</label> 
				<label class="col-md-6">Contraseña:
					<br />
					<input class="form-control" type="password" name="password1"   value="<?php echo isset($data["pass"]) ? $data["pass"] : '' ?>"  placeholder="Password" required/>
 				</label> 			 
				<div class="clearfix"></div><br/>
				<div class="col-md-6">
					<input type="submit" class="btn btn-success" name="enviar" value="Modificar datos" />
				</div>
			</form>
		</div>
		<div class="clearfix">
			<br />
			<br />
		</div>
	</div>
</div>