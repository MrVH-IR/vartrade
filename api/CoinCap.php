<?php
class CoinCap
{
    private $baseUrl = 'https://api.coincap.io/v2/assets';

    public function searchAssets($query)
    {
        $url = $this->baseUrl . '?search=' . urlencode($query);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function getAssetById($id)
    {
        $url = $this->baseUrl . '/' . urlencode($id);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
