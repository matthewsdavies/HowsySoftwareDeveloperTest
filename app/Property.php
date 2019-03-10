<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'city',
        'postcode'
    ];

    /**
     * Array of Validation Rules.
     *
     * @var array
     */
    protected static $rules = [
        'address_line_1' => 'required',
        'address_line_2',
        'city' => 'required',
        'postcode' => 'required',
    ];
}
