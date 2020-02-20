<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\PersonalInfo;
use App\Http\Resources\PersonalInfoResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return PersonalInfoResource::collection(
        //    PersonalInfo::paginate(5)
        //);
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

        $personalInfo = Auth::guard('api')->user()->personal_info()->firstOrCreate($payload);

        //$personalInfo = PersonalInfo::create($payload);

        return new PersonalInfoResource($personalInfo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalInfo $personalInfo)
    {
        return new PersonalInfoResource(Auth::guard('api')->user()->personal_info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalInfo $personalInfo)
    {
        $payload = $this->validatedPayload($request);

        $personalInfo = Auth::guard('api')->user()->personal_info;

        $personalInfo->update($payload);

        return new PersonalInfoResource($personalInfo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalInfo $personalInfo)
    {
        $personalInfo->delete();

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
            'nric' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'nric_front_copy' => 'nullable|string',
            'mobile_no' => 'nullable|string',
            'gender' => 'nullable|integer',
            'nationality' => 'nullable|string',
            'religion_id' => 'nullable|integer',
            'occupation' => 'nullable|string',
            'marital_status' => 'nullable|integer',
            
        ]);
    }
        
}
