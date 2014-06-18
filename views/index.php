<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="x-ua-compatible" content="IE=edge" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/static/css/style.css">
	    <link rel="stylesheet" href="/static/css/foundation.css" />
	<title><?=$title;?> - Фобос ЕР</title>
	<meta name="classification" content="business" />
	<meta name="robots" content="index, follow" />
	<meta name="owner" content="FobosR" />
	<meta name="keywords" content="Fobos, fobosr, фобос, ер, фобосЕр, fobos-r, фобос-ер, ООД, град, монтана, българия, георги, георгиев, производство, пакетаж, пласмент, изделия от хартия, тоалетна, хартия, кухненска, кухненски, рула, ролки,  носни, кърпички, салфетки, римби, rimbi, писана, фреш, fresh, мелани, дева, спринг, перле, perle, финес, мони, целулоза, пакет, пакети, чувал, щампа, бандерол, fantasy, кафе, coffee" />
	<meta name="description" content="Фобос Ер ООД е специализирана фирма в производството и пласмента на богата гама от салфетки, кухненси рула, тоалетна хартия, носни кърпички и други..." />
	<!-- <script>if(window.chrome){window.location = '/new' + window.location.pathname;}</script> -->
</head>
<body>
	<div style="position: absolute; display: none; top: 0px; bottom: 0px; left: 0px; right: 0px; background-color: red;">dasdas</div>	
	<!--[if IE]>
	<script>
		document.body.className = 'ie-hacks';
	</script>
	<![endif]--> 
	<div class="bg-hack header">
		<div id="holder">
			<div id="logo">
				<a href="<?=$prefix;?>/"> <img src="/static/img/logo.png"> </a>
			</div>

			<img src="/static/img/lines.png" id="lines" class="show-for-small toggle-icon">

			<div id="mainmenu">
				<a href="<?=$prefix;?>/">НАЧАЛО</a>
				<a href="<?=$prefix;?>/products">ПРОДУКТИ</a>
				<a href="<?=$prefix;?>/about">ЗА НАС</a>
				<a href="<?=$prefix;?>/interesting">ИНТЕРЕСНО</a>
				<a href="<?=$prefix;?>/contacts">КОНТАКТИ</a>
			</div>
			
			<div style="clear: both;"></div>
		</div>
	</div>

	<div id="content-wrapper">
		<div class="well">
			<? if (isset($path)) require('./views/' . $path . '.php'); ?>
		</div>
	</div>
	<script src="/static/js/media-support.js"></script>
	<script src="/static/js/vendor/modernizr.js"></script>
</body>
</html>