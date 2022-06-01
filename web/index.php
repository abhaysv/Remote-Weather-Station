<!--
Title: Mahindra University Weather Status
Authors: Abhay SV
-->
<?php
$api_url = 'https://api.thingspeak.com/channels/1755530/feeds.json?api_key=JILE4HUXIVMTY0WJ&results=4';


$json_data = file_get_contents($api_url);
$response_data = json_decode($json_data);
$weather_feeds = $response_data->feeds;
$weather_feeds = array_slice($weather_feeds, 0, 4);
$latest = count($weather_feeds) - 1;

$rain_status = $weather_feeds[$latest]->field1 ? 'Raining' : 'Not Raining';

foreach ($weather_feeds as $feed) {
	$feed->created_at = str_replace('T', ' @ ', $feed->created_at);
	$feed->created_at = str_replace('Z', ' Hrs', $feed->created_at);
}

function weather_feels($temp, $rain)
{
	$weather_feels = ($temp > 30 && !$rain)
		? 'Mostly Sunny'
		: (($temp > 25 && !$rain)
			? 'Partly Sunny'
			: 'Overcast / Raining');
	return $weather_feels;
}
function weather_icon($temp, $rain)
{
	$weather_feels = ($temp > 30 && !$rain)
		? 'clear-day'
		: (($temp > 25 && !$rain)
			? 'partly-cloudy-day'
			: 'rain');
	return $weather_feels;
}
function humidity_feels($humid, $rain)
{
	$humidity_feels = ($humid > 3 && !$rain)
		? 'Feels Dry'
		: (($humid > 2.5 && !$rain)
			? 'Partly Humid'
			: 'Extremely Wet / Raining');
	return $humidity_feels;
}

