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
    <div class="col">
      <a href="{{route('purchases.download', $purchase->id)}}" class="mb-2 btn btn-success mr-2 float-right"><i class="fa fa-arrow-down pr-2" aria-hidden="true"></i> Download</a>
    </div>
</div>

<div class="container">
  <div class="card">
<div class="card-header pt-5">
Invoice:
<strong>{{$purchase->invoice_no}}</strong> <br>Issue Date: {{$purchase->date}}
  <span class="float-right"> <strong>Status:</strong> {{$purchase->status}}</span>

</div>
<div class="card-body">
<div class="row mb-5">
<div class="col-sm-6">
<h6 class="mb-3">From:</h6>
<div>
<strong>{{$supplier->name}}</strong>
</div>
<div>{{$supplier->address}}</div>
<div>Email: {{$supplier->email}}</div>
<div>Phone: {{$supplier->phone}}</div>
</div>


<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>Rafiat Ibna Hussine</strong>
</div>
<div>173 South Goran,Dhaka</div>
<div>Email: mdrafiatibnahussine@gmail.com</div>
<div>Phone: 01677317694</div>
</div>





</div>

<div class="table-responsive-sm pt-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Item</th>
                <th class="text-center">Unit Cost</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Tax</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice as $key => $invoices)
            <tr>
                <td class="text-center">{{$key+1}}</td>
                <td class="text-left strong">{{$invoices->iproduct}}</td>
                <td class="text-center">{{$invoices->iprice}}</td>
                <td class="text-center">{{$invoices->iquan}}</td>
                <td class="text-center">{{$invoices->itax}}</td>
                <td class="text-right">{{$invoices->isubtotal}}</td>
            </tr>
            @endforeach
    </tbody>
    </table>
</div>
<div class="row">
    <div class="col-lg-8 col-sm-5">

    </div>

    <div class="col-lg-4 col-sm-5 ml-auto">
        <table class="table table-borderless">
            <tbody>
             {{--    <tr>
                    <td class="left">
                    <strong>Subtotal</strong>
                    </td>
                    <td class="right">$8.497,00</td>
                </tr>
                <tr>
                    <td class="left">
                    <strong>Discount (20%)</strong>
                    </td>
                    <td class="right">$1,699,40</td>
                </tr>
                <tr>
                    <td class="left">
                     <strong>VAT (10%)</strong>
                    </td>
                    <td class="right">$679,76</td>
                </tr> --}}
                <tr>
                    <td class="text-canter">
                    <strong>Total</strong>
                    </td>
                    <td class="text-right">
                    <strong>{{$purchase->grand_total}}</strong>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</div>
<div class="row mt-5 pt-5">
    <div class="col-lg-8 text-right">
    </div>
    <div class="col-lg-4 ">
        <i><strong>Signature : </strong></i>
        <hr width="100%" color="black" >
    </div>
</div>

</div>
</div>
</div>


@endsection