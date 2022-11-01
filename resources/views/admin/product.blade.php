
<!DOCTYPE html>
<html lang="en">
  <head>
 @include('admin.header')


 <base  href="/public" >

  </head>
  <body>



  @include('admin.sidebar')
@include('admin.navbar')
<div class="container-fluid page-body-wrapper">
<div class="container  ">
<h1 class="fs-3 text-center"> Add Products</h1>


@if(session()->has('message'))
<div class="alert alert-success ">
<button  type="button" class="close" data-dismiss="alert" >X</button>
{{session()->get('message')}}
</div>
@endif
<form action="{{url('uploadproduct')}}" method="post" enctype="multipart/form-data" >
    @csrf
<div class="row mb-3" >

    <label class=" col-sm-2 col-form-label ">Product title:</label>
   <div class="col-sm-10">
    <input type="text"  class="form-control text-light"  name="title"  placeholder="Give a product title"  required >
</div>
</div>


<div class="row mb-3" >

    <label class=" col-sm-2 col-form-label">Price:</label>
   <div class="col-sm-10">
    <input type="text"  class="form-control text-light"  name="price"  placeholder=" product price"  required >
</div>
</div>
<div class="row mb-3" >

    <label class=" col-sm-2 col-form-label">Description:</label>
   <div class="col-sm-10">
    <input type="text"  class="form-control text-light"  name="des"  placeholder="Description"  required >
</div>
</div>
<div class="row mb-3" >


    <label class=" col-sm-2 col-form-label">Quantity:</label>
   <div class="col-sm-10">
    <input type="number"  class="form-control text-light"  name="quantity"  placeholder="quantity"  required >
</div>
</div>
<div class="row mb-3">
    <label  class=" col-sm-2 col-form-label">Category:</label>
    <div  class="col-sm-10">
    <select class="form-select" name="category"     required>
      <option selected disabled value="">Category</option>
     @foreach($category as $category)
      <option>{{$category->category_name}}</option>
     @endforeach
    </select>
</div>
</div>
<div class="pt-2">

    <input type="file"  class="pt-2" name="file" required >
</div >
<div class="pt-2 text-center">
<input  type="submit"   class="btn btn-success "    >
</div>
</form>


</div>
</div>
@include('admin.script')

  </body>
</html>

