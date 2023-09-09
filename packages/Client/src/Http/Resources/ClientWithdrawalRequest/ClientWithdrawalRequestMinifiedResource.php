<?php

namespace Client\Http\Resources\ClientWithdrawalRequest;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientWithdrawalRequestMinifiedResource extends JsonResource
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

               'status' => $this->withdrawalRequestStatus,

               'admin_notes' => $this->admin_notes,

               'client_notes' => $this->client_notes,

               'action_at' => $this->action_at,

               'action_by_id' => $this->action_by,

               'created_at' => $this->created_at,
          ];
     }
}
