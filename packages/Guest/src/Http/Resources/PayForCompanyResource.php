<?php

namespace Guest\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Lang;

class PayForCompanyResource extends JsonResource
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

               'company_id' => $this->company_id,

               'amount' => $this->amount .Lang::get('employee_wallet.SAR'),

               'payer_name' => $this->payer_name,

               'payer_email' => $this->payer_email,

               'payer_phone' => $this->payer_phone,

               'notes' => $this->notes,

          ];
     }
}
