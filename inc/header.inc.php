<?php
include("PHPMailer/class.phpmailer.php");
include("admin/dal/data.php");

$canonical = CANONICAL;
$autor = TITULO;
$made = EMAIL;
$pais = META_PAIS;
$place = META_PLACE;
$position = META_POSITION;
$copy = META_COPY;
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127300251-10"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127300251-10');
</script>

<script type="text/javascript">
(function() {
window.__insp = window.__insp || [];
__insp.push(['wid', 631083174]);
var ldinsp = function(){
if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=631083174&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
setTimeout(ldinsp, 0);
})();
</script>
<!-- End Inspectlet Asynchronous Code -->

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4393579.js"></script>
<!-- End of HubSpot Embed Code -->

<meta charset="utf-8"/>
<meta name="author" lang="es" content="<?php echo $autor; ?>" />
<link rel="author" href="<?php echo $made; ?>" rel="nofollow" />
<meta name="copyright" content="<?php echo $copy; ?>" />
<link rel="canonical" href="<?php echo $canonical; ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="all" />
<meta name="rating" content="general" />
<meta name="content-language" content="es-ar" />
<meta name="DC.identifier" content="<?php echo $canonical; ?>" />
<meta name="DC.format" content="text/html" />
<meta name="DC.coverage" content="<?php echo $pais; ?>" />
<meta name="DC.language" content="es-ar" />
<meta http-equiv="window-target" content="_top" />
<meta name="robots" content="all" />
<meta http-equiv="content-language" content="es-ES" />
<meta name="google" content="notranslate" />
<meta name="geo.region" content="AR-X" />
<meta name="geo.placename" content="<?php echo $place; ?>" />
<meta name="geo.position" content="<?php echo $position; ?>" />
<meta name="ICBM" content="<?php echo $position; ?>" />
<meta content="public" name="Pragma" />
<meta http-equiv="pragma" content="public" />
<meta http-equiv="cache-control" content="public" />

<meta property="og:url" content="<?php echo $canonical; ?>" />
<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/css/animate.css"  media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/css/flexslider.css" />
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/css/estilo.css"  media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/css/font-awesome.min.css"  media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/lightbox/lightbox.css" />

<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>/favicon.png" />
