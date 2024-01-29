<?php

namespace Admin\Http\Resources\Country\District;

use Admin\Http\Resources\Country\City\CityMinifiedResource;
use Admin\Http\Resources\Country\CountryMinifiedResource;
use Admin\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use Admin\Http\Resources\Country\Zone\ZoneMinifiedResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'name' => $this->name,
            'prefix' => $this->prefix,
            'stopped_at' => $this->stopped_at,
            'active' => $this->stopped_at ? false: true,
            'country' => new CountryMinifiedResource($this->country),
            'governorate' => new GovernorateMinifiedResource($this->governorate),
            'city' => new CityMinifiedResource($this->city),
            'zone' => new ZoneMinifiedResource($this->zone),
        ];
    }
}
