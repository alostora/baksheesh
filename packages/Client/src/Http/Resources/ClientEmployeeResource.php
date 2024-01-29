<?php

namespace Client\Http\Resources;

use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientEmployeeResource extends JsonResource
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

            'account_type' => new SystemLookupResource($this->accountType),

            'client' => new UserMinifiedResource($this->client),

            'created_at' => $this->created_at,

            'stopped_at' => $this->stopped_at,

            'active' => $this->stopped_at ? false : true,

        ];
    }
}
