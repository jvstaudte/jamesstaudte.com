<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      href="http://fonts.googleapis.com/css?family=Oswald:400,700|Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/bootstrap.css" />

    <link rel="stylesheet" href="../css/style.css" />

    <style>
        div { padding: 30px;}
    </style>
    
    <title>AQI API</title>
  </head>
  <body>


</head>
<body>

<div class="container py-1 mt-1">
  <div class="alert alert-secondary">
    <h4>AQI API</h4>
      <p>This API uses the Air Quality API at RapidAPI.  It is built using PHP and passes the latitude and longitude of a location in the middle of San Francisco as its parameters.  It then shows the AQI Index and the corresponding color and description.  More details can be found here: <a href="https://rapidapi.com/weatherbit/api/air-quality">Air Quality</a></p>
  </div>

<?php
include 'inc_api.php';
//start aqi search

$curl = curl_init();

curl_setopt_array($curl, array(
	//CURLOPT_URL => "https://air-quality.p.rapidapi.com/forecast/airquality?lon=-122.443677&lat=37.778720",
	CURLOPT_URL => "https://air-quality.p.rapidapi.com/current/airquality?lon=-122.443677&lat=37.778720",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		$curlhead1,
		$curlhead2 
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
	//echo '<br />';
	$myReponse1 = json_decode($response, true);
	$myAQI = $myReponse1['data']['0']['aqi'];
   // $myAQI = 11;

	
	

switch (true) {
  case  ($myAQI <= 50):
    echo '<div style="background-color: green; color: white">' 
        . $myAQI 
        . ' Green: Good</div>';
    break;
  case  ($myAQI <= 100):
    echo '<div style="background-color: yellow; color: black">' 
        . $myAQI 
        . ' Yellow: Moderate</div>';
    break;
  case  ($myAQI <= 150):
    echo '<div style="background-color: orange; color: white">' 
        . $myAQI 
        . ' Orange: Unhealthy for Sensitive Groups</div>';
    break;
  case  ($myAQI <= 200):
     echo '<div style="background-color: red; color: white">' 
        . $myAQI 
        . ' Red: Unhealthy</div>'; 
    break;
  case  ($myAQI <= 300):
    echo '<div style="background-color: purple; color: white">' 
        . $myAQI 
        . ' Purple: Very Unhealthy</div>';
    break;
  default:
    echo '<div style="background-color: maroon; color: white">' 
        . $myAQI 
        . ' Maroon: Hazardous</div>';
}	

	//{"data":[{"mold_level":1,"aqi":199,"pm10":123.362,"co":1649.84,"o3":85.1667,"predominant_pollen_type":"Trees","so2":1,"pollen_level_tree":3,"pollen_level_weed":1,"no2":7.5,"pm25":92,"pollen_level_grass":null}],"city_name":"San Francisco","lon":-122.44,"timezone":"America\/Los_Angeles","lat":37.78,"country_code":"US","state_code":"CA"} 
}

/*
$myReponse1 = json_decode($response, true);
echo "<p>Today is: " . date("l, jS \of F Y,  h:i:s A e") . "</p>";
echo "<p>On this date in " .  $myReponse1['year'] . "...<br />&nbsp;&nbsp;";
echo $myReponse1['text'] . "</p>";
$day = date("j");
*/

?>

</div>

</body>
</html>
