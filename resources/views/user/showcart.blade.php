<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet icon" type="image" href="/productimage/basket.png">

    <title>Store Ecommerce</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--

TemplateMo 571 Hexashop

https://templatemo.com/tm-571-hexashop

-->
    </head>

    <body>
    @include('sweetalert::alert')

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('/')}}" class="logo">
                            <img src="assets/images/logo.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                        <li class="scroll-to-section"><a href="{{url('/')}}" >Home</a></li>
                            <li class="scroll-to-section"><a   href="{{url('/about')}}">About Us</a></li>
                            <li class="scroll-to-section"><a href="{{url('/contact')}}">Contact Us</a></li>

                            @guest
                            @if (Route::has('login'))


                                <li >
                                    <a class="btn btn-primary text-light py-0" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li>
                                   <a class="btn btn-success py-0" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <ul class="nav-item dropdown pt-2 texr-dark">
                               <a  class="pe-2 text-dark" href="{{url('showcart')}}"><i class="fa fa-shopping-cart"></i>Cart[{{$count}}]</a>

                                <a id="navbarDropdown" class=" dropdown-toggle text-dark " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item   "  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </ul>
                        @endguest


                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
        @if(session()->has('message'))
<div class="alert alert-warning text-center ">
<button  type="button" class="close" data-dismiss="alert" >X</button>
{{session()->get('message')}}
</div>
@endif
@if(\Session::has('error'))
        <div class="alert alert-danger text-center">

        <button  type="button" class="close" data-dismiss="alert" >X</button>
        {{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif






    </header>

<div class="container" style="padding:160px;">


    <table class="table table-bordered text-center">

  <thead class="table-primary">
    <tr>

      <th >Product Name</th>
      <th >Qunatity</th>
      <th >Price</th>
      <th >Delete</th>
    </tr>
  </thead>
  <?php $total=0 ;  ?>
  <?php  ;  ?>
    @foreach($cart as $carts)
  <tbody>

    <tr>

      <td>

{{$carts->product_title}}
      </td>
      <td>


      {{$carts->quantity}}</td>
      <td>


      {{$carts->price}}$</td>
      <td><a class="btn btn-danger"  href="{{url('delete',$carts->id)}}">Delete</a></td>
    </tr>


  </tbody>

  <?php $total=$total + $carts->price?>

@endforeach

</table>
<h3 class="text-center"> Total Price:   {{$total}}$</h3>

<div class="text-center pt-5">
@if($total > 0)

<a  href="{{url('cash_order')}}" style="display:block" class="mb-2"  onclick="confirmation(event)" ><span class="fw-bold">Cash On Delevery:</span> <img src="/productimage/cod.png"  style="width:50px" style="height:30px" ></a></li>
<a   href="{{url('stripe',$total)}}" style="display:block" class="mb-2"  ><span class="fw-bold">Paiment en ligne:</span> <img src="/productimage/visa.png"  style="width:80px" style="height:80px" ></a></li>
<a   href="{{url('processpaypal',$total)}}" style="display:block"  ><span class="fw-bold">Paypal:</span> <img src="/productimage/paypal.png"  style="width:70px" style="height:70px" ></a></li>

@endif

</div>





</div>








<script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title: "Are you sure to order this product",
            text: "You will not be able to revert this!",
            icon: "success",
            buttons: true,
            dangerMode: true,

        })
        .then((willCancel) => {
            if (willCancel) {



                window.location.href = urlToRedirect;

            }


        });


    }
</script>


    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);

            });
        });

    </script>
        <script src="admin/assets/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
