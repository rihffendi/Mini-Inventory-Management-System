@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Product</span>
    <h3 class="page-title">Manage Product</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-3">
    <div class="col-8">
      <a href="{{route('products.create')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-plus-square pr-2" aria-hidden="true"></i> Add Product</a>
    </div>
    <div class="col-4">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong class="text-white">{{session()->get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong class="text-white">{{session()->get('delete')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<table id="example" class="table table-bordered bg-white card-small" style="width:100%">
        <thead class="bg-darkish text-white">
            <tr>
                <th>SL</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Category</th>
                <th>Product Cost</th>
                <th>Product Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($product as $key => $products)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$products->name}}</td>
                <td>{{$products->product_code}}</td>
                <td>{{$products->category_name}}<br>
                    @if($products->sub_category_name !== NULL)
                       <i class="fas fa-long-arrow-alt-right"></i> {{$products->sub_category_name}}
                    @endif
                </td>
                <td>{{$products->product_cost}}</td>
                <td>{{$products->product_price}}</td>
                <td>
                    <a href="{{route('products.show', $products->id)}}" class="btn btn-xs btn-outline-dark action-button"><i class="fas fa-folder-open"></i></a>
                    <a href="{{route('products.edit', $products->id)}}" class="btn btn-xs btn-outline-secondary action-button"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script>
	$(document).ready(function() {
    $('#example').DataTable();

    window.setTimeout(function() {
        $(".alert").fadeTo(3000, 0).slideUp(3000, function() {
            $(this).hide();
        });
    }, 1000);
} );
</script>

@endsection
