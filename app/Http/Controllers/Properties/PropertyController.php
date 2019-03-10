<?php

namespace App\Http\Controllers\Properties;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    /**
     * Return a collection of properties
     *
     * @return Property[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return Property::all();
    }

    /**
     * Return a single property
     *
     * @param Property $property
     * @return Property
     */
    public function get(Property $property)
    {
        return $property;
    }

    /**
     * Create a new property
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Request $request)
    {
        $property = Property::create([
            'address_line_1' => $request->get('address_line_1'),
            'address_line_2' => $request->get('address_line_2'),
            'city' => $request->get('city'),
            'postcode' => $request->get('city'),
        ]);

        $geoCode = (new GeoCodeFactory($property))->getLatAndLng();
        $property->latitude = $geoCode['lat'];
        $property->longitude = $geoCode['lng'];
        $property->save();

        return response()->json($property);
    }
}
