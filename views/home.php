<div flexmenu id="box-parent" style="width: 100%; height: 360px; overflow: hidden;">
	<div id="box-holder">
		<? $i = 0; foreach($data as $now) { ?>
		<a href="<?=$prefix;?>/products/<?=$now->url;?>" id="<?if($i==0){?>box-left<?}elseif($i==2){?>box-right<?}else{?>box<?}?>" class="box">
			<div class="example">
				<? if ($i == 1) { ?>
				<div class="title hide-for-small bg-hack-4"><?=$now->title;?></div>
				<div class="triangle hide-for-small"></div> 
				<? } ?>
				<img class="image" src="<?=$now->image;?>">
				<div class="text-holder bg-hack">
					<?=mb_substr($now->fulltext, 0, 58, 'UTF-8');?>..
				</div>
				<div class="bottom bg-hack-4"></div>
			</div>
		</a>
		<? $i++; } ?>
	</div>
</div>