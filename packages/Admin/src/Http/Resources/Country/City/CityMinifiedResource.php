<?php

namespace Admin\Http\Resources\Country\City;

use Admin\Http\Resources\Country\CountryMinifiedResource;
use Admin\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityMinifiedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'governorate_id' => $this->governorate_id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'prefix' => $this->prefix,
            'stopped_at' => $this->stopped_at,
            'active' => $this->stopped_at ? false : true,

        ];
    }
}
