<?
$city = $_GET['city'];
if (empty($city)) {
	$city = 'jakarta';
}
$xml = simplexml_load_file('http://www.google.com/ig/api?weather=' . $city);
$information = $xml->xpath("/xml_api_reply/weather/forecast_information");
$current = $xml->xpath("/xml_api_reply/weather/current_conditions");
$forecast_list = $xml->xpath("/xml_api_reply/weather/forecast_conditions");
?>
<html>
	<head>
		<title>Google Weather API</title>
		<style type="text/css" media="screen">	
			body {
				font-family:"Lucida Grande","Lucida Sans Unicode",Arial,Verdana,sans-serif;
				font-size:12px;
				color:#4D4D4D;
			}
			
			h2 {
				font-size:14px;				
			}
			.weather {
				background:#EEF2F6;
				padding:4px;
				margin-bottom:2px;
				width:400px;
				overflow:hidden;
			}			
			.weather img {
				vertical-align:middle;
				float:left;
				margin-right:4px;
			}
		</style>
	</head>
	<body>
		<h1><?= print $information[0]->city['data']; ?></h1>
		<h2>Today's weather</h2>
		<div class="weather">		
		<img src="<?= 'http://www.google.com' . $current[0]->icon['data']?>" alt="weather"?>
		<span class="condition">
			<?= $current[0]->temp_f['data'] ?>&deg; F,
			<?= $current[0]->condition['data'] ?>
		</span>
		</div>
		<h2>Forecast</h2>
		<? foreach ($forecast_list as $forecast) : ?>
			<div class="weather">
				<img src="<?= 'http://www.google.com' . $forecast->icon['data']?>" alt="weather"?>
				<div><?= $forecast->day_of_week['data']; ?></div>
				<span class="condition">
					<?= $forecast->low['data'] ?>&deg; F - <?= $forecast->high['data'] ?>&deg; F,
					<?= $forecast->condition['data'] ?>
				</span>
			</div>	
		<? endforeach ?>
	</body>
</html>	