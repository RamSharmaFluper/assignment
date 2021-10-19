@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
    
      <a href="{{url('add-company')}}" >       
      <button type="button" style="margin-bottom: 6px;
      width: 113px;" class="btn btn-success">Add Company</button>
      </a>
      <table class="table table-bordered">
        <thead >
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Logo</th>
            <th scope="col">Website</th>
            <th scope="col">Actions</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach ($companies as $key=>$company)
          <tr class='row_{{$company->id}}'>
            <td>{{$company->name}}</td>      
            <td>{{$company->email}}</td>
            <td> <img src="{{ asset('storage/'.$company->logo) }}" alt="" width="100" height="100">
            </td>
            <td>{{$company->website}}</td>
            <td>
              <a href="{{url('edit-company')}}/{{$company->id}}" class="btn btn-success">Edit</a>
              <a href="#" onclick="doSomething({{$company->id}})" id = "{{$company->id}}" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      {{ $companies->links() }}

    </div>
  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  function doSomething(id){
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type:'DELETE',
        url:'/delete-company/'+id,
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
