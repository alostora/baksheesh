<?php

namespace Client\Http\Resources\ClientWithdrawalRequest;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientWithdrawalRequestResource extends JsonResource
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

               'amount' => $this->amount,

               'discount_percentage' => $this->discount_percentage,

               'status' => $this->withdrawalRequestStatus,

               'created_at' => $this->created_at,
          ];
     }
}
