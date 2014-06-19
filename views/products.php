<div class="dark-holder bg-hack">
	<div id="tag" class="bg-hack hide-for-small">
		<p>Какво предлагаме?</p>
		<div id="tag-triangle" class="hide-for-small"></div>
	</div>
	
	
	<div id="menu" class="hide-for-small accordion">
			<div id="click1" ><a href="<?=$prefix;?>/products/cat/toaletna-hartia">Тоалетна хартия</a></div> 

				<div class="toggle1"><a href="<?=$prefix;?>/products/cat/toaletna-hartia/100-celuloza"> &nbsp; &nbsp; &nbsp; 100% целулоза</a></div>
				<div class="toggle1"><a href="<?=$prefix;?>/products/cat/toaletna-hartia/reciklirana"> &nbsp; &nbsp; &nbsp; Рециклирана</a></div>
				<div class="toggle1"><a href="<?=$prefix;?>/products/cat/toaletna-hartia/eko-celulozna"> &nbsp; &nbsp; &nbsp; Еко-целулозна</a></div>

			
			<div id="click2"><a href="<?=$prefix;?>/products/cat/salfetki">Салфетки</a></div>
			
				<div class="toggle2"><a href="<?=$prefix;?>/products/cat/salfetki/25x25"> &nbsp; &nbsp; &nbsp; 25x25</a></div>
				<div class="toggle2"><a href="<?=$prefix;?>/products/cat/salfetki/33x33"> &nbsp; &nbsp; &nbsp; 33x33</a></div>
				<div class="toggle2"><a href="<?=$prefix;?>/products/cat/salfetki/25x28"> &nbsp; &nbsp; &nbsp; 25x28</a></div>
				<div class="toggle2"><a href="<?=$prefix;?>/products/cat/salfetki/30x30"> &nbsp; &nbsp; &nbsp; 30x30</a></div>
			
			
			<div><a href="<?=$prefix;?>/products/cat/kuhnenski-rolki"> Кухненски ролки</a></div>
			<div><a href="<?=$prefix;?>/products/cat/nosni-kurpichki">Носни кърпички</a></div>
			<div><a href="<?=$prefix;?>/products/cat/pr">Дамски превръзки</a></div>
	</div>
	
	
	<div class="show-for-small" style="width: 100%; height: 5px; background: url('/static/img/transparent-bg-1.png')"></div>
	<div class="picture-menu show-for-small">
		<a href="<?=$prefix;?>/products/cat/kuhnenski-rolki" class="<?if($id=='kuhnenski-rolki')echo'active';?>"><img src="/static/img/icons/rola.png"></a>
		<a href="<?=$prefix;?>/products/cat/toaletna-hartia" class="<?if($id=='toaletna-hartia')echo'active';?>"><img src="/static/img/icons/hartia.png"></a>
		<a href="<?=$prefix;?>/products/cat/nosni-kurpichki" class="<?if($id=='nosni-kurpichki')echo'active';?>"><img src="/static/img/icons/kurpichki.png"></a>
		<a href="<?=$prefix;?>/products/cat/salfetki" class="<?if($id=='salfetki')echo'active';?>"><img src="/static/img/icons/salfetki.png"></a>
	</div>
	<div id="products-holder">
		<? if (isset($cat)) { ?>
			<? foreach($cat as $now) { $notnull = true; ?>
				<a href="<?=$prefix;?>/products/<?=$now->url?>" class="item">
					<div class="name bg-hack"><?=$now->title?></div>
					<img style="width: 100%" src="<?=$now->thumb;?>">
				</a>
			<? } ?>

			<? if ( !isset($notnull) ) { ?><div style="font-size: 20px; ">Няма намерени продукти по вашите критерии.</div><? } ?>
		<? } ?>

		<? if(isset($current)) { 
			if (isset($current->title)) { ?>
			<div class="single-product">
				<div class="bg-hack-4 wrapper">
					<div class="title bg-hack"><?=$current->title;?></div>
					<div class="triangle hide-for-small"></div>
					<img class="image" src="<?=$current->image;?>">

					<div class="text-holder">
						<?=$current->fulltext;?>
					</div>
					<a href="<?=$prefix;?>/products/cat/<?=$current->category;?>" class="back-btn bg-hack">
						<img src="/static/img/back_arrow.png" style="width: 37px; height: 37px;">
						<span style="top: -7px; position: relative;">Назад</span>
					</a>
				</div>
			</div><? } ?>

			<? if ( !isset($current->title) ) { ?><div style="font-size: 20px; ">Няма намерени продукти по вашите критерии.</div><? } ?>
		<? } ?>

	</div>
	<div style="clear: both; margin-bottom: 50px;"></div>
</div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script>

$(document).ready(function(){
  $("#click1").click(function(){
    $(".toggle1").slideToggle();
	$(".toggle2").hide();
	
  });
  
   $("#click2").click(function(){
    $(".toggle2").toggle();
	$(".toggle1").hide();
	
  });
  
});

	
</script>