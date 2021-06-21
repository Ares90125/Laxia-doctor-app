<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Stuff;

class StuffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('id')) {
            $stuff = Stuff::find($this->route('id'));
            return $stuff && $this->user()->can('update', $stuff);
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
            'stuffs' => ['required', 'array'],
            'stuffs.name' => 'required|string|max:255',
            'stuffs.kana' => 'required|string|max:255',
            'stuffs.duty' => 'required|string|max:255',
            'stuffs.job_id' => 'required|integer|exists:mtb_jobs,id',
            'stuffs.experience_year' => 'required|integer',
            'stuffs.career' => 'required',
            'stuffs.profile' => 'required',
            'specialities' => ['required', 'array'],
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
            'stuffs.name' => '氏名(漢字)',
            'stuffs.kana' => '氏名(カタカナ)',
            'stuffs.duty' => '役職',
            'stuffs.job_id' => '職種',
            'stuffs.experience_year' => '医師歴',
            'stuffs.career' => '経歴',
            'stuffs.profile' => '資格',
        ];
    }
}
