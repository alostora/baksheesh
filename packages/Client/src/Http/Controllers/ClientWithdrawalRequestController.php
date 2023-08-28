<?php

namespace Client\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\ClientWithdrawalRequest;
use Client\Foundations\ClientWithdrawalRequest\ClientWithdrawalRequestCreateCollection;
use Client\Foundations\ClientWithdrawalRequest\ClientWithdrawalRequestSearchCollection;
use Client\Foundations\ClientWithdrawalRequest\ClientWithdrawalRequestUpdateCollection;
use Client\Http\Requests\ClientWithdrawalRequest\ClientWithdrawalRequestCreateRequest;
use Client\Http\Resources\ClientWithdrawalRequest\ClientWithdrawalRequestMinifiedResource;
use Client\Http\Resources\ClientWithdrawalRequest\ClientWithdrawalRequestResource;
use Illuminate\Http\Request;

class ClientWithdrawalRequestController extends Controller
{

    public function index(Request $request)
    {
        $withdrawalRequests = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            -1,
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ClientWithdrawalRequestMinifiedResource::collection($withdrawalRequests));
    }

    public function search(Request $request)
    {
        $withdrawalRequests = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ClientWithdrawalRequestMinifiedResource::collection($withdrawalRequests));
    }

    public function show(ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        return response()->success(
            trans('client.client_withdrawal_retrieved_successfully'),
            new ClientWithdrawalRequestResource($clientWithdrawalRequest),
            StatusCode::OK
        );
    }

    public function store(ClientWithdrawalRequestCreateRequest $request)
    {
        $clientWithdrawalRequest = ClientWithdrawalRequestCreateCollection::createClientWithdrawalRequest($request);

        return response()->success(
            trans('client.client_withdrawal_created_successfully'),
            new ClientWithdrawalRequestResource($clientWithdrawalRequest),
            StatusCode::OK
        );
    }

    public function update(ClientWithdrawalRequestCreateRequest $request, ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        $clientWithdrawalRequest = ClientWithdrawalRequestUpdateCollection::updateClientWithdrawalRequest($request, $clientWithdrawalRequest);

        return response()->success(
            trans('client.client_withdrawal_updated_successfully'),
            new ClientWithdrawalRequestResource($clientWithdrawalRequest),
            StatusCode::OK
        );
    }

    public function destroy(ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        $clientWithdrawalRequest->delete();

        return response()->success(
            trans('client.client_withdrawal_deleted_successfully'),
            new ClientWithdrawalRequestResource($clientWithdrawalRequest),
            StatusCode::OK
        );
    }
}
