<?php
$apiKey = '3LcGDlYJGST1jXsimEjh8piuITsoW3Wm';
$ticker = 'AAPL';

// Calcular a data do último mês
$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-1 month'));

// Construir a URL com o período do último mês
$url = "https://api.polygon.io/v2/aggs/ticker/$ticker/range/1/day/$startDate/$endDate?adjusted=true&sort=asc&apiKey=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);

$results = [];
foreach ($data['results'] as $dayData) {
  $results[] = [
    'date' => date('Y-m-d', $dayData['t'] / 1000), // Converte o timestamp para uma data legível
    'close' => $dayData['c'] // Preço de fechamento
  ];
}

echo json_encode($results);
