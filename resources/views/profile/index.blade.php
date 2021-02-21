@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Profile</span>
    <h3 class="page-title">Update Profile</h3>
  </div>
</div>

<div class="row mb-3">
	<div class="col-8">
	  <a href="{{route('dashboard.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2 " aria-hidden="true"></i> Dashboard</a>
	</div>
    <div class="col-4">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong class="text-white">{{session()->get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong class="text-white">{{session()->get('delete')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<div class="mb-4">
	<div class="card card-small ">
 		<form id="profileForm" action="{{route('profile.update', auth()->user()->id)}}" method="post" enctype="multipart/form-data">
 			@csrf
			<div class="row p-3 pt-4">
		        <div class="col-sm-12 col-md-6">
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>User Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="User Name" aria-label="Supplier Name" aria-describedby="basic-addon1" name="user_name" value="{{auth()->user()->name}}"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Full Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Full Name" aria-label="Full Name" aria-describedby="basic-addon1" name="full_name" value="{{auth()->user()->full_name}}"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Email</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" value="{{auth()->user()->email}}"> </div>
		            </div>
                    <div class="form-group">
                        <div class="input-group col-xs-12">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><strong>Company Logo</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
                            </div>
                        </div>
                       
                        @if((auth()->user()->company_logo))
                            <input type="file" class="form-control file-upload-default d-none" name="company_logo" id="company_files" value="{{auth()->user()->company_logo}}">
                            <span class="pip">
                                <img src="{{auth()->user()->company_logo}}" class="imageThumb float-left " alt="">
                                <a href="#" class="float-right" id="logoChangeCompany">Change Company Logo</a>
                            </span>
                            
                        @else
                            <input type="file" class="form-control file-upload-default" name="company_logo" id="company_files" value="">
                        @endif
                    </div>
		          
		        </div>
		        <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><strong>Company Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Company Name" aria-label="Company Name" aria-describedby="basic-addon1" name="company_name" value="{{auth()->user()->company_name}}"> </div>
                    </div>
		        	 <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Company Address</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Company Address" aria-label="Company Address" aria-describedby="basic-addon1" name="company_address" value="{{auth()->user()->address}}"> </div>
		            </div>
				 	<div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Company Contact</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Company Contact" aria-label="Company Contact" aria-describedby="basic-addon1" name="company_contact" value="{{auth()->user()->contact}}"> </div>
		            </div>
	          	  
		           	<div class="form-group">
                        <div class="input-group col-xs-12">
                        	<div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Profile Photo</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
                        </div>
                      	@if(auth()->user()->profile_photo)
                        	<input type="file" class="form-control file-upload-default d-none" name="profile_photo" id="profile_files" value="{{auth()->user()->profile_photo}}">
                      	
                        	<div class="thumb-img">
		                  	 	<span class="pips">
		                        	<img src="{{auth()->user()->profile_photo}}" class="imageThumb float-left " alt="">
		                        </span><br/>
		                        <a href="#" class="float-right" id="logoChangeProfile">Change Profile photo</a>
	                        </div>
	                    @else
	                   	 	<input type="file" class="form-control file-upload-default d-none" name="profile_photo" id="profile_files" value="">
	                    @endif
                    </div>
		            <button type="submit" class="mt-3 btn btn-primary mr-2 float-right">Save</button>
		        </div>
	      	</div>
      	</form>
	</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

    	$("#logoChangeProfile").on("click", function(e) {
    		$('.thumb-img').remove();
    		$('#profile_files').removeClass('d-none');
    	});

    	$("#logoChangeCompany").on("click", function(e) {
    		$('.pip').remove();
    		$('#company_files').removeClass('d-none');
    	});


        $("#company_files").on("change", function(e) {
	        var files = e.target.files,
	          filesLength = files.length;

	          if(filesLength > 0){
	            $(".pip").remove();
	          }
	          var fileReader = new FileReader();
	          fileReader.onload = (function(e) {
	            var file = e.target;
	            $("<span class=\"pip\">" +
	              "<img class=\"imageThumb float-left\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
	              "<br/><a href=\"#\" class=\"remove\"><button class=\"btn btn-sm btn-danger float-right\">Remove</button></a>" +
	              "</span>").insertAfter("#company_files");
	            $(".remove").click(function(){
	              $(this).parent(".pip").remove();
	              $('#company_files').val('');
	            });
	          });
	          fileReader.readAsDataURL(files[0]);
	        
      	});

      	$("#profile_files").on("change", function(e) {
	        var files = e.target.files,
	          filesLength = files.length;

	          if(filesLength > 0){
	          	$(".thumb-img").remove();
	            // $(".pips").remove();
	          }
	          var fileReader = new FileReader();
	          fileReader.onload = (function(e) {
	            var file = e.target;
	            $("<div class=\"thumb-img\"><span class=\"pips\">" +
	              "<img class=\"imageThumb float-left\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
	              "<br/><a href=\"#\" class=\"remove\"><button class=\"btn btn-sm btn-danger float-right\">Remove</button></a>" +
	              "</span></div>").insertAfter("#profile_files");
	            $(".remove").click(function(){
	              $(this).parent(".pips").remove();
	              $(".thumb-img").remove();
	              $('#profile_files').val('');
	            });
	          });
	          fileReader.readAsDataURL(files[0]);
	        
      	});
        $.validator.addMethod('dimention', function(value, element, param) {
            if (element.files.length == 0) {
                return true;
            }
            var width = $(element).data('imageWidth');
            var height = $(element).data('imageHeight');
            if (width == param[0] && height == param[1]) {
                return true;
            } else {
                return false;
            }
        }, 'Image size should be 150px x 150px');

        $.validator.addMethod('filesize', function(value, element, param) {

            if (element.files.length == 0) {
                return true;
            }
            var size = element.files[0].size;

            size = size / 1024;
            size = Math.round(size);
            return this.optional(element) || size <= param;

        }, 'Image size must be less than 500kb');

        $('#company_files').change(function() {
            $('#company_files').removeData('imageWidth');
            $('#company_files').removeData('imageHeight');
            var file = this.files[0];
            var tmpImg = new Image();
            tmpImg.src = window.URL.createObjectURL(file);
            tmpImg.onload = function() {
                width = tmpImg.naturalWidth,
                    height = tmpImg.naturalHeight;
                $('#company_files').data('imageWidth', width);
                $('#company_files').data('imageHeight', height);
            }
        });

          $('#profile_files').change(function() {
            $('#profile_files').removeData('imageWidth');
            $('#profile_files').removeData('imageHeight');
            var file = this.files[0];
            var tmpImg = new Image();
            tmpImg.src = window.URL.createObjectURL(file);
            tmpImg.onload = function() {
                width = tmpImg.naturalWidth,
                    height = tmpImg.naturalHeight;
                $('#profile_files').data('imageWidth', width);
                $('#profile_files').data('imageHeight', height);
            }
        });
        $('#profileForm').validate({ // initialize the plugin
            rules: {

                user_name: {
                    required: true,
                    maxlength: 25

                },
             	full_name: {
                    required: true

                },
                email: {
                    required: true

                },
                company_name: {
                    required: true

                },
                company_address: {
                    required: true

                },
             	company_contact: {
	                required: true,
	                digits: true,
                 	maxlength: 11,
                    minlength:11

	            },
                company_logo: {
                    required: true,
                    extension: "jpg,jpeg,png",
                    dimention: [150, 150],
                    filesize: 500
                },
                profile_photo: {
                    required: true,
                    extension: "jpg,jpeg,png",
                    dimention: [150, 150],
                    filesize: 500
                }
            },
            messages: {
            
            }
        });
   });
</script>
@endsection



