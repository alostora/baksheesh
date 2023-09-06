<?php

namespace Admin\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyMinifiedResource extends JsonResource
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

            'id' => $this->id,
            'name' => $this->name,
            'client_id' => $this->client_id,
            'stopped_at' => $this->stopped_at,
        ];
    }
}
