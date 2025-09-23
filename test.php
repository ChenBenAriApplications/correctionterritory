<?php
// Replace with your actual API key
$apiKey = "zq_ujf8gikb5aQgmyimpTQ7CIIpN5x2x";

// Get inputs for the ticker symbol and date range
$ticker = "WMT";
$startDate ="2018-01-09";
$endDate = "2023-02-10";
 $url = "https://api.polygon.io/v2/aggs/ticker/$ticker/range/1/day/$startDate/$endDate?adjusted=true&sort=asc&apiKey=$apiKey";
    $response = file_get_contents($url);
    $data=json_decode($response, true);
    $results = $data['results'];

    foreach ($results as $dayData) {
      echo  $highPrice = $dayData['h']."<br/>";
     
     }  


?>