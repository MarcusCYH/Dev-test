<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Resources\Employee as EmployeeResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeResource::collection(
            EmployeeController::paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $this->validatedPayload($request);

        $employee = Employee::create($payload);

        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $payload = $this->validatedPayload($request);


        $employee->update($payload);

        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([], 204);
    }
    
    /**
     * Validate payload from request
     *
     * @return void
     */
    public function validatedPayload(Request $request)
    {
        return $request->validate([
            'company_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'avatar' => 'nullable|string',
            'google2fa_secret' => 'nullable|string',
            'is_google2fa_enabled' => 'nullable|integer',
            'preferred_name' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'citizenship' => 'nullable|string',
            
        ]);
    }
        
}
