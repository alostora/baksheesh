<?php

namespace App\Http\Resources;

use App\Constants\HasLookupType\ClientSystemMode;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string uuid
 * @property string type
 * @property string code
 * @property string prefix
 * @property string name
 */
class ClientSystemModeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $durations = $this->code == ClientSystemMode::LIVE['code'] ? [] : $this->clientSystemModeDurations;
        return [
            'id' => $this->id,
            'code' => $this->code,
            'key' => $this->key,
            'prefix' => $this->prefix,
            'name' => $this->name,
            'durations' => ClientSystemModeDurationMinifiedResource::collection($durations)
        ];
    }
}
