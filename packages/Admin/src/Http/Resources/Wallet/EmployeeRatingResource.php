<?php

namespace Admin\Http\Resources\Wallet;

use Admin\Http\Resources\Company\CompanyMinifiedResource;
use App\Http\Resources\Auth\UserMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeRatingResource extends JsonResource
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

            'employee' => new UserMinifiedResource($this->employee),

            'rating' => new EmployeeRatingResource($this->availableRating),

            'rating_value' => $this->rating_value,

            'payer_name' => $this->payer_name,

            'payer_email' => $this->payer_email,

            'payer_phone' => $this->payer_phone,

            'guest_key' => $this->guest_key,

            'created_at' => $this->created_at,
        ];
    }
}
