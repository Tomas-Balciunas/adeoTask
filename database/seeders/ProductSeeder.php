<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use Faker\Factory;
use Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Products::create([
            'name' => $faker->city,
            'price' => $faker->randomNumber(2),
            'weather_condition_id' => rand(1, 13)
        ]);
        }
    }
}
