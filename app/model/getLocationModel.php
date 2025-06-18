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

function getIpAdress(): array|string
{
  global $opt;
  $cIp = curl_init(URL_IP);
  curl_setopt_array($cIp, $opt);
  $response = curl_exec($cIp);

  $codeHttp = curl_getinfo($cIp, CURLINFO_RESPONSE_CODE);
  curl_close($cIp);

  if ($codeHttp != 200) {
    http_response_code($codeHttp);
    return "error - getIpAddress(): " . $codeHttp;
  }

  $ipData = json_decode($response, true);
  // $ipAddrLocal = $_SERVER["REMOTE_ADDR"];

  if (!isset($ipData["ip"])) {
    return "error - getIpAddress(): JSON response failed";
  }

  return $ipData["ip"];
}

/**
 * returns an array consisting of:
    country
    city
    lon
    lat
 * @param array $opt
 * @return array|string
 */
function getLocation(): array|string
{
  global $opt;
  $ipAddr = getIpAdress();

  // get location
  $urlLocation = URL_GEO
    . urlencode($ipAddr)
    . "?fields=1065169";

  $cLocation = curl_init($urlLocation);
  curl_setopt_array($cLocation, $opt);
  $response = curl_exec($cLocation);
  $codeHttp = curl_getinfo($cLocation, CURLINFO_RESPONSE_CODE);

  if ($codeHttp != 200) {
    http_response_code($codeHttp);
    return "error - getLocation(): " . $codeHttp;
  }

  return json_decode($response, true);
}
