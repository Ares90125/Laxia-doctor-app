<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Reservation extends JsonResource
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
            'clinic_name' => $this->clinic->name,
            'status' => $this->status,
            'visit_date' => $this->visit_date,
            'visit_time' => $this->visit_time,
            'mailbox' => $this->mailbox->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
