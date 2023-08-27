<?php

namespace Client\Http\Resources;

use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientEmployeeMinifiedResource extends JsonResource
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

               'client_id' => $this->client_id,

               'name' => $this->name,

               'email' => $this->email,

               'phone' => $this->phone,

               'account_type' => new SystemLookupResource($this->accountType),

               'created_at' => $this->created_at,
          ];
     }
}
