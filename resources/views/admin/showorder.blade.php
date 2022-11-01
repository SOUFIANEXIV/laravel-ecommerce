
<!DOCTYPE html>
<html lang="en">
  <head>
 @include('admin.header')
  </head>
  <body>



  @include('admin.sidebar')
@include('admin.navbar')

<div class="container-fluid page-body-wrapper mx-0">
<div >



@if(session()->has('message'))
<div class="alert alert-success ">
<button  type="button" class="close" data-dismiss="alert" >X</button>
{{session()->get('message')}}
</div>
@endif

<form  action="{{url('search_admin')}}" method="get"  class="form-inline float-end" role="search">
    @csrf
        <input class="form-control bg-light" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    <h1 class="text-center mt-2">Orders</h1>

    <table class="table">
  <thead class="table-primary">
    <tr>

      <th >Name</th>
      <th >Phone</th>
      <th >Address</th>
      <th >Email</th>
      <th >Product title</th>
      <th >Quantity</th>
   <th >Price</th>
      <th >Status</th>
      <th >Paiment</th>
      <th >Action</th>
      <th >Print PDF</th>
      <th >Send Email</th>

    </tr>
  </thead>

  @foreach($order as $orders)
  <tbody class="table-dark">
    <tr>

      <td>{{$orders->name}}</td>
      <td>{{$orders->phone}}</td>
      <td>{{$orders->adress}}</td>
      <td>{{$orders->email}}</td>
      <td>{{$orders->product_name}}</td>

      <td>{{$orders->quantity}}</td>
    <td>{{$orders->price}}</td>
      <td>{{$orders->statuts}}</td>
      <td>{{$orders->payment_status}}</td>

      <td>

 <a   href="{{url('updatestatus',$orders->id)}}" onclick="return confirm('Are You Sure')" class ="btn btn-success">Delivred</a>




</td>
<td>
    <a href="{{url('print_pdf',$orders->id)}}" class="btn btn-primary"> Print PDF</a>
</td>
<td>
    <a   href="{{url('send_email',$orders->id)}} "class="btn btn-primary">Send Email</a>
</td>
    </tr>


  @endforeach
  </tbody>

</table>




</div>
</div>





@include('admin.script')

  </body>
</html>

