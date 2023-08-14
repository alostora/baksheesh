<?php

namespace Admin\Http\Resources\Company\CompanyEmployee;

use Admin\Http\Resources\Company\CompanyMinifiedResourse;
use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyEmployeeResourse extends JsonResource
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

            'email' => $this->email,

            'phone' => $this->phone,

            'token' => $this->api_token,

            'account_type' => new SystemLookupResource($this->accountType),

            'client' => new CompanyEmployeeMinifiedResourse($this->client),
            
            'company' => new CompanyMinifiedResourse($this->company),

            'created_at' => $this->created_at,
        ];
    }
}


