<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    /**
     * リクエスト単位の承認を行う。不要な場合trueを返す。
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * バリデーションのルールセットを記述する。
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
    /**
     * バリデーションに失敗した時の処理。
     *
     * @param Validator $validator
     *
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }
}