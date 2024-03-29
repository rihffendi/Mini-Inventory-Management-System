<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
<style>

body {
    background: #f5f6f8;
    font-size: 15px;
    color: black;
    background-color: #fff;
}
.h6, h6 {
    font-size: 1rem;
    line-height: 1.5rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: .75rem;
    font-weight: 400;
    color: black;
}
.container {
    max-width: 1140px;
}

.card {
    background-color: #fff;
    border: none;
    border-radius: .625rem;
    box-shadow: 0 0.46875rem 2.1875rem rgb(90 97 105 / 10%), 0 0.9375rem 1.40625rem rgb(90 97 105 / 10%), 0 0.25rem 0.53125rem rgb(90 97 105 / 12%), 0 0.125rem 0.1875rem rgb(90 97 105 / 10%);
}
.card-header {
    padding: 1.09375rem 1.875rem;
    background-color: #fff;
    border-bottom: none;
}

.card-body {
    padding: 1.875rem;
    flex: 1 1 auto;
}

.float-right {
    float: right!important;
}

.float-left {
    float: left!important;
}
.mb-5, .my-5 {
    margin-bottom: 3rem!important;
}

.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.pt-5, .py-5 {
    padding-top: 3rem!important;
}
.mt-5, .my-5 {
    margin-top: 3rem!important;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.font-weight-normal {
    font-weight: 400!important;
}
.col-sm-6 {
   
    width: 50%;
}

.table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
    border-collapse: collapse;
}

.table-bordered {

    border: 1px solid #dee2e6;
}

.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table td, .table th {
    padding: .75rem;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}

.text-center {
    text-align: center!important;
}
.text-right {
    text-align: right!important;
}
.col-lg-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
}
.ml-auto, .mx-auto {
    margin-left: auto!important;
}
.col-lg-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
}
</style>
</head>

<body>
    
<div class="container">
   <div class="card">
   <div class="card-header pt-3">
        <div class="col-sm-6">
         Invoice: <strong>{{$purchase->invoice_no}}</strong> <br> Order Date: {{$purchase->date}} <br>  <strong>Status:</strong> {{$purchase->status}}
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3" style="min-height: 200px; clear: both;">
            <div class="col-sm-6 float-left">
                <h6 class="mb-3"><strong>From:</strong></h6>
                <div class="font-weight-normal"><strong>Name : </strong> {{$supplier->name}}</div>
                <div class="font-weight-normal"><strong>Company : </strong> {{$supplier->company}}</div>
                <div class="font-weight-normal"><strong>Address :</strong> {{$supplier->address}}</div>
                <div class="font-weight-normal"><strong>Email : </strong> {{$supplier->email}}</div>
                <div class="font-weight-normal"><strong>Phone : </strong> {{$supplier->phone}}</div>
            </div>
            <div class="col-sm-6  float-right">
                <h6 class="mb-3"><strong>To:</strong></h6>
                <div class="font-weight-normal"><strong>Name : </strong> {{auth()->user()->full_name}}</div>
                <div class="font-weight-normal"><strong>Company : </strong> {{auth()->user()->company_name}}</div>
                <div class="font-weight-normal"><strong>Address : </strong> {{auth()->user()->address}}</div>
                <div class="font-weight-normal"><strong>Email : </strong> {{auth()->user()->email}}</div>
                <div class="font-weight-normal"><strong>Phone : </strong> {{auth()->user()->contact}}</div>
            </div>
        </div>

<div class="pt-5 mb-5" style="clear: both;">
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
                <tr>
                    <td class="text-canter">
                    <strong>Total</strong>
                    </td>
                    <td class="text-center">
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
    <div class="col-lg-4">
        <i><strong>Signature : </strong></i>
        <hr width="100%" color="black" >
    </div>
</div>

</div>
</div>
</div>

</body>
</html>