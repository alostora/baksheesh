<?php

namespace Admin\Http\Resources\Company;

use App\Foundations\File\MainRepo;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyMinifiedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,

            'name' => $this->name,

            'stopped_at' => $this->stopped_at,

            'client' => new UserMinifiedResource($this->client),

            'file' => new FileResource(MainRepo::getFile($this->file)),
        ];
    }
}
