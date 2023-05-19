<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function getCountryInfo($countryName)
    {
        $response = Http::withOptions([
            'verify' => false
        ])->get('https://restcountries.com/v3.1/name/' . $countryName);
    
        $countryData = $response->json();
    
        if (empty($countryData)) {
            return response()->json('Country not found', 404);
        }
    
        $country = $countryData[0];
        return response()->json([
            'name' => $country['name']['common'],
            'capital' => $country['capital'][0],
            'flag' => $country['flags']['png'],
            'region' => $country['region'],
            'subregion' => $country['subregion'],
            'population' => $country['population'],
            'currencies' => implode(', ', array_keys($country['currencies'])), // Add this
        ]);
    }
}