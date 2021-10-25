@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
    
      <a href="{{url('add-employee')}}" >       
      <button type="button" style="margin-bottom: 6px;
      width: 113px;" class="btn btn-success">Add Employee</button>
      </a>
      <table class="table table-bordered">
        <thead >
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Company</th>
            <th scope="col">Actions</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach ($employees as $key=>$employee)
          <tr class='row_{{$employee->id}}'>
            <td>{{$employee->first_name}}</td>      
            <td>{{$employee->last_name}}</td>      
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            <td>{{$employee->name}}</td>
            <td>
              <a href="{{url('edit-employee')}}/{{$employee->id}}" class="btn btn-success">Edit</a>
              <a href="#" onclick="remove({{$employee->id}})" id = "{{$employee->id}}" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      {{ $employees->links() }}

    </div>
  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  function remove(id){
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type:'DELETE',
        url:'/delete-employee/'+id,
        data: {
            "id": id,
            "_token": token,
        },
        success:function(data) {
          location.reload();
        }
    });
  }
</script>
