@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Supplier</span>
    <h3 class="page-title">View Supplier</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('people.suppliers.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Supplier</a>
	</div>
</div>


	<table class="table table-bordered table-striped table-hover">
		<tbody>
			<tr><td><strong>Supplier Name    :</strong> {{$supplier->name}}</td></tr>
			<tr><td><strong>Supplier Email   :</strong>	{{$supplier->email}}</td></tr>
			<tr><td><strong>Supplier Phone 	 :</strong>	{{$supplier->phone}}</td></tr>
			<tr><td><strong>Supplier Company :</strong>	{{$supplier->company}}</td></tr>
			<tr><td><strong>Supplier Address :</strong>	{{$supplier->address}}</td></tr>
			<tr><td><strong>Supplier Status  :</strong>	
				@if($supplier->status === 1)
					Active
				@else
					Inactive
				@endif
				</td>
			</tr>
			<tr><td><strong>Supplier Details :</strong>	{{$supplier->details}}</td></tr>	
			@if($outstanding)
			<tr><td><strong>Supplier Outstanding :</strong>	{{$outstanding->outstanding}}</td></tr>	
			@else
			<tr><td><strong>Supplier Outstanding :</strong>	0</td></tr>	
			@endif
		</tbody>
	</table>


@endsection