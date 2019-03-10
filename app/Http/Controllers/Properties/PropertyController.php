<?php

namespace App\Http\Controllers\Properties;

use App\Property;
use App\GeoCode\GeoCoderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;

class PropertyController extends Controller
{
    /**
     * @var GeoCoderContract
     */
    protected $geoCoder;

    /**
     * PropertyController constructor.
     *
     * @param GeoCoderContract $geoCoder
     */
    public function __construct(GeoCoderContract $geoCoder)
    {
        $this->geoCoder = $geoCoder;
    }

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
     * @param StorePropertyRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(StorePropertyRequest $request)
    {
        $validatedData = $request->validated();

        $property = Property::create($validatedData);

        $geoCode = $this->geoCoder->getLatAndLng(
                $property->address_line_1,
                $property->address_line_2,
                $property->city,
                $property->postcode
            );

        $property->latitude = $geoCode['lat'];
        $property->longitude = $geoCode['lng'];
        $property->save();

        return response()->json($property, 201);
    }
}
