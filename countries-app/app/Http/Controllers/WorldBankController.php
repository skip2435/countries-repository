<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WorldBankController extends Controller
{
    public function getEconomicData($countryCode)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/NY.GDP.PCAP.CD?format=json');
        $data = json_decode($response->getBody()->getContents(), true);

        $gdpData = [];
        foreach ($data[1] as $entry) {
            if ($entry['value'] !== null) {
                $gdpData[] = [
                    'year' => $entry['date'],
                    'gdpPerCapita' => $entry['value'],
                ];
            }
        }

        return response()->json($gdpData);
    }
}

