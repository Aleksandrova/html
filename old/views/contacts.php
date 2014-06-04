<div class="dark-holder-small" id="contacts-holder">
	<div style="overflow: hidden;">
		<div id="left-part" class="part">
			<a href="tel:+35996300314">
				<img src="/static/img/icons/phone.png" align="left">
				<p>096/300 314</p>
			</a>
			<a href="tel:+35996313581">
				<img src="/static/img/icons/phone.png" align="left">
				<p>096/313 581</p>
			</a>
		</div>
		<div id="right-part" class="part">
			<a href="tel:+359888476358">
				<img src="/static/img/icons/mobile.png" align="left">
				<p>0888 476 358</p>
			</a>
			<a href="mailto: fobosr@gmail.com">
				<img src="/static/img/icons/mail.png" align="left">
				<p>fobosr@gmail.com</p>
			</a>
		</div>
	</div>

	<div id="location">
		<div id="adress">Офиса ни може да намерите на: ул. Индустриална №12, гр. Монтана</div>
		<div>
			<div id="map_canvas" width="100%" height="260px;" style="width: 100%; height: 260px;"></div>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
	window.onload = function() {
		var pos = new google.maps.LatLng(43.4088963, 23.2318185);

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
			title: 'Fobos ER - Офис'
		});
	}
	
</script>