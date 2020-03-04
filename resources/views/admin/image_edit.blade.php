@extends('layouts.admin_layouts.admin_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <br><br>
    <div class="page-content">
      
      
      <div class="container">
        <form id="file-upload-form" class="uploader" action="{{url('/admin/edit/'.$image->id)}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          @csrf
          <input type="file" id="file-input" name="image" class="image_input"/>
          <button class="btn btn-primary"> OPEN FOR UPDATE </button>
          <button type="submit" class="btn btn-success">EDIT IMAGE</button>
        </form>
        <div class="row">
          <h1> IMAGE </h1>
          <br>
          <a class="col-md-4 col-sm-6">
            <img alt="" src="{{ asset('/img/'.$image->image) }}" class="image"/>
          </a>   
        </div>
      </div>
    </div>
</div>
<style>
.image_input {
  opacity: 0;
  width: 163px;
  height: 35px;
  position: relative;
  top: 35px;
  z-index: 1000;
}
.image {
  width: 100%;
  height: 280px;
}
</style>
<!-- END QUICK SIDEBAR -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>
 
  $(document).ready(function(){
  $('#file-input').on('change', function(){ //on file input change
      if (window.File &amp;&amp; window.FileReader &amp;&amp; window.FileList &amp;&amp; window.Blob) //check File API supported browser
      {
          
          var data = $(this)[0].files; //this file data
          
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                      $('#thumb-output').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
          
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
  });
  });
 
</script>
@endsection