<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubscriptionPackageCreateRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'number_of_locations' => 'required|integer|min:1',
            'number_of_calendars' => 'required|integer|min:1',
            'status' => 'required|in:' . implode(",", array_keys(subscriptionPackageStatus())),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name can not be empty'),
            'price.required' => __('Price can not be empty'),
            'price.numeric' => __('Price must be a number'),
            'price.min' => __('Price should be minimum 0'),
            'number_of_locations.required' => __('Location number can not be empty'),
            'number_of_locations.min' => __('Location number should be minimum 1'),
            'number_of_calendars.min' => __('Calendar number should be minimum 1'),
            'number_of_calendars.required' => __('Calendar number can not be empty'),
            'status.required' => __('Status can not be empty'),
            'number_of_locations.integer' => __('Location number must be a number'),
            'number_of_calendars.integer' => __('Calendar number must be a number'),
            'status.in' => __('Invalid status'),
        ];
    }
}
