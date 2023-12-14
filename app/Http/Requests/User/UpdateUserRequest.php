<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dealer_id' => 'required|integer',
            'up_fname' => 'required|string',
            'up_lname' => 'required|string',
            'up_email' => 'required|email|unique:users,email,' . request('dealer_id'),
            'up_phone' => 'nullable',
            'up_address' => 'nullable',
        ];
    }
}
