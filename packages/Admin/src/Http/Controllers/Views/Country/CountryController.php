<?php

namespace Admin\Http\Controllers\Views\Country;

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
        $data = CountrySearchCollection::searchCountries(
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Country/index', $data);
    }

    public function search(Request $request)
    {
        $data = CountrySearchCollection::searchCountries(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Country/index', $data);
    }

    public function show(Country $country)
    {
        return response()->success(
            trans('country.country_retrieved_successfully'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }

    public function create()
    {
        return view('Admin/Country/create');
    }

    public function store(CountryCreateRequest $request)
    {
        CountryCreateCollection::createCountry($request->validated());

        return redirect(url('admin/countries'));
    }


    public function edit(Country $country)
    {
        return view('Admin/Country/edit', compact('country'));
    }

    public function update(CountryUpdateRequest $request, Country $country)
    {
        $country->update($request->validated());

        return redirect(url('admin/countries'));
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return back();
    }

    public function active(Country $country)
    {
        $country->update(['stopped_at'=> null]);

        return back();
    }

    public function inactive(Country $country)
    {
        $country->update(['stopped_at' => Carbon::now()]);

        return back();
    }
}
