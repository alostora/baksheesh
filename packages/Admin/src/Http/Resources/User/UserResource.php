<?php

namespace Admin\Http\Resources\User;

use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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

            'email' => $this->email,

            'phone' => $this->phone,

            'user_account_type_id' => $this->user_account_type_id,

            'accountType' => new SystemLookupResource($this->accountType),

            'created_at' => $this->created_at,
        ];
    }
}
