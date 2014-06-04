<? if (isset($current->title)) { ?>
<div class="current-article">
	<img class="current-article-img" src="/static/img/interesting/<?=$current->image;?>">

	<div class="text-wrapper">
		<div class="current-article-heading">
			<?=$current->title;?>
		</div>
		<div class="current-article-text">
			<?=$current->fulltext;?>
		</div>
	</div>
</div>
<? } else { ?>
<div class="current-article" style="font-size: 20px;">
	Статията не съществува!
</div>
<? } ?>

<div class="articles-holder">
	<div class="head">
		Още статии
	</div>
	<div class="articles">

    	<?php foreach($data as $now) { ?>
		<a class="article" href="<?=$prefix;?>/interesting/<?=$now->url;?>">
			<div style="float: left; width: 39%;">
				<img src="/static/img/interesting/<?=$now->thumb?>">
			</div>
			<div class="article-content">
				<div class="heading">
					<?=$now->title?>
				</div>
				<?=mb_substr($now->fulltext, 0, 80, 'UTF-8');?>...
			</div>
		</a>

		<? } ?>
	</div>
</div>