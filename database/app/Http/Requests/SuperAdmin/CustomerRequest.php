<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        return [
            "email" => "required|email",
            "username" => "required",
            "password" => "required|min:8",
            "company_name" => "required",
//            "vat_number" => "required",
            "address" => "required",
//            "zip_code" => "required",
            "city" => "required",
            "country" => "required",
            "start_date" => "required",
//            "subscription_package_id" => "required|exists:subscription_packages,id",
            "status" => 'required|in:' . implode(",", array_keys(customerStatus())),
//            "logo" => "file",
//            "credit" => "required|integer|min:0|max:999999999",
//            "image" => "file"
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('Email can not be empty'),
            'email.email' => __('Invalid email address'),
            'username.required' => __('Username can not be empty'),
            'username.unique' => __('Username already exists'),
            'password.required' => __('Password can not be empty'),
            'password.min' => __('Password must be at least 8 characters'),
            'company_name.required' => __('Company can not be empty'),
            'vat_number.required' => __('Vat number can not be empty'),
            'address.required' => __('Address can not be empty'),
            'zip_code.required' => __('Zip Code can not be empty'),
            'city.required' => __('City can not be empty'),
            'country.required' => __('Country can not be empty'),
            'start_date.required' => __('Start date can not be empty'),
            'end_date.required' => __('End date can not be empty'),
            'subscription_package_id.required' => __('Invalid subscription package'),
            'subscription_package_id.exists' => __('Invalid subscription package'),
            'status.required' => __('Status can not be empty'),
            'status.in' => __('Invalid status'),
            'credit.integer' => __('Credit must be an integer'),
            'credit.required' => __('Credit can not be empty'),
            'credit.min' => __('Credit should be minimum 0'),
            'credit.max' => __('Credit should be maximum 999999999'),
        ];
    }
}
