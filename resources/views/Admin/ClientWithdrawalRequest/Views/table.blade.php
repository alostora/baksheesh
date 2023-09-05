<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('withdrawal_request.page_title_withdrawal_request')</h3>
                    <div class="col-md-4">

                    </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>@lang('withdrawal_request.client')</th>
                                <th>@lang('withdrawal_request.amount')</th>
                                <th>@lang('general.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($withdrawal_requests))
                            @foreach ($withdrawal_requests as $key=>$withdrawal_request)
                            <tr>
                                <td> {{$withdrawal_request->client->name}} </td>
                                <td> {{$withdrawal_request->amount}} </td>
                                <td>

                                    <a href="{{url('admin/client-withdrawal-request/delete/'.$withdrawal_request->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    
                                    <a href="{{url('admin/accept-client-withdrawal-request/'.$withdrawal_request->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    
                                    <a href="{{url('admin/refuse-client-withdrawal-request/'.$withdrawal_request->id)}}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-close"></i>
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