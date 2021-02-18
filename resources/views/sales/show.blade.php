@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Sale</span>
    <h3 class="page-title">View Sale</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('sales.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Sale</a>
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
            @foreach($sale as $sales)
            <tr>
                <td>{{$sales->sproduct}}</td>
                <td>{{$sales->squantity}}</td>
                <td>{{$sales->sprice}}</td>
                <td>{{$sales->stax}}</td>
                <td>{{$sales->stotal}}</td>
                <td>
                    <a href="{{route('sales.edit', $sales->sid)}}" class="btn btn-xs btn-outline-secondary action-button"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection