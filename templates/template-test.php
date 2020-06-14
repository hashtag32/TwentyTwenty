<?php

/**
 * Template Name: Test Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">


  
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>














	<script type="text/javascript">
		$(document).ready(function() {
			$(function() {
				$('#datetimepicker_start').datetimepicker();
			});
		});
	</script>
	<div class="section-inner">

		<form method="post" action="" onsubmit="">
			<div class='input-group' id='datetimepicker_start'>
				<input style="border-radius:10px;background-color:white;margin:30px;" type='text' class="input-box input-form" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>

			<div class="input-group mb-3">
				<input id="start_gps_location_input" style="border-radius:10px;background-color:white;margin:30px;margin-bottom:0px" placeholder="Start GPS Location" class="input-box input-form " type="text" name="ne" required>
				<!-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
				<div style="margin:auto;width:90%" class="input-group-append">
					<!-- todo:start coordinates here -->
					<a target="_blank" href="https://www.google.com/maps/@49.406876,6.9686856,15z?hl=de-DE">
						<span class="input-group-text " id="basic-addon2">Search on Maps</span>
					</a>
				</div>
			</div>


			<div class="input-group mb-3">
				<input id="end_gps_location_input"  placeholder="End GPS Location" class="input-form " type="text" name="ne" required>
				<!-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
				<div style="margin:auto;width:90%" class="input-group-append">
					<!-- todo:start coordinates here -->
					<a target="_blank" href="https://www.google.com/maps/@49.406876,6.9686856,15z?hl=de-DE">
						<span class="input-group-text " id="basic-addon2">Search on Maps </span>
					</a>
				</div>
			</div>

			<h2 id="distance_h2" class="own-h2 has-accent-color" style="font-size:35px">Distance: </h2>
			<h2 id="price_h2" class="own-h2 has-accent-color" style="font-size:35px">Price: </h2>

			<input id="email_input" style="border-radius:10px;background-color:white;margin:30px;" placeholder="enter email" class="input-box input-form " type="text" name="ne" required>

			<div class=" button-wrap">
				<button class="smart-button" type="submit" value="Subscribe" onClick="displayMap();">
					Request delivery
				</button>
			</div>
		</form>



		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCS9C0YTzYEEbq4U6nrSlgo5q_CHMPl1MQ&callback=initMap">
		</script>

		<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
		<script src="/assets/gmap3.js?body=1" type="text/javascript"></script>
		<div id="map-wrapper">
			<div id="map-canvas" style="width: 500px; height: 500px;"></div>
		</div>
		<div>


			<style>
				html,
				body,
				#map-wrapper,
				#map_canvas {
					margin: 0;
					padding: 0;
					height: 100%;
					width: 100%;
				}
			</style>
			<div id="map-wrapper">
				<div id="map_canvas" style="width: 500px; height: 500px;"></div>
			</div>


			<script>



			</script>




			<?php print_r(updateSymbol("cost")) ?>
			<?php get_template_part('template-parts/footer-menus-widgets'); ?>

			<?php get_footer(); ?>


			<script>
				// Read in GPS location
				navigator.geolocation.getCurrentPosition(function(location) {
					var start_gps_location_id = document.getElementById('start_gps_location_input');
					start_gps_location_id.value = location.coords.latitude + ", " + location.coords.longitude;
				});


				function checkForm() {
					return true;
				}
				// Set the marker on maps
				function displayMap() {
					var start_gps_location_id = document.getElementById('start_gps_location_input');
					var start_gps_value = start_gps_location_id.value;

					var startLong;
					var startLat;
					if (start_gps_value != "") {
						start_gps_array = start_gps_value.split(/, /);
						startLat = parseFloat(start_gps_array[0]);
						startLong = parseFloat(start_gps_array[1]);
					} else {
						//todo:remove
						startLat = 49.412069;
						startLong = 6.981903;
					}

					var end_gps_location_id = document.getElementById('end_gps_location_input');

					var end_gps_value = end_gps_location_id.value;

					var endLat;
					var endLong;
					if (end_gps_value != "") {
						end_gps_array = end_gps_value.split(/, /);
						endLat = parseFloat(end_gps_array[0]);
						endLong = parseFloat(end_gps_array[1]);
					} else {
						//todo:remove
						startLat = 49.412069;
						startLong = 6.981903;
					}



					// var endLat = 49.409031;
					// var endLong = 6.964063;




					var middleLong = (startLong + endLong) / 2;
					var middleLat = (startLat + endLat) / 2;

					var total_dist_km = distance(startLat, startLong, endLat, endLong, "K");
					total_dist_m = (total_dist_km * 1000).toFixed(2);
					document.getElementById('distance_h2').innerText += total_dist_m + " m";

					var price_dollar = price(total_dist_m);


					document.getElementById('price_h2').innerText += " ~" + price_dollar + " $";



					console.log(total_dist_m);
					console.log(middleLong);
					console.log(middleLat);

					var locations = [
						['Start Point', startLat, startLong],
						['End Point', endLat, endLong],
					];


					var map = new google.maps.Map(document.getElementById('map-canvas'), {
						zoom: 13,
						center: new google.maps.LatLng(middleLat, middleLong),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});

					var infowindow = new google.maps.InfoWindow();

					var marker, i;

					for (i = 0; i < locations.length; i++) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map
						});

						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							console.log("fired");
							return function() {
								infowindow.setContent(locations[i][0]);
								infowindow.open(map, marker);
							}
						})(marker, i));
					}



				}






				// General functions


				function price(distance_m) {
					// 2.5$ fixed + 1$ per 200m
					return 2.5 + 1 * distance_m / 200;
				}

				function distance(lat1, lon1, lat2, lon2, unit) {
					if ((lat1 == lat2) && (lon1 == lon2)) {
						return 0;
					} else {
						var radlat1 = Math.PI * lat1 / 180;
						var radlat2 = Math.PI * lat2 / 180;
						var theta = lon1 - lon2;
						var radtheta = Math.PI * theta / 180;
						var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
						if (dist > 1) {
							dist = 1;
						}
						dist = Math.acos(dist);
						dist = dist * 180 / Math.PI;
						dist = dist * 60 * 1.1515;
						if (unit == "K") {
							dist = dist * 1.609344
						}
						if (unit == "N") {
							dist = dist * 0.8684
						}
						return dist;
					}
				}
			</script>



			<?php

			function sendMail($requesterMail, $startCoordinates, $endCoordinates, $date)
			{
				$subject = "New Delivery request";
				$content = 'From: ' . $requesterMail . ' \n StartCoordinates: ' . $startCoordinates . ' \n EndCoordinates: ' . $endCoordinates . ' \n Date: ' . $date;
				$recipient = "request@stockvoting.net";
				// $mailheader = "From: alex@treib \r\n";
				mail($recipient, $subject, $content) or die("Error!");
			}




			?>