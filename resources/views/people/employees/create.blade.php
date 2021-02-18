@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Employee</span>
    <h3 class="page-title">Add Employee</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('people.employees.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Employee</a>
	</div>
</div>

<div class="col-lg-12 mb-4">
	<div class="card card-small">
		<form id="employeeForm" action="{{route('people.employees.store')}}" method="post">
			@csrf
			<div class="row p-3 pt-4">
		        <div class="col-sm-12 col-md-6">
		            <div class="form-group">
		              <div class="input-group mb-4">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Employee Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Employee Name" aria-label="Employee Name" aria-describedby="basic-addon1" name="name"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-4">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Employee Phone</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Employee Phone" aria-label="Employee Phone" aria-describedby="basic-addon1" name="phone"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Employee Email</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="email" class="form-control" placeholder="Employee Email" aria-label="Employee Email" aria-describedby="basic-addon1" name="email"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Employee NID</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Naional ID" aria-label="Employee NID" aria-describedby="basic-addon1" name="national_id"> </div>
		            </div>
		        </div>
		        <div class="col-sm-12 col-md-6">
		          	<div class="form-row">
						<div class="form-group col-md-6">
							<div class="input-group mb-3">
				                <div class="input-group-prepend">
				                  <span class="input-group-text" id="basic-addon1"><strong>Status</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
				                </div>
								<select name="status" id="inputState" class="form-control"  aria-label="status" aria-describedby="basic-addon1" name="status" >
								  <option selected value="">Select Status</option>
								  <option value="1">Active</option>
								  <option value="0">Inactive</option>
							    </select>
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="input-group mb-3">
				                <div class="input-group-prepend">
				                  <span class="input-group-text" id="basic-addon1"><strong>Gender</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
				                </div>
								<select name="gender" id="inputState" class="form-control"  aria-label="gender" aria-describedby="basic-addon1" name="gender" >
								  <option selected value="">Select Gender</option>
								  <option value="1">Male</option>
								  <option value="0">Female</option>
							    </select>
							</div>
						</div>
					</div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Employee Address</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Employee Address" aria-label="Employee Address" aria-describedby="basic-addon1" name="address"></div>
		            </div>
	             	<div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Employee Age</strong></span>
		                </div>
		                <input type="text" class="form-control"placeholder="Employee Age" aria-label="Employee Age" aria-describedby="basic-addon1" name="age"></div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Employee Salary</strong></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Employee Salary" aria-label="Employee Salary" aria-describedby="basic-addon1" name="salary"></div>
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

		 $('#employeeForm').validate({ // initialize the plugin
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
                },
             	age: {
                	required: true,
                	range: [18, 65]
                },
                salary: {
                	required: true,
                	digits: true
                },
             	national_id: {
                	required: true,
                	maxlength: 15
                },
                gender: {
                	required: true
                }

            },
            messages: {

            }
        });

	});
</script>
@endsection
