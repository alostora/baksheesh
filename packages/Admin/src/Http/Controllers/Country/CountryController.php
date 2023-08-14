<?php

namespace Admin\Http\Controllers\Country;

use Admin\Foundations\Country\CountryCreateCollection;
use Admin\Foundations\Country\CountrySearchCollection;
use Admin\Http\Requests\Country\CountryCreateRequest;
use Admin\Http\Requests\Country\CountryUpdateRequest;
use Admin\Http\Resources\Country\CountryMinifiedResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = CountrySearchCollection::searchCountries(
            -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CountryMinifiedResource::collection($countries));
    }

    public function search(Request $request)
    {
        $countries = CountrySearchCollection::searchCountries(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CountryMinifiedResource::collection($countries));
    }

    public function show(Country $country)
    {
        return response()->success(
            trans('country.country_retrieved_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }

    public function store(CountryCreateRequest $request)
    {
        $country =  CountryCreateCollection::createCountry($request->validated());

        return response()->success(
            trans('country.country_created_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }

    public function update(CountryUpdateRequest $request, Country $country)
    {
        $country->update($request->validated());

        return response()->success(
            trans('country.country_updated_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->success(
            trans('country.country_deleted_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }
}
