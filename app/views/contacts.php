<div class="dark-holder-small" id="contacts-holder">
	<div>
		<img id="contacts-map" src="/static/img/contacts-map.png">
	</div>
	<div style="overflow: hidden;">
		<div class="part">
			<? $i=0; foreach($data as $now) { $i++; ?> 
			<a class="bg-hack" <?=($i % 2 == 0 ? 'style="float: right;"' : '')?> <?=_link("/contacts/" . $now->url);?>>
				<p><?=$now->city->{$lng};?></p>
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
		<form action="/<?=$lng;?>/contacts" method="post">
	        
			<div><p> <?=$label['contacts']['name']?> </p> </div> 
			<div><input name="name" placeholder="Вашето име..."></div>

			<div><p>Email: </p></div> 
			<div><input name="email" type="email" placeholder="Email..."></div>

			<div><p><?=$label['contacts']['text']?> </p> </div>
			<div id="tex"><textarea name="message" placeholder="Съобщението Ви..."></textarea></div>
					
			<input id="button-send" type="submit" value="<?=$label['contacts']['send'];?>">
	        
			
			<div id="fix"></div>
		</form>
	</div>
</div>
