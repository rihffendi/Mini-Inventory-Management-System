
@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Customer</span>
    <h3 class="page-title">Edit Customer</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('people.customers.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Customer</a>
	</div>
</div>

<div class="col-lg-12 mb-4">
	<div class="card card-small">
 		<form id="supplierForm" action="{{route('people.customers.update', $customer->id)}}" method="post">
 			@csrf
			<div class="row p-3 pt-4">
		        <div class="col-sm-12 col-md-6">
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Customer Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Supplier Name" aria-label="Supplier Name" aria-describedby="basic-addon1" name="name" value="{{$customer->name}}"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Customer Phone</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Supplier Phone" aria-label="Supplier Phone" aria-describedby="basic-addon1" name="phone" value="{{$customer->phone}}"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Customer Email</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="email" class="form-control" placeholder="Supplier Email" aria-label="Supplier Email" aria-describedby="basic-addon1" name="email" value="{{$customer->email}}"> </div>
		            </div>
		            
		        </div>
		        <div class="col-sm-12 col-md-6">
					<div class="form-group">
						<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Status</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
							<select name="status" id="inputState" class="form-control"  aria-label="status" aria-describedby="basic-addon1" >
							  <option value="1" {{$customer->status == 1 ? 'selected' : ''}}>Active</option>
							  <option value="0" {{$customer->status == 0 ? 'selected' : ''}}>Inactive</option>
						    </select>
						</div>
					</div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Customer Address</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Supplier Address" aria-label="Supplier Address" aria-describedby="basic-addon1" name="address" value="{{$customer->address}}"> </div>
		            </div>
		             <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Customer Details</strong></span>
		                </div>
		                <textarea class="form-control" placeholder="Supplier Details" aria-label="Supplier Details" aria-describedby="basic-addon1" name="details">{{$customer->details}}</textarea></div>
		            </div>
		            <button type="submit" class="mb-2 btn btn-primary mr-2 float-right">Update</button>
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

		 $('#supplierForm').validate({ // initialize the plugin
            rules: {

                name: {
                    required: true,
                    maxlength: 30
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    digits: true,
                    maxlength: 11,
                    minlength:11
                },
                address: {
                	required: true,
                	maxlength: 60
                },
                status: {
                	required: true
                }

            },
            messages: {

            }
        });

	});
</script>
@endsection

