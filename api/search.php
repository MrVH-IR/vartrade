<?php
require_once 'CoinCap.php';

if (isset($_GET['searchData'])) {
    $query = $_GET['searchData'];
    $coinCap = new CoinCap();
    $result = $coinCap->searchAssets($query);

    echo json_encode($result['data']);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Invalid request']);
