<?php

namespace Admin\Http\Controllers\Views\Wallet;

use Admin\Foundations\Report\Withdrawal\WithdrawalReportSearchCollection;
use Admin\Foundations\Wallet\ClientWithdrawalRequest\ClientWithdrawalRequestSearchCollection;
use Admin\Http\Requests\ClientWithdrawalRequest\ClientWithdrawalRequestChangeStatusRequest;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\ClientWithdrawalRequest;
use App\Models\User;
use Carbon\Carbon;
use Client\Http\Resources\ClientWithdrawalRequest\ClientWithdrawalRequestResource;
use Illuminate\Http\Request;

class WithdrawalRequestController extends Controller
{

    public function index(Request $request, User $user)
    {

        $data = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            $user,
            -1,
            -1,
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/ClientWithdrawalRequest/index', $data);
    }

    public function search(Request $request, User $user)
    {
        $data = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            $user,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/ClientWithdrawalRequest/index', $data);
    }

    public function searchAllWithdrawalRequests(Request $request)
    {
        $data = WithdrawalReportSearchCollection::searcAllhWithdrawalRequests(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/AllWithdrawalRequest/index', $data);
    }

    public function show(ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        return response()->success(
            trans('client.client_withdrawal_retrieved_successfully'),
            new ClientWithdrawalRequestResource($clientWithdrawalRequest),
            StatusCode::OK
        );
    }

    public function destroy(ClientWithdrawalRequest $clientWithdrawalRequest)
    {
        $clientWithdrawalRequest->delete();

        return back();
    }

    public function changeStatus(
        ClientWithdrawalRequestChangeStatusRequest $request,
        ClientWithdrawalRequest $clientWithdrawalRequest
    ) {

        $validated = $request->validated();

        $validated['discount_percentage'] = SystemDefault::DEFAUL_DISCOUNT_PERCENTAGE;

        $validated['action_by_id'] = auth()->id();

        $data['action_at'] = Carbon::now();

        $clientWithdrawalRequest->update($validated);

        return back();
    }
}
