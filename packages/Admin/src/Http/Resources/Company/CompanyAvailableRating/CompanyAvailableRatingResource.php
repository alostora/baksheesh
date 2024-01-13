<?php

namespace Admin\Http\Resources\Company\CompanyAvailableRating;

use Admin\Http\Resources\Company\CompanyMinifiedResource;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyAvailableRatingResource extends JsonResource
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

            'company' => new CompanyMinifiedResource($this->company),

            'client' => new UserMinifiedResource($this->client),

            'available_rating' => new SystemLookupResource($this->availableRating),
        ];
    }
}
