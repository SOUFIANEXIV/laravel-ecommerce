
<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/public">

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
<!--

TemplateMo 571 Hexashop

https://templatemo.com/tm-571-hexashop

-->
    </head>
    @include('sweetalert::alert')
    <body>

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
                        <li class="scroll-to-section"><a href="{{url('/')}}" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="{{url('/about')}}">About Us</a></li>
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
    </header>




    <section class="section" id="product">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6">
                <div class="left-images">


                <img src="/productimage/{{$product->image}}" alt="">


                </div>
            </div>


            <div class="col-lg-4">
                <div class="right-content">
                    <h4>{{$product->title}}</h4>
                    <span class="price">${{$product->price}}</span>
                    <span> Category:   {{$product->category}}</span>
                    <ul class="stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                    <span>{{$product->description}}.</span>
                    <div class="quote">
                        <i class="fa fa-quote-left"></i><p>{{$product->description}}</p>
                    </div>

                    <div class="total">

                        <form action="{{url('addcart',$product->id)}}" method="post">
                            @csrf
                            <div class="quantity-content">
                        <div class="left-content">
                            <h6> Order Now</h6>
                        </div>
                        <div class="right-content">
                            <div class="quantity buttons_added">



                                <input type="number"   min="1" max="" name="quantity" value="1"   class="input-text qty text" >

                            </div>
                        </div>
                    </div>

                            <input  class="btn btn-primary" type="submit" value="Add To Cart" >

                           </form>





                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <div class="container  ">
        <h3 class="">Comments</h3>
        <form  action="{{url('add_comment')}}" method="post">
            @csrf
        <div class=" pb-3">
            <input type="hidden"name="product_id" value="{{$product->id}}">
  <textarea class="form-control  w-50   "  name="comment" style="resize:none"  placeholder="Leave a comment here" id="floatingTextarea"  maxlength="100"></textarea>

</div>

 <div div class="col-12 mb-2 ps-0">
    <button class="btn btn-primary" type="submit">Comment</button>

  </div>
</form>

    </div>
    <div class="container pb-3">
        <h5 class="pt-2">All comments</h5>

@foreach($comment as $comment)

        <h6>{{$comment->name}}</h6>
        <p>{{$comment->comment}}</p>
        <small class="">{{$comment->created_at}}</small>

        <a href="javascript::void(0); " onclick="reply(this)" data-commentid="{{$comment->id}}">Reply</a>

     @if( auth::id() == $comment->user_id)

        <a href="{{url('delete_comment',$comment->id) }}" data-commentid="{{$comment->id}}" class="text-danger">Delete</a>
@endif

        @foreach($reply as $rep)
        @if($rep->comment_id==$comment->id)
         <div class="ps-5 pt-2 mb-2"  >

          <h6>{{$rep->name}}</h6>
        <p class="ps-3">{{$rep->reply}}</p>
        <a href="javascript::void(0); " onclick="reply(this)" data-commentid="{{$comment->id}}">Reply</a>


        @if( auth::id() && auth::id() == $rep->user_id)
        <a href="{{url('delete_reply',$rep->id) }}" data-commentid="{{$comment->id}}" class="text-danger">Delete</a>
     @endif


         </div>
         @endif
         @endforeach




@endforeach

        <div class=" pb-3  replyDiv" style="display:none">
        <form action="{{url('add_reply')}}" method="post">
            @csrf

      <input  type="text" id="commentId" name="commentId" hidden>

  <textarea class="form-control  w-50  " name="reply" style="resize:none"  placeholder="Reply" id="floatingTextarea"  maxlength="100"></textarea>
<div div class="col-12 mb-2">
    <button class="btn btn-primary" type="submit">Reply</button>
    <a  href="javascript::void(0); " class="btn btn-primary" onclick="reply_close(this)" >Close</a>
  </div>
        </form>
</div>


</div>

   <script type="text/javascript">
    function reply(caller){
        document.getElementById('commentId').value=$(caller).attr('data-commentid');

$('.replyDiv').insertAfter($(caller));
$('.replyDiv').show();
    }
    function reply_close(caller){
     $('.replyDiv').hide();
  }



   </script>



<script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>










































    <script src="assets/js/jquery-2.1.0.min.js"></scrip0>

<!-- Bootstrap -->
<script src="assets/js/popper.js"></scrip0>
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
