<?php

namespace Admin\Http\Controllers\Views\Country;

use Admin\Foundations\Country\District\DistrictCreateCollection;
use Admin\Foundations\Country\District\DistrictSearchCollection;
use Admin\Http\Requests\Country\DistrictCreateRequest;
use Admin\Http\Requests\Country\DistrictUpdateRequest;
use Admin\Http\Resources\Country\District\DistrictMinifiedResource;
use Admin\Http\Resources\Country\District\DistrictResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $districts = DistrictSearchCollection::searchCountryDistricts(
            $country,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(DistrictMinifiedResource::collection($districts));
    }

    public function search(Country $country, Request $request)
    {
        $districts = DistrictSearchCollection::searchCountryDistricts(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(DistrictMinifiedResource::collection($districts));
    }

    public function searchAll(Request $request)
    {
        $districts = DistrictSearchCollection::searchAllDistricts(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(DistrictMinifiedResource::collection($districts));
    }

    public function show(District $district)
    {
        return response()->success(
            trans('district.district_retrieved_successfully'),
            new DistrictResource($district),
            StatusCode::OK
        );
    }

    public function store(DistrictCreateRequest $request)
    {
        $district =  DistrictCreateCollection::createDistrict($request->validated());

        return response()->success(
            trans('district.district_created_successfully'),
            new DistrictResource($district),
            StatusCode::OK
        );
    }

    public function update(DistrictUpdateRequest $request, District $district)
    {
        $district->update($request->validated());

        return response()->success(
            trans('district.district_updated_successfully'),
            new DistrictResource($district),
            StatusCode::OK
        );
    }

    public function destroy(District $district)
    {
        $district->delete();

        return response()->success(
            trans('district.district_deleted_successfully'),
            new DistrictResource($district),
            StatusCode::OK
        );
    }
}
