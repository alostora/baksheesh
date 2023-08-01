<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string uuid
 * @property string type
 * @property string code
 * @property string prefix
 * @property string name
 */
class ClientSystemModeMinifiedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'key' => $this->key,
            'prefix' => $this->prefix,
            'name' => $this->name,
        ];
    }
}
