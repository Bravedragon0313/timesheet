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
                    <form class="form-horizontal" method="post" action="{{ url('admin/proposals/edit/'.$proposalDetails->proposal_id) }}" name="edit_proposal" id="edit_proposal" novalidate="novalidate">{{ csrf_field() }}
                        <div class="form-body">
                            <h3 class="form-section">Edit Proposal</h3>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Proposal Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="proposal_name" id="proposal_name" value="{{ $proposalDetails->proposal_name }}" />
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Start Date</label>
                                <div class="col-md-4">
                                    <input type="date" name="startDate" max="3000-12-31" min="1000-01-01" class="form-control" value="{{ $proposalDetails->startDate }}">
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">End Date</label>
                                <div class="col-md-4">
                                    <input type="date" name="endDate" max="3000-12-31" min="1000-01-01" class="form-control" value="{{ $proposalDetails->endDate }}">
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Client Name</label>
                                <div class="col-md-4">
                                    <select id="proposal_cel" name="client_name" class="form-control input-sm select2-multiple">
                                        <option></option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->client_name }}" {{ ($proposalDetails->client_name==$client->client_name) ? "selected" : "" }}>{{$client->client_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Client Email</label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control" name="client_email" value="{{ $proposalDetails->client_email }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Client Address</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="client_addr" value="{{ $proposalDetails->client_addr }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Phone Number</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="client_phone" value="{{ $proposalDetails->client_phone }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Person to Contact</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="client_contact" value="{{ $proposalDetails->client_contact }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Dicipline</label>
                                <div class="col-md-4">
                                    <select id="proposal_cel" name="client_dicip" class="form-control input-sm select2-multiple">
                                        @foreach ($disciplines as $discipline)
                                            <option value="{{ $discipline->discipline_type }}" {{ ($proposalDetails->client_dicip==$discipline->discipline_type) ? "selected" : "" }}>{{$discipline->discipline_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Importance Level</label>
                                <div class="col-md-4">
                                    <select name="importance_level" class="form-control input-sm select2-multiple">
                                        <option value="high" {{ ($proposalDetails->importance_level=="high") ? "selected" : "" }}>high</option>
                                        <option value="medium" {{ ($proposalDetails->importance_level=="medium") ? "selected" : "" }}>medium</option>
                                        <option value="low" {{ ($proposalDetails->importance_level=="low") ? "selected" : "" }}>low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Comments</label>
                                <div class="col-md-4">
                                    <textarea type="text" class="form-control" name="client_comments" rows="5">
                                    {{ $proposalDetails->client_comments }}
                                    </textarea>
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