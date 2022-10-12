<?php

namespace App\Http\Requests\Admin\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
    // public function rules()
    // {
    //     return [
    //         //
    //     ];
    // }

    public function rules()
    {
        $rules = [
            'branch_id' => 'required',
            'team_code' => 'required|unique:teams,team_code',
            'team_name' => 'required',
        ];
        
        return $rules;
    }

    public function messages()
    {
        $msgs = [
            'branch_id.required' => 'Branch is required.',  
            'team_code.required' => 'Team Code is required.',
            'team_code.unique' => 'Team Code is aleady exist.',
            'team_name.required' => 'Team Name is required.',
        ];

        return $msgs;
    }
}
