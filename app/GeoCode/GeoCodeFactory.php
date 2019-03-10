<?php

namespace App\Http\Controllers\Properties;

use App\Property;
use GuzzleHttp\Client;

class GeoCodeFactory
{
    /**
     * @var Property
     */
    private $property;

    /**
     * @var Client
     */
    private $client;

    /**
     * API Url
     *
     * @var string
     */
    private $apiUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=';

    /**
     * GeoCodeFactory constructor.
     *
     * @param Property $property
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
        $this->client = new Client();
    }

    /**
     * Get the Lat Lng from the Google GeoCode API
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLatAndLng()
    {
        $addressURL = $this->getFormattedAddress();
        $request = $this->client->request('GET', $this->apiUrl.$addressURL);
        $response = json_decode($request->getBody()->getContents());

        if (!empty($response) && $response->status != 'ZERO_RESULTS') {
            return [
                'lat' => $response->results[0]->geometry->location->lat,
                'lng' => $response->results[0]->geometry->location->lat,
            ];
        }

        return [
            'lat' => null,
            'lng' => null,
        ];

    }

    /**
     * Format the address ready for the API call
     *
     * @return string
     */
    private function getFormattedAddress()
    {
        return  urlencode($this->property->address_line_1) . ',' .
            urlencode($this->property->address_line_2) . ',' .
            urlencode($this->property->city) . ',' .
            urlencode($this->property->postcode) .
            '&key=' . env('GOOGLE_MAPS_API_KEY');
    }
}