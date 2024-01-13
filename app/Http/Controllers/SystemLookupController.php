<?php

namespace App\Http\Controllers;

use App\Constants\HasLookupType\LookupType;
use App\Constants\StatusCode;
use App\Http\Resources\SystemLookupResource;
use App\Models\SystemLookup;

class SystemLookupController extends Controller
{
    public function index($type)
    {
        $system_lookups = SystemLookup::findByType($type);

        return response()->paginated(SystemLookupResource::collection($system_lookups));
    }

    public function lookupTypes()
    {
        return response()->success(
            trans('api.system_lookup_types_retrieved_successfully'),
            LookupType::LOOKUP_TYPES,
            StatusCode::OK
        );
    }
}
