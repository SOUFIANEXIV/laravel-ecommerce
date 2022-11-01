<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;
use App\Models\Comment;
use App\Models\Reply;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Subscriber;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Route;


class RedirectController extends Controller
{
    public function redirect()

    {
        $usertype=Auth::user()->usertype;
        if($usertype == '1'){

            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            $order=order::all();
            $total_revenue=0;
            foreach($order as $order){

                $total_revenue=$total_revenue+$order->price;
            }

            $total_deleverd=order::where( 'statuts','=','Delevered')->get()->count();
            $total_not_deleverd=order::where( 'statuts','=','Not Delivered')->get()->count();

            return view('admin.home' ,compact('total_product','total_order','total_user','total_revenue','total_deleverd','total_not_deleverd'));
        }
        else{

        $data = product::paginate(9);
        $user=auth()->user();
        $count=cart::where('phone',$user->phone)->count();


        return view(('user.home'),compact('data','count'));
        }
    }

    public function index(){



        if (auth::id()){

            return redirect('redirect');
        }

       else{


        $data = product::paginate(9);



return view('user.home',compact('data'));

       }
    }
    public function search(Request $request){


        $search=$request->search;

        if($search== ''  )

        {
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();



            $data = product::paginate(9);


            return view('user.home',compact('data','count','cart'));
        }
        $user=auth()->user();
        $cart=cart::where('phone',$user->phone)->get();
        $count=cart::where('phone',$user->phone)->count();

        $data=product::where('title','like','%'.$search.'%')->get();
        return view('user.home',compact('data','count','cart'));


    }
    public function addcart( Request $request , $id){

if(Auth::id()){

$user=auth()->user();
$userid=$user->id;

$product=product::find($id);

$product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->first('id');


if($product_exist_id){

    $cart=cart::find($product_exist_id)->first();

    $quantity=$cart->quantity;
    $cart->quantity=$quantity+ $request->quantity;

    $cart->price=$product->price * $cart->quantity;
    $cart->save();
    Alert::success('Product Added Successfully');

    return redirect()->back();




}else{

    $cart=new Cart;
    $cart->name=$user->name;
    $cart->phone=$user->phone;
    $cart->adress=$user->adress;
    $cart->email=$user->email;
    $cart->product_title=$product->title;
    $cart->product_id=$request->product_id;

    $cart->quantity=$request->quantity;
    $cart->price=$product->price * $request->quantity;
    $cart->user_id=Auth()->user()->id;

    $cart->save();
    Alert::success('Product Added Successfully');

        return redirect()->back();


}








}


else{
    return redirect('login');
}



    }
    public function showcart(){


        $user=auth()->user();
        $cart=cart::where('phone','=',$user->phone)->get();
        $count=cart::where('phone',$user->phone)->count();

        return view('user.showcart',compact('count','cart'));
    }
    public function deletecart($id){
        $data=cart::find($id);
        $data->delete();
        Alert::warning('Product Deleted');
        return redirect()->back();


    }
    public function cash_order(){

  $user=auth()->user();
  $phone=$user->phone;

$data=cart::where('phone','=',$phone)->get();
foreach($data as $data){

$order=new order;
$order->name=$data->name;
$order->phone=$data->phone;
$order->adress=$data->adress;
$order->email=$data->email;

$order->product_name=$data->product_title;
$order->price=$data->price;
$order->quantity=$data->quantity;
$order->statuts='Not Delivered ';
$order->payment_status='cash on delevery';
$order->save();
Alert::success('Order Confirme Successfully');

}
DB::table('carts')->where('phone',$phone)->delete();
return redirect()->back()->with('message','Order Confirme Successfully');




 }
 public function about(){
    return view('user.about');
 }

