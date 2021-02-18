@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Sub Category</span>
    <h3 class="page-title">Add Sub Category</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('category.sub-categories.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Sub Category</a>
	</div>
</div>

<div class="col-lg-12 mb-4">
	<div class="card card-small">
		<form id="categoryForm" action="{{route('category.sub-categories.store')}}" method="post">
			@csrf
			<div class="row p-3 pt-4">
		        <div class="col-sm-12 col-md-12">
		            <div class="form-group pb-2">
		              <div class="input-group mb-2">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Sub Category Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Sub Category Name" aria-label="Sub Category Name" aria-describedby="basic-addon1"name="name"> </div>
		            </div>
		            
		            <div class="form-group">
						<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Category</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
							<select name="category" id="inputState" class="form-control"  aria-label="status" aria-describedby="basic-addon1" >
							  <option selected value="">Select Category</option>
							  @foreach($category as $categories)	
							  	<option value="{{$categories->id}}">{{$categories->name}}</option>
							  @endforeach
						    </select>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Status</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
							<select name="status" id="inputState2" class="form-control"  aria-label="status" aria-describedby="basic-addon1" >
							  <option selected value="">Select Status</option>
							  <option value="1">Active</option>
							  <option value="0">Inactive</option>
						    </select>
						</div>
					</div>
	          	  	<div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Sub Category Details</strong></span>
		                </div>
		                <textarea class="form-control" placeholder="Category Details" aria-label="Category Details" aria-describedby="basic-addon1" name="details"></textarea></div>
		            </div>
		            <button type="submit" class="mb-2 btn btn-primary mr-2 float-right">Save</button>
		        </div>
	      	</div>
      	</form>
	</div>
</div>
@endsection

@section('script')
<!-- Validation js for forms-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
	$(document).ready(function() {

		 $('#categoryForm').validate({ // initialize the plugin
            rules: {

                name: {
                    required: true,
                    maxlength: 30
                },
                status: {
                	required: true
                },
                category: {
                	required: true
                }

            },
            messages: {

            }
        });

	});
</script>
@endsection