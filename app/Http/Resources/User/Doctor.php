<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Doctor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'kana' => $this->kana,
            'duty' => $this->duty,
            'job_name' => $this->job ? $this->job->name : "",
            'experience_year' => $this->experience_year,
            'career' => $this->career,
            'profile' => $this->profile,
            'photo' => $this->photo,
            'ave_diaries_rate' => $this->ave_diaries_rate,
            'clinic_id' => $this->clinic_id,
            'clinic_name' => $this->clinic ? $this->clinic->name : '',
            'diaries_count' => $this->diaries_count,
            'counseling_count' => $this->counseling_count,
            'cases_count' => $this->cases_count,
            'likes_count' => $this->likes_count,
            'is_like' => $this->is_like,
            'is_favorite' => $this->is_favorite,
            'views_count' => $this->views_count,
        ];
    }
}
