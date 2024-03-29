<?php

namespace Admin\Http\Resources\Company;

use Admin\Http\Resources\Company\CompanyAvailableRating\CompanyAvailableRatingMinifiedResource;
use App\Foundations\File\MainRepo;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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

            'name' => $this->name,

            'company_field' => $this->company_field,

            'client_id' => $this->client_id,

            'stopped_at' => $this->stopped_at,

            'active' => $this->stopped_at ? false: true,

            'client' => new UserMinifiedResource($this->client),

            'file' => new FileResource(MainRepo::getFile($this->file)),

            'company_available_ratings' => SystemLookupResource::collection($this->companyAvailableRatings),

            'company_available_ratings' => CompanyAvailableRatingMinifiedResource::collection($this->companyAvailableRatings),
        ];
    }
}
