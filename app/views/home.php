<div flexmenu id="box-parent" style="width: 100%; height: 360px; overflow: hidden;">
	<div id="box-holder">
		<? $i = 0; foreach($data as $now) { ?>
		<a <?=_link("/products/" . $now->url);?> class="box">
			<div class="example">
				<? if ($i == 1 || $i == 4) { ?>
				 <div class="title hide-for-small bg-hack-4"><?=$now->title;?></div>
				<div class="triangle hide-for-small"></div> 
				<? } ?>
				<img class="image" src="<?=$now->image;?>">
				<div class="text-holder bg-hack">
					<?=str_replace("#", "<br/>", mb_substr(str_replace("<br/>", "#", $now->fulltext->{$lng}), 0, 50, 'UTF-8'));?>..
				</div>
				<div class="bottom bg-hack-4"></div>
			</div>
		</a>
		<? $i++; } ?>
	</div>
</div>