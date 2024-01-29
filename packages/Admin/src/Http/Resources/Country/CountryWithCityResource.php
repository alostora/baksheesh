<?php

namespace Admin\Http\Resources\Country;

use Admin\Http\Resources\Country\City\CityMinifiedResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryWithCityResource extends JsonResource
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
            'phone_code' => $this->phone_code,
            'flag' => $this->flag,
            'prefix' => $this->prefix,
            'stopped_at' => $this->stopped_at,
'active' => $this->stopped_at ? false: true,

            'cities' => CityMinifiedResource::collection($this->cities),
        ];
    }
}
