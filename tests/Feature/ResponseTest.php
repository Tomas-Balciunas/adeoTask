<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use App\Helper\Weather;

class ResponseTest extends TestCase
{
    // private $weather;
    // private $client;

    // protected function setUp(): void
    // {
    //     $baseUri = 'https://api.meteo.lt/';
    //     $client = new Client(['base_uri' => $baseUri]);
    //     $this->weather = $this->client->request('GET', 'v1/places/kaunas/forecasts/long-term');
    // }

    public function testShouldReturnSuccess()
    {
        $weather = $this->getWeather(200);
        $content = new Weather($weather);
        $result = $content->recByCity('kaunas');
        $this->assertEquals(200, $result->getStatusCode());
    }

    public function testShouldReturnNotFound()
    {
        $this->expectExceptionCode(404);
        $weather = $this->getWeather(404);
        $content = new Weather($weather);
        $content = $content->recByCity('kauns');
    }

    private function getWeather($status, $body = null)
    {
        $baseUri = 'https://api.meteo.lt/';
        $mock = new MockHandler([new Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler, 'base_uri' => $baseUri]);
    }

    public function testSuccess()
    {
        $response = $this->get('/api/products/recommendation/kaunas');
        $response->assertStatus(200);
    }

    public function testFailure()
    {
        $response = $this->get('/api/products/recommendation/kauns');
        $response->assertStatus(404);
    }
}
