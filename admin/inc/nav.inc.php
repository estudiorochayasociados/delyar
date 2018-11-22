<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.php"><?php echo TITULO ?></a>
	</div>
	<div class="clearfix"></div>
	<hr style="margin-bottom: 0px" />
	<ul class="nav navbar-top-links navbar-left">		
		<li>
			<a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
		</li> 
		<li class="dropdown">
			<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-newspaper-o fa-fw"></i> Novedades<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li>
					<a href="index.php?op=verNotas"> Ver Novedades</a>
				</li>
				<li>
					<a href="index.php?op=agregarNotas"> Agregar Novedades</a>
				</li>
			</ul>
		</li> 
		<li class="dropdown">
			<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-video-o"></i> Videos<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li>
					<a href="index.php?op=verVideos"> Ver Videos</a>
				</li>
				<li>
					<a href="index.php?op=agregarVideos"> Agregar Video</a>
				</li>
			</ul>
		</li> 
		<li>
			<a  href="index.php?op=verContenidos"><i class="fa fa-edit fa-fw"></i> Contenidos</a>			 
		</li> 
		<li>
			<a  href="index.php?op=verPedidos"><i class="fa fa-edit fa-fw"></i> Pedidos</a>			 
		</li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-bullhorn  fa-fw"></i> Slider<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li>
					<a href="index.php?op=verSlider"> Ver Sliders</a>
				</li>
				<li>
					<a href="index.php?op=agregarSlider"> Agregar Sliders</a>
				</li>
			</ul>
		</li> 
		<li >
			<a href="index.php?op=verUsuarios"><i class="fa  fa-users fa-fw"></i> Usuarios</span></a>
		</li> 
		<li >
			<a href="index.php?op=importarProductos"><i class="fa fa-file-excel-o fa-fw"></i> Importar Productos</span></a>
		</li> 
		<li >
			<a href="index.php?op=salir"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
		</li>
	</ul>
	<!-- /.navbar-top-links -->	

</nav>
