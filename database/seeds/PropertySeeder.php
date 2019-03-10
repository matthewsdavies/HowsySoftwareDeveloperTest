<?php

use Illuminate\Database\Seeder;
use \App\Http\Controllers\Properties\GeoCodeFactory as GeoCodeFactory;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_GB');

        for ($i=0; $i < 10; $i++) {
            $property = \App\Property::create([
                'address_line_1' => $faker->buildingNumber.' '.$faker->streetName,
                'address_line_2' => null,
                'city' => $faker->city,
                'postcode' => $faker->postcode
            ]);

            $geoCode = (new GeoCodeFactory($property))->getLatAndLng();
            $property->latitude = $geoCode['lat'];
            $property->longitude = $geoCode['lng'];
            $property->save();
        }
    }
}
