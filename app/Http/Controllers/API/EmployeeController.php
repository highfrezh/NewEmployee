<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'last_name'   => 'required|string|max:191',
            'first_name'  => 'required|string|max:191',
            'middle_name' => 'required|string|max:191',
            'address'     => 'required|string|max:191',
            'department_id' => 'required|integer',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip_code' => 'required|integer',
            'birthday' => 'required',
            'date_hired' => 'required'
            
        ]);

        return Employee::create([
            'last_name'     => $request['last_name'],
            'first_name'    => $request['first_name'],
            'middle_name'   => $request['middle_name'],
            'address'       => $request['address'],
            'department_id' => $request['department_id'],
            'country_id'    => $request['country_id'],
            'state_id'      => $request['state_id'],
            'city_id'       => $request['city_id'],
            'zip_code'      => $request['zip_code'],
            'birthday'      => $request['birthday'],
            'date_hired'    => $request['date_hired'],
            
        ]);
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
