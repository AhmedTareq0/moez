<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function country()
    {
        // dd('ddd');
        $countries = Country::get();
        return response()->json($countries);
    }

    public function city(Request $request, $country)
    {
        $cities = City::where('country_id', $country)->get();
        return response()->json($cities);
    }
}
