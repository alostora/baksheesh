<?php

namespace App\Http\Resources;

use App\Http\Resources\Auth\UserMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $resource =  [
            'id' => $this->id,
            'name' => $this->event_name,
            'name_ar' => $this->event_name_ar,
            'content' => $this->event_content,
            'content_ar' => $this->event_content_ar,
            'reference_code' => $this->event_reference_code,
            'actor' => new UserMinifiedResource($this->actor),
            'data' => json_decode($this->data),
            'occurred_at' => $this->occurred_at,
            'watched' => $this->recipient->watched
        ];

        return $resource;
    }
}
