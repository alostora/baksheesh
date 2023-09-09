<?php

namespace Admin\Http\Controllers\Views\Wallet;

use Admin\Foundations\Report\Withdrawal\WithdrawalReportSearchCollection;
use Admin\Foundations\Wallet\ClientWithdrawalRequest\ClientWithdrawalRequestSearchCollection;
use Admin\Http\Requests\ClientWithdrawalRequest\ClientWithdrawalRequestChangeStatusRequest;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\HasLookupType\WithdrawalRequestStatus;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\ClientWithdrawalRequest;
use App\Models\SystemLookup;
use App\Models\User;
use Carbon\Carbon;
use Client\Http\Resources\ClientWithdrawalRequest\ClientWithdrawalRequestResource;
use Illuminate\Http\Request;

class WithdrawalRequestController extends Controller
{

    public function index(Request $request, User $user)
    {

        $withdrawal_requests = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            $user,
            -1,
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/ClientWithdrawalRequest/index', compact('withdrawal_requests'));
    }

    public function search(Request $request, User $user)
    {
        $withdrawalRequests = ClientWithdrawalRequestSearchCollection::searchWithdrawalRequests(
            $user,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/ClientWithdrawalRequest/index', compact('withdrawalRequests'));
    }

    public function searchAllWithdrawalRequests(Request $request)
    {
        $data['withdrawal_requests'] = WithdrawalReportSearchCollection::searcAllhWithdrawalRequests(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['withdrawal_request_status'] = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)->get();


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

    public function accept(ClientWithdrawalRequest $clientWithdrawalRequest)
    {

        $data = [];

        $withdrawalStatus =  SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::ACCEPTED['code'])
            ->first();

        $data['status'] = $withdrawalStatus->id;

        $data['discount_percentage'] = SystemDefault::DEFAUL_DISCOUNT_PERCENTAGE;

        $data['action_by_id'] = auth()->id();

        $data['action_at'] = Carbon::now();

        $clientWithdrawalRequest->update($data);

        return back();
    }

    public function refuse(ClientWithdrawalRequest $clientWithdrawalRequest)
    {

        $data = [];

        $withdrawalStatus =  SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::REFUSED['code'])
            ->first();

        $data['status'] = $withdrawalStatus->id;

        $data['discount_percentage'] = SystemDefault::DEFAUL_DISCOUNT_PERCENTAGE;

        $data['action_by_id'] = auth()->id();

        $data['action_at'] = Carbon::now();

        $clientWithdrawalRequest->update($data);

        return back();
    }
}
