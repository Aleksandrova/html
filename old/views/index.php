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
	<meta name="description" content="Фобос Ер ООД е специализирана фирма в производството и пласмента на богата гама от салфетки, кухненси рула, тоалетна хартия, носни кърпички и други..." /> 
</head>
<body>
	<header>
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
	</header>

	<div id="content-wrapper">
		<div class="well">
			<? if (isset($path)) require('./views/' . $path . '.php'); ?>
		</div>
	</div>
</body>
</html>