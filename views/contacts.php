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
		<a href="#" onclick="document.getElementById('form-holder').style.display = 'block'; this.parentNode.style.display = 'none';">
			<p>Пишете ни</p>
			<p id="for">За заявки, въпроси и повече информация кликнете тук.</p>
		</a>
	</div>

	<div class="bg-hack" id="form-holder" style="display: none;">
		<div id="write-us" class="bg-hack"><p>Пишете ни</p></div>
		<form>
	        <input name="name" placeholder="Вашето име...">

			<input name="email" type="email" placeholder="Email...">

			<div id="tex"><textarea name="message" placeholder="Съобщението Ви..."></textarea></div>
					
			<input type="submit" value="Изпрати">
	        <div id="fix"></div>
		</form>
	</div>
</div>
