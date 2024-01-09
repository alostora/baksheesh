<?php

namespace Client\Http\Resources\ClientWithdrawalRequest;

use App\Http\Resources\Auth\UserMinifiedResource;
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

            'amount' => $this->amount,

            'status' => $this->withdrawalRequestStatus,

            'admin_notes' => $this->admin_notes,

            'client_notes' => $this->client_notes,

            'bank_transfer_number' => $this->bank_transfer_number,

            'action_at' => $this->action_at,

            'action_by_id' => $this->action_by,

            'created_at' => $this->created_at,

            'client' => new UserMinifiedResource($this->client),
        ];
    }
}
