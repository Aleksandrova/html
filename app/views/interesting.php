<? if (isset($current->title)) { ?>
<div class="bg-hack current-article">
	<img class="current-article-img" src="/static/img/interesting/<?=$current->image;?>">

	<div class="text-wrapper">
		<div class="current-article-heading">
			<?=$current->title->{$lng};?>
		</div>
		<div class="current-article-text">
			<?=$current->fulltext->{$lng};?>
		</div>
	</div>
</div>
<? } else { ?>
<div class="current-article" style="font-size: 20px;">
	Статията не съществува!
</div>
<? } ?>

<div class="bg-hack articles-holder">
	<div class="bg-hack head">
		<?=$label['interesting']['more']?>
	</div>
	<div class="articles">

    	<?php foreach($data as $now) { ?>
		<a class="article" <?=_link("/interesting/" . $now->url);?>>
			<div style="float: left; width: 39%;">
				<img src="/static/img/interesting/<?=$now->thumb?>">
			</div>
			<div class="article-content">
				<div class="heading">
					<?=$now->title->{$lng}?>
				</div>
				<?=mb_substr($now->fulltext->{$lng}, 0, 80, 'UTF-8');?>...
			</div>
		</a>
		<div class="fake-border bg-hack"></div>
		<? } ?>

	</div>
</div>