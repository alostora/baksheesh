<?php

namespace Admin\Http\Controllers\Country;

use Admin\Foundations\Country\Zone\ZoneCreateCollection;
use Admin\Foundations\Country\Zone\ZoneSearchCollection;
use Admin\Http\Requests\Country\ZoneCreateRequest;
use Admin\Http\Requests\Country\ZoneUpdateRequest;
use Admin\Http\Resources\Country\Zone\ZoneMinifiedResource;
use Admin\Http\Resources\Country\Zone\ZoneResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $zones = ZoneSearchCollection::searchCountryZones(
            $country,
            -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ZoneMinifiedResource::collection($zones));
    }

    public function search(Country $country, Request $request)
    {
        $zones = ZoneSearchCollection::searchCountryZones(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ZoneMinifiedResource::collection($zones));
    }

    public function searchAll(Request $request)
    {
        $zones = ZoneSearchCollection::searchAllZones(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ZoneMinifiedResource::collection($zones));
    }

    public function show(Zone $zone)
    {
        return response()->success(
            trans('zone.zone_retrieved_successfully'),
            new ZoneResource($zone),
            StatusCode::OK
        );
    }

    public function store(ZoneCreateRequest $request)
    {
        $zone =  ZoneCreateCollection::createZone($request->validated());

        return response()->success(
            trans('zone.zone_created_successfully'),
            new ZoneResource($zone),
            StatusCode::OK
        );
    }

    public function update(ZoneUpdateRequest $request, Zone $zone)
    {
        $zone->update($request->validated());

        return response()->success(
            trans('zone.zone_updated_successfully'),
            new ZoneResource($zone),
            StatusCode::OK
        );
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();

        return response()->success(
            trans('zone.zone_deleted_successfully'),
            new ZoneResource($zone),
            StatusCode::OK
        );
    }
}
