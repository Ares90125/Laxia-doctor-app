<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Reservation;

class RsvWithUserInfoRequest extends FormRequest
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
            'reservations' => ['required', 'array'],
            'reservations.visit_date' => 'required|date',
            'reservations.start_time' => 'required|string',
            'reservations.end_time' => 'required|string',
            'reservations.stuff_id' => 'required|integer|exists:stuffs,id',
            'reservations.rsv_content_id' => 'required|integer|exists:mtb_rsv_contents,id',
            'reservations.menu_id' => 'required|integer|exists:menus,id',
            'patient_infos' => ['required', 'array'],
            'patient_infos.name01' => 'required|string',
            'patient_infos.name02' => 'required|string',
            'patient_infos.kana01' => 'required|string',
            'patient_infos.kana02' => 'required|string',
            'patient_infos.birthday' => 'required|date',
            'patient_infos.gender' => 'required|string',
            'patient_infos.phone_number' => 'required|string',
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
            'reservations.visit_date' => '日にち',
            'reservations.start_time' => '診察時間',
            'reservations.end_time' => '診察時間',
            'reservations.stuff_id' => '医師・スタッフ',
            'reservations.rsv_content_id' => '予約内容',
            'reservations.menu_id' => '施術メニュー',
            'patient_infos.name01' => '氏名(性)',
            'patient_infos.name02' => '氏名(名)',
            'patient_infos.kana01' => 'シメイ(セイ)',
            'patient_infos.kana02' => 'シメイ(メイ)',
            'patient_infos.birthday' => '生年月日',
            'patient_infos.gender' => '性別',
            'patient_infos.phone_number' => '電話番号',
        ];
    }
}
