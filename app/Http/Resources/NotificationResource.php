<?php

namespace App\Http\Resources;

use App\Mahasiswa;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id'        => $this->id,
            'data'      => $this->data,
            'mahasiswa' => MahasiswaResource::make(Mahasiswa::find($this->data->mahasiswa_id)),
            'created'   => $this->created_at
        ];
    }
}
