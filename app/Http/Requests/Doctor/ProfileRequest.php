<?php

namespace App\Http\Requests\Doctor;

// use App\Http\Requests\Api\Request;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('validation.attributes.doctor.id'),
        ];
    }
}
