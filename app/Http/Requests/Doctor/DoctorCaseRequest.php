<?php

namespace App\Http\Requests\Doctor;

use App\Models\Doctor;
use Illuminate\Foundation\Http\FormRequest;

class DoctorCaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category' => ['required', 'array'],
            'age' => 'required|integer',
            'gender' => 'required|string',
            'operation' => 'required|string',
            'operationRisk' => 'required|string',
            // 'majordoctorComment' => 'required|string',
            'before_photo' => ['required', 'array'],
            'after_photo' => ['required', 'array'],
            'menuProperty' => ['required', 'array'],
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
            'title' => __('validation.attributes.doctor.cases.title'),
            'category' => __('validation.attributes.doctor.category'),
            'age' => __('validation.attributes.doctor.cases.age'),
            'gender' => __('validation.attributes.doctor.cases.gender'),
            'operation' => __('validation.attributes.doctor.cases.operation'),
            'operationRisk' => __('validation.attributes.doctor.cases.operationRisk'),
            // 'majordoctorComment' => __('validation.attributes.doctor.cases.majordoctorComment'),
            'before_photo' => __('validation.attributes.doctor.cases.before_photo'),
            'after_photo' => __('validation.attributes.doctor.cases.after_photo'),
            'menuProperty' => __('validation.attributes.doctor.cases.menuProperty'),
        ];
    }
}
