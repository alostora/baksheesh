<?php

namespace Admin\Http\Resources\Company\CompanyEmployee\EmployeeAvailableRating;

use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeMinifiedResource;
use Admin\Http\Resources\Company\CompanyMinifiedResource;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeAvailableRatingResource extends JsonResource
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

            'employee' => new CompanyEmployeeMinifiedResource($this->employee),

            'available_rating' => new SystemLookupResource($this->availableRating),
        ];
    }
}
