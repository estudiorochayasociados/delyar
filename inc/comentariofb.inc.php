<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.12&appId=<?php echo APP_ID_FACEBOOK; ?>&autoLogAppEvents=1';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php
$nota = antihack(strpos($_SERVER['REQUEST_URI'], "nota"));
$id = $id;
$data = Nota_TraerPorId($id);

if($nota){ ?>
	<div class="fb-comments" data-href="<?php echo BASE_URL.'/notas.php?id='.$id; ?>" data-width="100%" data-numposts="20" data-order-by="reverse_time"></div>
	<?php }