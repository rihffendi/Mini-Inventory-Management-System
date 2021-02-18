@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Employee</span>
    <h3 class="page-title">View Employee</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('people.employees.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Employee</a>
	</div>
</div>


	<table class="table table-bordered table-striped table-hover">
		<tbody>
			<tr><td><strong>Employee Name    :</strong> {{$employee->name}}</td></tr>
			<tr><td><strong>Employee Email   :</strong>	{{$employee->email}}</td></tr>
			<tr><td><strong>Employee Phone 	 :</strong>	{{$employee->phone}}</td></tr>
			<tr><td><strong>Employee Gender  :</strong>	
				@if($employee->gender === 1)
					Male
				@else
					Female
				@endif
				</td>
			</tr>
			<tr><td><strong>Employee Age 	 :</strong>	{{$employee->age}}</td></tr>
			<tr><td><strong>Employee NID 	 :</strong>	{{$employee->national_id}}</td></tr>
			<tr><td><strong>Employee Address :</strong>	{{$employee->address}}</td></tr>
			<tr><td><strong>Employee Status  :</strong>	
				@if($employee->status === 1)
					Active
				@else
					Inactive
				@endif
				</td>
			</tr>
			<tr><td><strong>Employee Salary  :</strong>	{{$employee->salary}}</td></tr>	
		</tbody>
	</table>


@endsection