<!-- <div class="modal fade" id="check-list-item-editor-modal" tabindex="-1" role="dialog" aria-labelledby="check-list-item-editor-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="check-list-item-editor-modal-label">Check List Item Editor</h4>
            </div>
            <div class="modal-body">

              <div id="error_checklist_editor" class="alert alert-danger" role="alert">
                <span id="error_msg_checklist_editor"></span>
              </div>

                <form id="frm_checklist_editor" name="frm_checklist_editor" class="form-horizontal" novalidate="">
                  {{ csrf_field() }}

                    <input type="hidden" id="checklist_id" value="-1" />

                    
                    Item Label Field comment out
                    {{-- <div id="div-item_label" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="item_label">Label</label>
                      <div class="col-sm-8">
                          {!! Form::text('item_label', null, ['class' => 'form-control']) !!}
                      </div>
                    </div> --}}

                     Item Description Field for comment
                    <div id="div-item_description" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="item_description">Description</label>
                      <div class="col-sm-8">
                          {!! Form::textarea('item_description', null, ['id'=>'item_description','rows'=>'2','class' => 'form-control']) !!}
                      </div>
                    </div>

                     Ordinal Field for comment
                    <div id="div-ordinal" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="ordinal">Position</label>
                      <div class="col-sm-2">
                          {!! Form::number('ordinal', null, ['id'=>'ordinal','class' => 'form-control']) !!}
                      </div>
                    </div>

                    {{-- <hr/> --}}

                     Requires Attachment Field for comment
                    <div id="div-requires_attachment" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="requires_attachment"></label>
                      <div class="col-sm-1">
                          <div class="form-check">
                              {{-- {!! Form::hidden('requires_attachment', 0, ['id'=>'requires_attachment','class' => 'form-check-input']) !!} --}}
                              {!! Form::checkbox('requires_attachment', '1', null, ['id'=>'requires_attachment','class' => 'form-check-input']) !!}
                          </div>
                      </div>
                      <div class="col-sm-8">
                        Attachment Required
                      </div>
                    </div>

                     Required Attachment Mime Type Field for comment
                    <div id="div-required_attachment_mime_type" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="required_attachment_mime_type">Mime Type</label>
                      <div class="col-sm-8">
                          {!! Form::text('required_attachment_mime_type', null, ['id'=>'required_attachment_mime_type','class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                      </div>
                    </div>

                    {{-- <hr/> --}}

                     Requires Input Field for comment
                    <div id="div-requires_input" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="requires_input"></label>
                      <div class="col-sm-1">
                          <div class="form-check">
                              {{-- {!! Form::hidden('requires_input_value', 0, ['id'=>'requires_input','class' => 'form-check-input']) !!} --}}
                              {!! Form::checkbox('requires_input', '1', null, ['id'=>'requires_input','class' => 'form-check-input']) !!}
                          </div>
                      </div>
                      <div class="col-sm-8">
                        Requires Text Input
                      </div>
                    </div>

                     Required Input Type Field for comment
                    <div id="div-required_input_type" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="required_input_type">Input Type</label>
                      <div class="col-sm-8">
                          {!! Form::text('required_input_type', null, ['id'=>'required_input_type','class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                      </div>
                    </div>

                     Required Input Validation Field for comment
                    <div id="div-required_input_validation" class="form-group">
                      <label class="control-label mb-10 col-sm-3" for="required_input_validation">Input Validation</label>
                      <div class="col-sm-8">
                          {!! Form::text('required_input_validation', null, ['id'=>'required_input_validation','class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                      </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-checklist-editor-save" value="add">Save Checklist Item</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal -->
<div class="modal fade" id="check-list-item-editor-modal" tabindex="-1" aria-labelledby="check-list-item-editor-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="check-list-item-editor-moda">CheckList Item Editor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="error_checklist_editor" class="alert alert-danger" role="alert">
          <span id="error_msg_checklist_editor"></span>
        </div>

        <form id="frm_workflow_creator" name="frm_workflow_creator" >
                  {{ csrf_field() }}

                  <input type="hidden" id="checklist_id" value="-1" />
                    
                  <!-- Item Label Field -->
                  {{-- <div id="div-item_label">
                      <label class="form-label" for="item_label">Label</label>
                      <div>
                          {!! Form::text('item_label', null, ['class' => 'form-control']) !!}
                      </div>
                    </div> --}}

                    <!-- Description Field -->
                    <div class="mb-3">
                        <label for="item_description" class="form-label">Description</label>
                        <div>
                          {!! Form::textarea('item_description', null, ['id'=>'item_description','rows'=>'3','class' => 'form-control']) !!}
                        </div>
                    </div>

                    <!-- Ordinal Field -->
                    <div id="div-ordinal" class="row mb-3">
                      <label class="form-label" for="ordinal">Position</label>
                      <div class="col-md-3">
                          {!! Form::number('ordinal', null, ['id'=>'ordinal','class' => 'form-control']) !!}
                      </div>
                    </div>

                     <!-- Requires Attachment Field -->
                    <div id="div-requires_attachment" class="row mb-3">
                      <div class="col-md-9">
                        <div class="form-check">
                          {{-- {!! Form::hidden('requires_attachment', 0, ['id'=>'requires_attachment','class' => 'form-check-input']) !!} --}}
                          {!! Form::checkbox('requires_attachment', '1', null, ['id'=>'requires_attachment','class' => 'form-check-input']) !!}
                          <label class="form-label" for="requires_attachment">Attachment required</label>
                            </div>
                      </div>
                    </div>

                    <!-- Required Attachment Mime Type Field -->

                    <div id="div-required_attachment_mime_type" class=" mb-3">
                      <div>
                        <label class="form-label" for="required_attachment_mime_type">Mime Type</label>
                          {!! Form::text('required_attachment_mime_type', null, ['id'=>'required_attachment_mime_type','class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                      </div>
                    </div>

                     <!-- Requires Input Field -->
                    <div id="div-requires_input" class="mb-3 row">
                      <div class="col-md-9">
                        <div class="form-check">
                          {{-- {!! Form::hidden('requires_input_value', 0, ['id'=>'requires_input','class' => 'form-check-input']) !!} --}}
                          {!! Form::checkbox('requires_input', '1', null, ['id'=>'requires_input','class' => 'form-check-input']) !!}
                          <label class="form-label" for="requires_input">Requires Text Input</label>
                          </div>
                      </div>
                    </div>

                    <!-- Required Input Type Field -->
                    <div id="div-required_input_type" class="mb-3">
                      <label class="form-label" for="required_input_type">Input Type</label>
                      <div>
                          {!! Form::text('required_input_type', null, ['id'=>'required_input_type','class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                      </div>
                    </div>

                     <!-- Required Input Validation Field -->
                    <div id="div-required_input_validation" class="mb-3">
                      <label class="form-label" for="required_input_validation">Input Validation</label>
                      <div>
                          {!! Form::text('required_input_validation', null, ['id'=>'required_input_validation','class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                      </div>
                    </div> 

                   
                </form>
      </div>
      
      <div id="div-checklist-editor-save" class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-checklist-editor-save" value="add">
                    <span class="spinner">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </span>  
                    Save
                </button>
            </div>
    </div>
  </div>
</div>