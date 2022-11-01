
<!DOCTYPE html>
<html lang="en">
  <head>
 @include('admin.header')
  </head>
  <body>



  @include('admin.sidebar')
@include('admin.navbar')

<div class="container-fluid page-body-wrapper">
<div class="container  text-center ">

@if(session()->has('message'))
<div class="alert alert-success ">
<button  type="button" class="close" data-dismiss="alert" >X</button>
{{session()->get('message')}}
</div>
@endif
    <h1 class="mt-4">Add Category</h1>
    <form class="mt-5" action="{{url('add_category')}}" method="post">
        @csrf
    <div class="row mb-3 " >

<label class=" col-sm-2 col-form-label ">Category:</label>
<div class="col-sm-10">
<input type="text"  class="form-control bg-light w-50"  name="Category"  placeholder="Give a Category"  required >


</div>

</div>
<div class="pt-2 text-center">
<input  type="submit"   class="btn btn-success "    >
</div>


</form>


<table class="table mt-5 table-bordered">
  <thead class="table-secondary">
    <tr>

      <th scope="col">Category Name</th>

      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="table-dark">

  @foreach($data as $data)
    <tr>


      <td>{{$data->category_name}}</td>
      <td><a class="btn btn-danger" onclick="return confirm('Are You Sure')" href="{{url('delete_category',$data->id)}}">Delete</a></td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
</div>




@include('admin.script')

  </body>
</html>

