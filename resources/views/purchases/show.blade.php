@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Purchase</span>
    <h3 class="page-title">View Purchase</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('purchases.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Purchase</a>
	</div>
</div>


<table id="example" class="table table-bordered bg-white card-small" style="width:100%">
        <thead class="bg-darkish text-white">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (Per Unit)</th>
                <th>Tax </th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase as $purchases)
            <tr>
                <td>{{$purchases->pproduct}}</td>
                <td>{{$purchases->pquantity}}</td>
                <td>{{$purchases->pprice}}</td>
                <td>{{$purchases->ptax}}</td>
                <td>{{$purchases->ptotal}}</td>
                <td>
                    <a href="{{route('purchases.edit', $purchases->pid)}}" class="btn btn-xs btn-outline-secondary action-button"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection