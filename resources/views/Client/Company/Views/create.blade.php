<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('company.create')</h3>
                </div>
                <form role="form" action="{{url('client/client-company')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="file">@lang('company.file')</label>
                                <input required type="file" class="form-control" name="file" id="file" placeholder="@lang('company.file')">
                            </div>

                            <div class="col-md-6">
                                <label for="company_field">@lang('company.company_field')</label>
                                <input required type="text" class="form-control" name="company_field" id="company_field" placeholder="@lang('company.company_field')">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">@lang('company.name')</label>
                                    <input required type="text" class="form-control" name="name" id="name" placeholder="@lang('company.name')">
                                </div>

                                <div class="col-md-6">
                                    <label for="available_rating_ids">@lang('company.available_rating')</label>
                                    <select required class="form-control select2" multiple="multiple" name="available_rating_ids[]" id="available_rating_ids">
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
