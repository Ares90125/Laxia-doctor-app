<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Reservation;

class RsvPayRequest extends FormRequest
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
            'payments' => ['required', 'array'],
            'payments.total_price' => 'required|integer|min:1',
            'payments.except_item' => 'nullable|string',
            'payments.except_price' => 'required|integer'
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
            'payments.total_price' => '合計金額',
            'payments.except_item' => '除外金額',
            'payments.except_price' => '除外項目'
        ];
    }
}
