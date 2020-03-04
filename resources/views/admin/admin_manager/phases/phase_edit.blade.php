@extends('layouts.admin_layouts.admin_design')
@section('content')

<div class="page-content-wrapper">
  
  <div class="page-content"><hr>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" method="post" action="{{ url('admin/phases/edit/'.$phaseDetails->phase_id) }}" name="edit_phase" id="edit_phase" novalidate="novalidate">{{ csrf_field() }}
                        <div class="form-body">
                            <h3 class="form-section">Edit Phase</h3>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Phase Nr.</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="phase_number" id="phase_number" value="{{ $phaseDetails->phase_number }}" />
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Phase Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="phase_name" id="phase_name" value="{{ $phaseDetails->phase_name }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="submit" value="Edit Project" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
  </div>
</div>

@endsection