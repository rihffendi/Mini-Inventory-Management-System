@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Income</span>
    <h3 class="page-title">View Income</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('accounts.incomes.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Income</a>
	</div>
</div>


	<table class="table table-bordered table-striped table-hover">
		<tbody>
			<tr><td><strong>Payment Date   :</strong> {{$income->idate}}</td></tr>
			<tr><td><strong>Payment From   :</strong> {{$income->iname}}</td></tr>
			<tr><td><strong>Payment Type   :</strong> {{$income->itype}}</td></tr>
			<tr><td><strong>Paid Amount    :</strong> {{$income->ipaid}}</td></tr>
			<tr><td><strong>Outstanding    :</strong> {{$income->ioutstanding}}</td></tr>
			<tr><td><strong>Payment Details:</strong> {{$income->idetails}}</td></tr>	
		</tbody>
	</table>


@endsection