<footer class="row" style="background: #10966e">
	<div class="container">
		<div  class="col col-xs-12 col-md-6">
			<h1>Encontranos en...</h1><hr/>
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13618.798637225766!2d-62.099327!3d-31.4224!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xedfc14226737ec14!2sDelyar+Sa!5e0!3m2!1ses!2sar!4v1472500091503" title="mapa"  frameborder="0" style="border:0;width:100%;height:300px"></iframe>
		</div>
		<div class="col col-xs-12 col-md-6" style="color:#f1f1f1">
			<br/><br/>
			<i class="material-icons">location_on</i>  <span class="direccion">CASA CENTRAL: Bv Roca 3103, San Francisco, Córdoba</span><br/>
			<i class="material-icons">location_on</i> <span class="direccion">DEPÓSITO PARQUE INDUSTRIAL: Juan Venier esq. Finazzi, San Francisco, Córdoba</span><br/>
			<i class="material-icons">location_on</i> <span class="direccion">DEPÓSITO PARQUE INDUSTRIAL: Calle 6 nº 861, Sunchales, Santa Fe</span>
			<br/>
			<i class="material-icons">perm_phone_msg</i>
			<span class="direccion">  03564 427633 / 437047 / 436226</span>
			<br/>
			<i class="material-icons">email</i>
			<span class="direccion">  administracion@delyar.com.ar</span>
			<br/><br/><br/>
			<a href="<?php echo BASE_URL; ?>/contacto" class="btn btn-large btn-success" style="display:block">ENVIANOS TUS DUDAS</a><br>
			<a href="http://www.delyar.distrib2b.com.ar/" target="_blank" class="btn btn-large btn-success" style="display:block" rel="noopener">ACCESO DE CLIENTES</a>
		</div>
		<div style="clear:both;"></div>
		<div class="col col-xs-12 col-md-6 ">
			<h4>INFO EXTRA</h4>
			<ul>
				<li><a href="http://www.bna.com.ar/" target="_blank" rel="noopener">Dólar</a></li>
				<li><a href="http://www.smn.gov.ar/" target="_blank" rel="noopener">Clima</a></li>
				<li><a href="http://www.bcr.com.ar/pages/granos/default.aspx/" target="_blank" rel="noopener">Mercado Granario de Rosario</a></li>
				<br />
			</ul>
		</div>
		<div class="col col-xs-12 col-md-6 ">
			<h4>SEMILLAS</h4>
			<ul>
				<li><a href="http://bayercropscience.com.ar/soluciones-bayer/p240-credenz" target="_blank" rel="noopener">CREDENZ</a></li>
				<li><a href="http://www.advantaseeds.com.ar" target="_blank" rel="noopener">ADVANTA</a></li>
				<li><a href="http://semillasillinois.com.ar" target="_blank" rel="noopener">ILLINOIS</a></li>
			</ul>
		</div>
		<br/><br/>
	</div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/lightbox/lightbox.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/js/jquery.flexslider.js"></script>
<script>
	$(document).ready(function(){
		new WOW().init();
		$('.carousel').carousel();
		$('.slider').slider({full_width: true});
		 
	});
</script>

<!--
<div style="position: fixed;bottom:20px;left:15px;z-index: 999">
	<a target="_blank" href="https://www.facebook.com/pages/category/Local-Business/Delyar-SA-1534972143404059/" style="vertical-align:middle;box-shadow:0px 0px 10px #333;font-size:14px;padding:10px;border-radius:5px;background-color:#1787fb;color:white;text-shadow:none;" rel="noopener">
		<span class="hidden-xs hidden-sm">Comunicate vía</span> Facebook
	</a> &nbsp;
	<a target="_blank" href="https://api.whatsapp.com/send?phone=543564570789&text=&source=&data=" style="vertical-align:middle;box-shadow:0px 0px 10px #333;font-size:14px;padding:10px;border-radius:5px;background-color:#369317;color:white;text-shadow:none;" rel="noopener">
		<span class="hidden-xs hidden-sm">Comunicate vía</span> WhatsApp
	</a>
</div>
-->

<script>
	$("#provincia").change(function () {
		$("#provincia option:selected").each(function () {
			elegido = $(this).val();
			$.ajax({
				type: "GET",
				url: "<?php echo BASE_URL ?>/inc/localidades.inc.php",
				data: "elegido=" + elegido,
				dataType: "html",
				success: function (data) {
					$('#localidad option').remove();
					var substr = data.split(';');
					for (var i = 0; i < substr.length; i++) {
						var value = substr[i];
						$("#localidad").append(
							$("<option></option>").attr("value", value).text(value)
							);
					}
					$("#localidad").material_select();
				}
			});
		});
	}) 

	function CambiarLocation(url) {
		$(location).attr('href',url);
	}

	function ajaxPost(url) {
		event.preventDefault();
		var form = $("#formAjax").serialize();
		$.ajax({method: "POST", url: url, data: form, dataType: "html",
			beforeSend: function() {
				$("#resultado").html("CARGANDO");
			},
			success: function(result){
				$("#resultado").html(result);
			}});
		event.preventDefault();
	}

	function ajaxGet(url) {
		console.log(url);
		$.ajax({method: "GET", url: url, dataType: "html",
			beforeSend: function() {
				$("#resultado").html("CARGANDO");
			},
			success: function(result){
				$("#resultado").html(result);
				console.log(result);
			}});
		event.preventDefault();
	}

	$('.linkModal').click(function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		var titulo = $(this).attr('data-title');
		$('#contenidoForm').load(url,function(result){
			$('#myModal').modal({show:true});
			$('.modal-title').html(titulo);
			e.preventDefault();
		})
	});

	$("table").addClass("table-responsive");
	$("table").addClass("table-hover");
 
	function unset(varPost) { 
		$("#"+varPost).val('');
		$("form").submit();
	}
</script>

<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body" id="contenidoForm">

			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>