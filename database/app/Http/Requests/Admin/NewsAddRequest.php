<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsAddRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'required_if:id,==,""',
            'news' => 'required',
            'status' => 'required|in:' . implode(",", array_keys(newsStatus())),
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('News title can not be empty'),
            'image.required_if' => __('Image can not be empty'),
            'status.required' => __('Status can not be empty'),
            'news.required' => __('News body can not be empty'),
            'status.in' => __('Invalid status'),
        ];
    }
}
