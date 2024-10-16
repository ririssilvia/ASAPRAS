<?php

namespace App\Console\Commands;

use App\Models\GarduInduk;
use App\Models\GarduWeather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchWeatherForecast extends Command
{
    protected $signature = 'fetch:weather-forecast';
    protected $description = 'Fetch weather forecast data from Weatherstack API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $garduInduks =  GarduInduk::all()->toArray();
        $arrLat = [];
        $arrLong = [];
        foreach ($garduInduks as $garduInduk) {
            array_push($arrLat, $garduInduk['lat']);
            array_push($arrLong, $garduInduk['log']);
        }
        $latSting = implode(",",$arrLat);
        $arrLong = implode(",",$arrLong);
        // Http get
        $url = "https://api.open-meteo.com/v1/forecast?latitude=$latSting&longitude=$arrLong&current=temperature_2m&hourly=temperature_2m&timezone=Asia%2FBangkok&forecast_days=3";
        $response = Http::get($url)->collect();
        if ($response) {
            $arrayWeather= [];
            foreach ($response as $resIndex => $res) {
                if ($res['hourly']['time'] && $res['hourly']['temperature_2m']) {
                    $now = now();
                    foreach ($res['hourly']['time'] as $timeIndex => $value) {
                        array_push($arrayWeather, [
                            'id_gi' => $garduInduks[$resIndex]['id_gi'],
                            'temperature' => $res['hourly']['temperature_2m'][$timeIndex],
                            'time' => $value,
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                    }
                }
            }
            GarduWeather::upsert($arrayWeather, uniqueBy: ['id_gi', 'time'], update: ['temperature']);
        }
    }
}




