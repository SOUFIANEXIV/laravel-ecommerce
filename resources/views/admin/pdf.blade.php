<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <title>PDF</title>
</head>

    <body>
    <table class="table  table-striped table-primary">
  <thead>
    <tr>
      <th scope="col">Custumer Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Poduct</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Paiment</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <td>{{$order->name}}</td>
      <td>{{$order->phone}}</td>
      <td>{{$order->adress}}</td>
      <td>{{$order->product_name}}</td>
      <td>{{$order->quantity}}</td>
      <td>{{$order->price}}</td>
      <td>{{$order->payment_status}}</td>
    </tr>


  </tbody>
</table>









<script src="admin/assets/js/bootstrap.bundle.min.js"></script>



</body>
</html>
