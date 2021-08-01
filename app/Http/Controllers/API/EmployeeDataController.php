<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Department;

class EmployeeDataController extends Controller
{
    //
    public function departments(){

        $department = Department::all();

        return response()->json($department);
        
    }

    public function countries(){

        $countries = Country::all();

        return response()->json($countries);
    }

    public function states(Country $country){

        return response()->json($country->states);
    }

    public function cities(State $state){

        return response()->json($state->city);
    }
}
