<?php

namespace App\GeoCode;

use App\Property;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class GeoCodeFactory implements GeoCoderContract
{
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
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get the Lat Lng from the Google GeoCode API
     *
     * @param $addressLine1
     * @param $addressLine2
     * @param $city
     * @param $postcode
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLatAndLng($addressLine1, $addressLine2, $city, $postcode)
    {
        $addressURL = $this->getFormattedAddress($addressLine1, $addressLine2, $city, $postcode);

        try {
            $request = $this->client->request('GET', $this->apiUrl.$addressURL);
            $response = json_decode($request->getBody()->getContents());

            if (!empty($response) && $response->status !== 'ZERO_RESULTS') {
                return [
                    'lat' => $response->results[0]->geometry->location->lat,
                    'lng' => $response->results[0]->geometry->location->lat,
                ];
            }
        }
        catch (ClientException $exception) {
            var_dump($exception->getRequest(), $exception->getResponse() );
        }

        return [
            'lat' => null,
            'lng' => null,
        ];

    }

    /**
     * Format the address ready for the API call
     *
     * @param $addressLine1
     * @param $addressLine2
     * @param $city
     * @param $postcode
     * @return string
     */
    private function getFormattedAddress($addressLine1, $addressLine2, $city, $postcode)
    {
        return urlencode($addressLine1) . ',' .
            urlencode($addressLine2) . ',' .
            urlencode($city) . ',' .
            urlencode($postcode) .
            '&key=' . env('GOOGLE_MAPS_API_KEY');
    }
}