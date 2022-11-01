






<section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class="pb-5">Our Latest Products</h2>

  <form  action="{{url('search')}}" method="get"  class="form-inline float-end" role="search">
    @csrf
        <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

 </div>




                </div>
            </div>
        </div>











        <div class="container">
            <div class="row">


                @foreach($data as $product)
                <div class="col-lg-4">
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="{{url('product_details',$product->id)}}"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{url('product_details',$product->id)}}"><i class="fa fa-star"></i></a></li>
                                    <li><a href="{{url('product_details',$product->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <img src="/productimage/{{$product->image}}" alt="">
                        </div>
                        <div class="down-content">
                            <h4>{{$product->title}}</h4>
                            <span>${{$product->price}}</span>
                            <span>{{$product->category}}</span>

                           <form action="{{url('addcart',$product->id)}}" method="post">
                            @csrf

                            <input type="number"  min="1"  name="quantity" value="1" class="input-text qty text w-25 text-center" >

                            <input type="hidden" name="product_id"    value="{{$product->id}}" >
                            <input  class="btn btn-dark   w-50" type="submit" value="Add To Cart"  style="margin-left:70px"  >
                           </form>


                            <ul class="stars">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>


                        </div>
                    </div>
                </div>

@endforeach

@if(method_exists($data,'links'))

<div class="d-flex justify-content-center">
    {!! $data->links() !!}


</div>
@endif

            </div>
        </div>

    </section>

