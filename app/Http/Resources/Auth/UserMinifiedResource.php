<?php

namespace App\Http\Resources\Auth;

use Admin\Http\Resources\Country\CountryMinifiedResource;
use Admin\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use App\Constants\FileModuleType;
use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use App\Http\Resources\SystemLookupResource;
use App\Models\File;
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
        $file = $this->file ? $this->file : File::where('type', FileModuleType::DEFAULT_USER_AVATAR['key'])->first();

        return [

            'id' => $this->id,

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'available_companies_count' => $this->api_available_companies_count,

            'available_employees_count' => $this->api_available_employees_count,

            'collected_cash' => $this->clientEmployeeCash()->sum('amount') + $this->clientCompanyCash()->sum('amount'),

            'delivered_cash' => $this->acceptedWithdrawal()->sum('amount'),

            'created_at' => $this->created_at,

            'stopped_at' => $this->stopped_at,

            'avatar' => new FileResource(MainRepo::getFile($file)),

            'account_type' => new SystemLookupResource($this->accountType),

            'country' => new CountryMinifiedResource($this->country),

            'governorate' => new GovernorateMinifiedResource($this->governorate),
        ];
    }
}
