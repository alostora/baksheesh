<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('company.create')</h3>
        </div>
        <form role="form" action="{{url('admin/company')}}" method="POST">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="client_id">@lang('company.client')</label>
                  <select class="form-control select2" name="client_id" id="client_id">
                    @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="name">@lang('company.name')</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="@lang('company.name')">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="available_rating_ids">@lang('company.available_rating')</label>
                  <select class="form-control select2" multiple="multiple" name="available_rating_ids[]" id="available_rating_ids">
                    @foreach ($available_rating as $available_rating)
                    <option value="{{$available_rating->id}}">{{$available_rating->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('company.submit')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>