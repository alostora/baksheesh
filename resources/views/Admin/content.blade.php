<section class="content-header">
  <h1>
    @lang('general.app_name')
    <small>@lang('general.dashboard')</small>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-6 col-xs-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$count_active_clients}}</h3>
          <p>@lang('general.active_clients')</p>
        </div>
        <div class="icon">
          <i class="fa fa-car" aria-hidden="true"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xs-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$count_active_companies}}</h3>
          <p>@lang('general.active_companies')</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-primary">
        <div class="inner">

          <h3>{{$count_active_employees}}</h3>
          <p>@lang('general.active_employees')</p>

        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3><span style="margin-left: 5%;">{{$current_amount}}</span> </h3>
          <p>@lang('general.current_amount')</p>
        </div>
        <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-default">
        <div class="inner">
          <h3>
            <span style="margin-left: 5%;">{{isset($totalYearIncom)?$totalYearIncom:0}}</span>
          </h3>
          <p>@lang('general.totalYearIncom')</p>
        </div>
        <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
      </div>
    </div>
  </div>
</section>