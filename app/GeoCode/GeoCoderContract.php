<?php

namespace App\GeoCode;

interface GeoCoderContract
{
    /**
     * Get the Lat Lng from the Google GeoCode API
     *
     * @param $addressLine1
     * @param $addressLine2
     * @param $city
     * @param $postcode
     * @return mixed
     */
    public function getLatAndLng($addressLine1, $addressLine2, $city, $postcode);
}