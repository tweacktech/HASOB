<!-- <div class="modal fade" id="check-list-creator-modal" tabindex="-1" role="dialog" aria-labelledby="check-list-creator-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="check-list-creator-modal-label">Create New Check List</h4>
            </div>
            <div class="modal-body">

              <div id="error_checklist_creator" class="alert alert-danger" role="alert">
                <span id="error_msg_checklist_creator"></span>
              </div>

                <form id="frm_checklist_creator" name="frm_checklist_creator" class="form-horizontal" novalidate="">
                  {{ csrf_field() }}

                    <div class="form-group error">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="new_checklist_name" name="new_checklist_name" required></textarea>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-checklist-creator-save" value="add">Save Checklist</button>
            </div>
        </div>
    </div>
</div> -->


<!-- Modal -->
<div class="modal fade" id="check-list-creator-modal" tabindex="-1" aria-labelledby="check-list-creator-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="check-list-creator-modal-label">Create New Checklist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="error_checklist_creator" class="alert alert-danger" role="alert">
          <span id="error_msg_checklist_editor"></span>
        </div>

    

        <form id="frm_checklist_creator" name="frm_checklist_creator" novalidate="" >
                  {{ csrf_field() }}

                  <input type="hidden" id="workflow_id" value="-1" />


                    <div class=" error">
                        <div class="mb-3 {{ $errors->has('wf_name') ? ' has-error' : '' }}" >
                        <label for="name" class="form-label">Name</label>
                        <input 
                            type="text" 
                            class="form-control " 
                            value="{{ old('wf_name') }}" 
                            required 
                            id="new_checklist_name"
                            name="new_checklist_name"
                            placeholder="enter new checklist">
                        </div>
                    </div>
                    
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-checklist-creator-save" value="add">
         
        <span class="spinner">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          <span class="visually-hidden">Loading...</span>
        </span>
        
        Save Checklist




        </button>
      </div>
    </div>
  </div>
</div>