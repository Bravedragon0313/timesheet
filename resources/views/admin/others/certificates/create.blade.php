@extends('layouts.admin_layouts.admin_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <br><br>
    <div class="page-content">     
      
      <div class="container">
        <form id="file-upload-form" class="form-horizontal" action="{{url('admin/others/certificates/save')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          @csrf
          <div class="form-body">
            <h3 class="form-section">Add Certificate</h3>
            <div class="form-group has-success">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="certificate_name" required/>
                </div>
            </div>
            <div class="form-group has-success">
                <label class="control-label col-md-3">Department</label>
                <div class="col-md-4">
                    <select  name="department" class="form-control input-sm select2-multiple">
                        @foreach ($disciplines as $discipline)
                            <option value="{{ $discipline->discipline_type }}">{{$discipline->discipline_type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group has-success">
                <label class="control-label col-md-3">Purpose of Use</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="purpose" required/>
                </div>
            </div>
            <div class="form-group has-success">
                <label class="control-label col-md-3">Comments</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="comments" col="10" row="5">
                    </textarea>
                </div>
            </div>
            <div class="form-group has-success">
              <label class="control-label col-md-3">Attachment</label>
              <div class="col-md-4">
                  <input type="file" id="file-input" name="attachment" class="image_input"/>
                  <input type="hidden" id="file-input_val" name="real_name" />
              </div>
            </div>
          </div>
          
          <div class="form-actions">
              <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                      <button type="submit" class="btn btn-success">Save</button>
                  </div>
              </div>
          </div>
          
        </form>
      </div>
    </div>
</div>
<!-- END QUICK SIDEBAR -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
@endsection