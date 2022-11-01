
<!DOCTYPE html>
<html lang="en">
  <head>

  <base href="/public">
 @include('admin.header')
  </head>
  <body>



  @include('admin.sidebar')
@include('admin.navbar')

<div class="container-fluid page-body-wrapper">
<div class="container  ">
    <form action="{{url('send_user_email',$order->id)}}" method="post">
        @csrf
    <h1 class="text-center pt-3">Send Email To : <span>{{$order->email}}</span></h1>

    <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Text</label>
  <textarea class="form-control bg-light" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<input type="submit" class="btn  btn-success">
</form>
</div>
</div>







@include('admin.script')

  </body>
</html>

