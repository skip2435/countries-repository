<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WorldBankController extends Controller
{
    public function getEconomicData($countryCode)
    {
        $client = new Client();

        // Get GDP per capita
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/NY.GDP.PCAP.CD?format=json');
        $gdpPerCapitaData = json_decode($response->getBody()->getContents(), true);

        // Get total GDP
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/NY.GDP.MKTP.CD?format=json');
        $totalGdpData = json_decode($response->getBody()->getContents(), true);

        // Get unemployment data
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/SL.UEM.TOTL.ZS?format=json');
        $unemploymentData = json_decode($response->getBody()->getContents(), true);

        // Get inflation rate data
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/FP.CPI.TOTL.ZG?format=json');
        $inflationData = json_decode($response->getBody()->getContents(), true);

        // Get interest rate data
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/FR.INR.RINR?format=json');
        $interestRateData = json_decode($response->getBody()->getContents(), true);

        // Get economic growth rate data
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/NY.GDP.MKTP.KD.ZG?format=json');
        $growthRateData = json_decode($response->getBody()->getContents(), true);

        // Get income inequality data
        $response = $client->request('GET', 'http://api.worldbank.org/v2/country/'.$countryCode.'/indicator/SI.POV.GINI?format=json');
        $incomeInequalityData = json_decode($response->getBody()->getContents(), true);

        // Combine data
        $economicData = [];
        foreach ($gdpPerCapitaData[1] as $i => $entry) {
            if ($entry['value'] !== null 
                && $totalGdpData[1][$i]['value'] !== null 
                && $unemploymentData[1][$i]['value'] !== null
                && $inflationData[1][$i]['value'] !== null
                && $interestRateData[1][$i]['value'] !== null
                && $growthRateData[1][$i]['value'] !== null
                && $incomeInequalityData[1][$i]['value'] !== null) {
                $economicData[] = [
                    'year' => $entry['date'],
                    'gdpPerCapita' => $entry['value'],
                    'totalGdp' => $totalGdpData[1][$i]['value'],
                    'unemploymentRate' => $unemploymentData[1][$i]['value'],
                    'inflationRate' => $inflationData[1][$i]['value'],
                    'interestRate' => $interestRateData[1][$i]['value'],
                    'growthRate' => $growthRateData[1][$i]['value'],
                    'incomeInequality' => $incomeInequalityData[1][$i]['value'],
                ];
            }
        }

        return response()->json($economicData);
    }
}

