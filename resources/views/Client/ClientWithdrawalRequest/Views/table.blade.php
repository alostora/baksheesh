<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('withdrawal_request.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('client/client-withdrawal-request/create')}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('company.create')</span>
                        </a>
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
                                    <label class="label bg-{{$color}}">
                                        {{$withdrawal_request->withdrawalRequestStatus->name}}
                                    </label>
                                </td>
                                <td>
                                    {{--
                                        <a href="{{url('client/client-withdrawal-request/edit/'.$withdrawal_request->id)}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-trash"></i>
                                    </a>

                                    --}}
                                    @if($withdrawal_request->withdrawalRequestStatus->code === \App\Constants\HasLookupType\WithdrawalRequestStatus::PENDING['code'])
                                    <a href="{{url('client/client-withdrawal-request/delete/'.$withdrawal_request->id)}}" class="btn btn-danger btn-sm">
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
                            {{ $withdrawal_requests->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
