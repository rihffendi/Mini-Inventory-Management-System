@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Expense</span>
    <h3 class="page-title">Add Expense</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('accounts.expenses.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Expense</a>
	</div>
</div>

<div class="col-lg-12 mb-4">
	<div class="card card-small">
		<form action="{{route('accounts.expenses.store')}}" method="post" id="expenseForm">
			@csrf
			<div class="row p-3 pt-4">
		        <div class="col-sm-12 col-md-6">
		            <div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Supplier</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
							<select name="supplier_id" id="inputState" class="form-control selectSupplier silver"  aria-label="Supplier" aria-describedby="basic-addon1" >
							  <option selected value="">Select Supplier Name</option>
							  @foreach($supplier as $suppliers)
							  	<option value="{{$suppliers->id}}">{{$suppliers->name}}</option>
							  @endforeach()
						    </select>
					</div>
	          	 	
			       	<div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Payment Type</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
						<select name="payment_type" id="inputState" class="form-control silver"  aria-label="status" aria-describedby="basic-addon1" >
						  <option selected value="">Select Payment Type</option>
						  <option value="Cash">Cash</option>
						  <option value="Cheque">Cheque</option>
						  <option value="Pay-order">Pay-order</option>
					    </select>
					</div>
					<div class="input-group date">
				       	<div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Date</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
				       	<input type="date" name='payment_date' class="form-control datepicker silver"  aria-label="date" aria-describedby="basic-addon1">
			       	</div>
		        </div>
		        <div class="col-sm-12 col-md-6">
	        	 	<div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Outstanding</strong>
		                </div>
		                <input type="number" class="form-control silver" placeholder="Outstanding" aria-label="Outstanding" aria-describedby="basic-addon1" name="outstanding" id="outstanding" disabled> </div>
		            </div>
					<div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Paid Amount</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="number" class="form-control silver" placeholder="Paid Amount" aria-label="Paid Amount" aria-describedby="basic-addon1" name="paid" id="paid"> </div>
		            </div>
		           
		             <div class="form-group">
		              <div class="input-group mb-3">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Income Details</strong></span>
		                </div>
		                <textarea class="form-control" placeholder="Income Details" aria-label="Income Details" aria-describedby="basic-addon1" name="details"></textarea></div>
		            </div>
		            <button type="submit" class="mt-3 btn btn-primary mr-2 float-right">Save</button>
		        </div>
	      	</div>
      	</form>
	</div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
	$(document).ready(function() {
		$('#expenseForm').validate({ // initialize the plugin
            rules: {

                supplier_id: {
                    required: true
                },
                payment_date: {
                    required: true
                },
                payment_type: {
                	required: true
                },
                paid: {
                	required: true
                }
             },
            messages: {

            }
        });

         $('body').on('change', '.selectSupplier', function(e){
	    	// alert('hello');
	    	// if( $('#purchaseForm').find('select option[value='+$(this).val()+']:selected').length>1){
	     //        alert('option is already selected');
	     //        $(this).val($(this).find("option:first").val());   
	     //    }
	    	var supplier = e.target.value;
	    	
	    	 $.ajaxSetup ({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
	     
		 	$.ajax ({
	           
	           url:"{{ route('accounts.expenses.singledata') }}",
	           type:"POST",
	           cache:"false",
	           data : {
	           		supplier : supplier
	           },
	           success:function (data) {
	           	  console.log(data);
	           	  $('#outstanding').val(data.supplier);
	            }

	   		})
	    });

        


         $('form').submit(function(e) {
         	$(".silver").each(function() {
				   var element = $(this);
				   if (element.val() == "") {
				       isValid = false;
				   }
				});
				
				if(isValid){
					$("#expenseForm :input[type='number']").each(function(e){
						$(this).removeAttr('disabled');
					});
				}
         });
	});
</script>
@endsection