function pollution_feels($humid)
{
	$humidity_feels = ($humid < 30)
		? 'Feels Healthy'
		: (($humid < 61)
			? 'Feels Ok'
			: 'Feels like Delhi');
	return $humidity_feels;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Mahindra University Weather Status</title>
	<!-- custom-theme -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Aridity Weather Widget Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //custom-theme -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- js -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<!-- //js -->
	<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
	<link href="css/easy-responsive-tabs.css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
</head>

<body onload="startTime()">
	<div class="main">
		<h1>Mahindra University Weather Status</h1>
		<div class="w3_agile_main_grids">
			<div class="w3layouts_main_grid">
				<div class="w3layouts_main_grid_left">
					<h2>Bahadurpally, Hyderabad</h2>
					<p><?php echo weather_feels($weather_feeds[$latest]->field1, $weather_feeds[$latest]->field4); ?></p>
					<h3>Now</h3>
					<h4><?php echo $weather_feeds[$latest]->field1; ?><span>°c</span></h4>
				</div>
				<div class="w3layouts_main_grid_right">
					<?php echo '<canvas id="'.weather_icon($weather_feeds[$latest]->field1, $weather_feeds[$latest]->field4).'" width="70" height="70"> </canvas>';?>
					<div id="w3time"></div>
					<div class="w3layouts_date_year">
						<!-- date -->
						<script type="text/javascript">
							var mydate = new Date()
							var year = mydate.getYear()
							if (year < 1000)
								year += 1900
							var day = mydate.getDay()
							var month = mydate.getMonth()
							var daym = mydate.getDate()
							if (daym < 10)
								daym = "0" + daym
							var dayarray = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday")
							var montharray = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December")
							document.write("" + dayarray[day] + ", " + montharray[month] + " " + daym + ", " + year + "")
						</script>
						<!-- //date -->
					</div>
				</div>
				<div class="clear"> </div>
			</div>

			<div class="agileits_w3layouts_main_grid">
				<div class="agile_main_grid_left">
					<div class="wthree_main_grid_left_grid">
						<div class="w3ls_main_grid_left_grid1">
							<div class="w3l_main_grid_left_grid1_left">
								<h3>Humidity Index</h3>
								<p><?php echo $weather_feeds[$latest]->field2; ?> <span>%</span></p>
							</div>
							<div class="w3l_main_grid_left_grid1_right">
								<canvas id="partly-cloudy-day" width="45" height="45"></canvas>
							</div>
							<div class="clear"> </div>
						</div>
						<div class="w3ls_main_grid_left_grid1">
							<div class="w3l_main_grid_left_grid1_left">
								<h3>Rain Status</h3>
								<p><?php echo $rain_status; ?><span></span></p>
							</div>
							<div class="w3l_main_grid_left_grid1_right">
								<canvas id="cloudy" width="45" height="45"></canvas>
							</div>
							<div class="clear"> </div>
						</div>
						<div class="w3ls_main_grid_left_grid1">
							<div class="w3l_main_grid_left_grid1_left">
								<h3>Pollution Index</h3>
								<p><?php echo $weather_feeds[$latest]->field3; ?> <span>%</span></p>
							</div>
							<div class="w3l_main_grid_left_grid1_right">
								<canvas id="wind" width="45" height="45"></canvas>
							</div>
							<div class="clear"> </div>
						</div>
					</div>
				</div>
				<div class="w3_agileits_main_grid_right">
					<div class="agileinfo_main_grid_right_grid">
						<div id="parentHorizontalTab">
							<ul class="resp-tabs-list hor_1">
								<li>Temperture</li>
								<li>Humidity</li>
								<li>Pollution Index</li>
							</ul>
							<div class="resp-tabs-container hor_1">
								<div class="w3_agileits_tabs">
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest]->field1; ?><i>°c</i><span><?php echo weather_feels($weather_feeds[$latest]->field1, $weather_feeds[$latest]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 1]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 1]->field1; ?><i>°c</i><span><?php echo weather_feels($weather_feeds[$latest - 1]->field1, $weather_feeds[$latest - 1]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 2]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 2]->field1; ?><i>°c</i><span><?php echo weather_feels($weather_feeds[$latest - 2]->field1, $weather_feeds[$latest - 2]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 3]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 3]->field1; ?><i>°c</i><span><?php echo weather_feels($weather_feeds[$latest - 3]->field1, $weather_feeds[$latest - 3]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
								</div>
								<div class="w3_agileits_tabs">
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest]->field2; ?><i>%</i><span><?php echo humidity_feels($weather_feeds[$latest]->field2, $weather_feeds[$latest]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 1]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 1]->field2; ?><i>%</i><span><?php echo humidity_feels($weather_feeds[$latest - 1]->field2, $weather_feeds[$latest - 1]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 2]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 2]->field2; ?><i>%</i><span><?php echo humidity_feels($weather_feeds[$latest - 2]->field2, $weather_feeds[$latest - 2]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 3]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 3]->field2; ?><i>%</i><span><?php echo humidity_feels($weather_feeds[$latest - 3]->field2, $weather_feeds[$latest - 3]->field4); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
								</div>
								<div class="w3_agileits_tabs">
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest]->field3; ?><i>%</i><span><?php echo pollution_feels($weather_feeds[$latest]->field3); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 1]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 1]->field3; ?><i>%</i><span><?php echo pollution_feels($weather_feeds[$latest - 1]->field3); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 2]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 2]->field3; ?><i>%</i><span><?php echo pollution_feels($weather_feeds[$latest - 2]->field3); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="w3_main_grid_right_grid1">
										<div class="w3_main_grid_right_grid1_left">
											<p><?php echo $weather_feeds[$latest - 3]->created_at; ?></p>
										</div>
										<div class="w3_main_grid_right_grid1_right">
											<p><?php echo $weather_feeds[$latest - 3]->field3; ?><i>%</i><span><?php echo pollution_feels($weather_feeds[$latest - 3]->field3); ?></span></p>
										</div>
										<div class="clear"> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		<div class="agileits_copyright">
			<p>
				 Mahindra University Weather V:1.2. All Systems : Operational | Show More Data <a href="show_graphs.php">CLICK HERE !!!</a>
			</p>
		</div>
	</div>
	<!-- sky-icons -->
	<script src="js/skycons.js"></script>
	<script>
		var icons = new Skycons({
				"color": "#D1D100"
			}),
			list = [
				"sleet", "clear-day"
			],
			i;

		for (i = list.length; i--;)
			icons.set(list[i], list[i]);

		icons.play();
	</script>
	<script>
		var icons1 = new Skycons({
				"color": "#000000"
			}),
			list = [
				"clear-night", "partly-cloudy-day",
				"partly-cloudy-night", "cloudy", "rain", "clear-day", "snow", "wind",
				"fog"
			],
			i;

		for (i = list.length; i--;)
			icons1.set(list[i], list[i]);

		icons1.play();
	</script>
	<!-- //sky-icons -->
	<!-- tabs -->
	<script src="js/easyResponsiveTabs.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			//Horizontal Tab
			$('#parentHorizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion
				width: 'auto', //auto or any width like 600px
				fit: true, // 100% fit in a container
				tabidentify: 'hor_1', // The tab groups identifier
				activate: function(event) { // Callback function if tab is switched
					var $tab = $(this);
					var $info = $('#nested-tabInfo');
					var $name = $('span', $info);
					$name.text($tab.text());
					$info.show();
				}
			});
		});
	</script>
	<!-- //tabs -->
	<!-- time -->
	<script>
		function startTime() {
			var today = new Date();
			var h = today.getHours();
			var m = today.getMinutes();
			var s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('w3time').innerHTML =
				h + ":" + m + ":" + s;
			var t = setTimeout(startTime, 500);
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i
			}; // add zero in front of numbers < 10
			return i;
		}
	</script>
	<!-- //time -->
</body>

</html>