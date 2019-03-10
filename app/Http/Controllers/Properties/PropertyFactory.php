<?php

namespace App\Http\Controllers\Properties;

use Illuminate\Http\Request;

class PropertyFactory
{
    public function store(Request $request)
    {
        $property = Property::create([
            'address_line_1' => $request->get('address_line_1'),
            'address_line_2' => $request->get('address_line_2'),
            'city' => $request->get('city'),
            'postcode' => $request->get('city'),
        ]);
    }
}