 public function contact(){
    return view('user.contact');
 }
 public function product_details($id){
    if(auth::id()){

          $user=auth()->user();
    $cart=cart::where('phone',$user->phone)->get();
    $count=cart::where('phone',$user->phone)->count();
    $product=product::findorFail($id);
    $comment= Comment::where('product_id',$product->id)->get();

    $reply=Reply::all();

    return view('user.product_details',compact('product','cart','count','comment','reply'));}

else{
   $product=product::findorFail($id);
   $comment= Comment::where('product_id',$product->id)->get();

    $reply=Reply::all();

    return view('user.product_details',compact('product','comment','reply'));
 }

}
public function stripe($total){

return view('user.stripe',compact('total'));


}

public function stripePost(Request $request,$total)
{
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    Stripe\Charge::create ([
            "amount" => $total*100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment ."
    ]);
    $user=auth()->user();
  $phone=$user->phone;

$data=cart::where('phone','=',$phone)->get();
foreach($data as $data){

$order=new order;
$order->name=$data->name;
$order->phone=$data->phone;
$order->adress=$data->adress;
$order->email=$data->email;

$order->product_name=$data->product_title;
$order->price=$data->price;
$order->quantity=$data->quantity;
$order->statuts='Not Delivered ';
$order->payment_status='Paid';
$order->save();

DB::table('carts')->where('phone',$phone)->delete();
Alert::success('Payment successful!');

};

   Session::flash('success', 'Payment successful!');

   return redirect('showcart');




}

 public function add_comment(Request $request){

if(auth::id()){
$comment=new comment;

$comment->name=Auth::user()->name;
$comment->email=Auth::user()->email;
$comment->product_id=$request->product_id;
$comment->user_id=Auth()->user()->id;
$comment->comment=$request->comment;
$comment->save();
return redirect()->back();

}else{
    return redirect('login');
}


 }
 public function add_reply(Request $request){

    if(auth::id()){

        $reply=new reply;
        $reply->name=Auth::user()->name;
$reply->email=Auth::user()->email;
$reply->comment_id=$request->commentId;
$reply->user_id=Auth()->user()->id;
$reply->reply=$request->reply;
$reply->save();
return redirect()->back();

    }
else{

    return redirect('login');
}
 }
public function  delete_comment($id){


    if(Auth::id()  ){




 $comment=comment::find($id);


    $comment->delete();
    return redirect()->back();

}
else{

    return redirect('login');



 }
}



 public function  delete_reply($id){


    if(auth::id() ){
    $reply=Reply::find($id);
    $reply->delete();
    return redirect()->back();}



    else{

        return redirect('login');



     }


 }
 public function subscriber(Request $request)
 {

 if(auth::id()){

        $subscriber =new subscriber;
        $subscriber->name=Auth::user()->name;
$subscriber->email=Auth::user()->email;

$subscriber->name=$request->name;
$subscriber->email=$request->email;
$subscriber->message=$request->message;

$subscriber->save();
Alert::success('Message had successfuly send!');
return redirect()->back()->with('Message had successfuly send!');



 }else{

    return redirect('login');
 }


 }



 public function processpaypal(Request $request ,$total){


    $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('processSuccess'),
                "cancel_url" => route('processCancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total,
                    ]
                ]
            ]
        ]);


        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect('showcart')->with('message','Order Confirme Successfully');

            Alert::success('Payment successful!');



        } else {
            return redirect('showcart')->with('error', $response['message'] ?? 'You have canceled the transaction.');;
        }
}


public function processSuccess(Request $request)
{

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {


            $user=auth()->user();
            $phone=$user->phone;

          $data=cart::where('phone','=',$phone)->get();
          foreach($data as $data){

          $order=new order;
          $order->name=$data->name;
          $order->phone=$data->phone;
          $order->adress=$data->adress;
          $order->email=$data->email;

          $order->product_name=$data->product_title;
          $order->price=$data->price;
          $order->quantity=$data->quantity;
          $order->statuts='Not Delivered ';
          $order->payment_status='Paypal';
          $order->save();

          DB::table('carts')->where('phone',$phone)->delete();
          Alert::success('Payment successful!');

            return redirect('showcart')->with('message','Order Confirme Successfully');
            Alert::success('Payment successful!');
          }

        } else {
            return redirect('showcart')->with('error', $response['message'] ?? 'You have canceled the transaction.');;
        }



}

 public function processCancel(Request $request)
    {
        return redirect('showcart')->with('error', $response['message'] ?? 'You have canceled the transaction.');;

    }

 

}






