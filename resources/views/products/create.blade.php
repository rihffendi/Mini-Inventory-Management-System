@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Product</span>
    <h3 class="page-title">Add Product</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('products.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Product</a>
	</div>
</div>

<div class="col-lg-12 mb-4">
	<div class="card card-small">
		<form id="productForm" action="{{route('products.store')}}" method="post">
			@csrf
			<div class="row p-3 pt-4">
		        <div class="col-sm-12 col-md-6">
		            <div class="form-group pb-2">
		              <div class="input-group mb-2">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Product Name</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
		                </div>
		                <input type="text" class="form-control" placeholder="Product Name" aria-label="Product Name" aria-describedby="basic-addon1" name="name"> </div>
		            </div>
		            
		            <div class="form-group pb-2">
		            	<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Category</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
			                </div>
							<select class="form-control" name="category" id="category">
								<option value="" selected> Select Category</option>
							  @foreach($category as $categories)
							  	<option value="{{$categories->id}}">{{$categories->name}}</option>
							  @endforeach
			                </select>
			            </div>
		          	</div>
		            <div class="form-group pb-2">
		            	<div class="input-group mb-3">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id="basic-addon1"><strong>Sub Category</strong></span>
			                </div>
							<select class="form-control" name="subcategory" id="subcategory" disabled>
			                </select>
			            </div>
		          	</div>
		          	 <div class="form-row">
						<div class="form-group col-md-6">
						 	<div class="input-group mb-3">
				                <div class="input-group-prepend">
				                  <span class="input-group-text" id="basic-addon1"><strong>Product Code</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
				                </div>
				                <input type="text" class="form-control" placeholder="Product Code" aria-label="Product Code" aria-describedby="basic-addon1" name="product_code"> 
				            </div>
						</div>
						<div class="form-group col-md-6">
							<div class="input-group mb-3">
				                <div class="input-group-prepend">
				                  <span class="input-group-text" id="basic-addon1"><strong>Alert Quantity</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
				                </div>
				                <input type="number" class="form-control" placeholder="Alert Quantity" aria-label="Alert Quantity" aria-describedby="basic-addon1" name="alert_quantity"> 
				            </div>
						</div>
					</div>
		        </div>
		        <div class="col-sm-12 col-md-6">
		           
		            <div class="form-row">
						<div class="form-group col-md-6">
						 	<div class="input-group mb-3">
				                <div class="input-group-prepend">
				                  <span class="input-group-text" id="basic-addon1"><strong>Product Cost</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
				                </div>
				                <input type="number" class="form-control" placeholder="Product Cost" aria-label="Product Cost" aria-describedby="basic-addon1" name="product_cost"> 
				            </div>
						</div>
						<div class="form-group col-md-6">
							<div class="input-group mb-3">
				                <div class="input-group-prepend">
				                  <span class="input-group-text" id="basic-addon1"><strong>Product Price</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
				                </div>
				                <input type="number" class="form-control" placeholder="Product Price" aria-label="Product Price" aria-describedby="basic-addon1" name="product_price"> 
				            </div>
						</div>
					</div>
					<div class="form-group">
		              <div class="input-group mb-3 mt-2">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Product Tax</strong></span>
		                </div>
		                <input type="number" class="form-control" placeholder="Product Tax" aria-label="Product Tax" aria-describedby="basic-addon1" name="tax"> </div>
		            </div>
		            <div class="form-group">
		              <div class="input-group mb-3 mt-4">
		                <div class="input-group-prepend">
		                  <span class="input-group-text" id="basic-addon1"><strong>Product Details</strong></span>
		                </div>
		                <textarea class="form-control" placeholder="Product Details" aria-label="Product Details" aria-describedby="basic-addon1" name="product_details"></textarea> </div>
		            </div>
		            <button type="submit" class="mb-2 mt-5 btn btn-primary mr-2 float-right">Save</button>
		          
		        </div>
	      	</div>
      	</form>
	</div>
</div>
@endsection

@section('script')
<!-- Validation js for forms-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
	$(document).ready(function() {

		$('#productForm').validate({ // initialize the plugin
            rules: {

                name: {
                    required: true,
                    maxlength: 30
                },
                category: {
                    required: true
                },
                product_code: {
                	required: true,
                	maxlength: 20
                },
                alert_quantity: {
                	required: true,
                },
             	product_cost: {
                	required: true,
                	digits: true
                },
                product_price: {
                	required: true,
                	digits: true
                }
            },
            messages: {

            }
        });
	    $('#category').on('change',function(e) {
	     
			var cat_id = e.target.value;
			console.log(cat_id);

	       $.ajaxSetup ({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
	     
		 	$.ajax ({
	           
	           url:"{{ route('products.fetch') }}",
	           type:"POST",
	           data: {
	               cat_id: cat_id
	            },
	           success:function (data) {
	           		// console.log(data);
	              $('#subcategory').empty();
				  $('#subcategory').removeAttr('disabled');
				  if(data == '' || data.subcat == ''){
				  	$('#subcategory').prop('disabled', true);
				  }
	              $.each(data.subcat,function(index,subcategory){
	                  $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
	              })
	            }
	   		})
	    });
	});
</script>
@endsection
