<?php
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

$response = Http::acceptJson()->withHeaders([
    'x-rapidapi-host' => 'v3.football.api-sports.io',
    'x-rapidapi-key' => 'b1ae4a3fca89630148dadaa295a0b5b7'
])->get('https://v3.football.api-sports.io/standings?league=4&season=2020');


$collection = collect($response->json()['response'][0]);

//echo $collection;
foreach(json_decode($collection)->league->standings as $pool=>$value)
    {
      foreach(json_decode($collection)->league->standings[$pool] as $country)
          {
              echo $country->team->name.'<br>';
          }
        echo '<br>';
    }
/**
echo "GROUP A: ------------" . '<br>';
echo "1: " .json_decode($collection)->league->standings[0][0]->team->name.'<br>';
echo "2: " .json_decode($collection)->league->standings[0][1]->team->name.'<br>';
echo "3: " .json_decode($collection)->league->standings[0][2]->team->name.'<br>';
echo "4: " .json_decode($collection)->league->standings[0][3]->team->name.'<br>';

echo "GROUP B: ------------" . '<br>';
echo "1: " .json_decode($collection)->league->standings[1][0]->team->name.'<br>';
echo "2: " .json_decode($collection)->league->standings[1][1]->team->name.'<br>';
echo "3: " .json_decode($collection)->league->standings[1][2]->team->name.'<br>';
echo "4: " .json_decode($collection)->league->standings[1][3]->team->name.'<br>';

foreach (json_decode($collection)->league->standings as $poule)
    {
        foreach($poule as $pool)
            {
                echo $pool->team->name."<br>";
            }
    }

**/
