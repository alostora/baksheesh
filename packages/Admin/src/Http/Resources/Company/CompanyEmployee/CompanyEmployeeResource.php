<?php

namespace Admin\Http\Resources\Company\CompanyEmployee;

use Admin\Http\Resources\Company\CompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingMinifiedResource;
use Admin\Http\Resources\Company\CompanyMinifiedResource;
use Admin\Http\Resources\Country\CountryMinifiedResource;
use Admin\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use App\Constants\FileModuleType;
use App\Foundations\File\MainRepo;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\SystemLookupResource;
use App\Models\File;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $file = $this->file ? $this->file : File::where('type', FileModuleType::DEFAULT_USER_AVATAR['key'])->first();

        return [
            'id' => $this->id,

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'employee_job_name' => $this->employee_job_name,

            'token' => $this->api_token,

            'created_at' => $this->created_at,

            'stopped_at' => $this->stopped_at,

            'active' => $this->stopped_at ? false: true,

            'employee_job_name' => $this->employee_job_name,

            'company' => new CompanyMinifiedResource($this->company),

            'avatar' => new FileResource(MainRepo::getFile($file)),

            'account_type' => new SystemLookupResource($this->accountType),

            'client' => new UserMinifiedResource($this->client),

            'country' => new CountryMinifiedResource($this->country),

            'governorate' => new GovernorateMinifiedResource($this->governorate),

            'employee_available_ratings' => EmployeeAvailableRatingMinifiedResource::collection($this->employeeAvailableRatings),

        ];
    }
}
