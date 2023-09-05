<?php

namespace Client\Http\Controllers\Views;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\ClientWithdrawalRequest;
use Client\Foundations\ClientWithdrawalRequest\ClientWithdrawalRequestCreateCollection;
use Client\Foundations\ClientWithdrawalRequest\ClientWithdrawalRequestSearchCollection;
use Client\Foundations\ClientWithdrawalRequest\ClientWithdrawalRequestUpdateCollection;
use Client\Http\Requests\ClientWithdrawalRequest\ClientWithdrawalRequestCreateRequest;
use Client\Http\Resources\ClientWithdrawalRequest\ClientWithdrawalRequestResource;
use Illuminate\Http\Request;

class ClientWithdrawalRequestController extends Controller
{

    public function index(Request $request)
    {
        $data['withdrawal_requests'] = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            -1,
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/ClientWithdrawalRequest/index', $data);
    }

    public function search(Request $request)
    {
        $data['withdrawal_requests'] = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/ClientWithdrawalRequest/index', $data);
    }

    public function show(ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        return response()->success(
            trans('client.client_withdrawal_retrieved_successfully'),
            new ClientWithdrawalRequestResource($clientWithdrawalRequest),
            StatusCode::OK
        );
    }

    public function create()
    {
        return view('Client/ClientWithdrawalRequest/create');
    }

    public function store(ClientWithdrawalRequestCreateRequest $request)
    {
        ClientWithdrawalRequestCreateCollection::createClientWithdrawalRequest($request);

        return redirect(url('client/client-withdrawal-requests'));
    }

    public function edit(ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        return view('Client/ClientWithdrawalRequest/edit', compact('clientWithdrawalRequest'));
    }

    public function update(ClientWithdrawalRequestCreateRequest $request, ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        $clientWithdrawalRequest = ClientWithdrawalRequestUpdateCollection::updateClientWithdrawalRequest($request, $clientWithdrawalRequest);

        return redirect(url('client/client-withdrawal-requests'));
    }

    public function destroy(ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        $clientWithdrawalRequest->delete();

        return back();
    }
}
