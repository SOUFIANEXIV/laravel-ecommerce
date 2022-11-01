<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Notifications\SendEmailNotification;
use PDF;
use Notification;
use Location;


class AdminController extends Controller
{

    public function show_category(){

        if(Auth::id()){
            if(Auth::user()->usertype =='1'){

 $data=Category::all();
       return view('admin.category',compact('data'));
            }else{

                return redirect('login');
            }
        }





             }
             public function add_category(Request $request){

                if(Auth::id()){
                    if(Auth::user()->usertype =='1'){

   $data=new category;
        $data->category_name=$request->Category;

        $data->save();
        return redirect()->back()->with('message','Category Added Successfully');


                    }
                    else{

                        return redirect('login');
                    }
                }



             }
             public function delete_category($id){

                if(Auth::id()){
                    if(Auth::user()->usertype =='1'){

  $data=Category::find($id);
                $data->delete();
                return redirect()->back()->with('message','Category Delete Successfully');


        }
        else{

            return redirect('login');
        }

    }


             }



 public function product(){


    if(Auth::id()){
        if(Auth::user()->usertype =='1'){

  $category=Category::all();


    return view('admin.product',compact('category'));

        }else{

            return redirect('login');
        }

    }



    if(Auth::id()){
        if(Auth::user()->usertype =='1'){

            return view('admin.product');
        }
        else{
            return redirect()->back();
        }


 }else{
    return redirect('login');
 }
}

 public function uploadproduct(Request $request){
    $data=new product;
    $image =$request->file;
    $imagename=time().'.'.$image->getClientOriginalExtension();
    $request->file->move('productimage',$imagename);
    $data->image=$imagename;


    $data->title=$request->title;
    $data->price=$request->price;
    $data->category=$request->category;

    $data->description=$request->des;

    $data->quantity=$request->quantity;
    $data->save();
    return redirect()->back()->with('message','Product Added Successfully');



 }


 public function showproduct(){

    if(Auth::id()){
        if(Auth::user()->usertype =='1'){

  $data =product::all();
 return view('admin.showproduct',compact('data'));
        }
        else{

            return redirect('login');
        }
    }







     }

     public function deleteproduct($id){
        $data=product::find($id);
        $data->delete();
        return redirect()->back()->with('message','Product Delete Successfully');
        ;
     }
     public function updateview($id){


        $data =product::find($id);
        $category=Category::all();
        return view('admin.updateview',compact('data','category'));
     }


     public function updateproduct( Request $request,  $id){


        $data=product::find($id);

        $image =$request->file;
        if($image)
        {


    $imagename=time().'.'.$image->getClientOriginalExtension();
    $request->file->move('productimage',$imagename);
    $data->image=$imagename;
}

    $data->title=$request->title;
    $data->price=$request->price;

    $data->description=$request->des;


    $data->quantity=$request->quantity;
    $data->category=$request->category;
    $data->save();
    return redirect()->back()->with('message','Product Updated Successfully');


     }
     public function showorder(){

        if(Auth::id()){
            if(Auth::user()->usertype =='1'){

  $order=Order::all();

        return view('admin.showorder',compact('order'));


            }else{
                return redirect('login');
            }
        }

     }
     public function  updatestatus($id){
        $order=Order::find($id);
        $order->statuts='Delevered';
        $order->payment_status='Paid';
        $order->save();
        return redirect()->back()->with('message','Product Delivred Successfully');


     }
     public function print_pdf($id){
        $order=order::find($id);

$pdf=PDF::loadView('admin.pdf',compact('order'));
return  $pdf->download('order_details.pdf');

    }
    public function send_email($id){


        $order=order::find($id);


return view('admin.email_info',compact('order'));

    }
    public function send_user_email(  Request $request, $id){

        $order=order::find($id);

        $details=[

            'message'=>$request->message,



        ];
        Notification::send($order,new SendEmailNotification($details));
    }
    public function search_admin(Request $request){


        $search=$request->search;

        $order=Order::where('name','like','%'.$search.'%')->orwhere('phone','like','%'.$search.'%')->get();

        return view('admin.showorder',compact('order'));


}

public function location(){

    $ip="196.217.198.94";

 $user=location::get($ip);

    return view('admin.location',compact('user'));
}

}
