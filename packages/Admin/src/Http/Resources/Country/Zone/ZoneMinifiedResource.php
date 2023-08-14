<?php

namespace Admin\Http\Resources\Country\Zone;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneMinifiedResource extends JsonResource
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
            'city_id' => $this->city_id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'prefix' => $this->prefix,
        ];
    }
}
