<?php

namespace Admin\Http\Resources\User;

use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMinifiedResource extends JsonResource
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

            'user_account_typ' => new SystemLookupResource($this->userAccountType),

            'created_at' => $this->created_at,
        ];
    }
}
