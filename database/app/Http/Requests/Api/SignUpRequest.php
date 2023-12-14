<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SignUpRequest extends FormRequest
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
            'subscriber_id' => 'required|exists:subscribers,id',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
            'device_type' => 'required|in:' . implode(",", ['android', 'ios']),
            'device_token' => 'required',
            'district' => 'required',
            'blood_group' => 'required|in:' . implode(",", array_keys(bloodGroups())),
            'gender' => 'required|in:' . implode(",", array_keys(genders()))
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name field can not be empty'),
            'subscriber_id.required' => __('Subscriber field can not be empty'),
            'subscriber_id.exists' => __('Invalid subscriber'),
            'password.required' => __('Password field can not be empty'),
            'password.min' => __('Password length must be at least 8 characters.'),
            'password.confirmed' => __('Password and confirm password is not matched'),
            'email.required' => __('Email field can not be empty'),
            'phone.required' => __('Phone field can not be empty'),
            'email.email' => __('Invalid email address'),
            'device_type.required' => __('Device type is required'),
            'device_type.in' => __('Device type is invalid'),
            'device_token.required' => __('Device token is required'),
            'district.required' => __('District is required'),
            'blood_group.required' => __('Blood group is required'),
            'blood_group.in' => __('Blood group is invalid'),
            'gender.required' => __('Gender is required'),
            'gender.in' => __('Gender is invalid'),
        ];
    }

    public function failedValidation(Validator $validator)
    {

        if ($this->header('accept') == "application/json") {
            $errors = '';
            if ($validator->fails()) {
                $e = $validator->errors()->all();
                foreach ($e as $error) {
                    $errors .= $error . "\n";
                }
            }
            $json = [
                'success' => false,
                'message' => $errors,
                'data' => null
            ];
            $response = new JsonResponse($json, 422);

            throw (new ValidationException($validator, $response))->errorBag($this->errorBag)->redirectTo($this->getRedirectUrl());
        } else {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}
