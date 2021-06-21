<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TreatCase;

class CaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('id')) {
            $case = TreatCase::find($this->route('id'));
            return $case && $this->user()->can('update', $case);
        }
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
            'cases' => ['required', 'array'],
            'cases.menu_id' => 'required|integer|exists:menus,id',
            'cases.stuff_id' => 'required|integer|exists:stuffs,id',
            'cases.patient_age' => 'required|integer',
            'cases.patient_gender' => 'required',
            'cases.case_description' => 'required',
            'cases.treat_risk' => 'required',
            'cases.before_photo' => 'nullable|string|max:255',
            'cases.after_photo' => 'nullable|string|max:255',
            'categories' => ['required', 'array'],
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
            'cases.menu_id' => 'メニュー名',
            'cases.speciality_id' => 'カテゴリー',
            'cases.stuff_id' => '担当者',
            'cases.patient_age' => '施術者の年齢',
            'cases.patient_gender' => '施術者の性別',
            'cases.case_description' => '施術者の解説',
            'cases.treat_risk' => '施術者の解説',
            'cases.before_photo' => 'beforeの写真',
            'cases.after_photo' => 'afterの写真',
        ];
    }
}
