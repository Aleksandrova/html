<div class="dark-holder-small" id="contacts-holder">
	<div class="bg-hack" id="city">
		<p><?=$data->city;?></p>
	</div>
	<div style="overflow: hidden;">
		<div class="partc">
			<? foreach($data->contact as $now) { ?> 
				<a class="bg-hack" <? if(sizeof($data->contact) % 2 == 1) { ?> style="width: 100%;" <? } ?> href="tel: <?=$now->data;?>">
					<img src="/static/img/icons/<?=$now->type;?>.png" align="left">
					<p><?=$now->data;?></p>
				</a>
			<? } ?>
		</div>
	</div>

	<div class="bg-hack" id="location">
		<div id="adress">Офиса ни може да намерите на:   <?=$data->address;?>.</div>
		<div>
			<div id="map_canvas" width="100%" height="260px;" style="width: 100%; height: 260px;"></div>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
	window.onload = function() {
		var pos = new google.maps.LatLng(<?=$data->location->x;?>, <?=$data->location->y;?>);

		var mapCanvas = document.getElementById('map_canvas');
		var mapOptions = {
			center: pos,
			zoom: 17,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		var map = new google.maps.Map(map_canvas, mapOptions);

		new google.maps.Marker({
			position: pos,
			map: map,
			title: 'Fobos ER - ????'
		});
	}
	
</script>