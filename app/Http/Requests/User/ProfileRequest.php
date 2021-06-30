<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Patient;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if ($this->route('id')) {
        //     $case = TreatCase::find($this->route('id'));
        //     return $case && $this->user()->can('update', $case);
        // }
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
            'patients' => ['required', 'array'],
            'patients.unique_id' => 'required|string|unique:patients|max:255',
            'patients.nickname' => 'required|string|max:255',
            'patients.birthday' => 'nullable|date',
            'patients.intro' => 'nullable|string',
            'patients.area' => 'nullable',
            'patients.photo' => 'nullable|file|image',
            'patient_categories' => 'nullable|array'
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
            'patients.unique_id' => 'ユーザーID',
            'patients.nickname' => 'ニックネーム',
            'patients.birthday' => '生年月日',
            'patients.intro' => '自己紹介',
            'patients.area' => '施術を考えているエリア',
            'patients.photo' => '画像',
            'patient_categories' => 'カテゴリー'
        ];
    }
}
