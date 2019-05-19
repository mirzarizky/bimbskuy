<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
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
            'id'            => $this->id,
            'nama'          => $this->nama,
            'nip'           => $this->nip,
            'kode_bimbing'  => $this->kode_bimbing,
            'kode_wali'     => $this->kode_wali
        ];
    }
}
