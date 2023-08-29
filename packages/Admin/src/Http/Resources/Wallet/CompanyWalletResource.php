<?php

namespace Admin\Http\Resources\Wallet;

use Admin\Http\Resources\Company\CompanyMinifiedResource;
use App\Http\Resources\Auth\UserMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyWalletResource extends JsonResource
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

            'client' => new UserMinifiedResource($this->client),

            'company' => new CompanyMinifiedResource($this->company),

            'amount' => $this->amount,

            'payer_name' => $this->payer_name,

            'payer_email' => $this->payer_email,

            'payer_phone' => $this->payer_phone,

            'notes' => $this->notes,

            'created_at' => $this->created_at,
        ];
    }
}
