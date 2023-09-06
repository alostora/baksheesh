<?php

namespace App\Http\Resources\Auth;

use App\Constants\FileModuleType;
use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
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
            'avatar' => new FileResource(MainRepo::getFile($file)),
            'created_at' => $this->created_at,
            'stopped_at' => $this->stopped_at,
        ];
    }
}
