<?php

namespace App\Http\Controllers\Backend\Auth\User;
use App\Models\Country;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{

    public function index(Request $request)
    {
        $name = 'name_' . app()->getLocale();
        $user = auth()->user();
        // dd($user);
        if($user->country){
            $country = Country::find($user->country)->first();
            $user->country = $country->$name;
        }
        if($user->city){
            $city = city::find($user->city)->first();
            $user->city = $city->$name;
        }
        return view('backend.account.index',compact('user'));
    }
}
