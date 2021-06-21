<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PatientInfo;

class PatientInfoRequest extends FormRequest
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
            'patientInfos' => ['required', 'array'],
            'patientInfos.name01' => 'required|string',
            'patientInfos.name02' => 'required|string',
            'patientInfos.kana01' => 'required|string',
            'patientInfos.kana02' => 'required|string',
            'patientInfos.birthday' => 'required|date',
            'patientInfos.gender' => 'required|string',
            'patientInfos.phone_number' => 'required|string',
            'memo' => 'nullable',
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
            'patientInfos.name01' => '氏名(性)',
            'patientInfos.name02' => '氏名(名)',
            'patientInfos.kana01' => 'シメイ(セイ)',
            'patientInfos.kana02' => 'シメイ(メイ)',
            'patientInfos.birthday' => '生年月日',
            'patientInfos.gender' => '性別',
            'patientInfos.phone_number' => '電話番号',
            'memo' => '患者メモ'
        ];
    }
}
