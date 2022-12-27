@php
$logged_in_user = Auth::guard('web')->user();
@endphp
<div class="modal fade" id="availability-modal" role="dialog" aria-labelledby="availability-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="availability-modal-label">Your Availability Status</h4>
            </div>
            <div class="modal-body">

              <div id="error_div_availability" class="alert alert-danger" role="alert">
                <span id="error_msg_availability"></span>
              </div>

                <form id="frm_availability" name="frm_availability" class="form-horizontal" novalidate="">
                  {{ csrf_field() }}

                    @if ($logged_in_user != null)
                    <div class="form-group error">
                        <label class="col-sm-3 control-label">Current Status</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <select id="availability_status" name="availability_status" class="form-control">
                              <option value="available" {{ $logged_in_user->presence_status=='available' ? 'selected' : '' }}>Available</option>
                              <option value="on leave" {{ $logged_in_user->presence_status=='on leave' ? 'selected' : '' }}>On Leave</option>
                              <option value="do not disturb" {{ $logged_in_user->presence_status=='do not disturb' ? 'selected' : '' }} >Do Not Disturb</option>
                            </select>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                          </div>
                        </div>
                    </div>
                    @endif

                    @if ($logged_in_user != null)
                    <div class="form-group error">
                        <label for="presence_comments" class="col-sm-3 control-label">Comments</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id="presence_comments" name="presence_comments" rows="5" required>{!! $logged_in_user->leave_delegation_notes !!}</textarea>
                        </div>
                    </div>
                    @endif

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save-availability" value="add">Save</button>
            </div>
        </div>
    </div>
</div>