i
<!DOCTYPE html>
<html lang="en">
  <head>
  <base  href="/public" >
 @include('admin.header')
  </head>
  <body>



  @include('admin.sidebar')
@include('admin.navbar')


<div class="container-fluid page-body-wrapper">
<div class="container text-light">
@if(session()->has('message'))
<div class="alert alert-primary ">
<button  type="button" class="close" data-dismiss="alert" >X</button>
{{session()->get('message')}}

</div>
@endif

<table class="table table-striped-columns">
  <thead>


    <tr class="table-light">

      <th scope="col ">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
   <th scope="col">Category</th>
      <th scope="col">Quantity</th>


      <th scope="col">Image</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $product)
    <tr class="table-secondary">

      <td>{{$product->title}}</td>
      <td>{{$product->description}}</td>
      <td>{{$product->price}}</td>
       <td>{{$product->category}}</td>
        <td>{{$product->quantity}}</td>


      <td ><img class="w-100 h-100 rounded-0" src="/productimage/{{$product->image}}"> </td>
      <td><a class="btn btn-info" href="{{url('updateview',$product->id)}}">Update</a></td>
      <td><a class="btn btn-danger" onclick="return confirm('Are You Sure')" href="{{url('deleteproduct',$product->id)}}">Delete</a></td>
    </tr>
    @endforeach

  </tbody>
</table>




</div>
</div>





@include('admin.script')

  </body>
</html>

