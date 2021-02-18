@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Stock</span>
    <h3 class="page-title">Manage Stock</h3>
  </div>
</div>
<!-- End Page Header -->



<table id="example" class="table table-bordered bg-white card-small" style="width:100%">
        <thead class="bg-darkish text-white">
            <tr>
                <th>SL</th>
                <th>Product Name</th>
                <th>Total Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $key => $products)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$products->pname}}</td>
                <td>{{$products->pquantity}}</td>
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
} );
</script>

@endsection

