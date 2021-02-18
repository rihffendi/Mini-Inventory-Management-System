@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Product</span>
    <h3 class="page-title">View Product</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('products.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Product</a>
	</div>
</div>


	<table class="table table-bordered table-striped table-hover">
		<tbody>
			<tr><td><strong>Product Name    :</strong> {{$product->name}}</td></tr>
			<tr><td><strong>Product Code   :</strong>	{{$product->product_code}}</td></tr>
			<tr><td><strong>Product Category 	 :</strong>	{{$product->category_name}}</td></tr>
			<tr><td><strong>Product SubCategory :</strong>	{{$product->sub_category_name}}</td></tr>
			<tr><td><strong>Product Cost :</strong>	{{$product->product_cost}}</td></tr>
			<tr><td><strong>Product Price :</strong>	{{$product->product_price}}</td></tr>
			<tr><td><strong>Product Tax :</strong>	{{$product->tax}}</td></tr>
			<tr><td><strong>Product Details :</strong>	{{$product->product_details}}</td></tr>	
		</tbody>
	</table>


@endsection