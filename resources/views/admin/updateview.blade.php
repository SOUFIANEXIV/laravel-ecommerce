
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
<div class="container  ">
<h1 class="fs-3 text-center pt-2"> Edit Products</h1>


@if(session()->has('message'))
<div class="alert alert-success ">
<button  type="button" class="close" data-dismiss="alert" >X</button>
{{session()->get('message')}}
</div>
@endif
<form action="{{url('updateproduct',$data->id)}}" method="post" enctype="multipart/form-data" >
    @csrf
<div class="row mb-3" >

    <label class=" col-sm-2 col-form-label ">Product Title:</label>
   <div class="col-sm-10">
    <input type="text"  class="form-control text-light"  name="title" value="{{$data->title}}"  required >
</div>
</div>


<div class="row mb-3" >

    <label class=" col-sm-2 col-form-label">Price:</label>
   <div class="col-sm-10">
    <input type="text"  class="form-control text-light"  name="price" value="{{$data->price}}" required >
</div>
</div>
<div class="row mb-3" >

    <label class=" col-sm-2 col-form-label">Description:</label>
   <div class="col-sm-10">
    <input type="text"  class="form-control text-light"  name="des"  value="{{$data->description}}"  required >
</div>
</div>

<div class="row mb-3" >

    <label class=" col-sm-2 col-form-label">Quantity:</label>
   <div class="col-sm-10">
    <input type="number"  class="form-control text-light"  name="quantity"  value="{{$data->quantity}}"  required >
</div>



<div class="row mb-3 mt-2">
    <label  class=" col-sm-2 col-form-label">Category:</label>
    <div  class="col-sm-10">
    <select class="form-select" name="category"     selected  required>

      <option selected >{{$data->category}}</option>

     @foreach($category as $category)
      <option>{{$category->category_name}}</option>
     @endforeach
    </select>

    </select>
</div>
</div>

</div>
<label class=" col-sm-2 col-form-label">Old Image</label>
   <div class=" col-sm-10 text-center">
    <img class="100" width="100" height="100" src="/productimage/{{$data->image}}" required >

</div>
<label class=" col-sm-2 col-form-label">Change Image</label>
  <input  type="file" name="file">

<div class="pt-2 text-center">
<input  type="submit"   class="btn btn-success "  value="Update"  >
</div>
</form>


</div>
</div>



@include('admin.script')

  </body>
</html>

