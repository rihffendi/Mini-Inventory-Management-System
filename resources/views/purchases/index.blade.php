@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Purchase</span>
    <h3 class="page-title">Manage Purchase</h3>
  </div>
</div>
<!-- End Page Header -->


<div class="row mb-3">
    <div class="col-8">
      <a href="{{route('purchases.create')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-plus-square pr-2" aria-hidden="true"></i> Add Purchase</a>
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
                <th>Supplier Name</th>
                <th>Invoice No</th>
                <th>Status</th>
                <th>Grand Total</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase as $key => $purchases)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$purchases->psupplier}}</td>
                <td>{{$purchases->pinv}}</td>
                <td>{{$purchases->pstatus}}</td>
                <td>{{$purchases->ptotal}}</td>
                <td>{{$purchases->pdate}}</td>
                <td>
                    <a href="{{route('purchases.show', $purchases->pid)}}" class="btn btn-xs btn-outline-dark action-button"  data-toggle="tooltip" data-placement="top" title="Details"><i class="fas fa-folder-open"></i></a>
                    <a href="{{route('purchases.edit', $purchases->pid)}}" class="btn btn-xs btn-outline-secondary action-button"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                      <a href="{{route('purchases.invoice', $purchases->pid)}}" class="btn btn-xs btn-outline-dark action-button" data-toggle="tooltip" data-placement="top" title="Invoice"><i class="far fa-file-alt"></i>
                    </a>
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
    $('[data-toggle="tooltip"]').tooltip()
} );

</script>

@endsection

