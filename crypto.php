<?php

// Polygon API URL base and your API key
$apiKey = "zq_ujf8gikb5aQgmyimpTQ7CIIpN5x2x"; // Replace with your actual API key
$baseUrl = "https://api.polygon.io/v2/aggs/ticker/X:";

// List of cryptocurrencies to query
$cryptocurrencies = [
    ['name' => 'Bitcoin', 'symbol' => 'BTC'],
    ['name' => 'Ethereum', 'symbol' => 'ETH'],
    ['name' => 'Tether', 'symbol' => 'USDT'],
    ['name' => 'BNB', 'symbol' => 'BNB'],
    ['name' => 'USD Coin', 'symbol' => 'USDC'],
    ['name' => 'Ripple', 'symbol' => 'XRP'],
    ['name' => 'Cardano', 'symbol' => 'ADA'],
    ['name' => 'Solana', 'symbol' => 'SOL'],
    ['name' => 'Dogecoin', 'symbol' => 'DOGE'],
    ['name' => 'Polkadot', 'symbol' => 'DOT'],
    ['name' => 'Litecoin', 'symbol' => 'LTC'],
    ['name' => 'Avalanche', 'symbol' => 'AVAX'],
    ['name' => 'Shiba Inu', 'symbol' => 'SHIB'],
    ['name' => 'Wrapped Bitcoin', 'symbol' => 'WBTC'],
    ['name' => 'Chainlink', 'symbol' => 'LINK'],
    ['name' => 'Stellar', 'symbol' => 'XLM'],
    ['name' => 'Uniswap', 'symbol' => 'UNI'],
    ['name' => 'Cosmos', 'symbol' => 'ATOM'],
    ['name' => 'Monero', 'symbol' => 'XMR'],
    ['name' => 'Bitcoin Cash', 'symbol' => 'BCH'],
];


// Date range for the query
$startDate = "2018-01-09";
$endDate = "2024-07-23";

// Begin HTML table
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Cryptocurrency</th><th>Symbol</th><th>Last Close Price</th><th>All-Time High</th><th>Correction Range (%)</th></tr>";

// Iterate over each cryptocurrency
foreach ($cryptocurrencies as $crypto) {
    $symbol = $crypto['symbol'];
    $name = $crypto['name'];
    $url = "{$baseUrl}{$symbol}USD/range/1/day/{$startDate}/{$endDate}?adjusted=true&sort=asc&apiKey={$apiKey}";

    // Initialize a cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo "<tr><td colspan='5'>Error fetching data for {$name} ({$symbol}): " . curl_error($ch) . "</td></tr>";
        curl_close($ch);
        continue; // Skip this cryptocurrency if an error occurs
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $data = json_decode($response, true);

    // Initialize variables to store the last close price and the all-time high
    $lastClosePrice = null;
    $allTimeHigh = null;

    // Check if data is available
    if (isset($data['results']) && is_array($data['results'])) {
        $results = $data['results'];
        
        // Get the last close price
        $lastResult = end($results);
        $lastClosePrice = $lastResult['c'];

        // Calculate the all-time high
        foreach ($results as $dayData) {
            if ($allTimeHigh === null || $dayData['h'] > $allTimeHigh) {
                $allTimeHigh = $dayData['h'];
            }
        }

        // Calculate the correction range as a percentage
        $correctionRange = null;
        if ($allTimeHigh > 0) {
            $correctionRange = (($allTimeHigh - $lastClosePrice) / $allTimeHigh) * 100;
        }

        // Output the results for the current cryptocurrency in table rows
        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$symbol}</td>";
        echo "<td>" . number_format($lastClosePrice, 2) . "</td>";
        echo "<td>" . number_format($allTimeHigh, 2) . "</td>";
        echo "<td>" . number_format($correctionRange, 2) . "%</td>";
        echo "</tr>";

    } else {
        echo "<tr><td colspan='5'>{$url}</td></tr>";
    }
}

// End HTML table
echo "</table>";

?>
