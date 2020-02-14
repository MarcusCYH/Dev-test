<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch(Request::route()->getName())
        {
            case 'api.validate_token':
                return [
                    'email' => 'nullable',
                    'mobile_no' => 'nullable',
                    'token' => 'required|alpha'
                ];
                break;
            case 'api.login.provider.provider_login':
                return [
                    'name' => 'required',
                    'email' => 'nullable', // add require if
                    'mobile_no' => 'nullable', // add require if
                    'provider_id' => 'required', // facebook is user_id
                    'provider_token' => 'required'
                ];
                break;
            default:
                throw Exception('There are no valid validation set for route '.Request::path().' in '.get_class().'.');
        }

    }
}
