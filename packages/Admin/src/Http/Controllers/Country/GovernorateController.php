<?php

namespace Admin\Http\Controllers\Country;

use Admin\Foundations\Country\Governorate\GovernorateCreateCollection;
use Admin\Foundations\Country\Governorate\GovernorateSearchCollection;
use Admin\Http\Requests\Country\GovernorateCreateRequest;
use Admin\Http\Requests\Country\GovernorateUpdateRequest;
use Admin\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as Governorate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $governorates = GovernorateSearchCollection::searchCountryGovernorates(
            $country,
            -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(GovernorateMinifiedResource::collection($governorates));
    }

    public function search(Country $country, Request $request)
    {
        $governorates = GovernorateSearchCollection::searchCountryGovernorates(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(GovernorateMinifiedResource::collection($governorates));
    }

    public function searchAll(Request $request)
    {
        $governorates = GovernorateSearchCollection::searchAllGovernorates(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(GovernorateMinifiedResource::collection($governorates));
    }

    public function show(Governorate $governorate)
    {
        return response()->success(
            trans('governorate.governorate_retrieved_successfully'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }

    public function store(GovernorateCreateRequest $request)
    {
        $governorate =  GovernorateCreateCollection::createGovernorate($request->validated());

        return response()->success(
            trans('governorate.governorate_created_successfully'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }

    public function update(GovernorateUpdateRequest $request, Governorate $governorate)
    {
        $governorate->update($request->validated());

        return response()->success(
            trans('governorate.governorate_updated_successfully'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();

        return response()->success(
            trans('governorate.governorate_deleted_successfully'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }

    public function active(Governorate $governorate)
    {
        $governorate->update(['stopped_at' => null]);

        return response()->success(
            trans('governorate.governorate_actived_successfully'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }

    public function inactive(Governorate $governorate)
    {
        $governorate->update(['stopped_at' => Carbon::now()]);

        return response()->success(
            trans('governorate.governorate_inactived_successfully'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }
}
