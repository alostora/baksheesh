<?php

namespace App\Http\Resources\Auth;

use Admin\Http\Resources\Country\CountryMinifiedResource;
use App\Constants\FileModuleType;
use App\Constants\GeneralBooleanStatus;
use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use App\Http\Resources\SystemLookupResource;
use App\Models\Country;
use App\Models\File;
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
        $file = $this->file ? $this->file : File::where('type', FileModuleType::DEFAULT_USER_AVATAR['key'])->first();
        return [
            'id' => $this->id,

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'token' => $this->api_token,

            'avatar' => new FileResource(MainRepo::getFile($file)),

            'country' => new CountryMinifiedResource(Country::first()),

            'member_control' => GeneralBooleanStatus::STATUS_LIST[$this->member_control ?? 0],

            'account_type' => new SystemLookupResource($this->accountType),

            'client' => new UserMinifiedResource($this->client),

            'created_at' => $this->created_at,
        ];
    }
}
