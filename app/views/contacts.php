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
	
	<?if(isset($flash['error'])){?>
		<div class="message"; style="background-color: #F10044;"><p> <?=$flash['error'];?></p></div>
	<?}elseif($flash['success']){?>
		<div class="message"; style="background-color: #28a989;"><p><?=$label['contacts']['sendsuccessful'];?></p></div>
	<?}?>
	
	<div class="bg-hack" id="click-here">
		<a href="#" onclick="document.getElementById('form-holder').style.display = 'block'; this.parentNode.style.display = 'none';">
			<p><?=$label['contacts']['writetous'];?></p>
			<p id="for"><?=$label['contacts']['clickhere'];?></p>
		</a>
	</div>

	<div class="bg-hack" id="form-holder" style="display: none;">
		<div id="write-us" class="bg-hack"><p><?=$label['contacts']['writetous'];?></p></div>
		<form action="/contacts" method="post">
	        <input name="name" placeholder="Вашето име...">

			<input name="email" type="email" placeholder="Email...">

			<div id="tex"><textarea name="message" placeholder="Съобщението Ви..."></textarea></div>
					
			<input id="button-send" type="submit" value="<?=$label['contacts']['send'];?>">
	        <div id="fix"></div>
		</form>
	</div>
</div>
