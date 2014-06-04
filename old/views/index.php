<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/static/css/style.css">
	<title><?=$title;?> - Фобос ЕР</title>
	<meta name="fragment" content="!" />
	<!--[if IE 8]><!--> <meta http-equiv="X-UA-Compatible" content="IE=8" /> <!--<![endif]-->
	<meta name="classification" content="business" />
	<meta name="robots" content="index, follow" />
	<meta name="owner" content="FobosR" />
	<meta name="keywords" content="Fobos, fobosr, фобос, ер, фобосЕр, fobos-r, фобос-ер, ООД, град, монтана, българия, георги, георгиев, производство, пакетаж, пласмент, изделия от хартия, тоалетна, хартия, кухненска, кухненски, рула, ролки,  носни, кърпички, салфетки, римби, rimbi, писана, фреш, fresh, мелани, дева, спринг, перле, perle, финес, мони, целулоза, пакет, пакети, чувал, щампа, бандерол, fantasy, кафе, coffee" />
	<meta name="description" content="Фобос Ер ООД е специализирана фирма в производството и пласмента на богата гама от салфетки, кухненси рула, тоалетна хартия, носни кърпички и други..." />
</head>
<body>
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
	<!--[if IE 8]>
	<script>
		document.body.className = 'ie-hacks';
	</script>
	<![endif]--> 
</body>
</html>