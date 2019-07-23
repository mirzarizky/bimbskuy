<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'              => $this->name,
            'email'             => $this->email,
            'avatar'            => $this->avatar,
            'email_verified_at' => $this->email_verified_at,
            'activated_at'      => $this->activated_at,
            'role'              => $this->role->name
        ];
    }
}
