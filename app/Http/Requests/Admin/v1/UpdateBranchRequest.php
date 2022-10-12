<?php

namespace App\Http\Requests\Admin\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
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
            'branch_code' => 'required|unique:branches,branch_code,'.$this->id.',id',
            'branch_name' => 'required',
        ];
        
        return $rules;
    }

    public function messages()
    {
        $msgs = [
            'branch_code.required' => 'Branch Code is required.',
            'branch_code.unique' => 'Branch Code is aleady exist.',
            'branch_name.required' => 'Branch Name is required.',
        ];

        return $msgs;
    }
}
