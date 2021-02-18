@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Customer</span>
    <h3 class="page-title">View Customer</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('people.customers.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Customer</a>
	</div>
</div>


	<table class="table table-bordered table-striped table-hover">
		<tbody>
			<tr><td><strong>Customer Name    :</strong> {{$customer->name}}</td></tr>
			<tr><td><strong>Customer Email   :</strong>	{{$customer->email}}</td></tr>
			<tr><td><strong>Customer Phone 	 :</strong>	{{$customer->phone}}</td></tr>
			<tr><td><strong>Customer Address :</strong>	{{$customer->address}}</td></tr>
			<tr><td><strong>Customer Status  :</strong>	
				@if($customer->status === 1)
					Active
				@else
					Inactive
				@endif
				</td>
			</tr>
			<tr><td><strong>Customer Details :</strong>	{{$customer->details}}</td></tr>	
		</tbody>
	</table>


@endsection