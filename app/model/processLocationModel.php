<?php

define("URL_IMP", "https://nominatim.openstreetmap.org/search?format=json");

$opt = [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_CONNECTTIMEOUT => 10,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_FAILONERROR => true,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_USERAGENT => "TidyTogether/1.0 (petrubraha@gmail.com)",
];

/**
 * example: https://nominatim.openstreetmap.org/search?format=json&city=Iasi
 * @param string|null $city
 * @return void
 [
   {
     "place_id": 55581162,
      ...
     "lat": "47.1615598",
     "lon": "27.5837814",
     "class": "boundary",
     "type": "administrative",
     "place_rank": 16,
     "importance": 0.642167030046915,
     "addresstype": "city",
     "name": "Iași",
     "display_name": "Iași, Iași Metropolitan Area, Iași, Roumanie",
     "boundingbox": [
       "47.0848238",
       ...
     ]
   },
   ... - might return multiple instances
 ]
 */
function processLocationModel(string $city): array|string
{
  if ("" === $city) {
    return [];
  }

  global $opt;
  $urlLocation = URL_IMP . "&city=" . $city;
  $cObj = curl_init($urlLocation);
  curl_setopt_array($cObj, $opt);
  $response = curl_exec($cObj);

  $codeHttp = curl_getinfo($cObj, CURLINFO_RESPONSE_CODE);
  curl_close($cObj);

  if ($codeHttp != 200) {
    //return "error - processLocationModel(): " . $codeHttp;
  }

  $data = json_decode($response, true);
  if (!isset($data)) {
    return "error - processLocationModel(): JSON response failed";
  }

  $ret = [];
  $ret["lat"] = $data[0]["lat"];
  $ret["lon"] = $data[0]["lon"];
  
  if (isset($data[0]["boundingbox"])) {
    $ret["boundingbox"] = $data[0]["boundingbox"];
    $ret["bounds"] = [
      "south" => (float)$data[0]["boundingbox"][0], //lat minima
      "north" => (float)$data[0]["boundingbox"][1], //lat maxima
      "west" => (float)$data[0]["boundingbox"][2], //long minima
      "east" => (float)$data[0]["boundingbox"][3] //long maxima
    ];
  }
  
  return $ret;
}
