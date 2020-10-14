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
    
    <title>Random Number API</title>
  </head>
  <body>


</head>
<body>

<div class="container py-1 mt-1">
  <div class="alert alert-secondary">
    <h4>Random Number API</h4>
			<p>This API leverages two different API's from RapidAPI. Built using PHP, it passes today's date as the number for the parameter.  The random fact comes from <a href="https://rapidapi.com/divad12/api/numbers-1">Numbers</a> and the image from <a href="https://rapidapi.com/microsoft-azure-org-microsoft-cognitive-services/api/bing-image-search1">Bing Image Search</a>
			</p>
  </div>

<?php
include 'inc_api.php';

//vars
$day = date("j");
$month = date("n");

//start numbers search
$myCurlFact = "https://numbersapi.p.rapidapi.com/" . $month . "/" . $day . "/date?fragment=true&json=true";
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => $myCurlFact,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: numbersapi.p.rapidapi.com",
		$curlheadkey 
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
	//{ "text": "the 1964-1965 New York World's Fair opens for its second and final season", "year": 1965, "number": 112, "found": true, "type": "date" }
	//echo $myReponse1['year'];
	//echo $myReponse1['text'];
}


$myReponse1 = json_decode($response, true);
echo "<p>Today is: " . date("l, jS \of F Y,  h:i:s A e") . "</p>";
echo "<p>On this date in " .  $myReponse1['year'] . "...<br />&nbsp;&nbsp;";
echo $myReponse1['text'] . "</p>";


//need 543x362px img


//echo $myCurl;



//start image search
$myCurlImg = "https://bing-image-search1.p.rapidapi.com/images/search?count=2&safeSearch=strict&q=" . $day;
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => $myCurlImg,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: bing-image-search1.p.rapidapi.com",
		$curlheadkey
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {


	$character = json_decode($response, true);
	//echo $response;
	//echo "<p>" . $character['value'][0]['contentUrl'] . "</p>";
	//echo "<p>" . $character['value'][0]['width'] . "</p>";
	//echo "<p>" . $character['value'][0]['height'] . "</p>";
	
	//echo '<img src="' . $character['value'][0]['contentUrl'] . '">';

	//echo '<img src="http://yachatsbrewing.com/wp-content/uploads/2016/09/Taplist-Numbers-23.png">';


}
/*
echo '<p>1</p>';
echo $response;
echo '<p>13/p>';
echo $character['value'][1]['contentUrl'];
echo '<p>2</p>';
*/



$myHeight =  $character['value'][1]['height'];
$myWidth = $character['value'][1]['width'];
$xFactor = $myHeight/300;
$myNewWidth  = $myWidth/$xFactor;


echo '<img src="' . $character['value'][1]['contentUrl'] . '" width="'.$myNewWidth.'px" height="300px">';



/*

' . $character['value'][1]['contentUrl'] . '\'); 
height: 200px; 
width: ' . $myNewWidth . 'px; 
background-repeat: no-repeat;" />';
*/

/*
echo '<br>';

	echo '<div style="background-image: url(\'' . $character['value'][1]['contentUrl'] . '\'); 
	height: ' . $character['value'][1]['height'] . 'px; 
	width: ' . $character['value'][1]['width'] . 'px; 
	background-repeat: no-repeat;" />';
*/



//<div style="background-image: url('h     vg.png');">abc</div>
//<div style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/24-Logo.svg/1200px-24-Logo.svg.png'">abc</div>
//<div style="background-image: url('img_girl.jpg');">

?>



</body>
</html>