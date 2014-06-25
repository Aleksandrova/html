<div class="dark-holder bg-hack">
	<div id="tag" class="bg-hack hide-for-small">
		<p><?=$label['products']['head_text']?></p>
		<div id="tag-triangle" class="hide-for-small"></div>
	</div>

	<? $g = new linkGenerator($id, isset($sub) ? $sub : false); ?>
	
	<div id="menu" class="hide-for-small accordion">
			<a <?=$g->gen("toaletna-hartia");?>><?=$label['products']['t-hartia'];?></a>

			<div class="subcat" style="display: <?=($id == 'toaletna-hartia' ? 'block' : 'none');?>">
				<a <?=$g->gen("toaletna-hartia", "100-celuloza");?>><?=$label['products']['celuloza'];?></a>
				<a <?=$g->gen("toaletna-hartia", "reciklirana");?>><?=$label['products']['reciklirana'];?></a>
				<a <?=$g->gen("toaletna-hartia", "eko-celulozna");?>><?=$label['products']['eko-celuloza'];?></a>
			</div>
			
			<a <?=$g->gen("salfetki");?>><?=$label['products']['salfetki'];?></a>
			
			<div class="subcat" style="display: <?=($id == 'salfetki' ? 'block' : 'none');?>">
				<a <?=$g->gen("salfetki", "25x25");?>>25x25</a>
				<a <?=$g->gen("salfetki", "25x28");?>>25x28</a>
				<a <?=$g->gen("salfetki", "30x30");?>>30x30</a>
				<a <?=$g->gen("salfetki", "33x33");?>>33x33</a>
			</div>
			
			<a <?=$g->gen("kuhnenski-rolki");?>><?=$label['products']['rolki'];?></a>
			<a <?=$g->gen("nosni-kurpichki");?>><?=$label['products']['kurpichki'];?></a>
			<a <?=$g->gen("pr");?>><?=$label['products']['pr'];?></a>
			<a <?=$g->gen("ketaring");?>><?=$label['products']['ketyring'];?></a>
			<a <?=$g->gen("partners");?>><?=$label['products']['partners'];?></a>
	</div>
	
	
	<div class="show-for-small" style="width: 100%; height: 5px; background: url('/static/img/transparent-bg-1.png')"></div>
	<div class="picture-menu show-for-small">
		<a <?=_link("/products/cat/kuhnenski-rolki");?> class="<?if($id=='kuhnenski-rolki')echo'active';?>"><img src="/static/img/icons/rola.png"></a>
		<a <?=_link("/products/cat/toaletna-hartia");?> class="<?if($id=='toaletna-hartia')echo'active';?>"><img src="/static/img/icons/hartia.png"></a>
		<a <?=_link("/products/cat/nosni-kurpichki");?> class="<?if($id=='nosni-kurpichki')echo'active';?>"><img src="/static/img/icons/kurpichki.png"></a>
		<a <?=_link("/products/cat/salfetki");?> class="<?if($id=='salfetki')echo'active';?>"><img src="/static/img/icons/salfetki.png"></a>
	</div>
	<div id="products-holder">
		<? if (isset($cat)) { ?>
			<? foreach($cat as $now) { $notnull = true; ?>
				<a <?=_link("/products/" . $now->url);?> class="item">
					<div class="name bg-hack"><?=$now->title?></div>
					<img style="width: 100%" src="<?=$now->thumb;?>">
				</a>
			<? } ?>

			<? if ( !isset($notnull) && $id != 'ketaring') { ?><div style="font-size: 20px; "><?=$label['products']['notfound'];?></div><? } ?>
		<? } ?>

		<? if(isset($current)) { 
			if (isset($current->title)) { ?>
			<div class="single-product">
				<div class="bg-hack-4 wrapper">
					<div class="title bg-hack"><?=$current->title;?></div>
					<div class="triangle hide-for-small"></div>
					<img class="image" src="<?=$current->image;?>">

					<div class="text-holder">
						<?=$current->fulltext->{$lng};?>
					</div>
					<a <?=_link("/products/cat/" . $current->category);?> class="back-btn bg-hack">
						<img src="/static/img/back_arrow.png" style="width: 37px; height: 37px;">
						<span style="top: -7px; position: relative;"><?=$label['products']['backbtn'];?></span>
					</a>
				</div>
			</div><? } ?>

			<? if ( !isset($current->title) && $id != 'ketaring' ) { ?><div style="font-size: 20px; "><?=$label['products']['notfound'];?></div><? } ?>
		<? } ?>

		<? if(isset($id) && $id == 'ketaring') { ?>
			<img src="/static/img/ketyring.png" width="95%" style="margin-bottom: 20px">
		<?}?>

	</div>
	<div style="clear: both; margin-bottom: 50px;"></div>
</div>
