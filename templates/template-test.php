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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>






	<div class="container">

		<div class='col-md-5'>
			<div class="form-group">
				<div class='input-group date' id='datetimepicker7'>
					<input type='text' class="form-control" />
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>
	</div>








	<script type="text/javascript">
		$(document).ready(function() {
			$(function() {
				$('#datetimepicker6').datetimepicker();
				$('#datetimepicker7').datetimepicker({
					useCurrent: false //Important! See issue #1075
				});
				$("#datetimepicker6").on("dp.change", function(e) {
					$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
				});
				$("#datetimepicker7").on("dp.change", function(e) {
					$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
				});
			});
		});
	</script>

	<form method="post" action="distance(" onsubmit="">
		<div style="border-radius:10px;background-color:white;margin:30px;right:40px;" class='input-group date input-box input-form ' id='datetimepicker6'>
			<input type='text' class="form-control" />
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
		<input style="border-radius:10px;background-color:white;margin:30px;" placeholder="Start GPS Location" class="input-box input-form " type="email" name="ne" required>
		<input id="end_gps_location" style="border-radius:10px;background-color:white;margin:30px;" placeholder="End GPS Location" class="input-box input-form " type="email" name="ne" required>
		<div class=" button-wrap">
			<button class="smart-button" type="submit" value="Subscribe">
				Request delivery
			</button>
		</div>
		<input type="button" class="button-voting" onclick="distance(start_gps_location.value, end_gps_location.value)" value="Request Delivery" alt="Thank you!" />
	</form>




	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCS9C0YTzYEEbq4U6nrSlgo5q_CHMPl1MQ&callback=initMap">
	</script>


	<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<script src="/assets/gmap3.js?body=1" type="text/javascript"></script>
	<div id="map-wrapper">
		<div id="map-canvas" style="width: 500px; height: 500px;"></div>
	</div>


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

		var startLong = 6.981903;
		var startLat = 49.412069;


		var endLong = 6.964063;
		var endLat = 49.409031;


		var middleLong = (startLong + endLong) / 2;
		var middleLat = (startLat + endLat) / 2;

		var total_dist = distance(startLat, startLong, endLat, endLong, "K");
		console.log(total_dist);

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
				return function() {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
				}
			})(marker, i));
		}
	</script>




	<?php print_r(updateSymbol("cost")) ?>
	<?php get_template_part('template-parts/footer-menus-widgets'); ?>

	<?php get_footer(); ?>


	<script>
		// Read in GPS location
		navigator.geolocation.getCurrentPosition(function(location) {
			var start_gps_location_id = document.getElementById('start_gps_location');
			start_gps_location_id.value = location.coords.latitude + ";" + location.coords.longitude;
		});



		$(".form_datetime").datetimepicker({
			format: 'yyyy-mm-dd hh:ii'
		});
		$(function() {
			$('#datetimepicker1').datetimepicker();
		});
	</script>