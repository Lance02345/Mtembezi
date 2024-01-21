<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather()
    {
        $apiKey = 'u7VZRYGrAxiQu81BN4hsCdzfAU1Z5uIFY';
        $cityKey = '224758'; // Replace with your actual city key

        $response = \Http::get("https://dataservice.accuweather.com/currentconditions/v1/{$cityKey}?apikey={$apiKey}");

        $weatherData = $response->json();

        return view('weather', ['weatherData' => $weatherData]);
    }}
