<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('filter.filter')</h3> <i class="fa fa-filter"></i>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="{{url('admin/all-client-withdrawal-requests/search')}}" method="GET">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.clients')</label>
                                    <select class="form-control select2" name="client_id" style="width: 100%;">
                                        <option value="">@lang('filter.select')</option>
                                        @foreach($clients as $client)
                                        <?php $selected = Request('client_id') == $client->id ? "selected" : ""; ?>
                                        <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.status')</label>
                                    <select class="form-control select2" name="status" style="width: 100%;">
                                        <option value="">@lang('filter.select')</option>
                                        @foreach($withdrawal_request_status as $withdrawal_status)
                                        <?php $selected = Request('status') == $withdrawal_status->id ? "selected" : ""; ?>
                                        <option value="{{$withdrawal_status->id}}" {{$selected}}>{{app()->getLocale() == 'ar' ? $withdrawal_status->name_ar : $withdrawal_status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('withdrawal_request.query_string')}}" class="form-control" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">@lang('filter.search')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('withdrawal_request.page_title')</h3>
                    <div class="col-md-4">

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
                            @if(!empty($withdrawal_requests))
                            @foreach ($withdrawal_requests as $key=>$withdrawal_request)

                            @if($withdrawal_request->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::PENDING['code'])
                            <?php $color = 'blue' ?>
                            @elseif($withdrawal_request->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::ACCEPTED['code'])
                            <?php $color = 'green' ?>
                            @elseif($withdrawal_request->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::REFUSED['code'])
                            <?php $color = 'orange' ?>
                            @endif
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$withdrawal_request->client->name}} </td>
                                <td> {{$withdrawal_request->amount}} </td>
                                <td>
                                    <label class="label label-default text-{{$color}}"></label>
                                    <div class="btn-group">
                                        <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-sm bg-{{$color}}" onclick="changeWithdrawalRequest('{{$withdrawal_request->id}}')">
                                            {{app()->getLocale() == 'ar' ? $withdrawal_request->withdrawalRequestStatus->name_ar : $withdrawal_request->withdrawalRequestStatus->name}}
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{url('admin/client-withdrawal-request/delete/'.$withdrawal_request->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $withdrawal_requests->render( "pagination::bootstrap-4") }}
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
