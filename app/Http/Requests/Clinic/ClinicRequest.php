<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class ClinicRequest extends FormRequest
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
            'clinic' => ['required', 'array'],
            'clinic.name' => 'required|string',
            'clinic.pref_id' => 'nullable|integer|exists:mtb_prefs,id',
            'clinic.addr01' => 'nullable|string|max:255',
            'clinic.addr02' => 'nullable|string|max:255',
            'clinic.department' => 'nullable|string|max:255',
            'clinic.net_reservation' => 'nullable|string|max:255',
            'clinic.nearest_station' => 'nullable|string|max:255',
            'clinic.site' => 'nullable|string|max:255',
            'clinic.access' => 'nullable|string|max:255',
            'clinic.phone_number' => 'nullable|string|max:255',
            'clinic.working_time' => 'nullable|string|max:255',
            'clinic.credit_card' => 'nullable|string|max:255',
            'clinic.holidays' => 'nullable|string|max:255',
            'clinic.parking' => 'nullable|string|max:255',
            'clinic.company_title' => 'nullable|string|max:255',
            'clinic.company_profile' => 'nullable|string|max:255',
            'clinic.photo' => 'nullable|string|max:255',
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
            'clinic.name' => 'クリニック名',
            'clinic.pref_id' => '都道府県',
            'clinic.addr01' => '住所',
            'clinic.addr02' => '住所',
            'clinic.department' => '住所',
            'clinic.net_reservation' => 'ネット予約',
            'clinic.nearest_station' => '最寄駅',
            'clinic.site' => '公式サイト',
            'clinic.access' => 'アクセス',
            'clinic.phone_number' => '電話番号',
            'clinic.working_time' => '営業時間',
            'clinic.credit_card' => 'クレジットカード',
            'clinic.holidays' => '休業日',
            'clinic.parking' => '駐車場',
            'clinic.company_title' => 'タイトル',
            'clinic.company_profile' => '会社紹介文',
            'clinic.photo' => '',
        ];
    }
}
