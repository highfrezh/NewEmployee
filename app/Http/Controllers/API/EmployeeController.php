<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeSingleResource;

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
        $employees = Employee::all();

        return EmployeeResource::collection($employees);
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
    public function show(Employee $employee)
    {
        //
        return new EmployeeSingleResource($employee);
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
        $user = Employee::findOrfail($id);

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

        $user->update($request->all());

        return['message' => 'updated the user info'];
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
        $user = Employee::findOrfail($id);

        //delete country
        $user->delete();

        return['message' => 'department deleted successfully'];
    }

}
