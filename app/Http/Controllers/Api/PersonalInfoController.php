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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $this->validatedPayload($request);

        if ($request->hasFile('nric_front_copy')) {
            $file = $request->file('nric_front_copy');
            $url = $file->store('attachments/personal_infos', 's3');
            $payload['nric_front_copy'] = $url;
        }

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalInfo $personalInfo)
    {
        $payload = $this->validatedPayload($request);

        if ($request->hasFile('nric_front_copy')) {
            $file = $request->file('nric_front_copy');
            $url = $file->store('attachments/personal_infos', 's3');
            $payload['nric_front_copy'] = $url;
        }

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
            'name' => 'nullable|string',
            'nric' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'nric_front_copy' => 'nullable|image',
            'mobile_no' => 'nullable|string',
            'gender' => 'nullable|integer',
            'nationality' => 'nullable|string',
            'religion_id' => 'nullable|integer',
            'occupation' => 'nullable|string',
            'marital_status' => 'nullable|integer',
            
        ]);
    }
}
