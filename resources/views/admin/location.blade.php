
<!DOCTYPE html>
<html lang="en">
  <head>
 @include('admin.header')
  </head>
  <body>



  @include('admin.sidebar')
@include('admin.navbar')

<div class="container-fluid page-body-wrapper mx-0">
<div class="container">
<h1>user details</h1>


<table class="table">
  <thead>
    <tr>
      <th scope="col">ip</th>
      <th scope="col">Country</th>
      <th scope="col">Region</th>
      <th scope="col">City</th>
      <th scope="col">Timezone</th>
    </tr>
  </thead>
  <tbody class="text-light">
    <tr>
      <th >{{$user->ip}}</th>
      <td>{{$user->countryName}}</td>
      <td>{{$user->regionName}}</td>
      <td>{{$user->cityName}}</td>
      <td>{{$user->timezone}}</td>
    </tr>
    <tr>

  </tbody>
</table>

</div>
</div>

@include('admin.script')

  </body>
</html>
