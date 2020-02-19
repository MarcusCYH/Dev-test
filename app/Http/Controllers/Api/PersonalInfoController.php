<?php

namespace App\Http\Controllers\Api;

use App\PersonalInfo;
use App\Http\Resources\PersonalInfo as PersonalInfoResource;
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
        return PersonalInfoResource::collection(
            PersonalInfoController::paginate(5)
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

        $personalInfo = PersonalInfo::create($payload);

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
        return new PersonalInfoResource($personalInfo);
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
            'nric' => 'required|string',
            'date_of_birth' => 'required|date',
            'nric_front_copy' => 'required|string',
            'mobile_no' => 'required|string',
            'gender' => 'required|integer',
            'nationality' => 'required|string',
            'religion_id' => 'required|integer',
            'occupation' => 'required|string',
            'marital_status' => 'required|integer',
            
        ]);
    }
        
}
