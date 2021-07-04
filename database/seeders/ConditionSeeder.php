<?php

namespace Database\Seeders;

use App\Models\WeatherCondition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conditions = [
            'clear',
            'isolated-clouds',
            'scattered-clouds',
            'overcast ',
            'light-rain',
            'moderate-rain',
            'heavy-rain',
            'sleet',
            'light-snow',
            'moderate-snow',
            'heavy-snow',
            'fog',
            'na'
        ];

        foreach ($conditions as $condition) {
            WeatherCondition::create(['condition' => $condition]);
        }
    }
}
