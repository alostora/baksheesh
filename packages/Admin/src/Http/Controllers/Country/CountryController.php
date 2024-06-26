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
use Carbon\Carbon;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = CountrySearchCollection::searchCountries(
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? 1000
        );

        return response()->success(
            trans('country.country_retrived_successfully'),
            CountryMinifiedResource::collection($countries),
            StatusCode::OK
        );

        // return response()->paginated(CountryMinifiedResource::collection($countries));
    }

    public function search(Request $request)
    {
        $countries = CountrySearchCollection::searchCountries(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? 1000
        );

        return response()->success(
            trans('country.country_retrived_successfully'),
            CountryMinifiedResource::collection($countries),
            StatusCode::OK
        );

        // return response()->paginated(CountryMinifiedResource::collection($countries));
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
        $country->governorates()->delete();
        $country->delete();

        return response()->success(
            trans('country.country_deleted_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }

    public function active(Country $country)
    {
        $country->update(['stopped_at' => null]);

        return response()->success(
            trans('country.country_actived_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }

    public function inactive(Country $country)
    {
        $country->update(['stopped_at' => Carbon::now()]);

        return response()->success(
            trans('country.country_inactived_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }
}
