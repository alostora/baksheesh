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

               'admin_notes' => $this->admin_notes,

               'client_notes' => $this->client_notes,

               'action_at' => $this->action_at,

               'action_by' => $this->action_by_id,

               'created_at' => $this->created_at,
          ];
     }
}
