@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Category</span>
    <h3 class="page-title">View Category</h3>
  </div>
</div>

<!-- End Page Header -->

<div class="row mb-3">
	<div class="col">
	  <a href="{{route('category.categories.index')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i> Manage Category</a>
	</div>
</div>


	<table class="table table-bordered table-striped table-hover">
		<tbody>
			<tr><td><strong>Category Name    :</strong> {{$category->name}}</td></tr>
			<tr><td><strong>Category Status  :</strong>	
				@if($category->status === 1)
					Active
				@else
					Inactive
				@endif
				</td>
			</tr>
			<tr><td><strong>Category Details :</strong>	{{$category->details}}</td></tr>	
		</tbody>
	</table>


@endsection