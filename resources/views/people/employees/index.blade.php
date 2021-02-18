@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Employee</span>
    <h3 class="page-title">Manage Employee</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-3">
    <div class="col-8">
      <a href="{{route('people.employees.create')}}" class="mb-2 btn btn-info mr-2"><i class="fa fa-plus-square pr-2" aria-hidden="true"></i> Add Employee</a>
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
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employee as $key => $employees)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$employees->name}}</td>
                <td>{{$employees->email}}</td>
                <td>{{$employees->phone}}</td>
                @if($employees->gender === 1)
                    <td>Male</td>
                @else
                    <td>Female</td>
                @endif
                <td>{{$employees->salary}}</td>
                @if($employees->status === 1)
                    <td>Active</td>
                @else
                    <td>Inactive</td>
                @endif
                <td>
                    <a href="{{route('people.employees.show', $employees->id)}}" class="btn btn-xs btn-outline-dark action-button"><i class="fas fa-folder-open"></i></a>
                    <a href="{{route('people.employees.edit', $employees->id)}}" class="btn btn-xs btn-outline-secondary action-button"><i class="fas fa-edit"></i></a>
                   {{--  <a href="#" data-id="{{$employees->id}}" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-outline-danger action-button del"><i class="fas fa-trash"></i></a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" >
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fas fa-times"></i>
                    </div>                      
                    <h4 class="modal-title w-100">Are you sure?</h4>    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{route('people.employees.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

     $('.del').on('click',function(){
      var delid = $(this).data('id');
      $('#id').val(delid);
      console.log(delid);
    });
} );
</script>

@endsection

