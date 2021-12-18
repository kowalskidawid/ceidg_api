<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nip' => $this->nip,
            'name' => $this->name,
            'zip_code' => $this->zip_code,
            'county' => $this->county,
            'municipality' => $this->county,
            'city' => $this->city,
            'street' => $this->street,
            'pkd_codes' => $this->pkd_codes
        ];
    }
}
