@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Expense</span>
    <h3 class="page-title">View Expense</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('accounts.expenses.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Expense</a>
	</div>
</div>


	<table class="table table-bordered table-striped table-hover">
		<tbody>
			<tr><td><strong>Payment Date   :</strong> {{$expense->idate}}</td></tr>
			<tr><td><strong>Payment From   :</strong> {{$expense->iname}}</td></tr>
			<tr><td><strong>Payment Type   :</strong> {{$expense->itype}}</td></tr>
			<tr><td><strong>Paid Amount    :</strong> {{$expense->ipaid}}</td></tr>
			<tr><td><strong>Outstanding    :</strong> {{$expense->ioutstanding}}</td></tr>
			<tr><td><strong>Payment Details:</strong> {{$expense->idetails}}</td></tr>	
		</tbody>
	</table>


@endsection