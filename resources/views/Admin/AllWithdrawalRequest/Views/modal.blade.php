<div class="modal fade" id="modal-default" style="display: none;">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Change Withdrawal Request Status</h4>
               </div>
               <div class="modal-body">
                    <form role="form" id="modal-from" action="" method="POST">
                         @csrf
                         @method('patch')
                         <div class="row">
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label>@lang('withdrawal_request.status')</label>
                                        <select class="form-control select2" name="status" style="width: 100%;" onchange="checkStatusValue(this.value)">
                                             <option value="">@lang('withdrawal_request.select')</option>
                                             @foreach($withdrawal_request_status as $withdrawal_status)
                                             <?php $selected = Request('status') == $withdrawal_status->id ? "selected" : ""; ?>
                                             <option value="{{$withdrawal_status->id}}" {{$selected}}>{{$withdrawal_status->name}}</option>
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                              <div class="col-md-12" id="refuse_reasone" style="display: none;">
                                   <div class="form-group">
                                        <label>@lang('withdrawal_request.refuse_reasone')</label>
                                        <textarea name="refuse_reasone" placeholder="{{Lang::get('withdrawal_request.refuse_reasone')}}" class="form-control"></textarea>
                                   </div>
                              </div>

                              <div class="col-md-12" id="bank_transfer_number" style="display: none;">
                                   <div class="form-group">
                                        <label>@lang('withdrawal_request.bank_transfer_number')</label>
                                        <input type="text" name="bank_transfer_number" placeholder="{{Lang::get('withdrawal_request.bank_transfer_number')}}" class="form-control">
                                   </div>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label>@lang('withdrawal_request.admin_notes')</label>
                                        <textarea name="admin_notes" placeholder="{{Lang::get('withdrawal_request.admin_notes')}}" class="form-control"></textarea>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<script>
     function checkStatusValue(statusValue) {

          $("#refuse_reasone").hide();
          $("#bank_transfer_number").hide();

          $.ajax({

               url: '{{url("api/system-lookups/4")}}',
               type: 'GET',
               data: {},
               dataType: 'json',
               success: function(response) {
                    let result = response.data;

                    for (let i = 0; i < result.length; i++) {
                         if (result[i].id == statusValue) {
                              if (result[i].prefix == "REFUSED") {

                                   $("#refuse_reasone").show();

                              } else if (result[i].prefix == "ACCEPTED") {
                                   $("#bank_transfer_number").show();

                              }
                         }
                    }
               },
               error: function(request, error) {
                    console.log("Request: " + JSON.stringify(request));
               }
          });
     }
</script>