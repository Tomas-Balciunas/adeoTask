<?php

namespace App\Helper;

use App\Models\Products;
use App\Models\WeatherCondition;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class Weather
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function recByCity($city)
	{

		if (Cache::has($city)) {
			$result = Cache::get($city);
			return $result;
		} else {
			$rec = $this->endpointRequest('v1/places/' . $city . '/forecasts/long-term');
			$result = response()->json($rec);
			Cache::put($city, $result, now()->addMinutes(5));
			return $result;
		}
	}

	public function endpointRequest($url)
	{
		try {
			$response = $this->client->request('GET', $url);
			return $this->response_handler($response->getBody()->getContents());
		} catch (\Exception $e) {
			return $e->getMessage();
		}

		
	}

	public function response_handler($response)
	{
		if ($response) {
			$resp = json_decode($response, true);
			$filt = $resp['forecastTimestamps'];
			$content = ['weather_data_source' => 'Lietuvos Hidrometeorologijos Tarnyba prie Aplinkos ministerijos','city' => $resp['place']['name'], 'recommendations' => []];
			$k = 0;
			$weather = WeatherCondition::all();
			
			for ($i = 0; $k < 3; $i++) {
				if ($filt[$i]['forecastTimeUtc'] == now()->endOfDay()->addSecond()->addHours(12)->addDays($k)->toDateTimeString()) {
					$id = WeatherCondition::where(['condition' => $filt[$i]['conditionCode']])->first()->id;
					array_push($content['recommendations'], [
						'weather_forecast' => $filt[$i]['conditionCode'],
						'date' => substr($filt[$i]['forecastTimeUtc'], 0, 10),
						'products' => $weather->find($id)->products->take(2)
					]);
					$k++;
				}
			}

			return $content;
		}

		return [];
	}
}
