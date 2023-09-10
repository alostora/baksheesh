<section class="content-header">
  <h1>
    @lang('dashboard.app_name')
    <small>@lang('dashboard.dashboard')</small>
  </h1>
</section>
<section class="content">
  <div class="row">

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$count_active_clients}}</h3>
          <p>@lang('dashboard.active_clients')</p>
        </div>
        <div class="icon">
          <i class="fa fa-users" aria-hidden="true"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$count_active_companies}}</h3>
          <p>@lang('dashboard.active_companies')</p>
        </div>
        <div class="icon">
          <i class="fa fa-building"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-primary">
        <div class="inner">

          <h3>{{$count_active_employees}}</h3>
          <p>@lang('dashboard.active_employees')</p>

        </div>
        <div class="icon">
          <i class="fa fa-wrench"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3><span style="margin-left: 5%;">{{$month_income}}</span> </h3>
          <p>@lang('dashboard.month_income')</p>
        </div>
        <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><span style="margin-left: 5%;">{{$year_income}}</span> </h3>
          <p>@lang('dashboard.year_income')</p>
        </div>
        <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><span style="margin-left: 5%;">{{$current_amount}}</span> </h3>
          <p>@lang('dashboard.current_amount')</p>
        </div>
        <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
      </div>
    </div>
  </div>
</section>