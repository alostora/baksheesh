<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{url('admin/all-client-withdrawal-requests/search')}}" method="GET">
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="status" style="width: 100%;">
                                        <option value="">@lang('filter.status')</option>
                                        @foreach($withdrawal_request_status as $withdrawal_status)
                                        <?php $selected = Request('status') == $withdrawal_status->id ? "selected" : ""; ?>
                                        <option value="{{$withdrawal_status->id}}" {{$selected}}>{{app()->getLocale() == 'ar' ? $withdrawal_status->name_ar : $withdrawal_status->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="client_id">
                                        <option value="">@lang('filter.clients')</option>
                                        @foreach($clients as $client)
                                        <?php $selected = Request('client_id') == $client->id ? "selected" : ""; ?>
                                        <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('withdrawal_request.page_title')</h3>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-info disabled color-palette">
                                    <span>
                                        @lang('withdrawal_request.total') : {{$count_all}}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-blue disabled color-palette">
                                    <span>
                                        @lang('withdrawal_request.pending') : {{$count_pending}}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-green disabled color-palette">
                                    <span>
                                        @lang('withdrawal_request.accepted') : {{$count_accepted}}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-yellow disabled color-palette">
                                    <span>
                                        @lang('withdrawal_request.refused') : {{$count_refused}}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-default disabled color-palette">
                                    <span>
                                        @lang('withdrawal_request.unexecutable') : {{$count_unexecutable}}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('withdrawal_request.client')</th>
                                <th>@lang('withdrawal_request.amount')</th>
                                <th>@lang('withdrawal_request.status')</th>
                                <th>@lang('withdrawal_request.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $color = '' ?>
                            @if(!empty($withdrawalRequests))
                            @foreach ($withdrawalRequests as $key=>$withdrawalRequest)

                            @if($withdrawalRequest->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::PENDING['code'])
                            <?php $color = 'blue' ?>
                            @elseif($withdrawalRequest->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::ACCEPTED['code'])
                            <?php $color = 'green' ?>
                            @elseif($withdrawalRequest->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::REFUSED['code'])
                            <?php $color = 'orange' ?>
                            @endif
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$withdrawalRequest->client->name}} </td>
                                <td> {{$withdrawalRequest->amount}} </td>
                                <td>
                                    <label class="label label-default text-{{$color}}"></label>
                                    <div class="btn-group">
                                        <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-sm bg-{{$color}}" onclick="changeWithdrawalRequest('{{$withdrawalRequest->id}}')">
                                            {{app()->getLocale() == 'ar' ? $withdrawalRequest->withdrawalRequestStatus->name_ar : $withdrawalRequest->withdrawalRequestStatus->name}}
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @if($withdrawalRequest->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::PENDING['code'])
                                    <a href="{{url('admin/client-withdrawal-request/delete/'.$withdrawalRequest->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $withdrawalRequests->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function changeWithdrawalRequest(withdrawalRequestId) {
        let url = "{{url('admin/client-withdrawal-request-change-status')}}" + "/" + withdrawalRequestId
        $("#modal-from").attr('action', url)
    }
</script>
