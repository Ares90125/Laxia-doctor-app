<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Me extends JsonResource
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
            'nickname' => $this->nickname,
            'unique_id' => $this->unique_id,
            'name' => $this->name,
            'kana' => $this->kana,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'gender' => $this->gender,
            'intro' => $this->intro,
            'intro' => $this->intro,
            'area' => $this->photo,
            'follows_count' => $this->follows_count,
            'followers_count' => $this->followers_count,
            'point' => $this->point,
        ];
    }
}
