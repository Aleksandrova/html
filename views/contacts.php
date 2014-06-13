<div class="dark-holder-small" id="contacts-holder">
	<div>
		<img src="/static/img/contacts-map.png">
	</div>
	<div style="overflow: hidden;">
		<div class="part">
			<? foreach($data as $now) { ?> 
			<a class="bg-hack" href="/contacts/<?=$now->url;?>">
				<p><?=$now->city;?></p>
			</a>
			<? } ?>
		</div>
	</div>

	<div class="bg-hack" id="click-here">
		<a href="#">
			<p>Пишете ни</p>
			<p id="for">За заявки, въпроси и повече информация кликнете тук.</p>
		</a>
	</div>
</div>
