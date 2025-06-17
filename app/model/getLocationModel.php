<?php
define("URL_IP", "https://api.ipify.org/?format=json");
define("URL_GEO", "http://ip-api.com/json/");

$opt = [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_CONNECTTIMEOUT => 10,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_FAILONERROR => true,
  CURLOPT_FOLLOWLOCATION => false
];


// get IP address
$cIp = curl_init(URL_IP);
curl_setopt_array($cIp, $opt);
$response = curl_exec($cIp);

$codeHttp = curl_getinfo($cIp, CURLINFO_RESPONSE_CODE);
curl_close($cIp);

if ($codeHttp != 200) {
  http_response_code($codeHttp);
  echo $codeHttp;
}

$ipData = json_decode($response, true);
$ipAddr = "";
$ipAddrLocal = "";

if (isset($ipData["ip"])) {
  $ipAddr = $ipData["ip"];
} else {
  echo "error: JSON response failed: nu contine campul \"ip\".";
}

if (isset($_SERVER["REMOTE_ADDR"])) {
  $ipAddrLocal = $_SERVER["REMOTE_ADDR"];
}


// get location
$url_location = URL_GEO
  . urlencode($ipAddr)
  . "?fields=1065169";

$cLocation = curl_init($url_location);
curl_setopt_array($cLocation, $opt);
$response = curl_exec($cLocation);
$codeHttp = curl_getinfo($cLocation, CURLINFO_RESPONSE_CODE);

if ($codeHttp != 200) {
  http_response_code($codeHttp);
  echo "Status code: " . $codeHttp;
}

$locationData = json_decode($response, true);
$coun = $locationData["country"];
$city = $locationData["city"];
$long = $locationData["lon"];
$latd = $locationData["lat"];

// echo $coun, " ", $city, " ", $long, " ", $latd;
