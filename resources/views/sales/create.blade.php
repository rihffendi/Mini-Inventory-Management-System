@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Sale</span>
    <h3 class="page-title">Add Sale</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('sales.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Sale</a>
	</div>
</div>

<div class="col-lg-12 mb-4">
	<div class="card card-small">
		<form action="{{route('sales.store')}}" method="post" id="saleForm">
			@csrf
			<div class="row p-3 pt-4">
		        <div class="col-sm-12 col-md-6">
	               <div class="form-group pb-2">
		            	<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Customer Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
							<select class="form-control silver" name="customer_id" id="customer_id">
								<option value="" selected> Select Customer</option>
								@foreach($customer as $customers)
									<option value="{{$customers->id}}">{{$customers->name}}</option>
								@endforeach
			                </select>
			            </div>
		          	</div>
		           <div class="form-group">
						<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Status</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
							<select name="status" id="inputState" class="form-control silver"  aria-label="status" aria-describedby="basic-addon1" >
							  <option selected value="">Select Status</option>
							  <option value="Ordered">Ordered</option>
							  <option value="Delivered">Delivered</option>
						    </select>
						</div>
					</div>
		          	
		        </div>
		        <div class="col-sm-12 col-md-6">
		            <div class="form-group pb-1">
					 	<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Invoice No</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
			                <input type="text"  name="invoice_no" id = "invoice_no"class="form-control silver" placeholder="Invoice No" aria-label="Invoice No" aria-describedby="basic-addon1"> 
			            </div>
					</div>
					 <div class="form-group pt-1">
				       <div class="input-group date">
				       	<div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Date</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
				       	<input type="date" name='date' class="form-control datepicker silver"  aria-label="date" aria-describedby="basic-addon1">
				       </div>
				    </div>
		            
		          
		        </div>
	      	</div>
	      	<div class="row p-3">
	      		<div class="col-md-12">
	      		<table class="table table-borderless m-0 " id="table-count">
	      			<thead>
	      				<tr>
		      				<th style="width: 25%">Product  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></th>
		      				<th>Price</th>
		      				<th>Quantity <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></th>
		      				<th>Tax</th>
		      				<th>Total<i class="fas fa-plus addRow"></i><i class="fas fa-minus removeRow"></i></th>
	      				</tr>
	      			</thead>
	      			<tbody>
	      				<tr>
	      					<td></td>
	      					<td></td>
	      					<td></td>
	      					<td class="text-right">Grand Total</td>
	      					<td>
	      						<div class="form-group">
	      							<div class="input-group">
	      								<input type="number" class="form-control silver" name="grand" id ="grand" disabled>
	      							</div>
	      						</div>
	      					</td>
	      				</tr>
	      			</tbody>
	      		</table>
	      		<button type="submit" class="mb-4 btn btn-primary mr-2 float-right">Save</button>
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
		$('#saleForm').validate({ // initialize the plugin
	            rules: {

	                customer_id: {
	                    required: true
	                },
	                status: {
	                    required: true
	                },
	                invoice_no: {
	                	required: true
	                },
	                date: {
	                	required: true
	                },
	                grand: {
	                	required: true
	                }
	             },
	            messages: {

	            }
	        });
		
		$('#invoice_no').change(function(){
			var invcheck =$('#invoice_no').val().replace(/ /g,'');
			// console.log(as);
			$.ajaxSetup ({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
	     
		 	$.ajax ({
	           
	           url:"{{ route('sales.invcheck') }}",
	           type:"POST",
	           cache:"false",
	           data : {
	           		invcheck : invcheck
	           },
	           success:function (data) {
	           	
	        	$('#invlb').remove();
	            if(data.invcheck){
	             	console.log('Invoice Exist');
	             	  $('#invoice_no').removeClass('valid').addClass('error').attr({
		        		"aria-required": true,
		        		"aria-invalid": true
		        	});
		        	$("<label class=\'error\' for=\'name\' id=\'invlb\'>Invoice aleady Exist</label>").insertAfter('#invoice_no');
		        	 $('#invoice_no').val('');
		        	}
		        else{
	             	$('#invoice_no').removeClass('error').addClass('valid').attr({
		        		"aria-required": true,
		        		"aria-invalid": false
		        	});
		        	$('#invlb').remove();
	             }
		        }

	            
	   		})
		});

	    var count = 1;
	    $('.addRow').on('click', function(){

	    	 $.ajaxSetup ({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
	     
		 	$.ajax ({
	           
	           url:"{{ route('sales.fetch') }}",
	           type:"POST",
	           cache:"false",

	           success:function (data) {
	           	 	newRow();
	              $.each(data.product,function(index,selectProduct){
                  		$('#sd'+ count +'').append('<option value="'+selectProduct.id+'">'+selectProduct.name+'</option>');
	              })
	              count++;
	            }
	   		})


		 	function newRow(){
		 		// console.log(product);
		 		var tr = '<tr>'+
		      				'<td style="width: 25%">'+
		      					'<div class="form-group">'+
		      						'<div class="input-group">'+
				      					'<select class="form-control selectProduct silver" name="selectProduct[]" id="sd'+count+'">'+
										 	
										   '<option value="">Select Product</option>'+
										  // '<option value="0">Inactive</option>'+
									    '</select>'+
								    '</div>'+
								'</div>'+
							'</td>'+
		      				'<td>'+
		      					'<div class="form-group">'+
		      						'<div class="input-group">'+
		      							'<input type="number" class="form-control silver"  name="price[]" id="price'+count+'" value="" disabled>'+
		      						'</div>'+
		      					'</div>'+
		      				'</td>'+
		      				'<td>'+
		      					'<div class="form-group">'+
		      						'<div class="input-group">'+
		      							'<input type="number" class="form-control quant silver" name="quantity[]" id="quantity'+count+'" value="" data-alert="0" aria-label="quantity" aria-describedby="quantity" min="1">'+
		      						'</div>'+
		      					'</div>'+
		      					'<div class="form-group">'+
		      						'<div class="input-group">'+
		      							'<input type="hidden" class="form-control" name="alert_quant" id="alert_quant'+count+'" value="" aria-label="alert_quant" aria-describedby="alert_quant">'+
		      						'</div>'+
		      					'</div>'+
		      				'</td>'+
		      				'<td>'+
		      					'<div class="form-group">'+
		      						'<div class="input-group">'+
			      						'<input type="number" class="form-control" name="tax[]" id="tax'+count+'" value="" disabled>'+
			      					'</div>'+
			      				'</div>'+
			      			'</td>'+
		      				'<td>'+
		      					'<div class="form-group">'+
		      						'<div class="input-group">'+
		      							'<input type="number" class="form-control total silver" name="total[]" id="total'+count+'" value="" disabled>'+
		      						'</div>'+
		      					'</div>'+
		      				'</td>'+
	      				'</tr>';
      			$('tbody tr:last').before(tr);
		 	}
	    });


	    $('.removeRow').on('click', function(){
	    	var rowCount = $('#table-count tr').length;
    	 	$('#table-count').each(function(){
	    	 	if(rowCount > 3){
	    	 		var trow = rowCount - 2; 
		    	 	$('#table-count tr:nth-child('+ trow +')').remove();
		    	 	$(trow).val("");
		    	 	$(rowCount).val("");
	    	 	}
    	 	});
			grandTotal();
	    	count--;
	    });



	    $('tbody').on('change', '.selectProduct', function(e){
	    	var erwe = $('#saleForm').find('.selectProduct option[value='+$(this).val()+']:selected').length;
	    	console.log(erwe);
	    	if( $('#saleForm').find('.selectProduct  option[value='+$(this).val()+']:selected').length>1){
	            alert('option is already selected');

	            $(this).val($(this).find("option:first").val());   
	        }
	        
	    	var product = e.target.value;
	    	var check = e.target.id;
	    	var idNum = check.match(/[0-9]+/g);
	    	
	    	 $.ajaxSetup ({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
	     
		 	$.ajax ({
	           
	           url:"{{ route('sales.singledata') }}",
	           type:"POST",
	           cache:"false",
	           data : {
	           		product : product
	           },
	           success:function (data) {
	           	console.log(data);
	           	  var rowCount = $('#table-count tr').length;
	           	  if(product.length > 0){
	           	  	$.each(data.product,function(index,selectProduct){
         				$('#price'+idNum[0]+'').val(selectProduct.product_price);
             			$('#tax'+idNum[0]+'').val(selectProduct.tax);
             			$('#quantity'+idNum[0]+'').attr('data-alert',data.tquantity.quantity);
             			$('#quantity'+idNum[0]+'').val('');
             			$('#total'+idNum[0]+'').val('');
             			$('#grand').val('');
	              	})
	           	  }
	           	  else{
         				$('#price'+idNum[0]+'').val("");
             			$('#tax'+idNum[0]+'').val("");
             			$('#alert_quant'+idNum[0]+'').val("");
             			$('#quantity'+idNum[0]+'').val("");
             			$('#total'+idNum[0]+'').val("");
             			$('#grand').val("");
	           	  }
	              
	            }

	   		})
	    });


    	function grandTotal() { 
            var el = $('.total').length
            var grand = 0;
            var tl = 0;
            var i;

            for(i=1 ; i<=el; i++) {
        		tl  =  $('#total'+i+'').val();
        		grand = grand + Number(tl);     
   		 	} 
   		 	$('#grand').val(grand);
        }


	    $('tbody').on('change', '.quant', function(e){
	    	var quantity = e.target.value;
	    	var check = e.target.id;
	    	var idNum = check.match(/[0-9]+/g);

	    	if(quantity > 0){
		    	var price = $('#price'+idNum[0]+'').val();
		    	var tax = $('#tax'+idNum[0]+'').val();
		    	var mul = Number(price) * quantity;
		    	var sum = mul + Number(tax);
		    	var total = $('#total'+idNum[0]+'').val(sum);
		    	grandTotal();
	    	}

	    	else{
	    		$('#total'+idNum[0]+'').val('');
	    		$('#grand').val('');
	    	}
	    });

	    
	    	$('form').submit(function(e) {
		 	 	
			        
		    	$('select.selectProduct').each(function(){
		    		if($(this).val() == ""){
			        $(this).removeClass('valid').addClass('error').attr({
		        		"aria-required": true,
		        		"aria-invalid": true
		        	});
		        	$("<label class=\'error\' for=\'name\'>Please Select a Product</label>").insertAfter(this);
		        	 e.preventDefault();
		        	} 

		    	});

		    	var isValid = true;
		    	
		    	$('input.quant').each(function(){
		    		var alertValue = $(this).attr('data-alert');
		    		
		        	if($(this).val() == ""){

		        		// console.log('first');
			        	$(this).removeClass('valid').addClass('error').attr({
			        		"aria-required": true,
			        		"aria-invalid": true
			        	});
			        	$("<label class=\'error\' for=\'name\'>This field is required</label>").insertAfter(this);
			        	 e.preventDefault();
		        	} 
		        	else if((alertValue === 0) || ($(this).val() > Number(alertValue))){
		        		// console.log('second');
		        		// console.log($(this).val());
			        	$(this).removeClass('valid').addClass('error').attr({
			        		"aria-required": true,
			        		"aria-invalid": true
			        	});
			        	$("<label class=\'error\' for=\'name\'>Out of Stock</label>").insertAfter(this);
			        	 e.preventDefault();
		        	}
		        	else{
		        		// console.log('third');
		        		$(this).removeClass('error').addClass('valid').attr({
			        		"aria-required": true,
			        		"aria-invalid": false
			        	});
		        	} 
 	    		});
				
	        	
				$(".silver").each(function() {
				   var element = $(this);
				   if (element.val() == "") {
				       isValid = false;
				   }
				});
				
				if(isValid){
					$("#saleForm :input[type='number']").each(function(e){
						$(this).removeAttr('disabled');
					});
				}

				var row = $('#table-count tr').length;
				if(row < 3){
					$("<label class=\'error\' for=\'name\'><i>*Please Select at least one Product*</i></label>").insertAfter('tbody');
					e.preventDefault();
				}
			
		  });
    });
</script>
@endsection